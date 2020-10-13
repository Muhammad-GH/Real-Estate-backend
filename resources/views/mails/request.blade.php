<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Flipkoti</title>
</head>

<body style="margin:0;">
    {{-- <div style="background: #f5f5f5;width: 100%;padding: 80px 0; font-family: arial;">
        <div style="margin: 0 auto; max-width: 640px;">
            {!! $intro !!} 
        </div>
    </div> --}}
    <div style="background:#f5f5f5; font-family:arial; padding:80px 0; width:100%">
        <div style="margin: 0 auto; max-width: 640px;">
            <div style="margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; max-width:640px">
                <div style="display:inline-block; margin-bottom:30px; margin-left:30px; margin-right:30px; margin-top:30px; text-align:center; width:100%">
                    <div><img alt="logo" src="https://i.ibb.co/QmY2GXM/logo.png" /></div>
                </div>

                <div style="background:#111111 url(images/email-header-bg.jpg); color:#ffffff; padding:80px 0; text-align:center">
                    <p style="margin-left:0px; margin-right:0px">Welcome</p>
                </div>

                <div style="background:#ffffff; box-sizing:border-box; display:inline-block; padding:50px 50px; width:100%">
                    <h1 style="margin-left:10px; margin-right:10px">Dearest {{$name}},</h1>

                    <p style="margin-left:15px; margin-right:15px"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum..</p>

                    <p style="margin-left:30px; margin-right:30px">
                        <!--?= htmlspecialchars_decode($intro) ?-->
                    </p>

                    <p style="margin-left:30px; margin-right:30px">
                        <!--?= htmlspecialchars_decode($body) ?-->
                    </p>

                    <p style="margin-left:30px; margin-right:30px">
                        <!--?= htmlspecialchars_decode($end) ?-->
                    </p>
                    <a href="{{ 'http://' . request()->getHttpHost() . '/pro#/confirmed'}}" style="background: #2a72cc; color: #fff; text-decoration: none; padding: 15px 30px; display: inline-block; border-radius: 7px; font-weight: 600; margin-top: 20px;">Confirm your account</a><br />
                    &nbsp;
                    <h2 style="margin-left:20px; margin-right:20px">Do check our other services</h2>

                    <div style="display:inline-block; width:100%">
                        <div style="border:1px solid #e8e9e9; box-sizing:border-box; float:left; padding:22px 37px; width:46%"><img alt="icon-sale" src="https://i.ibb.co/SnSFJhC/icon-sale.png" style="float:left; margin-right:17px" />
                            <p style="margin-left:4px; margin-right:4px"><a href="#" style="color:#2a5adc;">Find</a> near by apartments</p>
                        </div>

                        <div style="border:1px solid #e8e9e9; box-sizing:border-box; float:right; padding:22px 37px; width:46%"><img alt="icon-home" src="https://i.ibb.co/5WfDr9V/icon-home.png" style="float:left; margin:-4px 17px -4px 0" />
                            <p style="margin-left:4px; margin-right:4px"><a href="#" style="color:#2a5adc;">Sell</a> your apartment</p>
                        </div>
                    </div>
                </div>

                <div style="color:#777777; font-size:13px; margin-top:30px; text-align:center">
                    <p style="margin-left:7px; margin-right:7px">write your query at: info@flipkoti.fi</p>

                    <p style="margin-left:7px; margin-right:7px">Follow us on social media</p>

                    <div style=" margin-top: 15px;">
                        <a style="margin:0 3px; width: 20px; height: 20px; background: url(https://i.imgur.com/9udUsiZ.png) no-repeat scroll 0 0; display: inline-block;" href="#"></a>
                        <a style="margin:0 3px; width: 20px; height: 20px; background: url(https://i.imgur.com/9udUsiZ.png) no-repeat scroll -30px 0; display: inline-block;" href="#"></a>
                        <a style="margin:0 3px; width: 20px; height: 20px; background: url(https://i.imgur.com/9udUsiZ.png) no-repeat scroll -60px 0; display: inline-block;" href="#"></a>
                        <a style="margin:0 3px; width: 20px; height: 20px; background: url(https://i.imgur.com/9udUsiZ.png) no-repeat scroll -90px 0; display: inline-block;" href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>