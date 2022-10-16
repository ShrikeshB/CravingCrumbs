let arrow = document.querySelector('.arrow-btn');
let reverse = document.querySelector('.reverse-arrow');
let container = document.querySelector('.pay-container');
arrow.addEventListener('click', () => {
    container.classList.add('active');
});
reverse.addEventListener('click', () => {
    container.classList.remove('active');
});

