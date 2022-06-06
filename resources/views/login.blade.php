<!--Template Name: bubble-login-form 
File Name: index.html
Author Name: ThemeVault
Author URI: http://www.themevault.net/
Licence URI: http://www.themevault.net/license/-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPEG BKD</title>
    {{--
    <link rel="icon" href="/loginform/images/favicon.png" /> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/loginform/css/style.css" rel="stylesheet">
    @toastr_css
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <img class="img-circle" src="/theme/logo.png" width="80px">
            <h1>Kepegawaian</h1>
            BKD Kota Banjarmasin
            <form class="form" action="/login" method="post">
                @csrf
                <input type="text" placeholder="Username" name="username" value="{{old('username')}}" required>
                <input type="password" placeholder="Password" name="password" value="{{old('password')}}" required>
                <button type="submit" id="login-button">Login</button>
            </form>
        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>

        <div class="copyright">
            <div class="container">2022 Developed By Diskominfotik Kota Banjarmasin<br />
                <!--Do not remove Backlink from footer of the template. To remove it you can purchase the Backlink !-->
                {{-- &copy; Designed by <a href="http://www.themevault.net/"
                    target="_blank"><strong>ThemeVault.</strong></a> --}}
            </div>
        </div>
    </div>

    <script>
        $("#login-button").click(function (event) {
                event.preventDefault();

                $('form').fadeOut(500);
                $('.wrapper').addClass('form-success');
            });
    </script>

    <script src="/theme/plugins/jquery/jquery.min.js"></script>
    @toastr_js
    @toastr_render
</body>

</html>