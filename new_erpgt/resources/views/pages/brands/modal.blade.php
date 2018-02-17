<div class="modal fade" id="BrandModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">

	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">{{trans('gtb.Brand_add?')}}</h4>
			</div>

    		<div class="modal-body">
		        {!! Form::open(['id' => 'frmBrand']) !!}
			    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			    <input type="hidden" name="brand_id" id="brand_id" value="">

				<div class="field-wrapper BrandForm">
					<div class="row text-center">
		                <div class="col-md-12">
		                	{{ Form::bsText('Brand','gtb', null, ['required' => '', 'autofocus' => '']) }}
		                </div>
	              	</div>
				</div>
				
				{!! Form::close() !!}
		    </div>

		    <div class="modal-footer">
				{!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveBrand', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
		    </div>

		</div>
	</div>
</div>