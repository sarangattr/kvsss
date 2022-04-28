<div class="form-group">
    @if(isset($label)) {!! Form::label($name, $label, ['class' => isset($required) ? 'required form-label' : 'form-label']) !!} @endif 
    <div class="input-group" id="datepicker2">
        {!! Form::text($name, null, [
                'class' => 'form-control', 
                'id' => isset($id) ? $id : $name, 
                'placeholder' => isset($placeholder) ? $placeholder : '',
                'autofocus' => isset($autofocus) ? true : false,
                'data-provide' => 'datepicker',
                'data-date-format' => isset($dateFormat) ? $dateFormat : 'yyyy-mm-dd',
                'data-date-autoclose' => 'true',
                'data-date-container' => '#datepicker2'
            ]) 
        !!}
        <span class="input-group-text"><i class="ri-calendar-event-fill"></i></span>
    </div>
    @if ($errors->has($name)) <div class="text-danger">{{ $errors->first($name) }}</div> @endif
</div>

@push('styles')
<link rel="stylesheet" href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush

@push('script')
    <script src="{{asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
@endpush