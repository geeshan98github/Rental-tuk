<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TukTuk - Reset Password</title>
    <style type="text/css">
        /* Responsive Styles */
        @media screen and (max-width: 600px) {
            .content {
                width: 100% !important;
                max-width: 100% !important;
            }

            .logo-container img {
                max-width: 120px !important;
            }

            .code-box {
                font-size: 28px !important;
                padding: 15px !important;
            }

            .button-link {
                padding: 12px 20px !important;
                font-size: 15px !important;
            }
        }

        @media screen and (max-width: 400px) {
            .footer-links span {
                display: block !important;
                margin-bottom: 5px !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Poppins', Arial, sans-serif;">
    <div
        style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
        Your TukTuk Reset Password Link
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table class="content" border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); max-width: 600px;">
                    {{-- <tr>
            <td align="center" class="logo-container" style="padding: 30px 20px 20px 20px; border-bottom: 1px solid #eeeeee;">
              <a href="{{$baseUrl}}" target="_blank">
                <img src="{{ $baseUrl }}/public/frontend/images/logo.png" alt="TukTuk Logo" width="150" style="display: block; height: auto;" />
              </a>
            </td>
          </tr> --}}

                    <tr>
                        <td style="padding: 30px 30px 20px 30px; color: #2B2B2B; font-size: 16px; line-height: 1.6;">
                            {{-- <h1
                                style="font-family: 'Poppins', Arial, sans-serif; color: #2B2B2B; font-size: 24px; margin: 0 0 20px 0; font-weight: 700;">
                                Click the link below to reset your password</h1> --}}
                            <p style="margin: 0 0 15px 0;">Hi {{ $data->first_name }},</p>
                            <p>You are receiving this email because we received a password reset
                                request for your account. </p>
                            <p>If you did not request a password reset, please ignore this email.
                            </p>
                            <p>To reset your password, click the following link:</p>
                            <p> <a href="{{ $resetLink }}">{{ $resetLink }}</a></p>
                            <p style="margin: 0;">Thanks,<br />The TukTuk Team</p>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding: 20px 30px; background-color: #003525; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; text-align: center; color: #F8F8F8; font-size: 12px;">
                            <p style="margin: 0 0 5px 0;">&copy; 2024-2025 TukTuk. All rights reserved.</p>
                            <p style="margin: 0 0 5px 0;" class="footer-links">
                                <a href="YOUR_WEBSITE_URL/privacy" target="_blank"
                                    style="color: #FCEE29; text-decoration: none;">Privacy Policy</a>
                                <span style="color: #FCEE29; margin: 0 5px;">|</span>
                                <a href="YOUR_WEBSITE_URL/terms" target="_blank"
                                    style="color: #FCEE29; text-decoration: none;">Terms of Service</a>
                                <span style="color: #FCEE29; margin: 0 5px;">|</span>
                                <a href="YOUR_WEBSITE_URL/contact" target="_blank"
                                    style="color: #FCEE29; text-decoration: none;">Contact Us</a>
                            </p>
                            <p style="margin:0;">123 TukTuk Lane, Colombo, Sri Lanka</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
