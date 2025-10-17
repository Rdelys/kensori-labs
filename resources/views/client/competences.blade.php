@extends('layouts.clients')

@section('title', 'Compétences')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-10 fade-in">

    <!-- ======== En-tête ======== -->
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-user-graduate text-blue-600"></i>
            Gestion des Compétences
        </h1>
        <button onclick="toggleModal('addEmployeeModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Ajouter un employé
        </button>
    </div>

    <!-- ======== Indicateurs Clés ======== -->
    <div class="grid md:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Taux global de compétence</p>
            <p class="text-3xl font-bold text-green-600">92%</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Formations à venir</p>
            <p class="text-3xl font-bold text-blue-600">5</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Écarts détectés</p>
            <p class="text-3xl font-bold text-red-600">3</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Taux d’efficacité des formations</p>
            <p class="text-3xl font-bold text-yellow-600">88%</p>
        </div>
    </div>

    <!-- ======== Graphiques ======== -->
    <div class="grid md:grid-cols-2 gap-5">
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-chart-pie text-blue-600"></i> Répartition des niveaux de compétence
            </h2>
            <canvas id="competenceChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-chart-line text-blue-600"></i> Évolution de l’efficacité des formations
            </h2>
            <canvas id="formationChart"></canvas>
        </div>
    </div>

    <!-- ======== Liste du Personnel ======== -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b bg-gray-50">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-users text-blue-600"></i> Liste du personnel
            </h2>
            <button onclick="toggleModal('addSkillModal')" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajouter une compétence
            </button>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-blue-50 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Poste</th>
                    <th class="p-3 text-left">Niveau</th>
                    <th class="p-3 text-left">Dernière formation</th>
                    <th class="p-3 text-left">Prochaine formation</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">Julie Martin</td>
                    <td class="p-3">Technicienne Qualité</td>
                    <td class="p-3"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Avancé</span></td>
                    <td class="p-3">Audit Interne (08/2025)</td>
                    <td class="p-3">Communication (12/2025)</td>
                    <td class="p-3 text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                        <button class="text-green-600 hover:text-green-800"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ======== Plan de Formation ======== -->
    <div class="bg-white p-6 rounded-xl shadow">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-chalkboard-user text-blue-600"></i> Plan de formation
            </h2>
            <button onclick="toggleModal('addTrainingModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                <i class="fa-solid fa-plus"></i> Ajouter une formation
            </button>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-blue-50 border-b text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-2 text-left">Intitulé</th>
                    <th class="p-2 text-left">Employé</th>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Statut</th>
                    <th class="p-2 text-left">Évaluation</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">Formation Audit Interne</td>
                    <td class="p-2">Julie Martin</td>
                    <td class="p-2">08/2025</td>
                    <td class="p-2"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Réalisée</span></td>
                    <td class="p-2">Excellente (95%)</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- ======== Modales ======== -->
<!-- Modal Employé -->
<div id="addEmployeeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl w-1/2">
        <h3 class="text-xl font-semibold mb-4 flex items-center gap-2"><i class="fa-solid fa-user-plus text-blue-600"></i> Ajouter un employé</h3>
        <form class="space-y-3">
            <input type="text" placeholder="Nom complet" class="w-full p-2 border rounded">
            <input type="text" placeholder="Poste" class="w-full p-2 border rounded">
            <input type="date" class="w-full p-2 border rounded">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Enregistrer</button>
            <button type="button" onclick="toggleModal('addEmployeeModal')" class="ml-3 text-gray-600 hover:text-gray-800">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal Compétence -->
<div id="addSkillModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl w-1/2">
        <h3 class="text-xl font-semibold mb-4 flex items-center gap-2"><i class="fa-solid fa-plus-circle text-blue-600"></i> Ajouter une compétence</h3>
        <form class="space-y-3">
            <input type="text" placeholder="Nom de l'employé" class="w-full p-2 border rounded">
            <input type="text" placeholder="Compétence" class="w-full p-2 border rounded">
            <select class="w-full p-2 border rounded">
                <option>Niveau</option>
                <option>Débutant</option>
                <option>Intermédiaire</option>
                <option>Avancé</option>
                <option>Expert</option>
            </select>
            <textarea placeholder="Commentaires" class="w-full p-2 border rounded"></textarea>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Enregistrer</button>
            <button type="button" onclick="toggleModal('addSkillModal')" class="ml-3 text-gray-600 hover:text-gray-800">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal Formation -->
<div id="addTrainingModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl w-1/2">
        <h3 class="text-xl font-semibold mb-4 flex items-center gap-2"><i class="fa-solid fa-chalkboard-user text-blue-600"></i> Ajouter une formation</h3>
        <form class="space-y-3">
            <input type="text" placeholder="Intitulé de la formation" class="w-full p-2 border rounded">
            <input type="text" placeholder="Employé concerné" class="w-full p-2 border rounded">
            <input type="date" class="w-full p-2 border rounded">
            <select class="w-full p-2 border rounded">
                <option>Statut</option>
                <option>Planifiée</option>
                <option>Réalisée</option>
                <option>Annulée</option>
            </select>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Enregistrer</button>
            <button type="button" onclick="toggleModal('addTrainingModal')" class="ml-3 text-gray-600 hover:text-gray-800">Annuler</button>
        </form>
    </div>
</div>

<script>
    // ======== Gestion des modales ========
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    // ======== Graphique Répartition des compétences ========
    const ctx1 = document.getElementById('competenceChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Débutant', 'Intermédiaire', 'Avancé', 'Expert'],
            datasets: [{
                data: [5, 8, 12, 4],
                backgroundColor: ['#f87171', '#facc15', '#34d399', '#3b82f6']
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // ======== Graphique efficacité formations ========
    const ctx2 = document.getElementById('formationChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Efficacité moyenne (%)',
                data: [70, 75, 80, 85, 90, 88],
                borderWidth: 3,
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                y: { min: 0, max: 100 }
            }
        }
    });
</script>

@endsection
