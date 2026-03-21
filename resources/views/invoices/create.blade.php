@extends('layouts.app')

@section('content')

<h2>Create Invoice</h2>

<form method="POST" action="{{ route('invoices.store') }}">
    @csrf

    <label>Client:</label>
    <select name="client_id" required>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="items">
            <tr>
                <td><input type="text" name="items[0][name]" required></td>
                <td><input type="number" name="items[0][quantity]" value="1" class="qty"></td>
                <td><input type="number" name="items[0][price]" value="0" class="price"></td>
                <td class="total">0</td>
                <td><button type="button" onclick="removeRow(this)">X</button></td>
            </tr>
        </tbody>
    </table>

    <br>

    <button type="button" onclick="addRow()">+ Add Item</button>

    <br><br>

    <h3>Subtotal: <span id="subtotal">0</span></h3>

    <button type="submit">Save Invoice</button>
    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif
</form>

@endsection

<script>
let index = 1;

function addRow() {
    let row = `
    <tr>
        <td><input type="text" name="items[${index}][name]" required class="class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"></td>
        <td><input type="number" name="items[${index}][quantity]" value="1" class="class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"></td>
        <td><input type="number" name="items[${index}][price]" value="0" class="class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400""></td>
        <td class="total">0</td>
        <td><button type="button" onclick="removeRow(this)">X</button></td>
    </tr>
    `;
    document.getElementById('items').insertAdjacentHTML('beforeend', row);
    index++;
}

function removeRow(button) {
    button.closest('tr').remove();
    calculateTotal();
}

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('qty') || e.target.classList.contains('price')) {
        let row = e.target.closest('tr');
        let qty = row.querySelector('.qty').value;
        let price = row.querySelector('.price').value;
        let total = qty * price;

        row.querySelector('.total').innerText = total;

        calculateTotal();
    }
});

function calculateTotal() {
    let subtotal = 0;

    document.querySelectorAll('#items tr').forEach(row => {
        let total = parseFloat(row.querySelector('.total').innerText) || 0;
        subtotal += total;
    });

    document.getElementById('subtotal').innerText = subtotal;
}
</script>