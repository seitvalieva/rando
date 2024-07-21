const handleMobileMenu = () => {
    
    const navBurgerMenu = document.getElementById('navBurgerMenu')
    const mobileMenu = document.getElementById('mobileMenu')
    const mobileMenuClose = document.getElementById('mobileMenuClose')

    const openMenu = () => {
        mobileMenu.classList.add('mobile-menu--open')
    }
    const closeMenu = () => {
        mobileMenu.classList.remove('mobile-menu--open')
    }

    navBurgerMenu.addEventListener('click', openMenu)
    mobileMenuClose.addEventListener('click', closeMenu)
}

handleMobileMenu()