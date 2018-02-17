<div class="modal fade" id="Equipment_typeModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">

	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">{{trans('gtb.Equipment_type_add?')}}</h4>
			</div>

    		<div class="modal-body">
		        {!! Form::open(['id' => 'frmEquipment_type', 'files' => true]) !!}
			    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			    <input type="hidden" name="equipment_type_id" id="equipment_type_id" value="">

				<div class="field-wrapper Equipment_typeForm">
					<div class="row text-center">
		                <div class="col-md-12">
		                	{{ Form::bsText('Equipment_type','gtb', null, ['required' => '', 'autofocus' => '']) }}
		                	{{ Form::bsSelect('Domain','gtb', $domains) }}
		                	{{ Form::bsFile('Icon','general', ['required' => '', 'accept' => 'image/png']) }}
		                	{{ Form::bsFile('Maintenance', 'gtb', ['required' => '', 'accept' => 'application/pdf']) }}
                            <div id="image_preview"><div class="thumbnail hidden"><img src="" alt=""></div></div>
		                </div>
	              	</div>
				</div>
				
				{!! Form::close() !!}
		    </div>

		    <div class="modal-footer">
				{!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveEquipment_type', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
		    </div>

		</div>
	</div>
</div>