<?php

$posts = new Post();
$categories = new Category();

?>

<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="card mt-4 shadow-sm" >
        <h4 class="pt-3 pl-4 font-semibold text-xl tracking-tight" style="background-color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;">
            <i class="fas fa-search me-1"></i><span style="color: #D0B49F;"> Blog</span> Search
        </h4>
        
        <div class="card-body">
            <form action="search" method="get" class="input-group">
                <input type="text" name="search" placeholder="Search..." class="form-control"/>
                <span class="input-group-btn">
                    <button type="submit" class="btn" style="background: #f7f7f7; border: 1px solid #dfdfdf" type="button">
                        <span class="fas fa-search"></span>
                    </button>
                </span>
            </form>
        </div>
        <div class="card-footer text-muted text-center text-sm" style="background-color: white;border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;">
            Search Specific Blog
        </div>
        <!-- /.input-group -->
    </div>