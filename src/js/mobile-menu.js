document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuItems = document.querySelectorAll('#mobile-menu .menu-item-has-children > a');

    // Toggle mobile menu
    mobileMenuToggle.addEventListener('click', () => {
        mobileMenu.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
    });

    // Close mobile menu
    mobileMenuClose.addEventListener('click', () => {
        mobileMenu.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (mobileMenu.classList.contains('active') && 
            !mobileMenu.contains(e.target) && 
            !mobileMenuToggle.contains(e.target)) {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Handle dropdown toggles
    mobileMenuItems.forEach(item => {
        // Get the menu text
        const menuText = item.textContent.trim();
        // Clear the anchor tag content
        item.textContent = '';
        
        // Add dropdown toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.classList.add('dropdown-toggle');
        toggleBtn.innerHTML = `
            <span class="flex-grow text-left">${menuText}</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        `;
        item.appendChild(toggleBtn);

        // Toggle submenu
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const submenu = item.nextElementSibling;
            submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
            toggleBtn.querySelector('svg').style.transform = 
                submenu.style.display === 'none' ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    });

    // Initially hide all submenus on mobile
    document.querySelectorAll('#mobile-menu .sub-menu').forEach(submenu => {
        submenu.style.display = 'none';
    });
});
