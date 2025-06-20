document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleTheme');
    const themeIcon = document.getElementById('themeIcon');
    const userPref = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    function applyTheme(dark) {
        if (dark) {
            document.body.classList.add('dark-mode');
            themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
        } else {
            document.body.classList.remove('dark-mode');
            themeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
        }
    }

    if (userPref === 'dark' || (!userPref && systemPrefersDark)) {
        applyTheme(true);
    } else {
        applyTheme(false);
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            const isDark = document.body.classList.contains('dark-mode');
            applyTheme(!isDark);
            localStorage.setItem('theme', !isDark ? 'dark' : 'light');
        });
    }
});



