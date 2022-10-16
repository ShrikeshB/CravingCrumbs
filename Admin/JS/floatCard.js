let view = document.querySelectorAll(".view");
let float = document.querySelectorAll(".float-card");
let close = document.querySelector(".close-btn");
let overlay = document.querySelector(".overlay");
let body = document.querySelector("body");
let i = 0;

let isSelected = false;
let PreIndex = 0;
let index = 0;
// fetch view btn individually
view.forEach(function (item) {
  i++;
  
  item.addEventListener("click", function () {

    index = item.getAttribute("data-viewIndex");
    overlay.classList.add("active");
    console.log(index);
    if (isSelected == true) {
      let floatcard1 = document.querySelector(
        '[data-Floatindex="' + PreIndex + '"]'
      );
      floatcard1.classList.remove("active");
   


   

    }
    isSelected = true;
    PreIndex = index;
    let floatcard2 = document.querySelector(
      '[data-Floatindex="' + index + '"]'
    );
    floatcard2.classList.add("active");
    body.classList.add("active");





  });


});


// close.addEventListener("click", function(){
//   console.log("close "+index);
//   let floatcard2 = document.querySelector(
//     '[data-Floatindex="' + index + '"]'
//   );
//   floatcard2.classList.remove("active");
// });

function close1(){
  console.log("close "+index);
  let floatcard2 = document.querySelector(
    '[data-Floatindex="' + index + '"]'
  );
  floatcard2.classList.remove("active");
  body.classList.remove("active");
  overlay.classList.remove("active");
}