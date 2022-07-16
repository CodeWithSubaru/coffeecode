<div class="py-3"></div>
<!-- Footer -->
<footer class="py-4" style="z-index: -1; bottom: 0; background: #ffffff !important; border-radius: unset;">
  <div class="px-4">
    <div class="d-flex align-items-center justify-content-between small">
      <div class="">Copyright &copy; Coffee Code 2022 - <?= date('Y') ?></div>
      <?php $users = new User(); ?>

      <?php if ($users->isLoggedIn()) : ?>
        <?php if ($users->data()->author_permission == '0' && $users->data()->user_role == 'Subscriber') : ?>
          <form method="post">
            <input type="hidden" name="author_permission" value="1">
            <input type="submit" name="send_request" class="link-primary" value="Send Request to be an Author" />
          </form>
        <?php endif; ?>
      <?php endif; ?>
      <div>
        <a href="#">Privacy Policy</a>
        &middot;
        <a href="#">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
  </div>
</footer>

<script src="../js/index.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(".notifications .icon_wrap").click(function() {
    console.log($(this).parent());
    $(this).parent().toggleClass("active");
    $(".profile").removeClass("active");
  });

  $(".show_all .link").click(function() {
    $(".notifications").removeClass("active");
    $(".popup").show();
  });

  fetchNotif();

  function fetchNotif() {
    $.ajax({
      url: './process.php',
      method: 'POST',
      data: {
        action: 'fetchNotif'
      },
      success: function(response) {
        $('.notification_ul').html(response);
      }
    })
  }


  $('.icon_wrap').click(function() {
      $.ajax({
      url: './process.php',
      method: 'POST',
      data: {
        action: 'updateRead'
      },
      success: function(response) {
        fetchNotif();
        $(".circle").hide();
      }
    })

  });

setInterval(checkNotif, 1000);

  function checkNotif() {
    $.ajax({
      url: './process.php',
      method: 'POST',
      data: {
        action: 'checkNotif'
      },
      success: function(response) {
        console.log(response);
        $(".circle").html(response);
      }
    })
  }
</script>

<script>
  let preloader = document.getElementById("loading");
  let body = document.querySelector("body");

  function myLoader() {
    setTimeout(() => {
      preloader.style.display = "none";
      body.style.overflow = "auto";
    }, 950);
  }
</script>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>
  const menuNavItems = document.querySelector('#menuNavItems').classList;
  menuNavItems.toggle('hidden');

  const menuNavItems1 = document.querySelector('#menuNavItems1').classList;
  menuNavItems1.toggle('hidden');

  const menuNavItems2 = document.querySelector('#menuNavItems2').classList;
  menuNavItems2.toggle('hidden');

  console.log(menuNavItems2);
</script>
<script src="https://cdn.tiny.cloud/1/gmzjl0vpsce7mp8l07g2elpmdugjikfxaoy9kctoq34az5bt/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>

<script>
  var button = document.querySelector(".btn-bookmarker");

  // Select the input box
  var url = window.location.href;

  // Hold bookmarks in local storage
  if (typeof(localStorage.bookmark) == "undefined") {
    localStorage.bookmark = "";
  }

  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  const userBtn = document.querySelector("#user-menu-button");
  const menu = document.querySelector("#menu").classList;
  menu.toggle("hidden");

  userBtn.addEventListener("click", function() {
    menu.toggle("hidden");
    menu.toggle("block");
  });

  let alert = document.querySelectorAll('.alert');

  alert.forEach(element => {

    setTimeout(() => {
      element.classList.add('d-none');
    }, 5000);
  });


  const scroll = document.querySelector('.scrollToTop');
  window.addEventListener('scroll', () => {
    scroll.classList.toggle("active", window.scrollY > 500);
  });

  function scrollToTop() {

    window.scrollTo(0, 0);
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script>
  window.addEventListener('DOMContentLoaded', event => {
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple);
    }
  });
</script>

</body>

</html>

<!-- End -->