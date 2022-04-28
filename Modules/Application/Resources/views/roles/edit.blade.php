@extends('application::layouts.master')
@section('title', 'Edit Role')

@section('content')

    @include('application::components.form', [
        'form' => 'application::roles._form',
        'method' => 'PUT',
        'action' => ['roles.update',$id],
        'result' => $result,
        'container' => '12',
        'layout' => true,
        'type' => 'update',
        'actionControlles' => false
    ])

@endsection