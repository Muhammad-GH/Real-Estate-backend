
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Flipkoti</title>
</head>
<body style="margin:0;">
    <div style="background: #f5f5f5;width: 100%;padding: 80px 0; font-family: arial;">
        <div style="margin: 0 auto; max-width: 640px;">
            <!-- <div style=" margin: 0 0 30px; display: inline-block; width: 100%;">
                <div style="float: left;">
                    <img src="images/logo.png">
                </div>
                <div style="float: right;">
                    <img style=" width: 34px; border-radius: 50%; height: 34px; float: left;margin-right: 15px;" src="images/avatar1.jpg">
                    <div style="float: left;">
                        <p style="margin: 0 0 2px; font-size: 13px; color: #565757;">Welcome user</p>
                        <p style="margin: 0;font-size: 14px;">Nihshant Gupta</p>
                    </div>
                </div>
            </div> -->
            <!-- <div style="background: #111111 url(images/email-header-bg.jpg); text-align: left; padding: 80px 0; color: #fff;">
                <h3 style="color: #fff; font-weight: 400; font-size: 20px; margin: 0 0 12px;">Hello {{ $first_name }} {{ $last_name }},</h3>
                <!-- <p style="margin: 0; font-size: 16px;">A space for realestate professional</p> -- >
            </div> -->
            <div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">
                <h1 style=" margin: 0 0 10px; font-size: 24px;">@lang('pms.reset.mail.dear') {{ $first_name }}</h1>
                <p style="margin: 0 0 15px; line-height: 1.6;">@lang('pms.reset.mail.link_text')</p>
                <a style="background: #2a72cc; color: #fff; text-decoration: none; padding: 15px 30px; display: inline-block; border-radius: 7px; font-weight: 600; margin-top: 20px;" href="{{ route('frontend.pms.password.set', $reset_token ) }}" >@lang('pms.reset.mail.confirm_account')</a>
            </div>
            <div style=" margin-top: 30px; text-align: center; color: #777; font-size: 13px;">
                <!-- <p style="margin: 0 0 7px;">Unsubscribe</p> -->
                <p style="margin: 0 0 7px;" >@lang('pms.mail.mail_to', ['info_mail' => 'info@flipkoti.fi'])</p>
                <p style="margin: 0 0 7px;">@lang('pms.mail.follow_us') </p>
                <div style=" margin-top: 15px;">
                    <a style="margin:0 3px; width: 20px; height: 20px; background: url(images/social-icons.png) no-repeat scroll 0 0; display: inline-block;" href="#"></a>
                    <a style="margin:0 3px; width: 20px; height: 20px; background: url(images/social-icons.png) no-repeat scroll -30px 0; display: inline-block;" href="#"></a>
                    <a style="margin:0 3px; width: 20px; height: 20px; background: url(images/social-icons.png) no-repeat scroll -60px 0; display: inline-block;" href="#"></a>
                    <a style="margin:0 3px; width: 20px; height: 20px; background: url(images/social-icons.png) no-repeat scroll -90px 0; display: inline-block;" href="#"></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>