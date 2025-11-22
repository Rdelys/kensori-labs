@extends('layouts.clients')

@section('title', 'Revue de Direction')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
.shadow-premium { box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
.fade-in { animation: fadeIn 0.4s ease-out both; }
@keyframes fadeIn { from {opacity:0; transform:translateY(6px);} to {opacity:1; transform:none;} }
</style>

<div class="space-y-10 p-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen fade-in">

    <!-- EN-TÊTE -->
    <div class="bg-white rounded-3xl border shadow-premium p-8 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-50 to-transparent opacity-50"></div>
        <div class="relative z-10">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2 flex items-center justify-center gap-3 tracking-tight">
                <i class="fa-solid fa-handshake text-green-600"></i>
                Revue de Direction
            </h1>
            <div class="mt-3">
              <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-xs font-semibold shadow-sm">Session Annuelle {{ date('Y') }}</span>
            </div>
        </div>
    </div>

    <!-- INDICATEURS SYNTHÉTIQUES -->
    <div class="grid md:grid-cols-4 gap-5 text-center">
        <div class="bg-white rounded-2xl shadow-premium p-5 border hover:shadow-lg transition">
            <i class="fa-solid fa-bullseye text-2xl text-green-600 mb-2"></i>
            <p class="font-semibold text-gray-700">Taux d'atteinte</p>
            <p class="text-3xl font-bold text-green-700">84%</p>
        </div>
        <div class="bg-white rounded-2xl shadow-premium p-5 border hover:shadow-lg transition">
            <i class="fa-solid fa-face-smile text-2xl text-green-600 mb-2"></i>
            <p class="font-semibold text-gray-700">Satisfaction client</p>
            <p class="text-3xl font-bold text-green-700">4.3 / 5</p>
        </div>
        <div class="bg-white rounded-2xl shadow-premium p-5 border hover:shadow-lg transition">
            <i class="fa-solid fa-triangle-exclamation text-2xl text-yellow-500 mb-2"></i>
            <p class="font-semibold text-gray-700">Non-conformités</p>
            <p class="text-3xl font-bold text-yellow-600">7</p>
        </div>
        <div class="bg-white rounded-2xl shadow-premium p-5 border hover:shadow-lg transition">
            <i class="fa-solid fa-shield-halved text-2xl text-green-600 mb-2"></i>
            <p class="font-semibold text-gray-700">Conformité ISO</p>
            <p class="text-3xl font-bold text-green-700">96%</p>
        </div>
    </div>

    <!-- PLANIFICATION -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-calendar-days text-green-600"></i> Planification des Revues
        </h3>
        <table class="min-w-full text-sm text-gray-700 text-center">
            <thead class="bg-gray-100 text-gray-600 uppercase">
                <tr>
                    <th class="py-3 px-4 text-left">Date prévue</th>
                    <th class="py-3 px-4">Ordre du jour</th>
                    <th class="py-3 px-4">Statut</th>
                    <th class="py-3 px-4">Responsable</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-green-50">
                    <td class="py-3 px-4 text-left font-medium">10/11/2025</td>
                    <td class="py-3 px-4">Évaluation de la performance du SMQ</td>
                    <td class="py-3 px-4"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Prévu</span></td>
                    <td class="py-3 px-4">Directeur Qualité</td>
                </tr>
                <tr class="hover:bg-green-50">
                    <td class="py-3 px-4 text-left font-medium">12/05/2025</td>
                    <td class="py-3 px-4">Analyse des non-conformités et actions</td>
                    <td class="py-3 px-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Réalisé</span></td>
                    <td class="py-3 px-4">Responsable Processus</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ORDRE DU JOUR -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-list-check text-green-600"></i> Ordre du jour type
        </h3>
        <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm">
            <li>Suivi des décisions de la revue précédente</li>
            <li>Résultats des audits internes et externes</li>
            <li>Analyse des non-conformités et actions</li>
            <li>Performance des processus et satisfaction client</li>
            <li>Évaluation des ressources et des prestataires</li>
            <li>Décisions et opportunités d'amélioration</li>
        </ul>
    </div>

    <!-- GRAPHIQUE -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-green-600"></i> Synthèse des décisions
        </h3>
        <div class="flex justify-center">
            <canvas id="revueChart" style="max-width:400px;max-height:400px;"></canvas>
        </div>
    </div>

    <!-- ACTIONS -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-list-ol text-green-600"></i> Décisions et actions issues
        </h3>
        <table class="min-w-full text-sm text-gray-700 text-center mb-6">
            <thead class="bg-gray-100 text-gray-600 uppercase">
                <tr>
                    <th class="py-3 px-4 text-left">Action</th>
                    <th class="py-3 px-4">Responsable</th>
                    <th class="py-3 px-4">Échéance</th>
                    <th class="py-3 px-4">Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-green-50">
                    <td class="py-3 px-4 text-left">Mettre à jour le plan de formation 2026</td>
                    <td class="py-3 px-4">RH Qualité</td>
                    <td class="py-3 px-4">15/01/2026</td>
                    <td class="py-3 px-4"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">En cours</span></td>
                </tr>
                <tr class="hover:bg-green-50">
                    <td class="py-3 px-4 text-left">Renforcer la communication interne</td>
                    <td class="py-3 px-4">Responsable Communication</td>
                    <td class="py-3 px-4">20/12/2025</td>
                    <td class="py-3 px-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Validé</span></td>
                </tr>
            </tbody>
        </table>

        <!-- FORMULAIRE AJOUT -->
        <div class="mt-6 border-t pt-4">
            <h4 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-plus text-green-600"></i> Ajouter une action (simulation)
            </h4>
            <form id="actionForm" class="grid md:grid-cols-4 gap-3 text-sm">
                <input id="actionName" type="text" placeholder="Intitulé de l’action" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400 col-span-2">
                <input id="actionResp" type="text" placeholder="Responsable" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                <input id="actionDate" type="date" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                <button id="addAction" type="button" class="bg-green-600 hover:bg-green-700 text-white px-4 rounded-lg shadow">
                    <i class="fa-solid fa-check"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- VALIDATION FINALE -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-file-signature text-green-600"></i> Validation et approbation QMS
        </h3>
        <form id="validationForm" class="space-y-4">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nom du valideur</label>
                    <input id="validatorName" type="text" placeholder="Directeur Qualité" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Date de validation</label>
                    <input id="validationDate" type="date" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Commentaire / décision</label>
                <textarea id="validationComment" rows="3" placeholder="Remarques ou décisions finales..." class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-400"></textarea>
            </div>
            <div class="text-right">
                <button id="btnValidate" type="button" class="bg-gradient-to-br from-green-600 to-emerald-500 text-white px-6 py-2 rounded-lg hover:from-green-700 hover:to-emerald-600 shadow">
                    <i class="fa-solid fa-save mr-1"></i> Valider la revue
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.getElementById('revueChart'), {
        type: 'doughnut',
        data: { labels: ['Actions terminées', 'En cours', 'Planifiées'], datasets: [{ data: [6, 3, 2], backgroundColor: ['#16A34A', '#FACC15', '#3B82F6'] }] },
        options: { cutout: '70%', plugins: { legend: { position: 'bottom' } }, responsive: true }
    });

    document.getElementById('addAction').addEventListener('click', () => {
        const action = document.getElementById('actionName').value.trim();
        const resp = document.getElementById('actionResp').value.trim();
        const date = document.getElementById('actionDate').value;
        if (!action || !resp || !date) return alert('Veuillez remplir tous les champs.');
        alert(`Action ajoutée : ${action} - ${resp} (${date})`);
    });

    document.getElementById('btnValidate').addEventListener('click', () => {
        const name = document.getElementById('validatorName').value.trim();
        const date = document.getElementById('validationDate').value;
        if (!name || !date) return alert('Veuillez renseigner le nom et la date de validation.');
        alert(`Revue validée par ${name} le ${date}`);
    });
});
</script>

@endsection
