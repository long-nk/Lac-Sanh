<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{{ $pageInfo->name }} - Đăng ký tài khoản thành công</title>
    <style>
        p a {
            font-family: "Montserrat", sans-serif !important;
            font-size: 14px !important;
            color: #7d7d7d !important;
            text-decoration: none;
        }

        strong a {
            color: #1e1e1e !important;
            text-decoration: none;
        }

        .im {
            font-family: "Montserrat", sans-serif !important;
            color: #1e1e1e !important;
        }

        @media only screen and (max-width: 600px) {
            .main-wrapper {
                background-color: #f8fafd !important;
                padding-top: 0px !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#2d3748; font-family:Arial, sans-serif;">

<table class="main-wrapper" width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0; background-color:#2d3748;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:6px; overflow:hidden;">

                <!-- Header -->
                <tr>
                    <td align="center" >
                        <img src="{{ asset('images/logo.png') }}" alt="Logo top" style="margin-top: 25px; max-width:100%; height:auto;">
                    </td>
                </tr>

                <!-- Image Success -->
{{--                <tr>--}}
{{--                    <td align="center" style="padding-top: 32px">--}}
{{--                        <img src="{{ asset('images/success.png') }}" alt="Image success" style="max-width:100%; height:auto;">--}}
{{--                    </td>--}}
{{--                </tr>--}}

                <!-- Main Content -->
                <tr>
                    <td style="padding-bottom: 30px; padding-left: 30px; padding-right: 30px; padding-top: 0px; color:#1e1e1e; font-family: 'Montserrat', Arial, sans-serif; font-size:16px; line-height:1.6;">
                        <h1 style="margin-bottom:10px; text-align:center; font-size:22px; color:#1e1e1e; font-weight:700;">Đặt lại mật khẩu thành công</h1>
                        <p style="margin: 0px; text-align:center; color:#1e1e1e; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Vui lòng đăng nhập bằng mật khẩu mới</p>

                        <!-- Account Info -->
                        <div style="margin:20px 0; background:#f9f9f9; padding:15px; text-align:left; font-size:14px; border-radius:4px; color:#111111; font-weight:400; border:1px solid #e5e7eb;">
                            <p style="margin: 0px; color:#1e1e1e; font-size:16px; font-weight:700; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Thông tin tài khoản</p>
                            <ul style="margin: 12px 0px; font-weight:400; padding: 0px 25px;">
                                <li style="margin: 12px 0px; color:#1e1e1e; font-weight:400; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Tên đăng nhập: <strong style="color:#1e1e1e !important; font-weight:700;">{{ @$data['email'] }}</strong></li>
                                <li style="margin: 12px 0px; color:#1e1e1e; font-weight:400; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Mật khẩu: <strong style="color:#1e1e1e; font-weight:700;">{!! @$data['password'] !!}</strong></li>
                            </ul>
                        </div>

                        <!-- Button -->
{{--                        <div style="text-align:center; margin-bottom:30px;">--}}
{{--                            <a href="{{ route('accounts.login') }}" style="background: var(--L2, linear-gradient(90deg, #1a3a75 0%, #526b97 100%)); color:#ffffff; padding:10px 45px; text-decoration:none; font-size:16px; font-weight: 600; border-radius:8px; display:inline-block;">--}}
{{--                                Đăng nhập--}}
{{--                            </a>--}}
{{--                        </div>--}}

                        <p style="margin: 0px; color:#1e1e1e; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Trân trọng,<br>{{ $pageInfo->name }}</p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color:#f3f4f6; padding:15px; text-align:center; font-size:12px; color:#666666;">
                        <p style="margin: 0px; color:#1e1e1e; font-size:14px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">© 2025 - {{ $pageInfo->name }}</p>
                        <p style="margin:5px 0;">
                            <span style="margin: 0 16px; color: #7d7d7d;">{{route('home')}}</span> <span style="color: #7d7d7d;">•</span>
                            <span style="margin: 0 16px; color: #7d7d7d;"><a href="tel:{{ $pageInfo->phone_footer }}" target="_blank">{{ $pageInfo->phone_footer }}</a></span> <span style="color: #7d7d7d;">•</span>
                            <span style="margin: 0 16px; color: #7d7d7d;">{{ $pageInfo->email }}</span>
                        </p>
                        <p>
                            <a href="{{ $pageInfo->tiktok ?? '#' }}" style="margin:0 5px;">
                                <img src="{{ asset('images/tiktok.png') }}" width="32" height="32" alt="Tiktok">
                            </a>
                            <a href="{{ $pageInfo->facebook ?? '#' }}" style="margin:0 5px;">
                                <img src="{{ asset('images/facebook.png') }}" width="32" height="32" alt="Facebook">
                            </a>
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
