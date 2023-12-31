<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin - <?=$title?></title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' type='text/javascript'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
 
    <style>
        @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v17/mem5YaGs126MiZpBA-UN_r8OUuhs.ttf) format('truetype');
        }
        @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v17/mem8YaGs126MiZpBA-UFVZ0e.ttf) format('truetype');
        }
        @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v17/mem5YaGs126MiZpBA-UNirkOUuhs.ttf) format('truetype');
        }
        @font-face {
        font-family: 'Open Sans Condensed';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Condensed Light'), local('OpenSansCondensed-Light'), url(https://fonts.gstatic.com/s/opensanscondensed/v14/z7NFdQDnbTkabZAIOl9il_O6KJj73e7Ff1GhDuXMQg.ttf) format('truetype');
        }
        @font-face {
        font-family: 'Open Sans Condensed';
        font-style: normal;
        font-weight: 700;
        src: local('Open Sans Condensed Bold'), local('OpenSansCondensed-Bold'), url(https://fonts.gstatic.com/s/opensanscondensed/v14/z7NFdQDnbTkabZAIOl9il_O6KJj73e7Ff0GmDuXMQg.ttf) format('truetype');
        }
        * {
        box-sizing: border-box;
        }
        body {
        font-family: 'open sans', helvetica, arial, sans;
        background: url("<?=base_url()?>assets/img/sekolah3.jpg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        }
        .log-form {
        width: 40%;
        min-width: 320px;
        max-width: 475px;
        background: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.25);
        }
        @media (max-width: 40em) {
        .log-form {
            width: 95%;
            position: relative;
            margin: 2.5% auto 0 auto;
            left: 0%;
            -webkit-transform: translate(0%, 0%);
            -moz-transform: translate(0%, 0%);
            -o-transform: translate(0%, 0%);
            -ms-transform: translate(0%, 0%);
            transform: translate(0%, 0%);
        }
        }
        .log-form form {
        display: block;
        width: 100%;
        padding: 2em;
        }
        .log-form h2 {
        color: #5d5d5d;
        font-family: 'open sans condensed';
        font-size: 1.35em;
        display: block;
        background: #2a2a2a;
        width: 100%;
        text-transform: uppercase;
        padding: 0.75em 1em 0.75em 1.5em;
        box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.05);
        border: 1px solid #1d1d1d;
        margin: 0;
        font-weight: 200;
        }
        .log-form input {
        display: block;
        margin: auto auto;
        width: 100%;
        margin-bottom: 2em;
        padding: 0.5em 0;
        border: none;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 1.25em;
        color: #757575;
        }
        .log-form input:focus {
        outline: none;
        }
        .log-form .btn {
        display: inline-block;
        background: #1fb5bf;
        border: 1px solid #1ba0a9;
        padding: 0.5em 2em;
        color: white;
        margin-right: 0.5em;
        box-shadow: inset 0px 1px 0px rgba(255, 255, 255, 0.2);
        }
        .log-form .btn:hover {
        background: #23cad5;
        }
        .log-form .btn:active {
        background: #1fb5bf;
        box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.1);
        }
        .log-form .btn:focus {
        outline: none;
        }
        .log-form .forgot {
        color: #33d3de;
        line-height: 0.5em;
        position: relative;
        top: 2.5em;
        text-decoration: none;
        font-size: 0.75em;
        margin: 0;
        padding: 0;
        float: right;
        }
        .log-form .forgot:hover {
        color: #1ba0a9;
        }
    </style>

</head>

<body>
  <div class='log-form'>
  <h2 style="color:white">Login Admin <?=$title?></h2>
    <form action="<?=base_url();?>auth/login" method="post"> 
        <input type='text' name='username' placeholder='username' />
        <i class="fa fa-user form-control-feedback"><?php echo form_error('username'); ?></i>
        <input type='password' name='password' placeholder='password' />
        <i class="fa fa-lock form-control-feedback"><?php echo form_error('password'); ?></i>

        <!-- <button type='submit' class='btn'>Login</button> -->
        <button type="submit" class="btn"><span>Sign in</span></button>

        <!-- <a class='forgot' href='#'>Forgot Username?</a> -->
    </form>
    </div><!--end log form -->
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  
  
  

</body>

</html>
 