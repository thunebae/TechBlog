<?php
    require '../app/helpers/session_helper.php';
?>
<?php
   require BLOG_ROOT . '/views/includes/header.php';
?>

    <?php
       require BLOG_ROOT . '/views/includes/navbar.php';
    ?>

<div class="mt-5">
    <img src="<?php echo URL_ROOT; ?>/img/banner_home.jpg" class="img-fluid" alt="">
</div><!-- end page-title -->

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">                          
                            <div class="widget">
                                <h2 class="widget-title">Popular Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="upload/tech_blog_08.jpg" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">5 Beautiful buildings you need..</h5>
                                                <small>12 Jan, 2016</small>
                                            </div>
                                        </a>

                                        <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="upload/tech_blog_01.jpg" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">Let's make an introduction for..</h5>
                                                <small>11 Jan, 2016</small>
                                            </div>
                                        </a>

                                        <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 last-item justify-content-between">
                                                <img src="upload/tech_blog_03.jpg" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">Did you see the most beautiful..</h5>
                                                <small>07 Jan, 2016</small>
                                            </div>
                                        </a>
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->
                        </div><!-- end sidebar -->
            </div><!-- end col -->
                    
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-grid-system">
                        <div class="row">
                            <?php foreach($data['page_view'] as $page_view): ?>
                            <div class="col-md-6">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="tech-single.html" title="">
                                            <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta big-meta">
                                        <span class="color-orange"><a href="tech-category-01.html" title=""><?php echo $page_view->category; ?> </a></span>
                                        <h4><a href="tech-single.html" title=""><?php echo $page_view->post_title; ?> </a></h4>
                                        <p><?php echo $page_view->descript; ?></p>
                                        <small><a href="tech-single.html" title=""><?php echo date('F j Y h:m', strtotime($page_view->post_created)) ?></a></small>
                                        <small><a href="tech-author.html" title="">by <?php echo $page_view->user_name; ?></a></small>
                                        <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> 2887</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->
                            <?php endforeach; ?>
                        </div><!-- end row -->
                    </div><!-- end blog-grid-system -->

                    <hr class="invis">
                    <div class="row">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-start">
                                <?php 
                                    $prev = $data['page'] - 1;
                                    if ($prev > 0){
                                        echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$prev.'">Prev</a></li>';
                                    }  

                                    $num_page = ceil(count($data['posts'])/6);
                                    $url = URL_ROOT . '/pages';
                                    for($i=1; $i<=$num_page; $i++){
                                        if ($i <= 10){
                                            if ($i === 1){
                                                echo '<li class="page-item"><a class="page-link" href="'.$url.'">1</a></li>';
                                            }else{
                                                echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
                                            }  
                                        }
                                    }  
                                    $next = $data['page'] + 1;
                                    if ($next <= $num_page){
                                        echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$next.'">Next</a></li>';
                                    }                                      
                                ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div>
    </div>
</section>



<?php
   require BLOG_ROOT . '/views/includes/footer.php';
?>