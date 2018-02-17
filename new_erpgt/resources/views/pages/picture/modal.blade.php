<div class="modal fade" id="PictureModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('picture.Picture_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmPicture', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="picture_id" id="picture_id" value="">
                <input type="hidden" name="site_id" id="site_id" value="{{ $site->id }}">

                <div class="field-wrapper PictureForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="slim"
                                     data-label="Glissez la photo ou cliquez ici">
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
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'savePicture', 'class'=>'btn btn-lg btn-block btn-success btn-save loading-btn', 'data-loading-text' => "<i class='fa fa-spinner fa-spin '></i> Téléchargement"]) !!}
            </div>

        </div>
    </div>
</div>