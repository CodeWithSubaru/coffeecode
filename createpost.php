<?php

include "includes/navbar.php";
$user = new User();

if (!$user->isLoggedIn() || $user->data()->user_role !== 'Subscriber') {
    header('Location: index');
} else {
    $posts = new Post();
    $categories = new Category();
    $posts->addpost();
?>

    <!-- Start of content -->
    <?php Session::flashMessage($posts->error); ?>
    <!-- First Blog Post -->
    <div class="container" style="background: unset !important; padding: unset; box-shadow: unset !important;">
        <div class="d-flex justify-content-end">
            <a href="mypost" class="btn btn-primary">
                << Back to My Post </a>
        </div>
    </div>
    <div class="container animate__animated animate__fadeIn animate__fast my-3 w-100 shadow-sm">
        <form action="" method="post" class="row" enctype="multipart/form-data">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: white;border-top-right-radius: 15px; border-top-left-radius: 15px;">
                <h1 class=" d-flex align-items-center font-semibold text-xl tracking-tight" style="padding-top: unset;">
                    <i class="fas fa-plus-square me-2"></i>
                    <span style="color: #D0B49F;">Create</span> Post
                </h1>
            </div>
            <div class="card-body">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                <div class="form-group mt-3">
                    <label for="post_title">Post Title</label>
                    <input type="text" name="post_title" class="form-control" value="<?= Input::get('post_title') ?>">
                </div>

                <div class="form-group mt-3">
                    <label for="post_category_id">Post Category</label>
                    <select name="post_category_id" class="form-select">
                        <option selected disabled>Select your Category</option>
                        <?= $categories->fetchCategoryId() ?>
                    </select>
                </div>

                <input type="hidden" name="post_user_id" class="form-control" value="<?= $user->data()->user_id ?>">

                <input type="hidden" name="post_status" value="Draft">


                <div class="form-group mt-3">
                    <label for="post_image">Post Image</label>
                    <input type="file" name="post_image" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="post_tags">Post Tags <small class="text-muted ms-2"> Use ', ' (comma) to separete tags </small></label>
                    <input type="text" name="post_tags" class="form-control" id="post_tags" value="<?= Input::get('post_tags') ?>">
                </div>

                <div class="form-group mt-3">
                    <label for="post_content">Post Content</label>
                    <textarea name="post_content" class="form-control" cols="30" rows="10" style="resize: none;"><?= Input::get('post_content') ?></textarea>
                </div>

                <div class="form-group d-flex mt-3">
                    <button type="submit" name="create_post_subs" class="btn flex-fill" style="background: #0D6EFD; color:white;">Publish Post</button>
                </div>
            </div>
        </form>

    </div>


    </div>
    </div>
    <!-- End -->

    </div>
    <!-- /. col-md-8 -->

    </div>
    <!-- col-md-4 -->
    </div>
    <!-- /.row -->

    </div>
<?php
    include "includes/footer.php";
}
?>