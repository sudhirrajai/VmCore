<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Thank you for your message</title>
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
            background: linear-gradient(135deg, #6366f1, #4f46e5);
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

        .quote {
            background-color: #f9fafb;
            border-left: 4px solid #6366f1;
            padding: 15px 20px;
            font-style: italic;
            color: #4b5563;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
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
            <h1>Message Received</h1>
        </div>
        <div class="content">
            <h2>Hi {{ $submission->name }},</h2>
            <p>Thank you for getting in touch with us! This is an automated reply to let you know that we've received
                your message.</p>
            <p>Our team will review your inquiry and get back to you as soon as possible. For your records, here is a
                copy of your message:</p>

            <div class="quote">
                <strong>Subject:</strong> {{ $submission->subject }}<br><br>
                {!! nl2br(e($submission->message)) !!}
            </div>

            <p style="margin-top: 30px;">Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        <div class="footer">
            <p>This is an automated response, please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>