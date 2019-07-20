<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>来了老弟</title>
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
<div class="lowin">
    <div class="lowin-brand">
        <img src="{{asset('images/kodinger.jpg')}}" alt="logo">
    </div>
    <div class="lowin-wrapper">
        <div class="lowin-box lowin-login">
            <div class="lowin-box-inner">
                <form action="{{route('admin.reset_action')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{$token}}">
                    <p>欢迎回来</p>
                    @include('_shared.error')
                    @include('_shared.message')
                    <div class="lowin-group">
                        <label>请输入新密码 </label>
                        <input type="password" name="password"  class="lowin-input" >
                    </div>
                    <div class="lowin-group password-group">
                        <label>请确认密码 </label>
                        <input type="password" name="confirm_password"  class="lowin-input" >
                    </div>
                    <button class="lowin-btn login-btn">
                        确认提交
                    </button>

                    <div class="text-foot">
                        {{--Don't have an account? <a href="javascript:;"  class="register-link">注册</a>--}}
                    </div>
                </form>
            </div>
        </div>

        <div class="lowin-box lowin-register">
            <div class="lowin-box-inner">
                <form action="{{route('admin.signup')}}" method="POST">
                    {{csrf_field()}}
                    <p>Let's create your account</p>
                    <div class="lowin-group">
                        <label>Name</label>
                        <input type="text" name="name" autocomplete="name" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label>Email</label>
                        <input type="email" autocomplete="email" name="email" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label>Password</label>
                        <input type="password" name="password" autocomplete="current-password" class="lowin-input">
                    </div>
                    <button class="lowin-btn">
                        注册
                    </button>

                    <div class="text-foot">
                        Already have an account? <a href="" class="login-link">登录</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="lowin-footer">

    </footer>
</div>

<script src="{{ asset('js/auth.js') }}"></script>
<script>
    Auth.init({
        login_url: "{{route('admin.reset_action')}}",
        forgot_url: "{{route('admin.forget')}}",
        forgot_name:"忘记密码",
    });
</script>
</body>
</html>