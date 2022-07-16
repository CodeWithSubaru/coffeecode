<footer class="py-4 bg-light mt-auto">
  <div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-between small">
      <div class="text-muted">Copyright &copy; Your Website 2021</div>
      <div>
        <a href="#">Privacy Policy</a>
        &middot;
        <a href="#">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>

    <script> 
        const menuNavItems2 = document.querySelector('.menuNavItems2').classList;
        menuNavItems2.toggle('hidden');
    </script>

<script src="./js/index.js"></script>

<script src="./js/scripts.js"></script>

<script>

  let preloader = document.getElementById("loading");
  let body = document.querySelector("body");

  function myLoader() {
    setTimeout(() => {
      preloader.style.display = "none";
      body.style.overflow = "auto";
    }, 1999);
  }


  
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>



<script>
  const editCategories = document.querySelectorAll('#editcategories');

  editCategories.forEach(editCat => {
    editCat.addEventListener('click', function(e) {
      e.preventDefault();
      
    })
  })

</script>

<script>
  // TinyMCE
  tinymce.init({
    selector: "",
    plugins: "a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker",
    toolbar: "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table",
    toolbar_mode: "floating",
    tinycomments_mode: "embedded",
    tinycomments_author: "Author name",
  });

  <?php if (Input::get('cat_id')) { ?>
    document.getElementById("cat_title").disabled = false;
    document.getElementById("update_cat").disabled = false;
    <?php } else { ?>
      // document.getElementById("cat_title").style.cursor = 'not-allowed';
      document.getElementById("cat_title").disabled = true;
      document.getElementById("update_cat").disabled = true;
  <?php } ?>

  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }


  let img = document.querySelectorAll('#img');
  
  img.forEach(element => {
    let imgsrc = element.getAttribute("src");
    if (imgsrc === "") {
      element.classList.remove('img-thumbnail')
    }
  });

  let alert = document.querySelectorAll('.alert');

  alert.forEach(element => {

    setTimeout(() => {
      element.classList.add('d-none');
    }, 5000);
  });
</script>

<script>
  const dataTable = document.querySelector('dataTable-bottom');
  const divBtnAction = document.querySelectorAll('.buttonsAction');
  
  console.log(dataTable);
  console.log(divBtnAction);
  
  [...divBtnAction.children].forEach(element => {
    element.appendChild()
  });

</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#292b2c';
  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Post", "Comments", "Users", "Categories"],
      datasets: [{
        data: [<?= Post::count_row() ?>, <?= Comments::count_row() ?>, <?= User::count_row() ?>, <?= Category::count_row() ?>],

        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
      }],
    },
  });


</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>


</body>

</html>