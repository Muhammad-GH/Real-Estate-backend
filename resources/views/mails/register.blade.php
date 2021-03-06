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
            <div style=" margin: 0 0 30px; display: inline-block; width: 100%;">
                <div style="float: left;">
                    <img class="navbar-brand-full" src="{{url('/img/frontend/logo-pro.png')}}" width="89" height="25" alt="Flipkoti">
                </div>
                <div style="float: right;">
                    {{-- <img style=" width: 34px; border-radius: 50%; height: 34px; float: left;margin-right: 15px;" src="images/avatar1.jpg"> --}}
                    <div style="float: left;">
                        <p style="margin: 0 0 2px; font-size: 13px; color: #565757;">Welcome user</p>
                        <p style="margin: 0;font-size: 14px;">{{ $name }}</p>
                    </div>
                </div>
            </div>
            <div style="background: #111111 url(images/email-header-bg.jpg); text-align: center; padding: 80px 0; color: #fff;">
                <h3 style=" font-weight: 400; font-size: 20px; margin: 0 0 12px;">Welcome to Flipkoti for Professional</h3>
                <p style="margin: 0; font-size: 16px;">A space for realestate professional</p>
            </div>
            <div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">
                <h1 style=" margin: 0 0 10px; font-size: 24px;">Dear Customer</h1>
                <p style="margin: 0 0 15px; line-height: 1.6;">Thanks for registering with us</p>
                <p style="margin: 0 0 15px; line-height: 1.6;"><?= htmlspecialchars_decode($intro) ?>, <a href="" style="color: #2a72cc; font-weight: 600;"><?= htmlspecialchars_decode($body) ?></a></p>
                <p style="margin: 0 0 15px; line-height: 1.6;"><?= htmlspecialchars_decode($end) ?></p>
                <a style="background: #2a72cc; color: #fff; text-decoration: none; padding: 15px 30px; display: inline-block; border-radius: 7px; font-weight: 600; margin-top: 20px;" href="">Confirm your account</a>
            </div>
            <div style=" margin-top: 30px; text-align: center; color: #777; font-size: 13px;">
                <p style="margin: 0 0 7px;">Unsubscribe</p>
                <p style="margin: 0 0 7px;" >write your query at: info@flipkoti.fi</p>
                <p style="margin: 0 0 7px;">Follow us on social media </p>
                <div style=" margin-top: 15px;">
                    <a style="`; height: 20px; background: url(images/social-icons.png) no-repeat scroll 0 0; display: inline-block;" href="#"></a>
                    <a style="margin:0 3px; width: 20px; height: 20px; background: url(images/social-icons.png) no-repeat scroll -30px 0; display: inline-block;" href="#"></a>
                    <a style="margin:0 3px; width: 20px; height: 20px; background: url(images/social-icons.png) no-repeat scroll -60px 0; display: inline-block;" href="#"></a>
                    <a style="margin:0 3px; width: 20px; height: 20px; background: url(images/social-icons.png) no-repeat scroll -90px 0; display: inline-block;" href="#"></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>