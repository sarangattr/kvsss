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
                    <li class="breadcrumb-item active">Tags</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Tags')

@section('content')

@include('application::components.form', [
    'form' => 'masters::tags._form',
    'method' => 'POST',
    'action' => ['tags.store'],
    'result' => [],
    'container' => '12',
    'actionControlles' => false,
])
@endsection