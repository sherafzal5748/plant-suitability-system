<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: 'Segoe UI', Arial, sans-serif;">
    {{-- sending 4-digit code to user for password reset"forgot password" --}}

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f6f8; padding: 40px 15px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 480px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 28px 30px 16px 30px; border-bottom: 1px solid #f1f5f9;">
                            <h1 style="margin: 0; color: #0f172a; font-size: 20px; font-weight: 700; line-height: 1.3;">
                                {{ $subject }}
                            </h1>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td align="center" style="padding: 28px 30px;">
                            <p style="margin: 0 0 24px 0; color: #475569; font-size: 15px; line-height: 1.6; text-align: center;">
                                {{ $mailmessage }}
                            </p>

                            <!-- OTP Code Box -->
                            <div style="background-color: #f8fafc; border: 1px dashed #3b82f6; border-radius: 6px; padding: 16px 24px; display: inline-block; margin-bottom: 24px;">
                                <span style="font-family: 'Courier New', Courier, monospace; font-size: 32px; font-weight: 700; color: #1d4ed8; letter-spacing: 10px;">
                                    {{ $fourDigitNumber }}
                                </span>
                            </div>

                            <p style="margin: 0; color: #94a3b8; font-size: 13px; line-height: 1.5; text-align: center;">
                                This code will expire in 10 minutes. If you did not request a password reset, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #f8fafc; padding: 16px 30px; border-top: 1px solid #f1f5f9;">
                            <p style="margin: 0; color: #94a3b8; font-size: 12px;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
