<!-- Update Form -->
<form action="" method="post" class="animate__animated animate__fadeIn animate__fast  card mt-5 shadow">

<h4 class="card-header pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;font-size: 20px;"><i class="fas fa-edit me-1"></i>
                            <span style="color:#D0B49F;">Update </span> Category</h4>


<div class="card-body">

    <div class="form-group">
        <label for="cat_title">Category</label>
        <input type="text" name="cat_title" id="cat_title" class="form-control" value="<?= $categories->cat_title($_GET['cat_id'] ?? '') ?>">
    </div>

    <div class="form-group float-end">
        <button type="submit" name="update_category" id="update_cat" class="btn btn-success"><i class="fas fa-caret-square-up me-1"></i> Update Category</button>
    </div>
    <div class="clearfix"></div>
</div>
</form>

<!-- End of Update Form -->