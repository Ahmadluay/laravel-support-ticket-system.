<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestTickets extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Ticket::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('ticket_number')
                    ->label('ID')
                    ->badge(),

                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(40),

                TextColumn::make('priority')
                    ->label('Priority')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Low'            => 'info',
                        'Medium'         => 'warning',
                        'High', 'Urgent' => 'danger',
                        default          => 'gray',
                    }),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'New'         => 'info',
                        'In Progress' => 'warning',
                        'Resolved'    => 'success',
                        'Closed'      => 'gray',
                        default       => 'gray',
                    }),

                TextColumn::make('created_at_n8n')
                    ->label('Submitted At')
                    ->dateTime('d M Y - H:i'),
            ])
            ->actions([
                Action::make('open')
                    ->label('View')
                    ->url(fn (Ticket $record): string => route('filament.admin.resources.tickets.view', $record))
                    ->icon('heroicon-m-eye'),
            ]);
    }
}
