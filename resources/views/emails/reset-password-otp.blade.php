<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Reset Password</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-wrapper {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-body {
            padding: 40px 30px;
        }
        .otp-code {
            background-color: #fce7f3;
            border: 2px dashed #ec4899;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code .code {
            font-size: 32px;
            font-weight: bold;
            color: #ec4899;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .message {
            color: #666666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 14px;
            color: #856404;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #e5e7eb;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #ec4899;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-wrapper">
            <div class="email-header">
                <h1>Reset Password</h1>
            </div>
            <div class="email-body">
                <p class="message">Halo!</p>
                <p class="message">Kami menerima permintaan untuk mereset password akun Anda di <strong>SMKN 4 BOGOR</strong>. Gunakan kode OTP di bawah ini untuk melanjutkan proses reset password.</p>
                
                <div class="otp-code">
                    <div class="code">{{ $otp }}</div>
                </div>
                
                <p class="message">Kode ini akan kedaluwarsa dalam <strong>10 menit</strong>. Jangan bagikan kode ini kepada siapa pun.</p>
                
                <div class="warning">
                    <strong>⚠️ Peringatan:</strong> Jika Anda tidak meminta reset password, abaikan email ini atau hubungi admin segera jika Anda merasa ada aktivitas mencurigakan pada akun Anda.
                </div>
            </div>
            <div class="footer">
                <p>Email ini dikirim secara otomatis. Mohon jangan membalas email ini.</p>
                <p>&copy; {{ date('Y') }} SMKN 4 BOGOR. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>

