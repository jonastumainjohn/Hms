<!DOCTYPE html>
<html>
<head>
    <title>Patient Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .header img {
            max-height: 80px;
        }
        .header h1 {
            margin: 10px 0;
            color: #0073e6;
        }
        .content {
            margin: 20px 0;
        }
        .content p {
            margin: 10px 0;
        }
        .content ul {
            list-style: none;
            padding: 0;
        }
        .content ul li {
            margin: 5px 0;
            padding: 5px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .content ul li strong {
            color: #0073e6;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #666;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="{{asset('images/site/default-logo.jpg')}}" alt="{{ $hospitalName }} Logo"> 
            <h1>{{ $hospitalName }}</h1>
            <p>{{ $companyLocation }}</p> 
        </div>

        <!-- Content -->
        <div class="content">
            <p>Dear <strong>{{ $patient->first_name }} {{ $patient->last_name }}</strong>,</p>
            <p>Thank you for registering with us. Below are your registration details:</p>
            <ul>
                <li><strong>MRN Number:</strong> {{ $patient->mrn_number }}</li>
                <li><strong>Email:</strong> {{ $patient->email }}</li>
                <li><strong>Phone Number:</strong> {{ $patient->phone_number }}</li>
                <li><strong>Registration Fee Paid:</strong> {{ number_format($patient->registration_fee, 2) }} Tshs</li>
                <li><strong>Time of Registration:</strong> {{ $time }}</li>
            </ul>
            <p>If you have any questions, feel free to contact us at <a href="mailto:jonastumain6@gmail.com">info@alloshospital.com</a> or call (123) 456-7890.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you,</p>
            <p><strong>{{ $hospitalName }} Team</strong></p>
            <p>{{ $companyLocation }}</p>
        </div>
    </div>
</body>
</html>
