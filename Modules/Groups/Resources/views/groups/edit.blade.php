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
                    <li class="breadcrumb-item active">Management</li>
                    <li class="breadcrumb-item active">Clusters</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('title','Edit Cluster')

@section('content')

<div class="card">
    <div class="card-header">Edit Cluster</div>
    <div class="card-body">
        <div class="container">
            @include('application::components.form', [
                'enctype' => ['multipart/form-data'],
                'form' => 'groups::groups.form',                
                'method' => 'PUT',                
                'action' => ['clusters.update',$id],
                'result' => $result,
                'container' => '12',
                'layout' => true,
                'actionControlles' => false
            ])
        </div>
    </div>
</div>
@endsection
