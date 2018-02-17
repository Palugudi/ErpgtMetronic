<div class="modal fade" id="MapModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">

	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">{{trans('gtb.Map_add?')}}</h4>
			</div>

    		<div class="modal-body">
		        {!! Form::open(['id' => 'frmMap']) !!}
			    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			    <input type="hidden" name="map_id" id="map_id" value="">
			    <input type="hidden" name="site_id" id="site_id" value="{{$site->id}}">

				<div class="field-wrapper MapForm">
					<div class="row text-center">
		                <div class="col-md-12">
							{{ Form::bsText('Map','gtb', null, ['required' => '', 'autofocus' => '']) }}
							<div class="form-group">
                                <div class="slim"
                                     data-label="Glissez l'image du plan ou cliquez ici">
                                    <input type="file" name="Picture" id="Picture"/>
                                    <img src="" id="PictureEdit" alt="">
                                </div>
                            </div>
		                </div>
	              	</div>
				</div>

				{!! Form::close() !!}
		    </div>

		    <div class="modal-footer">
				{!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveMap', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
		    </div>

		</div>
	</div>
</div>