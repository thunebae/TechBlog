<?php
    require BLOG_ROOT . '/views/includes/header.php';
    require BLOG_ROOT . '/views/includes/navbar.php';
    require BLOG_ROOT . '/views/includes/navbar.php';
?>

<header>
    <!-- Custom log in/sign up form for this template -->
    <link href="<?php echo URL_ROOT; ?>/css/form.css" rel="stylesheet">
</header>

<div class="wrapper fadeInDown mt-5">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h3 class="active"> Log In </h3>

    <!-- Icon -->
    <div class="fadeIn first p-3">
    <i class='fa fa-user-o fa-2x'></i>
    </div>

    <!-- Login Form -->
    <form action="<?php echo URL_ROOT; ?>/users/login" method ="POST">
        <input type="text" id="username" class="fadeIn first" name="username" placeholder="Username">
        <br>
        <span class="invalidFeedback">
            <?php echo $data['usernameError']; ?>
        </span>
            
        <input type="password" id="password" class="fadeIn second" name="password" placeholder="Password">
        <br>
        <span class="invalidFeedback">
            <?php echo $data['passwordError']; ?>
        </span>
        <br>
        <input type="submit" class="fadeIn third" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
        Not registered yet? <a class="underlineHover" href="<?php echo URL_ROOT; ?>/users/register">Create an account!</a>
    </div>

  </div>
</div>
<?php
   require BLOG_ROOT . '/views/includes/footer.php';
?>