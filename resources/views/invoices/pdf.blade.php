<h2>Invoice {{ $invoice->invoice_number }}</h2>

<p>Client: {{ $invoice->client->name }}</p>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
    </tr>

    @foreach($invoice->items as $item)
        <tr>
            <td>{{ $item->item_name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->total }}</td>
        </tr>
    @endforeach
</table>

<h3>Total: ₹{{ $invoice->total }}</h3>