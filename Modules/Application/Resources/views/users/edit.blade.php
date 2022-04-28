@extends('application::layouts.master')
@section('title', 'Edit User')

@section('content')

    @include('application::components.form', [
        'form' => 'application::users._form',
        'method' => 'PUT',
        'action' => ['users.update',$id],
        'result' => $result,
        'container' => '12',
        'layout' => true,
        'type' => 'Update',
        'actionControlles' => false
    ])

@endsection