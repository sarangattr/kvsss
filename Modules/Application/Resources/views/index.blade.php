@extends('layouts.admin')
@section('breadcrumb')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <!-- <h4 class="page-title">Starter</h4> -->
            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li> -->
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','dashboard')