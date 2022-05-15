<?php
    require_once '../app/helpers/session_helper.php';
    require BLOG_ROOT . '/views/includes/navbar.php';
    require BLOG_ROOT . '/views/includes/header.php';
?>

<style>
    button.btn-delete {
        background-color:white;
        border: none;
        background-image: url("<?php echo URL_ROOT; ?>/posts/create")
    }
</style>

<div class="container" style="margin-top: 73px;">
    <div class="bg-white" style="text-align: center;">
        <img src="<?php echo URL_ROOT; ?>/img/banner-manage-blog.jpg" class="img-fluid" alt="">
    </div>

    <div class="row mt-3">
        <div class="col-lg-4">
            <div class="row" style="margin-left:3px;">
                <?php if(isLoggedIn()): ?>
                    <a class="btn py-4" href="<?php echo URL_ROOT; ?>/posts/create">
                        <i class='fa fa-plus-square'></i>  Create new post
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="bg-white mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2 px-3">
                    <h4 class="text-right mt-4 px-3"><i class='fa fa-list blue-color'></i> Post List </h4>
                </div>
                <div class="blog-list-widget px-3">
                    <?php foreach($data['page_view'] as $post): ?>
                        <div class="row px-3">
                            <div class="col-8">
                                <div class="list-group">
                                    <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="<?php echo URL_ROOT; ?>/img/banner.jpg" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1"><?php echo $post->post_title; ?> </h5>
                                            <small><?php echo date('F j Y h:m', strtotime($post->post_created)) ?></small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php if(isLoggedIn() && $_SESSION['user_id'] == $post->user_id): ?>
                                    <a class="d-inline me-2" href="<?php echo URL_ROOT . '/posts/update/' . $post->post_id ?>">
                                        <i class='fa fa-edit fa-2x' style='color: blue'></i>
                                    </a>
                                    <form class="d-inline" action="<?php echo URL_ROOT . "/posts/delete/" . $post->post_id ?>" method="POST">
                                        <button type="submit" name="delete" class="btn-delete">
                                            <i class='fa fa-trash-o fa-2x' style='color: red'></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    
                    <?php endforeach; ?>
                    <hr class="invis">
                    <div class="row">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-start">
                                <?php 
                                    
                                    $num_page = ceil(count($data['posts_of_user'])/6);
                                    $url = URL_ROOT . '/posts';

                                    $prev = $data['page'] - 1;
                                    if ($prev > 0){
                                        echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$prev.'">Prev</a></li>';
                                    }  

                                    
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
                </div><!-- end blog-list -->
            </div>
        </div>          
    </div>
</div><!--end container-->

<?php
   require BLOG_ROOT . '/views/includes/footer.php';
?>
