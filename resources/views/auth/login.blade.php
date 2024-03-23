<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="description" content=" Today in this blog you will learn how to create a responsive Login & Registration Form in HTML CSS & JavaScript. The blog will cover everything from the basics of creating a Login & Registration in HTML, to styling it with CSS and adding with JavaScript." />
    <meta
        name="keywords"
        content="
 Animated Login & Registration Form,Form Design,HTML and CSS,HTML CSS JavaScript,login & registration form,login & signup form,Login Form Design,registration form,Signup Form,HTML,CSS,JavaScript,
"
    />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login & Signup Form HTML CSS | CodingNepal</title>
    <link rel="stylesheet" href="{{URL::asset('admin/login2/style.css')}}" />
    <script src="#" defer></script>
</head>
<body>
<section class="wrapper">
{{--    <div class="form login">--}}
{{--        <header>Login</header>--}}
{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}
{{--            <input type="text" name="email" placeholder="Email address" required />--}}
{{--            <input type="password" name="password" placeholder="Password" required />--}}
{{--            <a href="{{route('password.request')}}">Forgot password?</a>--}}
{{--            <input type="submit" value="Login" />--}}
{{--        </form>--}}
{{--    </div>--}}


    <div class="form signup">
        <header>Login</header>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" name="email" placeholder="Email address" required />
            <input type="password" name="password" placeholder="Password" required />
            <a style="color: silver" href="{{route('password.request')}}">Forgot password?</a>
            <input type="submit" value="Login" />
        </form>
    </div>



    <script>
        const wrapper = document.querySelector(".wrapper"),
            signupHeader = document.querySelector(".signup header"),
            loginHeader = document.querySelector(".login header");

        loginHeader.addEventListener("click", () => {
            wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
            wrapper.classList.remove("active");
        });
    </script>
</section>
</body>
</html>
