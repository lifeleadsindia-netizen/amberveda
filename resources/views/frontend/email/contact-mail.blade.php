<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Enquiry - AMBER VEDA</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAF7F0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #3A3A3A;
            -webkit-font-smoothing: antialiased;
        }
        .wrapper {
            width: 100%;
            background-color: #FAF7F0;
            padding: 40px 15px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #EAE3D2;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #1B4332;
            padding: 30px 40px;
            text-align: center;
            border-bottom: 3px solid #C9A84C;
        }
        .brand {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #FFFFFF;
            margin: 0;
            text-transform: uppercase;
        }
        .brand span {
            color: #E6C875;
        }
        .badge {
            display: inline-block;
            margin-top: 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            background-color: rgba(201, 168, 76, 0.2);
            color: #E6C875;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid rgba(201, 168, 76, 0.4);
        }
        .content {
            padding: 36px 40px;
        }
        .intro {
            font-size: 15px;
            color: #555555;
            margin: 0 0 24px 0;
            line-height: 1.6;
        }
        .field-group {
            margin-bottom: 18px;
            border-bottom: 1px solid #F0EAD6;
            padding-bottom: 14px;
        }
        .field-label {
            font-size: 11.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #8C7B5D;
            margin-bottom: 4px;
        }
        .field-value {
            font-size: 15px;
            color: #1A1A1A;
            font-weight: 500;
            word-break: break-word;
        }
        .field-value a {
            color: #1B4332;
            text-decoration: none;
        }
        .message-box {
            background-color: #FAF7F0;
            border-left: 3px solid #C9A84C;
            border-radius: 6px;
            padding: 16px 20px;
            margin-top: 8px;
            font-size: 14.5px;
            line-height: 1.6;
            color: #2D2D2D;
            white-space: pre-line;
        }
        .footer {
            background-color: #F8F5EE;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #777777;
            border-top: 1px solid #EAE3D2;
        }
        .footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="brand">AMBER<span>VEDA</span></div>
                <div class="badge">New Contact Enquiry</div>
            </div>

            <!-- Content -->
            <div class="content">
                <p class="intro">A new contact enquiry has been received from the website contact form. The details are provided below:</p>

                <!-- Name -->
                <div class="field-group">
                    <div class="field-label">Name</div>
                    <div class="field-value">{{ $name }}</div>
                </div>

                <!-- Email -->
                <div class="field-group">
                    <div class="field-label">Email Address</div>
                    <div class="field-value">
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </div>
                </div>

                <!-- Phone -->
                <div class="field-group">
                    <div class="field-label">Phone Number</div>
                    <div class="field-value">
                        <a href="tel:{{ $phone }}">{{ $phone }}</a>
                    </div>
                </div>

                <!-- Subject -->
                <div class="field-group">
                    <div class="field-label">Subject</div>
                    <div class="field-value">{{ $subject }}</div>
                </div>

                <!-- Message -->
                <div class="field-group" style="border-bottom: none; margin-bottom: 0; padding-bottom: 0;">
                    <div class="field-label">Message</div>
                    <div class="message-box">{!! nl2br(e($contactMessage ?? '')) !!}</div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p><strong>AMBER VEDA Wellness Pvt Ltd</strong></p>
                <p>This email was automatically generated from the website contact form.</p>
            </div>
        </div>
    </div>
</body>
</html>
