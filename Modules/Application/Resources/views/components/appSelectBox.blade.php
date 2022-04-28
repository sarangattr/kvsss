<?php 

    if(! isset($options)) {
        $options = [];
    }

?>

<div class="form-group">
    @if(isset($label)) {!! Form::label($name, $label, ['class' => isset($required) ? 'required form-label' : 'form-label']) !!} @endif 
    {!! Form::select($name, ['' => '- ' . $placeholder . ' -'] + $options, null, ['class' => 'form-control']) !!}
    @if ($errors->has($name)) <div class="text-danger">{{ $errors->first($name) }}</div> @endif
</div>