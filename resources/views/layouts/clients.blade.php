<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'Tableau de bord')</title>

  <!-- Inter font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom Premium Styling -->
  <style>
    :root {
      --accent: #2563eb; /* Blue 600 */
      --accent-light: #3b82f6;
      --accent-dark: #1e40af;
      --text-primary: #1e293b;
      --text-secondary: #64748b;
      --bg-main: #f8fafc;
      --bg-glass: rgba(255,255,255,0.75);
      --radius: 1rem;
    }

    html { scroll-behavior: smooth; }
    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, #f9fafb 0%, #eef2ff 100%);
      color: var(--text-primary);
    }

    /* Premium nav link */
    .nav-link {
      display: flex; align-items: center; gap: 0.85rem;
      padding: 0.6rem 1rem;
      border-radius: var(--radius);
      font-weight: 500;
      color: var(--text-secondary);
      transition: all 0.25s ease;
      text-decoration: none;
    }
    .nav-link:hover {
      background: linear-gradient(to right, var(--accent-light), var(--accent-dark));
      color: white;
      transform: translateX(2px);
      box-shadow: 0 4px 10px rgba(37,99,235,0.25);
    }
    .nav-active {
      background: linear-gradient(90deg, var(--accent), var(--accent-dark));
      color: white !important;
      box-shadow: 0 8px 22px rgba(37,99,235,0.35);
    }

    /* Glass effect */
    .glass {
      background: var(--bg-glass);
      backdrop-filter: blur(14px);
    }

    /* Sidebar */
    #sidebar {
      border-right: 1px solid rgba(0,0,0,0.05);
      background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(245,247,250,0.9));
    }

    .rotate-180 { transform: rotate(180deg); }

    @media (min-width: 1024px) {
      #sidebar { transform: translateX(0) !important; }
    }

    /* Smooth fade animation */
    .fade-in { opacity: 0; transform: translateY(10px); animation: fadeInUp .5s ease-out forwards; }
    @keyframes fadeInUp { to { opacity:1; transform:translateY(0); } }

    /* Premium search input */
    input[type="search"] {
      background: white;
      border-radius: var(--radius);
      transition: all 0.2s ease;
    }
    input[type="search"]:focus {
      box-shadow: 0 0 0 3px rgba(37,99,235,0.25);
      border-color: var(--accent);
    }

    /* Logout button */
    .logout-btn {
      border: 1.5px solid #ef4444;
      color: #ef4444;
      border-radius: var(--radius);
      transition: all 0.25s ease;
      font-weight: 500;
    }
    .logout-btn:hover {
      background: #ef4444;
      color: white;
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(239,68,68,0.25);
    }

    /* Avatar and company card */
    .company-card {
      background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
      border-radius: var(--radius);
      box-shadow: 0 4px 14px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }
    .company-card:hover {
      box-shadow: 0 8px 22px rgba(0,0,0,0.08);
      transform: translateY(-2px);
    }

    /* Modern footer */
    footer {
      background: rgba(255,255,255,0.7);
      backdrop-filter: blur(8px);
      border-top: 1px solid rgba(0,0,0,0.05);
    }
  </style>
</head>

<body class="text-gray-800">

  <!-- Mobile topbar -->
  <div class="lg:hidden fixed top-0 inset-x-0 z-50 glass border-b border-gray-200 px-4 py-3 flex items-center justify-between shadow-md">
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
        <div class="w-11 h-11 bg-gradient-to-br from-blue-600 to-indigo-500 text-white rounded-full flex items-center justify-center shadow">
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
        <button class="w-full nav-link justify-between font-semibold" data-collapse-target="{{ $section['id'] }}">
          <span class="flex items-center gap-3"><i class="fa-solid fa-{{ $section['icon'] }}"></i> {{ $section['label'] }}</span>
          <i class="fa-solid fa-chevron-down transition-transform"></i>
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
  <main class="lg:ml-72 pt-20 lg:pt-10 px-6 pb-12 min-h-screen transition-all">
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
          <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff" alt="avatar" class="w-10 h-10 rounded-full border-2 border-blue-100 shadow">
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
      } else {
        sidebar.classList.add('-translate-x-full');
        document.body.style.overflow = '';
      }
    }
    mobileBtn?.addEventListener('click', () => setSidebar(true));
    document.addEventListener('click', (e) => {
      if (window.innerWidth >= 1024) return;
      if (!sidebar.contains(e.target) && !mobileBtn.contains(e.target)) setSidebar(false);
    });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setSidebar(false); });

    // Collapsible menus
    document.querySelectorAll('[data-collapse-target]').forEach(btn => {
      const targetId = btn.getAttribute('data-collapse-target');
      const list = document.getElementById(targetId);
      btn.addEventListener('click', () => {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
        list.classList.toggle('hidden');
        btn.querySelector('.fa-chevron-down')?.classList.toggle('rotate-180');
      });
    });
  </script>
</body>
</html>
