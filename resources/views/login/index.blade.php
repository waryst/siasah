<!DOCTYPE html>
<html>

<head>
    <title>Membuat Background di html</title>
    <link rel="stylesheet" href="{{ asset('asset_login') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/css/adminlte.min.css">

    <script src="{{ asset('asset_login') }}/js/a81368914c.js"></script>
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>

<body>
    <div class="container">
        <div class="login-content d-flex text-center justify-content-center items-center mt-8">
            <div class=" p-4" style="border: rgb(243, 242, 245) solid 0.5px">
                <form action="{{ url('/') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-2" style="color: white;font-size: 30px;font-weight: 400">
                        Login

                    </div>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <input id="user" type="text" autocomplete="off" class="form-control" name="username"
                                placeholder="UserName">
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <input type="Password" autocomplete="off" class="form-control" name="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary col-4 float-right" value="Login" />

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>






<!DOCTYPE html>
<html>

<head>
    <title>SIGA Login Form</title>
    {{-- <link rel="stylesheet" href="{{ asset('asset_login') }}/css/style.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('asset') }}/css/adminlte.min.css"> --}}

    {{-- <script src="{{ asset('asset_login') }}/js/a81368914c.js"></script> --}}
</head>



</html>
