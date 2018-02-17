<div class="modal fade" id="EquipmentModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">

	    	<div class="modal-header">
	    		@if(isset($map->site_id))
	    			<a class="close" aria-label="Close" href="#" onclick="window.location.reload(true);"><span aria-hidden="true">&times;</span></a>
	    		@else
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    		@endif
		        <h4 class="modal-title" id="equipmentModalTitle">{{trans('gtb.Equipment_add?')}}</h4>
			</div>

    		<div class="modal-body">
		        {!! Form::open(['id' => 'frmEquipment']) !!}
			    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			    <input type="hidden" name="equipment_id" id="equipment_id" value="">
			    <input type="hidden" name="equipment_map_id" id="equipment_map_id" value="">
			    <input type="hidden" name="site_id" id="site_id" value="{{ isset($map->site_id)?$map->site_id:(isset($site->id)?$site->id:$equipment->site_id) }}">
			    <input type="hidden" name="domain_id" id="domain_id" value="">
			    <input type="hidden" name="position_left" id="position_left" value="">
			    <input type="hidden" name="position_top" id="position_top" value="">

				<div class="field-wrapper EquipmentForm">
					<div class="row text-center">
		                <div class="col-md-6">
		                	{{ Form::bsSelect('Equipment_type','gtb', []) }}
		                	{{ Form::bsSelect('Brand','gtb', $brands) }}
		                	{{ Form::bsSelect('Status','gtb', $statuses) }}
		                	{{ Form::bsSelect('Localisation','gtb', $localisations) }}
						</div>
		                <div class="col-md-6">
		                	{{ Form::bsText('Model','gtb', null, ['required' => '']) }}
		                	{{ Form::bsNumber('Quantity','gtb', null, ['required' => '']) }}
		                	{{ Form::bsText('Serial_number','gtb', null, []) }}
		                	{{ Form::bsText('Manufacture_date','gtb', null, []) }}
						</div>
						<div class="col-md-12">
		                	{{ Form::bsTextarea('Informations','gtb', null, []) }}
						</div>
	              	</div>
				</div>

				{!! Form::close() !!}
		    </div>

		    <div class="modal-footer">
				{!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveEquipment', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
		    </div>

		</div>
	</div>
</div>