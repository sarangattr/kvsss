@extends('application::layouts.master')
@section('title', 'Create User')

@section('content')

    @include('application::components.form', [
        'form' => 'application::users._form',
        'method' => 'POST',
        'action' => ['users.store'],
        'result' => [],
        'container' => '12',
        'layout' => true,
        'type' => 'create',
        'actionControlles' => false
    ])

@endsection