<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?=base_url();?>assets/images/logo-dark.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/auth/'?>css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url(<?=base_url().'assets/auth/images/bg-01.jpg'?>);">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <form class="login100-form validate-form flex-sb flex-w"  action="<?=base_url();?>auth/logins" method="post">
                <?php if ($this->session->flashdata('error')) { ?>
                    <p class="text-center" style='font-style:italic;color:red'> <?= $this->session->flashdata('error') ?> </p>
                <?php } ?>
                <a href="<?=$this->config->item('perpus')?>" class="btn-face m-b-20">
                    Masuk Perpus
                </a>


                <a href="<?=base_url()?>" class="btn-google m-b-20">Kembali</a>
                <div class="p-t-31 p-b-9">
                    <span class="txt1">Username</span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Username is required">
                    <input class="input100" type="text" name="username" id="username">
                    <span class="focus-input100"></span>
                </div>

                <div class="p-t-13 p-b-9">
                    <span class="txt1">Password</span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" >
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn m-t-17">
                    <input type="submit" name="type" class="login100-form-btn" value="masuk">
                </div>


            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="<?=base_url().'assets/auth/'?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url().'assets/auth/'?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url().'assets/auth/'?>vendor/bootstrap/js/popper.js"></script>
<script src="<?=base_url().'assets/auth/'?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url().'assets/auth/'?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url().'assets/auth/'?>vendor/daterangepicker/moment.min.js"></script>
<script src="<?=base_url().'assets/auth/'?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url().'assets/auth/'?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url().'assets/auth/'?>js/main.js"></script>

<script>
    $(document).ready(function(){
    	$("#username").focus();
    })
</script>

</body>
</html>