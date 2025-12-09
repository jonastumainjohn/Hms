<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        p {
            color: #555;
            line-height: 1.5;
            padding: 0 20px;
        }

        .footer {
            text-align: center;
            font-size: 0.8em;
            color: #777;
            padding: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 22px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Password Change Notification</h1>
        </div>
        <p>Hi <strong>{{$user->name}}</strong>,</p>
        <p>Your password has been changed successfully. If you did not make this change, please contact support immediately.</p>
        <p><strong>Username/Email:</strong> {{$user->email}} or {{$user->username}}</p>
        <p><strong>New Password:</strong> {{$new_password}}</p>
        <p>Thank you for using our service!</p>
    </div>

    <div class="footer">
        <p>&copy; {{date('Y')}} larablog.com. All rights reserved.</p>
    </div>

</body>

</html>
