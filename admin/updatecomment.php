<?php
include "./includes/navbar.php";
$comment = new Comments();
$comment->updatecomment();
$comment->all();
$comment->getId();
$comment->getPostByCommentId(Input::get('comment_id'));
?>
<div id="layoutSidenav_content">

    <main>
        <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4 my-3">
            <h1 class="mt-4"> Update Comment</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
                <li class="breadcrumb-item">Update Post</li>
            </ol>

            <?php Session::flashMessage($comment->error); ?>
            
            <form action="" method="post" class="card" enctype="multipart/form-data">
            <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;"><i class="far fa-edit me-2"></i> <span style="color: #D0B49F;">Update</span> Comments</h4>

                <div class="card-body">
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" name="comment_author" class="form-control" value="<?= $comment->getFullName() ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" name="comment_email" class="form-control" value="<?= $comment->getEmail() ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="comment_post">Comment Response to</label>
                        <input type="text" name="comment_post" class="form-control" value="<?= $comment->getPostTitles() ?>" readonly>
                    </div>

                    


                    <div class="form-group">
                        <label for="comment_content">Comment Content</label>
                        <textarea name="comment_content" class="form-control" rows="10" style="resize: none;"><?= $comment->getId()->first()->comment_content ?></textarea>
                    </div>

                    <div class="form-group d-flex">
                        <button type="submit" name="update_post" class="btn btn-success flex-fill">Update Comment</button>
                    </div>


                </div>
            </form>
        </div>
    </main>
    <?php
    include "./includes/footer.php";
    ?>