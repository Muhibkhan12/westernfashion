<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CustomOrderController extends Controller
{
    // ---- the choices shown on the form (edit these lists to match what you really offer) ----
    public const STYLES    = ['Field jacket', 'Leather jacket', 'Denim trucker', 'Shearling aviator', 'Wool coat', 'Waxed cotton jacket', 'Something else'];
    public const MATERIALS = ['Wool', 'Waxed cotton', 'Full-grain leather', 'Shearling', 'Denim'];
    public const COLORS    = ['Black' => '#1C1A16', 'Brick' => '#9A3D28', 'Blue' => '#3B5BA5', 'Cream' => '#EDE9E3', 'Camel' => '#B08D57', 'Olive' => '#57624A'];
    public const LININGS   = ['No lining', 'Cotton', 'Wool flannel', 'Quilted'];
    public const HARDWARE  = ['Brass', 'Silver', 'Black', 'Match the jacket'];
    public const FITS      = ['Slim', 'Regular', 'Relaxed', 'Oversized'];
    public const SIZES     = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
    public const BUDGETS   = ['Under $300', '$300 – $500', '$500 – $800', '$800+', 'Not sure yet'];

    public function create()
    {
        return view('custom-order', [
            'styles'    => self::STYLES,
            'materials' => self::MATERIALS,
            'colors'    => self::COLORS,
            'linings'   => self::LININGS,
            'hardware'  => self::HARDWARE,
            'fits'      => self::FITS,
            'sizes'     => self::SIZES,
            'budgets'   => self::BUDGETS,
            'user'      => auth()->user(),
        ]);
    }

    public function store(Request $request)
    {
        // honeypot: real people never see/fill this field. Pretend it worked, store nothing.
        if ($request->filled('website')) {
            return redirect()->route('custom-order.create')
                ->with('custom_order_number', 'CUS-' . now()->format('ymd') . '-' . strtoupper(Str::random(4)))
                ->with('custom_order_email', (string) $request->input('email'));
        }

        $measure = ['nullable', 'numeric', 'between:10,250'];

        $data = $request->validate([
            'style'    => ['required', Rule::in(self::STYLES)],
            'material' => ['required', Rule::in(self::MATERIALS)],
            'color'    => ['required', Rule::in([...array_keys(self::COLORS), 'Other'])],
            'color_other' => ['required_if:color,Other', 'nullable', 'string', 'max:100'],
            'lining'   => ['nullable', Rule::in(self::LININGS)],
            'hardware' => ['nullable', Rule::in(self::HARDWARE)],

            'fit'           => ['required', Rule::in(self::FITS)],
            'sizing_mode'   => ['required', Rule::in(['standard', 'custom'])],
            'standard_size' => ['required_if:sizing_mode,standard', 'nullable', Rule::in(self::SIZES)],
            'unit'          => ['required_if:sizing_mode,custom', 'nullable', Rule::in(['cm', 'in'])],
            'height'         => $measure,
            'chest'          => array_merge(['required_if:sizing_mode,custom'], $measure),
            'waist'          => array_merge(['required_if:sizing_mode,custom'], $measure),
            'shoulder_width' => array_merge(['required_if:sizing_mode,custom'], $measure),
            'sleeve_length'  => array_merge(['required_if:sizing_mode,custom'], $measure),
            'jacket_length'  => array_merge(['required_if:sizing_mode,custom'], $measure),
            'quantity'       => ['required', 'integer', 'between:1,10'],

            'monogram'  => ['nullable', 'string', 'max:40'],
            'details'   => ['nullable', 'string', 'max:2000'],
            'budget'    => ['nullable', Rule::in(self::BUDGETS)],
            'needed_by' => ['nullable', 'date', 'after:today'],
            'reference_images'   => ['nullable', 'array', 'max:4'],
            'reference_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'consent' => ['accepted'],
        ], [
            'consent.accepted'  => 'Please confirm we may contact you about this request.',
        ]);

        $data['unit'] = $data['unit'] ?? 'cm';

        // keep only what belongs to the chosen sizing mode
        if ($data['sizing_mode'] === 'standard') {
            foreach (['chest', 'waist', 'shoulder_width', 'sleeve_length', 'jacket_length', 'height'] as $k) {
                $data[$k] = null;
            }
        } else {
            $data['standard_size'] = null;
        }
        if ($data['color'] !== 'Other') {
            $data['color_other'] = null;
        }

        $paths = [];
        foreach ($request->file('reference_images', []) as $file) {
            $paths[] = $file->store('custom-orders', 'public');
        }

        unset($data['consent'], $data['reference_images']);

        $order = CustomOrder::create($data + [
            'user_id'          => auth()->id(),
            'order_number'     => $this->newNumber(),
            'reference_images' => $paths,
        ]);

        return redirect()->route('custom-order.create')
            ->with('custom_order_number', $order->order_number)
            ->with('custom_order_email', $order->email);
    }

    private function newNumber(): string
    {
        do {
            $n = 'CUS-' . now()->format('ymd') . '-' . strtoupper(Str::random(4));
        } while (CustomOrder::where('order_number', $n)->exists());

        return $n;
    }
}