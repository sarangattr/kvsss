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
                        <a href="{{url('/admin/set-top-box/create')}}" id="staff-table" class="btn btn-danger mb-2"> <i class="fa fa-plus"></i> New SetTopBox</a>
                    </div>
                    <div class="col-md-3 text-end">
                        <form action="" type="GET"> 
                            <input class="form-control" type="text" placeholder ="search lco code,serial no,vc no" name="search" />
                        </form>
                    </div>
                </div> 
                <div class="table-responsive">
                <table id="staff-table-re" class="table table-striped dt-responsive nowrap w-100" style="overflow:hidden;">
                    <thead class="">
                        <tr>
                            <th>Sl No</th>
                            <th>LCO ID</th>
                            <th>Serial No</th>
                            <th>VC No</th>
                            <th>Model</th>
                            <th>Cas</th>
                            <th>Type</th>
                            <th>Supplier</th>
                            <th>Batch</th>
                            <th>Assigned Date</th>
                            <th>Activated Date</th>
                            <th>Deactivated Date</th>
                            <th>Reactivated Date</th>
                            <th>Created Date</th>
                            <th>SubDistributor Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=$data['data'] -> firstItem(); ?>
                        @foreach($data['data'] as $rec)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $rec -> lco_id }}</td>
                            <td>{{ $rec -> serial_no }}</td>
                            <td>{{ $rec -> vc_no }}</td>
                            <td>{{ $rec -> model }}</td>
                            <td>{{ $rec -> cas }}</td>
                            <td>{{ $rec -> stb_type }}</td>
                            <td>{{ $rec -> supplier }}</td>
                            <td>{{ $rec -> batch }}</td>
                            <td>{{ $rec -> assign_date }}</td>
                            <td>{{ $rec -> activ_date }}</td>
                            <td>{{ $rec -> deact_date }}</td>
                            <td>{{ $rec -> react_date }}</td>
                            <td>{{ $rec -> create_date }}</td>
                            <td>{{ $rec -> subdistributor_code }}</td>
                            <td>{!! $rec -> status !!}</td>
                            <td>{!! $rec -> actions !!}</td>
                        </tr>
                        <?php $i=$i+1; ?>
                        @endforeach
                    </tbody>
                </table>
                </div>

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