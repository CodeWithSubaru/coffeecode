<?php

include "includes/navbar.php";
$user = new User();

if (!$user->isLoggedIn() || $user->data()->user_role !== 'Subscriber') {
    header('Location: index');
} else {
    $profile = new User();
    $posts = new Post();
    $categories = new Category();
    $posts->addpost();
?>

                <div class="container" style="background: unset; padding:unset;">
                    <div class="d-flex justify-content-end">
                        <a href="index" class="btn btn-primary "><< Go Back to Homepage </a>
                    </div>
                </div>
                    <!-- First Blog Post -->
                 <div class="container col-md-4 animate__animated animate__fadeIn animate__fast container-fluid my-3 w-100">
                        <div class="row">

                        <h1 
                            class="card-header pt-3 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;">
                            <i class="fas fa-address-card me-2"></i>
                            <span style="color: #D0B49F;">Profile</span>
                        </h1>
                                <div class="card-body p-4" style="overflow-x: auto;">
                                    <div>
                                        <div class="d-flex flex-column align-items-center text-center p-3 "><img class="rounded-circle" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhoue1tte-glasses-profile.jpg">
                                            <span class="font-weight-bold"><?= $profile->data()->username ?></span><span class="text-black-50"><?= $profile->data()->user_email ?></span><span> </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-center ">
                                        <div class="p-3 py-5 ">

                                            <div class="row mt-2">
                                                <div class="col-md-4"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="<?= $profile->data()->user_firstname ?>" readonly></div>
                                                <div class="col-md-4"><label class="labels">Middlename</label><input type="text" class="form-control" placeholder="middle name" value="<?= $profile->data()->user_middlename ?>" readonly></div>
                                                <div class="col-md-4"><label class="labels">Surname</label><input type="text" class="form-control" value="<?= $profile->data()->user_lastname ?>" readonly placeholder="surname"></div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12"><label class="labels">Role</label><input type="text" class="form-control" readonly placeholder="enter phone number" value="<?= $profile->data()->user_role ?>"></div>


                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" readonly placeholder="country" value="<?= $profile->data()->country ?>"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                </div>
                </main>

            <?php
            include "./includes/footer.php";
        }
            ?>
            <script>
                // var savebutton = document.getElementById('savebutton');
                // var readonly = true;
                // var inputs = document.querySelectorAll('input[type="text"]');
                // savebutton.addEventListener('click', function() {

                //     for (var i = 0; i < inputs.length; i++) {
                //         inputs[i].toggleAttribute('readonly');
                //     };
                //     if (savebutton.innerHTML == "Edit") {
                //         savebutton.innerHTML = "Save";
                //     } else {
                //         savebutton.innerHTML = "Edit";
                //     }
                // });
            </script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>