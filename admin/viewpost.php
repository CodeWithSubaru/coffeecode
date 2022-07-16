<?php
include "./includes/navbar.php";
$posts = new Post();
$category = new Category();
if (isset($_POST['update_post'])) {
  $posts->updatepost();
}

if (isset($_POST['delete_post'])) {
  $posts->delete();
}

$posts->published();
?>
<div id="layoutSidenav_content">

  <main class="mb-4">
    <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4">
      <div class="d-flex justify-content-between mt-4">
        <h1> View Post</h1>
        <div>
          <!-- Button Going back to view post -->
          <a href="createpost" class="btn btn-primary"> <i class="far fa-plus-square me-1"></i> Add New Post </a>
        </div>
      </div>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
        <li class="breadcrumb-item" style="color:#6c757d;">View Post</li>
      </ol>

      <?php Session::flashMessage($posts->error); ?>

      <!-- Full Width -->
      <div class="card mt-4 drop-shadow-md">
        <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px; font-size: 20px;"><i class="far fa-eye me-2"></i><span style="color: #D0B49F;"> View</span> Post</h4>
        <div class="card-body">
          <table id="datatablesSimple" class="">
            <thead>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th style="min-width: 130px;">Category </th>
                <th>Image</th>
                <th style="height: 100%; min-width: 400px;">Content</th>
                <th>Tags</th>
                <th>Comment Count</th>
                <th>Views Counts</th>
                <th>Status</th>
                <th>Status Update</th>

                <th style="height: 100%; min-width: 250px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($posts->all() as $post) : ?>
                <tr>
                  <td><?= $post->post_id ?></td>
                  <td><?= $post->post_title ?></td>
                  <td><?= $posts->getFullName($post->user_firstname, $post->user_middlename, $post->user_lastname) ?></td>
                  <td><?= date_format(date_create($post->post_date), "F d, Y") ?></td>
                  <td><?= $post->cat_title ?></td>
                  <td class="text-center">
                    <img src="<?= ($post->post_image == '1') ? './uploads/img/default.png' : '..' . trim($post->post_image, '.') ?>" id="img" class="img-thumbnail" alt="" style="min-height: 100px; object-fit: contain;" />

                  </td>
                  <td><?= strlen($post->post_content) > 200 ? substr($post->post_content, 0, 200) . "..." : $post->post_content ?></td>
                  <td class="tags"><?= $post->post_tags ?></td>
                  <td class="text-center"><?= Comments::countCommentsByPost($post->post_id) ?></td>
                  <td class="text-center"><?= $post->post_views_count ?></td>
                  <td><?= $post->post_status ?></td>
                  <td>
                    <?php if ($post->post_status === "Draft") : ?>
                      <a href=" viewpost?publish=<?= $post->post_id ?>" class="me-1 link-success">
                        Publish
                      </a>
                    <?php else : ?>
                      <a href="viewpost?draft=<?= $post->post_id ?>" class="link-danger">
                        Draft
                      </a>

                    <?php endif; ?>
                  </td>
                  <td class="text-center">
                    <a href="../post?post_id=<?= $post->post_id ?>" class="me-2 btn btn-sm btn-primary rounded-pill mb-2 w-50"><i class="fas fa-calendar-day me-2"></i> Details </a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-success rounded-pill mb-2 w-50" data-bs-toggle="modal" data-bs-target="#editPost<?= $post->post_id ?>" style="background:#F9AB00; border: 1px solid #F9AB00;">

                      <i class="fas fa-edit me-2"></i> Edit

                    </button>

                    <!-- getting id of user to load on modal -->

                    <button type="button" class="btn btn-sm btn-danger rounded-pill w-50" data-bs-toggle="modal" data-bs-target="#deletePost<?= $post->post_id ?>">

                      <i class="fas fa-trash-alt"></i> Delete

                    </button>

                    <?php $posts->getId($post->post_id); ?>


                  </td>


                  <!-- Modal Edit User -->
                  <div class="modal myModal" id="editPost<?= $post->post_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content shadow mt-5" style="border: none;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit me-2"></i><span style="color: #D0B49F;">Update</span> Posts</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5">

                          <form action="" method="post" class="" enctype="multipart/form-data">

                            <div class="card-body">

                              <input type="hidden" name="post_id" value="<?= $posts->data()->post_id ?>">

                              <div class="form-group">
                                <label for="post_title">Post Title</label>
                                <input type="text" name="post_title" class="form-control" value="<?= $posts->data()->post_title ?>">
                              </div>

                              <?php $posts->cat_title($posts->data()->post_category_id) ?>

                              <div class="form-group">
                                <label for="post_category_id">Post Category</label>
                                <select name="post_category_id" class="form-select">
                                  <option selected value="<?= $posts->data()->post_category_id ?>">
                                    <?= $posts->cat_title($posts->data()->post_category_id) ?>
                                  </option>
                                  <?= $category->fetchCategoryId(); ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="post_user_id">Post Author</label>
                                  <input type="text" id="disabledTextInput" class="form-control" value="<?= $posts->getFullname($posts->data()->user_firstname, $posts->data()->user_middlename, $posts->data()->user_lastname)  ?>" disabled>
                                  
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
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                              <button type="submit" name="update_post" class="btn btn-success text-uppercase"> <i class="fas fa-save"></i> Save</button>
                            </div>

                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Delete User -->
                  <div class="modal" id="deletePost<?= $post->post_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content shadow" style="border: none;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-tie me-2"></i><span style="color: #d0b49b;"> Delete </span> Users</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5 mb-3 d-flex justify-content-between align-items-center">

                          <!-- Body Modal -->
                          <form method="post">

                            <input type="hidden" name="post_id" value="<?= $posts->data()->post_id ?>">

                            <div>
                              <i class="fas fa-exclamation-triangle me-2 text-warning" style="font-size: 50px;"></i>
                            </div>

                            <div>
                              <h2 class="text-warning"> Warning! </h2>
                              <p> Are you sure you want to delete this user? </p>
                            </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle me-2"></i> Cancel</button>
                          <button type="submit" name="delete_post" class="btn btn-success text-uppercase"> <i class="fas fa-check-circle me-2"></i> Yes </button>
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
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Category</th>
        <th>Image</th>
        <th>Content</th>
        <th>Tags</th>
        <th>Comment Count</th>
        <th>Views Counts</th>
        <th>Status</th>
        <th>Status Update</th>

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