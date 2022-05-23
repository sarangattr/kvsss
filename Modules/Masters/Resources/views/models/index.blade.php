@extends('layouts.admin')

@section('breadcrumb')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <!-- <h4 class="page-title">Starter</h4> -->
            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Masters</a></li>
                    <li class="breadcrumb-item active">Models</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Models')

@section('content')

<x-masters::sideMenus
    actionButtonId="models"
    title="Model"
    modalId="model-modal"
    submitUrl="{{route('models.create')}}"
    formId="model-form"
>
    @component('application::components.datatable', [
        'id' => 'model-table',
        'hideCardLayout' => true,
        // 'actionButtons' => [
        //     ['name' => 'Add New', 'url' => url('/admin/masters/sector/create')],
        // ],
        'url' => url('/admin/masters/models/datatable'),
        'headers' => [
            ['label' => 'ID', 'width' => '50px', 'name' => 'DT_RowIndex', 'orderable' => false ,'searchable' => false ],
            ['label' => 'Name', 'name' => 'name'],
            ['label' => 'Model Id', 'name' => 'model_id'],
            ['label' => 'Brand Id', 'name' => 'brand_id'],
            ['label' => 'Status', 'name' => 'status', 'orderable' => false ,'searchable' => false],
            ['label' => 'Actions', 'name' => 'actions','orderable' => false ,'searchable' => false],
        ]
    ])
    @endcomponent
</x-masters::sideMenus>


@endsection

@push('script')

@endpush