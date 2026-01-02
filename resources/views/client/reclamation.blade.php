@extends('layouts.clients')

@section('title', 'Registre des Réclamations')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
#newReclamForm, #newActionForm, #editReclamForm {display: none;}

/* Styles optimisés et compact */
.compact-card {padding: 1.25rem !important;}
.compact-table {font-size: 0.875rem;}
.compact-table th {padding: 0.75rem 0.5rem; font-size: 0.75rem;}
.compact-table td {padding: 0.75rem 0.5rem;}
.compact-badge {padding: 0.25rem 0.5rem; font-size: 0.7rem;}
.compact-btn {padding: 0.5rem 1rem; font-size: 0.875rem;}
.compact-indicator {font-size: 2rem !important;}
.compact-icon {width: 2.5rem; height: 2.5rem;}

/* Tableau visible au premier regard */
.main-table-container {
    margin-top: 1.5rem;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    background: white;
}

.table-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem;
}

.table-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* Styles responsive améliorés */
@media (max-width: 768px) {
    .compact-table th, .compact-table td {
        padding: 0.5rem 0.25rem;
        font-size: 0.8rem;
    }
    
    .table-actions {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .table-actions button {
        width: 100%;
        justify-content: center;
    }
    
    .filter-container {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .filter-container select, .filter-container input {
        width: 100%;
    }
}

/* Badges de statut */
.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
}
.status-new {background: #fef3c7; color: #92400e;}
.status-inprogress {background: #dbeafe; color: #1e40af;}
.status-resolved {background: #d1fae5; color: #065f46;}
.status-pending {background: #fef3c7; color: #92400e;}
.status-closed {background: #e5e7eb; color: #374151;}

/* Priorités */
.priority-high {background: #fee2e2; color: #dc2626; border: 1px solid #fecaca;}
.priority-medium {background: #fef3c7; color: #d97706; border: 1px solid #fde68a;}
.priority-low {background: #d1fae5; color: #059669; border: 1px solid #a7f3d0;}
.priority-critical {background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-weight: bold;}

/* Hover effects simplifiés */
.hover-lift:hover {transform: translateY(-1px); transition: transform 0.2s;}
.table-row-hover:hover {background: #f9fafb;}
</style>

<div class="space-y-6">

  <!-- ===== EN-TÊTE COMPACT ===== -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
        <div class="p-2 bg-gradient-to-r from-red-500 to-orange-500 rounded-lg">
          <i class="fa-solid fa-flag text-white text-lg"></i>
        </div>
        Registre des Réclamations
      </h1>
      <p class="text-gray-600 text-sm mt-1">Suivi et traitement des réclamations clients</p>
    </div>
    <div class="flex gap-2">
      <button id="btnExportPDF" class="compact-btn bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg shadow flex items-center gap-2 font-medium">
        <i class="fa-solid fa-file-pdf text-sm"></i>
        <span class="hidden sm:inline">Export PDF</span>
      </button>
      <button id="btnNewReclam" class="compact-btn bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white rounded-lg shadow flex items-center gap-2 font-medium">
        <i class="fa-solid fa-plus text-sm"></i>
        <span class="hidden sm:inline">Nouvelle</span>
      </button>
    </div>
  </div>

  <!-- ===== INDICATEURS COMPACTS ===== -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-white shadow rounded-lg p-4 border hover-lift">
      <div class="flex items-center gap-3">
        <div class="compact-icon bg-red-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-exclamation-circle text-red-600"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs font-medium">Ce mois</p>
          <h3 class="compact-indicator font-bold text-red-700">24</h3>
          <p class="text-xs text-red-600 font-medium">+3</p>
        </div>
      </div>
    </div>
    
    <div class="bg-white shadow rounded-lg p-4 border hover-lift">
      <div class="flex items-center gap-3">
        <div class="compact-icon bg-blue-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-hourglass-half text-blue-600"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs font-medium">En traitement</p>
          <h3 class="compact-indicator font-bold text-blue-700">8</h3>
          <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
            <div class="bg-blue-500 h-1.5 rounded-full" style="width: 33%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="bg-white shadow rounded-lg p-4 border hover-lift">
      <div class="flex items-center gap-3">
        <div class="compact-icon bg-green-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-check-circle text-green-600"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs font-medium">Résolution</p>
          <h3 class="compact-indicator font-bold text-green-700">92%</h3>
          <p class="text-xs text-green-600 font-medium">Objectif: 95%</p>
        </div>
      </div>
    </div>
    
    <div class="bg-white shadow rounded-lg p-4 border hover-lift">
      <div class="flex items-center gap-3">
        <div class="compact-icon bg-purple-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-clock-rotate-left text-purple-600"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs font-medium">Délai moyen</p>
          <h3 class="compact-indicator font-bold text-purple-700">3.2j</h3>
          <p class="text-xs text-purple-600 font-medium">-0.5j</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== FILTRES RAPIDES ===== -->
  <div class="bg-white shadow rounded-lg p-4 border">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 filter-container">
      <div class="flex items-center gap-2 text-sm text-gray-700">
        <i class="fa-solid fa-filter text-gray-500"></i>
        <span>Filtres :</span>
      </div>
      <div class="flex flex-wrap gap-2 w-full md:w-auto">
        <select id="filterStatus" class="compact-btn border rounded text-sm bg-white">
          <option>Tous statuts</option>
          <option>Nouveau</option>
          <option>En traitement</option>
          <option>Résolu</option>
          <option>Fermé</option>
        </select>
        <select id="filterUrgence" class="compact-btn border rounded text-sm bg-white">
          <option>Toutes urgences</option>
          <option>Critique</option>
          <option>Élevé</option>
          <option>Moyen</option>
          <option>Faible</option>
        </select>
        <select id="filterCategorie" class="compact-btn border rounded text-sm bg-white">
          <option>Toutes catégories</option>
          <option>Produit endommagé</option>
          <option>Retard livraison</option>
          <option>Erreur facturation</option>
          <option>Service client</option>
        </select>
        <div class="relative flex-1 md:w-48">
          <input type="text" id="searchReclam" placeholder="Rechercher..." class="compact-btn border rounded text-sm bg-white w-full pl-9">
          <i class="fa-solid fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== TABLEAU PRINCIPAL (VISIBLE IMMÉDIATEMENT) ===== -->
  <div class="main-table-container">
    <div class="table-header flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
      <div>
        <h2 class="text-lg font-semibold text-white flex items-center gap-2">
          <i class="fa-solid fa-list-check"></i>
          Réclamations en cours
        </h2>
        <p class="text-white/80 text-sm mt-1">24 réclamations - 8 en traitement</p>
      </div>
      <div class="flex gap-2">
        <button id="btnNewAction" class="compact-btn bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded flex items-center gap-2">
          <i class="fa-solid fa-plus text-xs"></i>
          <span class="hidden sm:inline">Action</span>
        </button>
        <button id="btnAnalyseRecurrence" class="compact-btn bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded flex items-center gap-2">
          <i class="fa-solid fa-chart-pie text-xs"></i>
          <span class="hidden sm:inline">Analyse</span>
        </button>
      </div>
    </div>
    
    <div class="overflow-x-auto">
      <table class="w-full compact-table">
        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
          <tr>
            <th class="text-left font-semibold py-3 px-3">ID / Client</th>
            <th class="text-left font-semibold py-3 px-3">Date / Canal</th>
            <th class="text-left font-semibold py-3 px-3">Catégorie</th>
            <th class="text-left font-semibold py-3 px-3">Urgence</th>
            <th class="text-left font-semibold py-3 px-3">Statut</th>
            <th class="text-left font-semibold py-3 px-3">Actions</th>
          </tr>
        </thead>
        <tbody id="reclamationsTable" class="text-gray-700">
          <!-- Exemple 1 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="1" data-status="resolu" data-urgence="high" data-categorie="Produit endommagé">
            <td class="py-3 px-3">
              <div class="font-bold text-sm">#REC-2025-001</div>
              <div class="text-xs text-gray-600">Client A</div>
            </td>
            <td class="py-3 px-3">
              <div class="text-sm">15/12/25</div>
              <span class="compact-badge bg-blue-100 text-blue-800 rounded">Email</span>
            </td>
            <td class="py-3 px-3">
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-box-open text-red-500 text-sm"></i>
                <span class="text-sm">Produit endommagé</span>
              </div>
            </td>
            <td class="py-3 px-3">
              <span class="priority-high compact-badge">Élevé</span>
            </td>
            <td class="py-3 px-3">
              <span class="status-resolved status-badge">Résolu</span>
            </td>
            <td class="py-3 px-3">
              <div class="table-actions">
                <button class="edit-btn p-1.5 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit text-sm"></i>
                </button>
                <button class="view-btn p-1.5 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye text-sm"></i>
                </button>
                <button class="delete-btn p-1.5 text-red-600 hover:bg-red-50 rounded" title="Supprimer">
                  <i class="fa-solid fa-trash text-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 2 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="2" data-status="inprogress" data-urgence="medium" data-categorie="Retard de livraison">
            <td class="py-3 px-3">
              <div class="font-bold text-sm">#REC-2025-002</div>
              <div class="text-xs text-gray-600">Client B</div>
            </td>
            <td class="py-3 px-3">
              <div class="text-sm">14/12/25</div>
              <span class="compact-badge bg-green-100 text-green-800 rounded">Téléphone</span>
            </td>
            <td class="py-3 px-3">
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-truck text-orange-500 text-sm"></i>
                <span class="text-sm">Retard livraison</span>
              </div>
            </td>
            <td class="py-3 px-3">
              <span class="priority-medium compact-badge">Moyen</span>
            </td>
            <td class="py-3 px-3">
              <span class="status-inprogress status-badge">En cours</span>
            </td>
            <td class="py-3 px-3">
              <div class="table-actions">
                <button class="edit-btn p-1.5 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit text-sm"></i>
                </button>
                <button class="view-btn p-1.5 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye text-sm"></i>
                </button>
                <button class="close-btn p-1.5 text-purple-600 hover:bg-purple-50 rounded" title="Clôturer">
                  <i class="fa-solid fa-check-circle text-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 3 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="3" data-status="resolu" data-urgence="low" data-categorie="Erreur de facturation">
            <td class="py-3 px-3">
              <div class="font-bold text-sm">#REC-2025-003</div>
              <div class="text-xs text-gray-600">Client C</div>
            </td>
            <td class="py-3 px-3">
              <div class="text-sm">13/12/25</div>
              <span class="compact-badge bg-purple-100 text-purple-800 rounded">App mobile</span>
            </td>
            <td class="py-3 px-3">
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar text-purple-500 text-sm"></i>
                <span class="text-sm">Erreur facture</span>
              </div>
            </td>
            <td class="py-3 px-3">
              <span class="priority-low compact-badge">Faible</span>
            </td>
            <td class="py-3 px-3">
              <span class="status-resolved status-badge">Résolu</span>
            </td>
            <td class="py-3 px-3">
              <div class="table-actions">
                <button class="edit-btn p-1.5 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit text-sm"></i>
                </button>
                <button class="view-btn p-1.5 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye text-sm"></i>
                </button>
                <button class="delete-btn p-1.5 text-red-600 hover:bg-red-50 rounded" title="Supprimer">
                  <i class="fa-solid fa-trash text-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 4 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="4" data-status="new" data-urgence="critical" data-categorie="Service client">
            <td class="py-3 px-3">
              <div class="font-bold text-sm">#REC-2025-004</div>
              <div class="text-xs text-gray-600">Client D</div>
            </td>
            <td class="py-3 px-3">
              <div class="text-sm">12/12/25</div>
              <span class="compact-badge bg-red-100 text-red-800 rounded">Réseau social</span>
            </td>
            <td class="py-3 px-3">
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-headset text-blue-500 text-sm"></i>
                <span class="text-sm">Service client</span>
              </div>
            </td>
            <td class="py-3 px-3">
              <span class="priority-critical compact-badge">Critique</span>
            </td>
            <td class="py-3 px-3">
              <span class="status-new status-badge">Nouveau</span>
            </td>
            <td class="py-3 px-3">
              <div class="table-actions">
                <button class="edit-btn p-1.5 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit text-sm"></i>
                </button>
                <button class="view-btn p-1.5 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye text-sm"></i>
                </button>
                <button class="assign-btn p-1.5 text-indigo-600 hover:bg-indigo-50 rounded" title="Assigner">
                  <i class="fa-solid fa-user-check text-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 5 -->
          <tr class="hover:bg-gray-50 table-row-hover" data-id="5" data-status="pending" data-urgence="medium" data-categorie="Produit non conforme">
            <td class="py-3 px-3">
              <div class="font-bold text-sm">#REC-2025-005</div>
              <div class="text-xs text-gray-600">Client E</div>
            </td>
            <td class="py-3 px-3">
              <div class="text-sm">11/12/25</div>
              <span class="compact-badge bg-blue-100 text-blue-800 rounded">Email</span>
            </td>
            <td class="py-3 px-3">
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-sm"></i>
                <span class="text-sm">Non conforme</span>
              </div>
            </td>
            <td class="py-3 px-3">
              <span class="priority-medium compact-badge">Moyen</span>
            </td>
            <td class="py-3 px-3">
              <span class="status-pending status-badge">En attente</span>
            </td>
            <td class="py-3 px-3">
              <div class="table-actions">
                <button class="edit-btn p-1.5 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit text-sm"></i>
                </button>
                <button class="view-btn p-1.5 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye text-sm"></i>
                </button>
                <button class="escalate-btn p-1.5 text-red-600 hover:bg-red-50 rounded" title="Escalader">
                  <i class="fa-solid fa-arrow-up text-sm"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <!-- Pagination compacte -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-3 p-4 border-t bg-gray-50">
      <div class="text-sm text-gray-600">
        Affichage <span class="font-bold">1-5</span> de <span class="font-bold">24</span>
      </div>
      <div class="flex gap-1">
        <button class="p-2 border rounded text-gray-700 hover:bg-gray-100">
          <i class="fa-solid fa-chevron-left text-xs"></i>
        </button>
        <button class="p-2 w-8 bg-blue-600 text-white rounded font-medium text-sm">1</button>
        <button class="p-2 w-8 border rounded text-gray-700 hover:bg-gray-100 text-sm">2</button>
        <button class="p-2 w-8 border rounded text-gray-700 hover:bg-gray-100 text-sm">3</button>
        <button class="p-2 border rounded text-gray-700 hover:bg-gray-100">
          <i class="fa-solid fa-chevron-right text-xs"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- ===== ANALYSE COMPACTE ===== -->
  <div class="bg-white shadow rounded-lg p-5 border">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
        <i class="fa-solid fa-chart-pie text-red-500"></i>
        Analyse des récurrences
      </h3>
      <button id="btnExportAnalyse" class="compact-btn bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded flex items-center gap-2">
        <i class="fa-solid fa-download text-sm"></i>
        <span class="hidden sm:inline">Export</span>
      </button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
      <div>
        <h4 class="font-semibold text-gray-700 mb-3 text-sm">Top causes récurrentes</h4>
        <div class="space-y-3">
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm">Produit endommagé</span>
              <span class="text-sm font-bold text-red-600">25%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5">
              <div class="bg-red-500 h-1.5 rounded-full" style="width: 25%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm">Retards livraison</span>
              <span class="text-sm font-bold text-orange-600">20%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5">
              <div class="bg-orange-500 h-1.5 rounded-full" style="width: 20%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm">Erreurs facturation</span>
              <span class="text-sm font-bold text-yellow-600">15%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5">
              <div class="bg-yellow-500 h-1.5 rounded-full" style="width: 15%"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div>
        <h4 class="font-semibold text-gray-700 mb-3 text-sm">Actions prévues</h4>
        <div class="space-y-3">
          <div class="bg-blue-50 p-3 rounded border border-blue-200">
            <div class="flex justify-between items-center mb-1">
              <span class="font-medium text-sm">Amélioration emballage</span>
              <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs">En cours</span>
            </div>
            <p class="text-xs text-gray-600">Réduction dommages de 40%</p>
          </div>
          <div class="bg-green-50 p-3 rounded border border-green-200">
            <div class="flex justify-between items-center mb-1">
              <span class="font-medium text-sm">Formation support</span>
              <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs">Planifié</span>
            </div>
            <p class="text-xs text-gray-600">Janv 2026</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="mt-5 pt-4 border-t">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-600">Objectif élimination récurrences</p>
          <p class="font-bold text-green-700">-50% d'ici Juin 2026</p>
        </div>
        <div class="text-sm">
          <span class="text-gray-700">Progression:</span>
          <span class="font-bold text-green-600 ml-2">30%</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== FORMULAIRES MASQUÉS ===== -->
  <div id="newReclamForm" class="bg-white shadow-lg rounded-lg p-5 border">
    <h3 class="text-lg font-bold mb-4 text-gray-800">Nouvelle réclamation</h3>
    <form id="reclamForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-gray-700 mb-1 text-sm font-medium">Client *</label>
        <select class="w-full p-2 border rounded text-sm" required>
          <option value="">Sélectionner</option>
          <option>Client A</option>
          <option>Client B</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 mb-1 text-sm font-medium">Catégorie *</label>
        <select class="w-full p-2 border rounded text-sm" required>
          <option value="">Sélectionner</option>
          <option>Produit endommagé</option>
          <option>Retard livraison</option>
        </select>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-1 text-sm font-medium">Description *</label>
        <textarea rows="2" class="w-full p-2 border rounded text-sm" required></textarea>
      </div>
      <div class="md:col-span-2 flex justify-end gap-2 pt-2">
        <button type="button" id="cancelReclam" class="compact-btn bg-gray-300 text-gray-800 rounded">Annuler</button>
        <button type="submit" class="compact-btn bg-gradient-to-r from-red-600 to-orange-500 text-white rounded">
          <i class="fa-solid fa-save mr-1"></i> Enregistrer
        </button>
      </div>
    </form>
  </div>

  <!-- ===== MODAL ANALYSE ===== -->
  <div id="modalAnalyseRecurrence" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[80vh] overflow-y-auto">
      <div class="p-4 border-b flex justify-between items-center">
        <h3 class="font-bold text-gray-800">Analyse détaillée</h3>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
      </div>
      <div class="p-4">
        <p class="text-sm text-gray-600 mb-4">Analyse des récurrences par client et impact sur la satisfaction.</p>
        <div class="space-y-3">
          <div class="p-3 bg-gray-50 rounded">
            <div class="flex justify-between">
              <span class="font-medium">Client A</span>
              <span class="px-2 py-0.5 bg-red-100 text-red-800 rounded text-xs">5 récurrences</span>
            </div>
            <p class="text-xs text-gray-600 mt-1">Satisfaction: 68% (vs 87% moyenne)</p>
          </div>
          <div class="flex justify-end gap-2 mt-4 pt-4 border-t">
            <button id="closeModalBtn" class="compact-btn bg-gray-300 text-gray-800 rounded">Fermer</button>
            <button class="compact-btn bg-gradient-to-r from-red-600 to-orange-500 text-white rounded">Exporter</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// --- Initialisation ---
document.addEventListener('DOMContentLoaded', function() {
    initCharts();
    initEventListeners();
    
    // Date par défaut
    const today = new Date().toISOString().split('T')[0];
    if (document.getElementById('reclamDate')) {
        document.getElementById('reclamDate').value = today;
    }
});

// --- Gestion affichage formulaires ---
function initEventListeners() {
    const rForm = document.getElementById('newReclamForm');
    const aForm = document.getElementById('newActionForm');
    
    // Bouton nouvelle réclamation
    document.getElementById('btnNewReclam').onclick = () => {
        rForm.style.display = rForm.style.display === 'block' ? 'none' : 'block';
        if (rForm.style.display === 'block') {
            rForm.scrollIntoView({behavior: 'smooth'});
        }
    };
    
    document.getElementById('cancelReclam')?.addEventListener('click', () => {
        rForm.style.display = 'none';
    });
    
    // Bouton nouvelle action
    document.getElementById('btnNewAction')?.addEventListener('click', () => {
        showNotification('💡 Créez une action depuis la réclamation concernée', 'info');
    });
    
    // Bouton analyse
    document.getElementById('btnAnalyseRecurrence').onclick = () => {
        document.getElementById('modalAnalyseRecurrence').classList.remove('hidden');
    };
    
    // Fermer modal
    document.getElementById('closeModal')?.addEventListener('click', closeModal);
    document.getElementById('closeModalBtn')?.addEventListener('click', closeModal);
    
    function closeModal() {
        document.getElementById('modalAnalyseRecurrence').classList.add('hidden');
    }
    
    // Fermer modal en cliquant à l'extérieur
    document.getElementById('modalAnalyseRecurrence')?.addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    
    // Formulaire réclamation
    document.getElementById('reclamForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        showNotification('✅ Réclamation enregistrée', 'success');
        this.reset();
        rForm.style.display = 'none';
    });
    
    // Filtres
    document.getElementById('filterStatus')?.addEventListener('change', filterReclamations);
    document.getElementById('filterUrgence')?.addEventListener('change', filterReclamations);
    document.getElementById('filterCategorie')?.addEventListener('change', filterReclamations);
    document.getElementById('searchReclam')?.addEventListener('input', filterReclamations);
    
    // Export PDF
    document.getElementById('btnExportPDF').onclick = () => {
        showNotification('📄 PDF en génération...', 'success');
        setTimeout(() => showNotification('✅ PDF exporté', 'success'), 1000);
    };
    
    // Export analyse
    document.getElementById('btnExportAnalyse').onclick = () => {
        showNotification('📊 Analyse exportée', 'success');
    };
    
    // Actions sur les lignes du tableau
    document.querySelectorAll('#reclamationsTable tr').forEach(row => {
        addRowEventListeners(row);
    });
}

// --- Filtrage ---
function filterReclamations() {
    const statusFilter = document.getElementById('filterStatus')?.value;
    const urgenceFilter = document.getElementById('filterUrgence')?.value;
    const categorieFilter = document.getElementById('filterCategorie')?.value;
    const searchFilter = document.getElementById('searchReclam')?.value.toLowerCase() || '';
    
    document.querySelectorAll('#reclamationsTable tr').forEach(row => {
        const status = row.getAttribute('data-status');
        const urgence = row.getAttribute('data-urgence');
        const categorie = row.getAttribute('data-categorie');
        const rowText = row.textContent.toLowerCase();
        
        let show = true;
        
        if (statusFilter && statusFilter !== 'Tous statuts') {
            const statusMap = {
                'Nouveau': 'new',
                'En traitement': 'inprogress',
                'Résolu': 'resolu',
                'Fermé': 'closed'
            };
            if (status !== statusMap[statusFilter]) show = false;
        }
        
        if (urgenceFilter && urgenceFilter !== 'Toutes urgences') {
            const urgenceMap = {
                'Critique': 'critical',
                'Élevé': 'high',
                'Moyen': 'medium',
                'Faible': 'low'
            };
            if (urgence !== urgenceMap[urgenceFilter]) show = false;
        }
        
        if (categorieFilter && categorieFilter !== 'Toutes catégories') {
            if (!categorie?.includes(categorieFilter)) show = false;
        }
        
        if (searchFilter && !rowText.includes(searchFilter)) {
            show = false;
        }
        
        row.style.display = show ? '' : 'none';
    });
}

// --- Actions sur lignes ---
function addRowEventListeners(row) {
    // Bouton éditer
    row.querySelector('.edit-btn')?.addEventListener('click', function() {
        const id = row.querySelector('td:first-child .font-bold').textContent;
        showNotification(`📝 Édition de ${id}`, 'info');
    });
    
    // Bouton voir
    row.querySelector('.view-btn')?.addEventListener('click', function() {
        const client = row.querySelector('td:first-child .text-xs').textContent;
        showNotification(`👁️ Détails de ${client}`, 'info');
    });
    
    // Bouton supprimer
    row.querySelector('.delete-btn')?.addEventListener('click', function() {
        if (confirm('Supprimer cette réclamation ?')) {
            showNotification('🗑️ Réclamation supprimée', 'warning');
        }
    });
    
    // Bouton clôturer
    row.querySelector('.close-btn')?.addEventListener('click', function() {
        const statusCell = row.querySelector('td:nth-child(5)');
        statusCell.innerHTML = '<span class="status-resolved status-badge">Résolu</span>';
        row.setAttribute('data-status', 'resolu');
        showNotification('✅ Réclamation clôturée', 'success');
    });
    
    // Bouton assigner
    row.querySelector('.assign-btn')?.addEventListener('click', function() {
        showNotification('👤 Réclamation assignée', 'info');
    });
    
    // Bouton escalader
    row.querySelector('.escalate-btn')?.addEventListener('click', function() {
        showNotification('⬆️ Réclamation escaladée', 'warning');
    });
}

// --- Graphiques ---
function initCharts() {
    // Graphique simple si nécessaire
    console.log('Graphiques initialisés');
}

// --- Notifications ---
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white font-medium flex items-center gap-2 text-sm';
    
    const colors = {
        success: 'linear-gradient(135deg, #10b981, #059669)',
        warning: 'linear-gradient(135deg, #f59e0b, #d97706)',
        info: 'linear-gradient(135deg, #3b82f6, #1d4ed8)',
        error: 'linear-gradient(135deg, #ef4444, #dc2626)'
    };
    
    notification.style.background = colors[type] || colors.info;
    notification.innerHTML = `
        <i class="fa-solid fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection