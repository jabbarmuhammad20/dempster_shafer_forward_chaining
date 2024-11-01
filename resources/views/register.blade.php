<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../login_mhs/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../login_mhs/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../login_mhs/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../login_mhs/css/style.css">

    <title>Login</title>
</head>

<body>
    {{-- Notif Alert --}}
    @include('sweetalert::alert')
    {{-- End Notif Alert --}}
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <div class="mb-4">
                                    <h3>Register <strong></strong></h3>
                                    {{-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> --}}
                                </div>
                                <form action="daftarpasien" method="post" class="f1">
                                    {{csrf_field() }}
                                <input type="hidden" name="type" value="0">
                                    <div class="form-group first">
                                        <label for="username">name</label>
                                        <input id="name" type="name"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name"
                                            autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group first">
                                        <label for="username">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>


                                    <div class="form-group last mb-4">
                                        <label for="password">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <input type="submit" value="Log In"
                                    class="btn btn-pill text-white btn-block btn-primary">
                                <span class="d-block text-center my-4 text-muted"> <a href="/">Sudah
                                        Mendaftar ?</a></span>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="../login_mhs/js/jquery-3.3.1.min.js"></script>
    <script src="../login_mhs/js/popper.min.js"></script>
    <script src="../login_mhs/js/bootstrap.min.js"></script>
    <script src="../login_mhs/js/main.js"></script>
</body>

</html>
