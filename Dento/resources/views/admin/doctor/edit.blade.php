@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Dentist</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><a href="{{route('doctor.list')}}">Dentist</a></li>
                <li class="breadcrumb-item active">Edit</li>
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

            <div class="col-lg-8">
                <div class="row">
                    <div class="card p-5" style="height: 70vh">
                        <h3 class="text-center">Dentist Profile</h3>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <h4><b>Dentist Name:</b> {{$d->name}}</h4>
                        </div><br>
                        <div class="col-md-12">
                            <h4><b>Dentist Email:</b> {{$d->email}}</h4>
                        </div><br>
                        <div class="col-md-12">
                            <h4><b>Dentist Number:</b> {{$d->number}}</h4>
                        </div><br>
                        <div class="col-md-12">
                            <h4><b>User Image:</b></h4>
                            @if (!$d->image)
                                <i class="ri-account-circle-line" style="font-size: 80px"></i>
                            @else
                            <img src="{{ asset('images/profile/' . $d->image) }}" alt="Profile" width="100px" class="rounded-circle border outline-dark">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-5">
                    <form action="{{ route('doctor.update', $d->id) }}" method="POST">
                        @csrf
                        <h4 class="text-dark text-center">Edit Dentist</h4>
                        <div class="row g-4">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <label for="name" class="form-label">Dentist Name</label>
                                <input type="text" id="name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $d->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Dentist Email</label>
                                <input type="text" id="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $d->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="number" class="form-label">Dentist Number</label>
                                <input type="text" id="number"
                                    class="form-control @error('number') is-invalid @enderror" name="number"
                                    value="{{ $d->number }}">
                                @error('number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 d-grid">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
