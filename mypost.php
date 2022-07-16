<?php

include "includes/navbar.php";
$user = new User();

if (!$user->isLoggedIn() || $user->data()->user_role !== 'Subscriber') {
    header('Location: index');
} else {
    $posts = new Post();
    $categories = new Category();

    if (isset($_POST['update_post'])) {

        $posts->updatepost();

    }
    $posts->addpost();
?>

    <!-- Start of content -->
    

    <!-- First Blog Post -->

        <div class="container mb-3" style="background: unset !important; padding: unset; box-shadow: unset !important;">
            <div class="d-flex justify-content-end">
                <a href="createpost" class="btn btn-success"> <i class="far fa-plus-square"></i> Create Post </a>
            </div>
        </div>

    
 <div class="min-height">
    <?php Session::flashMessage($posts->error); ?>
    
    <div class="container animate__animated animate__fadeIn animate__fast shadow-sm">
        
        <div class="row ">
                            <h1 
                                class="card-header font-semibold text-xl tracking-tight" style="background-color: white; border-top-right-radius: 15px; border-top-left-radius: 15px;">
                                <i class="fas fa-eye me-2"></i>
                                <span style="color: #D0B49F;">My</span> Post
                            </h1>

                                </div>
                                <div class="card-body p-4">
                                    <table id="datatablesSimple" class="table table-hover" style="min-height: 200px;">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 200px;">Title</th>
                                                <th>Date</th>
                                                <th style="min-width: 130px;">Category</th>
                                                <th style="min-width: 150px;">Image</th>
                                                <th style="height: 100%; min-width: 300px;">Content</th>
                                                <th>Views</th>
                                                <th>Tags</th>
                                                <th>Status</th>
                                                <th class="text-center" style="height: 100%; min-width: 250px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($posts->byPostAuthor($user->data()->user_id) as $post) : ?>
                                                <tr>
                                                    <td><?= $post->post_title ?></td>
                                                    <td><?= date_format(date_create($post->post_date), "F d, Y") ?> </td>
                                                    <td><?= $categories->cat_title($post->post_category_id) ?></td>
                                                    <td class="text-center">
                                                        <img src="<?= $post->post_image ?>" id="img" class="img-thumbnail" alt="" style="min-height: 100px; object-fit: contain;" />
                                                    </td>
                                                    <td><?= $post->post_content ?></td>
                                                    <td><?= $post->post_views_count ?></td>
                                                    <td class="tags"><?= $post->post_tags ?></td>
                                                    <td><span <?= $post->post_status == 'Draft' ? ' class="font-extrabold text-red-900">Waiting for Approval' : 'class="font-extrabold text-amber-400">Published' ?></span></td>
                                                    <td class="text-center">
                                                        <?php if ($post->post_status == 'Published'): ?>
                                                        <div class="my-2">
                                                            <a href="post?post_id=<?=$post->post_id?>" class="btn btn-primary btn-sm rounded-pill me-2 w-50">
                                                                <i class="far fa-eye me-1"></i> View
                                                            </a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-success rounded-pill mb-2 w-50" 
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editPost<?=$post->post_id?>" 
                                                            style="background:#F9AB00; border: 1px solid #F9AB00;">

                                                            <i class="fas fa-edit me-2"></i> Edit

                                                        </button> 

                                                        <?php $posts->getId($post->post_id); ?>

                                                    </td>

                                                    </tr>

                                                     <!-- Modal Edit User -->
                                                    <div class="modal myModal" id="editPost<?=$posts->data()->post_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg d-flex justify-content-center">
                                                            <div class="modal-content shadow mt-5" style="border: none;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit me-2"></i><span style="color: #D0B49F;">Update</span> Posts</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body px-5">

                                                            <form action="" method="post" class="" enctype="multipart/form-data">
                                                                
                                                                    <div class="card-body">
                                                                        
                                                                    <input type="hidden" name="post_id" value="<?=$posts->data()->post_id?>">

                                                                        <div class="form-group mb-3">
                                                                            <label for="post_title">Post Title</label>
                                                                            <input type="text" name="post_title" class="form-control" value="<?= $posts->data()->post_title ?>">
                                                                        </div>

                                                                        <div class="form-group mb-3">
                                                                            <label for="post_category_id">Post Category</label>
                                                                            <select name="post_category_id" class="form-select">
                                                                                <?php $posts->getCategorybyCatFK($posts->data()->post_category_id) ?>
                                                                                <option selected value="<?= $posts->data()->post_category_id ?>">
                                                                                    <?= $posts->getcategory()->cat_title ?>
                                                                                </option>
                                                                                <?= $categories->fetchCategoryId(); ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group mb-3">
                                                                            <label for="post_image">Post Image</label>
                                                                            <input type="file" name="post_image" class="form-control">
                                                                            <input type="hidden" name="post_image" value="<?= Input::get('post_image') ?>">
                                                                        </div>

                                                                        <div class="my-3  d-flex justify-content-center" style="width: 100%;">
                                                                            <img src="<?= $posts->data()->post_image ?>" style="object-fit: scale-down;" class="img-thumbnail" alt="Post Image">
                                                                            <input type="hidden" name="post_image_old" value="<?= $posts->data()->post_image ?>">
                                                                        </div>

                                                                        <div class="form-group mb-3">
                                                                            <label for="post_tags">Post Tags</label>
                                                                            <input type="text" name="post_tags" class="form-control" id="post_tags" value="<?= $posts->data()->post_tags ?>">
                                                                        </div>

                                                                        <div class="form-group mb-3">
                                                                            <label for="post_content">Post Content</label>
                                                                            <textarea class="form-control" name="post_content" rows="3" placeholder="Join the discussion and leave a comment!" style="resize: none; min-height: 300px;"><?= $posts->data()->post_content ?></textarea>
                                                                        </div>
                                                                    </div>
                                                            </form>  
                                                            </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary text-uppercase" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                                    <button type="submit" name="update_post" class="btn btn-success text-uppercase"> <i class="fas fa-save"></i> Save</button>
                                                                </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfooter>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Content</th>
                                            <th>Views</th>
                                            <th>Tags</th>
                                            <th>Status</th>
                                            <th>Action</th>
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

<?php
    include "includes/footer.php";
}
?>