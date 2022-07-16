window.addEventListener("DOMContentLoaded", () => {
  //Get the current page path.
  var patharray = location.pathname.split("/");
  var path = patharray[2];
 console.log(patharray);
  // If on the root folder of the site, highlight the first link.
  if (path == "" || path == "index") {
    document.querySelector(".home").classList.add("current");
  } else {
    //Otherwise, loop through the links and put classname on
    // the one whose folder name matches foldername variable.
    var nav = document.getElementById("sidenav1");
    var links = nav.getElementsByTagName("a");
    console.log(links);
    for (i = 1; i < links.length; i++) {
      if (links[i].getAttribute("href").indexOf(path) > -1) {
        links[i].classList.add("current");
      }
    }
  }
});
