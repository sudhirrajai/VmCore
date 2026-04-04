<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background: #f4f4f4; padding: 10px; border-bottom: 1px solid #ddd; margin-bottom: 20px; }
        .field { margin-bottom: 10px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>
        <div class="field"><span class="label">Name:</span> {{ $submission->name }}</div>
        <div class="field"><span class="label">Email:</span> {{ $submission->email }}</div>
        <div class="field"><span class="label">Phone:</span> {{ $submission->phone ?? 'N/A' }}</div>
        <div class="field"><span class="label">Subject:</span> {{ $submission->subject ?? 'N/A' }}</div>
        <div class="field">
            <span class="label">Message:</span><br>
            {{ $submission->message }}
        </div>
        <hr>
        <p>This message was sent from the contact form on {{ config('app.name') }}.</p>
    </div>
</body>
</html>