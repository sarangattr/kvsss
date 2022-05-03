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
                    <li class="breadcrumb-item active">Set Top Box</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Set Top Box')

@section('content')

<div class="card">
    <div class="card-header">New Set Top Box</div>
    <div class="card-body">
        <div class="container">
            @include('application::components.form', [
                'enctype' => ['multipart/form-data'],
                'form' => 'settopbox::set-top-box._form',                
                'method' => 'POST',                
                'action' => ['set-top-box.store'],
                'result' => [],
                'container' => '12',
                'layout' => true,
                'actionControlles' => false
            ])
        </div>
    </div>
</div>
@endsection