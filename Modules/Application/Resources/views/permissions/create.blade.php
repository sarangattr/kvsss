@extends('application::layouts.master')
@section('title', 'Create Permission')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <!-- <h4 class="page-title">Starter</h4> -->
            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Permissions</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

    @include('application::components.form', [
        'form' => 'application::permissions._form',
        'method' => 'POST',
        'action' => ['permissions.store'],
        'result' => [],
        'container' => '12',
        'layout' => true,
        'type' => 'create',
        'actionControlles' => false
    ])

@endsection