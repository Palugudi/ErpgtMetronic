@foreach ($internalcomments as $internalcomment)
    <div class="comment">
        <div class="col-xs-8 col-sm-8">
            <div class="comment-info">
                <div class="comment-name">
                    @if ($internalcomment->user_id == Auth::user()->id)
                        <a href="" OnClick='EditInternalcomment({{ $internalcomment->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteInternalcomment({{ $internalcomment->id }})" data-toggle="modal">
                        <span class="glyphicon glyphicon-remove text-danger"></span></a>
                    @endif
                    <h3>{{$user_names[$internalcomment->user_id]}}</h3>
                    <p class="comment-time">{{ format_date($internalcomment->updated_at) }}</p>
                </div> 
            </div>
        </div>
        <div class="comment-content">
            <br>
            {!! nl2br($internalcomment->comment) !!}
        </div>

        <hr>
    </div>
@endforeach