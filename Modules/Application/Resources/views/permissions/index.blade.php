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