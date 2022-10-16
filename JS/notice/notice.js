const close = document.querySelector(".close");
close.addEventListener("click",function (){
    const notice = document.querySelector(".notice");
    notice.classList.add('close');
});