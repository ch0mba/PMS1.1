const toggleBtn = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');
const mainContent = document.querySelector('main-content');

toggleBtn.addEventListener('click', function() {
    sidebar.classList.toggle('collapsed'); // Toggle sidebar
    mainContent.classList.toggle('collapsed'); // Adjust main content width
});