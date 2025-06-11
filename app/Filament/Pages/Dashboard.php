<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Welcome to Pitstop' ;

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static bool $shouldRegisterNavigation = false;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\TotalRevenueWidget::class,
            \App\Filament\Widgets\CasesStatsOverview::class,
            \App\Filament\Widgets\CasesChart::class,
            \App\Filament\Widgets\CasesStatusChart::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return [
            'default' => 2,
            'sm' => 2,
            'md' => 2,
            'lg' => 2,
            'xl' => 2,
            '2xl' => 2,
        ];
    }

    public function getColumns(): int | array
    {
        return 1;
    }

} 