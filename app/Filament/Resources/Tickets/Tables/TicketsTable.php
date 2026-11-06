<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ticket_number')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color('gray'),

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
                    ->dateTime('d M Y - H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'New'         => 'New',
                        'In Progress' => 'In Progress',
                        'Resolved'    => 'Resolved',
                        'Closed'      => 'Closed',
                    ]),

                SelectFilter::make('priority')
                    ->options([
                        'Low'    => 'Low',
                        'Medium' => 'Medium',
                        'High'   => 'High',
                        'Urgent' => 'Urgent',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
