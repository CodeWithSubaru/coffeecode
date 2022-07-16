<?php
include "./includes/navbar.php";
$users = new User();
$user->admin();

if (isset($_POST['update_user'])) {
  $user->updateuser();
}
if (isset($_POST['delete_user'])) {
  $user->delete();
}
?>
<div id="layoutSidenav_content">

  <main class="mb-4">
    <div class="container-fluid px-4 animate__animated animate__fadeIn animate__fast">
      <h1 class="mt-4">Users</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
        <li class="breadcrumb-item" style="color:#6c757d;">Users</li>
      </ol>

      <?= Session::flashMessage($user->error) ?>

      <form method="post">
        <!-- Full Width -->
        <div class="card mt-4 drop-shadow-md">
          <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px; font-size: 20px;"><i class="fas fa-user-tie me-2"></i><span style="color: #D0B49F;"> Users</span></h4>
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Assign as</th>
                  <th>Country</th>
                  <th>Actions</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach ($users->all() as $user) : ?>
                  <tr>
                    <td><?= $user->user_id ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->user_firstname ?></td>
                    <td><?= $user->user_middlename ?></td>
                    <td><?= $user->user_lastname ?></td>
                    <td><?= $user->user_email ?></td>
                    <td><?= $user->user_role ?></td>
                    <td><?= $user->country ?></td>
                    <td>
                      <a href='users?<?= $user->user_role == 'Admin' ? "subscriber={$user->user_id}" : "admin={$user->user_id}" ?>' class='me-1 link-success'>
                        <?= $user->user_role == 'Admin' ? "Subscriber" : "Admin" ?>
                      </a>
                    </td>

                    <td class="text-center">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-sm btn-success rounded-pill mb-2 w-50" data-bs-toggle="modal" data-bs-target="#editUser<?= $user->user_id ?>" style="background:#F9AB00; border: 1px solid #F9AB00;">

                        <i class="fas fa-edit me-2"></i> Edit

                      </button>

                      <!-- getting id of user to load on modal -->

                      <button type="button" class="btn btn-sm btn-danger rounded-pill w-50" data-bs-toggle="modal" data-bs-target="#deleteUser<?= $user->user_id ?>">

                        <i class="fas fa-trash-alt"></i> Delete

                      </button>

                      <?php $users->getId($user->user_id); ?>

                    </td>

                    <!-- Modal Edit User -->
                    <div class="modal myModal" id="editUser<?= $user->user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow" style="border: none;">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-tie me-2"></i><span style="color: #d0b49b;"> Edit</span> Users</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body px-5 pb-4 mb-3">

                            <form method="post" class="" enctype="multipart/form-data">

                              <input type="hidden" name="user_id" value="<?= $users->data()->user_id ?>">

                              <div class="row">
                                <div class="col-md-4 form-group">
                                  <label for="user_firstname" class="form-label">Firstname</label>
                                  <input type="text" name="user_firstname" class="form-control" value="<?= $users->data()->user_firstname ?>">
                                </div>

                                <div class="col-md-4 form-group">
                                  <label for="user_firstname" class="form-label">Middlename</label>
                                  <input type="text" name="user_middlename" class="form-control" value="<?= $users->data()->user_middlename ?>">
                                </div>

                                <div class="col-md-4 form-group">
                                  <label for="user_firstname" class="form-label">Lastname</label>
                                  <input type="text" name="user_lastname" class="form-control" value="<?= $users->data()->user_lastname ?>">
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="user_firstname" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="<?= $users->data()->username ?>">
                              </div>

                              <div class="form-group">
                                <label for="user_email" class="form-label">Email</label>
                                <input type="text" name="user_email" class="form-control" value="<?= $users->data()->user_email ?>">
                              </div>

                              <div class="form-group">
                                <label class="labels" class="form-label">Role</label>
                                <input type="text" name="role" class="form-control" placeholder="enter phone number" value="<?= $users->data()->user_role ?>">
                              </div>

                              <div class="form-group">
                                <label class="labels" class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="country" value="<?= $users->data()->country ?>">
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                <button type="submit" name="update_user" class="btn btn-success text-uppercase"> <i class="fas fa-save"></i> Save</button>
                              </div>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Delete User -->
                    <div class="modal" id="deleteUser<?= $user->user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow" style="border: none;">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-tie me-2"></i><span style="color: #d0b49b;"> Delete </span> Users</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body px-5 mb-3 d-flex justify-content-between align-items-center">

                            <!-- Body Modal -->
                            <form method="post">
                              <input type="hidden" name="user_id" value="<?= $users->data()->user_id ?>">
                            </form>

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
                            <button type="submit" name="delete_user" class="btn btn-success text-uppercase"> <i class="fas fa-check-circle me-2"></i> Yes </button>
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
  <th>ID</th>
  <th>Username</th>
  <th>Firstname</th>
  <th>Lastname</th>
  <th>Email</th>
  <th>Role</th>
  <th>Assign as</th>
  <th>Country</th>
  <th>Action</th>
</tfooter>
</table>
</div>
<!-- End -->
</form>
</div>
</main>




<?php
include "./includes/footer.php";
?>