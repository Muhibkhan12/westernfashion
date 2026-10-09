<?php

namespace App\Http\Controllers;

use App\Models\Order;

class UserDashboardController extends Controller
{
    /** Orders that are still on their way (not delivered, not cancelled). */
    private const IN_PROGRESS = ['PENDING', 'CONFIRMED', 'PROCESSING', 'SHIPPED'];

    public function index()
    {
        $user = auth()->user();

        // every query starts from this user's orders only
        $mine = fn () => Order::where('user_id', $user->id);

        $stats = [
            'orders'     => $mine()->count(),
            'inProgress' => $mine()->whereIn('status', self::IN_PROGRESS)->count(),
            'delivered'  => $mine()->where('status', 'DELIVERED')->count(),
            // cancelled orders don't count as spend; "status" is nullable, so keep NULL rows too
            'spent'      => (float) $mine()
                ->where(fn ($q) => $q->whereNull('status')->orWhere('status', '!=', 'CANCELLED'))
                ->sum('total'),
        ];

        // newest 4 orders, with the number of pieces (sum of quantities) on each
        $recent = $mine()
            ->withSum('items as items_count', 'quantity')
            ->latest()
            ->take(4)
            ->get();

        // the address lives on each order, so show the one from the latest order
        $lastOrder = $recent->first();

        return view('User.Dashboard', compact('user', 'stats', 'recent', 'lastOrder'));
    }
}