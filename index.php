<?php
session_start();
include "./phpfiles.php";
if (isset($_SESSION['userId'])) {
    header('Location: ./afterLogin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="manifest" href="manifest.json" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="Images/icons/icon-192x192.png" />
    <link href="https://fonts.googleapis.com/css?family=Spartan:400,600,800,900&display=swap" rel="stylesheet">
    <meta name="apple-mobile-web-app-status-bar" content="#00adb5" />
    <meta name="theme-color" content="#00adb5" />
    <link rel="stylesheet" href="Scripts and Sheets/main.css" />
    <title>BE Project</title>
</head>

<body onload="formVisibility()">
    <div class="overflowhide">
        <div class="statusbar">
            Group No. 44
        </div>
        <div class="sliding-background">
            <img src="Images/Img6.jpg" class="carousel" alt="Fourth slide">
            <img src="Images/Img5.jpg" class="carousel" alt="Fifth slide">
            <img src="Images/Img4.jpg" class="carousel" alt="Sixth slide">
            <img src="Images/Img6.jpg" class="carousel" alt="Fourth slide">
        </div>
        <div class="sliding-background">
            <img src="Images/Img1.jpg" class="carousel" alt="First slide">
            <img src="Images/Img2.jpg" class="carousel" alt="Second slide">
            <img src="Images/Img3.jpg" class="carousel" alt="Third slide">
            <img src="Images/Img1.jpg" class="carousel" alt="First slide">
        </div>
        <div id="form">
            <div id="login-form" class="reveal-that box-s">
                <h3 class="text-center">Login</h3>
                <form method="POST" class="p-md-4 p-3" action="./phpfiles.php" autocomplete="off">
                    <input class="form-group form-control" type="text" name="username" placeholder="Username" required="" />
                    <input class="form-group form-control" type="password" name="password" placeholder="Password" required />
                    <input class="form-group form-control" type="submit" value="Sign in" name="Login" />
                    <a class="signopt text-decoration-none" onclick="toggleClassOne()" href="#">
                        <div class="signopt-change">
                            SIGN UP
                        </div>
                    </a>
                </form>
            </div>
            <div id="register-form" class="hide-that box-s">
                <h3 class="text-center">Sign Up</h3>
                <form action="./Scripts and Sheets/Register.php" method="POST" class="p-md-4 p-3" autocomplete="off">
                    <input class="form-group form-control" type="email" name="email" placeholder="Email" required />
                    <input class="form-group form-control" type="text" name="username" placeholder="Username" required />
                    <input class="form-group form-control" type="password" name="password" placeholder="Password" required />
                    <input class="form-group form-control" type="submit" value="Register" />
                    <a class="signopt text-decoration-none" onclick="toggleClassOne()" href="#">
                        <div class="signopt-change">
                            SIGN IN
                        </div>
                    </a>
                </form>
            </div>

        </div>

    </div>
    </div>
</body>
<script src="Scripts and Sheets/main.js"></script>
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('serviceWorker.js').then(function(registration) {
                // Registration was successful
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                // registration failed :(
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (event) => {
        // Stash the event so it can be triggered later.
        window.deferredPrompt = event;
        // Remove the 'hidden' class from the install button container
    });
</script>

</html>