<style>
    .card-stats {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-stats.card-body {
        padding: 1.5rem;
    }

    .card-stats.card-body.card-title {
        font-size: 0.9rem;
    }

    .card-stats.card-body span.h2 {
        font-size: 1.5rem;
    }

    .card-stats.card-footer {
        background-color: #f7f7f7;
        padding: 1rem;
        border-top: 1px solid #ddd;
    }

    .card-stats .card-footer .icon {
        font-size: 1.5rem;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

    .bg-orange {
        background-color: #ffa07a;
    }

    .bg-red {
        background-color: #ff69b4;
    }

    .bg-green {
        background-color: #34c759;
    }

    .bg-blue {
        background-color: #87ceeb;
    }

    .bg-emerald{
        background-color: #87ebc8;
    }
</style>

@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Users</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $users }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="#" class="small text-muted">View Details</a>
                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Admin</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $admins }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="{{route('admin.list')}}" class="small text-muted">View Details</a>
                        <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Doctor</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $doctors }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="{{route('doctor.list')}}" class="small text-muted">View Details</a>
                        <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Patient</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $patients }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="{{route('patient.list')}}" class="small text-muted">View Details</a>
                        <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                            <i class="fas fa-user-injured"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Services</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $services }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="{{route('service.list')}}" class="small text-muted">View Details</a>
                        <div class="icon icon-shape bg-emerald text-white rounded-circle shadow">
                            <i class="fa fa-hospital"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
