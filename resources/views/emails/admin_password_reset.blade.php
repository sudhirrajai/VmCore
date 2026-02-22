<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reset Your Admin Password</title>
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

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
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

        .footer a {
            color: #6366f1;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>We received a request to reset the password associated with this email address for your Admin Control
                Panel.</p>
            <p>If you didn't make this request, you can safely ignore this email. Otherwise, you can reset your password
                using the link below (valid for 60 minutes):</p>

            <div style="text-align: center;">
                <a href="{{ url('admin/reset-password/' . $token . '?email=' . urlencode($email)) }}" class="btn">Reset
                    My Password</a>
            </div>

            <p style="margin-top: 30px;">
                If you're having trouble clicking the "Reset My Password" button, copy and paste the URL below into your
                web browser:
                <br>
                <a href="{{ url('admin/reset-password/' . $token . '?email=' . urlencode($email)) }}"
                    style="word-break: break-all; color: #6366f1;">
                    {{ url('admin/reset-password/' . $token . '?email=' . urlencode($email)) }}
                </a>
            </p>

            <p>Best regards,<br>{{ config('app.name') }} Security Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply.</p>
        </div>
    </div>
</body>

</html>