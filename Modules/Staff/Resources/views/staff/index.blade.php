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
                    <li class="breadcrumb-item active">Staff</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Staffs')

@section('content')

    @component('application::components.datatable', [
        'id' => 'staff-table',
        'actionButtons' => [
           ['name' => 'New Staff', 'url' => url('/admin/staffs/create'),'icon' => 'fa fa-plus'],
        ],       
        'url' => url('/admin/staffs/datatable'),
        'headers' => [
            ['label' => 'ID', 'width' => '50px', 'name' => 'id', 'orderable' => false ],
            ['label' => 'Name', 'name' => 'name' , 'orderable' => false, 'searchable' => false],     
            ['label' => 'Staff Id', 'name' => 'staff_id'],
            ['label' => 'Email', 'name' => 'email', 'orderable' => false, 'searchable' => false], 
            ['label' => 'Phone', 'name' => 'mobile', 'orderable' => false, 'searchable' => false], 
            ['label' => 'User Type', 'name' => 'role', 'orderable' => false, 'searchable' => false],
            ['label' => 'Date of Join', 'name' => 'date_of_join', 'orderable' => false, 'searchable' => false],           
            ['label' => 'Status', 'name' => 'status', 'orderable' => false, 'searchable' => false],                
            ['label' => 'Actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
            
        ]
    ])
    @endcomponent


@endsection

@push('script')

@endpush