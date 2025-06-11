<?php

namespace App\Filament\Widgets;

use App\Models\CaseModel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class TotalRevenueWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue = CaseModel::whereHas('offer')
            ->join('offers', 'cases.offer_id', '=', 'offers.id')
            ->sum('offers.price');

        $thisMonthRevenue = CaseModel::whereHas('offer')
            ->join('offers', 'cases.offer_id', '=', 'offers.id')
            ->whereBetween('cases.created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ])
            ->sum('offers.price');

        $thisQuarterRevenue = CaseModel::whereHas('offer')
            ->join('offers', 'cases.offer_id', '=', 'offers.id')
            ->whereBetween('cases.created_at', [
                Carbon::now()->startOfQuarter(),
                Carbon::now()->endOfQuarter(),
            ])
            ->sum('offers.price');

        return [
            Stat::make('This Month\'s Revenue', '€' . number_format($thisMonthRevenue, 2))
                ->description('Revenue for ' . Carbon::now()->format('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary')
                ->chart([3, 5, 7, 4, 6, 3, 5, 7])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('This Quarter\'s Revenue', '€' . number_format($thisQuarterRevenue, 2))
                ->description('Revenue for Q' . Carbon::now()->quarter . ' ' . Carbon::now()->year)
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning')
                ->chart([5, 7, 3, 6, 4, 7, 5, 3])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Total Revenue', '€' . number_format($totalRevenue, 2))
                ->description('Total revenue from all cases')
                ->descriptionIcon('heroicon-m-currency-euro')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
} 