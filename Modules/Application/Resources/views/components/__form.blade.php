<div class="row">
    <div class="col-md-{{isset($container) ? $container : 12}}">
        <div class="card">
            <div class="card-body">
                @if(!isset($formPath))

                @else
                    @if($action === 'create')
                        {!! Form::open(['route' => $actionUrl]) !!}
                    @elseif ($action === 'update')
                        {!! Form::model($result, ['method' => 'PUT', 'route' => $actionUrl ]) !!}
                    @endif
                @endif
                @include($formPath)
                <div class="row mt-3">
                    <div class="col-md-12 text-end">
                        @if($action === 'create')
                            <x-application::button name="Submit"/>
                        @else
                            <x-application::button name="Update"/>
                        @endif
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
