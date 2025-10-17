@extends('layouts.clients')

@section('title', 'Satisfaction client')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-10 fade-in">

  <!-- ENTÊTE -->
  <div class="flex items-center justify-between border-b pb-4">
    <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
      <i class="fa-solid fa-face-smile text-yellow-500"></i>
      Satisfaction client
    </h1>
    <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow">
      <i class="fa-solid fa-plus mr-2"></i>Nouvelle enquête
    </button>
  </div>

  <!-- INDICATEURS -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Taux de satisfaction global</p>
      <h3 class="text-3xl font-bold text-green-600">87%</h3>
    </div>
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Score NPS</p>
      <h3 class="text-3xl font-bold text-blue-600">+42</h3>
    </div>
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Réclamations reçues</p>
      <h3 class="text-3xl font-bold text-red-600">6</h3>
    </div>
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Enquêtes clôturées</p>
      <h3 class="text-3xl font-bold text-purple-600">4</h3>
    </div>
  </div>

  <!-- TABLEAU DES ENQUÊTES -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-clipboard-list text-blue-500"></i>
      Historique des enquêtes de satisfaction
    </h2>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-100 text-gray-600 uppercase">
        <tr>
          <th class="py-3 px-3 text-left">Date</th>
          <th class="py-3 px-3 text-left">Campagne</th>
          <th class="py-3 px-3 text-left">Réponses</th>
          <th class="py-3 px-3 text-left">Taux satisfaction</th>
          <th class="py-3 px-3 text-left">Score NPS</th>
          <th class="py-3 px-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y text-gray-700">
        <tr>
          <td class="py-2 px-3">10/09/2025</td>
          <td class="py-2 px-3">Livraison T3</td>
          <td class="py-2 px-3">48</td>
          <td class="py-2 px-3 text-green-600 font-semibold">89%</td>
          <td class="py-2 px-3 text-blue-600">+44</td>
          <td class="py-2 px-3 text-right">
            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
          </td>
        </tr>
        <tr>
          <td class="py-2 px-3">01/08/2025</td>
          <td class="py-2 px-3">Support client</td>
          <td class="py-2 px-3">62</td>
          <td class="py-2 px-3 text-green-600 font-semibold">91%</td>
          <td class="py-2 px-3 text-blue-600">+52</td>
          <td class="py-2 px-3 text-right">
            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- GRAPHIQUES -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-6 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-chart-line text-blue-500"></i>
      Analyse des résultats
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="text-center">
        <canvas id="npsChart" width="300" height="300"></canvas>
        <p class="text-sm text-gray-600 mt-2">Évolution du NPS par campagne</p>
      </div>
      <div class="text-center">
        <canvas id="satisfactionChart" width="300" height="300"></canvas>
        <p class="text-sm text-gray-600 mt-2">Répartition des niveaux de satisfaction</p>
      </div>
    </div>
  </div>

  <!-- RÉCLAMATIONS CLIENT -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-envelope-open-text text-blue-500"></i>
      Réclamations clients
    </h2>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-100 text-gray-600 uppercase">
        <tr>
          <th class="py-3 px-3 text-left">Date</th>
          <th class="py-3 px-3 text-left">Client</th>
          <th class="py-3 px-3 text-left">Objet</th>
          <th class="py-3 px-3 text-left">Statut</th>
          <th class="py-3 px-3 text-left">Liaison CAPA</th>
        </tr>
      </thead>
      <tbody class="divide-y text-gray-700">
        <tr>
          <td class="py-2 px-3">03/10/2025</td>
          <td class="py-2 px-3">Société X</td>
          <td class="py-2 px-3">Délai de livraison</td>
          <td class="py-2 px-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En cours</span></td>
          <td class="py-2 px-3">CAPA-014</td>
        </tr>
        <tr>
          <td class="py-2 px-3">18/09/2025</td>
          <td class="py-2 px-3">Client Y</td>
          <td class="py-2 px-3">Qualité produit</td>
          <td class="py-2 px-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Clôturée</span></td>
          <td class="py-2 px-3">CAPA-011</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- RAPPORTS -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-file-lines text-blue-500"></i>
      Rapports automatiques
    </h2>
    <p class="text-gray-600 text-sm mb-4">
      Génération automatique de rapports de satisfaction avec analyses statistiques, synthèse NPS, et suggestions d’actions correctives.
    </p>
    <div class="flex gap-3">
      <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">
        <i class="fa-solid fa-file-pdf mr-2"></i>Exporter PDF
      </button>
      <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg">
        <i class="fa-solid fa-file-excel mr-2"></i>Exporter Excel
      </button>
    </div>
  </div>

</div>

<!-- MODAL ENQUÊTE -->
<div id="surveyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-lg p-6 relative">
    <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-plus text-blue-500"></i>
      Nouvelle enquête de satisfaction
    </h3>
    <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
      <i class="fa-solid fa-xmark text-lg"></i>
    </button>

    <form class="space-y-4">
      <div>
        <label class="block text-sm text-gray-600 mb-1">Titre de l’enquête</label>
        <input type="text" class="w-full border rounded-lg p-2 text-sm" placeholder="Ex : Enquête satisfaction 2025 - T4">
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Canal de diffusion</label>
        <select class="w-full border rounded-lg p-2 text-sm">
          <option>Email</option>
          <option>QR Code</option>
          <option>Portail client</option>
        </select>
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Date de lancement</label>
        <input type="date" class="w-full border rounded-lg p-2 text-sm">
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Description / Objectif</label>
        <textarea rows="3" class="w-full border rounded-lg p-2 text-sm" placeholder="Décrivez les objectifs de l’enquête..."></textarea>
      </div>
      <div class="flex justify-end gap-3 pt-3">
        <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Créer</button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() { document.getElementById('surveyModal').classList.remove('hidden'); }
  function closeModal() { document.getElementById('surveyModal').classList.add('hidden'); }

  // Graphiques Chart.js
  new Chart(document.getElementById('npsChart'), {
    type: 'line',
    data: {
      labels: ['T1', 'T2', 'T3', 'T4'],
      datasets: [{
        label: 'NPS',
        data: [36, 40, 42, 44],
        borderColor: '#3B82F6',
        fill: false,
        tension: 0.3
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });

  new Chart(document.getElementById('satisfactionChart'), {
    type: 'doughnut',
    data: {
      labels: ['Très satisfait', 'Satisfait', 'Neutre', 'Insatisfait'],
      datasets: [{
        data: [45, 35, 15, 5],
        backgroundColor: ['#16A34A', '#60A5FA', '#FBBF24', '#EF4444']
      }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
  });
</script>
@endsection
