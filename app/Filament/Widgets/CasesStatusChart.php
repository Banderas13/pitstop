<?php

namespace App\Filament\Widgets;

use App\Models\CaseModel;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CasesStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Cases by Status';
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $cases = CaseModel::all();
        
        $statusCounts = [
            'Pending' => $cases->where('approval', 0)->count(),
            'Approved' => $cases->where('approval', 1)->count(),
            'Rejected' => $cases->where('approval', 2)->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Cases by Status',
                    'data' => array_values($statusCounts),
                    'backgroundColor' => [
                        '#9CA3AF', // Gray for Pending
                        '#10B981', // Green for Approved
                        '#EF4444', // Red for Rejected
                    ],
                    'borderColor' => '#ffffff',
                ],
            ],
            'labels' => array_keys($statusCounts),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }
} 