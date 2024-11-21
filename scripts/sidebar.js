  // Sidebar toggle functionality
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('main-content');
  const toggleBtn = document.getElementById('toggle-btn');

  toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('collapsed');
  });

  // Submenu toggle functionality
  document.querySelectorAll('.has-submenu > a').forEach(parentLink => {
      parentLink.addEventListener('click', function (e) {
          e.preventDefault(); // Prevent default link action
          const parentLi = this.parentElement;
          const submenuToggle = this.querySelector('.submenu-toggle');

          // Toggle submenu visibility
          if (parentLi.classList.contains('submenu-open')) {
              parentLi.classList.remove('submenu-open');
              submenuToggle.textContent = '+'; // Change icon to "+"
          } else {
              // Close other submenus
              document.querySelectorAll('.has-submenu').forEach(item => {
                  item.classList.remove('submenu-open');
                  item.querySelector('.submenu-toggle').textContent = '+';
              });
              parentLi.classList.add('submenu-open');
              submenuToggle.textContent = '-'; // Change icon to "-"
          }
      });
  });