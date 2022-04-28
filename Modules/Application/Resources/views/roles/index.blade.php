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