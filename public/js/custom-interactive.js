/**
 * ============================================================================
 * APOTEK KHADIJAH - INTERACTIVE SCRIPTS & DYNAMIC BEHAVIORS
 * ============================================================================
 */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // 1. REAL-TIME DIGITAL CLOCK & DATE
  initLiveClock();

  // 2. THEME MODE TOGGLE (LIGHT / DARK)
  initThemeToggle();

  // 3. SIDEBAR REAL-TIME MENU SEARCH
  initSidebarSearch();

  // 4. MOBILE SIDEBAR AUTO-CLOSE
  initMobileSidebar();

  // 5. SWEETALERT2 LOGOUT CONFIRMATION
  initLogoutConfirmation();

  // 6. FULLSCREEN TOGGLE HELPER
  initFullscreenToggle();
});

/**
 * 1. Live Digital Clock
 */
function initLiveClock() {
  const clockElement = document.getElementById('navbarLiveClockText');
  if (!clockElement) return;

  const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  const months = [
    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
  ];

  function updateClock() {
    const now = new Date();
    const dayName = days[now.getDay()];
    const dateNum = String(now.getDate()).padStart(2, '0');
    const monthName = months[now.getMonth()];
    const year = now.getFullYear();

    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    clockElement.textContent = `${dayName}, ${dateNum} ${monthName} ${year} • ${hours}:${minutes}:${seconds} WIB`;
  }

  updateClock();
  setInterval(updateClock, 1000);
}

/**
 * 2. Dark / Light Theme Toggle
 */
function initThemeToggle() {
  const THEME_KEY = 'apotek-theme-mode';
  const toggleBtn = document.getElementById('themeToggleBtn');
  const themeIcon = document.getElementById('themeToggleIcon');

  function getSavedTheme() {
    return localStorage.getItem(THEME_KEY) || 'light';
  }

  function applyTheme(theme) {
    document.documentElement.setAttribute('data-bs-theme', theme);
    localStorage.setItem(THEME_KEY, theme);

    if (themeIcon) {
      if (theme === 'dark') {
        themeIcon.className = 'bi bi-sun-fill text-warning';
        themeIcon.style.color = '';
        themeIcon.style.transform = 'rotate(360deg)';
      } else {
        themeIcon.className = 'bi bi-moon-stars-fill';
        themeIcon.style.color = '#087F5B';
        themeIcon.style.transform = 'rotate(0deg)';
      }
    }
  }

  // Initial apply
  applyTheme(getSavedTheme());

  if (toggleBtn) {
    toggleBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      applyTheme(newTheme);
    });
  }
}

/**
 * 3. Sidebar Real-Time Menu Search
 */
function initSidebarSearch() {
  const searchInput = document.getElementById('sidebarMenuSearch');
  const clearBtn = document.getElementById('sidebarSearchClear');
  const menuContainer = document.querySelector('.sidebar-menu');

  if (!searchInput || !menuContainer) return;

  const menuItems = menuContainer.querySelectorAll('.nav-item');

  searchInput.addEventListener('input', function () {
    const query = this.value.trim().toLowerCase();

    if (clearBtn) {
      clearBtn.style.display = query.length > 0 ? 'block' : 'none';
    }

    if (!query) {
      // Reset all items
      menuItems.forEach((item) => {
        item.style.display = '';
        if (item.classList.contains('menu-open-by-search')) {
          item.classList.remove('menu-open', 'menu-open-by-search');
          const sub = item.querySelector('.nav-treeview');
          if (sub) sub.style.display = '';
        }
      });
      return;
    }

    menuItems.forEach((item) => {
      // Check if this item is a parent container with treeview
      const treeview = item.querySelector('.nav-treeview');
      if (treeview) {
        const subLinks = treeview.querySelectorAll('.nav-link p');
        let hasMatch = false;

        subLinks.forEach((subP) => {
          const text = subP.textContent.toLowerCase();
          const subItem = subP.closest('.nav-item');
          if (text.includes(query)) {
            hasMatch = true;
            if (subItem) subItem.style.display = '';
          } else {
            if (subItem) subItem.style.display = 'none';
          }
        });

        if (hasMatch) {
          item.style.display = '';
          if (!item.classList.contains('menu-open')) {
            item.classList.add('menu-open', 'menu-open-by-search');
            treeview.style.display = 'block';
          }
        } else {
          item.style.display = 'none';
        }
      } else {
        // Direct leaf item
        const pText = item.querySelector('.nav-link p')?.textContent.toLowerCase() || '';
        if (pText.includes(query)) {
          item.style.display = '';
        } else {
          // If this is inside a treeview, parent search handled it
          if (!item.closest('.nav-treeview')) {
            item.style.display = 'none';
          }
        }
      }
    });
  });

  if (clearBtn) {
    clearBtn.addEventListener('click', function () {
      searchInput.value = '';
      searchInput.dispatchEvent(new Event('input'));
      searchInput.focus();
    });
  }
}

/**
 * 4. Mobile Sidebar Auto-Close
 */
function initMobileSidebar() {
  const isMobile = () => window.innerWidth < 992;
  const navLinks = document.querySelectorAll('.sidebar-menu .nav-link:not([data-lte-toggle])');

  navLinks.forEach((link) => {
    link.addEventListener('click', function () {
      if (isMobile()) {
        const body = document.body;
        if (body.classList.contains('sidebar-open')) {
          body.classList.remove('sidebar-open');
          body.classList.add('sidebar-collapse');
        }
      }
    });
  });
}

/**
 * 5. Logout Confirmation with SweetAlert2
 */
function initLogoutConfirmation() {
  const logoutForms = document.querySelectorAll('form[action*="logout"]');

  logoutForms.forEach((form) => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Konfirmasi Keluar',
          text: 'Apakah Anda yakin ingin keluar dari sistem Apotek?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#ef4444',
          cancelButtonColor: '#64748b',
          confirmButtonText: '<i class="bi bi-box-arrow-right me-1"></i> Ya, Logout',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          customClass: {
            popup: 'rounded-4 shadow-lg border-0',
            confirmButton: 'btn btn-danger px-4 py-2',
            cancelButton: 'btn btn-secondary px-4 py-2'
          }
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      } else {
        if (confirm('Apakah Anda yakin ingin logout?')) {
          form.submit();
        }
      }
    });
  });
}

/**
 * 6. Fullscreen Toggle Helper
 */
function initFullscreenToggle() {
  const maxIcon = document.querySelector('[data-lte-icon="maximize"]');
  const minIcon = document.querySelector('[data-lte-icon="minimize"]');

  document.addEventListener('fullscreenchange', function () {
    if (document.fullscreenElement) {
      if (maxIcon) maxIcon.classList.add('d-none');
      if (minIcon) minIcon.classList.remove('d-none');
    } else {
      if (maxIcon) maxIcon.classList.remove('d-none');
      if (minIcon) minIcon.classList.add('d-none');
    }
  });
}
