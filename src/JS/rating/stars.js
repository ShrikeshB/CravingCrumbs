var rated = -1;

$(document).ready(function () {
  resetStar();
//   if (localStorage.getItem("ratedIndex") != null) {
//     setStar(parseInt(localStorage.getItem("ratedIndex")));
//   }

  $(".star").on("click", function () {
    rated = parseInt($(this).data("index"));
    // localStorage.setItem("ratedIndex", rated);
    saveToDB();
  });

  $(".star").mouseover(function () {
    var currentIndex = parseInt($(this).data("index"));

    for (var i = 0; i <= currentIndex; i++)
      $(".star:eq(" + i + ")").css(
        "background-image",
        'url("../../Icons/Rated.png")'
      );
  });

  $(".star").mouseleave(function () {
    resetStar();

    if (rated != -1) {
      for (var i = 0; i <= rated; i++)
        $(".star:eq(" + i + ")").css(
          "background-image",
          'url("../../Icons/Rated.png")'
        );
    }
  });
});

function setStar(max) {
  for (var i = 0; i <= max; i++)
    $(".star:eq(" + i + ")").css(
      "background-image",
      'url("../../Icons/Rated.png")'
    );
}

function resetStar() {
  $(".star").css("background-image", 'url("../../Icons/unrated.png")');
}

function saveToDB(){

    document.cookie = "rating="+rated+"; path=../../"; 
}
