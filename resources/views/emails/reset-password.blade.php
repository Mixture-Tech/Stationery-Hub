<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7fa;
            color: #718096;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #f4f7fa;
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            height: 50px;
            width: auto;
        }
        .content {
            padding: 32px;
            text-align: left;
        }
        .content h1 {
            color: #3d4852;
            font-size: 24px;
            font-weight: bold;
            margin-top: 0;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 16px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2d3748;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
        }
        .subcopy {
            border-top: 1px solid #e8e5ef;
            margin-top: 25px;
            padding-top: 25px;
        }
        .subcopy p {
            font-size: 14px;
            color: #718096;
        }
        .subcopy a {
            color: #3869d4;
            word-break: break-all;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #b0adc5;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <table class="container" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="header">
                <a href="{{ config('app.url') }}">
                    <img src="{{ $logo }}" alt="Logo" />
                </a>
            </td>
        </tr>
        <tr>
            <td class="content">
                <h1>Xin chào!</h1>
                <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
                <p style="text-align: center;">
                    <a href="{{ $url }}" class="button">Đặt Lại Mật Khẩu</a>
                </p>
                <p>Liên kết đặt lại mật khẩu này sẽ hết hạn sau 60 phút.</p>
                <p>Nếu bạn không yêu cầu đặt lại mật khẩu, bạn không cần thực hiện thêm hành động nào.</p>
                <p>Trân trọng,<br>Đội ngũ Laravel</p>

                <div class="subcopy">
                    <p>
                        Nếu bạn gặp khó khăn khi nhấp vào nút "Đặt Lại Mật Khẩu", hãy sao chép và dán URL dưới đây vào trình duyệt web của bạn:<br>
                        <a href="{{ $url }}">{{ $url }}</a>
                    </p>
                </div>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>© 2025 Laravel. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>