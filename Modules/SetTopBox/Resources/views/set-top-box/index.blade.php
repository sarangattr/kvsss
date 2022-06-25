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
                    <li class="breadcrumb-item active">Set Top Boxes</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Set Top Box')

@section('content')

    @component('application::components.datatable', [
        'id' => 'settopbox-table',
        'actionButtons' => [
           ['name' => 'New Set Top Box', 'url' => url('/admin/set-top-box/create'),'icon' => 'fa fa-plus'],
        ],       
        'url' => url('/admin/set-top-box/datatable'),
        'headers' => [
            ['label' => 'ID', 'width' => '50px', 'name' => 'DT_RowIndex', 'orderable' => false ,'searchable' => false ],
            ['label' => 'LCO ID', 'name' => 'lco_id'],     
            ['label' => 'Serial No.', 'name' => 'serial_no'],
            ['label' => 'VC No.', 'name' => 'vc_no'],
            ['label' => 'Model', 'name' => 'model'],
            ['label' => 'Cas', 'name' => 'cas'],
            ['label' => 'Type', 'name' => 'stb_type'],
            ['label' => 'Supplier', 'name' => 'supplier'],
            ['label' => 'Batch', 'name' => 'batch'], 
            ['label' => 'Assigned Date', 'name' => 'assign_date'],
            ['label' => 'Activated Date', 'name' => 'activ_date'],
            ['label' => 'Deactivated Date', 'name' => 'deact_date'],
            ['label' => 'Reactivated Date', 'name' => 'react_date'],
            ['label' => 'Created Date', 'name' => 'create_date'],
            ['label' => 'SubDistributor Code', 'name' => 'subdistributor_code'],            
            ['label' => 'Status', 'name' => 'status', 'orderable' => false, 'searchable' => false],                
            ['label' => 'Actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
            
        ]
    ])
    @endcomponent


@endsection

@push('script')

@endpush