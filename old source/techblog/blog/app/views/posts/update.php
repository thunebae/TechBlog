<?php
    require BLOG_ROOT . '/views/includes/navbar.php';
    require BLOG_ROOT . '/views/includes/header.php';
?>

<section class="section">
    <div class="container mt-5">
        <h1>
            Update post
        </h1>

        <form action="<?php echo URL_ROOT; ?>/posts/update/<?php echo $data['post']->post_id ?>" method="POST">
            <!--Title-->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['post']->post_title ?>">
            </div>
            <div class="mb-3">
                <span class="invalidFeedback">
                    <?php echo $data['titleError']; ?>
                </span>
            </div>

            <!--Category-->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo $data['post']->category ?>">
            </div>
            <div class="mb-3">
                <span class="invalidFeedback">
                    <?php echo $data['categoryError']; ?>
                </span>
            </div>
            
            <!--Description-->
            <div class="mb-3">
                <label for="descript" class="form-label">Description</label>
                <input type="text" class="form-control" id="descript" name="descript" value="<?php echo $data['post']->descript ?>">
            </div>
            <div class="mb-3">
                <span class="invalidFeedback">
                    <?php echo $data['descriptError']; ?>
                </span>
            </div>
            <!--Body-->
            <div class="mb-3">
                <label for="body" class="form-label">Content</label>
                <textarea class="form-control" id="body" name="body" rows="10"><?php echo $data['post']->post_body ?></textarea>
            </div>
            <div class="mb-3">
                <span class="invalidFeedback">
                    <?php echo $data['bodyError']; ?>
                </span>
            </div>


            <button class="btn green" name="submit" type="submit">Submit</button>
        </form>
    </div>
</section>

<?php
   require BLOG_ROOT . '/views/includes/footer.php';
?>