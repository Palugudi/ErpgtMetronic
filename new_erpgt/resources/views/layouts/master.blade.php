<!DOCTYPE html>

<html lang="fr">

    <head>
        @include('partials.metronic._head')
    </head>

	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
             @include('partials.metronic._header')

            <!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                 @include('partials.metronic._sidebar')

                 <div class="m-grid__item m-grid__item--fluid m-wrapper">
          
                      @yield('content')
                 </div>
            </div>

            @include('partials.metronic._footer')
        </div>


        @include('partials.metronic._javascript')

        @yield('scripts')

    </body>
</html>