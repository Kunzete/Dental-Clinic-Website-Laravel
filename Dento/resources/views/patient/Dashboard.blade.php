<style>
    .form {
        padding: 5% 0px;
    }


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

    .bg-emerald {
        background-color: #87ebc8;
    }
</style>


@extends('patient.layouts.app')

@section('content')
    @if (Session::has('success'))
        <script>
            alert("{{ Session::get('success') }}");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            alert("{{ Session::get('error') }}");
        </script>
    @endif
    <div class="pagetitle">
        <h1>Patient Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('account.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Appointments</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $all }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-end">
                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                            <i class="fas fa-calendar-check"></i> <!-- calendar-check icon for appointments -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Pending</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $pending }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-end">
                        <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                            <i class="fas fa-clock"></i> <!-- clock icon for pending -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Confirmed</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $confirmed }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-end">
                        <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                            <i class="fas fa-check-circle"></i> <!-- check-circle icon for confirmed -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-muted mb-0">Cancelled</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $cancelled }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-end">
                        <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                            <i class="fas fa-ban"></i> <!-- ban icon for cancelled -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-3">

            <!-- Left side columns -->
            <div class="col-md-7">
                <div class="card py-2 px-0">
                    @if ($table_all->isEmpty())
                        <div class="card p-5 text-center">
                            <h4>No Appointments Today! Feel free to relax 🥳🍾</h4>
                        </div>
                    @else
                        <table class="table table-responsive table-hover p-4">
                            <thead>
                                <tr class="">
                                    <th scope="col" class="ps-2">Doctor</th>
                                    <th scope="col" class="ps-2">Time</th>
                                    <th scope="col" class="ps-2">Date</th>
                                    <th scope="col" class="ps-2">Status</th>
                                    <th scope="col" class="ps-2">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table_all as $appointment)
                                    @php
                                        $doctor = $doctors->where('id', $appointment->doctor_id)->first();
                                    @endphp
                                    <tr>
                                        <td class="py-3 ps-2">{{ $doctor->name }}</td>
                                        <td class="py-3 ps-2">{{ $appointment->appointment_time }}</td>
                                        <td class="py-3 ps-2">{{ $appointment->appointment_day }}</td>
                                        <td class="py-3 ps-2">
                                            <span style="width:100px;"
                                                class="btn btn-{{ $appointment->status === 'pending' ? 'primary' : ($appointment->status === 'confirmed' ? 'success' : 'danger') }}">{{ $appointment->status }}</span>
                                        </td>
                                        <td class="py-3 ps-2" style="width:200px;">
                                            {{ $appointment->description === null ? 'No description available' : $appointment->description }}
                                        </td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <!-- Right side columns -->
            <div class="col-md-5">
                <div class="card py-4 px-4">
                    <h4 class="text-center">Book Appointment</h4>
                    <hr>
                    <div class="form">
                        <form action="{{ route('account.appointment') }}" method="POST">
                            @csrf
                            <div class="col-md-12">

                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control shadow-none"
                                    value="{{ Auth::user()->name }}">
                                <br>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control shadow-none"
                                    value="{{ Auth::user()->email }}">
                                <br>
                                <label for="number" class="form-label">Number</label>
                                <input type="number" id="number" name="number" class="form-control shadow-none"
                                    value="{{ Auth::user()->number }}">
                                <br>
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" name="address" class="form-control shadow-none">

                                <br>
                                <select name="time" class="form-select shadow-none @error('time') is-invalid @enderror">
                                    <option disabled selected>Choose Your Schedule</option>
                                    <option value="9AM-10AM">9 AM to 10 AM</option>
                                    <option value="11AM-12PM">11 AM to 12 PM</option>
                                    <option value="2PM-4PM">2 PM to 4 PM</option>
                                    <option value="8PM-10PM">8 PM to 10 PM</option>
                                </select>
                                @error('time')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        select time *</span>
                                @enderror

                                <br>
                                <select name="day" class="form-select shadow-none @error('day') is-invalid @enderror">
                                    <option disabled selected>Choose Your Schedule</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                                @error('day')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Please
                                        select day *</span>
                                @enderror

                                <br>
                                <select name="doctor" style="width: 100%"
                                    class="form-select shadow-none @error('doctor') is-invalid @enderror">
                                    <option disabled selected>Choose Your Doctor</option>
                                    @foreach ($d as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor')
                                    <span
                                        style="color:#00AEEF; font-weight:500; font-family: Montserrat, Sans-serif; font-size:14px">Not
                                        selecting a Doctor? Well who are you booking?</span>
                                @enderror

                                <br>
                                <div class="col-lg">
                                    <textarea class="form-control shadow-none" name="description" placeholder="Your Message"></textarea>
                                </div>

                                <br>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
