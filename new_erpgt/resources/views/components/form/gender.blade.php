<div class="form-group">

    {{ Form::label($name, trans("$translation.$name"), ['for' => $name, 'class' => 'component']) }}
<p>
    {{ Form::label($name, 'M.', ['for' => 1]) }}
	{{ Form::radio($name, 1, true) }} &nbsp;&nbsp;&nbsp;

	{{ Form::label($name, 'Mme', ['for' => 2]) }}
	{{ Form::radio($name, 2) }} &nbsp;&nbsp;&nbsp;

	{{ Form::label($name, 'Mlle', ['for' => 3]) }}
	{{ Form::radio($name, 3) }}
</p>

</div>

