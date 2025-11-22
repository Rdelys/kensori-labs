<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'Tableau de bord')</title>

  <!-- Inter font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom Premium Styling -->
  <style>
    :root {
      /* Core palette */
      --accent: #0f172a;            /* deep navy base for luxury */
      --accent-2: #0ea5e9;         /* sapphire highlight */
      --accent-3: #7c3aed;         /* amethyst */
      --gold: #d4af37;             /* premium gold accent */
      --glass-bg: rgba(255,255,255,0.6);
      --glass-strong: rgba(255,255,255,0.85);
      --muted: #6b7280;
      --text-primary: #0b1220;
      --bg-1: linear-gradient(135deg,#f8fafc 0%, #eef2ff 100%);
      --radius-lg: 16px;
      --radius-xl: 22px;
    }

    /* Base */
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
      background: var(--bg-1);
      color: var(--text-primary);
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      line-height:1.45;
      min-height:100vh;
    }

    /* Subtle page container shadow */
    .page-shell {
      max-width: 1400px;
      margin: 0 auto;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    /* Premium nav link (overrides + Tailwind utilities kept) */
    .nav-link {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      padding: 0.6rem 1rem;
      border-radius: 12px;
      font-weight: 600;
      color: var(--muted);
      transition: all 260ms cubic-bezier(.2,.9,.2,1);
      text-decoration: none;
      will-change: transform, box-shadow;
      background: transparent;
      font-size: 0.95rem;
      letter-spacing: 0.2px;
    }
    .nav-link i { min-width:1.05rem; text-align:center; opacity:0.95; }

    .nav-link:hover {
      transform: translateX(6px);
      color: white;
      background: linear-gradient(90deg, rgba(14,165,233,0.98), rgba(124,58,237,0.95));
      box-shadow: 0 10px 30px rgba(12,74,184,0.12);
    }

    .nav-active {
      background: linear-gradient(135deg, rgba(14,165,233,1), rgba(124,58,237,0.95));
      color: #fff !important;
      box-shadow: 0 12px 28px rgba(124,58,237,0.18), inset 0 -2px 8px rgba(255,255,255,0.06);
      transform: translateX(2px);
    }

    /* Glass container */
    .glass {
      background: var(--glass-bg);
      border: 1px solid rgba(255,255,255,0.6);
      backdrop-filter: blur(10px) saturate(1.05);
      -webkit-backdrop-filter: blur(10px) saturate(1.05);
    }

    /* Sidebar */
    #sidebar {
      border-right: 1px solid rgba(11,18,32,0.04);
      background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(249,250,251,0.98));
      transition: all 300ms ease;
      /* soft inner glow to suggest depth */
      box-shadow: 0 8px 30px rgba(8,11,22,0.03);
    }

    /* Sidebar header logo */
    .company-card {
      background: linear-gradient(180deg, rgba(255,255,255,1), rgba(243,246,255,0.98));
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(6,7,23,0.06);
      transition: transform .26s ease, box-shadow .26s ease;
      padding:0.75rem;
    }
    .company-card:hover{ transform: translateY(-4px); box-shadow:0 18px 40px rgba(7,11,35,0.06); }

    .company-badge {
      width:44px; height:44px;
      display:flex; align-items:center; justify-content:center;
      border-radius:10px;
      background: linear-gradient(135deg,#0ea5e9,#7c3aed);
      color:white; box-shadow: 0 8px 20px rgba(124,58,237,0.15);
      font-weight:700;
    }

    /* Mobile topbar - stronger glass + blur */
    .mobile-topbar {
      background: linear-gradient(180deg, rgba(255,255,255,0.7), rgba(255,255,255,0.55));
      backdrop-filter: blur(8px) saturate(1.02);
      border-bottom: 1px solid rgba(11,18,32,0.04);
    }

    /* Fade-in animations */
    .fade-in { opacity: 0; transform: translateY(10px); animation: fadeInUp .56s cubic-bezier(.2,.9,.2,1) forwards; }
    @keyframes fadeInUp { to { opacity:1; transform:translateY(0); } }

    /* Search input - premium */
    input[type="search"] {
      background: linear-gradient(180deg,#ffffff,#fbfdff);
      border-radius: 12px;
      transition: box-shadow .22s ease, transform .18s ease;
      border: 1px solid rgba(11,18,32,0.06);
      padding-left: 2.6rem !important;
    }
    input[type="search"]:focus {
      outline: none;
      box-shadow: 0 8px 26px rgba(14,165,233,0.12);
      border-color: rgba(14,165,233,0.95);
      transform: translateY(-1px);
    }

    /* Avatar */
    .avatar-ring {
      border: 2px solid rgba(14,165,233,0.08);
      padding: 2px; border-radius: 9999px;
      background: linear-gradient(180deg, rgba(255,255,255,0.75), rgba(255,255,255,0.65));
      box-shadow: 0 6px 20px rgba(12,74,184,0.06);
    }

    /* Logout button */
    .logout-btn {
      border: 1.5px solid #ef4444;
      color: #ef4444;
      border-radius: 12px;
      transition: all 0.25s ease;
      font-weight: 600;
      background: linear-gradient(180deg, rgba(255,255,255,0.8), rgba(255,255,255,0.7));
      padding: 0.6rem 0.9rem;
      display:inline-flex; align-items:center; gap:0.5rem;
      justify-content:center;
    }
    .logout-btn:hover {
      background: linear-gradient(90deg, #ef4444, #dc2626);
      color: white;
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(239,68,68,0.18);
    }

    /* Buttons & small utility */
    .btn-premium {
      background: linear-gradient(90deg, #0ea5e9, #7c3aed);
      color: white;
      border-radius: 12px;
      padding: 0.5rem 0.9rem;
      font-weight: 600;
      box-shadow: 0 8px 26px rgba(124,58,237,0.12);
      transition: transform .18s ease, box-shadow .18s ease;
    }
    .btn-premium:hover { transform: translateY(-3px); box-shadow: 0 18px 46px rgba(14,165,233,0.12); }

    /* Footer */
    footer {
      background: linear-gradient(180deg, rgba(255,255,255,0.85), rgba(250,250,255,0.6));
      backdrop-filter: blur(6px);
      border-top: 1px solid rgba(11,18,32,0.04);
      color: var(--muted);
    }

    /* Collapsible chevrons */
    .chev {
      transition: transform .28s cubic-bezier(.2,.9,.2,1);
      color: var(--muted);
    }
    .chev.rotate-180 { transform: rotate(180deg); color: var(--accent-2); }

    /* Responsive adjustments */
    @media (min-width: 1024px) {
      #sidebar { transform: translateX(0) !important; width: 300px; }
      main { padding-left: 2rem; padding-right: 2rem; }
    }

    @media (max-width: 1023px) {
      #sidebar { width: 86%; max-width:420px; }
    }

    /* Tiny helpers */
    .muted { color: var(--muted); }
    .heading-lg { font-size:1.125rem; font-weight:700; color:var(--text-primary); }
    .subtle { color: #9aa4b2; font-size:0.875rem; }

    /* Accessibility focus */
    a:focus, button:focus, input:focus { outline: 3px solid rgba(124,58,237,0.12); outline-offset: 3px; border-radius:8px; }

    /* Extra polish for lists in sidebar */
    #sidebar ul li a { padding-left: 0.75rem; padding-right: 0.75rem; border-radius: 10px; display:block; }
    #sidebar ul li a:hover { transform: translateX(4px); }

    /* Slight decorative divider */
    .soft-divider { height:1px; background: linear-gradient(90deg, transparent, rgba(11,18,32,0.04), transparent); margin: .9rem 0; border-radius: 2px; }

    /* Subtle badge */
    .badge-soft {
      font-size: 10px; padding: 4px 8px; border-radius: 999px; background: rgba(14,165,233,0.08); color: #035388; font-weight:600;
    }

    /* Make icons look crisp in dark-ish gradients */
    .fa-solid, .fa-regular, .fa-brands { color: inherit; -webkit-font-smoothing: antialiased; }

  </style>
</head>

<body class="text-gray-800">

  <!-- Mobile topbar -->
  <div class="lg:hidden fixed top-0 inset-x-0 z-50 mobile-topbar px-4 py-3 flex items-center justify-between shadow-md">
    <div class="flex items-center gap-3">
      <button id="mobile-menu-btn" aria-controls="sidebar" aria-expanded="false" aria-label="Menu" class="p-2 rounded-md focus:ring-2 focus:ring-blue-300">
        <i class="fa-solid fa-bars text-2xl text-blue-700"></i>
      </button>
      <h1 class="text-lg font-semibold text-blue-900">@yield('title', 'Tableau de bord')</h1>
    </div>
    <div class="flex items-center gap-3">
      <button class="relative p-2 rounded-md hover:text-blue-600">
        <i class="fa-regular fa-bell text-xl"></i>
        <span class="absolute -top-1 -right-1 px-1.5 py-0.5 bg-red-500 text-white text-xs rounded-full">3</span>
      </button>
      <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff" alt="avatar" class="w-9 h-9 rounded-full shadow-md border border-blue-200">
    </div>
  </div>

  <!-- Sidebar -->
  <aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen w-72 p-6 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl glass overflow-y-auto">
    <div class="mb-6">
      <div class="company-card p-4 flex items-center gap-3">
        <div class="company-badge">
          <i class="fa-solid fa-building text-lg"></i>
        </div>
        <div>
          <div class="font-semibold text-gray-900">Entreprise</div>
          <div class="text-xs text-gray-500">{{ $user->client->company ?? 'Inconnue' }}</div>
        </div>
      </div>
    </div>

    <nav class="space-y-3">
      <a href="{{ route('client.dashboard') }}" class="nav-link nav-active">
        <i class="fa-solid fa-house-chimney text-lg w-5"></i>
        <span>Tableau de bord</span>
      </a>

      <!-- Sections -->
      @foreach([
        ['id'=>'contextMenu','icon'=>'earth-europe','label'=>'Contexte','items'=>[
          ['client.parties','people-group','Parties intéressées'],
          ['client.swot','chart-line','SWOT / PESTEL'],
          ['client.processus','diagram-project','Processus du SMQ']
        ]],
        ['id'=>'leadershipMenu','icon'=>'award','label'=>'Leadership','items'=>[
          ['client.politique','certificate','Politique Qualité'],
          ['client.raci','diagram-project','Matrice RACI'],
          ['client.revu','calendar-check','Revues de Direction']
        ]],
        ['id'=>'planMenu','icon'=>'clipboard-list','label'=>'Planification','items'=>[
          ['client.risques','triangle-exclamation','Risques & Opportunités'],
          ['client.objectifs','bullseye','Objectifs Qualité'],
          ['client.plani','arrows-rotate','Planification des Changements']
        ]],
        ['id'=>'supportMenu','icon'=>'gear','label'=>'Soutien','items'=>[
          ['client.docs','file-lines','Documentation'],
          ['client.equipements','screwdriver-wrench','Équipements'],
          ['client.competences','id-badge','Compétences']
        ]],
        ['id'=>'evalMenu','icon'=>'chart-simple','label'=>'Évaluation','items'=>[
          ['client.audits','shield-check','Audits Internes'],
          ['client.satisfaction','face-smile','Satisfaction Client']
        ]],
        ['id'=>'improveMenu','icon'=>'lightbulb','label'=>'Amélioration','items'=>[
          ['client.capa','bug','Non-conformités / CAPA'],
          ['client.ia','robot','IA Prédictive']
        ]]
      ] as $section)
      <div class="pt-3 border-t border-gray-100">
        <button class="w-full nav-link justify-between font-semibold" data-collapse-target="{{ $section['id'] }}" aria-expanded="false" aria-controls="{{ $section['id'] }}">
          <span class="flex items-center gap-3"><i class="fa-solid fa-{{ $section['icon'] }}"></i> {{ $section['label'] }}</span>
          <i class="fa-solid fa-chevron-down chev transition-transform"></i>
        </button>
        <ul id="{{ $section['id'] }}" class="mt-2 ml-3 space-y-1 hidden">
          @foreach($section['items'] as [$route, $icon, $label])
          <li><a href="{{ route($route) }}" class="nav-link"><i class="fa-solid fa-{{ $icon }} w-4"></i> {{ $label }}</a></li>
          @endforeach
        </ul>
      </div>
      @endforeach
    </nav>

    <div class="mt-6 border-t pt-4">
      <a href="{{ route('user.logout') }}" class="logout-btn flex items-center justify-center gap-2 px-3 py-2">
        <i class="fa-solid fa-arrow-right-from-bracket"></i> Se déconnecter
      </a>
    </div>
  </aside>

  <!-- Main content -->
  <main class="lg:ml-72 pt-20 lg:pt-10 px-6 pb-12 min-h-screen transition-all page-shell">
    <header class="sticky top-0 z-30 glass py-4 mb-6 rounded-2xl shadow-lg flex flex-col lg:flex-row items-center justify-between gap-4 px-5">
      <div class="relative w-full lg:max-w-md">
        <input id="search" type="search" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 border border-gray-200" />
        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-400"></i>
      </div>
      <div class="flex items-center gap-4">
        <button class="relative p-2 rounded-md hover:text-blue-600">
          <i class="fa-regular fa-bell text-2xl text-gray-600"></i>
          <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1.5">3</span>
        </button>
        <div class="flex items-center gap-3">
          <div class="avatar-ring rounded-full">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff" alt="avatar" class="w-10 h-10 rounded-full border-2 border-blue-100 shadow">
          </div>
          <div class="hidden sm:block text-left">
            <div class="text-sm font-medium">{{ $user->name }}</div>
            <div class="text-xs text-gray-500">Administrateur</div>
          </div>
        </div>
      </div>
    </header>

    <section class="fade-in">
      @yield('content')
    </section>

    <footer class="mt-16 pt-6 pb-6 text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} <span class="font-semibold text-blue-700">MonApp</span>. Tous droits réservés.
      <a href="/mentions-legales" class="ml-2 text-blue-600 hover:underline">Mentions légales</a>
    </footer>
  </main>

  <!-- JavaScript -->
  <script>
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');

    function setSidebar(open) {
      if (open) {
        sidebar.classList.remove('-translate-x-full');
        document.body.style.overflow = 'hidden';
        // add slight backdrop to focus content on mobile
        if (!document.getElementById('mobile-backdrop')) {
          const backdrop = document.createElement('div');
          backdrop.id = 'mobile-backdrop';
          backdrop.style.position = 'fixed';
          backdrop.style.inset = '0';
          backdrop.style.zIndex = '30';
          backdrop.style.background = 'rgba(8,12,20,0.35)';
          backdrop.addEventListener('click', () => setSidebar(false));
          document.body.appendChild(backdrop);
        } else {
          document.getElementById('mobile-backdrop').style.display = 'block';
        }
      } else {
        sidebar.classList.add('-translate-x-full');
        document.body.style.overflow = '';
        const bd = document.getElementById('mobile-backdrop');
        if (bd) bd.style.display = 'none';
      }
      // update aria-expanded on the button
      if (mobileBtn) mobileBtn.setAttribute('aria-expanded', !!open);
    }
    mobileBtn?.addEventListener('click', (e) => {
      // toggle on click for better UX
      const expanded = mobileBtn.getAttribute('aria-expanded') === 'true';
      setSidebar(!expanded);
    });
    document.addEventListener('click', (e) => {
      if (window.innerWidth >= 1024) return;
      if (!sidebar.contains(e.target) && !mobileBtn.contains(e.target)) setSidebar(false);
    });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setSidebar(false); });

    // Collapsible menus
    document.querySelectorAll('[data-collapse-target]').forEach(btn => {
      const targetId = btn.getAttribute('data-collapse-target');
      const list = document.getElementById(targetId);
      // Ensure initial aria attributes
      btn.setAttribute('aria-expanded', 'false');
      if (!list) return;
      btn.addEventListener('click', (ev) => {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', (!expanded).toString());
        list.classList.toggle('hidden');
        const chev = btn.querySelector('.fa-chevron-down');
        if (chev) chev.classList.toggle('rotate-180');
      });
    });

    // Small enhancement: link keyboard accessibility for collapse
    document.querySelectorAll('[data-collapse-target]').forEach(btn => {
      btn.addEventListener('keyup', (e) => { if (e.key === 'Enter' || e.key === ' ') btn.click(); });
    });

    // Make sure navigation active state is preserved visually if server sets class
    // (No-op here but kept for extendability)
    (function markActiveLinks() {
      try {
        const links = document.querySelectorAll('#sidebar a');
        links.forEach(a => {
          // if current url includes route path -- simple heuristic (server should provide nav-active)
          if (a.href && window.location.href.startsWith(a.href)) {
            a.classList.add('nav-active');
          }
        });
      } catch(e){}
    })();

    // Small utility: preserve focus trap when sidebar open on mobile
    document.addEventListener('focusin', function(e){
      if (window.innerWidth < 1024 && !sidebar.contains(e.target) && !mobileBtn.contains(e.target) && sidebar.classList.contains('-translate-x-full') === false) {
        // move focus to sidebar for keyboard users
        const firstFocusable = sidebar.querySelector('a,button,input,select,textarea');
        if (firstFocusable) firstFocusable.focus();
      }
    });

  </script>
</body>
</html>
