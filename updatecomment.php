<?php
include "includes/navbar.php";
$comment = new Comments();
$comment->updatecomment();
?>
<!-- Start of content -->
    <div class="row">
        <div class="col-md-10 offset-md-10 mb-3" style="transform: translate(-6.5%,0);">
            <a href="mycomments" class="btn btn-primary "><< Back to My Comments </a>
        </div>
    </div>

    <div class="container animate__animated animate__fadeIn animate__fast container-fluid my-3 w-100 drop-shadow" style="background-color: white;">
    <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12 mb-4">
                

                <?php Session::flashMessage($comment->error); ?>
                <!-- Comments Form -->
                <div class="font-medium">
                <h1 
                    class="card-header pt-3 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;">
                    <i class="fas fa-edit me-2"></i>
                    <span style="color: #D0B49F;"> Edit</span> Comment
                </h1>

                    <?php if ($user->isLoggedIn()) :  ?>
                        <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4 my-3 w-100">
                            <form action="" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="token" value="<?= Token::generate('token')  ?>">
                                <input type="hidden" name="post_id1" value="<?= $comment->getId()->first()->comment_post_id ?>">
                                <input type="hidden" name="comment_status" value="<?= $comment->getId()->first()->comment_status ?>">

                                <div class="form-group mb-2">
                                    <label for="post_title" class="form-label">Your Comment: </label>
                                    <textarea class="form-control" name="comment_content" rows="3" placeholder="Join the discussion and leave a comment!" style="resize: none; min-height: 300px;"><?= $comment->getId()->first()->comment_content ?></textarea>
                                </div>

                                <button type="submit" name="update_post" class="btn btn-success float-end py-2">
                                <i class="fas fa-edit me-1"></i> Update comment
                                </button>

                                <div class="clearfix"></div>
                            </form>
                        <?php else : ?>
                            <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 250px;">
                                <h2 class="my-3 font-semibold text-lg"> Login or Sign up to add your comment</h2>
                                <div class="w-100 d-flex justify-content-center">
                                    <a href="login" class="btn btn-primary w-25 me-2"> Login</a>
                                    <a href="signup" class="btn btn-success w-25"> Sign Up</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        </div>

<?php
include "includes/footer.php";
?>