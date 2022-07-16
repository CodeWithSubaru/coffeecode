<?php
include "includes/navbar.php";
$user = new User();

if (!isset($_GET['post_id'])) {
    header('Location: index');
} else {

    $posts = new Post();
    $comments = new Comments();
    $categories = new Category();
    $favorites = new Favorites();
    $comments->addcomment();
    if (isset($_POST['update_comment'])) {
        $comments->updatecomment();
    }

    if (isset($_POST['add_to_favorites'])) {
        $favorites->add();
    }

    if (isset($_POST['remove_to_favorites'])) {
        $favorites->remove();
    }

    $posts->getId(Input::get('post_id'));
?>
    <meta property="og:url" content="<?= URL ?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= $posts->data()->post_title ?>">
    <meta property="og:description" content="<?= $posts->data()->post_content ?>">
    <meta property="og:image" content="<?= $posts->data()->post_image ?>">

    <div class="shareBtn-container animate__animated animate__fadeIn animate__fast">
        <!-- Sharingbutton Facebook -->
        <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=<?= URL ?>" target="_blank" rel="noopener" aria-label="Share on Facebook">
            <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--large">
                <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z" />
                    </svg>
                </div>
            </div>
        </a>

        <!-- Sharingbutton E-Mail -->
        <a class="resp-sharing-button__link" href="mailto:?subject=<?= $posts->data()->post_title ?>&amp;body=<?= URL ?>" target="_self" rel="noopener" aria-label="Share by E-Mail">
            <div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--large">
                <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM7.25 14.43l-3.5 2c-.08.05-.17.07-.25.07-.17 0-.34-.1-.43-.25-.14-.24-.06-.55.18-.68l3.5-2c.24-.14.55-.06.68.18.14.24.06.55-.18.68zm4.75.07c-.1 0-.2-.03-.27-.08l-8.5-5.5c-.23-.15-.3-.46-.15-.7.15-.22.46-.3.7-.14L12 13.4l8.23-5.32c.23-.15.54-.08.7.15.14.23.07.54-.16.7l-8.5 5.5c-.08.04-.17.07-.27.07zm8.93 1.75c-.1.16-.26.25-.43.25-.08 0-.17-.02-.25-.07l-3.5-2c-.24-.13-.32-.44-.18-.68s.44-.32.68-.18l3.5 2c.24.13.32.44.18.68z" />
                    </svg>
                </div>
            </div>
        </a>

        <!-- Sharingbutton Reddit -->
        <a class="resp-sharing-button__link" href="https://reddit.com/submit/?url=<?= URL ?>&amp;resubmit=true&amp;title=<?= $posts->data()->post_title ?>" target="_blank" rel="noopener" aria-label="Share on Reddit">
            <div class="resp-sharing-button resp-sharing-button--reddit resp-sharing-button--large">
                <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M24 11.5c0-1.65-1.35-3-3-3-.96 0-1.86.48-2.42 1.24-1.64-1-3.75-1.64-6.07-1.72.08-1.1.4-3.05 1.52-3.7.72-.4 1.73-.24 3 .5C17.2 6.3 18.46 7.5 20 7.5c1.65 0 3-1.35 3-3s-1.35-3-3-3c-1.38 0-2.54.94-2.88 2.22-1.43-.72-2.64-.8-3.6-.25-1.64.94-1.95 3.47-2 4.55-2.33.08-4.45.7-6.1 1.72C4.86 8.98 3.96 8.5 3 8.5c-1.65 0-3 1.35-3 3 0 1.32.84 2.44 2.05 2.84-.03.22-.05.44-.05.66 0 3.86 4.5 7 10 7s10-3.14 10-7c0-.22-.02-.44-.05-.66 1.2-.4 2.05-1.54 2.05-2.84zM2.3 13.37C1.5 13.07 1 12.35 1 11.5c0-1.1.9-2 2-2 .64 0 1.22.32 1.6.82-1.1.85-1.92 1.9-2.3 3.05zm3.7.13c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm9.8 4.8c-1.08.63-2.42.96-3.8.96-1.4 0-2.74-.34-3.8-.95-.24-.13-.32-.44-.2-.68.15-.24.46-.32.7-.18 1.83 1.06 4.76 1.06 6.6 0 .23-.13.53-.05.67.2.14.23.06.54-.18.67zm.2-2.8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm5.7-2.13c-.38-1.16-1.2-2.2-2.3-3.05.38-.5.97-.82 1.6-.82 1.1 0 2 .9 2 2 0 .84-.53 1.57-1.3 1.87z" />
                    </svg>
                </div>
            </div>
        </a>


    </div>



    <div class="container px-5 rounded shadow-sm" style="background-color: white;">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?= Session::flashMessage($comments->error); ?>

                <!-- First Blog Post -->

                <div class="" style="margin: 50px 0 50px;">
                    <div class="mb-3 d-flex justify-content-between">



                        <div><i class="fas fa-history"></i> <span class="font-medium" style="color: #9C9C9C;"> Posted on <?= Date::date_formmatted($posts->data()->post_date) ?> at <?= Date::time_format($posts->data()->post_date) ?></span></div>
                        No. of views: <?= $posts->addViews(); ?>
                    </div>
                    <div class="text-center my-5">
                        <h2 class="text-4xl mb-2">
                            <span class="font-semibold text-5xl"><?= $posts->data()->post_title ?></span>
                        </h2>
                        <p class="font-medium text-base mb-3"><span class="font-normal"> by</span> <?= $posts->getFullName($posts->data()->user_firstname, $posts->data()->user_middlename, $posts->data()->user_lastname) ?></p>
                        <a href="category?cat_id=<?= $posts->data()->post_category_id ?>" onMouseOver="this.style.backgroundColor='#a18167'" onMouseOut="this.style.backgroundColor='#ad8c72'" class="d-inline-block link-light mt-2 mb-4 px-3 py-2 py-1 font-medium rounded text-sm mb-2" style="background-color: #ad8c72;"><?= ucwords($posts->data()->cat_title) ?></a>
                    </div>
                    <hr />
                    <img class="img-responsive my-1" src="<?= ($posts->data()->post_image == '1') ? './uploads/img/default.png' : '.' . trim($posts->data()->post_image, '.') ?>" alt="" width="100%" style="height: 350px; object-fit: contain;" />
                    <hr />

                    <div class="py-3 font-meduim text-lg text-justify tracking-wide leading-10 indent-16 my-4 mx-auto" style="max-width: 70ch;">
                        <?= $posts->data()->post_content ?>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <strong>Tags: </strong>
                            <?php foreach (Tags::strSplit(',', $posts->data()->post_tags) as $post_tags) : ?>
                                <a href="tags?tags=<?= $post_tags ?>" class="d-inline-block bg-secondary link-light p-1 font-medium rounded text-sm mb-2"><?= ucwords($post_tags) ?></a>
                            <?php endforeach; ?>
                        </div>
                        
                        <div>
                            <?php if ($user->isLoggedIn() && $user->data()->user_role == "Subscriber" || $user->data()->user_role == "Author") : ?>
                                <?php if ($favorites->find(Input::get('post_id'))) : ?>

                                    <!-- Remove to favorites -->
                                    <form method="post" class="d-inline-block">
                                        <button type="submit" id="btn-favorites" name="remove_to_favorites" title="Remove to Favorites" class="btn btn-secondary me-2"><i class="fas fa-star"></i></button>
                                    </form>

                                <?php else : ?>

                                    <!-- Add to favorites -->
                                    <form method="post" class="d-inline-block">
                                        <button type="submit" id="btn-favorites" name="add_to_favorites" title="Add to Favorites" class="btn btn-secondary me-2"><i class="far fa-star"></i></button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                            <a href="./pdf_print.php?post_id=<?= Input::get('post_id') ?>" class="btn btn-success me-2" title="Print as PDF"><i class="fas fa-print"></i></a>
                            <a href="./pdf_download.php?post_id=<?= Input::get('post_id') ?>" class="btn btn-outline-primary" title="Download as PDF" style="font-size: 15px;"> <i class="fas fa-file-download me-2"></i> Download</a>
                        </div>
                    </div>

                </div>
                <!-- Blog end -->
                <hr>

                <!-- Comments Form -->
                <div class="p-4 bg-light font-medium">
                    <h3 class="font-semibold text-2xl mb-3">Leave a Comment:</h3>

                    <?php if ($user->isLoggedIn()) :  ?>
                        <form method="post" role="form">

                            <input type="hidden" name="token" value="<?= Token::generate() ?>">

                            <div class="form-group mb-2">
                                <textarea class="form-control" name="comment_content" rows="3" placeholder="Join the discussion and leave a comment!" style="resize: none; min-height: 300px;"></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary float-right my-2" name="submit_comment">
                                    Submit
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    <?php else : ?>
                        <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 250px;">
                            <h2 class="my-3 font-medium text-xl"> Login or Sign up to add your comment</h2>
                            <div class="w-100 d-flex justify-content-center">
                                <a href="login" class="btn btn-primary w-25 font-extrabold me-2"> Login</a>
                                <a href="signup" class="btn btn-outline-success font-extrabold w-25"> Sign Up</a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <hr>



                <!-- Comments section-->
                <section class="my-5 p-0">
                    <div class="">
                        <h3 class="font-semibold text-2xl mb-4">Comments: </h3>

                        <!-- Comment form-->
                        <!-- Comment with nested comments-->
                        <div class="d-flex flex-column mt-3 ml-3">

                            <?php if ($comments->countCommentsByPost(Input::get('post_id')) == 0) : ?>
                                <div class="text-center font-semibold text-2xl d-flex flex-column gap-4 justify-content-center align-items-center" style="height: 250px;">
                                    <div class="text-4xl">
                                        <i class="fas fa-comment me-2"></i>
                                    </div>
                                    No Comments Found!
                                </div>
                            <?php else : ?>
                                <?php foreach ($comments->getCommentsEveryUserByPostId(Input::get('post_id')) as $comment) : ?>

                                    <div class="d-flex mb-4">

                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhoue1tte-glasses-profile.jpg" height="50px" width="50px" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="font-medium text-base">
                                                <span class="fw-bold mr-2">

                                                    <?= $comment->user_firstname . " " . substr($comment->user_middlename, 0, 1) . " " . $comment->user_lastname ?>
                                                    <small class="text-muted"><?= $comment->user_email ?></small>
                                                </span>
                                                <span class="mr-3" style="border-right: 2px solid #ccc;">
                                                </span>
                                                <?= Date::date_formmatted($comment->comment_date) ?> at <?= Date::time_format($comment->comment_date) ?>

                                                <?php if ($user->isLoggedIn() && $user->data()->user_id == $comment->comment_user_id && $user->data()->user_role == "Subscriber" || $user->data()->user_role == "Admin") : ?>

                                                    <span class="mx-3" style="border-right: 2px solid #ccc;"></span>

                                                    <!-- Modal Edit Comment -->
                                                    <button data-bs-target="#editComment<?= $comment->comment_id ?>" class="editIconContainer" data-bs-toggle="modal" style="background: transparent;">
                                                        <i class="fa fa-cog me-1" id="editIcon"></i> Edit
                                                    </button>

                                                <?php endif; ?>
                                            </div>

                                            <span class="font-medium text-lg"><?= $comment->comment_content ?></span>
                                        </div>

                                    </div>
                                    <?php $comments->getId($comment->comment_id) ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                    </div>

                </section>


            </div>

            <!-- Modal -->
            <div class="modal fade" id="editComment<?= $comment->comment_id ?? '' ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border: none;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span style="color:#D0B49F;"> Update </span>user</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="post_id1" value="<?= $comment->comment_post_id ?>">
                                <input type="hidden" name="comment_id" value="<?= $comment->comment_id ?>">

                                <div class="form-group mb-2">
                                    <label for="post_title" class="form-label">Your Comment: </label>
                                    <textarea class="form-control" name="comment_content" rows="3" placeholder="Join the discussion and leave a comment!" style="resize: none; min-height: 300px;"><?= $comment->comment_content ?></textarea>
                                </div>
                                <div id="editingDiv"> </div>


                                <div class="clearfix"></div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                    <button type="submit" name="update_comment" class="btn btn-success float-end py-2">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Search -->
            <?php include 'includes/blogsearch.php' ?>

            <!-- Blog Categories -->
            <?php include 'includes/blogcategories.php' ?>

        </div>
        <!-- /.row -->

    </div>
    </div>


<?php
    include "includes/footer.php";
}
?>