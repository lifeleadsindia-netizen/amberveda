<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Verification OTP - AMBER VEDA</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e293b;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; padding: 30px 10px;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #10223d 0%, #17345b 100%); padding: 32px 20px; border-bottom: 3px solid #c9aa6f;">
                            <h1 style="margin: 0; color: #f7e2b7; font-size: 26px; font-weight: 800; letter-spacing: 1.5px; font-family: Georgia, serif;">AMBER VEDA</h1>
                            <p style="margin: 6px 0 0; color: #e2e8f0; font-size: 13px; letter-spacing: 0.5px;">Direct Seller Registration Verification</p>
                        </td>
                    </tr>
                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 36px 32px;">
                            <h2 style="margin: 0 0 16px; color: #0f172a; font-size: 20px; font-weight: 700;">Hello {{ $name ?? 'Direct Seller' }},</h2>
                            <p style="margin: 0 0 18px; color: #475569; font-size: 15px; line-height: 1.6;">
                                Thank you for registering with <strong>AMBER VEDA</strong>. To verify your email address and complete your Direct Seller account registration, please use the 6-digit verification code below:
                            </p>

                            <!-- OTP Box -->
                            <div style="background-color: #f8fafc; border: 2px dashed #c9aa6f; border-radius: 10px; padding: 20px; text-align: center; margin: 28px 0;">
                                <span style="display: block; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px;">Your Verification Code</span>
                                <span style="display: inline-block; font-size: 36px; font-weight: 900; color: #10223d; letter-spacing: 8px; font-family: monospace;">{{ $otp }}</span>
                                <span style="display: block; font-size: 12px; color: #94a3b8; margin-top: 8px;">Valid for 10 minutes</span>
                            </div>

                            <p style="margin: 0 0 12px; color: #475569; font-size: 14px; line-height: 1.6;">
                                Please enter this code on the registration verification screen to finalize your account creation.
                            </p>

                            <div style="background-color: #fef9c3; border-left: 4px solid #eab308; padding: 12px 16px; border-radius: 4px; margin: 24px 0 0;">
                                <p style="margin: 0; color: #854d0e; font-size: 13px; line-height: 1.5;">
                                    <strong>Security Notice:</strong> Never share this OTP with anyone. AMBER VEDA representatives will never ask for your verification code.
                                </p>
                            </div>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #f8fafc; padding: 22px 20px; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0; color: #64748b; font-size: 12px;">
                                &copy; {{ date('Y') }} AMBER VEDA. All rights reserved.
                            </p>
                            <p style="margin: 4px 0 0; color: #94a3b8; font-size: 11px;">
                                If you did not initiate this registration request, please safely ignore this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
