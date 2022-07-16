<?php
include "./includes/navbar.php";

$profile = new User();

if (isset($_POST['update_profile'])) {
  $profile->updateuser();
}


?>
<div id="layoutSidenav_content">
  <?php Session::flashMessage($profile->error); ?>
  <main>
    <div class="container-fluid px-4 animate__animated animate__fadeIn animate__fast">
      <h1 class="mt-4">Profile</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
        <li class="breadcrumb-item" style="color:#6c757d;">Profile</li>
      </ol>
      <!-- Full Width -->
      <div class="container">
        <div class="card mb-4 shadow ">
          <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px; font-size: 20px;"><i class="fas fa-address-card me-2"></i><span style="color: #D0B49F;"> Profile</span></h4>

          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center p-3 "><img class="rounded-circle" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhoue1tte-glasses-profile.jpg">
              <span class="font-weight-bold"><?= $profile->data()->username ?></span><span class="text-black-50"><?= $profile->data()->user_email ?></span><span> </span>
            </div>

            <div class="p-3 py-5 ">

              <div class="row mt-2">
                <div class="col-md-4">
                  <label class="labels">Name</label>
                  <input type="text" name="user_firstname" class="form-control" placeholder="first name" value="<?= $profile->data()->user_firstname ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label class="labels">Middlename</label>
                  <input type="text" name="user_middlename" class="form-control" placeholder="middle name" value="<?= $profile->data()->user_middlename ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label class="labels">Surname</label>
                  <input type="text" name="user_lastname" class="form-control" value="<?= $profile->data()->user_lastname ?>" readonly placeholder="surname">
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-12">
                  <label class="labels">Role</label>
                  <input type="text" class="form-control" name="user_role" readonly placeholder="enter phone number" value="<?= $profile->data()->user_role ?>">
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  <label class="labels">Country</label>
                  <input type="text" class="form-control" name="country" readonly placeholder="country" value="<?= $profile->data()->country ?>">
                </div>
              </div>

              <!-- Button trigger modal -->
              <div class="mt-5 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfile<?= $profile->data()->user_id ?>">
                  Edit
                </button>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- End -->
    </div>
  </main>



  <!-- Modal -->
  <div class="modal fade" id="editProfile<?= $profile->data()->user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border: none;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span style="color:#D0B49F;"> Update </span>Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" class="" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $profile->data()->user_id ?>">

            <div class="row">
              <div class="col-md-4 form-group">
                <label for="user_firstname" class="form-label">Firstname</label>
                <input type="text" name="user_firstname" class="form-control" value="<?= $profile->data()->user_firstname ?>">
              </div>

              <div class="col-md-4 form-group">
                <label for="user_firstname" class="form-label">Middlename</label>
                <input type="text" name="user_middlename" class="form-control" value="<?= $profile->data()->user_middlename ?>">
              </div>

              <div class="col-md-4 form-group">
                <label for="user_firstname" class="form-label">Lastname</label>
                <input type="text" name="user_lastname" class="form-control" value="<?= $profile->data()->user_lastname ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="user_firstname" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" value="<?= $profile->data()->username ?>">
            </div>

            <div class="form-group">
              <label for="user_email" class="form-label">Email</label>
              <input type="text" name="user_email" class="form-control" value="<?= $profile->data()->user_email ?>">
            </div>

            <div class="form-group">
              <label class="labels" class="form-label">Role</label>
              <input type="text" name="role" class="form-control" placeholder="enter phone number" value="<?= $profile->data()->user_role ?>">
            </div>

            <div class="form-group">
              <label class="labels" class="form-label">Country</label>
              <input type="text" name="country" class="form-control" placeholder="country" value="<?= $profile->data()->country ?>">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
          <button type="submit" name="update_profile" class="btn btn-success text-uppercase"> <i class="fas fa-save"></i> Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  include "./includes/footer.php";
  ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>