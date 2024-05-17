<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('label.document') }}</title>
</head>
<body>
    <h1>{{ trans('label.forget_password_email')}}</h1>

    {{ trans('label.reset_link')}}
    <a href="{{ route('reset.password.get', $token) }}">{{ trans('label.reset_password') }}</a>
</body>
</html>
