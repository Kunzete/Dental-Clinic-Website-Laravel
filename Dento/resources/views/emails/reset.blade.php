<!-- emails/reset.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .header a {
            color: #fff;
            text-decoration: none;
        }
        .content {
            padding: 20px;
        }
        .button {
            background-color: #337ab7;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #23527c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ env('APP_URL') }}">DentoSite</a>
        </div>
        <div class="content">
            <h2>Reset Your Password</h2>

            <p>We've received a request to reset your password. If you didn't make this request, please ignore this email.</p>

            <p>Copy and paste the following token:</p>
            <code>{{ $token }}</code>
            <p>Best regards,</p>
            <p>DentoSite</p>
        </div>
    </div>
</body>
</html>
