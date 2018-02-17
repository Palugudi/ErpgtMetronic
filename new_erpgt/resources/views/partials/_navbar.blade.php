<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">{{ Html::image('/images/erpgt50.png', 'logo ERPGT') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if (!Auth::guest())
          @if(!Auth::user()->first_connection)
            @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isManager() || Auth::user()->isPlanneur() || Auth::user()->isFM())
              <li class="{{ Request::is('site') ? "active" : "" }}"><a href="{{ url('/site') }}">{{trans('gtb.Sites')}}</a></li>
              @if(Auth::user()->isAdmin())
                <li class="{{ Request::is('users') ? "active" : "" }}"><a href="{{ url('/users') }}">{{trans('general.Users')}}</a></li>
              @else
                <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="{{ url('/contact') }}">{{trans('contact.Contacts')}}</a></li>
              @endif

              @if(!Auth::user()->isExternContact())
                <li class="{{ Request::is('reports') ? "active" : "" }}"><a href="{{ url('/reports') }}">{{trans('report.Reports')}}</a></li>

                <li class="{{ Request::is('orders') ? "active" : "" }}"><a href="{{ url('/orders') }}">{{trans('order.Orders')}}</a></li>
              @endif
            @endif
            @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isPlanneur() || Auth::user()->isFM() || Auth::user()->isExternContact())
              <li class="{{ Request::is('intervention') ? "active" : "" }}"><a href="{{ url('/intervention') }}">{{trans('intervention.Interventions')}}</a></li>
            @endif
          @else
            @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isManager() || Auth::user()->isPlanneur() || Auth::user()->isFM())
              <li class="{{ Request::is('site') ? "active" : "" }}"><a href="" data-toggle="modal" OnClick='IncompleteProfile()'>{{trans('gtb.Sites')}}</a></li>
              @if(Auth::user()->isAdmin())
                <li class="{{ Request::is('users') ? "active" : "" }}"><a href="" data-toggle="modal" OnClick='IncompleteProfile()'>{{trans('general.Users')}}</a></li>
              @else
                <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="" data-toggle="modal" OnClick='IncompleteProfile()'>{{trans('contact.Contacts')}}</a></li>
              @endif

              @if(!Auth::user()->isExternContact())
                <li class="{{ Request::is('reports') ? "active" : "" }}"><a href="" data-toggle="modal" OnClick='IncompleteProfile()'>{{trans('report.Reports')}}</a></li>

                <li class="{{ Request::is('orders') ? "active" : "" }}"><a href="" data-toggle="modal" OnClick='IncompleteProfile()'>{{trans('order.Orders')}}</a></li>
              @endif
            @endif
            @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isPlanneur() || Auth::user()->isFM() || Auth::user()->isExternContact())
              <li class="{{ Request::is('intervention') ? "active" : "" }}"><a href="" data-toggle="modal" OnClick='IncompleteProfile()'>{{trans('intervention.Interventions')}}</a></li>
            @endif
          @endif
        @endif
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> 
          <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="18" height="18" alt="{{ Session('locale') }}"  src="{!! asset('images/flags/' . Session('locale') . '-flag.png') !!}" /></a> 
 
          <ul class="dropdown-menu flag"> 
            @foreach ( config('app.languages') as $lang) 
            @if($lang !== config('app.locale')) 
            <li> 
              <a href="#" OnClick='FlagChange("{{ $lang }}");' data-toggle="modal"> 
                <img width="24" height="24" alt="{{ $lang }}" src="{!! asset('images/flags/' . $lang . '-flag.png') !!}">
              </a> 
            </li> 
            @endif 
            @endforeach 
          </ul> 
        </li> 
        <!-- Authentication Links -->
          @if (Auth::guest())
              <li><a href="{{ url('/login') }}">{{trans('auth.login')}}</a></li>
              {{ csrf_field() }}
          @else
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->first_name.' '.Auth::user()->last_name }} <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                    @if (Auth::user()->isAdmin())
                      <li><a href="{{ url('/domain') }}">{{trans('gtb.Domains')}}</a></li>
                      <li><a href="{{ url('/equipment_type') }}">{{trans('gtb.Equipment_types')}}</a></li>
                      <li><a href="{{ url('/brand') }}">{{trans('gtb.Brands')}}</a></li>
                      
                      <li><a href="{{ url('/localisation') }}">{{trans('gtb.Localisations')}}</a></li>
                      <li><a href="{{ url('/document_type') }}">{{trans('gtb.Document_types')}}</a></li>
                      <li><a href="{{ url('/status') }}">{{trans('gtb.Statuses')}}</a></li>
                      <li><a href="{{ url('/order_status') }}">{{trans('order_status.Order_statuses')}}</a></li>
                      <li><a href="{{ url('/interventionstatus') }}">{{trans('interventionstatus.Interventionstatuses')}}</a></li>
                      <li><a href="{{ url('/interventiontype') }}">{{trans('interventiontype.Interventiontypes')}}</a></li>
                      <li><a href="{{ url('/priority') }}">{{trans('priority.Priorities')}}</a></li>
                      <li><a href="{{ url('/time_type') }}">{{trans('time_type.Time_types')}}</a></li>
                      <li role="separator" class="divider"></li>
                    @endif
                      <li>
                          <a href="{{ url('/logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              {{trans('auth.logout')}}
                          </a>
                  
                          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                      </li>
                  </ul>
              </li>
          @endif
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
