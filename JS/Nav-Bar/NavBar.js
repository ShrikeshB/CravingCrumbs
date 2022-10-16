function onClickBurger(){
    let side_nav_bar = document.querySelector('.side-nav-bar');
    let burger_btn = document.querySelector('.burger-btn');
    let navigation = document.querySelector('.navigation');

    // toggle the width of nav-item block 
    side_nav_bar.classList.toggle('activate-side-nav-bar');
    burger_btn.classList.toggle('ative-burger-btn');

    // navigation activation in mobile view
    navigation.classList.toggle('active');
}