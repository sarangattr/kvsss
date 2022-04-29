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

<x-application::modal id="action-confirm-modal-popup-category" title="Action confirm">
    <div class="row">
        <div class="col-md-12 text-center">
            <h4>Are you sure want to delete this ?</h4>
            <div>This Category Has Sub Categories. Deleting this means all the sub categories will be deleted </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <x-application::modalActions id="action-confirm-modal-popup-submit-category" buttonLayout="danger" label="Delete"/>
        </div>
    </div>
</x-application::modal>


@endsection

@push('script')
    <script>var dataTableReRender = ""; </script>
    
    <script>dataTableReRender = "category-table";</script>
    
    <script>
        $(document).on('click', '.delete-action-confirm-category', function() {
            let href = $(this).data('href');
            $('#action-confirm-modal-popup-category').modal('show');
            $('#action-confirm-modal-popup-submit-category').attr('request-href', href);
        })

        $(document).on('click', '#action-confirm-modal-popup-submit-category', function() {
            appRequest($('#action-confirm-modal-popup-submit-category').attr('request-href'), '', 'DELETE')
            .then(res => {
                if(dataTableReRender)
                    $('#' + dataTableReRender).DataTable().draw();
                $('#action-confirm-modal-popup-category').modal('hide');
                $('#action-confirm-modal-popup-submit-category').attr('request-href', "");
                appNotification('success', 'Action status', 'Successfully deleted')
            })

        })
    </script>
@endpush