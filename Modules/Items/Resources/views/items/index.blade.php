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
                    <li class="breadcrumb-item active">Items</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Items')

@section('content')

    @component('application::components.datatable', [
        'id' => 'item-table',
        'actionButtons' => [
           ['name' => 'New Item', 'url' => url('/admin/items/create'),'icon' => 'fa fa-plus'],
        ],       
        'url' => url('/admin/items/datatable'),
        'headers' => [
            ['label' => 'ID', 'width' => '50px', 'name' => 'id', 'orderable' => false ],
            ['label' => 'Use', 'name' => 'use' , 'orderable' => false, 'searchable' => false],     
            ['label' => 'Number', 'name' => 'number'],
            ['label' => 'Model', 'name' => 'model_no'],   
            ['label' => 'Location', 'name' => 'location_no', 'orderable' => false, 'searchable' => false],           
            ['label' => 'Actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
            
        ]
    ])
    @endcomponent


@endsection

@push('script')

@endpush