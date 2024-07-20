@extends('admin.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Patient</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Patients</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div>
        <div class="search-bar">
            <form action="{{ route('patient.search') }}" class="search-form d-flex align-items-center" method="GET">
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
                @if ($patients->isEmpty())
                    <div class="card p-5 text-center">
                        <h4>Patients Not Found</h4>
                    </div>
                @else
                    <table class="table table-responsive table-hover p-4">
                        <thead>
                            <tr class="table-dark">
                                <th class="ps-4" scope="col">Patient Name</th>
                                <th scope="col">Patient Email</th>
                                <th scope="col">Patient Number</th>
                                <th scope="col">Patient Role</th>
                                <th scope="col">Profile Picture</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td class="ps-4 pt-4">{{ $patient->name }}</td>
                                    <td class="pt-4">{{ $patient->email }}</td>
                                    <td class="pt-4">{{ $patient->number }}</td>
                                    <td class="pt-4 pe-5">
                                        <select class="form-select" id="role-select-{{ $patient->id }}"
                                            data-patient-id="{{ $patient->id }}">
                                            <option selected disabled>{{ $patient->role }}</option>
                                            <option value="doctor" {{ $patient->role == 'doctor' ? 'selected' : '' }}>
                                                Doctor
                                            </option>
                                            <option value="admin" {{ $patient->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <!-- Add more roles as needed -->
                                        </select>
                                    </td>
                                    <td>
                                        @if (!$patient->image)
                                            <i class="ri-account-circle-line" style="font-size: 75px; margin-top:0px;"></i>
                                        @else
                                            <img src="{{ asset('images/profile/' . $patient->image) }}" alt="Profile"
                                                class="border outline-dark rounded-circle" width="80px"
                                                style="aspect-ration:3/2; object-fit: cover; ">
                                        @endif
                                    </td>
                                    <td class="d-grid py-4 pe-4">
                                        <a class="btn btn-primary my-2"
                                            href="{{ route('patient.edit', $patient->id) }}">Edit</a>
                                        <!-- Your Blade template -->
                                        <form method="POST" action="{{ route('patient.destroy', $patient->id) }}"
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
            var patientId = $(this).data('patient-id');

            $.ajax({
                url: '{{ route('update.role') }}', // URL to handle the request
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    id: patientId,
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
