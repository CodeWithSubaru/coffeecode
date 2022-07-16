<?php
include "./includes/navbar.php";
$user = new User();
$post = new Post();
$post->addpost();
$category = new Category();

?>
<div id="layoutSidenav_content">

    <main>
        <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4 my-3">
            <div class="d-flex justify-content-between mt-4">
                <h1> Add Post</h1>
                <div>
                    <!-- Button Going back to view post -->
                    <a href="viewpost" class="btn btn-primary">
                        << Go back To View Post </a>
                </div>
            </div>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
                <li class="breadcrumb-item" style="color:#6c757d;">Add Post</li>
            </ol>

            <?php Session::flashMessage($post->error); ?>

            <form action="" method="post" class="card mt-4 drop-shadow-md" enctype="multipart/form-data">
                <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px; font-size: 20px;"><i class="fas fa-plus-square me-2"></i> <span style="color: #D0B49F;">Add</span> Post</h4>

                <div class="card-body">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    <div class="form-group">
                        <label for="post_title">Post Title</label>
                        <input type="text" name="post_title" class="form-control" value="<?= Input::get('post_title') ?>">
                    </div>

                    <div class="form-group mt-3">
                        <label for="post_category_id">Post Category</label>
                        <select name="post_category_id" class="form-select">
                            <option selected disabled>Select your Category</option>
                            <?= $category->fetchCategoryId() ?>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="">Post Author</label>
                        <input type="text" class="form-control" value="<?= $user->data()->user_firstname . " " . substr($user->data()->user_middlename, 0, 1) . ". " . $user->data()->user_lastname ?>" readonly>
                    </div>
                    <input type="hidden" name="post_user_id" value="<?= $user->data()->user_id ?>">

                    <div class="form-group">
                        <label for="post_status">Post Status</label>
                        <select name="post_status" class="form-select">
                            <option value="Published" selected>Publish</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_image">Post Image</label>
                        <input type="file" name="post_image" class="form-control">
                        <div class="mt-3 d-flex justify-content-center" style="width: 100%;">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="post_tags">Post Tags <small class="text-muted ms-2"> Use ', ' (comma) to separete tags </small></label>
                        <input type="text" name="post_tags" class="form-control" id="post_tags" value="<?= Input::get('post_tags') ?>">
                    </div>

                    <div class="form-group mt-3">
                        <label for="post_content">Post Content</label>
                        <textarea name="post_content" class="form-control" cols="30" rows="10" style="resize: none;"><?= Input::get('post_content') ?></textarea>
                    </div>

                    <div class="form-group d-flex">
                        <button type="submit" name="create_post_admin" class="btn btn-primary flex-fill">Publish Post</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <?php
    include "./includes/footer.php";
    ?>