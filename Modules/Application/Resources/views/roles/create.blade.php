@extends('application::layouts.master')
@section('title', 'Create Role')

@section('content')

    @include('application::components.form', [
        'form' => 'application::roles._form',
        'method' => 'POST',
        'action' => ['roles.store'],
        'result' => [],
        'container' => '12',
        'layout' => true,
        'type' => 'create',
        'actionControlles' => false
    ])

@endsection