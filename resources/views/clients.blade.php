<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tableau de bord</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="flex bg-gray-50 text-gray-800 min-h-screen">

  <!-- Sidebar -->
  <aside class="w-72 bg-gradient-to-b from-blue-50 to-white border-r border-gray-200 p-6 fixed inset-y-0 overflow-y-auto">
    <div class="mb-8">
      <h5 class="text-lg font-semibold text-blue-900 mb-1">Bienvenue, {{ $user->name }}</h5>
      <p class="text-sm text-gray-600">
        Entreprise :
        <span class="font-medium text-gray-800">{{ $user->client->company ?? 'Inconnue' }}</span>
      </p>
    </div>

    <nav class="space-y-2">
      <a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-blue-600 text-white font-medium transition hover:bg-blue-700">
        <i class="bi bi-house-door text-lg"></i> Tableau de bord
      </a>

      <div class="mt-6">
        <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">Modules QMS</p>

        <ul class="space-y-1">
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-people"></i>Parties intéressées</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-bar-chart-line"></i>Analyse SWOT / PESTEL</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-award"></i>Politique Qualité</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-diagram-3"></i>Matrice RACI</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-exclamation-triangle"></i>Risques & Opportunités</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-bullseye"></i>Objectifs Qualité</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-file-earmark-text"></i>Documents & Versions</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-gear-wide-connected"></i>Équipements & Maintenance</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-shield-check"></i>Audits internes</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-lightbulb"></i>CAPA / Non-conformités</a></li>
          <li><a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition"><i class="bi bi-cpu"></i>Analyse prédictive</a></li>
        </ul>
      </div>
    </nav>

    <div class="mt-8">
      <a href="{{ route('user.logout') }}" class="w-full flex items-center justify-center gap-2 px-3 py-2 border border-red-500 text-red-600 rounded-lg font-medium hover:bg-red-50 transition">
        <i class="bi bi-box-arrow-right"></i> Se déconnecter
      </a>
    </div>
  </aside>

  <!-- Content -->
  <main class="flex-1 ml-72 p-10 overflow-y-auto">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Tableau de bord</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Exemple de carte -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <h3 class="font-semibold text-gray-800 mb-2">Performances QMS</h3>
        <p class="text-sm text-gray-500">Vue d’ensemble des indicateurs de performance qualité.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <h3 class="font-semibold text-gray-800 mb-2">Équipements</h3>
        <p class="text-sm text-gray-500">Suivi de maintenance et calibrations prévues.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <h3 class="font-semibold text-gray-800 mb-2">Audits internes</h3>
        <p class="text-sm text-gray-500">Prochain audit : 22 octobre 2025.</p>
      </div>
    </div>

    <div class="mt-10 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
      <h2 class="text-xl font-semibold text-blue-700 mb-4">Calendrier des maintenances</h2>
      <div id="maintenanceCalendar" class="rounded-lg border border-gray-200 p-4"></div>
    </div>
  </main>

  <!-- FullCalendar -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('maintenanceCalendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
          { title: 'Maintenance pompe A', start: '2025-10-20', color: '#3b82f6' },
          { title: 'Inspection compresseur', start: '2025-10-25', color: '#10b981' }
        ]
      });
      calendar.render();
    });
  </script>
</body>
</html>
