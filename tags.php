<?php

include "includes/navbar.php";
$posts = new Post();
$categories = new Category();
$tags = new Tags();
$page =  !isset($_GET['page']) ? 0 : ($_GET['page'] * 5) - 5;

?>
<!-- Start of content -->
<?php $session_id = Session::exists('user') ? Session::get('user') : ''; ?>


<?= Session::flashMessage($user->error); ?>
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
            <p class="font-medium text-2xl mt-4"> Related Tags to "<?= $_GET['tags'] ?? '' ?>"</p>
            <div class="" style="margin: 20px 0 50px; height: 50%;">
                <?php if ($tags->getAllSameTags(Input::get('tags'), $page, 5)) : ?>
                    <?php foreach ($tags->getAllSameTags(Input::get('tags'), $page, 5) as $post) { ?>
                        <!-- First Blog Post -->
                        <div class="leading-6 mt-5">
                            <p class="font-medium" style="color: #9C9C9C;">
                                <i class="fas fa-history text-muted me-1"></i> <span> Posted on <?= Date::date_formmatted($tags->data()->post_date) ?> at <?= Date::time_format($tags->data()->post_date) ?></span>
                            </p>
                            <h2 class="font-semibold text-4xl pt-1">
                                <a href="post?post_id=<?= $tags->data()->post_id ?>" class="font-medium hover:underline"><?= $tags->data()->post_title ?></a>
                            </h2>
                            <p class="font-medium text-base mb-3">
                                <span class="font-normal">
                                    by
                                </span>
                                <?= $tags->formatFullName($tags->data()->user_firstname, $tags->data()->user_middlename, $tags->data()->user_lastname) ?>
                            </p>
                            <a href="category?cat_id=<?= $tags->data()->post_category_id ?>" onMouseOver="this.style.backgroundColor='#a18167'" onMouseOut="this.style.backgroundColor='#ad8c72'" class="d-inline-block link-light mt-2 mb-4 px-3 py-2 py-1 font-medium rounded text-sm mb-2" style="background-color: #ad8c72;"><?= ucwords($tags->data()->cat_title) ?></a>

                        </div>
                        <hr />

                        <img class="img-responsive my-1 text-slate-50" src="<?= ($tags->data()->post_image == '1') ? './uploads/img/default.png' : '.' . trim($tags->data()->post_image, '.') ?>" alt="" width="100%" style="height: 350px; object-fit: contain;background-color:#1F2937;" />
                        <hr />
                        <div class="py-3 mb-3 font-medium text-lg text-center">
                            <?= strlen($tags->data()->post_content) > 70 ? substr($tags->data()->post_content, 0, 70) . "..." : $tags->data()->post_content; ?>
                        </div>

                        <form method="post" action="post?post_id=<?= $tags->data()->post_id ?>">
                            <input type="hidden" name="v" value="1">
                            <button type="submit" class="btn btn-success px-3 py-2 mb-2 rounded-3" style="background-color:#6C757D;">
                                Read More
                                <i class="fas fa-chevron-right ms-1"></i>
                            </button>
                        </form>

                        <hr />
                    <?php } ?>
                <?php else : ?>
                    <div class="text-5xl fond-bold d-flex justify-content-center align-items-center h-100"><?= 'Sorry, No Tags Found' ?></div>
                <?php endif; ?>
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

    <!-- Pager -->
    <nav aria-label="Page navigation example" class="d-flex justify-content-center mb-5">
        <ul class="pagination">


            <?php

            if (isset($_GET['page'])) {

                $pages = $_GET['page'];
            } else {

                $pages = 1;
            }

            $total_page = ceil($tags->pagination(Input::get('tags'), $page, 5) / 5);
            ?>

            <?php if ($page >= 1) : ?>
                <li class="page-item"><a class="page-link" href="index?page=<?= $pages - 1 ?>">
                        << /a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_page; $i++) {

                if ($i == Input::get('page') || $pages == $i) {
                    $isActive = 'active';
                } else {
                    $isActive = '';
                }

            ?>
                <li class="page-item <?= $isActive ?>"><a class="page-link" href="index?page=<?= $i ?>"><?= $i ?></a></li>

            <?php } ?>

            <?php if ($total_page > $pages) :   ?>

                <li class="page-item"><a class="page-link" href="index?page=<?= $pages + 1 ?>">></a></li>

            <?php endif; ?>

        </ul>
    </nav>
</div>
<!-- /.row -->

</div>
<?php
include "includes/footer.php";
?>