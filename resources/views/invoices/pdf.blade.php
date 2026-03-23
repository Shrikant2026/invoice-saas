<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice PDF</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            border-bottom: 2px solid #eee;
            margin-bottom: 20px;
            padding-bottom: 15px;
        }

        .top {
            display: flex;
            justify-content: space-between;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #2d6cdf;
        }

        .company-details {
            font-size: 12px;
            color: #555;
            margin-top: 5px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h2 {
            margin: 0;
        }

        .client-box {
            margin-top: 20px;
        }

        .client-box p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th {
            background: #f5f5f5;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            margin-top: 20px;
            text-align: right;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #888;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <div class="header">

        <div class="top">

            <!-- Logo + Company -->
            <div>
                <div class="logo">
                    Invoice Builder SaaS
                </div>

                <div class="company-details">
                    12A block Old town road street,<br>
                    Birmingham, London<br>
                    Email / Phone: *************
                </div>
            </div>

            <!-- Invoice Info -->
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <p>{{ $invoice->invoice_number }}</p>
            </div>

        </div>

    </div>

    <!-- Client -->
    <div class="client-box">
        <p><strong>Billed To:</strong></p>
        <p>{{ $invoice->client->name }}</p>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price, 2) }}</td>
                <td class="text-right">
                    ₹{{ number_format($item->total, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="total-box">
        <p class="total">
            Total: ₹{{ number_format($invoice->total, 2) }}
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        Thank you for your business 🙏
    </div>

</div>

</body>
</html>