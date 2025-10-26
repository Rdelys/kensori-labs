@extends('layouts.clients')

@section('title', 'Parties intéressées')

@section('content')
<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="space-y-10 fade-in">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between border-b pb-4">
        <div>
            <h1 class="text-3xl font-semibold text-gray-800">
                <i class="fa-solid fa-users text-blue-600 mr-2"></i>
                Parties intéressées & Contexte de l’organisation
            </h1>
            <p class="text-gray-500 mt-1">Module conforme à la clause 4 de la norme ISO 9001:2015</p>
        </div>
        <button class="mt-3 md:mt-0 px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus mr-2"></i> Ajouter une partie intéressée
        </button>
    </div>

    <!-- FORMULAIRE -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-user text-blue-500"></i> Formulaire d’Enregistrement des Parties Intéressées
        </h2>
        <form class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-600 text-sm mb-1">Nom / Organisation</label>
                <input type="text" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Client ABC">
            </div>
            <div>
                <label class="block text-gray-600 text-sm mb-1">Catégorie</label>
                <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option>Client</option>
                    <option>Fournisseur</option>
                    <option>Collaborateur</option>
                    <option>Autorité</option>
                    <option>Partenaire</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-600 text-sm mb-1">Besoins et Attentes</label>
                <textarea rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Décrire les attentes, exigences et contraintes..."></textarea>
            </div>
            <div>
                <label class="block text-gray-600 text-sm mb-1">Influence sur le SMQ</label>
                <input type="range" min="1" max="5" value="3" class="w-full accent-blue-500">
            </div>
            <div>
                <label class="block text-gray-600 text-sm mb-1">Responsable</label>
                <input type="text" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Nom du responsable">
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Enregistrer
                </button>
            </div>
        </form>
    </section>

    <!-- BASE CENTRALISÉE -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-database text-blue-500"></i> Base Centralisée des Parties Intéressées
        </h2>
        <table class="w-full text-sm text-left text-gray-700 border rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Besoins / Attentes</th>
                    <th class="px-4 py-2">Influence</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">Client A</td>
                    <td class="px-4 py-2">Client</td>
                    <td class="px-4 py-2">Qualité, rapidité, support technique</td>
                    <td class="px-4 py-2">Élevée</td>
                    <td class="px-4 py-2 text-center">
                        <button class="text-blue-600 hover:underline text-sm">
                            <i class="fa-solid fa-pen mr-1"></i> Modifier
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- 🔗 LIEN BESOINS ↔ PROCESSUS -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-5 flex items-center gap-2">
            <i class="fa-solid fa-link text-blue-500"></i> Lien Besoins ↔ Processus
        </h2>
        <p class="text-gray-500 text-sm mb-3">Association entre les attentes des parties intéressées, les processus impactés et les risques associés.</p>
        <table class="w-full text-sm text-left text-gray-700 border rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2">Partie</th>
                    <th class="px-4 py-2">Attentes</th>
                    <th class="px-4 py-2">Processus Impactés</th>
                    <th class="px-4 py-2">Risques Associés</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 font-semibold">Client A</td>
                    <td class="px-4 py-2">Livraison rapide, conformité</td>
                    <td class="px-4 py-2">Production, Contrôle Qualité</td>
                    <td class="px-4 py-2 text-red-600">Retard livraison / non-conformité</td>
                </tr>
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 font-semibold">Fournisseur B</td>
                    <td class="px-4 py-2">Communication fluide</td>
                    <td class="px-4 py-2">Achats, Logistique</td>
                    <td class="px-4 py-2 text-yellow-600">Rupture d’approvisionnement</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- GRAPHIQUES STATIQUES -->
    <section class="grid md:grid-cols-2 gap-6">
        <div class="bg-white shadow rounded-2xl p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-chart-column text-blue-500"></i> Niveau d’influence des parties intéressées
            </h2>
            <canvas id="influenceChart" class="w-full h-72"></canvas>
        </div>

        <div class="bg-white shadow rounded-2xl p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-blue-500"></i> Analyse PESTEL (facteurs externes)
            </h2>
            <canvas id="pestelChart" class="w-full h-72"></canvas>
        </div>
    </section>

    <!-- ⚙️ ANALYSE D’INFLUENCE AUTOMATISÉE -->
    <section class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-2xl p-6 shadow">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-brain text-blue-600"></i> Analyse d’Influence Automatisée
        </h2>
        <p class="text-gray-600 text-sm mb-4">Recommandations générées automatiquement selon les données d’influence et d’interaction.</p>

        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white border border-green-100 shadow-sm rounded-xl p-4">
                <h3 class="font-semibold text-green-700"><i class="fa-solid fa-thumbs-up mr-1"></i> Client A</h3>
                <p class="text-gray-500 text-sm mt-1">Acteur clé — impliquer dans les décisions stratégiques.</p>
                <span class="inline-block mt-3 text-xs bg-green-600 text-white px-3 py-1 rounded-full">Réunions mensuelles</span>
            </div>
            <div class="bg-white border border-yellow-100 shadow-sm rounded-xl p-4">
                <h3 class="font-semibold text-yellow-700"><i class="fa-solid fa-exclamation-triangle mr-1"></i> Fournisseur B</h3>
                <p class="text-gray-500 text-sm mt-1">Influence moyenne — surveiller la performance et la communication.</p>
                <span class="inline-block mt-3 text-xs bg-yellow-500 text-white px-3 py-1 rounded-full">Audit Q1 prévu</span>
            </div>
            <div class="bg-white border border-blue-100 shadow-sm rounded-xl p-4">
                <h3 class="font-semibold text-blue-700"><i class="fa-solid fa-user-tie mr-1"></i> Autorité Réglementaire</h3>
                <p class="text-gray-500 text-sm mt-1">Influence forte — maintenir une veille réglementaire active.</p>
                <span class="inline-block mt-3 text-xs bg-blue-600 text-white px-3 py-1 rounded-full">Reporting trimestriel</span>
            </div>
        </div>
    </section>

    <!-- SUIVI COMMUNICATION -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-comments text-blue-500"></i> Suivi des Communications
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 border">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Partie</th>
                        <th class="px-4 py-2">Canal</th>
                        <th class="px-4 py-2">Objet</th>
                        <th class="px-4 py-2">Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">10/10/2025</td>
                        <td class="px-4 py-2">Fournisseur B</td>
                        <td class="px-4 py-2">Réunion</td>
                        <td class="px-4 py-2">Révision contrat qualité</td>
                        <td class="px-4 py-2">M. Andry</td>
                    </tr>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">18/10/2025</td>
                        <td class="px-4 py-2">Client A</td>
                        <td class="px-4 py-2">Email</td>
                        <td class="px-4 py-2">Satisfaction trimestrielle</td>
                        <td class="px-4 py-2">Mme Lova</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- DOMAINE D’APPLICATION -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-globe text-blue-500"></i> Domaine d’Application du SMQ
        </h2>
        <p class="text-gray-600 leading-relaxed">
            Le système de management de la qualité s’applique à l’ensemble des processus de développement, 
            de déploiement et de maintenance des solutions numériques QMS. Il couvre tous les services 
            et sites concernés, sans exclusion conformément à la clause 4.3.
        </p>
    </section>

    <!-- CARTOGRAPHIE STATIQUE DES PROCESSUS -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-diagram-project text-blue-500"></i> Cartographie des Processus
        </h2>

        <div class="flex flex-col items-center space-y-4">
            <!-- Niveau stratégique -->
            <div class="flex items-center justify-center space-x-4">
                <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-bullseye mr-2"></i> Management Stratégique
                </div>
            </div>

            <!-- Flèche -->
            <i class="fa-solid fa-arrow-down text-gray-400"></i>

            <!-- Niveau opérationnel -->
            <div class="flex flex-wrap justify-center gap-4">
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-gears mr-2"></i> Processus Réalisation
                </div>
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-box-open mr-2"></i> Production / Services
                </div>
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-user-check mr-2"></i> Satisfaction Client
                </div>
            </div>

            <!-- Flèche -->
            <i class="fa-solid fa-arrow-down text-gray-400"></i>

            <!-- Niveau support -->
            <div class="flex flex-wrap justify-center gap-4">
                <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-people-group mr-2"></i> Ressources Humaines
                </div>
                <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-file-lines mr-2"></i> Documentation
                </div>
                <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-comments mr-2"></i> Communication
                </div>
            </div>

            <!-- Flèche -->
            <i class="fa-solid fa-arrow-down text-gray-400"></i>

            <!-- Évaluation / Amélioration -->
            <div class="flex items-center justify-center space-x-4">
                <div class="bg-purple-100 text-purple-700 px-4 py-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-arrows-rotate mr-2"></i> Évaluation & Amélioration Continue
                </div>
            </div>
        </div>
    </section>
</div>

{{-- CHARTS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('influenceChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Clients', 'Fournisseurs', 'Employés', 'Autorités', 'Partenaires'],
            datasets: [{
                label: 'Niveau d’influence',
                data: [5, 3, 4, 2, 3],
                backgroundColor: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe']
            }]
        },
        options: { scales: { y: { beginAtZero: true, title: { display: true, text: 'Influence (1-5)' } } } }
    });

    const ctx2 = document.getElementById('pestelChart').getContext('2d');
    new Chart(ctx2, {
        type: 'radar',
        data: {
            labels: ['Politique', 'Économique', 'Socioculturel', 'Technologique', 'Environnemental', 'Légal'],
            datasets: [{
                label: 'Impact sur le SMQ',
                data: [3, 4, 2, 5, 3, 4],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.3)'
            }]
        },
        options: { scales: { r: { beginAtZero: true, suggestedMax: 5 } } }
    });
</script>
@endsection
