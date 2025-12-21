@extends('layouts.clients')

@section('title', 'Matrice RACI')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

<style>
.organigramme-node {
    position: relative;
    min-width: 140px;
    cursor: move;
    transition: all 0.3s ease;
}
.organigramme-node:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.connector-line {
    position: absolute;
    background: #6B7280;
    height: 2px;
    transform-origin: left center;
}
.node-actions {
    position: absolute;
    top: 5px;
    right: 5px;
    display: flex;
    gap: 3px;
    opacity: 0;
    transition: opacity 0.2s;
}
.organigramme-node:hover .node-actions {
    opacity: 1;
}
.dragging {
    opacity: 0.7;
    z-index: 1000;
}
</style>

<div class="space-y-10 p-6 bg-gradient-to-b from-gray-50 to-white min-h-screen fade-in">

    <!-- HEADER -->
    <div class="text-center max-w-5xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-2 flex items-center justify-center gap-3">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-green-500 to-emerald-400 text-white shadow-lg">
                <i class="fa-solid fa-sitemap text-xl"></i>
            </span>
            <span>Matrice RACI & Organigramme</span>
        </h1>
    </div>

    <!-- MATRICE RACI -->
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200 max-w-7xl mx-auto">
        <div class="px-6 py-4 border-b bg-gradient-to-r from-emerald-600 to-green-500 text-white font-semibold flex justify-between items-center">
            <span class="flex items-center gap-2"><i class="fa-solid fa-table-list"></i> Matrice des rôles et responsabilités</span>
            <div class="flex items-center gap-3">
                <button id="btnAutoPush" class="text-white bg-green-700 hover:bg-green-800 px-4 py-1 rounded-full text-sm shadow transition">
                    <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Diffusion auto
                </button>
                <div class="text-xs text-white/80">Dernière diffusion : <span id="lastPush" class="font-medium ml-1">12/10/2025 14:32</span></div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="p-6">
                <table class="min-w-full text-sm text-gray-700 text-center rounded-lg overflow-hidden shadow-sm">
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
        </div>

        <!-- EXPORTATION -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-3 px-6 py-3 border-t bg-gradient-to-r from-white to-gray-50">
            <div class="text-sm text-gray-600">Les exports incluent la légende RACI et la version actuelle (statique).</div>
            <div class="flex gap-3">
                <button id="exportPdf" class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-600 shadow flex items-center gap-2">
                    <i class="fa-solid fa-file-pdf"></i> Exporter PDF
                </button>
                <button id="exportExcel" class="bg-blue-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-600 shadow flex items-center gap-2">
                    <i class="fa-solid fa-file-excel"></i> Exporter Excel
                </button>
            </div>
        </div>
    </div>

    <!-- LÉGENDE RACI -->
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white rounded-xl p-4 shadow border text-sm text-gray-600 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="font-semibold mb-2 text-gray-800 flex items-center gap-2"><i class="fa-solid fa-circle-info text-green-600"></i> Légende RACI</h3>
                <ul class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                    <li><span class="font-bold text-blue-600">R</span> : Responsable – Exécute la tâche</li>
                    <li><span class="font-bold text-green-600">A</span> : Approuve – Valide le résultat</li>
                    <li><span class="font-bold text-orange-500">C</span> : Consulté – Donne un avis</li>
                    <li><span class="font-bold text-gray-500">I</span> : Informé – Tient informé</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ORGANIGRAMME INTERACTIF MODIFIABLE -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-diagram-project text-green-600"></i> Organigramme hiérarchique interactif
            </h3>
            <div class="flex gap-2">
                <button id="btnSaveOrg" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-sm flex items-center gap-1">
                    <i class="fa-solid fa-save"></i> Sauvegarder
                </button>
                <button id="btnResetOrg" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded-lg text-sm flex items-center gap-1">
                    <i class="fa-solid fa-rotate-left"></i> Réinitialiser
                </button>
            </div>
        </div>

        <!-- CONTROLS -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg border">
            <div class="grid md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Niveau hiérarchique</label>
                    <select id="levelSelect" class="w-full border rounded-lg p-2 text-sm">
                        <option value="direction">Direction</option>
                        <option value="management">Management</option>
                        <option value="supervision">Supervision</option>
                        <option value="operation">Opérationnel</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Département</label>
                    <select id="deptSelect" class="w-full border rounded-lg p-2 text-sm">
                        <option value="qualite">Qualité</option>
                        <option value="production">Production</option>
                        <option value="logistique">Logistique</option>
                        <option value="rh">RH</option>
                        <option value="achats">Achats</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Ajouter poste</label>
                                    <input id="newPostInput" type="text" placeholder="Ex: Chef de projet" class="w-full border rounded-lg p-2 text-sm">
                </div>
                <div class="flex items-end">
                    <button id="btnAddPost" class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm flex items-center justify-center gap-1">
                        <i class="fa-solid fa-plus"></i> Ajouter poste
                    </button>
                </div>
            </div>
        </div>

        <!-- CANVAS ORGANIGRAMME -->
        <div class="relative">
            <div id="orgCanvas" class="min-h-[500px] border-2 border-dashed border-gray-300 rounded-lg p-6 bg-gradient-to-br from-gray-50 to-white overflow-auto relative">
                
                <!-- NODES EXISTANTS -->
                <div id="nodeContainer" class="relative">
                    <!-- Niveau Direction -->
                    <div class="flex justify-center mb-12" data-level="direction">
                        <div class="organigramme-node p-4 bg-gradient-to-r from-emerald-600 to-green-500 text-white rounded-xl shadow-lg font-semibold text-center cursor-move" 
                             data-id="1" data-level="direction" data-dept="qualite" style="position: absolute; left: 50%; transform: translateX(-50%); top: 20px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="1"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="1"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Directeur Général
                            <div class="text-xs mt-1 opacity-90">Direction</div>
                        </div>
                    </div>

                    <!-- Niveau Management -->
                    <div class="flex justify-around mb-12" data-level="management">
                        <div class="organigramme-node p-3 bg-gradient-to-br from-green-500 to-emerald-400 text-white rounded-lg shadow-md text-center cursor-move" 
                             data-id="2" data-level="management" data-dept="qualite" style="position: absolute; left: 25%; top: 150px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="2"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="2"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Directeur Qualité
                            <div class="text-xs mt-1 opacity-90">Management - Qualité</div>
                        </div>
                        <div class="organigramme-node p-3 bg-gradient-to-br from-blue-500 to-cyan-400 text-white rounded-lg shadow-md text-center cursor-move" 
                             data-id="3" data-level="management" data-dept="production" style="position: absolute; left: 50%; top: 150px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="3"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="3"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Directeur Production
                            <div class="text-xs mt-1 opacity-90">Management - Production</div>
                        </div>
                        <div class="organigramme-node p-3 bg-gradient-to-br from-purple-500 to-pink-400 text-white rounded-lg shadow-md text-center cursor-move" 
                             data-id="4" data-level="management" data-dept="rh" style="position: absolute; left: 75%; top: 150px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="4"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="4"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Directeur RH
                            <div class="text-xs mt-1 opacity-90">Management - RH</div>
                        </div>
                    </div>

                    <!-- Niveau Supervision -->
                    <div class="flex justify-between mb-12" data-level="supervision">
                        <div class="organigramme-node p-3 bg-gradient-to-br from-emerald-400 to-lime-400 text-white rounded-lg shadow-md text-center cursor-move" 
                             data-id="5" data-level="supervision" data-dept="qualite" style="position: absolute; left: 15%; top: 280px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="5"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="5"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Responsable Processus
                            <div class="text-xs mt-1 opacity-90">Supervision - Qualité</div>
                        </div>
                        <div class="organigramme-node p-3 bg-gradient-to-br from-amber-400 to-orange-400 text-white rounded-lg shadow-md text-center cursor-move" 
                             data-id="6" data-level="supervision" data-dept="qualite" style="position: absolute; left: 35%; top: 280px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="6"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="6"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Auditeur Interne
                            <div class="text-xs mt-1 opacity-90">Supervision - Qualité</div>
                        </div>
                        <div class="organigramme-node p-3 bg-gradient-to-br from-cyan-400 to-blue-400 text-white rounded-lg shadow-md text-center cursor-move" 
                             data-id="7" data-level="supervision" data-dept="production" style="position: absolute; left: 65%; top: 280px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="7"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="7"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Chef d'Atelier
                            <div class="text-xs mt-1 opacity-90">Supervision - Production</div>
                        </div>
                    </div>

                    <!-- Niveau Opérationnel -->
                    <div class="flex justify-around" data-level="operation">
                        <div class="organigramme-node p-2 bg-green-400 text-white rounded-lg shadow-sm text-sm text-center cursor-move" 
                             data-id="8" data-level="operation" data-dept="qualite" style="position: absolute; left: 10%; top: 400px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="8"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="8"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Opérateurs Qualité
                        </div>
                        <div class="organigramme-node p-2 bg-green-400 text-white rounded-lg shadow-sm text-sm text-center cursor-move" 
                             data-id="9" data-level="operation" data-dept="qualite" style="position: absolute; left: 30%; top: 400px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="9"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="9"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Assistants Qualité
                        </div>
                        <div class="organigramme-node p-2 bg-blue-400 text-white rounded-lg shadow-sm text-sm text-center cursor-move" 
                             data-id="10" data-level="operation" data-dept="production" style="position: absolute; left: 60%; top: 400px;">
                            <div class="node-actions">
                                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="10"><i class="fa-solid fa-pen text-xs"></i></button>
                                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="10"><i class="fa-solid fa-trash text-xs"></i></button>
                            </div>
                            Opérateurs Production
                        </div>
                    </div>
                </div>

                <!-- LIGNES DE CONNEXION -->
                <div id="connectors"></div>
            </div>

            <!-- LEGENDE -->
            <div class="mt-4 p-3 bg-gray-50 rounded-lg border text-sm">
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-gradient-to-r from-emerald-600 to-green-500 rounded"></div>
                        <span>Direction</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-gradient-to-br from-green-500 to-emerald-400 rounded"></div>
                        <span>Management</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-gradient-to-br from-emerald-400 to-lime-400 rounded"></div>
                        <span>Supervision</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-400 rounded"></div>
                        <span>Opérationnel</span>
                    </div>
                    <div class="flex items-center gap-2 ml-auto">
                        <span class="text-gray-500"><i class="fa-solid fa-arrows-up-down-left-right mr-1"></i> Glisser-déposer pour modifier</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL ÉDITION POSTE -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-5 relative">
                <h3 class="text-lg font-semibold mb-3">Modifier le poste</h3>
                <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>
                
                <form id="editForm" class="space-y-4">
                    <input type="hidden" id="editNodeId">
                    
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Intitulé du poste</label>
                        <input id="editTitle" type="text" class="w-full border rounded-lg p-2 text-sm" required>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Niveau</label>
                            <select id="editLevel" class="w-full border rounded-lg p-2 text-sm">
                                <option value="direction">Direction</option>
                                <option value="management">Management</option>
                                <option value="supervision">Supervision</option>
                                <option value="operation">Opérationnel</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Département</label>
                            <select id="editDept" class="w-full border rounded-lg p-2 text-sm">
                                <option value="qualite">Qualité</option>
                                <option value="production">Production</option>
                                <option value="logistique">Logistique</option>
                                <option value="rh">RH</option>
                                <option value="achats">Achats</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Activités principales</label>
                        <textarea id="editActivities" class="w-full border rounded-lg p-2 text-sm" rows="3" placeholder="Décrire les activités..."></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Subordination</label>
                        <select id="editParent" class="w-full border rounded-lg p-2 text-sm">
                            <option value="">Aucun (poste racine)</option>
                            <option value="1">Directeur Général</option>
                            <option value="2">Directeur Qualité</option>
                            <option value="3">Directeur Production</option>
                            <option value="4">Directeur RH</option>
                            <option value="5">Responsable Processus</option>
                            <option value="6">Auditeur Interne</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-3">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Annuler</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FORMULAIRE AJOUT RÔLE -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-green-600"></i> Gestion des rôles et responsabilités
        </h3>
        <form id="addRaciForm" class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Processus / Activité</label>
                <input id="frmProcess" type="text" placeholder="Ex: Suivi des indicateurs" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Rôle concerné</label>
                <select id="frmRole" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
                    <option>Directeur Qualité</option>
                    <option>Responsable Processus</option>
                    <option>Auditeur Interne</option>
                    <option>Opérateur</option>
                </select>
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Attribution (R, A, C, I)</label>
                <select id="frmAttrib" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
                    <option>R - Responsable</option>
                    <option>A - Approuve</option>
                    <option>C - Consulté</option>
                    <option>I - Informé</option>
                </select>
            </div>

            <div class="flex items-end justify-end">
                <button id="btnAddRaci" type="button" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow flex items-center gap-2">
                    <i class="fa-solid fa-plus mr-2"></i> Ajouter
                </button>
            </div>
        </form>
    </div>

    <!-- GRAPHIQUE RACI -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-4xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-green-600"></i> Répartition des rôles dans la matrice
        </h3>

        <div class="flex justify-center">
            <div class="w-full max-w-md" role="img" aria-label="Graphique répartition RACI">
                <canvas id="raciChart" style="width:100%; height:320px;"></canvas>
            </div>
        </div>
    </div>

    <!-- VALIDATION -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-double text-green-600"></i> Validation et remarques qualité
        </h3>
        <textarea id="validationComment" rows="3" placeholder="Commentaires du Directeur Qualité..." class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-300"></textarea>
        <div class="text-right mt-3">
            <button id="btnValidate" class="bg-gradient-to-br from-green-600 to-emerald-500 text-white px-5 py-2 rounded-lg hover:from-green-700 hover:to-emerald-600 shadow">
                <i class="fa-solid fa-save mr-1"></i> Valider la matrice
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let draggedNode = null;
    let nodeIdCounter = 11; // Commence après les nodes existants

    /* ---------- Graph Chart.js ---------- */
    const ctx = document.getElementById('raciChart').getContext('2d');
    const raciChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Responsables (R)', 'Approuve (A)', 'Consulté (C)', 'Informé (I)'],
            datasets: [{
                data: [10, 6, 4, 8],
                backgroundColor: ['#3B82F6', '#10B981', '#F97316', '#9CA3AF'],
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth:12, padding:12 } },
                tooltip: { callbacks: { label: ctx => `${ctx.label} : ${ctx.formattedValue}` } }
            }
        }
    });

    /* ---------- DRAG & DROP ---------- */
    function initializeDragAndDrop() {
        const nodes = document.querySelectorAll('.organigramme-node');
        
        nodes.forEach(node => {
            node.addEventListener('mousedown', startDrag);
            node.addEventListener('touchstart', startDragTouch);
        });
    }

    function startDrag(e) {
        e.preventDefault();
        draggedNode = this;
        draggedNode.classList.add('dragging');
        
        document.addEventListener('mousemove', onDrag);
        document.addEventListener('mouseup', stopDrag);
    }

    function startDragTouch(e) {
        e.preventDefault();
        draggedNode = this;
        draggedNode.classList.add('dragging');
        
        document.addEventListener('touchmove', onDragTouch);
        document.addEventListener('touchend', stopDrag);
    }

    function onDrag(e) {
        if (!draggedNode) return;
        
        const canvas = document.getElementById('orgCanvas');
        const rect = canvas.getBoundingClientRect();
        
        let x = e.clientX - rect.left - draggedNode.offsetWidth / 2;
        let y = e.clientY - rect.top - draggedNode.offsetHeight / 2;
        
        // Limites du canvas
        x = Math.max(0, Math.min(x, rect.width - draggedNode.offsetWidth));
        y = Math.max(0, Math.min(y, rect.height - draggedNode.offsetHeight));
        
        draggedNode.style.left = `${x}px`;
        draggedNode.style.top = `${y}px`;
        
        drawConnectors();
    }

    function onDragTouch(e) {
        if (!draggedNode || !e.touches[0]) return;
        
        const canvas = document.getElementById('orgCanvas');
        const rect = canvas.getBoundingClientRect();
        
        let x = e.touches[0].clientX - rect.left - draggedNode.offsetWidth / 2;
        let y = e.touches[0].clientY - rect.top - draggedNode.offsetHeight / 2;
        
        x = Math.max(0, Math.min(x, rect.width - draggedNode.offsetWidth));
        y = Math.max(0, Math.min(y, rect.height - draggedNode.offsetHeight));
        
        draggedNode.style.left = `${x}px`;
        draggedNode.style.top = `${y}px`;
        
        drawConnectors();
    }

    function stopDrag() {
        if (draggedNode) {
            draggedNode.classList.remove('dragging');
            draggedNode = null;
        }
        document.removeEventListener('mousemove', onDrag);
        document.removeEventListener('touchmove', onDragTouch);
        document.removeEventListener('mouseup', stopDrag);
        document.removeEventListener('touchend', stopDrag);
    }

    /* ---------- LIGNES DE CONNEXION ---------- */
    function drawConnectors() {
        const connectors = document.getElementById('connectors');
        connectors.innerHTML = '';
        
        // Relations hiérarchiques
        const connections = [
            { from: '1', to: '2' }, // DG -> DQ
            { from: '1', to: '3' }, // DG -> DP
            { from: '1', to: '4' }, // DG -> DRH
            { from: '2', to: '5' }, // DQ -> Resp Processus
            { from: '2', to: '6' }, // DQ -> Auditeur
            { from: '5', to: '8' }, // Resp Processus -> Opérateurs Qualité
            { from: '5', to: '9' }, // Resp Processus -> Assistants
            { from: '3', to: '7' }, // DP -> Chef Atelier
            { from: '7', to: '10' } // Chef Atelier -> Opérateurs Prod
        ];
        
        connections.forEach(conn => {
            const fromNode = document.querySelector(`[data-id="${conn.from}"]`);
            const toNode = document.querySelector(`[data-id="${conn.to}"]`);
            
            if (fromNode && toNode) {
                drawLine(fromNode, toNode);
            }
        });
    }

    function drawLine(fromNode, toNode) {
        const connectors = document.getElementById('connectors');
        const line = document.createElement('div');
        line.className = 'connector-line';
        
        const fromRect = fromNode.getBoundingClientRect();
        const toRect = toNode.getBoundingClientRect();
        const canvasRect = document.getElementById('orgCanvas').getBoundingClientRect();
        
        const x1 = fromRect.left - canvasRect.left + fromRect.width / 2;
        const y1 = fromRect.top - canvasRect.top + fromRect.height;
        const x2 = toRect.left - canvasRect.left + toRect.width / 2;
        const y2 = toRect.top - canvasRect.top;
        
        const length = Math.sqrt((x2 - x1) ** 2 + (y2 - y1) ** 2);
        const angle = Math.atan2(y2 - y1, x2 - x1) * 180 / Math.PI;
        
        line.style.width = `${length}px`;
        line.style.left = `${x1}px`;
        line.style.top = `${y1}px`;
        line.style.transform = `rotate(${angle}deg)`;
        
        connectors.appendChild(line);
    }

    /* ---------- AJOUT POSTE ---------- */
    document.getElementById('btnAddPost').addEventListener('click', () => {
        const title = document.getElementById('newPostInput').value.trim();
        const level = document.getElementById('levelSelect').value;
        const dept = document.getElementById('deptSelect').value;
        
        if (!title) {
            showToast('Veuillez entrer un nom de poste', 'warning');
            return;
        }
        
        const nodeId = nodeIdCounter++;
        const node = createNode(nodeId, title, level, dept);
        document.getElementById('nodeContainer').appendChild(node);
        
        // Positionner selon le niveau
        positionNode(node, level);
        
        // Réinitialiser le formulaire
        document.getElementById('newPostInput').value = '';
        
        // Réinitialiser drag & drop
        initializeDragAndDrop();
        drawConnectors();
        
        showToast(`Poste "${title}" ajouté avec succès`);
    });

    function createNode(id, title, level, dept) {
        const node = document.createElement('div');
        node.className = 'organigramme-node p-3 rounded-lg shadow-md text-center cursor-move';
        node.dataset.id = id;
        node.dataset.level = level;
        node.dataset.dept = dept;
        node.style.position = 'absolute';
        
        // Couleurs selon le niveau
        const colors = {
            direction: 'bg-gradient-to-r from-emerald-600 to-green-500 text-white',
            management: 'bg-gradient-to-br from-green-500 to-emerald-400 text-white',
            supervision: 'bg-gradient-to-br from-emerald-400 to-lime-400 text-white',
            operation: 'bg-green-400 text-white text-sm'
        };
        
        node.classList.add(...colors[level].split(' '));
        
        // Noms des niveaux et départements
        const levelNames = {
            direction: 'Direction',
            management: 'Management',
            supervision: 'Supervision',
            operation: 'Opérationnel'
        };
        
        const deptNames = {
            qualite: 'Qualité',
            production: 'Production',
            logistique: 'Logistique',
            rh: 'RH',
            achats: 'Achats'
        };
        
        node.innerHTML = `
            <div class="node-actions">
                <button class="edit-node text-white bg-black/20 p-1 rounded hover:bg-black/30" data-id="${id}">
                    <i class="fa-solid fa-pen text-xs"></i>
                </button>
                <button class="delete-node text-white bg-red-500/80 p-1 rounded hover:bg-red-600" data-id="${id}">
                    <i class="fa-solid fa-trash text-xs"></i>
                </button>
            </div>
            ${title}
            <div class="text-xs mt-1 opacity-90">${levelNames[level]} - ${deptNames[dept]}</div>
        `;
        
        // Événements pour les boutons
        node.querySelector('.edit-node').addEventListener('click', (e) => {
            e.stopPropagation();
            openEditModal(id, title, level, dept);
        });
        
        node.querySelector('.delete-node').addEventListener('click', (e) => {
            e.stopPropagation();
            if (confirm(`Supprimer le poste "${title}" ?`)) {
                node.remove();
                drawConnectors();
                showToast('Poste supprimé');
            }
        });
        
        return node;
    }

    function positionNode(node, level) {
        const canvas = document.getElementById('orgCanvas');
        const rect = canvas.getBoundingClientRect();
        
        const levelPositions = {
            direction: { y: 20, left: '50%' },
            management: { y: 150, left: '50%' },
            supervision: { y: 280, left: '50%' },
            operation: { y: 400, left: '50%' }
        };
        
        const pos = levelPositions[level] || { y: 400, left: '50%' };
        
        node.style.top = `${pos.y}px`;
        node.style.left = pos.left;
        node.style.transform = 'translateX(-50%)';
    }

    /* ---------- ÉDITION POSTE ---------- */
    function openEditModal(id, title, level, dept) {
        document.getElementById('editNodeId').value = id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editLevel').value = level;
        document.getElementById('editDept').value = dept;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const id = document.getElementById('editNodeId').value;
        const title = document.getElementById('editTitle').value;
        const level = document.getElementById('editLevel').value;
        const dept = document.getElementById('editDept').value;
        const activities = document.getElementById('editActivities').value;
        const parent = document.getElementById('editParent').value;
        
        const node = document.querySelector(`[data-id="${id}"]`);
        if (node) {
            // Mettre à jour le titre
            node.childNodes[2].textContent = title;
            
            // Mettre à jour le sous-titre
            const levelNames = {
                direction: 'Direction',
                management: 'Management',
                supervision: 'Supervision',
                operation: 'Opérationnel'
            };
            
            const deptNames = {
                qualite: 'Qualité',
                production: 'Production',
                logistique: 'Logistique',
                rh: 'RH',
                achats: 'Achats'
            };
            
            node.childNodes[4].textContent = `${levelNames[level]} - ${deptNames[dept]}`;
            
            // Mettre à jour les attributs
            node.dataset.level = level;
            node.dataset.dept = dept;
            
            // Mettre à jour les couleurs
            node.className = 'organigramme-node p-3 rounded-lg shadow-md text-center cursor-move';
            const colors = {
                direction: 'bg-gradient-to-r from-emerald-600 to-green-500 text-white',
                management: 'bg-gradient-to-br from-green-500 to-emerald-400 text-white',
                supervision: 'bg-gradient-to-br from-emerald-400 to-lime-400 text-white',
                operation: 'bg-green-400 text-white text-sm'
            };
            node.classList.add(...colors[level].split(' '));
            
            showToast(`Poste "${title}" mis à jour`);
        }
        
        closeEditModal();
    });

    /* ---------- SAUVEGARDE ---------- */
    document.getElementById('btnSaveOrg').addEventListener('click', () => {
        const nodes = [];
        document.querySelectorAll('.organigramme-node').forEach(node => {
            nodes.push({
                id: node.dataset.id,
                title: node.childNodes[2].textContent,
                level: node.dataset.level,
                dept: node.dataset.dept,
                x: parseInt(node.style.left),
                y: parseInt(node.style.top)
            });
        });
        
        // Simuler sauvegarde
        localStorage.setItem('organigramme', JSON.stringify(nodes));
        showToast('Organigramme sauvegardé localement', 'success');
    });

    document.getElementById('btnResetOrg').addEventListener('click', () => {
        if (confirm('Réinitialiser l\'organigramme ? Cela effacera les modifications.')) {
            // Recharger la page pour réinitialiser
            window.location.reload();
        }
    });

    /* ---------- FONCTIONS EXISTANTES ---------- */
    document.getElementById('btnAddRaci').addEventListener('click', () => {
        const p = document.getElementById('frmProcess').value.trim();
        const r = document.getElementById('frmRole').value;
        const a = document.getElementById('frmAttrib').value;
        if (!p) return alert('Veuillez renseigner le processus / activité.');
        showToast(`Entrée ajoutée : ${p} — (${r} : ${a}) — (statique uniquement)`);
        document.getElementById('frmProcess').value = '';
        document.getElementById('frmAttrib').selectedIndex = 0;
    });

    document.getElementById('btnValidate').addEventListener('click', () => {
        const c = document.getElementById('validationComment').value.trim();
        showToast('Matrice validée. Commentaire enregistré (statique).');
        document.getElementById('btnValidate').classList.add('opacity-80');
        setTimeout(() => document.getElementById('btnValidate').classList.remove('opacity-80'), 900);
    });

    /* ---------- EXPORT ---------- */
    document.getElementById('exportPdf').addEventListener('click', () => {
        const element = document.querySelector('.max-w-7xl') || document.body;
        const opt = {
            margin: 0.6,
            filename: 'Matrice_RACI_QMS.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
        };
        html2pdf().set(opt).from(element).save();
    });

    document.getElementById('exportExcel').addEventListener('click', () => {
        const table = document.querySelector('table');
        const wb = XLSX.utils.table_to_book(table, { sheet: "MatriceRACI" });
        XLSX.writeFile(wb, 'Matrice_RACI_QMS.xlsx');
    });

    /* ---------- TOAST ---------- */
    function showToast(message, type = 'info') {
        const container = document.getElementById('toastContainer') || (() => {
            const div = document.createElement('div');
            div.id = 'toastContainer';
            div.className = 'fixed right-6 bottom-6 flex flex-col gap-2 z-50';
            document.body.appendChild(div);
            return div;
        })();
        
        const toast = document.createElement('div');
        toast.className = `px-4 py-2 rounded shadow-lg text-sm animate-pop ${
            type === 'success' ? 'bg-green-600 text-white' :
            type === 'warning' ? 'bg-yellow-500 text-white' :
            type === 'error' ? 'bg-red-600 text-white' :
            'bg-gray-900 text-white'
        }`;
        toast.textContent = message;
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 2500);
    }

    /* ---------- INITIALISATION ---------- */
    initializeDragAndDrop();
    drawConnectors();

    // Redimensionnement des lignes au redimensionnement de la fenêtre
    window.addEventListener('resize', drawConnectors);
});
</script>

<style>
.fade-in { animation: fadeIn 0.32s ease-out both; }
@keyframes fadeIn { from {opacity:0; transform: translateY(6px);} to {opacity:1; transform:none;} }
@keyframes pop { 0% { transform: translateY(8px); opacity: 0 } 100% { transform: translateY(0); opacity: 1 } }
.animate-pop { animation: pop 220ms ease-out both; }
</style>

@endsection