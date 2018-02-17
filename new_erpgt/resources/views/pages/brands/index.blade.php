@extends('layouts.master')

@section('body', "brand-index")

@section('title', trans('gtb.Brands_list'))

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
		<!-- Begin: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
				   {{trans('gtb.Brands_list')}}
				</h3>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->

	<div class="m-content">
		<div class="m-portlet__body">
			<!--begin: Search Form -->
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
				<div class="row align-items-center">
					<div class="col-xl-8 order-2 order-xl-1">
						<div class="form-group m-form__group row align-items-center">
							<div class="col-md-4">
								<div class="m-input-icon m-input-icon--left">
									<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
									<span class="m-input-icon__icon m-input-icon__icon--left">
										<span>
											<i class="la la-search"></i>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 order-1 order-xl-2 m--align-right">
						<a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" OnClick='NewBrand();' data-toggle="modal">
							<span>
								<i class="la la-cart-plus"></i>
								<span>
								    {{trans('gtb.Brand_add_new')}} 
								</span>
							</span>
						</a>
						<div class="m-separator m-separator--dashed d-xl-none"></div>
					</div>
				</div>
			</div>
			<!--end: Search Form -->
			<div id="brandList"></div>
	   </div>
	</div>
	@include('pages.brands.modal')
@endsection

@section('scripts')
	@include('partials.scripts.table')
	<script>
	    var token = "{{ csrf_token() }}";
		var route = "{{ url('brand') }}";
		var routeAjax = "{{ route('brand.listajax') }}";
		var validate_btn = "{{ trans('general.Validate') }}";

		var BrandAddText = "{{ trans('gtb.Brand_add?')}}";
		var BrandDeleteText = "{{ trans('brand.delete')}}";
		var BrandEditText = "{{ trans('brand.edit')}}";
		var BrandDeletedText = "{{ trans('brand.deletedtext') }}"
	</script>
	{!! Html::script('js/views/brands-index.js') !!}
@endsection