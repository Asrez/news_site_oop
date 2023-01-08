<!DOCTYPE html>
<html lang="en">

<?php require_once "view/auth/part/head-tag.php" ?>


<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?= helper::url("public/auth/assets/images/img-01.png") ?>" alt="IMG">
            </div>

            <form method="post" action="<?= helper::url("store")?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Register
                    </span>
                <?php $message = helper::flash("register_error");
                if (!empty($message)) {
                    ?>
                    <div class="mb-2 alert alert-danger"><small class="form-text text-danger">
                            <?= $message ?>
                        </small></div>
                <?php } ?>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="username" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                </div>
                <div class="wrap-input100 validate-input" style="text-align: center">
                    <span id="captcha_refresh" style="cursor: pointer" > <i class="fa fa-refresh" style="font-size: 30px"></i></span>
                    <img src="<?= helper::url("captcha") ?>" width="150" height="80" id="captcha">
                </div>
                <div class="wrap-input100 validate-input" data-validate="Captcha is required">
                    <input class="input100" type="text" name="Captcha" placeholder="Enter the number in the box above">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Register
                    </button>
                </div>

                <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                    <a class="txt2" href="#">
                        Username / Password?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="">
                        Login your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $("#captcha_refresh").click(function () {
            $('#captcha').attr('src','captcha')
        });
    });
</script>
<?php require_once "view/auth/part/scripts.php" ?>

</body>

</html>