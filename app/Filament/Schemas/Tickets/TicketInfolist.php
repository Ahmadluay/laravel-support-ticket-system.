<?php

namespace App\Filament\Schemas\Tickets;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->schema([
                        TextEntry::make('ticket_number')
                            ->label('Ticket ID')
                            ->badge(),

                        TextEntry::make('customer_name')
                            ->label('Customer Name'),

                        TextEntry::make('customer_email')
                            ->label('Customer Email')
                            ->copyable(),

                        TextEntry::make('created_at_n8n')
                            ->label('Submitted At')
                            ->dateTime('d M Y - H:i'),
                    ])->columns(2),

                Section::make('Ticket Details')
                    ->schema([
                        TextEntry::make('subject')
                            ->label('Subject')
                            ->columnSpanFull(),

                        TextEntry::make('category')
                            ->label('Category')
                            ->badge(),

                        TextEntry::make('priority')
                            ->label('Priority')
                            ->badge()
                            ->color(fn (?string $state): string => match ($state) {
                                'Low' => 'info',
                                'Medium' => 'warning',
                                'High', 'Urgent' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (?string $state): string => match ($state) {
                                'New' => 'info',
                                'In Progress' => 'warning',
                                'Resolved' => 'success',
                                'Closed' => 'gray',
                                default => 'gray',
                            }),

                        TextEntry::make('description')
                            ->label('Issue Description')
                            ->columnSpanFull(),
                    ])->columns(3),
            ]);
    }
}
