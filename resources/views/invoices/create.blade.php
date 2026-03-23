@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-semibold mb-4">Create Invoice</h2>

    <form method="POST" action="{{ route('invoices.store') }}">
        @csrf

        <!-- Select Client -->
        <div class="mb-4">
            <label class="block mb-1 text-sm">Select Client</label>
            <select name="client_id" class="w-full border p-2 rounded" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Items -->
        <div id="items-container" class="space-y-3">

            <div class="grid grid-cols-4 gap-2 item-row">
                <input type="text" name="items[0][name]" placeholder="Item"
                    class="border p-2 rounded" required>

                <input type="number" name="items[0][quantity]" placeholder="Qty"
                    class="border p-2 rounded qty" required>

                <input type="number" step="0.01" name="items[0][price]" placeholder="Price"
                    class="border p-2 rounded price" required>

                <input type="text" placeholder="Total"
                    class="border p-2 rounded total bg-gray-100" readonly>
            </div>

        </div>

        <!-- Add Button -->
        <button type="button" onclick="addRow()"
            class="mt-3 bg-gray-200 px-3 py-1 rounded">
            + Add Item
        </button>

        <!-- Grand Total -->
        <div class="mt-6 text-right">
            <p class="text-sm">Grand Total</p>
            <p id="grand-total" class="text-xl font-bold text-green-600">₹0.00</p>
        </div>

        <!-- Submit -->
        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Save Invoice
        </button>

    </form>

</div>

@endsection

<script>
let index = 1;

function addRow() {
    const container = document.getElementById('items-container');

    const row = document.createElement('div');
    row.classList.add('grid', 'grid-cols-4', 'gap-2', 'item-row');

    row.innerHTML = `
        <input type="text" name="items[${index}][name]" placeholder="Item"
            class="border p-2 rounded" required>

        <input type="number" name="items[${index}][quantity]" placeholder="Qty"
            class="border p-2 rounded qty" required>

        <input type="number" step="0.01" name="items[${index}][price]" placeholder="Price"
            class="border p-2 rounded price" required>

        <input type="text" placeholder="Total"
            class="border p-2 rounded total bg-gray-100" readonly>
    `;

    container.appendChild(row);
    index++;
}

// Auto calculation
document.addEventListener('input', function(e) {

    if (e.target.classList.contains('qty') || e.target.classList.contains('price')) {

        const row = e.target.closest('.item-row');

        const qty = row.querySelector('.qty').value || 0;
        const price = row.querySelector('.price').value || 0;

        const total = qty * price;

        row.querySelector('.total').value = total.toFixed(2);

        updateGrandTotal();
    }
});

function updateGrandTotal() {
    let grandTotal = 0;

    document.querySelectorAll('.total').forEach(el => {
        grandTotal += parseFloat(el.value) || 0;
    });

    document.getElementById('grand-total').innerText =
        '₹' + grandTotal.toFixed(2);
}
</script>