<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = auth()->user()->invoices()->with('client')->latest()->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = auth()->user()->clients;

        return view('invoices.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $invoiceCount = auth()->user()->invoices()->count();

        if (auth()->user()->plan === 'free' && $invoiceCount >= 5) {
            return back()->with('error', 'Free plan limit reached. Upgrade to Pro.');
        }

        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'client_id' => $request->client_id,
            'invoice_number' => 'INV-' . time(),
            'issue_date' => now(),
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0,
        ]);

        $subtotal = 0;

        foreach ($request->items as $item) {
            $total = $item['quantity'] * $item['price'];

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $total,
            ]);

            $subtotal += $total;
        }

        $invoice->update([
            'subtotal' => $subtotal,
            'total' => $subtotal
        ]);

        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('items', 'client');

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load('items', 'client');

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));

        return $pdf->download('invoice.pdf');
    }

}
