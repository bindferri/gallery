<?php
require_once "includes/header.php";

if (isset($_POST['login'])){
    $username = trim($_POST['login_username']);
    $password = trim($_POST['login_password']);

    $user_found = $user->verify_login($username,$password);

    if ($user_found){
        $session->login($user_found);
        redirect("index.php");
    }else{
        $err_message = "Your password or username are incorrect";
    }
}else{
    $username = '';
    $password = '';
}
?>


<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php if (isset($err_message)) echo $err_message; ?></h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="login_username" value="<?php echo htmlentities($username); ?>" >

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="login_password" value="<?php echo htmlentities($password); ?>">

        </div>


        <div class="form-group">
            <input type="submit" name="login" value="Login" class="btn btn-primary">

        </div>


    </form>


</div>

<?php require_once "includes/footer.php";?>



