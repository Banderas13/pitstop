<?php

namespace App\Filament\Widgets;

use App\Models\CaseModel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CasesStatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $totalCases = CaseModel::count();
        $pendingCases = CaseModel::where('approval', 0)->count();
        $approvedCases = CaseModel::where('approval', 1)->count();
        $rejectedCases = CaseModel::where('approval', 2)->count();

        return [
            Stat::make('Total Cases', $totalCases)
                ->description('All cases in the system')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('gray'),

            Stat::make('Pending Cases', $pendingCases)
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Approved Cases', $approvedCases)
                ->description('Successfully approved')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Rejected Cases', $rejectedCases)
                ->description('Not approved')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
} 