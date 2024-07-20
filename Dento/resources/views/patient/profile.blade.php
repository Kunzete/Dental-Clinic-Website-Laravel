@extends('patient.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Patient Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('account.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if (!Auth::user()->image)
                            <i class="ri-account-circle-line" style="font-size: 85px"></i>
                        @else
                            <img src="{{ asset('images/profile/' . Auth::user()->image) }}" alt="Profile"
                                class="rounded-circle">
                        @endif
                        <h2>{{ Auth::user()->name }}</h2>
                        <h3>{{ Auth::user()->role }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-justified nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change password</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profilePicture">Profile
                                    Picture</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->role }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">number</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->number }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{ route('account.update') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                value="{{ Auth::user()->name }}">
                                            @error('name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="number" class="col-md-4 col-lg-3 col-form-label">Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="number" type="number"
                                                class="form-control @error('number') is-invalid @enderror" id="number"
                                                value="{{ Auth::user()->number }}">
                                            @error('number')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                value="{{ Auth::user()->email }}">
                                            @error('email')
                                                <p class="invalid-feedback">{{ $message }}😅</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade profile-change-password pt-3" id="profile-change-password">

                                <!-- Profile Edit Form -->
                                <form action="{{ route('account.updatePassword') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="currentpassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="currentPassword" type="password"
                                                class="form-control @error('currentPassword') is-invalid @enderror"
                                                id="currentpassword">
                                            @error('currentPassword')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password">
                                            @error('password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password_confirmation"
                                            class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password_confirmation" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation">
                                            @error('password_confirmation')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade profilePicture pt-3" id="profilePicture">

                                <form method="POST" action="{{ route('account.pfp') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="image" class="form-label">Profile Image</label>
                                        <input type="file" name="image" id="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary btn-sm" title="Upload new profile image"
                                                type="submit"><i class="bi bi-upload"></i> Update PFP</button>
                                        </div>
                                    </div>

                                </form>

                                <form action="{{ route('account.deletePFP') }}" method="POST">
                                    @csrf
                                    <div class="mt-2 d-grid">
                                        <button class="btn btn-danger btn-sm" title="Remove my profile image"
                                            type="submit"><i class="bi bi-trash"></i> Delete PFP</button>
                                    </div>
                                </form>

                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
