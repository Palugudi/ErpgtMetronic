<div class="modal fade" id="DocumentTypeModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">

	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">{{trans('gtb.Document_type_add?')}}</h4>
			</div>

    		<div class="modal-body">
		        {!! Form::open(['id' => 'frmDocumentType', 'files' => true]) !!}
			    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			    <input type="hidden" name="documenttype_id" id="documenttype_id" value="">

				<div class="field-wrapper Document_typeForm">
					<div class="row text-center">
		                <div class="col-md-12">
		                	{{ Form::bsText('Document_type','gtb', null, ['required' => '', 'autofocus' => '']) }}
		                	{{ Form::bsFile('Icon','general', ['required' => '', 'accept' => 'image/png']) }}
                            <div id="image_preview"><div class="thumbnail hidden"><img src="" alt=""></div></div>
		                </div>
	              	</div>
				</div>
				
				{!! Form::close() !!}
		    </div>

		    <div class="modal-footer">
				{!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveDocumentType', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
		    </div>

		</div>
	</div>
</div>