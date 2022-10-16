function Morecakes(){
    const category  = document.querySelector(".more-cake-options").value;

    window.location = "http://localhost/CakeSite/Admin/Pages/Tables.php?category="+category;
    
}