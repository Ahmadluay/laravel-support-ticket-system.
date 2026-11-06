<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;

class TicketsByPriorityChart extends ChartWidget
{
    protected ?string $heading = 'Tickets By Priority Chart';

    protected function getData(): array
    {
        $low = Ticket::where('priority', 'Low')->count();
        $medium = Ticket::where('priority', 'Medium')->count();
        $high = Ticket::where('priority', 'High')->count();
        $urgent = Ticket::where('priority', 'Urgent')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Tickets',
                    'data' => [$low, $medium, $high, $urgent],
                    'backgroundColor' => [
                        '#3b82f6',
                        '#f59e0b',
                        '#ef4444',
                        '#991b1b',
                    ],
                ],
            ],
            'labels' => ['Low', 'Medium', 'High', 'Urgent'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
