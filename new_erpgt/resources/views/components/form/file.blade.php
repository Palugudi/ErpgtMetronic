<div class="form-group">

    {{ Form::label($name, trans("$translation.$name"), ['for' => $name, 'class' => 'component']) }}
    {{ Form::file($name, array_merge(['class' => 'form-control input-lg', 'id' => $name,
 'placeholder' => trans("$translation.$name".'_placeholder')], $attributes)) }}

	<small class="help-block"></small>

</div>