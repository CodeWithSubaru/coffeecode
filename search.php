<?php

include "includes/navbar.php";
$user = new User();
$posts = new Post();
$comments = new Comments();
$categories = new Category();
$comments->addcomment();

?>

<!-- Start of content -->
<div class="container px-5 shadow-sm">
    <div class="row">
        <!-- Blog Entries Column -->

        <div class="col-md-8">
            <h1 class="text-center mt-5 font-semibold" style="font-size: 50px; color:#D0B49F;">
                Blogs
               <span class="badge bg-primary" style="position: relative; top: -30px; left: -25px; font-size: 12px;">
                    Newest
                </span>
            </h1>
            <p class="font-medium text-2xl mt-4"> Your search for "<?= $_GET['search'] ?>"</p>
            <div class="" style="margin: 20px 0 50px;">
                <?php if (!$posts->search()) : ?>
                    <hr>
                    <div class="text-center font-semibold text-4xl d-flex justify-content-center align-items-center" style="height: 250px;"> No Posts Found! </div>
                    <hr>
                <?php endif; ?>
                <hr>
                <?php foreach ($posts->search() as $post) { ?>
                    <!-- First Blog Post -->
                    <div class="leading-6 mt-5">
                        <p class="font-semibold" style="color: #6C757D;">
                            <i class="fas fa-history text-muted"></i> <span style="color: #9C9C9C;"> Posted on <?= Date::date_formmatted($post->post_date) ?> at <?= Date::time_format($post->post_date) ?></span>
                        </p>
                        <h2 class="font-semibold text-4xl">
                            <a href="post?post_id=<?= $post->post_id ?>" class="font-medium hover:underline"><?= $post->post_title ?></a>
                        </h2>
                        <p class="font-medium text-base mb-3">
                            <span class="font-normal">
                                by
                            </span>
                            <?= $posts->getFullName($post->user_firstname, $post->user_middlename, $post->user_lastname) ?>
                        </p>

                        <a href="category?cat_id=<?= $post->post_category_id ?>" onMouseOver="this.style.backgroundColor='#a18167'" onMouseOut="this.style.backgroundColor='#ad8c72'" class="d-inline-block link-light mt-2 mb-4 px-3 py-2 py-1 font-medium rounded text-sm mb-2" style="background-color: #ad8c72;"><?= ucwords($post->cat_title) ?></a>
                    </div>
                    <hr />

                    <img class="img-responsive my-1 bg-secondary" src=".<?= ($post->post_image == '../uploads/img/') ? trim($post->post_image, '.') . 'default.png' : trim($post->post_image, '.') ?>" alt="image-post" width=100%" style="height: 350px; object-fit: contain;" />
                    <hr />
                    <div class="py-3 font-medium text-lg indent-16">
                        <?= strlen($post->post_content) > 100 ? substr($post->post_content, 0, 100) . "..." : $post->post_content; ?>
                    </div>

                    <form method="post" action="post?post_id=<?= $post->post_id ?>">
                        <input type="hidden" name="v" value="1">
                        <button type="submit" class="btn btn-success my-2">
                            Read More
                            <i class="fas fa-chevron-right ms-1"></i>
                        </button>
                    </form>

                    <hr />
                <?php } ?>
            </div>
            <!-- End -->

        </div>
        <!-- /. col-md-8 -->


        <!-- Blog Search -->
        <?php include './includes/blogsearch.php' ?>

        <!-- Blog Categories -->
        <?php include './includes/blogcategories.php' ?>

    </div>
    <!-- col-md-4 -->
</div>
<!-- /.row -->
</div>
<?php
include "includes/footer.php";
?>