<?php
spl_autoload_register(fn ($class) => require_once '../classes/' . $class . '.php');
include "./includes/navbar.php";
$categories = new Category();
$session = new Session();
$categories->addcategory();

if (isset($_POST['update_category']))
    $categories->updatecategory();
?>
<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4 my-3">
            <h1 class="mt-4">Category </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
                <li class="breadcrumb-item" style="color:#6c757d;">Category</li>
            </ol>

            <?php Session::flashMessage($categories->error); ?>

            <div class="row">

                <div class="col-md-6">
                    <!-- Add Form -->
                    <form method="post" class="animate__animated animate__fadeIn animate__fast card shadow">


                        <h4 class="card-header pt-3 pl-4 font-semibold tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px; font-size: 20px;"><i class="fas fa-plus-square me-1"></i>
                            <span style="color:#D0B49F;">Add </span> Category
                        </h4>


                        <div class="card-body">
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                            <div class="form-group">
                                <label for="cat_title">Category</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>

                            <div class="form-group float-end">
                                <button type="submit" name="create_category" class="btn btn-primary"><i class="fas fa-plus-square me-1"></i> Add Category</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <!-- End of Add Form -->
                    <?php
                    include 'updatecategories.php';
                    ?>

                </div>
                <!-- col-md-6 -->

                <!-- View Category -->
                <!-- Full Width -->
                <div class="col-md-6 animate__animated animate__fadeIn animate__fast ">
                    <div class="card mb-4 shadow">
                        <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px; font-size: 20px;"><i class="fas fa-eye me-1"></i>
                            <span style="color:#D0B49F;">View </span> Category
                        </h4>


                        <div class="card-body">
                            <table id="datatablesSimple" class="">
                                <thead>
                                    <tr>
                                        <th class="text-center w-25">Id</th>
                                        <th class="text-center w-50">Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories->all() as $category) : ?>
                                        <tr>
                                            <td class="text-center"><?= $category->cat_id ?></td>
                                            <td class="text-center"><?= $category->cat_title ?></td>
                                            <td class="d-flex align-items-center">
                                                <a href="categories?cat_id=<?= $category->cat_id ?>" class="btn btn-sm btn-success rounded-pill me-2" style="background:#F9AB00; border: 1px solid #F9AB00;" id="editcategories">
                                                    <i class="fas fa-edit me-2"></i>
                                                    Edit
                                                </a>
                                                <a href="deletecategory?cat_id=<?= $category->cat_id ?>" class="btn btn-sm btn-danger rounded-pill">
                                                    <i class="fas fa-trash-alt me-2"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfooter>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Category</th>
                                    <th>Action</th>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                    <!-- End -->
                </div>
                <!-- End col-md-6 -->
            </div>
            <!-- row -->
    </main>
    <?php
    include "./includes/footer.php";
    ?>