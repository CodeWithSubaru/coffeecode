<?php
include "./includes/navbar.php";
spl_autoload_register(fn ($class) => require_once '../classes/' . $class . '.php');
Session::put('page', 'dashboard');
$user = new User();
?>
<div id="layoutSidenav_content" class="animate__animated animate__fadeIn">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard </li>
      </ol>

      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow" style="border: none;border-radius: 15px;">
            <a class="card-body" style="text-decoration: none;" ; href="viewpost">
              <div class="row">
                <div class="col-xs-3 px-4" style="font-weight: normal;">
                  <img src="./img/page.svg" class="w-25 h-100" style="float: right;" alt="">
                  <div class="col-xs-9 text-right">
                    <div class="" style="font-size: 80px;margin-bottom: -20px;color: #287bff;">
                      <?= Post::count_row(); ?>
                    </div>
                    <div class="" style="font-size: 25px;color: #999;">Posts</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow" style="border: none;border-radius: 15px;">
            <a class="card-body" style="text-decoration: none;" ; href="comments">
              <div class="row">
                <div class="col-xs-3 px-4" style="font-weight: normal;">
                  <img src="./img/comments.svg" class="w-25 h-100" style="float: right;" alt="">
                  <div class="col-xs-9 text-right">
                    <div class="" style="font-size: 80px;margin-bottom: -20px;color: #287bff;">
                      <?= Comments::count_row(); ?>
                    </div>
                    <div class="" style="text-overflow: ellipsis;overflow: hidden; white-space: nowrap;font-size: 25px;color: #999;">Comments</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow" style="border: none;border-radius: 15px;">
            <a class="card-body" style="text-decoration: none;" ; href="user">
              <div class="row">
                <div class="col-xs-3 px-4" style="font-weight: normal;">
                  <img src="./img/user.svg" class="w-25 h-100" style="float: right;" alt="">
                  <div class="col-xs-9 text-right">
                    <div class="" style="font-size: 80px;margin-bottom: -20px;color: #287bff;">
                      <?= User::count_row() ?>
                    </div>
                    <div class="" style="font-size: 25px;color: #999;">
                      Users
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow" style="border: none;border-radius: 15px;">
            <a class="card-body" style="text-decoration: none;" ; href="categories">
              <div class="row">
                <div class="col-xs-3 px-4" style="font-weight: normal;">
                  <img src="./img/category.svg" class="w-25 h-100" style="float: right;" alt="">
                  <div class="col-xs-9 text-right">
                    <div class="" style="font-size: 80px;margin-bottom: -20px;color: #287bff;">
                      <?= Category::count_row() ?>
                    </div>
                    <div class="" style="text-overflow: ellipsis;overflow: hidden; white-space: nowrap;font-size: 25px;color: #999;">Categories</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>


      <!-- User Table -->

      <div class="row">
        <div class="col-lg-6 mb-4">
          <div class="card shadow p-5" style="border: none;border-radius: 15px;min-height: 410px;">

            <div class="d-flex justify-content-between w-100" style="font-size: 25px; font-weight: bold;">
              <div class="d-flex align-items-center text-primary">
                <img src="./img/user.svg" class="me-2" style="width: 20px;" alt="">
                Recent Users
              </div>
              <a href="users" class="btn btn-primary px-3 py-2 rounded-3">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>

            <div class="card-body overflow-auto">
              <table class="table w-100">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (User::limit(5) as $user) : ?>
                    <tr>
                      <td>
                        <?= $user->username ?>
                      </td>
                      <td>
                        <?= $user->user_email ?>
                      </td>
                      <td>
                        <?= $user->user_role ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- Bar Chart -->

        <div class="col-lg-6 mb-4">
          <div class="card shadow p-5" style="border: none; border-radius: 15px;">
            <div class="d-flex align-items-center" style="font-size: 25px;">
              <img src="./img/count.svg" class="me-2" style="width: 20px;" alt="">
              Count
            </div>
            <div class="card-body d-flex justify-content-center overflow-auto">
              <canvas id="myPieChart" style="max-width: 500px;">
              </canvas>
            </div>
          </div>
        </div>
      </div>


      <!-- Comments -->

      <div class="row">

        <div class="col-lg-8 mb-4">
          <div class="card shadow p-5" style="border: none; border-radius: 15px;">
            <div class="d-flex justify-content-between w-100" style="font-size: 25px;">
              <div class="d-flex align-items-center text-danger" style="color: #287bff;">
                <img src="./img/comments.svg" class="me-2" style="width: 20px;" alt="">
                Recent Comments
              </div>
              <a href="comments" class="btn btn-danger px-3 py-2 rounded-3">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="card-body d-flex justify-content-center overflow-auto" style="min-width:0;">
              <table class="table w-100">
                <thead>
                  <tr>
                    <th>Author</th>
                    <th>Content</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (Comments::limit() as $comment) : ?>
                    <tr>
                      <td>
                        <?= $comment->user_firstname . " " . substr($comment->user_middlename, 0, 1) . ". " . $comment->user_lastname ?>
                      </td>
                      <td>
                        <?= $comment->comment_content ?>
                      </td>
                      <td>
                        <?= Date::date_formmatted($comment->comment_date) ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
  </main>
  <?php
  include "./includes/footer.php";
  ?>