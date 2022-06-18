<DOCTYPE html>
    <header>
        <div class="navbar">
        <?php
            require BLOG_ROOT . '/views/includes/header.php';
            require BLOG_ROOT . '/views/includes/navbar.php';
        ?>
        </div>
    <style>
        #profile_pic{
            width:150px;
            height:150px;
            object-fit:cover;
            border-radius:50%;
            margin-top:-100px;
            border: solid 2px white;
        }

    </style>
    </header>
    
    <div class="container">
        <!--cover area-->
        <div class="bg-white" style="text-align: center;">
                <img src="<?php echo URL_ROOT; ?>/img/cover.jpg" class="img-fluid" alt="">
                <img id="profile_pic" src="<?php echo $data['user']->user_photo?>" alt=>
                <form action="<?php echo URL_ROOT; ?>/users/update_avatar" method="post" enctype="multipart/form-data">                
                    <div class="row mt-3">
                        <div class="col-md-12 flex">
                            <input type="file" class="form-control"  name="file">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <br>
                <span class="font-weight-bold h5"><i class='fa fa-user'></i> <?php echo $_SESSION['username']?></span>
                <br>
                <span style="font-size: 16px"><i class='fa fa-envelope'></i> <?php echo $_SESSION['email']?></span>
                <div class="p-2"></div>
        </div>

        <!--body page-->
        <div class="row mt-3">
            <!--Profile setting-->
            <div class="col-lg-7" >
                <form action="<?php echo URL_ROOT; ?>/users/update_profile" method="POST">
                    <div class="p-3 py-5" style="background-color:white;">
                        <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                            <h4 class="text-right"><i class='fa fa-address-book'></i> Profile Settings</h4>
                        </div>
                        <!--Fullname-->
                        <div class="row mt-2 align-items-center px-3">
                            <div class="col-4">
                                <label for="fullname" class="col-form-label">Fullname</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name='fullname' id='fullname' value="<?php echo $data['user']->user_fullname?>" >
                            </div>
                        </div> 
                        <!--Birthday-->
                        <div class="row mt-4 align-items-center px-3">
                            <div class="col-4">
                                <label for="birthday" class="col-form-label">Birthday</label>
                            </div>
                            <div class="col-8">
                            <input type="text" class="form-control" name='birthday' id='birthday' onblur="this.type='text'" onclick="(this.type='date')"  value="<?php echo $data['user']->user_birthday?>">
                            </div>
                        </div> 
                        <!--Mobile number-->
                        <div class="row mt-4 align-items-center px-3">
                            <div class="col-4">
                                <label for="phone" class="col-form-label">Mobile Number</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name='phone' id='phone' value="<?php echo $data['user']->user_phone?>" >
                            </div>
                        </div> 
                        <!--address-->
                        <div class="row mt-4 align-items-center px-3">
                            <div class="col-4">
                                <label for="address" class="col-form-label">Address</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name='address' id='address' value="<?php echo $data['user']->user_address?>" >
                            </div>
                        </div> 
                        <!--email-->
                        <div class="row mt-4 align-items-center px-3">
                            <div class="col-4">
                                <label for="email" class="col-form-label">Email</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name='email' id='email' value="<?php echo $data['user']->user_email?>" >
                            </div>
                        </div> 
                        <!--Profile Description-->
                        <div class="row mt-4 align-items-center px-3">
                                <label for="descript" class="col-form-label">Description</label>
                               <input class="form-control" id="descript" name="descript" value="<?php echo $data['user']->user_descript?>" rows="4"></input>
                        </div> 
                        <!--button Update-->
                        <div class="mt-5 text-center px-3s">
                            <button class="btn btn-primary profile-button" type="submit" name="submit" >Save Profile</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--Posts list-->
            <div class="col-lg-5">
                <div class="p-3 py-5 mb-3"  style="background-color:white;">
                    <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                        <h4 class="text-right">New Post  <i class="fa fa-rss" style="color:red;"></i></h4>
                    </div>

                    <div class="blog-list-widget px-3">
                        <?php foreach($data['posts'] as $post): ?>
                        <div class="list-group">
                            <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="w-100 justify-content-between">
                                    <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid float-left">
                                    <h5 class="mb-1"><?php echo $post->post_title; ?> </h5>
                                    <small><?php echo date('F j Y h:m', strtotime($post->post_created)) ?></small>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div><!-- end blog-list -->
                </div>
            </div>
        <div>
    </div>
    </div>
    </div>
</div>

</DOCTYPE>

<?php
   require BLOG_ROOT . '/views/includes/footer.php';
?>
