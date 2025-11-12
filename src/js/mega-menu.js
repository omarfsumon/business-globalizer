document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item-has-children');
    let currentMegaMenu = null;
    let timeoutId = null;

    // Function to show mega menu
    function showMegaMenu(megaMenu) {
        if (currentMegaMenu && currentMegaMenu !== megaMenu) {
            hideMegaMenu(currentMegaMenu);
        }
        
        megaMenu.classList.remove('opacity-0', 'invisible', '-translate-y-2', 'pointer-events-none');
        megaMenu.classList.add('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
        currentMegaMenu = megaMenu;
    }

    // Function to hide mega menu
    function hideMegaMenu(megaMenu) {
        megaMenu.classList.remove('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
        megaMenu.classList.add('opacity-0', 'invisible', '-translate-y-2', 'pointer-events-none');
        if (currentMegaMenu === megaMenu) {
            currentMegaMenu = null;
        }
    }

    menuItems.forEach(item => {
        const megaMenu = item.querySelector('.mega-menu');
        if (!megaMenu) return;

        // Handle mouse enter
        item.addEventListener('mouseenter', () => {
            if (timeoutId) {
                clearTimeout(timeoutId);
                timeoutId = null;
            }
            showMegaMenu(megaMenu);
        });

        // Handle mouse leave with delay
        item.addEventListener('mouseleave', () => {
            timeoutId = setTimeout(() => {
                hideMegaMenu(megaMenu);
            }, 200); // 200ms delay before hiding
        });
    });

    // Close mega menu when clicking outside
    document.addEventListener('click', (e) => {
        if (currentMegaMenu && !e.target.closest('.menu-item-has-children')) {
            hideMegaMenu(currentMegaMenu);
        }
    });

    // Prevent closing when clicking inside mega menu
    document.querySelectorAll('.mega-menu').forEach(menu => {
        menu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
});
