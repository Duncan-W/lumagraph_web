// Show button when scrolled down the page
window.addEventListener('scroll', function() {
    const button = document.getElementById('toggleButton');
    const halfWayPoint = document.documentElement.scrollHeight / 5;
    const scrolledDown100px = window.scrollY > 100;
    const menu = document.getElementById('menu');

    if (button) {
        if (window.scrollY > halfWayPoint || scrolledDown100px) {
            button.classList.remove('hidden');
        } else {
            button.classList.add('hidden');
        }
    }

    if (menu) {
        if (window.scrollY <= halfWayPoint) {
            menu.classList.remove('folded');
        }
    }
});



// Hide the menu above the top of the page when the button is clicked
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('toggleButton');
    const menu = document.getElementById('menu');
    if (button && menu) {
        button.addEventListener('click', function() {
            menu.classList.toggle('folded');
        });
    }
});