@if (Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Bien joué!</strong> {{ Session::get('success') }}
	</div>
@endif

@if (Session::has('danger'))
	<div class="alert alert-danger" role="alert">
		<strong>Attention!</strong> {{ Session::get('danger') }}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger" role="alert">
		<strong>Erreur!</strong>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

 <div class="col-md-12">
    <div id="message-new" class="alert alert-success alert-dismissible" role="alert" style="display:none">
        <strong>{{ trans('gtb.message-create') }}</strong>
    </div>
    <div id="message-update" class="alert alert-success alert-dismissible" role="alert" style="display:none">
        <strong>{{ trans('gtb.message-update') }}</strong>
    </div>
    <div id="message-delete" class="alert alert-info" role="alert" style="display:none">
        <strong>{{ trans('gtb.message-delete') }}</strong>
    </div>
</div>