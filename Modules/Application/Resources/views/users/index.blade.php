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

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <!-- <h4 class="page-title">Starter</h4> -->
            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

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
