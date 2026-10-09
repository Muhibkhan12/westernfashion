<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Admin.dashboard', [
            'userName'      => auth()->user()->name ?? 'Ayesha Muhib',
            'stats'         => $this->stats(),
            'categories'    => [],
            'topProducts'   => [],
            'lowStock'      => [],
            'lowStockCount' => 0,
            'orders'        => [],
            'series'        => $this->emptySeries(),
        ]);
    }

    private function stats(): array
    {
        return [
            ['label' => 'Revenue',          'value' => '$0',    'delta' => '+0.0%', 'up' => true],
            ['label' => 'Orders',           'value' => '0',     'delta' => '+0.0%', 'up' => true],
            ['label' => 'New customers',    'value' => '0',     'delta' => '+0.0%', 'up' => true],
            ['label' => 'Avg. order value', 'value' => '$0.00', 'delta' => '+0.0%', 'up' => true],
        ];
    }

    private function emptySeries(): array
    {
        $days7  = collect(range(6, 0))->map(fn ($i) => now()->subDays($i)->format('D'))->all();
        $days30 = collect(range(29, 0))->map(fn ($i) => now()->subDays($i)->format('M j'))->all();
        $months = collect(range(11, 0))->map(fn ($i) => now()->startOfMonth()->subMonths($i)->format('M'))->all();

        return [
            '7D'  => ['labels' => $days7,  'values' => array_fill(0, 7, 0)],
            '30D' => ['labels' => $days30, 'values' => array_fill(0, 30, 0)],
            '12M' => ['labels' => $months, 'values' => array_fill(0, 12, 0)],
        ];
    }
}