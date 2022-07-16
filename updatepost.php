<?php
include "./includes/navbar.php";

$posts = new Post();
$category = new Category();
$posts->updatepost();
?>

    <div class="row">
        <div class="col-md-10 offset-md-10 mb-3" style="transform: translate(-3.8%,0);">
            <a href="mypost" class="btn btn-primary "><< Back to My Posts </a>
        </div>
    </div>

        <?php Session::flashMessage($posts->error) ?>
        
        <div class="container animate__animated animate__fadeIn animate__fast container-fluid my-3 w-100">
            
        <form action="" method="post" class="" enctype="multipart/form-data">
                <div class="row d-flex justify-content-between mt-4">
                <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;"><i class="fas fa-plus-square me-2"></i><span style="color: #D0B49F;"> Update</span> Post</h4>

                <div class="card-body">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    
                    <div class="form-group">
                        <label for="post_title">Post Title</label>
                        <input type="text" name="post_title" class="form-control" value="<?= $posts->data()->post_title ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_category_id">Post Category</label>
                        <select name="post_category_id" class="form-select">
                            <?php $post->getCategorybyCatFK($post->data()->post_category_id) ?>
                            <option selected value="<?= $posts->data()->post_category_id ?>">
                                <?= $post->getcategory()->cat_title ?>
                            </option>
                            <?= $category->fetchCategoryId(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_user_id">Post Author</label>
                        <select name="post_user_id" class="form-select">
                            <?php $posts->getPostbyUserFk($posts->data()->post_user_id) ?>
                            <option selected value="<?= $posts->data()->post_user_id ?>"><?= $posts->getFullname()  ?></option>


                        </select>
                    </div>


                    <div class="form-group">
                        <label for="post_status">Post Status</label>
                        <select name="post_status" class="form-select">
                            <option selected value="<?= $posts->data()->post_status ?>"><?= $posts->data()->post_status ?></option>
                            <option value="Published">Publish</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_image">Post Image</label>
                        <input type="file" name="post_image" class="form-control">
                        <input type="hidden" name="post_image" value="<?= Input::get('post_image') ?>">
                    </div>

                    <div class="mt-3 d-flex justify-content-center" style="width: 100%;">
                        <img src="<?= $posts->data()->post_image ?>" style="object-fit: scale-down;" class="img-thumbnail" alt="Post Image">
                        <input type="hidden" name="post_image_old" value="<?= $posts->data()->post_image ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Post Tags</label>
                        <input type="text" name="post_tags" class="form-control" id="post_tags" value="<?= $posts->data()->post_tags ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_content">Post Content</label>
                        <textarea name="post_content" class="form-control" cols="30" rows="10" style="resize: none;"><?= $posts->data()->post_content ?></textarea>
                    </div>

                    <div class="form-group d-flex">
                        <button type="submit" name="update_post" class="btn btn-success flex-fill">Update Post</button>
                    </div>
                </div>
            </form>
        </div>
    <?php
    include "./includes/footer.php";
    ?>