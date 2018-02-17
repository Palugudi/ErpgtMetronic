{{ Form::label($name, trans("$translation.$label"), ['for' => $value, 'class' => 'component']) }}
{{ Form::checkbox($name, $value, true, $attributes) }}
