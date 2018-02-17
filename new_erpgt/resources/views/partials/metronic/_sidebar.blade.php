
@if (!Auth::guest())
<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true"
                        data-menu-scrollable="false" data-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true" >
                <a  href="{{ url('/home') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Dashboard
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    Actions
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
                @if (Auth::user()->isAdmin())
                    <li class="m-menu__item {{ Request::is('domain') ? ' m-menu__item--expanded' : ''}}">
                        <a  href="{{ url('/domain') }}" class="m-menu__link">
                            <i class="m-menu__link-icon flaticon-layers"></i>
                            <span class="m-menu__link-text">
                                {{trans('gtb.Domains')}}
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('equipment_type') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/equipment_type') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('gtb.Equipment_types')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('brand') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/brand') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('gtb.Brands')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('localisation') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/localisation') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('gtb.Localisations')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('document_type') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/document_type') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('gtb.Document_types')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('status') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/status') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                {{trans('gtb.Statuses')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('order_status') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/order_status') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('order_status.Order_statuses')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('interventionstatus') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/interventionstatus') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('interventionstatus.Interventionstatuses')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('interventiontype') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/interventiontype') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('interventiontype.Interventiontypes')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('priority') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/priority') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('priority.Priorities')}}
                                </span>
                            </a>
                    </li>
                    <li class="m-menu__item {{ Request::is('time_type') ? ' m-menu__item--expanded' : ''}}">
                            <a  href="{{ url('/time_type') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    {{trans('time_type.Time_types')}}
                                </span>
                            </a>
                    </li>
                @endif
        </ul>
    </div>
    <!-- END: Aside Menu -->	
</div>
<!-- END: Left Aside -->
@endif