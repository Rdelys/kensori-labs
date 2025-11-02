@extends('layouts.clients')

@section('title', 'Équipements')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
#newEquipFormContainer{display:none;animation:fadeIn .3s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:none}}
</style>

<div class="space-y-10 fade-in">

    <!-- ======== En-tête ======== -->
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-screwdriver-wrench text-blue-600"></i>
            Gestion des Équipements
        </h1>
        <button id="btnNewEquip" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Nouvel équipement
        </button>
    </div>

    <!-- ======== 🌟 FORMULAIRE NOUVEL ÉQUIPEMENT ======== -->
    <div id="newEquipFormContainer" class="bg-white p-6 rounded-xl shadow border border-blue-100">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-blue-700">
            <i class="fa-solid fa-circle-plus"></i> Ajouter un nouvel équipement
        </h2>
        <form id="newEquipForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom de l’équipement</label>
                <input type="text" id="equipName" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Type</label>
                <select id="equipType" class="w-full p-2 border rounded-lg" required>
                    <option>Production</option>
                    <option>Mesure / Test</option>
                    <option>Informatique</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">État</label>
                <select id="equipEtat" class="w-full p-2 border rounded-lg" required>
                    <option>En service</option>
                    <option>En maintenance</option>
                    <option>Hors service</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Responsable</label>
                <input type="text" id="equipResp" class="w-full p-2 border rounded-lg" placeholder="Nom du responsable">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Localisation</label>
                <input type="text" id="equipLoc" class="w-full p-2 border rounded-lg" placeholder="Ex : Atelier / Laboratoire">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Dernière maintenance</label>
                <input type="date" id="equipDerniere" class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Prochaine échéance</label>
                <input type="date" id="equipProchaine" class="w-full p-2 border rounded-lg">
            </div>
            <div class="md:col-span-2 text-right space-x-2">
                <button type="button" id="cancelNewEquip" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                    <i class="fa-solid fa-xmark"></i> Annuler
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    <i class="fa-solid fa-check"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- ======== Tableau de bord (indicateurs clés) ======== -->
    <div class="grid md:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Taux de disponibilité</p>
            <p class="text-3xl font-bold text-green-600">97%</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Équipements étalonnés</p>
            <p class="text-3xl font-bold text-blue-600">42 / 45</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Maintenances à venir</p>
            <p class="text-3xl font-bold text-yellow-600">3</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Alertes environnementales</p>
            <p class="text-3xl font-bold text-red-600">0</p>
        </div>
    </div>

    <!-- ======== Recherche / Filtrage ======== -->
    <div class="bg-gray-100 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-2 flex items-center gap-2 text-gray-700">
            <i class="fa-solid fa-magnifying-glass"></i> Recherche et filtres
        </h2>
        <form class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" placeholder="Nom ou Référence" class="p-2 border rounded">
            <select class="p-2 border rounded">
                <option value="">Type d’équipement</option>
                <option>Production</option>
                <option>Mesure / Test</option>
                <option>Informatique</option>
            </select>
            <select class="p-2 border rounded">
                <option value="">État</option>
                <option>En service</option>
                <option>En maintenance</option>
                <option>Hors service</option>
            </select>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Rechercher</button>
        </form>
    </div>

    <!-- ======== Liste des Équipements ======== -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b bg-gray-50">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-table text-blue-600"></i> Liste des équipements
            </h2>
            <span class="text-sm text-gray-500">Suivi complet des états et échéances</span>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-blue-50 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Type</th>
                    <th class="p-3 text-left">État</th>
                    <th class="p-3 text-left">Dernière Maintenance</th>
                    <th class="p-3 text-left">Prochaine Échéance</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">Balance électronique</td>
                    <td class="p-3">Mesure</td>
                    <td class="p-3"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">En service</span></td>
                    <td class="p-3">10/08/2025</td>
                    <td class="p-3">10/02/2026</td>
                    <td class="p-3 text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                        <button class="text-yellow-500 hover:text-yellow-700"><i class="fa-solid fa-wrench"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">Tour CN 5000</td>
                    <td class="p-3">Production</td>
                    <td class="p-3"><span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">En maintenance</span></td>
                    <td class="p-3">01/09/2025</td>
                    <td class="p-3">01/12/2025</td>
                    <td class="p-3 text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                        <button class="text-green-600 hover:text-green-800"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ======== Gestion de l’Étalonnage ======== -->
    <div class="bg-gray-50 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
            <i class="fa-solid fa-scale-balanced text-blue-600"></i> Gestion de l’étalonnage
        </h2>
        <ul class="list-disc pl-6 text-gray-700 space-y-1 mb-3">
            <li>Certificats d’étalonnage conservés avec traçabilité complète.</li>
            <li>Planification automatique des étalonnages à venir avec rappels à J-15.</li>
            <li>Alertes en cas de dérive, retards ou non-conformité détectée.</li>
            <li>Archivage automatique des certificats expirés.</li>
        </ul>
        <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            <i class="fa-solid fa-download mr-2"></i> Télécharger le plan d’étalonnage
        </a>
    </div>

    <!-- ======== Historique des Maintenances ======== -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
            <i class="fa-solid fa-clock-rotate-left text-gray-700"></i> Historique des maintenances
        </h2>
        <table class="w-full border-collapse">
            <thead class="bg-blue-50 text-gray-700 uppercase text-sm border-b">
                <tr>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Équipement</th>
                    <th class="p-2 text-left">Type d’intervention</th>
                    <th class="p-2 text-left">Technicien</th>
                    <th class="p-2 text-left">Observations</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">10/08/2025</td>
                    <td class="p-2">Balance électronique</td>
                    <td class="p-2">Étalonnage</td>
                    <td class="p-2">M. Diallo</td>
                    <td class="p-2">Calibration OK - dérive 0.01%</td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">01/09/2025</td>
                    <td class="p-2">Tour CN 5000</td>
                    <td class="p-2">Maintenance corrective</td>
                    <td class="p-2">A. Benali</td>
                    <td class="p-2">Remplacement capteur de vitesse</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ======== Suivi des Conditions Environnementales ======== -->
    <div class="bg-gray-100 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-temperature-half text-red-600"></i> Suivi des conditions environnementales
        </h2>
        <p class="text-gray-700 mb-3">Surveillance et enregistrement des paramètres critiques : température, humidité, propreté, bruit.</p>

        <div class="grid md:grid-cols-4 gap-5">
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <p class="text-gray-500 text-sm">Température</p>
                <p class="text-2xl font-bold text-blue-600">22.4°C</p>
                <p class="text-xs text-gray-400">Norme : 20–25°C</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <p class="text-gray-500 text-sm">Humidité</p>
                <p class="text-2xl font-bold text-green-600">45%</p>
                <p class="text-xs text-gray-400">Norme : 30–60%</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <p class="text-gray-500 text-sm">Propreté</p>
                <p class="text-2xl font-bold text-yellow-600">OK</p>
                <p class="text-xs text-gray-400">ISO Classe 7</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <p class="text-gray-500 text-sm">Niveau sonore</p>
                <p class="text-2xl font-bold text-gray-700">62 dB</p>
                <p class="text-xs text-gray-400">Norme : ≤ 70 dB</p>
            </div>
        </div>
    </div>

    <!-- ======== Fiche Détail Équipement ======== -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-circle-info text-blue-600"></i> Détail de l’équipement : Balance électronique
        </h2>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <p><strong>Référence :</strong> BAL-EL-2024</p>
                <p><strong>Type :</strong> Instrument de mesure</p>
                <p><strong>Localisation :</strong> Laboratoire Métrologie</p>
                <p><strong>Fabricant :</strong> Mettler Toledo</p>
                <p><strong>Date d’acquisition :</strong> 15/03/2022</p>
            </div>
            <div>
                <p><strong>Statut :</strong> <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">En service</span></p>
                <p><strong>Dernier étalonnage :</strong> 10/08/2025</p>
                <p><strong>Prochain étalonnage :</strong> 10/02/2026</p>
                <p><strong>Responsable :</strong> M. Diallo</p>
                <p><strong>Certificat :</strong> <a href="#" class="text-blue-600 underline">Télécharger</a></p>
            </div>
        </div>

        <div class="border-t pt-4">
            <h3 class="text-lg font-semibold mb-2"><i class="fa-solid fa-screwdriver-wrench text-gray-600 mr-2"></i> Dernières interventions</h3>
            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                <li>10/08/2025 — Étalonnage périodique, résultat conforme (dérive inférieure à 0.02%).</li>
                <li>22/02/2025 — Maintenance préventive : nettoyage, recalibrage capteur.</li>
                <li>15/11/2024 — Maintenance corrective : remplacement cellule de charge.</li>
            </ul>
        </div>

        <div class="mt-5 border-t pt-4">
            <h3 class="text-lg font-semibold mb-2"><i class="fa-solid fa-file-lines text-blue-600 mr-2"></i> Documents associés</h3>
            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                <li><a href="#" class="text-blue-600 hover:underline">Fiche de vie équipement</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">Procédure d’étalonnage interne</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">Rapport de maintenance corrective</a></li>
            </ul>
        </div>
    </div>

</div>

<script>
// Apparition/disparition du formulaire
const formEquip = document.getElementById('newEquipFormContainer');
document.getElementById('btnNewEquip').addEventListener('click',()=>{
    formEquip.style.display='block';
    formEquip.scrollIntoView({behavior:'smooth'});
});
document.getElementById('cancelNewEquip').addEventListener('click',()=>{
    formEquip.style.display='none';
});

// Ajout dynamique d’un nouvel équipement dans la liste
document.getElementById('newEquipForm').addEventListener('submit', e=>{
    e.preventDefault();

    const name = document.getElementById('equipName').value;
    const type = document.getElementById('equipType').value;
    const etat = document.getElementById('equipEtat').value;
    const derniere = document.getElementById('equipDerniere').value || "—";
    const prochaine = document.getElementById('equipProchaine').value || "—";

    const tbody = document.querySelector("table tbody");
    const tr = document.createElement("tr");
    tr.classList.add("border-b","hover:bg-gray-50","transition");
    tr.innerHTML = `
        <td class="p-3">${name}</td>
        <td class="p-3">${type}</td>
        <td class="p-3">
            <span class="text-xs px-2 py-1 rounded-full ${
                etat === 'En service' ? 'bg-green-100 text-green-700' :
                etat === 'En maintenance' ? 'bg-yellow-100 text-yellow-700' :
                'bg-red-100 text-red-700'
            }">${etat}</span>
        </td>
        <td class="p-3">${derniere}</td>
        <td class="p-3">${prochaine}</td>
        <td class="p-3 text-center space-x-2">
            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
            <button class="text-yellow-500 hover:text-yellow-700"><i class="fa-solid fa-wrench"></i></button>
            <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
        </td>
    `;
    tbody.appendChild(tr);

    alert("✅ Nouvel équipement ajouté (simulation conforme au QMS)");
    e.target.reset();
    formEquip.style.display='none';
});
</script>
@endsection
