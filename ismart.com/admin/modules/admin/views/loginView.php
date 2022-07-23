<?php 
//  global $errors;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/import/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<body>
    <div id="wrapper-login">
        <div id="content-login" class="form-login">
            <section>
                <h1 class="heading-login">Đăng nhập</h1>
                <?php if(isset($_POST['btn_login'])){ emit_error("account");} ?>
                <form action="" method="POST">
                    <div class="form-group">

                        <label for="username">Tên đăng nhập:</label>

                        
                        <input class="pd-10" type="text" name="username" placeholder="Tên đăng nhập" value="<?php if(isset($_POST['btn_login'])) set_value('username')?>" id="username">
                    <?php if(isset($_POST['btn_login'])) {emit_error("username");}?>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="password">
                            Mật khẩu:
                        </label>

                        <input class="pd-10" type="password" name="password" placeholder="Nhập mật khẩu" id="password">
                        <?php if(isset($_POST['btn_login'])) emit_error("password")?>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember"> Ghi nhớ mật khẩu</label>
                    </div>
                    <br></br>
                    <input type="submit" name="btn_login" value="Login">
                </form>
                <a href="?mod=users&controller=login&action=getPass" class="forget_pass">Quên mật khẩu?</a>
                
                
            </section>
        </div>
    </div>
</body>

</html>