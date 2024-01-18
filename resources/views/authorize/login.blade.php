<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | صفحه ورود</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('.styleSheets.styleSheets')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>ورود به سایت</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

            <form action="{{route('users.login')}}" method="post">
                @csrf
                @if ($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="ایمیل"
                           name="email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" required placeholder="رمز عبور"
                           name="password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa-solid fa-fingerprint"></i>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input name="rememberMe" type="checkbox"> یاد آوری من
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                    </div>
                </div>
            </form>
{{--            <div class="button-box">--}}
{{--                <button type="submit">عضویت</button>--}}
{{--                <a href="{{route('provider.login',['provider'=>'google'])}}" class="btn btn-primary">--}}
{{--                <i class="sli sli-social-google"></i>--}}
{{--                    ایجاد اکانت با گوگل--}}
{{--                </a>--}}
{{--            </div>--}}

            <div class="social-auth-links text-center mb-3">
                <p>- یا -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fa-brands fa-facebook fa-lg"></i> ورود با اکانت فیسوبک
                </a>
                <a href="{{route('provider.login',['provider'=>'google'])}}" class="btn btn-block btn-danger">
                    <i class="fa-brands fa-google"></i> ورود با اکانت گوگل
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="#">رمز عبورم را فراموش کرده ام.</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">ثبت نام</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass   : 'iradio_square-blue',
            increaseArea : '20%' // optional
        })
    })
</script>
</body>
</html>
