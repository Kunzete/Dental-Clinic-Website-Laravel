<style>
    .wrap {
        width: 200px;
        /* fixed width */
        word-wrap: break-word;
        overflow-y: auto;
    }

    :root {
        --pending-color: #007bff;
        --confirmed-color: #28a745;
        --cancelled-color: #dc3545;
    }

    select{
        cursor: pointer;
        outline: none;
    }

    .status-pending {
        background-color: var(--pending-color);
        border: none;
        border-radius: 8px;
        color: white;
        padding: 4% 6%;
    }

    .status-confirmed {
        background-color: var(--confirmed-color);
        border: none;
        border-radius: 8px;
        color: white;
        padding: 4% 6%;
    }

    .status-cancelled {
        background-color: var(--cancelled-color);
        border: none;
        border-radius: 8px;
        color: white;
        padding: 4% 6%;
    }

    .status-pending option {
        background-color: white;
        color: black;
    }

    .status-confirmed option {
        background-color: white;
        color: black;
    }

    .status-cancelled option {
        background-color: white;
        color: black;
    }
</style>

@extends('dentist.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Appointments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dentist.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Appointment</li>
                    <li class="breadcrumb-item active">All</li>
                </ol>
            </nav>
        </div>
        <div class="search-bar">
            <form action="{{ route('appointment.search') }}" class="search-form d-flex align-items-center" method="GET">
                @csrf
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
    <br>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 p-2">
                @if ($appointment->isEmpty())
                    <div class="card p-5 text-center">
                        <h4>No Appointments Today! Feel free to relax 🥳🍾</h4>
                    </div>
                @else
                    <table class="table table-responsive table-hover p-4">
                        <thead>
                            <tr class="table-dark">
                                <th class="ps-4" scope="col">Name</th>
                                <th scope="col" class="pe-4">Email</th>
                                <th scope="col" class="pe-4">Number</th>
                                <th scope="col" class="pe-4">Address</th>
                                <th scope="col" class="pe-4">Time</th>
                                <th scope="col" class="pe-4">Date</th>
                                <th scope="col" class="pe-4">Status</th>
                                <th scope="col" class="pe-4">Description</th>
                            </tr>
                        </thead>
                        <tbody class="appointment-list">
                            @foreach ($appointment as $appointment)
                                <tr class="appointment" data-status="{{ $appointment->status }}">
                                    <td class="ps-4 pt-4">{{ $appointment->patient_name }}</td>
                                    <td class="pt-4 pe-4">{{ $appointment->patient_email }}</td>
                                    <td class="pt-4 pe-4">{{ $appointment->patient_number }}</td>
                                    <td class="pt-4 pe-4">{{ $appointment->patient_address }}</td>
                                    <td class="pt-4 pe-4">{{ $appointment->appointment_time }}</td>
                                    <td class="pt-4 pe-4">{{ $appointment->appointment_day }}</td>
                                    <td class="pt-4 pe-4">
                                        <select class="status-{{ $appointment->status }}"
                                            id="status-select-{{ $appointment->id }}"
                                            data-appointment-id="{{ $appointment->id }}">
                                            <option value="pending"
                                                {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="confirmed"
                                                {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                                            </option>
                                            <option value="cancelled"
                                                {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                            </option>
                                            <!-- Add more statuss as needed -->
                                        </select>
                                    </td>
                                    <td class="pt-4 wrap">{{ $appointment->description }}</td>
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
        $('select[id^="status-select-"]').on('change', function() {
            var status = $(this).val();
            var appointmentId = $(this).data('appointment-id');

            $.ajax({
                url: '{{ route('update.status') }}', // URL to handle the request
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    id: appointmentId,
                    status: status
                },
                success: function(response) {
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
    // appointments.js

    $(document).ready(function() {
        $('#filter-select').on('change', function() {
            var filterValue = $(this).val();
            filterAppointments(filterValue);
        });
    });

    function filterAppointments(filterValue) {
        $('#appointments-list .appointment').hide();
        if (filterValue === 'all') {
            $('#appointments-list .appointment').show();
        } else {
            $('#appointments-list .appointment[data-status="' + filterValue + '"]').show();
        }
    }
</script>
