<?php
include "./includes/navbar.php";

$post = new Post();
$category = new Category();
$post->updatepost();
?>
<div id="layoutSidenav_content">

    <main>
        <div class="animate__animated animate__fadeIn animate__fast container-fluid px-4 my-3 w-100">
            <div class="d-flex justify-content-between mt-4">
                <h1> Update Post</h1>
                <div>
                    <!-- Button Going back to view post -->
                    <a href="viewpost" class="btn btn-primary">
                        << Go back To View Post </a>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index">Dashboard</a></li>
                <li class="breadcrumb-item">Update Post</li>
            </ol>

            <?php Session::flashMessage($post->error) ?>

            
        </div>
    </main>
    <?php
    include "./includes/footer.php";
    ?>