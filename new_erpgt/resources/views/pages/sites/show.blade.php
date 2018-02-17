@extends('layouts.master')

@section('body', "site-index")

@section('title', 'Liste des sites')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

    <!-- Begin: Subheader -->
    <div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
               {{trans('gtb.Sites_list')}}
            </h3>
        </div>
    </div>
    </div>
    <!-- END: Subheader -->
   <div class="container">
    <section id="section-1" class="parallax">
        
        <div id="toolbar" class="toolbarmap">
            <div class="hamburger hamburgerSite">
                <span>Liste&nbsp;des&nbsp;plans</span>
            </div>
            <div id="toolbarlist">
                <div id="mapList"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h1>{{ $site->name}}</h1>
            </div>
        </div><!-- end of header .row -->
        <div class="row">
             <div class="col-md-4 col-center">              <!-- Partie en haut à gauche -->
                <div class="row">
                    @if(Auth::user()->map_creator)
                        <div class="col-xs-6"><a class="btnSite" href=""  OnClick='NewMap();' data-toggle="modal"><img src="{{ asset('images/btn/add_a_map.svg')}}" alt="{{trans('gtb.btn_add_a_map')}}" style="border-color: #f7f4f7; border-width: 2px; border-style: solid; border-radius: 50%; margin-right: 50px; margin-left: 40px;"><p>{{trans('gtb.btn_add_a_map')}}</p></a></div>
                    @endif
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('picture.index', $site->id) }}"><img src="{{ asset('images/btn/pictures.svg')}}" alt="{{trans('gtb.btn_pictures')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-right: 50px; margin-left: 45px;"><p>{{trans('gtb.btn_pictures')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('order.index', $site->id) }}"><img src="{{ asset('images/btn/orders.svg')}}" alt="{{trans('gtb.btn_orders')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-right: 48px; margin-left: 40px;"><p>{{trans('gtb.btn_orders')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('qrcode.index', $site->id) }}"><img src="{{ asset('images/btn/qrcode.svg')}}" alt="{{trans('gtb.btn_qrcode')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-left: 50px; margin-right: 45px;"><p>{{trans('gtb.btn_qrcode')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('planning.index', $site->id) }}"><img src="{{ asset('images/btn/planning.svg')}}" alt="{{trans('gtb.btn_planning')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-right: 40px; margin-left: 40px; "><p>{{trans('gtb.btn_planning')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('enterprise.index', $site->id) }}"><img src="{{ asset('images/btn/enterprise_contacts.svg')}}" alt="{{trans('gtb.btn_enterprise_contacts')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-left: 55px; margin-right: 50px;"><p>{{trans('gtb.btn_enterprise_contacts')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('report.index', $site->id) }}"><img src="{{ asset('images/btn/reporting.svg')}}" alt="{{trans('gtb.btn_reporting')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-right: 40px; margin-left: 40px;"><p>{{trans('gtb.btn_reporting')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href=""  OnClick='NewDocument()' data-toggle="modal"><img src="{{ asset('images/btn/add_a_document.svg')}}" alt="{{trans('gtb.btn_add_a_document')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-right: 50px; margin-left: 55px;"><p>{{trans('gtb.btn_add_a_document')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('consumption.index', $site->id) }}"><img src="{{ asset('images/btn/monitoring_of_consumptions.svg')}}" alt="{{trans('gtb.btn_monitoring_of_consumptions')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-left:45px; margin-right: 50px;"><p>{{trans('gtb.btn_monitoring_of_consumptions')}}</p></a></div>
                    <div class="col-xs-6"><a class="btnSite" href="{{ route('key.index', $site->id) }}"><img src="{{ asset('images/btn/key.svg')}}" alt="{{trans('gtb.btn_key')}}" style="border-color: #fff; border-width: 2px; border-style: solid; border-radius: 50%; margin-right: 5px; margin-left: 40px;"><p>{{trans('gtb.btn_key')}}</p></a></div>
                </div>
            </div>                              <!-- Fin de la partie en haut à gauche -->
            
            <div class="col-md-8">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#equipment"><strong>{{trans('gtb.Equipments_list_site')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#document"><strong>{{trans('gtb.Documents_list')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#intervention"><strong>{{trans('gtb.Interventions_history')}}</strong></a></li>
                </ul>
                <div id="siteList_filter" class="siteData_filter">
            <label style="margin-top: 25px; margin-left: 232px;"> Filtres <input type="search" class="form-control input-sm" placeholder="Rechercher" 
                    aria-controls="siteList" style="width: 220px; margin: -22px 0px 0px 50px;">
                </label>
            </div>
             <div class="table-responsive">
                <table class="table" id="DocumentsTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{trans('gtb.Equipments')}}</th>
                            <th>{{trans('gtb.Domain')}}</th>
                            <th>{{trans('Plan')}}</th>
                            <th>{{trans('gtb.Localisation')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <th><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a></th>
                        <td><a href="tel:{{ $site->phone }}">{{ $site->phone }}</a></td>
                        <td><a href="mailto:{{ $site->email }}">{{ $site->email }}</a></td>
                        <td>{{ $site->address }} {{ $site->postal_code }} {{ $site->city }}</td>
                    </tbody>
        
               </table>
         </div>

       </div>
    </section>
    @include('pages.document.modal')
    @include('pages.maps.modal')
    @include('pages.equipments.modal')
  </div>
 
@endsection

@section('scripts')
    @include('partials.scripts.table')
    {!! Html::script('js/views/sites-show.js') !!}
    {!! Html::script('js/slim.kickstart.min.js') !!}

    <script>
    var token = "{{ csrf_token() }}";
    var routeMap = "{{ url('map') }}";
    var routeDomain = "{{ url('domain') }}";
    var routeEquipment = "{{ url('equipment') }}";
    var routeAjaxMap = "{{ url('map/listajax') }}"+"/"+"{{$site->id}}";
    var routeAjaxEquipment = "{{ url('equipment/listajax') }}"+"/"+"{{$site->id}}";
    var routeAjaxIntervention = "{{ url('intervention/listajaxsite') }}"+"/"+"{{$site->id}}";
    var routeDocument = "{{ url('document') }}";
    var routeDocumentAjax = "{{ url('document/listajax') }}"+"/"+"{{$site->id}}";
    var DocumentEditText = "{{ trans('document.Document_edit') }}";
    var DocumentDeleteText = "{{ trans('document.Document_delete') }}";
    var DocumentDeletedText = "{{ trans('document.Document_deleted') }}";
    var validate_btn = "{{ trans('general.Validate') }}";

    var MapEditText = "{{ trans('gtb.Map_edit') }}";
    var MapAddText = "{{ trans('gtb.Map_add_new') }}";
    var MapDeleteText = "{{ trans('gtb.Map_delete') }}";
    var MapDeletedText = "{{ trans('gtb.Map_deleted') }}";
@endsection