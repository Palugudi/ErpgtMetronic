@foreach ($generalcomments as $generalcomment)
    <div class="comment">
        <div class="col-xs-8 col-sm-8">
            <div class="comment-info">
                <div class="comment-name">
                    @if ($generalcomment->user_id == Auth::user()->id)
                        <a href="" OnClick='EditGeneralComment({{ $generalcomment->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteGeneralcomment({{ $generalcomment->id }})" data-toggle="modal">
                        <span class="glyphicon glyphicon-remove text-danger"></span></a>
                    @endif
                    <h3>{{$user_names[$generalcomment->user_id]}}</h3>
                    <p class="comment-time">{{ format_date($generalcomment->updated_at) }}</p>
                </div> 
            </div>
        </div>


        <div class="comment-content">
            <br>
            {!! nl2br($generalcomment->comment) !!}
        </div>

        <hr>
    </div>
@endforeach
