<?php
include "includes/navbar.php";
$comments = new Comments();

if(isset($_POST['update_comment'])) {
    $comments->updatecomment();
}
?>
<!-- Start of content -->

                <?php Session::flashMessage($comments->error); ?>

        <div class="container mb-3" style="background-color: unset !important; padding: unset; box-shadow: unset !important;">
            <div class="d-flex justify-content-end">
              <a href="./" class="btn btn-primary"> << Go back to Homepage </a>
            </div>
        </div>
        <div class="min-height">
                <div class="container col-md-4 animate__animated animate__fadeIn animate__fast shadow-sm">
                    <div class="row">
                <h1 
                    class="card-header p-3 font-semibold text-xl tracking-tight" style="background: white;border-top-right-radius: 15px; border-top-left-radius: 15px;">
                    <i class="fas fa-comment me-2"></i>
                    <span style="color: #D0B49F;"> My</span> Comments
                </h1>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="datatablesSimple" class="table table-hover" style="min-height: 200px;">
                                <thead>
                                    <tr>
                                        <th style="max-width: 50px;">Comments</th>
                                        <th>In Response To</th>
                                        <th style="min-width: 100px;">Date</th>
                                        <th class="text-center" style="height: 100%; min-width: 250px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($comments->commentsByUserId() as $comment) : ?>
                                        <?php if ($comment->comment_user_id == $user->data()->user_id) : ?>
                                            <?php $comments->commentsbyPostId() ?>
                                            <tr>
                                                <td class="w-50"><?= substr($comment->comment_content, 0, 200) ?></td>
                                                <td><a href="post?post_id=<?= $comment->comment_post_id ?>" class="text-primary underline underline-offset-3"><?= $comments->getPostTitles() ?></a></td>
                                                <td><?= date_format(date_create($comment->comment_date), 'F d, Y') ?></td>
                                                <td class="text-center">
                                                <button 
                                                    type="button" 
                                                    class="btn btn-sm btn-success rounded-pill mb-2 w-25" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editComment<?=$comment->comment_id?>" 
                                                    style="background:#F9AB00; border: 1px solid #F9AB00;">

                                                    <i class="fas fa-edit me-2"></i> Edit

                                                </button> 

                                                        <?php $comments->getId($comment->comment_id); ?>
                                                </td>

                                                        <!-- Modal Edit User -->
                                                        <div class="modal myModal" id="editComment<?=$comments->data()->comment_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content shadow mt-5" style="border: none;">
                                                            <div class="modal-header">

                                                                <h1 class="modal-title text-xl"     id="exampleModalLabel"><i class="fas fa-edit me-2"></i><span style="color: #D0B49F;">Update</span> Comment</h1>
                                                                
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body px-5">
                                                            <?php if ($user->isLoggedIn()) :  ?>

                                                                <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4 my-3 w-100">
                                                                <form action="" method="post" enctype="multipart/form-data" id="formData">

                                                                        <input type="hidden" name="token" value="<?= Token::generate('token')  ?>">
                                                                        <input type="hidden" name="post_id1" value="<?= $comments->data()->comment_post_id ?>">

                                                                        <input type="hidden" name="comment_id" value="<?= $comments->data()->comment_id ?>">

                                                                        <div class="form-group mb-2">
                                                                            <label for="post_title" class="form-label">Your Comment: </label>
                                                                            <textarea class="form-control" name="comment_content" rows="3" placeholder="Join the discussion and leave a comment!" style="resize: none; min-height: 300px;"><?= $comments->data()->comment_content ?></textarea>
                                                                        </div>

                                                                        <div class="clearfix"></div>
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
                                                            
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                                    <button type="submit" name="update_comment" class="btn btn-success text-uppercase"> <i class="fas fa-save"></i> Save</button>
                                                                </div>

                                                            </form>  
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                

                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfooter>
                                    <th>Comments</th>
                                    <th>In Response To</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                    </div>
        

                </div>
            </div>
        </div>
        <!-- /.row -->

        </div>

<?php
include "includes/footer.php";
?>