<?php
namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\Action;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;
use Filament\Forms;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            Action::make('export')
                ->button()
                ->action('export'),
        ]);
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
