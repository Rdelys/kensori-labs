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

    {{-- SECTION 1B - Calcul brut/net et suivi --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">
            <i class="fa-solid fa-scale-balanced text-indigo-600"></i> Calcul Brut/Net et Suivi des Risques
        </h3>
        <ul class="list-disc pl-6 text-gray-600 text-sm mb-4 space-y-1">
            <li><strong>Calcul brut/net :</strong> Évaluation avant et après actions correctives</li>
            <li><strong>Suivi actions risques :</strong> Planification, mise en œuvre et évaluation d’efficacité</li>
            <li><strong>Analyse prédictive :</strong> Évolution des risques basée sur les données historiques</li>
        </ul>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-gray-700 font-semibold mb-2"><i class="fa-solid fa-gauge text-red-500"></i> Évaluation Brut vs Net</h4>
                <canvas id="riskEvalChart"></canvas>
            </div>
            <div>
                <h4 class="text-gray-700 font-semibold mb-2"><i class="fa-solid fa-chart-bar text-green-600"></i> Efficacité des Actions</h4>
                <canvas id="efficaciteChart"></canvas>
            </div>
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

    {{-- SECTION 2B - Heatmap visuelle des risques --}}
    <div class="card bg-gradient-to-b from-gray-50 to-white">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">
            <i class="fa-solid fa-fire text-red-500"></i> Heatmap Visuelle des Risques par Domaine
        </h3>
        <p class="text-sm text-gray-600 mb-3">
            Visualisation synthétique des domaines les plus exposés selon la gravité et la probabilité de survenue.
        </p>
        <canvas id="heatmapChart" style="height: 400px;"></canvas>

        {{-- LÉGENDE STATIQUE DYNAMIQUE --}}
        <div class="grid md:grid-cols-3 gap-4 mt-6 text-sm">
            <div class="p-4 rounded-xl border border-red-200 bg-red-50 shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-server text-red-500 text-lg"></i>
                    <span class="font-semibold text-gray-700">IT & Sécurité</span>
                </div>
                <p><strong>Niveau :</strong> Critique (9/10)</p>
                <p><strong>Tendance :</strong> En hausse 🔺</p>
                <p><strong>Action :</strong> Migration cloud sécurisée d’ici Q2 2026</p>
            </div>
            <div class="p-4 rounded-xl border border-yellow-200 bg-yellow-50 shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-users text-yellow-500 text-lg"></i>
                    <span class="font-semibold text-gray-700">Ressources Humaines</span>
                </div>
                <p><strong>Niveau :</strong> Modéré (6/10)</p>
                <p><strong>Tendance :</strong> Stable ➖</p>
                <p><strong>Action :</strong> Programme de montée en compétences 2025</p>
            </div>
            <div class="p-4 rounded-xl border border-green-200 bg-green-50 shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-file-shield text-green-500 text-lg"></i>
                    <span class="font-semibold text-gray-700">Conformité</span>
                </div>
                <p><strong>Niveau :</strong> Faible (4/10)</p>
                <p><strong>Tendance :</strong> En amélioration ✅</p>
                <p><strong>Action :</strong> Audit de conformité interne trimestriel</p>
            </div>
        </div>
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

    {{-- SECTION 4 - Analyse prédictive --}}
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

    {{-- SECTION 6 - OBJECTIFS QUALITÉ (Ajout CDC) --}}
    <div class="card bg-gradient-to-b from-gray-50 to-white mt-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            <i class="fa-solid fa-bullseye text-emerald-600"></i> Objectifs Qualité
        </h2>

        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-3"><i class="fa-solid fa-lightbulb text-yellow-500"></i> Formulation SMART</h3>
            <p class="text-sm text-gray-600 mb-4">Chaque objectif doit être <strong>Spécifique, Mesurable, Atteignable, Réaliste et Temporellement défini</strong>.</p>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-600 text-sm mb-1">Objectif</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ex : Améliorer la satisfaction client de 15% d’ici fin 2025">
                </div>
                <div>
                    <label class="block text-gray-600 text-sm mb-1">Responsable</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ex : Responsable Qualité">
                </div>
                <div>
                    <label class="block text-gray-600 text-sm mb-1">Indicateur (KPI)</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ex : Taux de satisfaction client (%)">
                </div>
                <div>
                    <label class="block text-gray-600 text-sm mb-1">Échéance</label>
                    <input type="date" class="w-full border border-gray-300 rounded-lg p-2">
                </div>
            </div>
            <button class="mt-4 bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition">
                <i class="fa-solid fa-plus"></i> Ajouter Objectif
            </button>
        </div>

        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">
                <i class="fa-solid fa-link text-blue-500"></i> Liaison automatique Objectifs ↔ Actions ↔ KPI
            </h3>
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Objectif</th>
                        <th class="p-2 text-left">Action liée</th>
                        <th class="p-2 text-left">KPI associé</th>
                        <th class="p-2 text-center">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2">Augmenter la satisfaction client</td>
                        <td class="p-2">Mise en place d’enquêtes mensuelles</td>
                        <td class="p-2">Taux de satisfaction (%)</td>
                        <td class="p-2 text-center text-green-600 font-semibold">En progrès</td>
                    </tr>
                    <tr>
                        <td class="p-2">Réduire les non-conformités</td>
                        <td class="p-2">Audit interne trimestriel</td>
                        <td class="p-2">Nb de NC par mois</td>
                        <td class="p-2 text-center text-yellow-500 font-semibold">En cours</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-6">
                <canvas id="objectifsKpiChart" height="120"></canvas>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">
                <i class="fa-solid fa-clock-rotate-left text-indigo-500"></i> Historique & Revue Périodique
            </h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <canvas id="historiqueChart" height="140"></canvas>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="p-3 border-l-4 border-emerald-500 bg-emerald-50 rounded">
                        <strong>Janv 2025 :</strong> Mise en place du suivi des indicateurs.
                    </div>
                    <div class="p-3 border-l-4 border-yellow-500 bg-yellow-50 rounded">
                        <strong>Avr 2025 :</strong> Ajustement de la politique qualité suite audit.
                    </div>
                    <div class="p-3 border-l-4 border-blue-500 bg-blue-50 rounded">
                        <strong>Août 2025 :</strong> Revue de direction : 70% des objectifs atteints.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('js/risques-opportunites.js') }}"></script>

<script>
new Chart(document.getElementById('objectifsKpiChart'), {
    type: 'bar',
    data: {
        labels: ['Satisfaction Client', 'Non-Conformités', 'Performance Fournisseurs', 'Formation Employés'],
        datasets: [{
            label: 'Taux d’atteinte (%)',
            data: [85, 65, 90, 75],
            backgroundColor: ['#10b981','#f59e0b','#3b82f6','#8b5cf6']
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, max: 100 } } }
});

new Chart(document.getElementById('historiqueChart'), {
    type: 'line',
    data: {
        labels: ['Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct'],
        datasets: [{
            label: 'Progression globale des objectifs (%)',
            data: [20, 35, 45, 50, 58, 65, 70, 75, 78, 82],
            borderColor: '#10b981',
            backgroundColor: 'rgba(16,185,129,0.2)',
            tension: 0.4,
            fill: true
        }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, max: 100 } } }
});
</script>
@endsection
