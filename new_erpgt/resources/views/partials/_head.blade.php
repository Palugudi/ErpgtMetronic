<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>{{ config('app.name') }} | @yield('title')</title>


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

<!-- Google Font -->
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">

{{ Html::style('css/styles.css') }}

	
@yield('stylesheets')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
