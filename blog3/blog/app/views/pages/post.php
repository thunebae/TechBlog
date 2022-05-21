
<?php
    require '../app/helpers/session_helper.php';
?>
<?php
   require BLOG_ROOT . '/views/includes/header.php';
   require BLOG_ROOT . '/views/includes/navbar.php';
?>
<style>
    .profile_pic{
        width: 70px;
        height: 70px;
        object-fit:cover;
        border-radius:50%;
        border: solid 1px #d6d1d1;
    }
</style>


<div class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="<?php echo URL_ROOT; ?>/pages">Posts</a></li>
                            <li class="breadcrumb-item active"><?php echo $data['post']->post_title ?></li>
                        </ol>
                        <span class="color-orange"><a title=""><?php echo $data['post']->post_category ?></a></span>
                        <h3><?php echo $data['post']->post_title ?></h3>

                        <div class="blog-meta big-meta">
                            <small><a title=""><?php echo date('F j Y h:m', strtotime($data['post']->post_created)) ?></a></small>
                            <small><a title="">by <?php echo $data['author_username'] ?></a></small>
                            <small><a title=""><i class="fa fa-eye"></i><?php echo $data['post']->views?></a></small>
                        </div><!-- end meta -->

                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                        </div><!-- end post-sharing -->
                    </div><!-- end title -->

                    <div class="single-post-media">
                        <img src="<?php echo URL_ROOT; echo $data['post']->post_photo?>" alt="" class="img-fluid">
                    </div><!-- end media -->

                    <div class="blog-content">  
                        <div class="pp mb-3"><i><b>"<?php echo $data['post']->post_descript?>"</b></i></div>
                        <div class="pp"><?php echo $data['post']->post_body ?></div>
                    </div>

                    <div class="row mt-5 mb-5">
                        <div class="col-lg-12">
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="<?php echo URL_ROOT; ?>/img/banner-post.jpg" alt="" class="img-fluid">
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <hr class="invis1">

                    <div class="custombox authorbox clearfix">
                        <h4 class="small-title">About author</h4>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <?php if(is_null($data['author_avatar'])): ?>
                                <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid rounded-circle profile_pic">
                            <?php else : ?>
                                <img src="../<?php echo $data['author_avatar'] ?>" alt="" class="img-fluid profile_pic">  
                            <?php endif; ?>  
                            
                            </div><!-- end col -->
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <?php if(is_null($data['author_fullname'])): ?>
                                    <h4><a>Update...</a></h4>
                                <?php else : ?>
                                    <h4><a><?php echo $data['author_fullname'] ?></a></h4>
                                <?php endif; ?>  
                            <div>
                                <?php if(is_null($data['author_descript'])): ?>
                                    <p>Update...</p>
                                <?php else : ?>
                                    <p><?php echo $data['author_descript'] ?></p>
                                <?php endif; ?>  
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end author-box -->

                    <hr class="invis1">
                    <!--Comment-->
                    <div class="custombox clearfix">
                                <h4 class="small-title"><?php echo $data['count_cmt'] ?> Comments</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                            <?php foreach($data['cmts'] as $cmt): ?>
                                                <div class="media" >
                                                    <a class="media-left" href="#"> 
                                                        <?php if(is_null($cmt->user_photo)): ?>
                                                            <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid rounded-circle profile_pic">
                                                        <?php else : ?>
                                                            <img src="../<?php echo $cmt->user_photo?>" alt="" class="img-fluid profile_pic">
                                                        <?php endif; ?> 
                                                    </a>
                                                    <div class="media-body">
                                                        <h4 class="media-heading user_name"><?php echo $cmt->user_name?> <small><?php echo $cmt->cmt_created?></small></h4>
                                                        <p><?php echo $cmt->cmt_body ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>

                                            
                                            <?php if(isLoggedIn()): ?>
                                            <div class="media">
                                                <a class="media-left" href="#">
                                                <?php if(is_null($data['user']->user_photo)): ?>
                                                    <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid rounded-circle profile_pic">
                                                <?php else : ?>
                                                    <img src="../<?php echo $data['user']->user_photo ?>" alt="" class="img-fluid rounded-circle profile_pic"> 
                                                <?php endif; ?>  
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading user_name"><?php echo $_SESSION['username'] ?></h4>
                                                    <form action="<?php echo URL_ROOT; ?>/cmts/create/ <?php echo $data['post']->post_id ?>" method="POST">
                                                        <textarea name="body" class="form-control" placeholder="Write a comment" rows="5"></textarea>
                                                        <br>
                                                        <button type="submit" class="btn float-left" >Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                    </div><!-- end custom-box -->
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <div class="banner-spot clearfix">
                            <div class="banner-img">
                                <img src="<?php echo URL_ROOT; ?>/img/standee-post.jpg" alt="" class="img-fluid">
                            </div><!-- end banner-img -->
                        </div><!-- end banner -->
                    </div><!-- end widget -->
                    <div class="widget">
                                <h2 class="widget-title">Popular Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <?php foreach($data['popular_posts'] as $popular_posts): ?>
                                        <a href="<?php echo URL_ROOT . '/pages/post/' . $popular_posts->post_id; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <?php if(is_null($popular_posts->post_photo)): ?>
                                                    <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid float-left">
                                                <?php else : ?>
                                                    <img src="<?php echo URL_ROOT . $popular_posts->post_photo; ?>" alt="" class="img-fluid float-left">
                                                <?php endif; ?>
                                                <h5 class="mb-1"><?php echo $popular_posts->post_title; ?></h5>
                                                <small><?php echo date('F j Y h:m', strtotime($popular_posts->post_created)) ?></small>
                                            </div>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->
                    <div class="widget">
                        <div class="banner-spot clearfix">
                            <div class="banner-img">
                                <img src="<?php echo URL_ROOT; ?>/img/dung.jpg" alt="" class="img-fluid">
                            </div><!-- end banner-img -->
                        </div><!-- end banner -->
                    </div><!-- end widget -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
   require BLOG_ROOT . '/views/includes/footer.php';
?>