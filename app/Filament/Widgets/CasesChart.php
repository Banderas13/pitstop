<?php

namespace App\Filament\Widgets;

use App\Models\CaseModel;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CasesChart extends ChartWidget
{
    protected static ?string $heading = 'Cases This Month';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '400px';

    public function getHeading(): string
    {
        return 'Cases in ' . Carbon::now()->format('F Y');
    }

    protected function getData(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $cases = CaseModel::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy(function ($case) {
                return Carbon::parse($case->created_at)->format('d');
            });

        $days = collect(range(1, Carbon::now()->daysInMonth))->map(function ($day) {
            return str_pad($day, 2, '0', STR_PAD_LEFT);
        });

        $data = $days->map(function ($day) use ($cases) {
            return $cases->get($day, collect())->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Cases',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                    'borderWidth' => 2,
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
            'labels' => $days->values()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                    'grid' => [
                        'display' => true,
                        'drawBorder' => false,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
} 