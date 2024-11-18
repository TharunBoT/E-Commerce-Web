<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class ProductStatOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Products', Product::count()) // Count the number of products
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Orders', Order::count())
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Users', User::count())
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
