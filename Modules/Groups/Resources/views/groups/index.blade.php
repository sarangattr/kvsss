@extends('layouts.admin')

@section('breadcrumb')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <!-- <h4 class="page-title">Starter</h4> -->
            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Management</li>
                    <li class="breadcrumb-item active">Clusters</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Clusters')

@section('content')

    @component('application::components.datatable', [
        'id' => 'cluster-table',
        'actionButtons' => [
           ['name' => 'New Cluster', 'url' => url('/admin/clusters/create'),'icon' => 'fa fa-plus'],
        ],       
        'url' => url('/admin/clusters/datatable'),
        'headers' => [
            ['label' => 'ID', 'width' => '50px', 'name' => 'id', 'orderable' => false ],
            ['label' => 'Name', 'name' => 'name'],     
            ['label' => 'Lead Id', 'name' => 'lead_id', 'orderable' => false, 'searchable' => false ],
            ['label' => 'No. of Members', 'name' => 'no_members', 'orderable' => false, 'searchable' => false],                 
            ['label' => 'Actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
            
        ]
    ])
    @endcomponent


@endsection

@push('script')

@endpush