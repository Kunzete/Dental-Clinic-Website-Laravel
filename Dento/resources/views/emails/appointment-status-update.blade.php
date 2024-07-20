<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Status Update</title>
    <style>
        /* Reset styles for email */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            font-size: 14px;
            background-color: #f4f4f4;
            color: #333333;
        }
        img{
            max-width: 100%;
            object-fit:contain;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #000000;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
        }
        .signature {
            margin-top: 20px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co/dD8LN4v/logo.png" alt="logo">
        </div>
        <div class="content">
            <p>Hello {{ $appointment->patient_name }},</p>

            <p>Your appointment status is
            @if ($appointment->status == "pending")
            <span style="color: rgb(69, 107, 211)">
                <strong>
                    {{ Str::upper($appointment->status) }}
                </strong>
            </span>
            @elseif ($appointment->status == "confirmed")
            <span style="color: rgb(69, 211, 119)">
                <strong>
                    {{ Str::upper($appointment->status) }}
                </strong>
            </span>
            @elseif ($appointment->status == "cancelled")
            <span style="color: rgb(211, 69, 69)">
                <strong>
                    {{ Str::upper($appointment->status) }}
                </strong>
            </span>
            @endif
            .</p>
            <p>Please find the details below:</p>

            <ul>
                <li><strong>Doctor:</strong> {{Auth::guard('doctor')->user()->name}}</li>
                <li><strong>Time:</strong> {{ $appointment->appointment_time }}</li>
                <li><strong>Day:</strong> {{ $appointment->appointment_day }}</li>
            </ul>

            <p>If you have any questions or concerns, please don't hesitate to contact us.</p>

            <p>Thank you for your cooperation.</p>

            <p>Best regards,<br>{{ Auth::guard('doctor')->user()->name }}</p>
        </div>
        <div class="signature">
            <hr>
            <p><strong>Dento</strong><br>
            Sialkot, Pakistan<br>
            Phone: 111 222 333<br>
            Email: <a href="mailto:dentositeclinic@gmail.com">dentositeclinic@gmail.com</a></p>
        </div>
    </div>
</body>
</html>
