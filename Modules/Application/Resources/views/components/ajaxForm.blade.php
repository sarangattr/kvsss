@php

    $formId = isset($id) ? $id : rand(); 

@endphp

@if($method === 'POST')
    {!! Form::open(['route' => $action, 'id' => $formId, 'data-create' => route($action)]) !!}
@elseif ($method === 'PUT')
    {!! Form::model($result, ['method' => $method, 'route' => $action, 'id' => $formId ]) !!}
@endif 
{!! $slot !!}
{!! Form::close() !!}

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    @if(isset($ajaxSubmit))
    <script>

        let formSet = $('#source-type-form').serializeArray();
        let validationRules = {};
        for (let i = 0; i < formSet.length; i++) {
            const el = formSet[i];
            let getElementProp = $('[name='+el.name+'')
            let isRequired = getElementProp.attr('required');
            let maximumLength = getElementProp.attr('maximumLength');
            let minimumLength = getElementProp.attr('minimumLength');
            isRequired = isRequired ? true : false;

            validationRules[el.name] = {required: isRequired}

            if(maximumLength)
                validationRules[el.name]['maxlength'] = maximumLength;

            if(minimumLength)
                validationRules[el.name]['minlength'] = minimumLength;
        }

        $("#{{$formId}}").validate({
            rules: validationRules,
        });

    </script>
    @endif
@endpush
