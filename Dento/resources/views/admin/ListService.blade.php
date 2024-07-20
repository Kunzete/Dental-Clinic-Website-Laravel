@extends('admin.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Services</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Service</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div>
    </div>
    <br>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 p-2">
                @if ($service->isEmpty())
                    <div class="card p-5 text-center">
                        <h4>Services Not Available</h4>
                    </div>
                @else
                    <table class="table table-responsive table-hover p-4">
                        <thead>
                            <tr class="table-dark">
                                <th class="ps-4" scope="col">Service Name</th>
                                <th scope="col">Service Stage</th>
                                <th scope="col">Service Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service as $service)
                                <tr>
                                    <td class="ps-4 pt-4">{{ $service->name }}</td>
                                    <td class="pt-4">{{ $service->stage }}</td>
                                    <td class="pt-4">{{ $service->price }} PKR</td>
                                    {{-- <td class="d-grid py-4 pe-4">
                                        <a class="btn btn-primary my-2"
                                            href="{{ route('service.edit', $service->id) }}">Edit</a>
                                        <!-- Your Blade template -->
                                        <form method="POST" action="{{ route('service.destroy', $service->id) }}"
                                            class="d-grid">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </section>
@endsection
