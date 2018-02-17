<div class="modal fade" id="ContactModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('contact.Contact_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmContact', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="contact_id" id="contact_id" value="">

                <div class="field-wrapper ContactForm">
                    <div class="row text-center">
                        <div class="col-md-6">
                            {{ Form::bsText('First_name','contact', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Last_name','contact', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Email','contact', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Number','contact', null, []) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::bsText('Job','contact', null, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveContact', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>