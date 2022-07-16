<?php
  include "includes/navbar2.php";
?>
    <!-- Start of content -->
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <!-- First Blog Post -->
          <h2 class="text-4xl mt-4">
            <a href="#" class="text-decoration-underline">Blog Post Title</a>
          </h2>
          <p class="">by <a href="index.php" class="text-2xl text-decoration-underline leading-loose">Start Bootstrap</a></p>
          <p class="mb-4">
            <i class="fas fa-history text-muted"></i> Posted on August 28, 2013 at 10:00 PM
          </p>
          <hr />
          <img
            class="img-responsive my-5"
            src="http://placehold.it/900x300"
            alt="image-post"
          />
          <hr />
          <p class="truncate py-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore,
            veritatis, tempora, necessitatibus inventore nisi quam quia repellat
            ut tempore laborum possimus eum dicta id animi corrupti debitis
            ipsum officiis rerum.
          </p>

          <a class="btn btn-primary my-2" href="#" data-bs-toggle="modal" data-bs-target="#LoginFirst"
            >Read More <span class="fas fa-chevron-right ms-1"></span
          ></a>

          <hr />

          <h2 class="text-4xl mt-4">
            <a href="#" class="text-decoration-underline">Blog Post Title</a>
          </h2>
          <p class="">by <a href="index.php" class="text-2xl text-decoration-underline leading-loose">Start Bootstrap</a></p>
          <p class="mb-4">
            <i class="fas fa-history text-muted"></i> Posted on August 28, 2013 at 10:00 PM
          </p>
          <hr />
          <img
            class="img-responsive my-5"
            src="http://placehold.it/900x300"
            alt="image-post"
          />
          <hr />
          <p class="truncate py-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore,
            veritatis, tempora, necessitatibus inventore nisi quam quia repellat
            ut tempore laborum possimus eum dicta id animi corrupti debitis
            ipsum officiis rerum.
          </p>
          <a class="btn btn-primary my-2" href="#" data-bs-toggle="modal" data-bs-target="#LoginFirst"
            >Read More <span class="fas fa-chevron-right ms-1"></span
          ></a>

          <hr />

          <!-- Blog end -->

          <!-- Pager -->
          <ul class="my-4 d-flex justify-content-between">
            <li class="previous">
              <a href="#" class="border border-primary rounded-pill p-2">&larr; Older</a>
            </li>
            <li class="next">
              <a href="#" class="border border-primary rounded-pill p-2">Newer &rarr;</a>
            </li>
          </ul>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
          <!-- Blog Search Well -->
          <div class="card mt-4">
            <h4 class="card-header">
              <i class="fas fa-search me-1"></i>Blog Search
            </h4>
            <div class="card-body">
              <div class="input-group">
                <input
                  type="text"
                  placeholder="Search..."
                  class="form-control"
                />
                <span class="input-group-btn">
                  <button
                    class="btn"
                    style="background: #f7f7f7; border: 1px solid #dfdfdf"
                    type="button"
                  >
                    <span class="fas fa-search"></span>
                  </button>
                </span>
              </div>
            </div>
            <div class="card-footer text-muted text-center">
              Search Specific Blog
            </div>
            <!-- /.input-group -->
          </div>

          <!-- Blog Categories -->
          <div class="card mt-3">
            <h4 class="card-header">
              <i class="fas fa-sitemap me-1"></i> Blog Categories
            </h4>
            <div class="card-body text-center">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled">
                    <li><a href="#">Category Name</a></li>
                    <li><a href="#">Category Name</a></li>
                    <li><a href="#">Category Name</a></li>
                    <li><a href="#">Category Name</a></li>
                  </ul>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <ul class="list-unstyled">
                    <li><a href="#">Category Name</a></li>
                    <li><a href="#">Category Name</a></li>
                    <li><a href="#">Category Name</a></li>
                    <li><a href="#">Category Name</a></li>
                  </ul>
                </div>
              </div>

              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="card-footer text-center text-muted">Categories</div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <hr />


<?php
  include "includes/footer.php";
?>