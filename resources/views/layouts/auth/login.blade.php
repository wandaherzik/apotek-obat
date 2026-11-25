<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>Login - Apotek Khadijah</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

  <style>
    :root {
      --font-family-base: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      --primary: #087F5B;
      --primary-hover: #066649;
      --secondary: #20A67A;
      --accent: #A3E4C5;
      --bg-offwhite: #F5F8F7;
      --surface-white: #FFFFFF;
      --text-darkgreen: #25352F;
      --text-muted: #5e736a;
      --border-color: #dce8e3;
    }

    * {
      box-sizing: border-box;
      font-family: var(--font-family-base);
    }

    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: var(--bg-offwhite);
      background-image: 
        radial-gradient(circle at 50% 0%, rgba(163, 228, 197, 0.35) 0%, transparent 60%),
        radial-gradient(circle at 10% 90%, rgba(32, 166, 122, 0.08) 0%, transparent 40%),
        radial-gradient(circle at 90% 90%, rgba(8, 127, 91, 0.06) 0%, transparent 40%);
      position: relative;
      overflow-x: hidden;
      padding: 2rem 1rem;
      color: var(--text-darkgreen);
    }

    /* Subtle Health Decorative Cross in Background */
    .health-bg-cross {
      position: absolute;
      pointer-events: none;
      opacity: 0.035;
      color: var(--primary);
      z-index: 0;
    }

    .cross-1 {
      top: 10%;
      left: 12%;
      font-size: 140px;
    }

    .cross-2 {
      bottom: 8%;
      right: 12%;
      font-size: 160px;
    }

    /* Main Container */
    .auth-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 440px;
      animation: fadeIn 0.45s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(16px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-6px); }
      40%, 80% { transform: translateX(6px); }
    }

    /* Clean Health Card */
    .clean-card {
      background: var(--surface-white);
      border: 1px solid var(--border-color);
      border-radius: 24px;
      box-shadow: 
        0 12px 35px -8px rgba(37, 53, 47, 0.07),
        0 4px 10px -2px rgba(37, 53, 47, 0.03);
      padding: 2.75rem 2.4rem;
    }

    /* Brand Header */
    .brand-header {
      text-align: center;
      margin-bottom: 2.2rem;
    }

    .brand-icon-emblem {
      width: 62px;
      height: 62px;
      border-radius: 18px;
      background: rgba(163, 228, 197, 0.28);
      border: 1.5px solid rgba(163, 228, 197, 0.6);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.85rem;
      color: var(--primary);
      margin-bottom: 1.1rem;
      transition: all 0.3s ease;
    }

    .clean-card:hover .brand-icon-emblem {
      transform: scale(1.04);
      background: rgba(163, 228, 197, 0.4);
    }

    .brand-title {
      font-size: 1.45rem;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: var(--text-darkgreen);
      margin-bottom: 0.35rem;
    }

    .brand-title span {
      color: var(--primary);
    }

    .brand-tagline {
      font-size: 0.88rem;
      color: var(--text-muted);
      margin: 0;
    }

    /* Form Fields */
    .form-group-clean {
      margin-bottom: 1.25rem;
    }

    .form-label-clean {
      display: block;
      font-size: 0.84rem;
      font-weight: 600;
      color: var(--text-darkgreen);
      margin-bottom: 0.45rem;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-wrapper .input-icon-left {
      position: absolute;
      left: 1.1rem;
      color: #7b948a;
      font-size: 1.05rem;
      pointer-events: none;
      transition: color 0.2s ease;
    }

    .input-clean {
      width: 100%;
      height: 48px;
      border-radius: 12px;
      border: 1.5px solid var(--border-color);
      background-color: var(--bg-offwhite);
      padding: 0 1rem 0 2.85rem;
      font-size: 0.92rem;
      font-weight: 500;
      color: var(--text-darkgreen);
      transition: all 0.2s ease;
    }

    .input-clean::placeholder {
      color: #9eb5ac;
    }

    .input-clean:focus {
      background-color: var(--surface-white);
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 0 3.5px rgba(8, 127, 91, 0.14);
    }

    .input-clean:focus ~ .input-icon-left {
      color: var(--primary);
    }

    /* Password Toggle Button */
    .toggle-pass-btn {
      position: absolute;
      right: 0.75rem;
      background: transparent;
      border: none;
      color: #7b948a;
      font-size: 1.1rem;
      padding: 0.35rem 0.5rem;
      cursor: pointer;
      border-radius: 8px;
      display: flex;
      align-items: center;
      transition: color 0.2s ease;
    }

    .toggle-pass-btn:hover {
      color: var(--primary);
    }

    /* Caps Lock Warning */
    .caps-warning {
      display: none;
      font-size: 0.78rem;
      color: #b45309;
      background: #fef3c7;
      border-radius: 8px;
      padding: 0.35rem 0.65rem;
      margin-top: 0.45rem;
      font-weight: 600;
      align-items: center;
      gap: 0.35rem;
    }

    /* Button */
    .btn-submit-clean {
      width: 100%;
      height: 48px;
      border-radius: 12px;
      background-color: var(--primary);
      color: #ffffff;
      border: none;
      font-weight: 700;
      font-size: 0.95rem;
      letter-spacing: 0.01em;
      box-shadow: 0 4px 14px rgba(8, 127, 91, 0.28);
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      cursor: pointer;
      margin-top: 0.5rem;
    }

    .btn-submit-clean:hover {
      background-color: var(--primary-hover);
      box-shadow: 0 6px 20px rgba(8, 127, 91, 0.38);
      transform: translateY(-1.5px);
      color: #ffffff;
    }

    .btn-submit-clean:active {
      transform: scale(0.98);
    }

    /* Shake Error Alert */
    .alert-shake {
      animation: shake 0.45s ease-in-out;
      border-radius: 12px;
      border: 1px solid #fecaca;
      background: #fef2f2;
      color: #b91c1c;
      font-weight: 500;
      font-size: 0.88rem;
      padding: 0.75rem 1rem;
      margin-bottom: 1.4rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* Clean Discreet Demo Hint */
    .clean-demo-hint {
      margin-top: 1.6rem;
      padding-top: 1.25rem;
      border-top: 1px dashed var(--border-color);
      text-align: center;
    }

    .demo-pill-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      font-size: 0.8rem;
      color: var(--primary);
      background: rgba(163, 228, 197, 0.22);
      border: 1px solid rgba(163, 228, 197, 0.5);
      border-radius: 20px;
      padding: 0.38rem 0.85rem;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.2s ease;
      text-decoration: none;
    }

    .demo-pill-btn:hover {
      background: rgba(163, 228, 197, 0.4);
      color: var(--primary-hover);
      transform: translateY(-1px);
    }

    /* Footer */
    .auth-footer {
      text-align: center;
      margin-top: 1.8rem;
      font-size: 0.78rem;
      color: var(--text-muted);
    }

    @media (max-width: 575.98px) {
      .clean-card {
        padding: 2rem 1.4rem;
        border-radius: 20px;
      }

      .cross-1, .cross-2 {
        display: none;
      }
    }
  </style>
</head>

<body>
  <!-- Clean Subtle Medical Watermark Icons -->
  <i class="bi bi-plus-lg health-bg-cross cross-1"></i>
  <i class="bi bi-plus-lg health-bg-cross cross-2"></i>

  <div class="auth-container">
    <div class="clean-card">
      <!-- Clean Brand Header -->
      <div class="brand-header">
        <div class="brand-icon-emblem">
          <i class="bi bi-capsule-pill"></i>
        </div>
        <h1 class="brand-title">Apotek <span>Khadijah</span></h1>
        <p class="brand-tagline">Sistem Informasi Layanan Farmasi</p>
      </div>

      <!-- Error Alert -->
      @if(session('error'))
        <div class="alert-shake" role="alert">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-circle-fill text-danger fs-6"></i>
            <span>{{ session('error') }}</span>
          </div>
          <button type="button" class="btn-close btn-sm" onclick="this.parentElement.remove()" aria-label="Close"></button>
        </div>
      @endif

      <!-- Form -->
      <form action="{{ route('login.authenticate') }}" method="POST" id="loginForm" autocomplete="off">
        @csrf

        <!-- Username -->
        <div class="form-group-clean">
          <label for="usernameInput" class="form-label-clean">Username</label>
          <div class="input-wrapper">
            <input
              id="usernameInput"
              type="text"
              name="username"
              class="input-clean"
              placeholder="Masukkan username"
              value="{{ old('username') }}"
              required
              autofocus
            />
            <i class="bi bi-person input-icon-left"></i>
          </div>
          @error('username')
            <div class="text-danger mt-1" style="font-size: 0.8rem;">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Password -->
        <div class="form-group-clean">
          <label for="passwordInput" class="form-label-clean">Password</label>
          <div class="input-wrapper">
            <input
              id="passwordInput"
              type="password"
              name="password"
              class="input-clean"
              placeholder="Masukkan password"
              required
            />
            <i class="bi bi-shield-lock input-icon-left"></i>
            <button
              type="button"
              class="toggle-pass-btn"
              id="togglePasswordBtn"
              title="Tampilkan / Sembunyikan Password"
            >
              <i class="bi bi-eye" id="togglePasswordIcon"></i>
            </button>
          </div>

          <!-- Caps Lock Warning -->
          <div class="caps-warning" id="capsLockAlert">
            <i class="bi bi-capslock-fill"></i> Caps Lock aktif
          </div>

          @error('password')
            <div class="text-danger mt-1" style="font-size: 0.8rem;">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Remember Me Checkbox -->
        <div class="d-flex align-items-center justify-content-between mb-3 mt-1">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" style="cursor: pointer;" />
            <label class="form-check-label" for="rememberMe" style="font-size: 0.84rem; color: var(--text-muted); cursor: pointer;">
              Ingat sesi saya
            </label>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit-clean" id="submitBtn">
          <span id="btnText">Masuk</span>
          <i class="bi bi-arrow-right" id="btnIcon"></i>
          <span class="spinner-border spinner-border-sm d-none" id="btnSpinner" role="status"></span>
        </button>
      </form>

      <!-- Discreet Quick Autofill Helper -->
      <div class="clean-demo-hint">
        <button type="button" class="demo-pill-btn" id="demoAutofillBtn" title="Isi kredensial admin otomatis">
          <i class="bi bi-key-fill"></i>
          <span id="demoBtnText">Isi Akun Admin</span>
        </button>
      </div>
    </div>

    <!-- Clean Footer -->
    <div class="auth-footer">
      <span>&copy; {{ date('Y') }} Apotek Khadijah &bull; Pelayanan Farmasi Terpercaya</span>
    </div>
  </div>

  <!-- Interactive Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const togglePasswordBtn = document.getElementById('togglePasswordBtn');
      const passwordInput = document.getElementById('passwordInput');
      const togglePasswordIcon = document.getElementById('togglePasswordIcon');
      const capsLockAlert = document.getElementById('capsLockAlert');
      const loginForm = document.getElementById('loginForm');
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const btnIcon = document.getElementById('btnIcon');
      const btnSpinner = document.getElementById('btnSpinner');
      const demoAutofillBtn = document.getElementById('demoAutofillBtn');
      const demoBtnText = document.getElementById('demoBtnText');
      const usernameInput = document.getElementById('usernameInput');

      // 1. Password Visibility Toggle
      if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener('click', function () {
          const isPassword = passwordInput.getAttribute('type') === 'password';
          passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

          if (isPassword) {
            togglePasswordIcon.className = 'bi bi-eye-slash';
            togglePasswordBtn.style.color = '#087F5B';
          } else {
            togglePasswordIcon.className = 'bi bi-eye';
            togglePasswordBtn.style.color = '#7b948a';
          }
        });
      }

      // 2. Caps Lock Detector
      if (passwordInput && capsLockAlert) {
        ['keyup', 'keydown'].forEach(evt => {
          passwordInput.addEventListener(evt, function (e) {
            if (e.getModifierState && e.getModifierState('CapsLock')) {
              capsLockAlert.style.display = 'inline-flex';
            } else {
              capsLockAlert.style.display = 'none';
            }
          });
        });
      }

      // 3. Demo Autofill Handler
      if (demoAutofillBtn && usernameInput && passwordInput) {
        demoAutofillBtn.addEventListener('click', function () {
          usernameInput.value = 'admin';
          passwordInput.value = 'admin123';
          demoBtnText.textContent = 'Kredensial Terisi!';
          demoAutofillBtn.style.background = '#dff5eb';
          demoAutofillBtn.style.borderColor = '#20A67A';
          
          setTimeout(() => {
            submitBtn.focus();
          }, 200);
        });
      }

      // 4. Submit Loading State
      if (loginForm && submitBtn) {
        loginForm.addEventListener('submit', function () {
          btnText.textContent = 'Memverifikasi...';
          btnIcon.classList.add('d-none');
          btnSpinner.classList.remove('d-none');
          submitBtn.disabled = true;
          submitBtn.style.opacity = '0.85';
          
          setTimeout(() => {
            loginForm.submit();
          }, 50);
        });
      }
    });
  </script>
</body>
</html>
