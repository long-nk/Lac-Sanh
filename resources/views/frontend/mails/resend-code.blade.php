<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gửi lại mã xác nhận</title>
    <style>

        a {
            font-family: "Montserrat", sans-serif !important;
            font-size: 14px !important;
            color: #7d7d7d !important;
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
<body style="font-family:Arial, sans-serif; margin:0; padding:0; background-color:#2d3748;">

<table class="main-wrapper" width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0; background-color:#2d3748;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:6px; overflow:hidden;">
                <tr>
                    <td>
                        <img src="{{asset('images/logo.png')}}" alt="Logo top" class="logo-top">
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px;font-size:16px; line-height:1.6;">
                        <p style="margin: 0px; color:#1e1e1e; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Xin chào <strong>{{@$data['username']}}</strong>,</p>
                        <p style="margin: 0px; color:#1e1e1e; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Yêu cầu gửi lại mã xác nhận của quý khách đã được thực hiện</p><br/>
                        <p style="margin: 0px; color:#1e1e1e; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Mã xác thực mới:</p>

                        <div style="margin:20px 0; background:#f9f9f9; padding:15px; text-align:center; font-size:32px; border-radius:4px; color:#111111; font-weight:400;">
                            {{@$data['verify_code']}}
                            <p style="margin-top:8px; font-size:14px; color:#757575; font-family: 'Montserrat', Arial, sans-serif;">
                                (Mã có hiệu lực trong vòng 2 phút)
                            </p>
                        </div>

                        <p style="color:#1e1e1e; font-size:16px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">Trân trọng,<br>{{$pageInfo->name}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="background-color:#f3f4f6; padding:15px; text-align:center; font-size:12px; color:#666666;">
                        <p style="color:#1e1e1e; font-size:14px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">© 2025 - {{$pageInfo->name}}</p>
                        <p style="margin:5px 0;">
                            <span style="margin: 0 16px;color: #7d7d7d !important">{{route('home')}}</span> <span style="color: #7d7d7d !important">•</span>
                            <span style="margin: 0 16px; color: #7d7d7d;"><a href="tel:{{ $pageInfo->phone_footer }}" target="_blank">{{ $pageInfo->phone_footer }}</a></span> <span style="color: #7d7d7d;">•</span>
                            <span style="margin: 0 16px;color: #7d7d7d !important">{{$pageInfo->email}}</span>
                        </p>
                        <p style="color:#1e1e1e; font-size:14px; font-family: 'Montserrat', Arial, sans-serif; font-style:normal;">
                            <a href="{{ $pageInfo->tiktok ?? '#' }}" style="margin:0 5px; text-decoration:none; color:#111111;">
                                <img src="{{asset('images/tiktok.png')}}" width="32" height="32" alt="Logo tiktok">
                            </a>
                            <a href="{{ $pageInfo->facebook ?? '#' }}" style="margin:0 5px; text-decoration:none; color:#1877f2;">
                                <img src="{{asset('images/facebook.png')}}" width="32" height="32" alt="Logo facebook">
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
