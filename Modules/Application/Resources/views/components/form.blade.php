@if(!isset($layout))
<div class="row">
    <div class="col-md-{{isset($container) ? $container : 12}}">
        <div class="card">
            <div class="card-body"> 
@endif
                @if(!isset($form)) 

                @else
                    @if($method === 'POST')
                        {!! Form::open(['route' => $action]) !!}
                    @elseif ($method === 'PUT')
                        {!! Form::model($result, ['method' => 'PUT', 'route' => $action ]) !!}
                    @endif
                @endif
                @include($form)
                @if(!isset($actionControlles))
                    <div class="row mt-3">
                        <div class="col-md-12 text-end">
                            @if($method === 'POST')
                                <x-application::button name="Submit"/>
                            @else
                                <x-application::button name="Update"/>
                            @endif
                        </div>
                    </div>
                @endif
                {!! Form::close() !!}
@if(!isset($layout))
            </div>
        </div>
    </div>
</div>
@endif
