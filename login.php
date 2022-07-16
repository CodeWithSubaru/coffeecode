<?php

require_once "./core/Init.php";
include './functions/Sanitize.php';
spl_autoload_register(fn ($class) => require_once './classes/' . $class . '.php');

$user = new User();
$user->login();
if ($user->isLoggedIn())
    Redirect::to('index');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Code | Login Page</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/toastr.css">

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 5 cdn css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap");

        * {
            font-family: "Quicksand", system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif,
                "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol",
                "Noto Color Emoji";
        }

        body {
            background-color: #d0b49f;
        }

        hr {
            width: 50px;
        }

        .link {
            text-align: center;
            align-items: center;
            justify-content: center;
        }

        a {
            color: #AB6B51;

        }

        a:hover {
            color: #D0B49F;

        }
    </style>

</head>

<body>
    <section class="vh-100">
        <!-- Notification Error -->
        <?php Session::flashMessage($user->error); ?>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-8 ">
                    <div class="card shadow" style="border-radius: 1rem; width: 50rem;">
                        <div class="row g-0 ">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://media.istockphoto.com/photos/funny-portrait-of-a-man-who-drinks-coffee-picture-id914817194?k=6&m=914817194&s=170667a&w=0&h=HW1NOOi_BDfVZYFlR35kERpX5Z2bbd6mSmikz41XDww=" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-4 text-black">

                                    <form method="POST" class="d-flex flex-grow-1 flex-column">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/120/facebook/65/hot-beverage_2615.png" style="height: 55px; margin-right: 5px;">
                                            <span class="h1 fw-bold mb-0" style="color: #d0b49f">Coffee</span> <span class="h1 fw-bold mb-0" style="color:  #1f2937">Code</span>
                                        </div>
                                        <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account:</h5>
                                        <input type="hidden" name="token" value="<?= Token::generate(); ?>">
                                        <!-- End Notif -->
                                        <div class="form-outline mb-4">
                                            <input class="form-control" placeholder="Username" type="text" name="username" value="<?= Input::get('username') ?? '' ?>" autofocus>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input class="form-control" placeholder="Password" type="password" name="password">
                                        </div>

                                        <button type="submit" name="login" class="btn btn-secondary float-end"> Login</button>
                                        <div class="clearfix"></div>
                                        <br>

                                        <div class="link">
                                            <div class="mb-1">
                                                Need a Account?
                                                <a href="signup"> Signup Now!!</a>
                                            </div>
                                            <div>
                                                <hr class="d-inline-block mb-1" style="width: 30px;"> or
                                                <hr class="d-inline-block mb-1" style="width: 30px;">
                                                <div class="mb-3">
                                                    Go to <a href="index"> Homepage </a>

                                                </div>

                                                <a href="#!" class="small text-muted mb-1">Terms of use.</a>
                                                <a href="#!" class="small text-muted">Privacy policy</a>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>