@extends('admin.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Admins</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Admins</li>
                </ol>
            </nav>
        </div>
        <div class="search-bar">
            <form action="{{ route('admin.search') }}" class="search-form d-flex align-items-center" method="GET">
                @csrf <!-- This line generates a CSRF token for security (recommended for forms in Laravel) -->
                <input type="search" class="form-control" placeholder="Search" name="search">
            </form>
        </div><!-- End Search Bar -->
    </div>
    <br>
    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12 p-2">
                @if ($admins->isEmpty())
                    <div class="card p-5 text-center">
                        <h4>Admins Not Found</h4>
                    </div>
                @else
                    <table class="table table-responsive table-hover p-4">
                        <thead>
                            <tr class="table-dark">
                                <th class="ps-4" scope="col">Admin Name</th>
                                <th scope="col">Admin Email</th>
                                <th scope="col">Admin Number</th>
                                <th scope="col">Profile Picture</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td class="ps-4 pt-4">{{ $admin->name }}</td>
                                    <td class="pt-4">{{ $admin->email }}</td>
                                    <td class="pt-4">{{ $admin->number }}</td>
                                    <td>
                                        @if (!$admin->image)
                                            <i class="ri-account-circle-line" style="font-size: 75px; margin-top:0px;"></i>
                                        @else
                                            <img src="{{ asset('images/profile/' . $admin->image) }}" alt="Profile"
                                                class="border outline-dark rounded-circle" width="80px"
                                                style="aspect-ration:3/2; object-fit: cover; ">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </section>
@endsection
