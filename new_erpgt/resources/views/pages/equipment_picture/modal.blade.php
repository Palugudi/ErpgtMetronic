<div class="modal fade" id="Equipment_pictureModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="equipmentPictureModalTitle">{{trans('equipment_picture.Equipment_picture_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmEquipment_picture', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="equipment_id" id="equipment_id" value="{{ $equipment->id }}">
                <input type="hidden" name="equipment_picture_id" id="equipment_picture_id" value="">

                <div class="field-wrapper Equipment_pictureForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="slim"
                                    data-label="{{ trans('equipment_picture.drop_picture') }}">
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
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveEquipment_picture', 'class'=>'btn btn-lg btn-block btn-success btn-save loading-btn', 'data-loading-text' => "<i class='fa fa-spinner fa-spin '></i> Téléchargement"]) !!}
            </div>

        </div>
    </div>
</div>