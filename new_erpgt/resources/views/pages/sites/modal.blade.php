<div class="modal fade" id="SiteModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">

	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: -125px;"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">{{trans('gtb.Site_add?')}}</h4>
			</div>

    		<div class="modal-body">
		        {!! Form::open(['id' => 'frmSite']) !!}
			    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			    <input type="hidden" name="site_id" id="site_id" value="">

				<div class="field-wrapper SiteForm">
					<div class="row text-center">
		                <div class="col-md-12">
		                	{{ Form::bsText('Site','gtb', null, ['required' => '', 'autofocus' => '']) }}
		                	{{ Form::bsText('Address','general', null, ['required' => '']) }}
		                </div>
		                <div class="col-md-6">
		                	{{ Form::bsText('Postal_code','general', null, ['required' => '']) }}
						</div>
						<div class="col-md-6">
		                	{{ Form::bsText('City','general', null, ['required' => '']) }}
						</div>
						<div class="col-md-6">
		                	{{ Form::bsText('Phone','general', null, []) }}
						</div>
						<div class="col-md-6">
		                	{{ Form::bsText('Email','general', null, []) }}
						</div>
	              	</div>
				</div>
				
				{!! Form::close() !!}
		    </div>

		    <div class="modal-footer">
				{!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveSite', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
		    </div>

		</div>
	</div>
</div>