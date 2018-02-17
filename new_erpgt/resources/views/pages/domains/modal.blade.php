<div class="modal fade" id="DomainModal" tabindex="-99" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">

	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">{{trans('gtb.Domain_add?')}}</h4>
			</div>

    		<div class="modal-body">
		        {!! Form::open(['id' => 'frmDomain', 'files' => true]) !!}
			    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			    <input type="hidden" name="domain_id" id="domain_id" value="">

				<div class="field-wrapper DomainForm">
					<div class="row text-center">
		                <div class="col-md-12">
		                	{{ Form::bsText('Domain','gtb', null, ['required' => '', 'autofocus' => '']) }}
		                	{{ Form::bsFile('Icon','general', ['required' => '', 'accept' => 'image/png']) }}
                            <div id="image_preview"><div class="thumbnail hidden"><img src="" alt=""></div></div>
                            <input class="jscolor" name="color" id="color" value="ab2567">
		                </div>
	              	</div>
				</div>
		    </div>

		    <div class="modal-footer">
				{!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveDomain', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
				{!! Form::close() !!}
		    </div>

		</div>
	</div>
</div>