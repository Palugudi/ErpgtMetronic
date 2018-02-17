<div class="form-group">

	{{ Form::submit(trans("$translation.$name"), array_merge(['class' => 'btn btn-lg btn-block', 'id' => $name], $attributes)) }}

</div>