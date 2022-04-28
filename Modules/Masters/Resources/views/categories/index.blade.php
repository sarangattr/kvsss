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
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Categories')

@section('content')

<x-masters::sideMenus
    actionButtonId="categories"
    title="Category"
    modalId="category-modal"
    submitUrl="{{route('categories.create')}}"
    formId="category-form"
>
    @component('application::components.datatable', [
        'id' => 'category-table',
        'hideCardLayout' => true,
        // 'actionButtons' => [
        //     ['name' => 'Add New', 'url' => url('/admin/masters/sector/create')],
        // ],
        'url' => url('/admin/masters/categories/datatable'),
        'headers' => [
            ['label' => 'ID', 'width' => '50px', 'name' => 'DT_RowIndex', 'orderable' => false ,'searchable' => false ],
            ['label' => 'Name', 'name' => 'name'],
            ['label' => 'Description', 'name' => 'description', 'orderable' => false ,'searchable' => false],
            ['label' => 'Parent Category', 'name' => 'parent_category', 'orderable' => false ,'searchable' => false],
            ['label' => 'Status', 'name' => 'status', 'orderable' => false ,'searchable' => false],
            ['label' => 'Actions', 'name' => 'actions','orderable' => false ,'searchable' => false],
        ]
    ])
    @endcomponent
</x-masters::sideMenus>
<x-application::modal id="category-modal" title="Category" actionButtonName="Submit" actionButtontype="submit">
    <x-application::ajaxForm method="POST" action="categories.store" id="category-form" ajaxSubmit>
        <div class="row mt-2">
            <div class="col-md-12">
                <x-application::formLabel name="name" label="Name" required/>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category name', 'required', 'maximumLength' => 100, 'minimumLength' => 2]) !!}
                <x-application::validationError name="name" />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <x-application::formLabel name="description" label="Description"/>
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Category Description']) !!}
                <x-application::validationError name="description" />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <x-application::formLabel name="parent_category" label="Parent Category"/>
                <select class="form-control" name="parent_id">
                    <option value="">- None -</option>
                    @include('masters::categories._categories-hirearchy', ['categories' => $parent, 'dashes'=> '', 'id' => isset($result->parent_id) ? $result->parent_id : null])
                </select>
                <x-application::validationError name="parent_category" />
            </div>
        </div>
        <x-application::modalActions type="submit" label="Submit"/>
    </x-application::ajaxForm>
</x-application::modal>

@endsection