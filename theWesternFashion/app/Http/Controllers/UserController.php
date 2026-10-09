<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    public function showHello()
    {
        return "Hello";
    }

    public function customers()
    {
        $hasStatus = Schema::hasColumn('orders', 'status');
        $hasNumber = Schema::hasColumn('orders', 'order_number');
        $totalCol  = $this->firstColumn('orders', ['total', 'total_amount', 'grand_total', 'amount']);
        $hasPhone  = Schema::hasColumn('users', 'phone');
        $hasCity   = Schema::hasColumn('users', 'city');

        // Customers = users with at least one non-cancelled order
        $spent = $totalCol ? "COALESCE(SUM(orders.$totalCol), 0)" : "0";
        $select = "users.id, users.name, users.email, users.created_at, "
                . ($hasPhone ? "users.phone, " : "")
                . ($hasCity ? "users.city, " : "")
                . "COUNT(orders.id) as orders_count, $spent as total_spent, MAX(orders.created_at) as last_order_at";

        $query = DB::table('users')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->selectRaw($select)
            ->groupByRaw('users.id, users.name, users.email, users.created_at' . ($hasPhone ? ', users.phone' : '') . ($hasCity ? ', users.city' : ''));

        if ($hasStatus) {
            $query->whereRaw("LOWER(orders.status) <> 'cancelled'");
        }

        $rows = $query->get();

        // Last 4 orders for each customer (all statuses, for the drawer)
        $orderCols = array_values(array_filter([
            'id', 'user_id', 'created_at',
            $hasStatus ? 'status' : null,
            $hasNumber ? 'order_number' : null,
            $totalCol,
        ]));

        $recent = DB::table('orders')
            ->whereIn('user_id', $rows->pluck('id'))
            ->orderByDesc('created_at')
            ->get($orderCols)
            ->groupBy('user_id');

        $customers = $rows->map(function ($r) use ($recent, $hasStatus, $hasNumber, $totalCol, $hasPhone, $hasCity) {
            $joined = \Carbon\Carbon::parse($r->created_at);
            $last   = \Carbon\Carbon::parse($r->last_order_at);
            $today  = now()->startOfDay();

            return [
                'id'        => $r->id,
                'name'      => $r->name ?: 'Unknown',
                'email'     => strtolower($r->email ?? ''),
                'phone'     => ($hasPhone ? $r->phone : null) ?: '—',
                'city'      => ($hasCity ? $r->city : null) ?: '—',
                'joined'    => $joined->toIso8601String(),
                'joinedAgo' => (int) $joined->copy()->startOfDay()->diffInDays($today, true),
                'last'      => $last->toIso8601String(),
                'lastAgo'   => (int) $last->copy()->startOfDay()->diffInDays($today, true),
                'orders'    => (int) $r->orders_count,
                'spent'     => round((float) $r->total_spent, 2),
                'recent'    => collect($recent->get($r->id, []))->take(4)->map(function ($o) use ($hasStatus, $hasNumber, $totalCol) {
                    return [
                        'id'     => $hasNumber && $o->order_number
                                    ? $o->order_number
                                    : 'TWF-' . strtoupper(substr((string) $o->id, 0, 8)),
                        'date'   => \Carbon\Carbon::parse($o->created_at)->toIso8601String(),
                        'total'  => $totalCol ? round((float) $o->{$totalCol}, 2) : 0,
                        'status' => $hasStatus ? ucfirst(strtolower($o->status)) : 'Pending',
                    ];
                })->values()->all(),
            ];
        })->values()->all();

        return view('Admin.customers', compact('customers'));
    }

    private function firstColumn(string $table, array $candidates): ?string
    {
        foreach ($candidates as $col) {
            if (Schema::hasColumn($table, $col)) {
                return $col;
            }
        }
        return null;
    }
}