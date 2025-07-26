function toggleSidebar() {
    const nav = document.getElementById('sidebar');
    const content = document.getElementById('mainContent');
    nav.classList.toggle('d-none');
    if (nav.classList.contains('d-none')) {
        content.style.marginLeft = '0';
    } else {
        content.style.marginLeft = '220px';
    }
}
