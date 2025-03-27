window.onload = (e) => {

    setTimeout((e) => {
        let wrapper = document.getElementsByClassName('pp-advanced-menu-main-wrapper')[0];


        elem = document.getElementsByClassName('pp-menu-toggle')[0];
        cloned = elem.cloneNode(true);
        cloned.addEventListener('click', toggleMenu);

        wrapper.removeChild(elem);
        wrapper.appendChild(cloned);
    }, 5000);

}

function toggleMenu() {
    document.body.classList.add('pp-menu--off-canvas', 'pp-menu-open');
    document.getElementsByClassName('pp-advanced-menu--dropdown')[0].classList.add('pp-menu-open', 'pp-menu-off-canvas-right');
}