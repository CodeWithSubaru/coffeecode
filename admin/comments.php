<?php
include "./includes/navbar.php";

$user = new User();
$date = new Date();
$comments = new Comments();
if (isset($_POST['update_comment'])) {
  $comments->updatecomment();
}

if (isset($_POST['delete_comment'])) {

  $comments->delete();
}
?>
<div id="layoutSidenav_content">


  <main>
    <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4">
      <h1 class="mt-4">Comments</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
        <li class="breadcrumb-item" style="color:#6c757d;">Comments</li>
      </ol>

      <?php Session::flashMessage($comments->error); ?>

      <div class="card mb-4 shadow">
        <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;font-size: 20px;"><i class="fas fa-eye me-2"></i> <span style="color: #D0B49F;">View</span> Comments</h4>

        <div class="card-body">
          <table id="datatablesSimple" class="border">
            <thead>
              <tr>
                <th>Id</th>
                <th>Commentor's Name</th>
                <th>Commentor's Email</th>
                <th style="max-width: 50px;">Comments</th>
                <th>In Response To</th>
                <th style="min-width: 100px;">Date</th>
                <th style="height: 100%; min-width: 250px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($comments->all() as $comment) : ?>
                <?php $user->find($comment->comment_user_id); ?>
                <tr>
                  <td><?= $comment->comment_id ?></td>
                  <td><?= $user->data()->user_firstname  . " " . substr($user->data()->user_middlename, 0, 1) . ". " . $user->data()->user_lastname ?></td>
                  <td><?= $user->data()->user_email ?></td>
                  <td class="w-25"><?= substr($comment->comment_content, 0, 200) ?></td>
                  <td>
                    <form method="post" action="../post?post_id=<?= $comment->comment_post_id ?>">
                      <input type="hidden" name="v" value="1">

                      <input type="submit" class="link-primary" id="btn-reset" value="<?= $comment->post_title ?>">
                    </form>
                  </td>
                  <td><?= Date::date_formmatted($comment->comment_date) ?> at <?= Date::time_format($comment->comment_date) ?></td>

                  <td class="text-center">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-success rounded-pill mb-2 w-50" data-bs-toggle="modal" data-bs-target="#editComment<?= $comment->comment_id ?>" style="background:#F9AB00; border: 1px solid #F9AB00;">

                      <i class="fas fa-edit me-2"></i> Edit

                    </button>

                    <!-- getting id of user to load on modal -->

                    <button type="button" class="btn btn-sm btn-danger rounded-pill w-50" data-bs-toggle="modal" data-bs-target="#deleteComment<?= $comment->comment_id ?>">

                      <i class="fas fa-trash-alt"></i> Delete

                    </button>

                    <?php $comments->getId($comment->comment_id); ?>

                  </td>


                  <!-- Modal Edit User -->
                  <div class="modal myModal" id="editComment<?= $comment->comment_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content shadow mt-5" style="border: none;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit me-2"></i><span style="color: #D0B49F;">Update</span> comments</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5">

                          <form method="post" enctype="multipart/form-data">

                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                            <input type="hidden" name="comment_id" value="<?= $comments->data()->comment_id ?>">

                            <input type="hidden" name="post_id1" value="<?= $comments->data()->comment_post_id ?>">

                            <div class="form-group">
                              <label for="comment_author">Author</label>
                              <input type="text" name="comment_author" class="form-control" value="<?= $comments->data()->user_firstname  . " " . substr($comments->data()->user_middlename, 0, 1) . ". " . $comments->data()->user_lastname ?>" readonly>
                            </div>

                            <div class="form-group">
                              <label for="comment_email">Email</label>
                              <input type="email" name="comment_email" class="form-control" value="<?= $comments->data()->user_email ?>" readonly>
                            </div>

                            <div class="form-group">
                              <label for="comment_post">Comment Response to</label>
                              <input type="text" name="comment_post" class="form-control" value="<?= $comments->data()->post_title ?>" readonly>
                            </div>

                            <div class="form-group">
                              <label for="comment_content">Comment Content</label>
                              <textarea name="comment_content" class="form-control" rows="10" style="resize: none;"><?= strip_tags($comments->data()->comment_content) ?></textarea>
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

                  <!-- Modal Delete User -->
                  <div class="modal" id="deleteComment<?= $comment->comment_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content shadow" style="border: none;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-comment me-2"></i><span style="color: #d0b49b;"> Delete </span> Comment</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5 mb-3 d-flex justify-content-between align-items-center">

                          <!-- Body Modal -->
                          <form method="post">

                            <input type="hidden" name="comment_id" value="<?= $comments->data()->comment_id ?>">

                            <div>

                              <i class="fas fa-exclamation-triangle me-4 text-warning" style="font-size: 50px;"></i>
                            </div>

                            <div>
                              <h2 class="text-warning"> Warning! </h2>
                              <p> Are you sure you want to delete this comment? </p>
                            </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle me-2"></i> Cancel</button>
                          <button type="submit" name="delete_comment" class="btn btn-success text-uppercase"> <i class="fas fa-check-circle me-2"></i> Yes </button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
        </div>


        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfooter>
        <th>Id</th>
        <th>Author</th>
        <th>Email</th>
        <th>Comments</th>
        <th>In Response To</th>
        <th>Date</th>
        <th>Action</th>
      </tfooter>
      </table>
      </div>
    </div>
    <!-- End -->
</div>
</main>

<?php
include "./includes/footer.php";
?>