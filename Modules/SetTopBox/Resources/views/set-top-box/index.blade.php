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
            ['label' => 'ID', 'width' => '50px', 'name' => 'id', 'orderable' => false ],
            ['label' => 'Name of LCO/Sub Dis/Dis', 'name' => 'lco_name' , 'orderable' => false, 'searchable' => false], 
            ['label' => 'LCO ID', 'name' => 'lco_code' , 'orderable' => false, 'searchable' => false],     
            ['label' => 'Serial No.', 'name' => 'serial_no'],
            ['label' => 'VC No.', 'name' => 'vc_no'], 
            ['label' => 'Assigned Date', 'name' => 'assign_date'],            
            ['label' => 'Status', 'name' => 'status', 'orderable' => false, 'searchable' => false],                
            ['label' => 'Actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
            
        ]
    ])
    @endcomponent


@endsection

@push('script')

@endpush