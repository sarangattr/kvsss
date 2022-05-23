<?php 

    if(! isset($type)) $type = "password";
    
   

    $options = [
        'class' => isset($class) ? 'form-control ' . $class : 'form-control', 
        'id' => isset($id) ? $id : $name, 
        'placeholder' => isset($placeholder) ? $placeholder : '',
        'autofocus' => isset($autofocus) ? true : false,
        'maxlength' => isset($maxlength) ? $maxlength : 250,
    ];

    if(isset($onchange)) $options['onchange'] = $onchange;
    if(isset($onkeypress)) $options['onkeypress'] = $onkeypress;
    if(isset($heigth)) $options['heigth'] = $heigth;
    if(isset($style)) $options['style'] = $style; 

?>

<div class="form-group">
    @if(isset($label)) {!! Form::label($name, $label, ['class' => isset($required) ? 'required form-label' : 'form-label']) !!} @endif 
    {!! Form::$type($name, $options) 
    !!}
    @if ($errors->has($name)) <div class="text-danger">{{ $errors->first($name) }}</div> @endif
</div>