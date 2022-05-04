@extends('application::layouts.master')
@section('title','Roles')
@section('content')

<?php

function actionButton(Type $var = null)
{
    return [
        ['name' => 'Add New Role', 'url' => url('/admin/roles/create')],
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
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

@component('application::components.datatable', [
    'id' => 'roles-table',
    // 'hideCardLayout' => true, 
    'actionButtons' => [
        ['name' => 'Add Role', 'url' => url('/admin/roles/create'), 'icon' => 'fa fa-plus'],
    ],
    'url' => url('/admin/roles/datatable'),
    'headers' => [
        ['label' => 'ID', 'name' => 'DT_RowIndex','orderable' => 'false' ],
        ['label' => 'Role', 'name' => 'name' ],
        ['label' => 'Actions', 'name' => 'actions'],
    ] 
])
@endcomponent
@endsection