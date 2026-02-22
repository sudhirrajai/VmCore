<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
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
            background: linear-gradient(135deg, #1f2937, #111827);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .content {
            padding: 40px 30px;
            line-height: 1.6;
        }

        .detail-row {
            margin-bottom: 15px;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 15px;
        }

        .detail-label {
            font-weight: 600;
            color: #6b7280;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            display: block;
        }

        .detail-value {
            color: #1f2937;
            font-size: 15px;
        }

        .message-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 20px;
            border-radius: 8px;
            margin-top: 25px;
            color: #374151;
            white-space: pre-wrap;
        }

        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            display: inline-block;
            background-color: #6366f1;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Inquiry Received</h1>
        </div>
        <div class="content">
            <div class="detail-row">
                <span class="detail-label">Name</span>
                <div class="detail-value">{{ $submission->name }}</div>
            </div>

            <div class="detail-row">
                <span class="detail-label">Email Address</span>
                <div class="detail-value"><a href="mailto:{{ $submission->email }}"
                        style="color: #6366f1;">{{ $submission->email }}</a></div>
            </div>

            @if($submission->phone)
                <div class="detail-row">
                    <span class="detail-label">Phone</span>
                    <div class="detail-value">{{ $submission->phone }}</div>
                </div>
            @endif

            <div class="detail-row" style="border-bottom: none;">
                <span class="detail-label">Subject</span>
                <div class="detail-value font-weight-bold">{{ $submission->subject }}</div>
            </div>

            <div class="message-box">{{ $submission->message }}</div>

            <div style="text-align: center;">
                <a href="{{ url('admin/inquiries') }}" class="btn">View in Admin Panel</a>
            </div>
        </div>
        <div class="footer">
            <p>Sent from the contact form on {{ config('app.name') }}.</p>
        </div>
    </div>
</body>

</html>