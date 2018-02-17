<div class="form-group">

    {{ Form::label($name, trans("$translation.$name"), ['for' => $name, 'class' => 'component']) }}
    {{ Form::number($name, $value, array_merge(['class' => 'form-control input-lg', 'id' => $name,
 'placeholder' => trans("$translation.$name".'_placeholder'), 'step' => '1'], $attributes)) }}

	<small class="help-block"></small>

</div>