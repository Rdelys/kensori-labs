@extends('layouts.clients')

@section('title', 'Audits internes')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-10 fade-in">

  <!-- ENTÊTE -->
  <div class="flex items-center justify-between border-b pb-4">
    <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
      <i class="fa-solid fa-clipboard-check text-blue-600"></i>
      Audits internes
    </h1>
    <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow">
      <i class="fa-solid fa-plus mr-2"></i>Nouvel audit
    </button>
  </div>

  <!-- INDICATEURS -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Audits planifiés</p>
      <h3 class="text-3xl font-bold text-blue-600">8</h3>
    </div>
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Audits réalisés</p>
      <h3 class="text-3xl font-bold text-green-600">5</h3>
    </div>
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Non-conformités</p>
      <h3 class="text-3xl font-bold text-red-600">3</h3>
    </div>
    <div class="bg-white shadow rounded-2xl p-4 text-center">
      <p class="text-gray-500 text-sm">Taux d’achèvement</p>
      <h3 class="text-3xl font-bold text-purple-600">62%</h3>
    </div>
  </div>

  <!-- PLANNING DES AUDITS -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-calendar-days text-blue-500"></i>
      Planning des audits
    </h2>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-100 text-gray-600 uppercase">
        <tr>
          <th class="py-3 px-3 text-left">Date</th>
          <th class="py-3 px-3 text-left">Processus</th>
          <th class="py-3 px-3 text-left">Auditeur</th>
          <th class="py-3 px-3 text-left">Statut</th>
          <th class="py-3 px-3 text-left">Constats</th>
          <th class="py-3 px-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y text-gray-700">
        <tr>
          <td class="py-2 px-3">05/10/2025</td>
          <td class="py-2 px-3">Production</td>
          <td class="py-2 px-3">A. Razafy</td>
          <td class="py-2 px-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Planifié</span></td>
          <td class="py-2 px-3">N/A</td>
          <td class="py-2 px-3 text-right">
            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
          </td>
        </tr>
        <tr>
          <td class="py-2 px-3">12/10/2025</td>
          <td class="py-2 px-3">Achats</td>
          <td class="py-2 px-3">M. Ando</td>
          <td class="py-2 px-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Clôturé</span></td>
          <td class="py-2 px-3">2 NC mineures</td>
          <td class="py-2 px-3 text-right">
            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
          </td>
        </tr>
        <tr>
          <td class="py-2 px-3">20/10/2025</td>
          <td class="py-2 px-3">RH</td>
          <td class="py-2 px-3">T. Hanitra</td>
          <td class="py-2 px-3"><span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">En retard</span></td>
          <td class="py-2 px-3">A planifier</td>
          <td class="py-2 px-3 text-right">
            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- CHECK-LIST -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-list-check text-blue-500"></i>
      Check-list d’audit
    </h2>
    <div class="space-y-3">
      @foreach ([
        'Le processus est-il documenté et appliqué ?',
        'Les enregistrements sont-ils disponibles et complets ?',
        'Les actions issues du dernier audit ont-elles été clôturées ?',
        'Le personnel connaît-il ses responsabilités ?',
        'Les indicateurs du processus sont-ils suivis et analysés ?'
      ] as $item)
      <div class="flex items-center justify-between border-b pb-2">
        <span>{{ $item }}</span>
        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
      </div>
      @endforeach
      <button class="mt-4 bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700">
        <i class="fa-solid fa-save mr-2"></i>Enregistrer la check-list
      </button>
    </div>
  </div>

  <!-- SAISIE MOBILE -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-mobile-screen-button text-blue-500"></i>
      Saisie mobile (photos, audio, notes)
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm text-gray-600 mb-1">Photo (preuve terrain)</label>
        <input type="file" accept="image/*" class="w-full border rounded-lg p-2 text-sm">
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Note vocale</label>
        <input type="file" accept="audio/*" class="w-full border rounded-lg p-2 text-sm">
      </div>
    </div>
    <div class="mt-4">
      <label class="block text-sm text-gray-600 mb-1">Observation</label>
      <textarea class="w-full border rounded-lg p-2 text-sm" rows="3" placeholder="Ajoutez vos remarques..."></textarea>
    </div>
    <button class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
      <i class="fa-solid fa-upload mr-2"></i>Soumettre
    </button>
  </div>

  <!-- RAPPORTS AUTOMATIQUES -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-file-lines text-blue-500"></i>
      Rapports automatiques
    </h2>
    <p class="text-gray-600 text-sm mb-4">
      Génération automatique de rapports d’audit incluant les constats, preuves, non-conformités et recommandations.  
      Export possible en <strong>PDF</strong> ou <strong>Excel</strong>.
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

  <!-- GRAPHIQUES -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-chart-pie text-blue-500"></i>
      Synthèse des audits
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="text-center">
        <canvas id="auditStatusChart" width="300" height="300"></canvas>
        <p class="text-sm text-gray-600 mt-2">Répartition des audits par statut</p>
      </div>
      <div class="text-center">
        <canvas id="ncProcessChart" width="300" height="300"></canvas>
        <p class="text-sm text-gray-600 mt-2">Non-conformités par processus</p>
      </div>
    </div>
  </div>
</div>

<!-- MODAL NOUVEL AUDIT -->
<div id="auditModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-lg p-6 relative">
    <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-plus text-blue-500"></i>
      Créer un nouvel audit
    </h3>
    <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
      <i class="fa-solid fa-xmark text-lg"></i>
    </button>

    <form class="space-y-4">
      <div>
        <label class="block text-sm text-gray-600 mb-1">Date d’audit</label>
        <input type="date" class="w-full border rounded-lg p-2 text-sm">
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Processus concerné</label>
        <input type="text" placeholder="Ex : Production" class="w-full border rounded-lg p-2 text-sm">
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Auditeur</label>
        <input type="text" placeholder="Nom de l’auditeur" class="w-full border rounded-lg p-2 text-sm">
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Statut</label>
        <select class="w-full border rounded-lg p-2 text-sm">
          <option>Planifié</option>
          <option>En cours</option>
          <option>Clôturé</option>
        </select>
      </div>
      <div>
        <label class="block text-sm text-gray-600 mb-1">Commentaires / Constats</label>
        <textarea rows="3" class="w-full border rounded-lg p-2 text-sm" placeholder="Observations..."></textarea>
      </div>
      <div class="flex justify-end gap-3 pt-3">
        <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Modal
  function openModal() { document.getElementById('auditModal').classList.remove('hidden'); }
  function closeModal() { document.getElementById('auditModal').classList.add('hidden'); }

  // Charts
  new Chart(document.getElementById('auditStatusChart'), {
    type: 'doughnut',
    data: {
      labels: ['Planifiés', 'Clôturés', 'En retard'],
      datasets: [{
        data: [3, 5, 1],
        backgroundColor: ['#FACC15', '#22C55E', '#EF4444']
      }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
  });

  new Chart(document.getElementById('ncProcessChart'), {
    type: 'bar',
    data: {
      labels: ['Production', 'Achats', 'RH'],
      datasets: [{
        label: 'Non-conformités',
        data: [2, 1, 0],
        backgroundColor: '#3B82F6'
      }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
  });
</script>
@endsection
