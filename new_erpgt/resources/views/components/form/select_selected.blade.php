<div class="form-group">

	{{ Form::label($name, trans("$translation.$name"), ['for' => $name, 'class' => 'component']) }}
	{{ Form::select($name, $data, $selected, ['class' => 'form-control input-lg', 'required' => '', 'placeholder' => trans("$translation.$name".'_placeholder')]) }}

	<small class="help-block"></small>
</div>
