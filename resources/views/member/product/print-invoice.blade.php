<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - #{{ $inv_data['invoice_no'] ?? 'INV' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.5;
            padding: 30px 15px;
            -webkit-font-smoothing: antialiased;
        }

        .top-action-bar {
            max-width: 920px;
            margin: 0 auto 24px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .print-instruction {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-print-invoice {
            background-color: #007b75;
            color: #ffffff;
            border: none;
            padding: 9px 20px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .btn-print-invoice:hover {
            background-color: #00635e;
        }

        .btn-close-window {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
            padding: 9px 20px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .btn-close-window:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
        }

        .invoice-card {
            max-width: 920px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 48px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .brand-title {
            color: #007b75;
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .company-details {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            max-width: 420px;
        }

        .invoice-title-block {
            text-align: right;
        }

        .invoice-main-heading {
            font-size: 34px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .meta-list {
            list-style: none;
            font-size: 13px;
            line-height: 1.65;
            color: #64748b;
        }

        .meta-list li {
            display: flex;
            justify-content: flex-end;
            gap: 6px;
        }

        .meta-list .label {
            color: #64748b;
        }

        .meta-list .value {
            color: #0f172a;
            font-weight: 600;
        }

        .divider {
            border: 0;
            border-top: 1px solid #e2e8f0;
            margin: 24px 0;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .info-block {
            width: 48%;
        }

        .info-block.right-align {
            text-align: right;
        }

        .section-label {
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .member-name {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .info-details {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
        }

        .info-details .val {
            color: #334155;
            font-weight: 600;
        }

        .shipping-address {
            font-size: 13px;
            color: #334155;
            line-height: 1.6;
        }

        .table-container {
            margin-bottom: 28px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table th {
            background-color: #f8fafc;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 16px;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .items-table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            vertical-align: middle;
        }

        .summary-bottom-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 36px;
            gap: 20px;
        }

        .note-card {
            max-width: 480px;
            font-size: 12px;
            color: #64748b;
            background: #f8fafc;
            padding: 14px 18px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            line-height: 1.6;
        }

        .totals-container {
            width: 300px;
            margin-left: auto;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            font-size: 14px;
        }

        .totals-row .label {
            color: #64748b;
        }

        .totals-row .val-sub {
            color: #0f172a;
            font-weight: 600;
        }

        .totals-row .val-discount {
            color: #ef4444;
            font-weight: 600;
        }

        .totals-divider {
            border: 0;
            border-top: 1px solid #e2e8f0;
            margin: 10px 0;
        }

        .totals-row.grand-total .label {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        .totals-row.grand-total .val-grand {
            font-size: 20px;
            font-weight: 700;
            color: #007b75;
        }

        .invoice-footer {
            border-top: 1px solid #e2e8f0;
            padding-top: 24px;
            text-align: center;
        }

        .thank-you-title {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 4px;
        }

        .footer-note {
            font-size: 12px;
            color: #64748b;
        }

        @media print {
            body {
                background-color: #ffffff !important;
                padding: 0 !important;
            }

            .top-action-bar {
                display: none !important;
            }

            .invoice-card {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>

<body>

    <div class="top-action-bar">
        <div class="print-instruction">
            Press the Print button or Ctrl+P to generate PDF/Paper printout.
        </div>
        <div class="action-buttons">
            <button onclick="window.print()" class="btn-print-invoice">Print Invoice</button>
            <button onclick="window.history.length > 1 ? history.back() : window.close()" class="btn-close-window">Close
                Window</button>
        </div>
    </div>

    <div class="invoice-card">
        <!-- Header -->
        <div class="invoice-header">
            <div>
                <h1 class="brand-title">{{ config('detailsApp.name') }}</h1>
                <div class="company-details">
                    <strong>{{ config('detailsApp.name') }}</strong><br>
                    Premium commerce invoice<br>
                    Issued for order fulfillment<br>
                    Support: {{ config('detailsApp.support') }}<br>
                    GSTIN: 09ABFCA7551D1ZP
                </div>
            </div>
            <div class="invoice-title-block">
                <h2 class="invoice-main-heading">INVOICE</h2>
                <ul class="meta-list">
                    <li>
                        <span class="label">Invoice No:</span>
                        <span class="value">#{{ $inv_data['invoice_no'] }}</span>
                    </li>
                    <li>
                        <span class="label">Invoice Date:</span>
                        <span class="value">{{ date('d M, Y', strtotime($inv_data['created_at'])) }}</span>
                    </li>
                    <li>
                        <span class="label">Order ID:</span>
                        <span class="value">{{ $ordData[0]['order_id'] }}</span>
                    </li>
                    <li>
                        <span class="label">Payment Status:</span>
                        <span class="value">{{ $inv_data['payment_status'] ?? 'Paid' }}</span>
                    </li>
                    <li>
                        <span class="label">Payment Method:</span>
                        <span class="value">{{ $inv_data['payment_method'] ?? 'Online Transfer' }}</span>
                    </li>
                    <li>
                        <span class="label">Due Date:</span>
                        <span
                            class="value">{{ $inv_data['due_date'] ?? date('d M, Y', strtotime($inv_data['created_at'])) }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="divider">

        <!-- Customer Info Section -->
        <div class="info-section">
            <div class="info-block">
                <div class="section-label">BILLED TO (MEMBER DETAILS):</div>
                <div class="member-name">{{ $data['name'] }}</div>
                <div class="info-details">
                    <div>Member ID: <span class="val">{{ $data['memberid'] }}</span></div>
                    <div>Address: <span class="val">{{ $data['address'] }}</span></div>
                    <div>Email: <span class="val">{{ $data['email'] }}</span></div>
                    <div>Mobile: <span class="val">{{ $data['mobile'] }}</span></div>
                </div>
            </div>
            <div class="info-block right-align">
                <div class="section-label">PAYMENT & SHIPPING SUMMARY:</div>
                <div class="shipping-address">
                    <div><strong>Status:</strong> {{ $inv_data['payment_status'] ?? 'Paid' }}</div>
                    <div><strong>Method:</strong> {{ $inv_data['payment_method'] ?? 'Online Transfer' }}</div>
                    <div style="margin-top: 6px;">
                        <strong>Shipping Address:</strong><br>
                        {{ $data['address'] }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="table-container">
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: left;">S NO.</th>
                        <th style="text-align: left;">ORDER ID</th>
                        <th style="text-align: left;">CATEGORY</th>
                        <th style="text-align: left;">PRODUCT NAME</th>
                        <th style="text-align: center;">QUANTITY</th>
                        <th style="text-align: right;">AMOUNT</th>
                        <th style="text-align: right;">GST</th>
                        <th style="text-align: right;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($ordData as $item)
                        <tr>
                            <td style="color: #64748b; font-size: 13px;">{{ $i }}</td>
                            <td style="font-weight: 500; color: #0f172a;">{{ $item['order_id'] }}</td>
                            <td style="color: #64748b; font-size: 13px;">{{ categoryName($item['cat_id']) }}</td>
                            <td style="font-weight: 600; color: #0f172a;">
                                {{ $item->product?->product ?? 'Product not found' }}</td>
                            <td style="text-align: center; font-weight: 600; color: #0f172a;">{{ $item['quantity'] }}
                            </td>
                            <td style="text-align: right; color: #0f172a;">&#8377;
                                {{ number_format($item['price'], 2) }}</td>
                            <td style="text-align: right; color: #0f172a;">&#8377;
                                {{ number_format($item['gst_amount'], 2) }}</td>
                            <td style="text-align: right; font-weight: 700; color: #0f172a;">&#8377;
                                {{ number_format($item['total_amount'], 2) }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary & Totals -->
        <div class="summary-bottom-wrapper">
            <div class="note-card">
                Amounts are shown in INR. This invoice includes GST as noted above and is generated digitally for your
                records.
            </div>
            <div class="totals-container">
                <div class="totals-row">
                    <span class="label">Sub Total:</span>
                    <span class="val-sub">&#8377; {{ number_format($invoiceSubtotal, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span class="label">GST Amount:</span>
                    <span class="val-discount">&#8377; {{ number_format($totalGst, 2) }}</span>
                </div>
                <hr class="totals-divider">
                <div class="totals-row grand-total">
                    <span class="label">Total:</span>
                    <span class="val-grand">&#8377; {{ number_format($invoiceTotal, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="thank-you-title">Thank you for your business!</div>
            <div class="footer-note">This is a computer-generated document. No signature is required. For returns or
                support, please contact the support desk.</div>
        </div>
    </div>

</body>

</html>
