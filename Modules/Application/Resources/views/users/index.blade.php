@extends('application::layouts.master')
@section('title', 'Users')
@section('content')

<?php

function actionButton(Type $var = null)
{
    return [
        ['name' => 'Add User', 'url' => url('/admin/users/create')],
    ];

}

?>

@component('application::components.datatable', [
    'id' => 'user-table',
    'actionButtons' => actionButton(),
    'url' => url('/admin/users/datatable'),
    'headers' => [
        ['label' => 'ID', 'width' => '50px', 'name' => 'DT_RowIndex', 'orderable' => false ],
        ['label' => 'Full name', 'name' => 'name'],
        ['label' => 'Email', 'name' => 'email'],
        ['label' => 'Mobile', 'name' => 'mobile'],
        ['label' => 'Role', 'name' => 'role'],
        ['label' => 'Created at', 'name' => 'created_at'],
        ['label' => 'Status', 'name' => 'status'],
        ['label' => 'Actions', 'name' => 'actions']
    ]
])
@endcomponent

@endsection
