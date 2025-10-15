@extends('layouts.clients')

@section('title', 'Tableau de bord QSM Intelligent')

@section('content')
<div class="space-y-8 fade-in">

  <!-- HEADER -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
    <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
    <div class="flex gap-2 mt-4 md:mt-0">
      <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
        <i class="bi bi-download"></i> Exporter PDF
      </button>
      <button class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
        <i class="bi bi-file-earmark-excel"></i> Exporter Excel
      </button>
    </div>
  </div>

  <!-- AVANCEMENT GLOBAL -->
  <div class="bg-white border border-gray-200 rounded-2xl shadow p-6">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
        <i class="bi bi-graph-up"></i> Avancement global du Système Qualité
      </h2>
      <span class="text-xl font-bold text-blue-600">78%</span>
    </div>
    <div class="w-full bg-gray-100 rounded-full h-4">
      <div class="bg-blue-600 h-4 rounded-full" style="width: 78%;"></div>
    </div>
    <div class="mt-3 text-sm">
      Statut : <span class="font-semibold text-yellow-600">En cours</span>
    </div>
  </div>

  <!-- CARTES PRINCIPALES -->
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

    <!-- Performances QMS -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition">
      <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-t-2xl">
        <i class="bi bi-bar-chart text-xl"></i>
        <h3 class="text-lg font-semibold">Performances QMS</h3>
      </div>
      <div class="p-5 text-gray-700 text-sm">
        <canvas id="kpiChart" class="mt-3 h-36"></canvas>
      </div>
    </div>

    <!-- Équipements -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition">
      <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-t-2xl">
        <i class="bi bi-gear text-xl"></i>
        <h3 class="text-lg font-semibold">Équipements</h3>
      </div>
      <div class="p-5 text-gray-700 text-sm leading-relaxed">
        <ul class="list-disc pl-5 space-y-1">
          <li>12 équipements actifs</li>
          <li>3 calibrations à venir</li>
          <li>Dernière maintenance : 10/10/2025</li>
        </ul>
      </div>
    </div>

    <!-- Audits internes -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition">
      <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-t-2xl">
        <i class="bi bi-shield-check text-xl"></i>
        <h3 class="text-lg font-semibold">Audits internes</h3>
      </div>
      <div class="p-5 text-gray-700 text-sm">
        <div class="flex justify-between items-center mb-3">
          <span>Audits réalisés :</span><strong>8</strong>
        </div>
        <div class="flex justify-between items-center">
          <span>Audits en cours :</span><strong>2</strong>
        </div>
        <canvas id="auditChart" class="mt-4 h-36"></canvas>
      </div>
    </div>

    <!-- Satisfaction client -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition">
      <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-purple-600 to-purple-500 text-white rounded-t-2xl">
        <i class="bi bi-emoji-smile text-xl"></i>
        <h3 class="text-lg font-semibold">Satisfaction Client</h3>
      </div>
      <div class="p-5 text-gray-700 text-sm">
        Score NPS actuel : <span class="font-bold text-purple-600">84%</span>
        <canvas id="npsChart" class="mt-3 h-36"></canvas>
      </div>
    </div>

    <!-- Non-conformités -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition">
      <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-t-2xl">
        <i class="bi bi-exclamation-triangle text-xl"></i>
        <h3 class="text-lg font-semibold">Non-Conformités & CAPA</h3>
      </div>
      <div class="p-5 text-gray-700 text-sm">
        <p>Non-conformités ouvertes : <strong>12</strong></p>
        <p>Actions correctives en cours : <strong>5</strong></p>
        <canvas id="capaChart" class="mt-3 h-36"></canvas>
      </div>
    </div>

    <!-- Analyses prédictives -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition">
      <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-t-2xl">
        <i class="bi bi-cpu text-xl"></i>
        <h3 class="text-lg font-semibold">Analyses Prédictives</h3>
      </div>
      <div class="p-5 text-gray-700 text-sm leading-relaxed">
        <p>Probabilité de non-conformité "Production" : <span class="font-semibold text-indigo-600">65%</span></p>
        <p class="mt-2">Recommandation : renforcer le contrôle intermédiaire et la formation opérateurs.</p>
        <canvas id="predictChart" class="mt-3 h-36"></canvas>
      </div>
    </div>
  </div>

  <!-- TABLEAU DE BORD PERSONNALISABLE -->
  <div class="bg-white border border-gray-200 rounded-2xl shadow p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-3 flex items-center gap-2">
      <i class="bi bi-grid-3x3-gap"></i> Tableau de bord personnalisable
    </h2>
    <p class="text-gray-500 text-sm mb-4">Glissez et déposez les widgets de votre choix pour créer votre vue personnalisée.</p>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
      <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 text-center">
        <div class="text-sm text-blue-700 font-semibold">Taux de Conformité</div>
        <div class="text-2xl font-bold text-blue-800 mt-1">96%</div>
      </div>
      <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-center">
        <div class="text-sm text-green-700 font-semibold">Formations Effectuées</div>
        <div class="text-2xl font-bold text-green-800 mt-1">87%</div>
      </div>
      <div class="bg-purple-50 border border-purple-200 rounded-xl p-3 text-center">
        <div class="text-sm text-purple-700 font-semibold">Satisfaction Moyenne</div>
        <div class="text-2xl font-bold text-purple-800 mt-1">4.5/5</div>
      </div>
      <div class="bg-gray-100 hover:bg-blue-50 border border-dashed rounded-xl p-3 flex flex-col items-center justify-center text-gray-500 text-sm cursor-pointer">
        <i class="bi bi-plus-circle text-blue-600 text-xl mb-1"></i>
        Ajouter un widget
      </div>
    </div>
  </div>

</div>

<!-- CHARTS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // KPI global
  new Chart(document.getElementById('kpiChart'), {
    type: 'bar',
    data: {
      labels: ['Conformité', 'Satisfaction', 'CAPA'],
      datasets: [{ 
        data: [96, 84, 88], 
        backgroundColor: ['#2563eb', '#8b5cf6', '#dc2626'] 
      }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
  });

  // Audit
  new Chart(document.getElementById('auditChart'), {
    type: 'doughnut',
    data: {
      labels: ['Réalisés', 'En cours', 'Planifiés'],
      datasets: [{ data: [8, 2, 1], backgroundColor: ['#fb923c', '#fde68a', '#fcd34d'] }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
  });

  // NPS
  new Chart(document.getElementById('npsChart'), {
    type: 'line',
    data: {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [{ data: [75, 78, 80, 82, 84, 85], borderColor: '#8b5cf6', fill: false }]
    },
    options: { plugins: { legend: { display: false } } }
  });

  // CAPA
  new Chart(document.getElementById('capaChart'), {
    type: 'bar',
    data: {
      labels: ['Ouvertes', 'En cours', 'Clôturées'],
      datasets: [{ data: [12, 5, 15], backgroundColor: ['#dc2626', '#f97316', '#16a34a'] }]
    },
    options: { plugins: { legend: { display: false } } }
  });

  // Prédictif
  new Chart(document.getElementById('predictChart'), {
    type: 'radar',
    data: {
      labels: ['Production', 'Contrôle', 'Maintenance', 'Formation', 'Audit'],
      datasets: [{
        data: [65, 45, 30, 55, 40],
        backgroundColor: 'rgba(79,70,229,0.2)',
        borderColor: '#4f46e5'
      }]
    },
    options: { plugins: { legend: { display: false } } }
  });
</script>
@endsection
