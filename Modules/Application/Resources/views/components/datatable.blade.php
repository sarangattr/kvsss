@php
    $dataTableId = isset($id) ? $id : rand(); 
    $url = isset($url) ? $url : '';
@endphp


@if(! $url)
    <div class="row justify-content-center">
        <div class="col-md-6">
            @component('application::components.alert', ['type' => 'danger'])
                Error: Datatable fetch url is missing. Please check the component proprties
            @endcomponent
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @component('application::components.display-code')
                <code>
                    <span>@</span>component('application::components.datatable', [
                    <div class="ms-2">
                        <div>'id' => 'user-table',</div>
                        <div>'url' => url('/admin/users/datatable'),</div>
                        <div>'headers' => [</div>
                        <div class="ms-3">
                            <div>['label' => 'ID', 'width' => '50px', 'name' => 'id', 'orderable' => false ],</div>
                            <div>['label' => 'Full name', 'name' => 'id'],</div>
                            <div>['label' => 'Email', 'name' => 'id'],</div>
                            <div>['label' => 'Mobile', 'name' => 'id'],</div>
                            <div>['label' => 'Role', 'name' => 'id'],</div>
                            <div>['label' => 'Last login', 'name' => 'id'],</div>
                            <div>['label' => 'Created at', 'name' => 'id'],</div>
                            <div>['label' => 'Status', 'name' => 'id'],</div>
                            <div>['label' => 'Actions', 'name' => 'id']</div>
                        </div>
                        ]
                    </div>
                    <div>])</div>
                    <div><span>@</span>endcomponent</div>
                </code>
                <div class="mt-2 text-muted text-end">Component version: {{componentVersion()}}</div>
            @endcomponent
        </div>
    </div>
    @php return ; @endphp
@endif

@if(! isset($hideCardLayout))
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
@endif
                @if(isset($actionButtons))
                    @foreach ($actionButtons as $item)
                        <a href="{{$item['url']}}" id="{{$item['id'] ?? rand()}}" class="btn btn-danger mb-3">@if(isset($item['icon'])) <i class="{{$item['icon']}}"></i> @endif {{$item['name']}}</a>
                    @endforeach
                @endif
                <table id="{{$dataTableId}}" class="table table-hover m-0 table-centered dt-responsive nowrap w-100" cellspacing="0" id="tickets-table">
                    <thead class="bg-light">
                        <tr>
                            @if(isset($headers))
                                @foreach ($headers as $item)
                                    <th style="{{isset($item['width']) ? 'width:' . $item['width'] : ''}}" class="fw-medium">{{$item['label']}}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody class="font-14"></tbody>
                </table>
                @if(! isset($hideCardLayout))
            </div>
        </div> 
    </div>
</div>
@endif
<input type="hidden" id="{{$id}}-table-value-name-fileds" value="{{json_encode($headers)}}" />
<x-application::actionConfirmModal
    actionAttribute=".delete-action-confirm"
    actionConfirmButtonlabel="Delete"
    defaultMesage="Are you sure want to delete this?"
    description=""
    center
    reRenderDataTableId="{{$dataTableId}}"
    primaryButtonLayout="danger"
/>
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
   
    
@endpush

@push('script')
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>

    <script>
        $(document).ready(function() {

            let headerValueFields = JSON.parse($('#{{$id}}-table-value-name-fileds').val());
            let DataTableColumns = [];
            for (let i = 0; i < headerValueFields.length; i++) {
                const el = headerValueFields[i];
                DataTableColumns.push({ data: el.data ? el.data : el.name, name: el.name, orderable: el.orderable ?? true, searchable: el.searchable ?? true })
            }
            $('#{{$dataTableId}}').dataTable({
                iDisplayLength: 10,
                serverSide: true,
                processing: true,
                keys: !0,
                select: {
                    style: "multi"
                },
                pagingType: 'full_numbers',
                language: {
                    processing: "Please wait....",
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                "order": [
                    [0, "DESC"]
                ],
                responsive      : true,
                ajax: {
                    url: "{{$url}}",
                    dataType: "json",
                    type: "POST",
                    data: function (d) {
                        d._token = $('input[name=_token]').val();
                        d.status = $('select[name=category_status]').val()
                        d.createdBy = $('select[name=category_created_by]').val()
                        d.createdAt = $('input[name=category_created_at]').val()
                    }
                },
                createdRow: function (row, data, index) {

                },
                initComplete: function (settings, json) {

                },
                drawCallback: function () {

                },
                columns: DataTableColumns
            })
        })
    </script>
@endpush
