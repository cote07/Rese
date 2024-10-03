function toggleMenu() {
    const menu = document.getElementById('menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    menu.classList.toggle('show');

    if (menu.classList.contains('show')) {
        menuIcon.style.display = 'none';
        closeIcon.style.display = 'inline';
    } else {
        menuIcon.style.display = 'inline';
        closeIcon.style.display = 'none';
    }
}
