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

        button.btn-camera{
            background-color: #deddd9;
            color: 
            position: absolute;
            border: none;
            width: 40px;
            height: 40px;
            border-radius:50%;
            margin-top:-50px;
            margin-left: 70px;
        }

    </style>
    </header>
    
    <div class="container">
        <!--cover area-->
        <div class="bg-white" style="text-align: center;">
                <img src="<?php echo URL_ROOT; ?>/img/cover.jpg" class="img-fluid" alt="">
                <?php if(is_null($data['user']->user_photo)): ?>
                    <img id="profile_pic" src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="">
                <?php else : ?>
                    <img id="profile_pic" src="<?php echo URL_ROOT . $data['user']->user_photo?>" alt="">
                <?php endif; ?>
                <form action="<?php echo URL_ROOT; ?>/users/update_avatar" method="post" enctype="multipart/form-data">                
                    <button type="button" class="btn-camera" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class='fa fa-camera fa-lg'></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i class='fa fa-info-circle' style='color: blue'></i> Update profile image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Choose file have extension .jpg .jpeg .png and size is less than 1MB. Please don't try to hack this web by upload file :<
                                        <br>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <input type="file" class="form-control"  name="file">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                 </div>
                        </div>
                    </div>
                    
                </form>
                <span class="font-weight-bold h5"><i class='fa fa-user'></i> <?php echo $_SESSION['username']?></span>
                <br>
                <span style="font-size: 16px"><i class='fa fa-envelope'></i> <?php echo $_SESSION['email']?></span>
                <div class="p-2"></div>
        </div>

        <!--body page-->
        <div class="row mt-3">
            <!--Profile setting-->
            
            <div class="col-lg-8" >
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
            <div class="col-lg-4">
                <div class="p-3 py-5 mb-3"  style="background-color:white;">
                    <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                        <h4 class="text-right">New Post  <i class="fa fa-rss" style="color:red;"></i></h4>
                    </div>
                    <?php if(!is_null($data['posts'])): ?>
                    <div class="blog-list-widget px-3">
                        <?php foreach($data['posts'] as $posts): ?>
                        <div class="list-group">
                            <a href="<?php echo URL_ROOT . '/pages/post/' . $posts->post_id; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="w-100 justify-content-between">
                                    <?php if(is_null($posts->post_photo)): ?>
                                        <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid float-left">
                                    <?php else : ?>
                                        <img src="<?php echo URL_ROOT . $posts->post_photo; ?>" alt="" class="img-fluid float-left">
                                    <?php endif; ?>
                                    <h5 class="mb-1"><?php echo $posts->post_title; ?> </h5>
                                    <small><?php echo date('F j Y h:m', strtotime($posts->post_created)) ?></small>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div><!-- end blog-list -->
                    <?php endif; ?>
                </div>
                <div class="side-bar">
                    <div class="widget mb-4">
                        <div class="banner-spot clearfix">
                            <div class="banner-img">
                                <img src="<?php echo URL_ROOT; ?>/img/dung-2.png" alt="" class="img-fluid">
                            </div><!-- end banner-img -->
                        </div><!-- end banner -->
                    </div><!-- end widget -->
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
