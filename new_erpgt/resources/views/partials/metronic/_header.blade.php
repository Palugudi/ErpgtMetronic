<!-- BEGIN: Header -->
<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">
            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="{{ url('/') }}" class="m-brand__logo-wrapper">
                            {{ Html::image('/images/erpgt50.png', 'logo ERPGT') }}
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                         <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>
                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>
            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                    <i class="la la-close"></i>
                </button>
                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                        @if (!Auth::guest())
                            @if(!Auth::user()->first_connection)
                                    @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isManager() || Auth::user()->isPlanneur() || Auth::user()->isFM())
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('site') ? 'active' : ''}}" role="link">
                                            <a  href="{{ url('/site') }}" class="m-menu__link">
                                                <i class="m-menu__link-icon  flaticon-layers"></i>
                                                <span class="m-menu__link-text">
                                                    {{trans('gtb.Sites')}}
                                                </span>
                                            </a>
                                        </li>
                                    @if(Auth::user()->isAdmin())
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('site') ? 'active' : ''}}" role="link">
                                            <a  href="{{ url('/users') }}" class="m-menu__link">
                                                <i class="m-menu__link-icon  flaticon-users"></i>
                                                <span class="m-menu__link-text">
                                                    {{trans('general.Users')}}
                                                </span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('site') ? 'active' : ''}}" role="link">
                                            <a  href="{{ url('/contact') }}" class="m-menu__link">
                                                <i class="m-menu__link-icon  flaticon-layers"></i>
                                                <span class="m-menu__link-text">
                                                    {{trans('contact.Contacts')}}
                                                </span>
                                            </a>
                                        </li>
                                    @endif

                                    @if(!Auth::user()->isExternContact())
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('reports') ? 'active' : ''}}" role="link">
                                            <a  href="{{ url('/reports') }}" class="m-menu__link">
                                                <i class="m-menu__link-icon	 flaticon-line-graph"></i>
                                                <span class="m-menu__link-text">
                                                    {{trans('report.Reports')}}
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('orders') ? 'active' : ''}}" role="link">
                                            <a  href="{{ url('/orders') }}" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-coins"></i>
                                                <span class="m-menu__link-text">
                                                     {{trans('order.Orders')}}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                    @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isPlanneur() || Auth::user()->isFM() || Auth::user()->isExternContact())
                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('intervention') ? 'active' : ''}}" role="link">
                                        <a  href="{{ url('/intervention') }}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-security"></i>
                                            <span class="m-menu__link-text">
                                                    {{trans('intervention.Interventions')}}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            @else
                                @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isManager() || Auth::user()->isPlanneur() || Auth::user()->isFM())
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('site') ? 'active' : '' }}" OnClick='IncompleteProfile()' data-toggle="modal">
                                    <a  href="" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-add"></i>
                                        <span class="m-menu__link-text">
                                                {{trans('gtb.Sites')}}
                                        </span>
                                    </a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('users') ? 'active' : '' }}" OnClick='IncompleteProfile()' data-toggle="modal">
                                        <a  href="" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-users"></i>
                                            <span class="m-menu__link-text">
                                                {{trans('general.Users')}}
                                            </span>
                                        </a>
                                    </li>
                                @else
                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('contact') ? 'active' : '' }}" OnClick='IncompleteProfile()' data-toggle="modal">
                                        <a  href="" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-add"></i>
                                            <span class="m-menu__link-text">
                                               {{trans('contact.Contacts')}}
                                            </span>
                                        </a>
                                    </li>
                                @endif

                                @if(!Auth::user()->isExternContact())
                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('reports') ? 'active' : '' }}" OnClick='IncompleteProfile()' data-toggle="modal">
                                        <a  href="" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-file-1"></i>
                                            <span class="m-menu__link-text">
                                                {{trans('report.Reports')}}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('orders') ? 'active' : '' }}" OnClick='IncompleteProfile()' data-toggle="modal">
                                        <a  href="" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-add"></i>
                                            <span class="m-menu__link-text">
                                                {{trans('order.Orders')}}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @endif
                                @if (Auth::user()->isAdmin() || Auth::user()->isTech() || Auth::user()->isPlanneur() || Auth::user()->isFM() || Auth::user()->isExternContact())
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel {{ Request::is('intervention') ? 'active' : '' }}" OnClick='IncompleteProfile()' data-toggle="modal">
                                        <a  href="" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-add"></i>
                                            <span class="m-menu__link-text">
                                                {{trans('intervention.Interventions')}}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        @endif
                    </ul>
                </div>
                <!-- END: Horizontal Menu -->								
                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                     <ul class="m-topbar__nav m-nav m-nav--inline">
                        @if (Auth::guest())
                            <li  class="m-nav__item">
                                <a href="{{ url('/login') }}" class="m-nav__link" id="dropdownMenuLink" aria-expanded="false"><br>
                                      {{trans('auth.login')}}
                                </a>
                            </li>
                            {{ csrf_field() }}
                        @else
                        <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic">
                                        <i class="flaticon-menu-1"> </i> {{ Auth::user()->first_name.' '.Auth::user()->last_name }} <span class="caret"></span>
                                    </span>
                                    <span class="m-topbar__username m--hide">
                                        {{ Auth::user()->first_name.' '.Auth::user()->last_name }} 
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500">
                                                    {{ Auth::user()->first_name.' '.Auth::user()->last_name }} 
                                                    </span>
                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                    {{ Auth::user()->email}} 
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
                                                        <span class="m-nav__section-text">
                                                            Section
                                                        </span>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                            <li  class="m-nav__item">
                                <a href="#" class="m-nav__link m-dropdown__toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="m-nav__link-icon">
                                       <img width="18" height="18" alt="{{ Session('locale') }}" src="{!! asset('images/flags/' . Session('locale') . '-flag.png') !!}">
                                    </span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @foreach ( config('app.languages') as $lang) 
                                        @if($lang !== config('app.locale')) 
                                            <a class="dropdown-item" href="#" OnClick='FlagChange("{{ $lang }}");'>
                                               <img width="24" height="24" alt="{{ $lang }}" src="{!! asset('images/flags/' . $lang . '-flag.png') !!}">
                                            </a>
                                        @endif 
                                    @endforeach 
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>
<!-- END: Header -->	