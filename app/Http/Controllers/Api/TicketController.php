<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id'      => 'required|string|unique:tickets,ticket_id',
            'customer_name'  => 'required|string',
            'customer_email' => 'required|email',
            'subject'        => 'required|string',
            'category'       => 'required|string',
            'priority'       => 'required|string',
            'description'    => 'required|string',
            'status'         => 'nullable|string',
            'created_at_n8n' => 'nullable|string',
        ]);

        $ticket = Ticket::create([
            'ticket_id'      => $validated['ticket_id'],
            'customer_name'  => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'subject'        => $validated['subject'],
            'category'       => $validated['category'],
            'priority'       => $validated['priority'],
            'description'    => $validated['description'],
            'status'         => $validated['status'] ?? 'New',
            'created_at_n8n' => $validated['created_at_n8n'] ?? now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Ticket stored successfully',
            'data'    => $ticket
        ], 201);
    }
}

