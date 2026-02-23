<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsletter->subject }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
        }

        .wrapper {
            width: 100%;
            background-color: #f4f6f9;
            padding: 20px 0;
            display: table;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .header {
            padding: 30px 20px;
            text-align: center;
            background-color: #ffffff;
            border-bottom: 2px solid #f0f2f5;
        }

        .header img {
            max-height: 50px;
            max-width: 200px;
        }

        .content {
            padding: 30px;
            line-height: 1.6;
            color: #333333;
            font-size: 16px;
        }

        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .footer {
            padding: 20px;
            text-align: center;
            background-color: #f8f9fa;
            color: #777777;
            font-size: 13px;
        }

        .footer a {
            color: #696cff;
            text-decoration: none;
        }

        .social-links {
            margin: 15px 0;
        }

        .social-links a {
            margin: 0 5px;
            display: inline-block;
        }

        .unsubscribe {
            margin-top: 15px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header -->
            <div class="header">
                @php
                    $logo = App\Models\Setting::get('site_logo') ?? asset('assets/img/logo.png');
                    $companyName = App\Models\Setting::get('site_name') ?? config('app.name');
                @endphp
                <h2>{{ $companyName }}</h2>
            </div>

            <!-- Content -->
            <div class="content">
                {!! current(explode('</body>', end(explode('<body>', $newsletter->content)))) ?: $newsletter->content !!}
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
                <div class="unsubscribe">
                    <p>You received this email because you are subscribed to our newsletter.</p>
                    <p><a href="{{ $unsubscribeLink }}">Click here to unsubscribe</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>