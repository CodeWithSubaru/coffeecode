<?php
include "./includes/navbar.php";
$favorites = new Favorites();

$user = new User();


if (isset($_POST['delete_favorite'])) {
    dd($favorites->remove());
}


?>




<!-- Start of content -->

<div class="container mb-3" style="background: unset !important; padding: unset; box-shadow: unset !important;">
    <div class="d-flex justify-content-end">
        <a href="index" class="btn btn-primary"> << Go Back to Homepage </a>
    </div>
</div>


<div class="min-height">
    <?php 
    //    Session::flashMessage($favorites->error);
      
    ?>

    

    <div class="container animate__animated animate__fadeIn animate__fast shadow-sm">

        <div class="row ">
            <h1 class="card-header font-semibold text-xl tracking-tight" style="background-color: white; border-top-right-radius: 15px; border-top-left-radius: 15px;">
                <i class="fas fa-star me-2"></i>
                <span style="color: #D0B49F;">Favorites</span>
            </h1>

        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple" class="table table-hover" style="min-height: 200px;">
                <thead>
                    <tr>
                        <th style="min-width: 200px;">Id</th>
                        <th>Favorite Posts</th>
                        <th class="" style="height: 100%; min-width: 250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $i = 1; ?>
                    <?php foreach ( $favorites->allByUser() as $favorite ): ?>
                    <tr>
                        <td> <?= $i++; ?> </td>
                        <td>
                            <a href="./post.php?post_id=<?= $favorite->post_id ?>" style="color: #0d6efd; text-decoration: underline;">
                                <?= $favorite->post_title ?>

                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill w-25" data-bs-toggle="modal" data-bs-target="#removeBookmark<?=$favorite->favorite_id?>">

                                <i class="fas fa-trash-alt me-2"></i> Remove

                            </button>
                        </td>
                    </tr>


                    <!-- Modal Delete User -->
                    <div class="modal" id="removeBookmark<?=$favorite->favorite_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow" style="border: none;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 20px;"><i class="fas fa-star me-2 font-bold"></i><span style="color: #d0b49b;"> Remove </span> Favorite Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post">
                                <div class="modal-body px-5 mb-3 d-flex justify-content-between align-items-center">

                                    <!-- Body Modal -->
                                        <input type="hidden" name="favorite_id" value="<?=$favorite->favorite_id?>">
                                        <div>
                                            <i class="fas fa-exclamation-triangle me-4 text-warning" style="font-size: 50px;"></i>
                                        </div>

                                        <div>
                                            <h2 class="text-warning mb-1" style="font-size: 32px;"> Warning! </h2>
                                            <p class="font-bold"> Are you sure you want to remove this favorite post? </p>
                                        </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle me-2"></i> Cancel</button>
                                    <button type="submit" name="delete_favorite" class="btn btn-success text-uppercase"> <i class="fas fa-check-circle me-2"></i> Yes </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>

        <?php endforeach; ?>
        </tbody>

        <tfooter>
            <th style="min-width: 200px;">Id</th>
            <th>Favorite Posts</th>
            <th class="" style="height: 100%; min-width: 250px;">Action</th>
        </tfooter>
        </table>
    </div>
</div>
</div>

</div>
</div>
<!-- End -->

<!-- /. col-md-8 -->

<!-- col-md-4 -->
<!-- /.row -->

</div>

<?php include 'includes/footer.php';