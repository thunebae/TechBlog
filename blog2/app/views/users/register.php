<?php
   require BLOG_ROOT . '/views/includes/header.php';
   require BLOG_ROOT . '/views/includes/navbar.php';
?>

<header>
    <!-- Custom log in/sign up form for this template -->
    <link href="<?php echo URL_ROOT; ?>/css/form.css" rel="stylesheet">
</header>

<div class="wrapper fadeInDown mt-5">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h3 class="active"> REGISTER </h3>

    <!-- Icon -->
    <div class="fadeIn first p-3">
        <i class='fa fa-user-plus fa-2x'></i>
    </div>

    <!-- Login Form -->
    <form id="register-form" method="POST" action="<?php echo URL_ROOT; ?>/users/register">
        <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username">
        <br>
        <span class="invalidFeedback">
            <?php echo $data['usernameError']; ?>
        </span>

        <input type="email" class="fadeIn third"  placeholder="Email" name="email" id="email">
        <br>
        <span class="invalidFeedback">
            <?php echo $data['emailError']; ?>
        </span>
            
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
        <br>
        <span class="invalidFeedback">
            <?php echo $data['passwordError']; ?>
        </span>

        <input type="password" class="fadeIn fourth" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword">
        <br>
        <span class="invalidFeedback">
            <?php echo $data['confirmPasswordError']; ?>
        </span>
        <br>

        <input type="submit" class="fadeIn fourth" value="Sign Up">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
        Already have an account?<a class="underlineHover" href="<?php echo URL_ROOT; ?>/users/login">Log in!</a>
    </div>

  </div>
</div>
<?php
   require BLOG_ROOT . '/views/includes/footer.php';
?>