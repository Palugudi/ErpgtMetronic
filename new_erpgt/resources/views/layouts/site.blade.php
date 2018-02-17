<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'ERPGT') }}</title>

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

        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/font-awesome.min.css') !!}
        {!! Html::style('css/flexslider.css') !!}
        {!! Html::style('css/custom.css') !!}

        @yield('styles')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="site @yield('body')">

        @yield('content')

        <!-- Scripts -->
        {!! HTML::script('js/jquery-2.1.4.min.js') !!}
        {!! HTML::script('js/libraries/tether.min.js') !!}
        {!! HTML::script('js/libraries/bootstrap.min.js') !!}

        {!! Html::script('js/libraries/jquery.flexslider.js') !!}
        {!! Html::script('js/custom.js') !!}
        @yield('scripts')

    </body>
</html>
