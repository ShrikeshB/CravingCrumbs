function Morecakes(){
    const category  = document.querySelector(".more-cake-options").value;

    window.location = "http://localhost/CakeSite/src/Pages/MoreCakes.php?category="+category;
    
}