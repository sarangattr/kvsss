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
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Brands')

@section('content')

<x-masters::sideMenus
    actionButtonId="brands"
    title="Brands"
    modalId="brand-modal"
    submitUrl="{{route('brands.create')}}"
    formId="brand-form"
>
    @component('application::components.datatable', [
        'id' => 'brand-table',
        'hideCardLayout' => true,
        // 'actionButtons' => [
        //     ['name' => 'Add New', 'url' => url('/admin/masters/sector/create')],
        // ],
        'url' => url('/admin/masters/brands/datatable'),
        'headers' => [
            ['label' => 'ID', 'width' => '50px', 'name' => 'DT_RowIndex', 'orderable' => false ,'searchable' => false ],
            ['label' => 'Name', 'name' => 'name'],
            ['label' => 'Description', 'name' => 'description', 'orderable' => false ,'searchable' => false],
            ['label' => 'Status', 'name' => 'status', 'orderable' => false ,'searchable' => false],
            ['label' => 'Actions', 'name' => 'actions','orderable' => false ,'searchable' => false],
        ]
    ])
    @endcomponent
</x-masters::sideMenus>


@endsection

@push('script')

@endpush