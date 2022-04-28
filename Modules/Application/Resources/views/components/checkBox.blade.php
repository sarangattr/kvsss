<div class="form-group">
    {{ Form::checkbox($name, $value, isset($checked) ? true : false) }}
    @if(isset($label)) {!! Form::label($name, $label, ['class' => isset($required) ? 'required form-label' : 'form-label']) !!} @endif 
</div>
@if ($errors->has($name)) <div class="text-danger">{{ $errors->first($name) }}</div> @endif