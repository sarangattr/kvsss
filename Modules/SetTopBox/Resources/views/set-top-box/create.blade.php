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

<div class="card">
    <div class="card-header">New Staff</div>
    <div class="card-body">
        <div class="container">
            @include('application::components.form', [
                'enctype' => ['multipart/form-data'],
                'form' => 'staff::staff._form',                
                'method' => 'POST',                
                'action' => ['staffs.store'],
                'result' => [],
                'container' => '12',
                'layout' => true,
                'actionControlles' => false
            ])
        </div>
    </div>
</div>
@endsection