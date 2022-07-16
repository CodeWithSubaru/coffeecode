<?php
include "./includes/navbar.php";

$users = new User();
if (isset($_POST['allow']) || isset($_POST['deny'])) {
    $users->updatePermission();
}
?>
<div id="layoutSidenav_content">


    <main>
        <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4">
            <h1 class="mt-4">Requests to be Author</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
                <li class="breadcrumb-item" style="color:#6c757d;">Requests to be Author</li>
            </ol>

            <?php Session::flashMessage($users->error); ?>
            <div class="d-flex justify-content-center">
                <div class="card mb-4 shadow w-75">
                    <h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;font-size: 20px;"><i class="fas fa-eye me-2"></i> <span style="color: #D0B49F;">View</span> </h4>

                    <div class="card-body">
                        <table id="datatablesSimple" class="border">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th class="w-75 text-center">Applicant's Name</th>
                                    <th> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users->getRequestToBeAuthor() as $user) : ?>
                                    <tr>
                                        <td><?= $user->user_id ?></td>
                                        <td class="text-center"><?= $user->user_firstname  . " " . substr($user->user_middlename, 0, 1) . ". " . $user->user_lastname ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning rounded-pill mb-2 w-50" data-bs-toggle="modal" data-bs-target="#allow<?= $user->user_id ?>">

                                                <i class="fas fa-check-circle me-2 text-light"></i> Allow

                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger rounded-pill mb-2 w-50" data-bs-toggle="modal" data-bs-target="#deny<?= $user->user_id ?>">

                                                <i class="fas fa-times-circle me-2"></i> Deny

                                            </button>

                                            <!-- Modal Allow -->
                                            <div class="modal myModal" id="allow<?= $user->user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content shadow mt-5" style="border: none;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit me-2"></i><span style="color: #D0B49F;">Allow </span>to be Author</span> </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">


                                                                <div class="d-flex justify-content-center px-5">

                                                                    <div class="d-flex align-items-center">
                                                                        <i class="fas fa-exclamation-triangle me-4 text-warning" style="font-size: 50px;"></i>
                                                                    </div>

                                                                    <div>
                                                                        <h2 class="text-warning"> Warning! </h2>
                                                                        <p> Are you sure you want to <strong class="">"Allow"</strong> this user to be an author? </p>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                                                                <input type="hidden" name="permission" value="2">
                                                                <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                                                                <button type="submit" name="allow" class="btn btn-success text-uppercase"> <i class="fas fa-check-circle me-2 text-light"></i>YES</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Delete User -->
                                            <div class="modal" id="deny<?= $user->user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content shadow" style="border: none;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-users me-2"></i><span style="color: #d0b49b;"> Deny </span> to be Author</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body px-5 mb-3 d-flex justify-content-center align-items-center">

                                                                <!-- Body Modal -->

                                                                <div>
                                                                    <i class="fas fa-exclamation-triangle me-4 text-warning" style="font-size: 50px;"></i>
                                                                </div>

                                                                <div>
                                                                    <h2 class="text-warning"> Warning! </h2>
                                                                    <p> Are you sure you want to <strong>"Deny"</strong> request to be an author? </p>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                                                                <input type="hidden" name="permission" value="0">
                                                                <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle me-2"></i> Cancel</button>
                                                                <button type="submit" name="deny" class="btn btn-success text-uppercase"> <i class="fas fa-check-circle me-2"></i> Yes </button>
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
                    <th class="text-center">Applicant's Name</th>
                    <th>Actions</th>
                </tfooter>
                </table>
                </div>
            </div>
        </div>
        <!-- End -->
</div>
</main>

<?php
include "./includes/footer.php";
?>