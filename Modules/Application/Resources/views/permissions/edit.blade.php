@extends('application::layouts.master')
@section('title', 'Edit Permission')

@section('content')

    @include('application::components.form', [
        'form' => 'application::permissions._form',
        'method' => 'PUT',
        'action' => ['permissions.update',$id],
        'result' => $result,
        'container' => '12',
        'layout' => true,
        'type' => 'update',
        'actionControlles' => false
    ])

@endsection