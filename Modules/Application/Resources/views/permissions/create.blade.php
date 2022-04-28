@extends('application::layouts.master')
@section('title', 'Create Permission')

@section('content')

    @include('application::components.form', [
        'form' => 'application::permissions._form',
        'method' => 'POST',
        'action' => ['permissions.store'],
        'result' => [],
        'container' => '12',
        'layout' => true,
        'type' => 'create',
        'actionControlles' => false
    ])

@endsection