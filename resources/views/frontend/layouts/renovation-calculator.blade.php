<!DOCTYPE html>
<html>
<head>
    <title>Flipkoti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link media="all" type="text/css" rel="stylesheet" href="http://flipkoti.fi/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://flipkoti.fi/css/style.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    
	<link rel="stylesheet" type="text/css" href="{{asset('renovation/css/newcss.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('renovation/css/calc.css')}}">
    <link rel="stylesheet" href="{{asset('renovation/build/css/intlTelInput.css')}}">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TZBZFDZ');</script>
<!-- End Google Tag Manager -->
    </head>
    <body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZBZFDZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@include('includes.partials.logged-in-as')
@include('frontend.includes.nav')
@yield('content')
@include('frontend.includes.renovation-calculator.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="{{asset('renovation/build/js/intlTelInput.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        // separateDialCode: true,
        utilsScript: "renovation/build/js/utils.js",
    });
</script>
<script>
	/*$(document).on('click','.makerenovation li a',function(){
		$('#cust-portion-type').html($(this).find('span').html());
	});*/
	if($("select.selectpicker").length){
		$("select.selectpicker").selectpicker();
	}
    $(document).on('click','.cust-reno-link',function(){
        $('#reno-portion-type').val($(this).text());
        $('#submit-form').trigger('click');
    });
</script>

</body>
</html>