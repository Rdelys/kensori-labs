@extends('layouts.clients')

@section('title', 'Revue de Direction')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

.shadow-premium {
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
}
</style>

<div class="space-y-10 p-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen fade-in">

    <!-- EN-TÊTE PREMIUM -->
    <div class="bg-white rounded-3xl border shadow-premium p-8 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-50 to-transparent opacity-50"></div>
        <div class="relative z-10">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2 flex items-center justify-center gap-3 tracking-tight">
                <i class="fa-solid fa-handshake text-green-600"></i>
                Revue de Direction – Système Qualité
            </h1>
            <p class="text-gray-600 text-sm">Pilotage stratégique du SMQ et conformité ISO 9001:2015 – §9.3</p>
            <div class="mt-3">
                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-xs font-semibold shadow-sm">Session Annuelle 2025</span>
            </div>
        </div>
    </div>

    <!-- RÉSUMÉ SYNTHÉTIQUE AJOUT -->
    <div class="grid md:grid-cols-4 gap-5 text-center">
        <div class="bg-white rounded-2xl shadow-premium p-5 border border-gray-100 hover:shadow-lg transition">
            <i class="fa-solid fa-bullseye text-2xl text-green-600 mb-2"></i>
            <p class="font-semibold text-gray-700">Taux d'atteinte</p>
            <p class="text-3xl font-bold text-green-700">84%</p>
        </div>
        <div class="bg-white rounded-2xl shadow-premium p-5 border border-gray-100 hover:shadow-lg transition">
            <i class="fa-solid fa-face-smile text-2xl text-green-600 mb-2"></i>
            <p class="font-semibold text-gray-700">Satisfaction client</p>
            <p class="text-3xl font-bold text-green-700">4.3 / 5</p>
        </div>
        <div class="bg-white rounded-2xl shadow-premium p-5 border border-gray-100 hover:shadow-lg transition">
            <i class="fa-solid fa-triangle-exclamation text-2xl text-yellow-500 mb-2"></i>
            <p class="font-semibold text-gray-700">Non-conformités</p>
            <p class="text-3xl font-bold text-yellow-600">7</p>
        </div>
        <div class="bg-white rounded-2xl shadow-premium p-5 border border-gray-100 hover:shadow-lg transition">
            <i class="fa-solid fa-shield-halved text-2xl text-green-600 mb-2"></i>
            <p class="font-semibold text-gray-700">Conformité ISO</p>
            <p class="text-3xl font-bold text-green-700">96%</p>
        </div>
    </div>

    <!-- ==== TON CODE ORIGINAL INTACT CI-DESSOUS ==== -->

    <!-- HEADER -->
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center justify-center gap-2">
            <i class="fa-solid fa-handshake text-green-600"></i>
            Revue de Direction – Système Qualité
        </h1>
        <p class="text-gray-500">Suivi stratégique du SMQ et décisions managériales selon ISO 9001 : 2015 §9.3</p>
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
            <i class="fa-solid fa-list-check text-green-600"></i> Ordre du jour type de la revue
        </h3>
        <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm">
            <li>Statut des actions issues des revues précédentes</li>
            <li>Résultats des audits internes et externes</li>
            <li>Analyse des non-conformités et actions correctives</li>
            <li>Performance des processus et satisfaction client</li>
            <li>Évaluation des ressources et des prestataires</li>
            <li>Opportunités d'amélioration et décisions stratégiques</li>
        </ul>
    </div>

    <!-- COLLECTE DE DONNÉES -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-database text-green-600"></i> Données collectées pour la revue
        </h3>
        <div class="grid md:grid-cols-3 gap-4 text-sm text-gray-700">
            <div class="bg-gray-50 p-4 rounded-xl border">
                <i class="fa-solid fa-chart-line text-green-600 mb-1"></i>
                <p class="font-semibold">Performance des KPIs</p>
                <p class="text-gray-500">84 % d’atteinte des objectifs trimestriels</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border">
                <i class="fa-solid fa-users text-green-600 mb-1"></i>
                <p class="font-semibold">Satisfaction client</p>
                <p class="text-gray-500">Indice moyen : 4.3/5</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border">
                <i class="fa-solid fa-triangle-exclamation text-green-600 mb-1"></i>
                <p class="font-semibold">Non-conformités recensées</p>
                <p class="text-gray-500">6 cas mineurs – 1 majeur</p>
            </div>
        </div>
    </div>

    <!-- GRAPHIQUE -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-green-600"></i> Synthèse des décisions de revue
        </h3>
        <div class="flex justify-center">
            <canvas id="revueChart" style="max-width:400px;max-height:400px;"></canvas>
        </div>
    </div>

    <!-- ACTIONS ET DÉCISIONS -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-list-ol text-green-600"></i> Décisions et actions issues de la revue
        </h3>
        <table class="min-w-full text-sm text-gray-700 text-center">
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

        <!-- FORMULAIRE -->
        <div class="mt-6 border-t pt-4">
            <h4 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-plus text-green-600"></i> Ajouter une action (simulation)
            </h4>
            <form class="grid md:grid-cols-4 gap-3 text-sm">
                <input type="text" placeholder="Intitulé de l’action" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400 col-span-2">
                <input type="text" placeholder="Responsable" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                <input type="date" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 rounded-lg shadow">
                    <i class="fa-solid fa-check"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- PROCÈS-VERBAL -->
    <div class="bg-white rounded-2xl shadow border p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-file-signature text-green-600"></i> Procès-verbal de revue (simulation)
        </h3>
        <textarea rows="4" placeholder="Résumé des points clés et décisions prises..." class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-400"></textarea>
        <div class="text-right mt-3">
            <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 shadow">
                <i class="fa-solid fa-file-pdf mr-1"></i> Générer le PV
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.getElementById('revueChart'), {
        type: 'doughnut',
        data: {
            labels: ['Actions terminées', 'En cours', 'Planifiées'],
            datasets: [{
                data: [6, 3, 2],
                backgroundColor: ['#16A34A', '#FACC15', '#3B82F6']
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } },
            responsive: true
        }
    });
});
</script>

@endsection
