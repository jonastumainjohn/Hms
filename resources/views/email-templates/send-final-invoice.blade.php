<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription and Invoice Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1, h3 {
            color: #1a73e8;
            font-weight: bold;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 24px;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        p {
            line-height: 1.6;
            font-size: 16px;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-size: 18px;
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td {
            font-size: 16px;
            color: #333;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #2e7d32;
        }

        .info {
            margin-top: 20px;
            font-size: 16px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

        .footer a {
            color: #1a73e8;
            text-decoration: none;
        }

        /* Media Query for small devices */
        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            h3 {
                font-size: 20px;
            }

            p, td, th {
                font-size: 14px;
            }

            table th, table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $hospitalName }}</h1>
        <p>Dear {{ $patient->first_name }},</p>
        <p>Below are your prescription and invoice details:</p>

        <h3>Prescription Details:</h3>
        <p><strong>Doctor's Notes:</strong> {{ $prescription->description }}</p>
        <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($prescription->appointment_date)->format('l, d M Y h:i A') }}</p>

        <h3>Prescribed Items:</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Medical Name</th>  <!-- Added this column -->
                        <th>Item ID</th>
                        <th>Quantity</th>
                        <th>Price (Tsh)</th>
                        <th>Total (Tsh)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prescriptionItems as $item)
                    <tr>
                        <td>{{ $item->medicine->name ?? 'N/A' }}</td>  <!-- If the medicine relationship is set up -->
                        <td>{{ $item->medical_id }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h3>Total Price:</h3>
        <p class="total-price">{{ number_format($prescription->total_price, 2) }} Tsh</p>

        <div class="info">
            <p><strong>Issued on:</strong> {{ $time }}</p>
            <p><strong>Location:</strong> {{ $companyLocation }}</p>
        </div>

        <p>Thank you for trusting us for your healthcare needs.</p>

        <p>Sincerely, <br> {{ $hospitalName }}</p>

        <div class="footer">
            <p>If you have any questions, feel free to <a href="mailto:jonas@gmail.com">contact us</a>.</p>
        </div>
    </div>
</body>
</html>
