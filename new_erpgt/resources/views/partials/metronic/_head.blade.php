  <!-- begin::Head -->
		<meta charset="utf-8" />
		<title>
			Metronic | Dashboard
		</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon/favicon.png')}}" type="image/png">
    <link rel="icon" sizes="32x32" href="{{ asset('images/favicon/favicon-32.png')}}" type="image/png">
    <link rel="icon" sizes="64x64" href="{{ asset('images/favicon/favicon-64.png')}}" type="image/png">
    <link rel="icon" sizes="96x96" href="{{ asset('images/favicon/favicon-96.png')}}" type="image/png">
    <link rel="icon" sizes="196x196" href="{{ asset('images/favicon/favicon-196.png')}}" type="image/png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-touch-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-touch-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-touch-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-touch-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-touch-icon-144x144.png')}}">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/favicon-144.png')}}">
    <meta name="msapplication-TileColor" content="#FFFFFF">


		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
		<link href="{{ asset('assets/metronic/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->
		<link href="{{ asset('assets/metronic/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/metronic/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ asset('assets/metronic/demo/default/media/img/logo/favicon.ico') }}" />

    {{ Html::style('css/styles.css') }}

	
    @yield('stylesheets')
	<!-- end::Head -->
