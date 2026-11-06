<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            // ->components([
            //     TextInput::make('ticket_id')
            //         ->required(),
            //     TextInput::make('customer_name')
            //         ->required(),
            //     TextInput::make('customer_email')
            //         ->email()
            //         ->required(),
            //     TextInput::make('subject')
            //         ->required(),
            //     TextInput::make('category')
            //         ->required(),
            //     TextInput::make('priority')
            //         ->required(),
            //     Textarea::make('description')
            //         ->required()
            //         ->columnSpanFull(),
            //     Select::make('status')
            //         ->options(['New' => 'New', 'In Progress' => 'In progress', 'Resolved' => 'Resolved', 'Closed' => 'Closed'])
            //         ->default('New')
            //         ->required(),
            //     DateTimePicker::make('created_at_n8n'),
            // ]);
            ->components([
                Section::make('Ticket Details')
                    ->description('General information about the customer support ticket.')
                    ->schema([
                        TextInput::make('ticket_number')
                            ->label('Ticket ID')
                            ->required()
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('customer_name')
                            ->label('Customer Name')
                            ->required(),

                        TextInput::make('customer_email')
                            ->label('Customer Email')
                            ->email()
                            ->required(),

                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->columnSpanFull(),

                        Select::make('category')
                            ->label('Category')
                            ->options([
                                'Technical' => 'Technical Support',
                                'Billing'   => 'Billing & Payments',
                                'General'   => 'General Inquiry',
                                'Feedback'  => 'Feedback',
                            ])
                            ->required(),

                        Select::make('priority')
                            ->label('Priority')
                            ->options([
                                'Low'    => 'Low',
                                'Medium' => 'Medium',
                                'High'   => 'High',
                                'Urgent' => 'Urgent',
                            ])
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'New'         => 'New',
                                'In Progress' => 'In Progress',
                                'Resolved'    => 'Resolved',
                                'Closed'      => 'Closed',
                            ])
                            ->required(),

                        Textarea::make('description')
                            ->label('Issue Description')
                            ->rows(4)
                            ->columnSpanFull()
                            ->required(),
                    ])->columns(2),

                    // DateTimePicker::make('created_at_n8n'),

                Section::make('Timestamps')
                    ->description('Timestamps related to the ticket.')
                    ->schema([
                        DateTimePicker::make('created_at_n8n')
                            ->label('Submitted At')
                            ->disabled()
                            ->dehydrated(),
                    ])->columns(1),
            ]);
    }
}
