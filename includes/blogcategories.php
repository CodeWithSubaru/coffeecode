<!-- Blog Categories -->
<div class="card mt-5 shadow-sm mb-5">
<h4 class="pl-4 pt-3 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;">
        <i class="fas fa-sitemap me-1"></i> <span style="color: #D0B49F;"> Blog</span> Categories
    </h4>
    <div class="card-body text-center">
        <div class="row">
            <?php foreach ($categories->all() as $category) : ?>
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li><a href="category?cat_id=<?= $category->cat_id ?>"><?= $category->cat_title ?></a></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
    <div class="card-footer text-center text-muted text-sm" style="background-color: white;">Choose your category</div>
</div>