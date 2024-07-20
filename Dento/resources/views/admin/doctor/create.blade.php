@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Doctor</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Doctors</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    <br>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show col-lg-12">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show col-lg-12">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-5">
                    <div class="row">
                        <form action="{{route('doctor.createDoctor')}}" method="POST">
                            @csrf
                            <h2 class="text-center">Create Doctor</h3>
                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="d-grid">
                                <button class="btn btn-primary">Create Doctor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
