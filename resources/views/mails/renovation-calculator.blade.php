<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Flipkoti</title>
</head>
<body style="margin:0;">
<div style="background: #f5f5f5;width: 100%;padding: 80px 0; font-family: arial; overflow: auto;">
    <div style="margin: 0 auto; max-width: 640px; min-width: 470px;">
        <div style=" margin: 0 0 30px; text-align: center; display: inline-block; width: 100%;">
            <div>
                <img src="{{ url('images/flipkoti-ft-logo.png') }}">
            </div>
        </div>
        <?= htmlspecialchars_decode($body) ?>
        @include('mails.footer')
    </div>
</div>
</body>
</html>