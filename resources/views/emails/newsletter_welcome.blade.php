<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome to Our Newsletter</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            padding: 40px 30px;
            line-height: 1.6;
        }

        .content h2 {
            color: #1f2937;
            margin-top: 0;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }

        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Subscription Confirmed! 🎉</h1>
        </div>
        <div class="content">
            <h2>Hello!</h2>
            <p>Thank you for subscribing to our newsletter with the email <strong>{{ $subscriberEmail }}</strong>.</p>
            <p>We're thrilled to have you on board. You'll now be among the first to receive our latest news, exclusive
                updates, and insights directly in your inbox.</p>
            <p>Stay tuned for our upcoming content. If you have any questions or just want to say hi, feel free to reply
                to this email!</p>

            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="btn">Visit Our Website</a>
            </div>

            <p style="margin-top: 30px;">Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        <div class="footer">
            <p>You received this email because you subscribed to our newsletter. If you didn't mean to subscribe, you
                can ignore this email.</p>
        </div>
    </div>
</body>

</html>