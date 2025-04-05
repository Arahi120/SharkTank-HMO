@extends('layouts.panel')

@section('title','Inicio')

@section('comment')

<h1 class="mt-4">Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Posts</div>
                        <a class="small text-white stretched-link" href="{{ route('post.index') }}">View Details</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small stretched-link text-primary" href="{{ route('post.index') }}">View Details</a>
                <div class="small text-gray-600"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Offers</div>
                        <a class="small text-white stretched-link" href="{{ route('offer.index') }}">View Details</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small stretched-link text-warning" href="{{ route('offer.index') }}">View Details</a>
                <div class="small text-gray-600"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Comments</div>
                        <a class="small text-white stretched-link" href="{{ route('comment.index') }}">View Details</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small stretched-link text-success" href="{{ route('comment.index') }}">View Details</a>
                <div class="small text-gray-600"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Labels</div>
                        <a class="small text-white stretched-link" href="{{ route('label.index') }}">View Details</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small stretched-link text-danger" href="{{ route('label.index') }}">View Details</a>
                <div class="small text-gray-600"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Investors</div>
                        <a class="small text-white stretched-link" href="{{ route('investor.index') }}">View Details</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small stretched-link text-danger" href="{{ route('investor.index') }}">View Details</a>
                <div class="small text-gray-600"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Users</div>
                        <a class="small text-white stretched-link" href="{{ route('user.index') }}">View Details</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small stretched-link text-danger" href="{{ route('user.index') }}">View Details</a>
                <div class="small text-gray-600"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
@endsection
