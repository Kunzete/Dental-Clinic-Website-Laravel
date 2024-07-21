<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DentoSite - Login</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light" style="height: 100vh">
    <div class="container col-md-4 d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="card py-5 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="mb-0">
                        <h4 class="text-center">Change Password</h4>
                    </div>
                    <hr>
                </div>
            </div>
            <form action="{{route('account.change-password', $email)}}" method="POST">
                @csrf
                <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                        <h5>Enter your new password below.</h5>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="{{$email}}" hidden>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="password">
                            @error('password')
                                <span class="text-danger">Please enter a secure password.</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Change Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
