@extends('layouts.clients')

@section('title', 'Risques & Opportunités')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        padding: 1.5rem;
        transition: 0.3s;
    }
    .card:hover { transform: translateY(-4px); }
    .grid { display: grid; gap: 2rem; }
    .matrix {
        border-collapse: collapse; width: 100%;
    }
    .matrix th, .matrix td {
        border: 1px solid #ddd;
        text-align: center;
        padding: 0.75rem;
    }
    .matrix th { background-color: #f4f4f4; font-weight: 600; }
    .critical-high { background: #ef4444; color: white; }
    .critical-medium { background: #f59e0b; color: white; }
    .critical-low { background: #10b981; color: white; }
    .badge {
        padding: 0.4rem 0.8rem;
        border-radius: 0.5rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: white;
    }
    .badge-risk { background-color: #ef4444; }
    .badge-opportunity { background-color: #10b981; }
</style>

<div class="space-y-10 fade-in">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        <i class="fa-solid fa-triangle-exclamation text-red-500"></i> Risques & Opportunités
    </h2>

    {{-- SECTION 1 - Graphiques Risques et Opportunités --}}
    <div class="grid md:grid-cols-2">
        <div class="card">
            <h3 class="text-xl font-semibold mb-3 text-gray-700">Répartition des Risques</h3>
            <canvas id="risquesChart"></canvas>
        </div>
        <div class="card">
            <h3 class="text-xl font-semibold mb-3 text-gray-700">Répartition des Opportunités</h3>
            <canvas id="opportunitesChart"></canvas>
        </div>
    </div>

    {{-- SECTION 2 - Matrice de criticité --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">
            <i class="fa-solid fa-table-cells-large text-indigo-500"></i> Matrice de Criticité (Probabilité × Gravité)
        </h3>
        <table class="matrix text-sm">
            <thead>
                <tr>
                    <th>Probabilité \ Gravité</th>
                    <th>Faible</th>
                    <th>Moyenne</th>
                    <th>Élevée</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Faible</th>
                    <td class="critical-low">Faible</td>
                    <td class="critical-low">Faible</td>
                    <td class="critical-medium">Modérée</td>
                </tr>
                <tr>
                    <th>Moyenne</th>
                    <td class="critical-low">Faible</td>
                    <td class="critical-medium">Modérée</td>
                    <td class="critical-high">Élevée</td>
                </tr>
                <tr>
                    <th>Élevée</th>
                    <td class="critical-medium">Modérée</td>
                    <td class="critical-high">Élevée</td>
                    <td class="critical-high">Critique</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- SECTION 3 - Suivi des actions --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">
            <i class="fa-solid fa-list-check text-blue-500"></i> Suivi des Actions
        </h3>
        <table class="table-auto w-full text-sm border-collapse">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="p-2">Type</th>
                    <th class="p-2">Description</th>
                    <th class="p-2">Responsable</th>
                    <th class="p-2">Échéance</th>
                    <th class="p-2">Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2"><span class="badge badge-risk">Risque</span></td>
                    <td class="p-2">Défaillance du serveur principal</td>
                    <td class="p-2">IT Manager</td>
                    <td class="p-2">20/10/2025</td>
                    <td class="p-2 text-yellow-500 font-semibold">En cours</td>
                </tr>
                <tr>
                    <td class="p-2"><span class="badge badge-opportunity">Opportunité</span></td>
                    <td class="p-2">Implémentation d’un système de sauvegarde cloud</td>
                    <td class="p-2">Chef Qualité</td>
                    <td class="p-2">05/11/2025</td>
                    <td class="p-2 text-green-500 font-semibold">Planifiée</td>
                </tr>
                <tr>
                    <td class="p-2"><span class="badge badge-risk">Risque</span></td>
                    <td class="p-2">Manque de compétences sur l’audit interne</td>
                    <td class="p-2">RH</td>
                    <td class="p-2">15/12/2025</td>
                    <td class="p-2 text-red-500 font-semibold">À traiter</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- SECTION 4 - Analyse prédictive (Tendances) --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">
            <i class="fa-solid fa-chart-line text-emerald-600"></i> Analyse Prédictive des Risques
        </h3>
        <canvas id="predictiveChart"></canvas>
        <p class="text-sm text-gray-600 mt-3">
            <i class="fa-solid fa-lightbulb text-yellow-500"></i> Cette projection prédit une <strong>hausse de 20%</strong> des risques critiques au 1er trimestre 2026 si aucune action corrective n’est menée.
        </p>
    </div>

    {{-- SECTION 5 - Alertes intelligentes --}}
    <div class="card bg-red-50 border-l-4 border-red-400 text-red-800">
        <h3 class="font-semibold mb-2"><i class="fa-solid fa-bell"></i> Alertes Intelligentes</h3>
        <ul class="list-disc ml-5 text-sm space-y-1">
            <li>⚠️ Risque critique "Serveur principal" approche de la date limite : 3 jours restants.</li>
            <li>⚠️ Opportunité "Sauvegarde cloud" doit être validée avant implémentation finale.</li>
            <li>🔔 Analyse prédictive : tendance à la hausse sur les risques informatiques.</li>
        </ul>
    </div>

</div>

<script>
    // Graphique des risques
    new Chart(document.getElementById('risquesChart'), {
        type: 'doughnut',
        data: {
            labels: ['Faible', 'Modéré', 'Élevé', 'Critique'],
            datasets: [{
                data: [8, 5, 3, 2],
                backgroundColor: ['#10b981', '#facc15', '#f97316', '#ef4444']
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Graphique des opportunités
    new Chart(document.getElementById('opportunitesChart'), {
        type: 'bar',
        data: {
            labels: ['Innovation', 'Formation', 'Automatisation', 'Satisfaction client'],
            datasets: [{
                label: 'Niveau de Potentiel',
                data: [80, 60, 90, 70],
                backgroundColor: '#10b981',
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });

    // Graphique prédictif (tendance temporelle)
    new Chart(document.getElementById('predictiveChart'), {
        type: 'line',
        data: {
            labels: ['Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Risque global (%)',
                data: [40, 42, 45, 47, 49, 51, 53, 54, 55, 57, 59, 60],
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239,68,68,0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Niveau de risque (%)' } },
                x: { title: { display: true, text: 'Période' } }
            }
        }
    });
</script>
@endsection
