<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'Tableau de bord')</title>

  <!-- Inter font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CDN (utilisation rapide) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome (v6 free) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Optional: small custom CSS for finer control -->
  <style>
    :root {
      --accent: #2563eb; /* blue-600 */
      --muted: #6b7280;  /* gray-500 */
    }

    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }

    /* Small polished utilities */
    .nav-link {
      display:flex; align-items:center; gap:0.75rem;
      padding:0.5rem 0.9rem; border-radius:0.6rem; color: #374151;
      transition: all .18s ease;
      text-decoration:none;
    }
    .nav-link:hover, .nav-link:focus {
      background-color: rgba(37,99,235,0.06);
      color: #0f172a;
      outline: none;
    }
    .nav-active {
      background: linear-gradient(180deg, rgba(37,99,235,1), rgba(34,83,220,1));
      color: white !important;
      box-shadow: 0 6px 20px rgba(15,23,42,0.12);
    }

    /* glass effect for sidebar/header */
    .glass {
      background: rgba(255,255,255,0.7);
      backdrop-filter: blur(8px);
    }

    /* smooth collapse icons rotation */
    .rotate-180 { transform: rotate(180deg); }

    @media (min-width: 1024px) {
      /* keep sidebar visible desktop */
      #sidebar { transform: translateX(0) !important; }
    }

    /* subtle fade-in */
    .fade-in { opacity: 0; transform: translateY(8px); animation: fadeInUp .45s ease-out forwards; }
    @keyframes fadeInUp { to { opacity:1; transform:translateY(0); } }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-blue-50 text-gray-800">

  <!-- Mobile topbar -->
  <div class="lg:hidden fixed top-0 inset-x-0 z-50 glass border-b border-gray-200 px-4 py-3 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <button id="mobile-menu-btn" aria-controls="sidebar" aria-expanded="false" aria-label="Menu" class="p-2 rounded-md focus:ring-2 focus:ring-offset-1 focus:ring-blue-200">
        <i class="fa-solid fa-bars text-2xl text-blue-700"></i>
      </button>
      <h1 class="text-lg font-semibold text-blue-900">@yield('title', 'Tableau de bord')</h1>
    </div>

    <div class="flex items-center gap-3">
      <button class="relative p-2 rounded-md focus:outline-none" aria-label="Notifications">
        <i class="fa-regular fa-bell text-xl text-gray-600"></i>
        <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">3</span>
      </button>
      <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff" alt="avatar" class="w-9 h-9 rounded-full border-2 border-blue-100 shadow-sm">
    </div>
  </div>

  <!-- Sidebar (desktop & mobile offcanvas) -->
  <aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen w-72 p-6 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out border-r border-gray-200 shadow-lg glass overflow-y-auto" aria-label="Sidebar">
    <div class="mb-6">
      <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-xl shadow-sm p-4 flex items-center gap-3 hover:shadow-md transition-all duration-300">
        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 text-white rounded-full flex items-center justify-center shadow">
          <i class="fa-solid fa-building text-lg"></i>
        </div>
        <div class="text-sm text-gray-700">
          <div class="font-semibold text-gray-900 leading-tight">Entreprise</div>
          <div class="text-xs text-gray-500 mt-0.5">
            {{ $user->client->company ?? 'Inconnue' }}
          </div>
        </div>
      </div>
    </div>


    <nav class="space-y-3" aria-label="Principales">
      <a href="{{ route('client.dashboard') }}" class="nav-link nav-active" role="link">
        <i class="fa-solid fa-house-chimney text-lg w-5"></i>
        <span class="truncate">Tableau de bord</span>
      </a>

      <!-- Collapsible section helper component -->
      <div class="pt-3 border-t border-gray-100">
        <button class="w-full nav-link justify-between font-semibold text-gray-700" data-collapse-target="contextMenu" aria-expanded="false">
          <span class="flex items-center gap-3"><i class="fa-solid fa-earth-europe"></i> Contexte</span>
          <i class="fa-solid fa-chevron-down transition-transform"></i>
        </button>
        <ul id="contextMenu" class="mt-2 ml-3 space-y-1 hidden" role="menu" aria-hidden="true">
          <li><a href="{{ route('client.parties') }}" class="nav-link"><i class="fa-solid fa-people-group w-4"></i> Parties intéressées</a></li>
          <li><a href="{{ route('client.swot') }}" class="nav-link"><i class="fa-solid fa-chart-line w-4"></i> SWOT / PESTEL</a></li>
          <li><a href="{{ route('client.processus') }}" class="nav-link"><i class="fa-solid fa-diagram-project w-4"></i> Processus du SMQ</a></li>
        </ul>
      </div>

      <div class="pt-3 border-t border-gray-100">
        <button class="w-full nav-link justify-between font-semibold text-gray-700" data-collapse-target="leadershipMenu" aria-expanded="false">
          <span class="flex items-center gap-3"><i class="fa-solid fa-award"></i> Leadership</span>
          <i class="fa-solid fa-chevron-down transition-transform"></i>
        </button>
        <ul id="leadershipMenu" class="mt-2 ml-3 space-y-1 hidden" role="menu" aria-hidden="true">
          <li><a href="{{ route('client.politique') }}" class="nav-link"><i class="fa-solid fa-certificate w-4"></i> Politique Qualité</a></li>
          <li><a href="{{ route('client.raci') }}" class="nav-link"><i class="fa-solid fa-diagram-project w-4"></i> Matrice RACI</a></li>
          <li><a href="#" class="nav-link"><i class="fa-solid fa-calendar-check w-4"></i> Revues de Direction</a></li>
        </ul>
      </div>

      <div class="pt-3 border-t border-gray-100">
        <button class="w-full nav-link justify-between font-semibold text-gray-700" data-collapse-target="planMenu" aria-expanded="false">
          <span class="flex items-center gap-3"><i class="fa-solid fa-clipboard-list"></i> Planification</span>
          <i class="fa-solid fa-chevron-down transition-transform"></i>
        </button>
        <ul id="planMenu" class="mt-2 ml-3 space-y-1 hidden" role="menu" aria-hidden="true">
          <li><a href="{{ route('client.risques') }}" class="nav-link"><i class="fa-solid fa-triangle-exclamation w-4"></i> Risques & Opportunités</a></li>
          <li><a href="{{ route('client.objectifs') }}" class="nav-link"><i class="fa-solid fa-bullseye w-4"></i> Objectifs Qualité</a></li>
          <li><a href="#" class="nav-link"><i class="fa-solid fa-arrows-rotate w-4"></i> Planification des Changements</a></li>
        </ul>
      </div>

      <div class="pt-3 border-t border-gray-100">
        <button class="w-full nav-link justify-between font-semibold text-gray-700" data-collapse-target="supportMenu" aria-expanded="false">
          <span class="flex items-center gap-3"><i class="fa-solid fa-gear"></i> Soutien</span>
          <i class="fa-solid fa-chevron-down transition-transform"></i>
        </button>
        <ul id="supportMenu" class="mt-2 ml-3 space-y-1 hidden" role="menu" aria-hidden="true">
          <li><a href="{{ route('client.docs') }}" class="nav-link"><i class="fa-solid fa-file-lines w-4"></i> Documentation</a></li>
          <li><a href="{{ route('client.equipements') }}" class="nav-link"><i class="fa-solid fa-screwdriver-wrench w-4"></i> Équipements</a></li>
          <li><a href="#" class="nav-link"><i class="fa-solid fa-id-badge w-4"></i> Compétences</a></li>
        </ul>
      </div>

      <div class="pt-3 border-t border-gray-100">
        <button class="w-full nav-link justify-between font-semibold text-gray-700" data-collapse-target="evalMenu" aria-expanded="false">
          <span class="flex items-center gap-3"><i class="fa-solid fa-chart-simple"></i> Évaluation</span>
          <i class="fa-solid fa-chevron-down transition-transform"></i>
        </button>
        <ul id="evalMenu" class="mt-2 ml-3 space-y-1 hidden" role="menu" aria-hidden="true">
          <li><a href="{{ route('client.audits') }}" class="nav-link"><i class="fa-solid fa-shield-check w-4"></i> Audits Internes</a></li>
          <li><a href="#" class="nav-link"><i class="fa-regular fa-face-smile w-4"></i> Satisfaction Client</a></li>
        </ul>
      </div>

      <div class="pt-3 border-t border-gray-100">
        <button class="w-full nav-link justify-between font-semibold text-gray-700" data-collapse-target="improveMenu" aria-expanded="false">
          <span class="flex items-center gap-3"><i class="fa-solid fa-lightbulb"></i> Amélioration</span>
          <i class="fa-solid fa-chevron-down transition-transform"></i>
        </button>
        <ul id="improveMenu" class="mt-2 ml-3 space-y-1 hidden" role="menu" aria-hidden="true">
          <li><a href="{{ route('client.capa') }}" class="nav-link"><i class="fa-solid fa-bug w-4"></i> Non-conformités / CAPA</a></li>
          <li><a href="{{ route('client.ia') }}" class="nav-link"><i class="fa-solid fa-robot w-4"></i> IA Prédictive</a></li>
        </ul>
      </div>

      <div class="pt-4 border-t border-gray-100">
        <a href="#" class="nav-link"><i class="fa-solid fa-gauge-high w-4"></i> Tableaux de bord</a>
      </div>
    </nav>

    <div class="mt-6 border-t pt-4">
      <a href="{{ route('user.logout') }}" class="flex items-center justify-center gap-2 border border-red-500 text-red-600 px-3 py-2 rounded hover:bg-red-50 transition" role="button">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Se déconnecter
      </a>
    </div>
  </aside>

  <!-- Main content -->
  <main class="lg:ml-72 pt-20 lg:pt-10 px-6 pb-12 min-h-screen transition-all">
    <!-- Header -->
    <header class="sticky top-0 z-30 bg-white/70 backdrop-blur-md glass py-4 mb-6 rounded-xl shadow-sm flex flex-col lg:flex-row items-center justify-between gap-4 px-4">
      <!-- Search -->
      <div class="relative w-full lg:max-w-md">
        <label for="search" class="sr-only">Recherche</label>
        <input id="search" type="search" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-400"></i>
      </div>

      <!-- Right controls -->
      <div class="flex items-center gap-4">
        <button class="relative p-2 rounded-md hover:text-blue-600 focus:ring-2 focus:ring-offset-1 focus:ring-blue-200" aria-label="Notifications">
          <i class="fa-regular fa-bell text-2xl text-gray-600"></i>
          <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1.5">3</span>
        </button>

        <div class="flex items-center gap-3">
          <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff" alt="avatar" class="w-10 h-10 rounded-full border-2 border-blue-100 shadow">
          <div class="hidden sm:block text-left">
            <div class="text-sm font-medium text-gray-800">{{ $user->name }}</div>
            <div class="text-xs text-gray-500">Administrateur</div>
          </div>
        </div>
      </div>
    </header>

    <!-- Page content area -->
    <section class="fade-in">
      @yield('content')
    </section>

    <!-- Footer -->
    <footer class="mt-16 border-t pt-6 text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} MonApp. Tous droits réservés.
      <a href="/mentions-legales" class="ml-2 text-blue-600 hover:underline">Mentions légales</a>
    </footer>
  </main>

  <!-- JavaScript: sidebar toggles, collapse groups, accessible keyboard handling -->
  <script>
    // Elements
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar-btn');

    // Toggle sidebar on mobile
    function setSidebar(open) {
      if (open) {
        sidebar.classList.remove('-translate-x-full');
        mobileBtn?.setAttribute('aria-expanded','true');
        document.body.style.overflow = 'hidden'; // prevent scroll behind
      } else {
        sidebar.classList.add('-translate-x-full');
        mobileBtn?.setAttribute('aria-expanded','false');
        document.body.style.overflow = '';
      }
    }

    mobileBtn?.addEventListener('click', () => setSidebar(true));
    closeSidebarBtn?.addEventListener('click', () => setSidebar(false));

    // Close by clicking outside (mobile)
    document.addEventListener('click', (e) => {
      if (window.innerWidth >= 1024) return;
      if (!sidebar.contains(e.target) && !mobileBtn.contains(e.target)) {
        setSidebar(false);
      }
    });

    // Keyboard: ESC closes
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') setSidebar(false);
    });

    // Collapsible groups (aria-friendly)
    document.querySelectorAll('[data-collapse-target]').forEach(btn => {
      const targetId = btn.getAttribute('data-collapse-target');
      const list = document.getElementById(targetId);
      const chevron = btn.querySelector('.fa-chevron-down');

      if (!list) return;
      btn.addEventListener('click', () => {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!expanded));
        list.classList.toggle('hidden');
        // rotate arrow
        const arrow = btn.querySelector('.fa-chevron-down');
        if (arrow) arrow.classList.toggle('rotate-180');
      });

      // keyboard support: toggle with Enter / Space
      btn.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          btn.click();
        }
      });
    });

    // Improve focus ring visibility for mouse vs keyboard
    (function() {
      function handleFirstTab(e) {
        if (e.key === 'Tab') {
          document.documentElement.classList.add('user-is-tabbing');
          window.removeEventListener('keydown', handleFirstTab);
        }
      }
      window.addEventListener('keydown', handleFirstTab);
    })();
  </script>

  @stack('scripts')
</body>
</html>
