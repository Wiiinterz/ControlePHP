function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${d.toUTCString()};path=/`;
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

function applyTheme(theme) {
    if (theme === 'dark') {
        document.body.classList.add('dark-theme');
        document.querySelectorAll('button').forEach(button => button.classList.add('dark-theme'));
        document.getElementById('theme-toggle').textContent = 'Mode clair';
    } else {
        document.body.classList.remove('dark-theme');
        document.querySelectorAll('button').forEach(button => button.classList.remove('dark-theme'));
        document.getElementById('theme-toggle').textContent = 'Mode sombre';
    }
}
const savedTheme = getCookie('theme');
applyTheme(savedTheme || 'light'); 

document.getElementById('theme-toggle').addEventListener('click', () => {
    const currentTheme = document.body.classList.contains('dark-theme') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    setCookie('theme', newTheme, 30); 
    applyTheme(newTheme);
});
