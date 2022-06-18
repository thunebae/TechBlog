<div class="container-fluid">
  <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo URL_ROOT; ?>/pages"><img src="<?php echo URL_ROOT; ?>/img/tech-logo.png" alt=""></a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages">Home</a>
              </li>                  
          </ul>
          <ul class="navbar-nav mr-2">
              <li class="nav-item">
              <form class="d-flex">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button type="submit" class="btn"><i class='fa fa-search fa-lg'></i></button>
              </form>
              </li>   
            <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['username']; ?>
              </a>
                <ul class="dropdown-menu" aria-labelledby="dropdown01" style="position: absolute;">
                  <li><a class="dropdown-item" href="<?php echo URL_ROOT; ?>/users/profile">Profile</a></li>
                  <li><a class="dropdown-item" href="<?php echo URL_ROOT; ?>/posts">Blog Management</a></li>
                  <li><a class="dropdown-item" href="<?php echo URL_ROOT; ?>/users/logout">Logout</a></li>
                </ul>
            </li>
            <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login">Login</a>
            </li> 
            <?php endif; ?>
          </ul>   
      </div>
  </nav>
</div>