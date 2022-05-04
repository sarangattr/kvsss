@extends('application::layouts.master')
@section('title','Permissions')
@section('content')

<?php

function actionButton(Type $var = null)
{
    return [
        ['name' => 'Add New Permission', 'url' => url('/admin/permissions/create')],
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
                    <li class="breadcrumb-item active">Permissions</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

@component('application::components.datatable', [
    'id' => 'permissions-table',
    // 'hideCardLayout' => true, 
    'actionButtons' => [
        ['name' => 'Add Permission', 'url' => url('/admin/permissions/create'), 'icon' => 'fa fa-plus'],
    ],
    'url' => url('/admin/permissions/datatable'),
    'headers' => [
        ['label' => 'ID', 'name' => 'DT_RowIndex','orderable' => 'false' ],
        ['label' => 'Permission', 'name' => 'name' ],
        ['label' => 'Actions', 'name' => 'actions'],
    ] 
])
@endcomponent
@endsection