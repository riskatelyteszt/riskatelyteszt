document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const themeToggle = document.getElementById('theme-toggle');
    const icon = themeToggle ? themeToggle.querySelector('i') : null;

    function applyTheme(theme) {
        if (theme === 'light') {
            body.classList.remove('dark-theme');
            body.classList.add('light-theme');
            if (icon) icon.className = 'fa-solid fa-moon';
        } else {
            body.classList.remove('light-theme');
            body.classList.add('dark-theme');
            if (icon) icon.className = 'fa-solid fa-sun';
        }
    }

    // Initialize from saved preference (if any)
    const saved = localStorage.getItem('theme');
    if (saved) applyTheme(saved);
    else {
        // If no saved preference, sync icon with existing body class
        if (body.classList.contains('light-theme')) {
            if (icon) icon.className = 'fa-solid fa-moon';
        } else {
            if (icon) icon.className = 'fa-solid fa-sun';
        }
    }

    if (!themeToggle) return;

    themeToggle.addEventListener('click', () => {
        const isDark = body.classList.contains('dark-theme');
        const newTheme = isDark ? 'light' : 'dark';
        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    });
});
