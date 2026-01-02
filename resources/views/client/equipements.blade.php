@extends('layouts.clients')

@section('title', 'Équipements')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
#newEquipFormContainer{display:none;animation:fadeIn .3s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:none}}
.card-shadow {box-shadow: 0 4px 12px rgba(0,0,0,0.05);}
.table-header {background: linear-gradient(135deg, #f0f9ff 0%, #e6f7ff 100%);}
.kpi-card {transition: transform 0.3s ease, box-shadow 0.3s ease;}
.kpi-card:hover {transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1);}
.badge {display: inline-block; padding: 0.25rem 0.75rem; border-radius: 50rem; font-size: 0.75rem; font-weight: 600;}
.status-active {background-color: #dcfce7; color: #166534;}
.status-warning {background-color: #fef3c7; color: #92400e;}
.status-inactive {background-color: #fee2e2; color: #991b1b;}
.periodicity-table th {background-color: #f8fafc; font-weight: 600;}
</style>

<div class="space-y-10 fade-in">

    <!-- ======== En-tête ======== -->
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-screwdriver-wrench text-blue-600"></i>
            Gestion des Équipements
        </h1>
        <button id="btnNewEquip" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2.5 rounded-xl shadow-lg flex items-center gap-2 transition-all">
            <i class="fa-solid fa-plus"></i> Nouvel équipement
        </button>
    </div>

    <!-- ======== 🌟 FORMULAIRE NOUVEL ÉQUIPEMENT ======== -->
    <div id="newEquipFormContainer" class="bg-white p-6 rounded-xl card-shadow border border-blue-100">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-blue-700">
            <i class="fa-solid fa-circle-plus"></i> Ajouter un nouvel équipement
        </h2>
        <form id="newEquipForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom de l'équipement</label>
                <input type="text" id="equipName" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Type</label>
                <select id="equipType" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option>Production</option>
                    <option>Mesure / Test</option>
                    <option>Informatique</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">État</label>
                <select id="equipEtat" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option>En service</option>
                    <option>En maintenance</option>
                    <option>Hors service</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Responsable</label>
                <input type="text" id="equipResp" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Nom du responsable">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Localisation</label>
                <input type="text" id="equipLoc" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex : Atelier / Laboratoire">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Dernière maintenance</label>
                <input type="date" id="equipDerniere" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Prochaine échéance</label>
                <input type="date" id="equipProchaine" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="md:col-span-2 text-right space-x-2">
                <button type="button" id="cancelNewEquip" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg transition">
                    <i class="fa-solid fa-xmark"></i> Annuler
                </button>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg transition">
                    <i class="fa-solid fa-check"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- ======== Tableau de bord (indicateurs clés) ======== -->
    <div class="grid md:grid-cols-5 gap-5">
        <div class="bg-white p-5 rounded-xl card-shadow text-center kpi-card">
            <p class="text-gray-500 text-sm mb-1">Taux de disponibilité</p>
            <p class="text-3xl font-bold text-green-600">97%</p>
        </div>
        <div class="bg-white p-5 rounded-xl card-shadow text-center kpi-card">
            <p class="text-gray-500 text-sm mb-1">Équipements étalonnés</p>
            <p class="text-3xl font-bold text-blue-600">42 / 45</p>
        </div>
        <div class="bg-white p-5 rounded-xl card-shadow text-center kpi-card">
            <p class="text-gray-500 text-sm mb-1">Maintenances à venir</p>
            <p class="text-3xl font-bold text-yellow-600">3</p>
        </div>
        <div class="bg-white p-5 rounded-xl card-shadow text-center kpi-card">
            <p class="text-gray-500 text-sm mb-1">Alertes environnementales</p>
            <p class="text-3xl font-bold text-red-600">0</p>
        </div>
        <!-- NOUVEAU KPI : Maintenance planifiée vs réalisée -->
        <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-5 rounded-xl card-shadow text-center kpi-card border border-blue-100">
            <p class="text-gray-700 text-sm mb-1 font-medium">Planifié vs Réalisé</p>
            <p class="text-3xl font-bold text-indigo-700">94%</p>
            <p class="text-xs text-gray-500 mt-1">45/48 interventions</p>
            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full" style="width: 94%"></div>
            </div>
        </div>
    </div>

    <!-- ======== Recherche / Filtrage ======== -->
    <div class="bg-gradient-to-r from-gray-50 to-white p-5 rounded-xl card-shadow border border-gray-200">
        <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-700">
            <i class="fa-solid fa-magnifying-glass"></i> Recherche et filtres
        </h2>
        <form class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" placeholder="Nom ou Référence" class="p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <select class="p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Type d'équipement</option>
                <option>Production</option>
                <option>Mesure / Test</option>
                <option>Informatique</option>
            </select>
            <select class="p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">État</option>
                <option>En service</option>
                <option>En maintenance</option>
                <option>Hors service</option>
            </select>
            <button class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2.5 rounded-lg transition">
                <i class="fa-solid fa-search mr-2"></i>Rechercher
            </button>
        </form>
    </div>

    <!-- ======== NOUVEAU : Tableau de Périodicité / Planning ======== -->
    <div class="bg-white rounded-xl card-shadow overflow-hidden border border-gray-200">
        <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-blue-50 to-indigo-50">
            <h2 class="text-xl font-semibold flex items-center gap-2 text-gray-800">
                <i class="fa-solid fa-calendar-days text-indigo-600"></i> Planning et Cycles de Maintenance
            </h2>
            <div class="flex gap-2">
                <button class="text-sm bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1.5 rounded-lg flex items-center gap-1 transition">
                    <i class="fa-solid fa-download"></i> Export
                </button>
                <button class="text-sm bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-3 py-1.5 rounded-lg flex items-center gap-1 transition">
                    <i class="fa-solid fa-filter"></i> Filtrer
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="periodicity-table border-b">
                    <tr class="text-gray-700 uppercase text-sm">
                        <th class="p-4 text-left">Équipement</th>
                        <th class="p-4 text-left">Type de Maintenance</th>
                        <th class="p-4 text-left">Fréquence</th>
                        <th class="p-4 text-left">Dernière</th>
                        <th class="p-4 text-left">Prochaine</th>
                        <th class="p-4 text-left">Statut</th>
                        <th class="p-4 text-left">Responsable</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 font-medium">Balance électronique</td>
                        <td class="p-4">Étalonnage périodique</td>
                        <td class="p-4">6 mois</td>
                        <td class="p-4">10/08/2025</td>
                        <td class="p-4 font-semibold text-blue-700">10/02/2026</td>
                        <td class="p-4"><span class="badge status-active">Planifié</span></td>
                        <td class="p-4">M. Diallo</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 font-medium">Tour CN 5000</td>
                        <td class="p-4">Maintenance préventive</td>
                        <td class="p-4">3 mois</td>
                        <td class="p-4">01/09/2025</td>
                        <td class="p-4 font-semibold text-orange-600">01/12/2025</td>
                        <td class="p-4"><span class="badge status-warning">En attente</span></td>
                        <td class="p-4">A. Benali</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 font-medium">Four de traitement</td>
                        <td class="p-4">Vérification sécurité</td>
                        <td class="p-4">12 mois</td>
                        <td class="p-4">15/03/2025</td>
                        <td class="p-4 font-semibold text-green-700">15/03/2026</td>
                        <td class="p-4"><span class="badge status-active">En cours</span></td>
                        <td class="p-4">S. Martin</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 font-medium">Microscope électronique</td>
                        <td class="p-4">Nettoyage approfondi</td>
                        <td class="p-4">1 mois</td>
                        <td class="p-4">25/10/2025</td>
                        <td class="p-4 font-semibold text-red-600">25/11/2025</td>
                        <td class="p-4"><span class="badge status-inactive">En retard</span></td>
                        <td class="p-4">L. Dubois</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="p-4 bg-gray-50 text-sm text-gray-600 flex justify-between items-center">
            <div>
                <i class="fa-solid fa-circle-info text-blue-500 mr-1"></i>
                <span>4 cycles de maintenance actifs • 1 intervention en retard</span>
            </div>
            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                Voir le planning complet <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- ======== Liste des Équipements ======== -->
    <div class="bg-white rounded-xl card-shadow overflow-hidden border border-gray-200">
        <div class="flex items-center justify-between p-5 border-b table-header">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-table text-blue-600"></i> Liste des équipements
            </h2>
            <span class="text-sm text-gray-500">Suivi complet des états et échéances</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-blue-50 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="p-4 text-left">Nom</th>
                        <th class="p-4 text-left">Type</th>
                        <th class="p-4 text-left">État</th>
                        <th class="p-4 text-left">Dernière Maintenance</th>
                        <th class="p-4 text-left">Prochaine Échéance</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 font-medium">Balance électronique</td>
                        <td class="p-4">Mesure</td>
                        <td class="p-4"><span class="badge status-active">En service</span></td>
                        <td class="p-4">10/08/2025</td>
                        <td class="p-4 font-semibold text-blue-700">10/02/2026</td>
                        <td class="p-4 text-center space-x-2">
                            <button class="text-blue-600 hover:text-blue-800 p-1.5 rounded hover:bg-blue-50 transition">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="text-yellow-500 hover:text-yellow-700 p-1.5 rounded hover:bg-yellow-50 transition">
                                <i class="fa-solid fa-wrench"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 p-1.5 rounded hover:bg-red-50 transition">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4 font-medium">Tour CN 5000</td>
                        <td class="p-4">Production</td>
                        <td class="p-4"><span class="badge status-warning">En maintenance</span></td>
                        <td class="p-4">01/09/2025</td>
                        <td class="p-4 font-semibold text-orange-600">01/12/2025</td>
                        <td class="p-4 text-center space-x-2">
                            <button class="text-blue-600 hover:text-blue-800 p-1.5 rounded hover:bg-blue-50 transition">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="text-green-600 hover:text-green-800 p-1.5 rounded hover:bg-green-50 transition">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 p-1.5 rounded hover:bg-red-50 transition">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ======== Gestion de l'Étalonnage ======== -->
    <div class="bg-gradient-to-r from-gray-50 to-white p-6 rounded-xl card-shadow border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-scale-balanced text-blue-600"></i> Gestion de l'étalonnage
        </h2>
        <ul class="list-disc pl-6 text-gray-700 space-y-2 mb-4">
            <li>Certificats d'étalonnage conservés avec traçabilité complète.</li>
            <li>Planification automatique des étalonnages à venir avec rappels à J-15.</li>
            <li>Alertes en cas de dérive, retards ou non-conformité détectée.</li>
            <li>Archivage automatique des certificats expirés.</li>
        </ul>
        <div class="flex gap-3">
            <a href="#" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2.5 rounded-lg transition">
                <i class="fa-solid fa-download mr-2"></i> Télécharger le plan d'étalonnage
            </a>
            <a href="#" class="inline-flex items-center bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-4 py-2.5 rounded-lg transition">
                <i class="fa-solid fa-calendar-plus mr-2"></i> Programmer un étalonnage
            </a>
        </div>
    </div>

    <!-- ======== Historique des Maintenances ======== -->
    <div class="bg-white p-6 rounded-xl card-shadow border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-clock-rotate-left text-gray-700"></i> Historique des maintenances
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-blue-50 text-gray-700 uppercase text-sm border-b">
                    <tr>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-left">Équipement</th>
                        <th class="p-3 text-left">Type d'intervention</th>
                        <th class="p-3 text-left">Technicien</th>
                        <th class="p-3 text-left">Observations</th>
                        <th class="p-3 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">10/08/2025</td>
                        <td class="p-3 font-medium">Balance électronique</td>
                        <td class="p-3">Étalonnage périodique</td>
                        <td class="p-3">M. Diallo</td>
                        <td class="p-3">Calibration OK - dérive 0.01%</td>
                        <td class="p-3"><span class="badge status-active">Réalisé</span></td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">01/09/2025</td>
                        <td class="p-3 font-medium">Tour CN 5000</td>
                        <td class="p-3">Maintenance corrective</td>
                        <td class="p-3">A. Benali</td>
                        <td class="p-3">Remplacement capteur de vitesse</td>
                        <td class="p-3"><span class="badge status-active">Réalisé</span></td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">15/10/2025</td>
                        <td class="p-3 font-medium">Four de traitement</td>
                        <td class="p-3">Maintenance préventive</td>
                        <td class="p-3">S. Martin</td>
                        <td class="p-3">Nettoyage et vérification thermocouples</td>
                        <td class="p-3"><span class="badge status-active">Réalisé</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ======== Suivi des Conditions Environnementales ======== -->
    <div class="bg-gradient-to-r from-gray-50 to-white p-6 rounded-xl card-shadow border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-temperature-half text-red-600"></i> Suivi des conditions environnementales
        </h2>
        <p class="text-gray-700 mb-4">Surveillance et enregistrement des paramètres critiques : température, humidité, propreté, bruit.</p>

        <div class="grid md:grid-cols-4 gap-5">
            <div class="bg-white p-5 rounded-lg card-shadow text-center kpi-card">
                <p class="text-gray-500 text-sm">Température</p>
                <p class="text-2xl font-bold text-blue-600">22.4°C</p>
                <p class="text-xs text-gray-400 mt-1">Norme : 20–25°C</p>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-1.5 rounded-full" style="width: 85%"></div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg card-shadow text-center kpi-card">
                <p class="text-gray-500 text-sm">Humidité</p>
                <p class="text-2xl font-bold text-green-600">45%</p>
                <p class="text-xs text-gray-400 mt-1">Norme : 30–60%</p>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-1.5 rounded-full" style="width: 65%"></div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg card-shadow text-center kpi-card">
                <p class="text-gray-500 text-sm">Propreté</p>
                <p class="text-2xl font-bold text-yellow-600">OK</p>
                <p class="text-xs text-gray-400 mt-1">ISO Classe 7</p>
                <div class="mt-2">
                    <span class="inline-block w-3 h-3 bg-green-500 rounded-full"></span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg card-shadow text-center kpi-card">
                <p class="text-gray-500 text-sm">Niveau sonore</p>
                <p class="text-2xl font-bold text-gray-700">62 dB</p>
                <p class="text-xs text-gray-400 mt-1">Norme : ≤ 70 dB</p>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div class="bg-gradient-to-r from-gray-500 to-gray-600 h-1.5 rounded-full" style="width: 88%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======== Fiche Détail Équipement ======== -->
    <div class="bg-white p-6 rounded-xl card-shadow border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-circle-info text-blue-600"></i> Détail de l'équipement : Balance électronique
        </h2>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-3">
                <p><strong class="text-gray-700">Référence :</strong> BAL-EL-2024</p>
                <p><strong class="text-gray-700">Type :</strong> Instrument de mesure</p>
                <p><strong class="text-gray-700">Localisation :</strong> Laboratoire Métrologie</p>
                <p><strong class="text-gray-700">Fabricant :</strong> Mettler Toledo</p>
                <p><strong class="text-gray-700">Date d'acquisition :</strong> 15/03/2022</p>
            </div>
            <div class="space-y-3">
                <p><strong class="text-gray-700">Statut :</strong> <span class="badge status-active ml-2">En service</span></p>
                <p><strong class="text-gray-700">Dernier étalonnage :</strong> 10/08/2025</p>
                <p><strong class="text-gray-700">Prochain étalonnage :</strong> 10/02/2026</p>
                <p><strong class="text-gray-700">Responsable :</strong> M. Diallo</p>
                <p><strong class="text-gray-700">Certificat :</strong> <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline ml-2">Télécharger <i class="fa-solid fa-arrow-down ml-1"></i></a></p>
            </div>
        </div>

        <div class="border-t pt-5">
            <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                <i class="fa-solid fa-screwdriver-wrench text-gray-600"></i> Dernières interventions
            </h3>
            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                <li><span class="font-medium">10/08/2025</span> — Étalonnage périodique, résultat conforme (dérive inférieure à 0.02%).</li>
                <li><span class="font-medium">22/02/2025</span> — Maintenance préventive : nettoyage, recalibrage capteur.</li>
                <li><span class="font-medium">15/11/2024</span> — Maintenance corrective : remplacement cellule de charge.</li>
            </ul>
        </div>

        <div class="mt-5 border-t pt-5">
            <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                <i class="fa-solid fa-file-lines text-blue-600"></i> Documents associés
            </h3>
            <div class="flex flex-wrap gap-3">
                <a href="#" class="inline-flex items-center bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-lg border border-gray-300 transition">
                    <i class="fa-solid fa-file-pdf text-red-500 mr-2"></i> Fiche de vie équipement
                </a>
                <a href="#" class="inline-flex items-center bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-lg border border-gray-300 transition">
                    <i class="fa-solid fa-file-word text-blue-500 mr-2"></i> Procédure d'étalonnage
                </a>
                <a href="#" class="inline-flex items-center bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-lg border border-gray-300 transition">
                    <i class="fa-solid fa-file-excel text-green-500 mr-2"></i> Rapport de maintenance
                </a>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

// Initialisation des sélecteurs de date
if (document.getElementById('equipDerniere')) {
    flatpickr("#equipDerniere", {
        dateFormat: "Y-m-d",
        locale: "fr"
    });
}
if (document.getElementById('equipProchaine')) {
    flatpickr("#equipProchaine", {
        dateFormat: "Y-m-d",
        locale: "fr"
    });
}

// Ajout dynamique d'un nouvel équipement dans la liste
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
    
    let badgeClass = "badge status-inactive";
    if (etat === 'En service') badgeClass = "badge status-active";
    if (etat === 'En maintenance') badgeClass = "badge status-warning";
    
    tr.innerHTML = `
        <td class="p-4 font-medium">${name}</td>
        <td class="p-4">${type}</td>
        <td class="p-4"><span class="${badgeClass}">${etat}</span></td>
        <td class="p-4">${derniere}</td>
        <td class="p-4 font-semibold ${prochaine !== "—" ? 'text-blue-700' : ''}">${prochaine}</td>
        <td class="p-4 text-center space-x-2">
            <button class="text-blue-600 hover:text-blue-800 p-1.5 rounded hover:bg-blue-50 transition">
                <i class="fa-solid fa-eye"></i>
            </button>
            <button class="text-yellow-500 hover:text-yellow-700 p-1.5 rounded hover:bg-yellow-50 transition">
                <i class="fa-solid fa-wrench"></i>
            </button>
            <button class="text-red-600 hover:text-red-800 p-1.5 rounded hover:bg-red-50 transition">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(tr);

    // Mise à jour du KPI de planification
    const planifieVsRealise = document.querySelector('.kpi-card:last-child .text-3xl');
    if (planifieVsRealise) {
        const currentValue = parseInt(planifieVsRealise.textContent);
        if (!isNaN(currentValue)) {
            planifieVsRealise.textContent = `${Math.min(100, currentValue + 2)}%`;
        }
    }

    alert("✅ Nouvel équipement ajouté avec succès");
    e.target.reset();
    formEquip.style.display='none';
    
    // Scroll vers le nouvel équipement ajouté
    tr.scrollIntoView({behavior: 'smooth', block: 'center'});
});

// Animation pour les cartes KPI au chargement
document.addEventListener('DOMContentLoaded', () => {
    const kpiCards = document.querySelectorAll('.kpi-card');
    kpiCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(10px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection