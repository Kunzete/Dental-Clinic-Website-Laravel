@extends('admin.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Dentist</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item">Dentist</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div>
        <div class="search-bar">
            <form action="{{route('doctor.search')}}" class="search-form d-flex align-items-center" method="GET">
                @csrf <!-- This line generates a CSRF token for security (recommended for forms in Laravel) -->
                <input type="search" class="form-control" placeholder="Search" name="search">
            </form>
        </div><!-- End Search Bar -->
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

            <div class="col-lg-12 p-2">
                @if ($doctors->isEmpty())
                    <div class="card p-5 text-center">
                        <h4>No Dentist Found</h4>
                    </div>
                @else
                    <table class="table table-responsive table-hover p-4">
                        <thead>
                            <tr class="table-dark">
                                <th class="ps-4" scope="col">Dentist Name</th>
                                <th scope="col">Dentist Email</th>
                                <th scope="col">Dentist Number</th>
                                <th scope="col">Dentist Role</th>
                                <th scope="col">Profile Picture</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <td class="ps-4 pt-4">{{ $doctor->name }}</td>
                                    <td class="pt-4">{{ $doctor->email }}</td>
                                    <td class="pt-4">{{ $doctor->number }}</td>
                                    <td class="pt-4 pe-5">
                                        <select class="form-select" id="role-select-{{ $doctor->id }}"
                                            data-doctor-id="{{ $doctor->id }}">
                                            <option selected disabled>Dentist</option>
                                            <option value="patient" {{ $doctor->role == 'patient' ? 'selected' : '' }}>
                                                Patient
                                            </option>
                                            <option value="admin" {{ $doctor->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <!-- Add more roles as needed -->
                                        </select>
                                    </td>
                                    <td>
                                        @if (!$doctor->image)
                                            <i class="ri-account-circle-line" style="font-size: 75px; margin-top:0px;"></i>
                                        @else
                                            <img src="{{ asset('images/profile/' . $doctor->image) }}" alt="Profile"
                                                class="border outline-dark rounded-circle" width="80px"
                                                style="aspect-ration:3/2; object-fit: cover; ">
                                        @endif
                                    </td>
                                    <td class="d-grid py-4 pe-4">
                                        <a class="btn btn-primary my-2"
                                            href="{{ route('doctor.edit', $doctor->id) }}">Edit</a>
                                        <!-- Your Blade template -->
                                        <form method="POST" action="{{ route('doctor.destroy', $doctor->id) }}"
                                            class="d-grid">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                Delete
                                            </button>
                                        </form>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('select[id^="role-select-"]').on('change', function() {
            var role = $(this).val();
            var doctorId = $(this).data('doctor-id');

            $.ajax({
                url: '{{ route('doctor.update.role') }}', // URL to handle the request
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    id: doctorId,
                    role: role
                },
                success: function(response) {
                    alert(response.message);
                    // Optionally, you can do more actions here, like updating the UI
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                    console.log('Status:', status);
                    console.log('Error:', error);
                    console.log('Response:', xhr.responseText);
                }
            });
        });
    });
</script>
