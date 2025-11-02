@extends('layouts.clients')

@section('title', 'Parties intéressées & Contexte de l’organisation')

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

    <!-- 🧭 FORMULAIRE CONTEXTE ORGANISATION -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-city text-blue-500"></i> Contexte de l’Organisation (Interne & Externe)
        </h2>

        <form class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-600 text-sm mb-1">Enjeux Internes</label>
                <textarea rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Culture, compétences, ressources, structure..."></textarea>
            </div>
            <div>
                <label class="block text-gray-600 text-sm mb-1">Enjeux Externes</label>
                <textarea rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Facteurs légaux, économiques, sociaux, technologiques..."></textarea>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Enregistrer le contexte
                </button>
            </div>
        </form>
    </section>

    <!-- FORMULAIRE PARTIES INTÉRESSÉES -->
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

    <!-- LIEN BESOINS ↔ PROCESSUS -->
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

    <!-- GRAPHIQUES -->
    <section class="grid md:grid-cols-2 gap-6">
        <div class="bg-white shadow rounded-2xl p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-chart-column text-blue-500"></i> Niveau d’influence
            </h2>
            <canvas id="influenceChart" class="w-full h-72"></canvas>
        </div>
        <div class="bg-white shadow rounded-2xl p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-blue-500"></i> Analyse PESTEL
            </h2>
            <canvas id="pestelChart" class="w-full h-72"></canvas>
        </div>
    </section>

    <!-- ANALYSE SWOT -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-diagram-project text-blue-500"></i> Analyse SWOT du SMQ
        </h2>
        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                <h3 class="font-bold text-green-700 mb-2"><i class="fa-solid fa-plus-circle"></i> Forces</h3>
                <ul class="list-disc ml-5 text-gray-600 space-y-1">
                    <li>Compétences solides du personnel</li>
                    <li>Processus bien documentés</li>
                    <li>Relations client excellentes</li>
                </ul>
            </div>
            <div class="bg-red-50 border border-red-200 p-4 rounded-lg">
                <h3 class="font-bold text-red-700 mb-2"><i class="fa-solid fa-minus-circle"></i> Faiblesses</h3>
                <ul class="list-disc ml-5 text-gray-600 space-y-1">
                    <li>Communication interne perfectible</li>
                    <li>Manque de digitalisation totale</li>
                </ul>
            </div>
            <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                <h3 class="font-bold text-blue-700 mb-2"><i class="fa-solid fa-arrow-trend-up"></i> Opportunités</h3>
                <ul class="list-disc ml-5 text-gray-600 space-y-1">
                    <li>Transformation numérique</li>
                    <li>Utilisation de l’IA pour l’analyse prédictive</li>
                </ul>
            </div>
            <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                <h3 class="font-bold text-yellow-700 mb-2"><i class="fa-solid fa-triangle-exclamation"></i> Menaces</h3>
                <ul class="list-disc ml-5 text-gray-600 space-y-1">
                    <li>Changements réglementaires</li>
                    <li>Risque de perte de compétences</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ⚙️ ORGANIGRAMME DYNAMIQUE DES PROCESSUS -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-diagram-next text-blue-500"></i> Cartographie Interactive des Processus
        </h2>
        <p class="text-gray-500 text-sm mb-3">Glissez-déposez pour visualiser et organiser vos processus.</p>

        <div id="processMap" class="relative w-full h-[500px] border border-dashed border-gray-300 rounded-lg bg-gray-50 overflow-hidden"></div>

        <div class="text-right mt-4">
            <button id="addProcess" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Ajouter un Processus
            </button>
        </div>
    </section>

</div>

{{-- CHARTS & INTERACTIONS --}}
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
        options: { scales: { y: { beginAtZero: true } } }
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
        }
    });

    // Outil d’organigramme dynamique simple
    document.addEventListener('DOMContentLoaded', () => {
        const area = document.getElementById('processMap');
        const addBtn = document.getElementById('addProcess');
        let count = 1;

        addBtn.addEventListener('click', () => {
            const node = document.createElement('div');
            node.className = 'absolute bg-blue-100 border border-blue-400 text-blue-800 px-3 py-2 rounded-lg shadow cursor-move select-none';
            node.textContent = 'Processus ' + count++;
            node.style.top = Math.random() * 400 + 'px';
            node.style.left = Math.random() * 600 + 'px';
            area.appendChild(node);

            let offsetX, offsetY;
            node.addEventListener('mousedown', (e) => {
                offsetX = e.offsetX;
                offsetY = e.offsetY;
                function moveHandler(ev) {
                    node.style.left = ev.pageX - area.offsetLeft - offsetX + 'px';
                    node.style.top = ev.pageY - area.offsetTop - offsetY + 'px';
                }
                function upHandler() {
                    document.removeEventListener('mousemove', moveHandler);
                    document.removeEventListener('mouseup', upHandler);
                }
                document.addEventListener('mousemove', moveHandler);
                document.addEventListener('mouseup', upHandler);
            });
        });
    });
</script>
@endsection
