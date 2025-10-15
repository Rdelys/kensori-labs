<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Tableau de bord')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
  html {
    scroll-behavior: smooth;
  }

  body {
    font-family: 'Inter', sans-serif;
  }

  .nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem; /* gap-3 */
    padding: 0.5rem 1rem; /* py-2 px-4 */
    border-radius: 0.5rem; /* rounded-lg */
    color: #374151; /* text-gray-700 */
    transition: all 0.2s ease;
    text-decoration: none;
  }

  .nav-link:hover {
    background-color: #eff6ff; /* hover:bg-blue-50 */
  }

  .nav-link.active {
    background-color: #2563eb; /* bg-blue-600 */
    color: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* shadow */
  }

  .glass {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(16px);
  }

  @media (min-width: 1024px) {
    #sidebar {
      transform: translateX(0) !important;
    }
  }

  /* Optional: small animation on fade-in content */
  .fade-in {
    opacity: 0;
    transform: translateY(10px);
    animation: fadeInUp 0.4s ease-out forwards;
  }

  @keyframes fadeInUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-blue-100 text-gray-800">

<!-- 🟦 Mobile Navbar -->
<div class="lg:hidden fixed top-0 w-full bg-white shadow z-50 flex justify-between items-center px-4 py-3">
  <h1 class="text-lg font-semibold text-blue-800">@yield('title', 'Tableau de bord')</h1>
  <button id="menu-btn" class="text-2xl text-blue-700">
    <i class="bi bi-list"></i>
  </button>
</div>

<!-- 🟦 Sidebar -->
<aside id="sidebar" class="glass fixed inset-y-0 left-0 z-40 w-72 p-6 transform -translate-x-full lg:translate-x-0 transition duration-300 ease-in-out border-r border-gray-200 shadow-lg">
  <div class="mb-10">
    <div class="flex items-center justify-between">
      <div>
        <h5 class="text-xl font-semibold text-blue-900">👋 Bonjour, {{ $user->name }}</h5>
        <p class="text-sm text-gray-600">Entreprise :
          <span class="font-medium">{{ $user->client->company ?? 'Inconnue' }}</span>
        </p>
      </div>
      <i class="bi bi-person-circle text-3xl text-blue-700"></i>
    </div>
  </div>

  <nav class="space-y-1">
    <a href="{{ route('client.dashboard') }}" class="nav-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
      <i class="bi bi-house-door"></i> Tableau de bord
    </a>

    <div class="mt-4">
      <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">Modules QMS</p>
      <ul class="space-y-1">
        <li><a href="{{ route('client.parties') }}" class="nav-link {{ request()->routeIs('client.parties') ? 'active' : '' }}"><i class="bi bi-people"></i> Parties intéressées</a></li>
        <li><a href="{{ route('client.swot') }}" class="nav-link {{ request()->routeIs('client.swot') ? 'active' : '' }}"><i class="bi bi-bar-chart-line"></i> SWOT / PESTEL</a></li>
        <li><a href="{{ route('client.politique') }}" class="nav-link {{ request()->routeIs('client.politique') ? 'active' : '' }}"><i class="bi bi-award"></i> Politique Qualité</a></li>
        <li><a href="{{ route('client.raci') }}" class="nav-link {{ request()->routeIs('client.raci') ? 'active' : '' }}"><i class="bi bi-diagram-3"></i> Matrice RACI</a></li>
        <li><a href="{{ route('client.risques') }}" class="nav-link {{ request()->routeIs('client.risques') ? 'active' : '' }}"><i class="bi bi-exclamation-triangle"></i> Risques</a></li>
        <li><a href="{{ route('client.objectifs') }}" class="nav-link {{ request()->routeIs('client.objectifs') ? 'active' : '' }}"><i class="bi bi-bullseye"></i> Objectifs</a></li>
        <li><a href="{{ route('client.docs') }}" class="nav-link {{ request()->routeIs('client.docs') ? 'active' : '' }}"><i class="bi bi-file-earmark-text"></i> Documents</a></li>
        <li><a href="{{ route('client.equipements') }}" class="nav-link {{ request()->routeIs('client.equipements') ? 'active' : '' }}"><i class="bi bi-gear-wide-connected"></i> Équipements</a></li>
        <li><a href="{{ route('client.audits') }}" class="nav-link {{ request()->routeIs('client.audits') ? 'active' : '' }}"><i class="bi bi-shield-check"></i> Audits</a></li>
        <li><a href="{{ route('client.capa') }}" class="nav-link {{ request()->routeIs('client.capa') ? 'active' : '' }}"><i class="bi bi-lightbulb"></i> CAPA</a></li>
        <li><a href="{{ route('client.ia') }}" class="nav-link {{ request()->routeIs('client.ia') ? 'active' : '' }}"><i class="bi bi-cpu"></i> IA prédictive</a></li>
      </ul>
    </div>
  </nav>

  <div class="mt-6 pt-6 border-t border-gray-200">
    <a href="{{ route('user.logout') }}" class="flex items-center justify-center gap-2 border border-red-500 text-red-600 px-3 py-2 rounded hover:bg-red-50 transition">
      <i class="bi bi-box-arrow-right"></i> Se déconnecter
    </a>
  </div>
</aside>

<!-- 🟦 Main content -->
<main class="lg:ml-72 pt-20 lg:pt-10 px-6 pb-12 min-h-screen transition-all">
  <!-- Header sticky -->
  <header class="sticky top-0 bg-white bg-opacity-90 backdrop-blur-lg z-30 py-4 mb-6 rounded-xl shadow-sm flex flex-col lg:flex-row items-center justify-between gap-4 px-4">
    <!-- Search -->
    <div class="relative w-full lg:max-w-sm">
      <input type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
      <i class="bi bi-search absolute left-3 top-2.5 text-gray-500"></i>
    </div>

    <!-- Right icons -->
    <div class="flex items-center gap-4">
      <button class="relative hover:text-blue-600">
        <i class="bi bi-bell text-2xl text-gray-600"></i>
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1.5">3</span>
      </button>
      <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff"
           alt="avatar" class="w-10 h-10 rounded-full border-2 border-blue-200 shadow">
    </div>
  </header>

  <!-- Page content -->
  <section class="fade-in">
    @yield('content')
  </section>

  <!-- Footer -->
  <footer class="mt-16 border-t pt-6 text-center text-sm text-gray-500">
    &copy; {{ date('Y') }} MonApp. Tous droits réservés.
    <a href="/mentions-legales" class="ml-2 text-blue-600 hover:underline">Mentions légales</a>
  </footer>
</main>

<!-- JavaScript mobile sidebar toggle -->
<script>
  const btn = document.getElementById('menu-btn');
  const sidebar = document.getElementById('sidebar');

  btn?.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
  });
</script>

@stack('scripts')
</body>
</html>
