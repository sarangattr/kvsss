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

<x-application::newActionConfirmModal
    actionAttribute=".delete-action-confirm"
    actionConfirmButtonlabel="Delete"
    defaultMesage="Are you sure want to delete this?"
    description=""
    center
    reRenderDataTableId="staff-table-re"
    primaryButtonLayout="danger"
/>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <a href="{{url('/admin/staffs/create')}}" id="staff-table" class="btn btn-danger mb-2"> <i class="fa fa-plus"></i> New Staff</a>
                    </div>
                    <div class="col-md-3 text-end">
                        <form action="" type="GET"> 
                            <input class="form-control" type="text" placeholder ="search lco code,name" name="search" />
                        </form>
                    </div>
                </div> 

                <table id="staff-table-re" class="table table-striped dt-responsive nowrap w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Staff Code</th>
                            <th>Staff Role</th>
                            <th>Mobile</th>
                            <th>Date of Join</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=$data['data'] -> firstItem(); ?>
                        @foreach($data['data'] as $rec)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $rec -> name }}</td>
                            <td>{{ $rec -> lco_code }}</td>
                            <td>{{ $rec -> user_type }}</td>
                            <td>{{ $rec -> mobile }}</td>
                            <td>{{ $rec -> date_of_join }}</td>
                            <td>{!! $rec -> status !!}</td>
                            <td>{!! $rec -> actions !!}</td>
                        </tr>
                        <?php $i=$i+1; ?>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-6">showing {{ $data['data'] -> firstItem() }} to {{ $data['data'] -> lastItem() }} of {{ $data['data'] -> total() }} results</div>
                    <div class="col-md-6" style="float:right">{{ $data['data']-> links("pagination::bootstrap-4") }}</div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@push('styles')

@endpush

@push('script')

@endpush