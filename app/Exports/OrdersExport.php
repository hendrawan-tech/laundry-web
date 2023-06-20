<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::with('category', 'user')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Order ID',
            'Kategori',
            'Total',
            'Nama User',
            'Telepon User',
            'Tanggal Laundry',
            'Status',
        ];
    }

    /**
     * @param mixed $order
     * @return array
     */
    public function map($order): array
    {
        return [
            $order->code,
            $order->category->name,
            'Rp ' . number_format($order->price, 0, ',', '.'),
            $order->user->name,
            $order->user->phone_number,
            Carbon::parse($order->created_at)->format('d M Y, H:i:s'),
            $order->status,
        ];
    }
}
