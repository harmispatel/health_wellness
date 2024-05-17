<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('label.admin') }}</title>
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('public/assets/frontend/css/bootstrap/bootstrap.min.css') }}">

    {{-- Font Awesome CSS --}}
    <link rel="stylesheet" href="{{ asset('public/assets/frontend/css/font-awesome/css/all.css') }}">

    {{-- Admin Login CSS --}}
    <link rel="stylesheet" href="{{ asset('public/assets/admin/css/admin_users/admin.css') }}">

    {{-- Font Style --}}
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="{{ asset('public/assets/admin/css/toastr/toastr.min.css') }}">

</head>
<body class="login">

    <form class="form-login" method="post" action="{{ route('admin.do.login') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 text-center">
                <img alt="logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDOLfmIA4IGukHskftrTRSelu-K73Xu9drKw&usqp=CAU" class="theme-logo">
                <h4 class="mt-2">{{ trans('label.admin') }}</h4>
            </div>
            @if (session()->has('message'))
            <div class="col-md-12 mt-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message')  }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
            @if (session()->has('error'))
                <div class="col-md-12 mt-4">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error')  }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="col-md-12 mt-3">
                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">{{ trans('label.enter_your_email_address')}}</label>
                    <div class="input-group">
                        <input type="text" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
                {{-- Password --}}
                <div class="form-group mt-3">
                    <label for="password" class="form-label">{{ trans('label.enter_your_password') }}</label>
                    <div class="input-group">
                        <input type="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" name="password" id="password" placeholder="Password">
                        <span class="input-group-text" onclick="ShowHidePassword()" id="passIcon">
                            <i class="fa fa-eye-slash"></i>
                        </span>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <button class="btn btn-gradient-dark w-100 btn-rounded"> {{ trans('label.signin') }}</button>
                </div>
            </div>
            <div class="col-md-12 mt-4 text-center">
                <div class="form-group forget-pass">
                    <a href="{{ route('forget.password.get') }}">{{ trans('label.forget_password')}}</a>
                </div>
            </div>
        </div>
    </form>

    {{-- Jquery --}}
    <script src="{{ asset('public/assets/admin/js/jquery/jquery.min.js') }}"></script>

    {{-- Popper JS --}}
    <script src="{{ asset('public/assets/frontend/js/popper/popper.min.js') }}"></script>

    {{-- Bootstarp JS --}}
    <script src="{{ asset('public/assets/frontend/js/bootstrap/bootstrap.min.js') }}"></script>

    {{-- Toastr --}}
    <script src="{{ asset('public/assets/admin/js/toastr/toastr.min.js') }}"></script>

    <script type="text/javascript">

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            timeOut: 10000
        }

        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}')
        @endif

        // Error Mesages
        var msg_arr = "{{ (Session::has('errors')) ? session('errors') : '' }}";
        if(msg_arr){
            var newArr = JSON.parse(msg_arr.replace(/&quot;/g,'"'));
            Object.values(newArr).forEach(val => {
                @if(Session::has('errors'))
                    toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true,
                        timeOut: 10000,
                    }
                    toastr.error(val);
                @endif
            });
            // End Error Messages
        }

        // Show & Hide Password
        function ShowHidePassword()
        {
            var currentType = $('#password').attr('type');

            if(currentType == 'password')
            {
                $('#password').attr('type','text');
                $('#passIcon').html('');
                $('#passIcon').append('<i class="fa fa-eye"></i>');
            }
            else
            {
                $('#password').attr('type','password');
                $('#passIcon').html('');
                $('#passIcon').append('<i class="fa fa-eye-slash"></i>');
            }
        }
    </script>

</body>
</html>
