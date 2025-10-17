@extends('layouts.clients')

@section('title', 'Matrice RACI')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-10 p-6 bg-gray-50 min-h-screen fade-in">

    <!-- HEADER -->
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center justify-center gap-2">
            <i class="fa-solid fa-sitemap text-green-600"></i>
            Matrice RACI – Système Qualité
        </h1>
        <p class="text-gray-500">Responsabilités, autorités et diffusion automatique selon le QMS</p>
    </div>

    <!-- MATRICE RACI -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">
        <div class="px-6 py-4 border-b bg-gradient-to-r from-green-600 to-green-400 text-white font-semibold flex justify-between items-center">
            <span><i class="fa-solid fa-table-list mr-2"></i> Matrice des rôles et responsabilités</span>
            <button class="text-white bg-green-700 hover:bg-green-800 px-4 py-1 rounded-full text-sm shadow">
                <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Diffusion auto
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700 text-center">
                <thead class="bg-gray-100 uppercase text-gray-600">
                    <tr>
                        <th class="py-3 px-4 text-left">Processus / Activité</th>
                        <th class="py-3 px-4">Directeur Qualité</th>
                        <th class="py-3 px-4">Responsable Processus</th>
                        <th class="py-3 px-4">Auditeur Interne</th>
                        <th class="py-3 px-4">Opérateur</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-green-50 transition">
                        <td class="py-3 px-4 font-medium text-left">Gestion des non-conformités</td>
                        <td class="py-3 px-4 text-green-600 font-bold">A</td>
                        <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                        <td class="py-3 px-4 text-orange-500 font-bold">C</td>
                        <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                    </tr>
                    <tr class="hover:bg-green-50 transition">
                        <td class="py-3 px-4 font-medium text-left">Audit interne qualité</td>
                        <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                        <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                        <td class="py-3 px-4 text-green-600 font-bold">A</td>
                        <td class="py-3 px-4 text-orange-500 font-bold">C</td>
                    </tr>
                    <tr class="hover:bg-green-50 transition">
                        <td class="py-3 px-4 font-medium text-left">Plan de formation</td>
                        <td class="py-3 px-4 text-green-600 font-bold">A</td>
                        <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                        <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                        <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                    </tr>
                    <tr class="hover:bg-green-50 transition">
                        <td class="py-3 px-4 font-medium text-left">Revue de direction</td>
                        <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                        <td class="py-3 px-4 text-green-600 font-bold">A</td>
                        <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                        <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- EXPORTATION -->
        <div class="flex justify-end gap-3 px-6 py-3 border-t bg-gray-50">
            <button class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-600 shadow">
                <i class="fa-solid fa-file-pdf mr-1"></i> Exporter en PDF
            </button>
            <button class="bg-blue-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-600 shadow">
                <i class="fa-solid fa-file-excel mr-1"></i> Exporter en Excel
            </button>
        </div>
    </div>

    <!-- LÉGENDE RACI -->
    <div class="bg-white rounded-xl p-4 shadow border text-sm text-gray-600">
        <h3 class="font-semibold mb-2"><i class="fa-solid fa-circle-info text-green-600 mr-2"></i> Légende RACI</h3>
        <ul class="grid grid-cols-2 md:grid-cols-4 gap-2">
            <li><span class="font-bold text-blue-600">R</span> : Responsable – Exécute la tâche</li>
            <li><span class="font-bold text-green-600">A</span> : Approuve – Valide le résultat</li>
            <li><span class="font-bold text-orange-500">C</span> : Consulté – Donne un avis</li>
            <li><span class="font-bold text-gray-500">I</span> : Informé – Tient informé</li>
        </ul>
    </div>

    <!-- FORMULAIRE AJOUT RÔLE -->
    <div class="bg-white rounded-2xl p-6 shadow border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-green-600"></i> Gestion des rôles et responsabilités
        </h3>
        <form class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Processus / Activité</label>
                <input type="text" placeholder="Ex: Suivi des indicateurs" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Rôle concerné</label>
                <select class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                    <option>Directeur Qualité</option>
                    <option>Responsable Processus</option>
                    <option>Auditeur Interne</option>
                    <option>Opérateur</option>
                </select>
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Attribution (R, A, C, I)</label>
                <select class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                    <option>R - Responsable</option>
                    <option>A - Approuve</option>
                    <option>C - Consulté</option>
                    <option>I - Informé</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                    <i class="fa-solid fa-plus mr-2"></i> Ajouter
                </button>
            </div>
        </form>
    </div>

    <!-- DIFFUSION AUTOMATIQUE -->
    <div class="bg-white rounded-2xl p-6 shadow border text-gray-700">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-cloud-arrow-up text-green-600"></i> Diffusion automatique des rôles
        </h3>
        <p class="text-sm mb-3">Cette fonction simule la notification automatique des mises à jour de la matrice RACI vers les utilisateurs concernés.</p>

        <div class="flex items-center gap-3">
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
                <i class="fa-solid fa-paper-plane mr-1"></i> Lancer la diffusion
            </button>
            <span class="text-sm text-gray-500">Dernière diffusion : <b>12/10/2025 à 14:32</b></span>
        </div>
    </div>

    <!-- GRAPHIQUE RACI -->
    <div class="bg-white rounded-2xl p-6 shadow border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-green-600"></i> Répartition des rôles dans la matrice
        </h3>
        <div class="flex justify-center">
            <canvas id="raciChart" width="150" height="150"></canvas>
        </div>
    </div>

    <!-- FICHES DE POSTE QUALITÉ -->
    <div class="bg-white rounded-2xl p-6 shadow border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-id-card-clip text-green-600"></i> Fiches de poste qualité liées
        </h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            <a href="#" class="group block border border-gray-200 hover:border-green-500 rounded-xl p-4 transition shadow-sm hover:shadow-md">
                <i class="fa-solid fa-user-tie text-green-600 text-2xl mb-2"></i>
                <h4 class="font-semibold">Directeur Qualité</h4>
                <p class="text-gray-500 text-sm">Supervision du SMQ, approbation finale et gestion stratégique qualité.</p>
            </a>
            <a href="#" class="group block border border-gray-200 hover:border-green-500 rounded-xl p-4 transition shadow-sm hover:shadow-md">
                <i class="fa-solid fa-gears text-green-600 text-2xl mb-2"></i>
                <h4 class="font-semibold">Responsable Processus</h4>
                <p class="text-gray-500 text-sm">Assure la performance et la conformité des processus opérationnels.</p>
            </a>
            <a href="#" class="group block border border-gray-200 hover:border-green-500 rounded-xl p-4 transition shadow-sm hover:shadow-md">
                <i class="fa-solid fa-user-check text-green-600 text-2xl mb-2"></i>
                <h4 class="font-semibold">Auditeur Interne</h4>
                <p class="text-gray-500 text-sm">Évalue le respect des procédures et propose des actions d'amélioration.</p>
            </a>
        </div>
    </div>

    <!-- ORGANIGRAMME INTERACTIF -->
    <div class="bg-white rounded-2xl p-6 shadow border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-diagram-project text-green-600"></i> Organigramme interactif
        </h3>

        <div id="organigramme" class="flex flex-col items-center space-y-4">
            <div class="p-4 bg-green-600 text-white rounded-xl shadow-lg font-semibold">Directeur Général</div>
            <div class="flex space-x-8">
                <div class="p-4 bg-green-500 text-white rounded-lg shadow-md">Directeur Qualité</div>
                <div class="p-4 bg-green-500 text-white rounded-lg shadow-md">Responsable Processus</div>
                <div class="p-4 bg-green-500 text-white rounded-lg shadow-md">Auditeur Interne</div>
            </div>
            <div class="flex space-x-6">
                <div class="p-3 bg-green-400 text-white rounded-lg shadow-sm text-sm">Opérateurs</div>
                <div class="p-3 bg-green-400 text-white rounded-lg shadow-sm text-sm">Assistants Qualité</div>
            </div>
        </div>

        <!-- FORMULAIRE AJOUT VISUEL -->
        <div class="mt-8 border-t pt-4">
            <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-plus text-green-600"></i> Ajouter un poste
            </h4>
            <form id="addPostForm" class="grid md:grid-cols-3 gap-4">
                <input id="newRole" type="text" placeholder="Ex : Superviseur Maintenance" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                <select id="roleLevel" class="border rounded-lg p-2 focus:ring-2 focus:ring-green-400">
                    <option value="haut">Niveau Haut (Direction)</option>
                    <option value="moyen">Niveau Moyen (Encadrement)</option>
                    <option value="bas">Niveau Bas (Opérationnel)</option>
                </select>
                <button type="button" id="addRole" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Ajouter
                </button>
            </form>
        </div>
    </div>

    <!-- VALIDATION -->
    <div class="bg-white rounded-2xl p-6 shadow border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-double text-green-600"></i> Validation et remarques qualité
        </h3>
        <textarea rows="3" placeholder="Commentaires du Directeur Qualité..." class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-400"></textarea>
        <div class="text-right mt-3">
            <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 shadow">
                <i class="fa-solid fa-save mr-1"></i> Valider la matrice
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Graphique réduit
    const ctx = document.getElementById('raciChart');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Responsables (R)', 'Approuve (A)', 'Consulté (C)', 'Informé (I)'],
            datasets: [{
                data: [10, 6, 4, 8],
                backgroundColor: ['#3B82F6', '#16A34A', '#F97316', '#9CA3AF']
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Système statique d’ajout dans l’organigramme
    document.getElementById('addRole').addEventListener('click', () => {
        const role = document.getElementById('newRole').value.trim();
        if (!role) return alert("Veuillez entrer un nom de poste !");
        const container = document.getElementById('organigramme');
        const newDiv = document.createElement('div');
        newDiv.textContent = role;
        newDiv.className = "p-3 bg-green-400 text-white rounded-lg shadow-sm text-sm mt-2";
        container.appendChild(newDiv);
        document.getElementById('newRole').value = '';
    });
});
</script>

@endsection
