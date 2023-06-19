<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $orders =  Order::all();
        $orderAntrian =  Order::where('status', 'Antrian')->get();
        $orderProses =  Order::where('status', 'Di Proses')->get();
        $orderSelesai =  Order::where('status', 'Selesai')->get();
        return [
            Card::make('Total Pesanan', $orders->count())->description('Total Keseluruhan Pesanan')->chart([7, 2, 10, 3, 15, 4, 17]),
            Card::make('Antrian', $orderAntrian->count())->description('Total Pesanan Dalam Antrian')->chart([7, 2, 10, 3, 15, 4, 17])->color('danger'),
            Card::make('Di Proses', $orderProses->count())->description('Total Pesanan Yang Diproses')->chart([7, 2, 10, 3, 15, 4, 17])->color('warning'),
            Card::make('Selesai', $orderSelesai->count())->description('Total Pesanan Yang Selesai')->chart([7, 2, 10, 3, 15, 4, 17])->color('success'),
        ];
    }
}
