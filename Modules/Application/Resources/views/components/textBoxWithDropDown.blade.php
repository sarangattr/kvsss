<?php 

    if(! isset($type)) {
        $type = "text";
    }

?>
<div class="form-group">
    @if(isset($label)) {!! Form::label($name, $label, ['class' => isset($required) ? 'required form-label' : 'form-label']) !!} @endif 
    <div class="input-group">
        <button
            class="btn btn-soft-secondary waves-effect waves-light dropdown-toggle"
            type="button" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">{{$selected}}<i class="mdi mdi-chevron-down"></i></button>
            {{-- <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div> --}}
        {!! Form::$type($name, null, [
                'class' => isset($class) ? 'form-control ' . $class : 'form-control', 
                'id' => isset($id) ? $id : $name, 
                'maxlength' => isset($maxlength) ? $maxlength : 250,
                'placeholder' => isset($placeholder) ? $placeholder : '',
                'autofocus' => isset($autofocus) ? true : false
            ]) 
        !!}
    </div>
    @if ($errors->has($name)) <div style="margin-top: -24px;" class="text-danger">{{ $errors->first($name) }}</div> @endif
</div>