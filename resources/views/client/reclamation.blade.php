@extends('layouts.clients')

@section('title', 'Registre des Réclamations')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
#newReclamForm, #newActionForm, #editReclamForm {display: none;}

/* Styles optimisés et ultra-compact */
.compact-card {padding: 1rem !important;}
.compact-table {font-size: 0.8rem;}
.compact-table th {padding: 0.5rem 0.4rem; font-size: 0.7rem; font-weight: 600;}
.compact-table td {padding: 0.5rem 0.4rem;}
.compact-badge {padding: 0.15rem 0.4rem; font-size: 0.65rem; border-radius: 0.25rem;}
.compact-btn {padding: 0.4rem 0.8rem; font-size: 0.75rem;}
.compact-indicator {font-size: 1.5rem !important;}
.compact-icon {width: 2rem; height: 2rem;}
.compact-form-input {padding: 0.35rem 0.5rem; font-size: 0.8rem;}

/* Espacement réduit */
.compact-gap {gap: 0.5rem;}
.compact-section {margin-bottom: 1rem;}

/* Tableau ultra-compact */
.main-table-container {
    margin-top: 1rem;
    border-radius: 0.375rem;
    overflow: hidden;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    background: white;
}

.table-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.75rem;
}

/* Styles responsive améliorés pour tous appareils */
@media (max-width: 640px) {
    .compact-table th, .compact-table td {
        padding: 0.4rem 0.2rem;
        font-size: 0.7rem;
    }
    
    .compact-table {
        min-width: 800px; /* Permet le scroll horizontal */
    }
    
    .table-actions {
        display: flex;
        flex-wrap: nowrap;
        gap: 0.2rem;
    }
    
    .table-actions button {
        padding: 0.3rem;
        min-width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .compact-indicator {
        font-size: 1.25rem;
    }
    
    .compact-icon {
        width: 1.75rem;
        height: 1.75rem;
    }
}

@media (min-width: 641px) and (max-width: 1024px) {
    .compact-table th, .compact-table td {
        padding: 0.5rem 0.3rem;
        font-size: 0.75rem;
    }
    
    .table-actions {
        gap: 0.3rem;
    }
}

/* Badges de statut ultra-compacts */
.status-badge {
    padding: 0.15rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.65rem;
    font-weight: 600;
    display: inline-block;
}
.status-new {background: #fef3c7; color: #92400e;}
.status-inprogress {background: #dbeafe; color: #1e40af;}
.status-resolved {background: #d1fae5; color: #065f46;}
.status-pending {background: #fef3c7; color: #92400e;}
.status-closed {background: #e5e7eb; color: #374151;}

/* Priorités compactes */
.priority-high {background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; font-size: 0.65rem;}
.priority-medium {background: #fef3c7; color: #d97706; border: 1px solid #fde68a; font-size: 0.65rem;}
.priority-low {background: #d1fae5; color: #059669; border: 1px solid #a7f3d0; font-size: 0.65rem;}
.priority-critical {background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-weight: bold; font-size: 0.65rem;}

/* Hover effects optimisés */
.hover-lift:hover {transform: translateY(-1px); transition: transform 0.15s; box-shadow: 0 2px 4px rgba(0,0,0,0.05);}
.table-row-hover:hover {background: #f8fafc;}

/* Scrollbar minimaliste */
::-webkit-scrollbar {
    height: 4px;
    width: 4px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 2px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}

/* Section analyse récurrence spécifique */
.recurrence-grid {
    display: grid;
    gap: 0.75rem;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}

.recurrence-item {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.375rem;
    padding: 0.75rem;
    font-size: 0.8rem;
}

.recurrence-progress {
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    overflow: hidden;
}

/* Layout ultra-compact pour mobile */
.mobile-stack {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.mobile-stack > * {
    width: 100%;
}

/* Icônes adaptatives */
.icon-sm {
    font-size: 0.8rem;
}

/* Optimisation de l'espace des formulaires */
.compact-form-grid {
    display: grid;
    gap: 0.5rem;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
}

/* Indicateurs en ligne */
.inline-stats {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
}
</style>

<div class="space-y-4">

  <!-- ===== EN-TÊTE ULTRA-COMPACT ===== -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-3 border-b compact-section">
    <div>
      <h1 class="text-xl font-bold text-gray-900 flex items-center gap-2">
        <div class="p-1.5 bg-gradient-to-r from-red-500 to-orange-500 rounded">
          <i class="fa-solid fa-flag text-white icon-sm"></i>
        </div>
        Registre Réclamations
      </h1>
      <p class="text-gray-600 text-xs mt-1">Suivi et traitement</p>
    </div>
    <div class="flex gap-1.5">
      <button id="btnExportPDF" class="compact-btn bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded shadow flex items-center gap-1">
        <i class="fa-solid fa-file-pdf icon-sm"></i>
        <span class="hidden xs:inline">PDF</span>
      </button>
      <button id="btnNewReclam" class="compact-btn bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white rounded shadow flex items-center gap-1">
        <i class="fa-solid fa-plus icon-sm"></i>
        <span class="hidden xs:inline">Nouvelle</span>
      </button>
    </div>
  </div>

  <!-- ===== INDICATEURS ULTRA-COMPACTS ===== -->
  <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 compact-section">
    <div class="bg-white shadow rounded p-3 border hover-lift">
      <div class="flex items-center gap-2">
        <div class="compact-icon bg-red-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-exclamation-circle text-red-600 icon-sm"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs">Ce mois</p>
          <div class="flex items-baseline gap-1">
            <h3 class="compact-indicator font-bold text-red-700">24</h3>
            <span class="text-xs text-red-600 font-medium">+3</span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="bg-white shadow rounded p-3 border hover-lift">
      <div class="flex items-center gap-2">
        <div class="compact-icon bg-blue-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-hourglass-half text-blue-600 icon-sm"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs">En cours</p>
          <h3 class="compact-indicator font-bold text-blue-700">8</h3>
          <div class="recurrence-progress mt-1">
            <div class="h-full bg-blue-500" style="width: 33%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="bg-white shadow rounded p-3 border hover-lift">
      <div class="flex items-center gap-2">
        <div class="compact-icon bg-green-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-check-circle text-green-600 icon-sm"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs">Résolution</p>
          <h3 class="compact-indicator font-bold text-green-700">92%</h3>
          <p class="text-xs text-green-600">Objectif: 95%</p>
        </div>
      </div>
    </div>
    
    <div class="bg-white shadow rounded p-3 border hover-lift">
      <div class="flex items-center gap-2">
        <div class="compact-icon bg-purple-100 rounded-full flex items-center justify-center">
          <i class="fa-solid fa-clock-rotate-left text-purple-600 icon-sm"></i>
        </div>
        <div>
          <p class="text-gray-500 text-xs">Délai moyen</p>
          <h3 class="compact-indicator font-bold text-purple-700">3.2j</h3>
          <p class="text-xs text-purple-600">-0.5j</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== FILTRES RAPIDES COMPACTS ===== -->
  <div class="bg-white shadow rounded p-3 border compact-section">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 filter-container">
      <div class="flex items-center gap-1 text-xs text-gray-700">
        <i class="fa-solid fa-filter text-gray-500 icon-sm"></i>
        <span>Filtres :</span>
      </div>
      <div class="flex flex-wrap gap-1.5 w-full md:w-auto mobile-stack">
        <select id="filterStatus" class="compact-btn border rounded text-xs bg-white">
          <option>Tous statuts</option>
          <option>Nouveau</option>
          <option>En cours</option>
          <option>Résolu</option>
          <option>Fermé</option>
        </select>
        <select id="filterUrgence" class="compact-btn border rounded text-xs bg-white">
          <option>Toutes urgences</option>
          <option>Critique</option>
          <option>Élevé</option>
          <option>Moyen</option>
          <option>Faible</option>
        </select>
        <select id="filterCategorie" class="compact-btn border rounded text-xs bg-white">
          <option>Toutes catégories</option>
          <option>Produit endommagé</option>
          <option>Retard livraison</option>
          <option>Erreur facturation</option>
          <option>Service client</option>
        </select>
        <div class="relative flex-1 min-w-[150px]">
          <input type="text" id="searchReclam" placeholder="Rechercher..." class="compact-btn border rounded text-xs bg-white w-full pl-7">
          <i class="fa-solid fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 icon-sm"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== TABLEAU PRINCIPAL ULTRA-COMPACT ===== -->
  <div class="main-table-container">
    <div class="table-header flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
      <div>
        <h2 class="text-base font-semibold text-white flex items-center gap-1">
          <i class="fa-solid fa-list-check icon-sm"></i>
          Réclamations en cours
        </h2>
        <p class="text-white/80 text-xs mt-0.5">24 réclamations - 8 en traitement</p>
      </div>
      <div class="flex gap-1.5">
        <button id="btnNewAction" class="compact-btn bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded flex items-center gap-1">
          <i class="fa-solid fa-plus icon-sm"></i>
          <span class="hidden sm:inline">Action</span>
        </button>
        <button id="btnAnalyseRecurrence" class="compact-btn bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded flex items-center gap-1">
          <i class="fa-solid fa-chart-pie icon-sm"></i>
          <span class="hidden sm:inline">Analyse</span>
        </button>
      </div>
    </div>
    
    <div class="overflow-x-auto">
      <table class="w-full compact-table">
        <thead class="bg-gray-50 text-gray-700 uppercase">
          <tr>
            <th class="text-left font-semibold py-2 px-2">ID / Client</th>
            <th class="text-left font-semibold py-2 px-2">Date / Canal</th>
            <th class="text-left font-semibold py-2 px-2">Catégorie</th>
            <th class="text-left font-semibold py-2 px-2">Urgence</th>
            <th class="text-left font-semibold py-2 px-2">Statut</th>
            <th class="text-left font-semibold py-2 px-2">Actions</th>
          </tr>
        </thead>
        <tbody id="reclamationsTable" class="text-gray-700">
          <!-- Exemple 1 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="1" data-status="resolu" data-urgence="high" data-categorie="Produit endommagé" data-produit="Smartphone X200" data-departement="Logistique">
            <td class="py-2 px-2">
              <div class="font-bold text-xs">#REC-2025-001</div>
              <div class="text-xs text-gray-600 truncate max-w-[100px]">Client A</div>
            </td>
            <td class="py-2 px-2">
              <div class="text-xs">15/12/25</div>
              <span class="compact-badge bg-blue-100 text-blue-800">Email</span>
            </td>
            <td class="py-2 px-2">
              <div class="flex items-center gap-1">
                <i class="fa-solid fa-box-open text-red-500 icon-sm"></i>
                <span class="text-xs truncate">Produit endommagé</span>
              </div>
            </td>
            <td class="py-2 px-2">
              <span class="priority-high compact-badge">Élevé</span>
            </td>
            <td class="py-2 px-2">
              <span class="status-resolved status-badge">Résolu</span>
            </td>
            <td class="py-2 px-2">
              <div class="table-actions">
                <button class="edit-btn p-1 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit icon-sm"></i>
                </button>
                <button class="view-btn p-1 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye icon-sm"></i>
                </button>
                <button class="delete-btn p-1 text-red-600 hover:bg-red-50 rounded" title="Supprimer">
                  <i class="fa-solid fa-trash icon-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 2 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="2" data-status="inprogress" data-urgence="medium" data-categorie="Retard de livraison" data-produit="Tablet Pro 12" data-departement="Transport">
            <td class="py-2 px-2">
              <div class="font-bold text-xs">#REC-2025-002</div>
              <div class="text-xs text-gray-600 truncate max-w-[100px]">Client B</div>
            </td>
            <td class="py-2 px-2">
              <div class="text-xs">14/12/25</div>
              <span class="compact-badge bg-green-100 text-green-800">Téléphone</span>
            </td>
            <td class="py-2 px-2">
              <div class="flex items-center gap-1">
                <i class="fa-solid fa-truck text-orange-500 icon-sm"></i>
                <span class="text-xs truncate">Retard livraison</span>
              </div>
            </td>
            <td class="py-2 px-2">
              <span class="priority-medium compact-badge">Moyen</span>
            </td>
            <td class="py-2 px-2">
              <span class="status-inprogress status-badge">En cours</span>
            </td>
            <td class="py-2 px-2">
              <div class="table-actions">
                <button class="edit-btn p-1 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit icon-sm"></i>
                </button>
                <button class="view-btn p-1 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye icon-sm"></i>
                </button>
                <button class="close-btn p-1 text-purple-600 hover:bg-purple-50 rounded" title="Clôturer">
                  <i class="fa-solid fa-check-circle icon-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 3 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="3" data-status="resolu" data-urgence="low" data-categorie="Erreur de facturation" data-produit="Laptop Elite" data-departement="Comptabilité">
            <td class="py-2 px-2">
              <div class="font-bold text-xs">#REC-2025-003</div>
              <div class="text-xs text-gray-600 truncate max-w-[100px]">Client C</div>
            </td>
            <td class="py-2 px-2">
              <div class="text-xs">13/12/25</div>
              <span class="compact-badge bg-purple-100 text-purple-800">App mobile</span>
            </td>
            <td class="py-2 px-2">
              <div class="flex items-center gap-1">
                <i class="fa-solid fa-file-invoice-dollar text-purple-500 icon-sm"></i>
                <span class="text-xs truncate">Erreur facture</span>
              </div>
            </td>
            <td class="py-2 px-2">
              <span class="priority-low compact-badge">Faible</span>
            </td>
            <td class="py-2 px-2">
              <span class="status-resolved status-badge">Résolu</span>
            </td>
            <td class="py-2 px-2">
              <div class="table-actions">
                <button class="edit-btn p-1 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit icon-sm"></i>
                </button>
                <button class="view-btn p-1 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye icon-sm"></i>
                </button>
                <button class="delete-btn p-1 text-red-600 hover:bg-red-50 rounded" title="Supprimer">
                  <i class="fa-solid fa-trash icon-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 4 -->
          <tr class="border-b hover:bg-gray-50 table-row-hover" data-id="4" data-status="new" data-urgence="critical" data-categorie="Service client" data-produit="Support technique" data-departement="Service Client">
            <td class="py-2 px-2">
              <div class="font-bold text-xs">#REC-2025-004</div>
              <div class="text-xs text-gray-600 truncate max-w-[100px]">Client D</div>
            </td>
            <td class="py-2 px-2">
              <div class="text-xs">12/12/25</div>
              <span class="compact-badge bg-red-100 text-red-800">Réseau social</span>
            </td>
            <td class="py-2 px-2">
              <div class="flex items-center gap-1">
                <i class="fa-solid fa-headset text-blue-500 icon-sm"></i>
                <span class="text-xs truncate">Service client</span>
              </div>
            </td>
            <td class="py-2 px-2">
              <span class="priority-critical compact-badge">Critique</span>
            </td>
            <td class="py-2 px-2">
              <span class="status-new status-badge">Nouveau</span>
            </td>
            <td class="py-2 px-2">
              <div class="table-actions">
                <button class="edit-btn p-1 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit icon-sm"></i>
                </button>
                <button class="view-btn p-1 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye icon-sm"></i>
                </button>
                <button class="assign-btn p-1 text-indigo-600 hover:bg-indigo-50 rounded" title="Assigner">
                  <i class="fa-solid fa-user-check icon-sm"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <!-- Exemple 5 -->
          <tr class="hover:bg-gray-50 table-row-hover" data-id="5" data-status="pending" data-urgence="medium" data-categorie="Produit non conforme" data-produit="Smartphone X200" data-departement="Qualité">
            <td class="py-2 px-2">
              <div class="font-bold text-xs">#REC-2025-005</div>
              <div class="text-xs text-gray-600 truncate max-w-[100px]">Client E</div>
            </td>
            <td class="py-2 px-2">
              <div class="text-xs">11/12/25</div>
              <span class="compact-badge bg-blue-100 text-blue-800">Email</span>
            </td>
            <td class="py-2 px-2">
              <div class="flex items-center gap-1">
                <i class="fa-solid fa-triangle-exclamation text-yellow-500 icon-sm"></i>
                <span class="text-xs truncate">Non conforme</span>
              </div>
            </td>
            <td class="py-2 px-2">
              <span class="priority-medium compact-badge">Moyen</span>
            </td>
            <td class="py-2 px-2">
              <span class="status-pending status-badge">En attente</span>
            </td>
            <td class="py-2 px-2">
              <div class="table-actions">
                <button class="edit-btn p-1 text-blue-600 hover:bg-blue-50 rounded" title="Éditer">
                  <i class="fa-solid fa-edit icon-sm"></i>
                </button>
                <button class="view-btn p-1 text-green-600 hover:bg-green-50 rounded" title="Voir">
                  <i class="fa-solid fa-eye icon-sm"></i>
                </button>
                <button class="escalate-btn p-1 text-red-600 hover:bg-red-50 rounded" title="Escalader">
                  <i class="fa-solid fa-arrow-up icon-sm"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <!-- Pagination ultra-compact -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-2 p-3 border-t bg-gray-50">
      <div class="text-xs text-gray-600">
        Affichage <span class="font-bold">1-5</span> de <span class="font-bold">24</span>
      </div>
      <div class="flex gap-1">
        <button class="p-1.5 border rounded text-gray-700 hover:bg-gray-100 text-xs">
          <i class="fa-solid fa-chevron-left icon-sm"></i>
        </button>
        <button class="p-1.5 w-6 bg-blue-600 text-white rounded font-medium text-xs">1</button>
        <button class="p-1.5 w-6 border rounded text-gray-700 hover:bg-gray-100 text-xs">2</button>
        <button class="p-1.5 w-6 border rounded text-gray-700 hover:bg-gray-100 text-xs">3</button>
        <button class="p-1.5 border rounded text-gray-700 hover:bg-gray-100 text-xs">
          <i class="fa-solid fa-chevron-right icon-sm"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- ===== ANALYSE DES RÉCURRENCES PAR TYPE DE PRODUIT ===== -->
  <div class="bg-white shadow rounded p-4 border compact-section">
    <div class="flex justify-between items-center mb-3">
      <h3 class="text-base font-bold text-gray-800 flex items-center gap-1.5">
        <i class="fa-solid fa-chart-line text-red-500 icon-sm"></i>
        Analyse des Récurrences
      </h3>
      <button id="btnExportAnalyse" class="compact-btn bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded flex items-center gap-1">
        <i class="fa-solid fa-download icon-sm"></i>
        <span class="hidden sm:inline">Export</span>
      </button>
    </div>
    
    <div class="recurrence-grid">
      <!-- Produit avec plus de problèmes -->
      <div class="recurrence-item">
        <div class="flex justify-between items-start mb-2">
          <div>
            <h4 class="font-semibold text-gray-800 text-sm">Produit le plus problématique</h4>
            <p class="text-xs text-gray-600 mt-0.5">Smartphone X200</p>
          </div>
          <span class="compact-badge bg-red-100 text-red-800 font-bold">12 incidents</span>
        </div>
        <div class="text-xs text-gray-700 mb-1">Taux de récurrence: <span class="font-bold text-red-600">25%</span></div>
        <div class="recurrence-progress">
          <div class="h-full bg-red-500" style="width: 25%"></div>
        </div>
        <div class="mt-2 text-xs text-gray-600">
          <div class="inline-stats">
            <i class="fa-solid fa-building text-gray-500"></i>
            <span>Département principal: <strong>Logistique</strong></span>
          </div>
        </div>
      </div>
      
      <!-- Top 3 produits récurrents -->
      <div class="recurrence-item">
        <h4 class="font-semibold text-gray-800 text-sm mb-2">Top 3 produits récurrents</h4>
        <div class="space-y-2">
          <div>
            <div class="flex justify-between text-xs">
              <span>Tablet Pro 12</span>
              <span class="font-bold text-orange-600">8 incidents</span>
            </div>
            <div class="recurrence-progress mt-0.5">
              <div class="h-full bg-orange-500" style="width: 16.7%"></div>
            </div>
            <div class="text-xs text-gray-600 mt-0.5">
              <span class="inline-stats">
                <i class="fa-solid fa-truck text-gray-500"></i>
                Dépt: Transport
              </span>
            </div>
          </div>
          
          <div>
            <div class="flex justify-between text-xs">
              <span>Laptop Elite</span>
              <span class="font-bold text-yellow-600">6 incidents</span>
            </div>
            <div class="recurrence-progress mt-0.5">
              <div class="h-full bg-yellow-500" style="width: 12.5%"></div>
            </div>
            <div class="text-xs text-gray-600 mt-0.5">
              <span class="inline-stats">
                <i class="fa-solid fa-file-invoice text-gray-500"></i>
                Dépt: Comptabilité
              </span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Département le plus concerné -->
      <div class="recurrence-item">
        <div class="flex justify-between items-start mb-2">
          <div>
            <h4 class="font-semibold text-gray-800 text-sm">Département le plus concerné</h4>
            <p class="text-xs text-gray-600 mt-0.5">Logistique</p>
          </div>
          <span class="compact-badge bg-blue-100 text-blue-800 font-bold">18 incidents</span>
        </div>
        <div class="text-xs text-gray-700 mb-1">Part des récurrences: <span class="font-bold text-blue-600">37.5%</span></div>
        <div class="recurrence-progress">
          <div class="h-full bg-blue-500" style="width: 37.5%"></div>
        </div>
        <div class="mt-2 text-xs text-gray-600">
          <div class="inline-stats">
            <i class="fa-solid fa-box text-gray-500"></i>
            <span>Produit principal: <strong>Smartphone X200</strong></span>
          </div>
        </div>
      </div>
      
      <!-- Tendance récurrente -->
      <div class="recurrence-item">
        <h4 class="font-semibold text-gray-800 text-sm mb-2">Tendance récurrente</h4>
        <div class="text-xs text-gray-700 mb-2">Produits endommagés en transit représentent <span class="font-bold text-red-600">45%</span> des récurrences</div>
        <div class="space-y-1.5">
          <div class="text-xs">
            <div class="flex justify-between">
              <span>Transports fragiles</span>
              <span class="font-medium">42%</span>
            </div>
            <div class="recurrence-progress">
              <div class="h-full bg-red-400" style="width: 42%"></div>
            </div>
          </div>
          <div class="text-xs">
            <div class="flex justify-between">
              <span>Emballage inadéquat</span>
              <span class="font-medium">35%</span>
            </div>
            <div class="recurrence-progress">
              <div class="h-full bg-orange-400" style="width: 35%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Actions correctives -->
    <div class="mt-4 pt-3 border-t">
      <h4 class="font-semibold text-gray-800 text-sm mb-2">Actions correctives prioritaires</h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="bg-blue-50 p-2 rounded border border-blue-200">
          <div class="flex justify-between items-center mb-1">
            <span class="font-medium text-xs">Amélioration emballage smartphone</span>
            <span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded text-xs">En cours</span>
          </div>
          <p class="text-xs text-gray-600">Cible: -40% dommages</p>
          <div class="text-xs text-gray-700 mt-1">
            <span class="inline-stats">
              <i class="fa-solid fa-industry text-gray-500"></i>
              Dépt: Logistique & Production
            </span>
          </div>
        </div>
        
        <div class="bg-green-50 p-2 rounded border border-green-200">
          <div class="flex justify-between items-center mb-1">
            <span class="font-medium text-xs">Formation transport fragile</span>
            <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded text-xs">Planifié</span>
          </div>
          <p class="text-xs text-gray-600">Janv 2026 - Équipe transport</p>
          <div class="text-xs text-gray-700 mt-1">
            <span class="inline-stats">
              <i class="fa-solid fa-users text-gray-500"></i>
              Dépt: Transport & RH
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Objectif réduction -->
    <div class="mt-3 pt-3 border-t">
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
        <div>
          <p class="text-xs text-gray-600">Objectif réduction récurrences</p>
          <p class="font-bold text-green-700 text-sm">-50% d'ici Juin 2026</p>
        </div>
        <div class="text-xs">
          <div class="inline-stats">
            <span class="text-gray-700">Progression:</span>
            <span class="font-bold text-green-600">30%</span>
          </div>
          <div class="recurrence-progress mt-1 w-24">
            <div class="h-full bg-green-500" style="width: 30%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== FORMULAIRES MASQUÉS ULTRA-COMPACTS ===== -->
  <div id="newReclamForm" class="bg-white shadow rounded p-4 border">
    <h3 class="text-base font-bold mb-3 text-gray-800">Nouvelle réclamation</h3>
    <form id="reclamForm" class="compact-form-grid gap-3">
      <div class="col-span-full">
        <label class="block text-gray-700 mb-1 text-xs font-medium">Client *</label>
        <select class="w-full compact-form-input border rounded" required>
          <option value="">Sélectionner</option>
          <option>Client A</option>
          <option>Client B</option>
        </select>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-1 text-xs font-medium">Produit *</label>
        <select class="w-full compact-form-input border rounded" required>
          <option value="">Sélectionner</option>
          <option>Smartphone X200</option>
          <option>Tablet Pro 12</option>
          <option>Laptop Elite</option>
        </select>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-1 text-xs font-medium">Catégorie *</label>
        <select class="w-full compact-form-input border rounded" required>
          <option value="">Sélectionner</option>
          <option>Produit endommagé</option>
          <option>Retard livraison</option>
        </select>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-1 text-xs font-medium">Département</label>
        <select class="w-full compact-form-input border rounded">
          <option value="">Sélectionner</option>
          <option>Logistique</option>
          <option>Transport</option>
          <option>Service Client</option>
        </select>
      </div>
      
      <div class="col-span-full">
        <label class="block text-gray-700 mb-1 text-xs font-medium">Description *</label>
        <textarea rows="2" class="w-full compact-form-input border rounded" required></textarea>
      </div>
      
      <div class="col-span-full flex justify-end gap-1.5 pt-2">
        <button type="button" id="cancelReclam" class="compact-btn bg-gray-300 text-gray-800 rounded">Annuler</button>
        <button type="submit" class="compact-btn bg-gradient-to-r from-red-600 to-orange-500 text-white rounded">
          <i class="fa-solid fa-save mr-0.5 icon-sm"></i> Enregistrer
        </button>
      </div>
    </form>
  </div>

  <!-- ===== MODAL ANALYSE DÉTAILLÉE ===== -->
  <div id="modalAnalyseRecurrence" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-3">
    <div class="bg-white rounded shadow-xl w-full max-w-2xl max-h-[85vh] overflow-y-auto">
      <div class="p-3 border-b flex justify-between items-center">
        <h3 class="font-bold text-gray-800 text-sm">Analyse détaillée des récurrences</h3>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
      </div>
      <div class="p-3">
        <div class="mb-3">
          <h4 class="font-semibold text-gray-700 text-sm mb-2">Analyse par type de produit</h4>
          <div class="space-y-2">
            <div class="p-2 bg-red-50 rounded border border-red-200">
              <div class="flex justify-between">
                <span class="font-medium text-xs">Smartphone X200</span>
                <span class="px-2 py-0.5 bg-red-100 text-red-800 rounded text-xs">12 récurrences</span>
              </div>
              <div class="text-xs text-gray-600 mt-1">
                <div class="inline-stats">
                  <i class="fa-solid fa-building text-gray-500"></i>
                  Département principal: <strong>Logistique</strong>
                </div>
              </div>
              <div class="text-xs text-gray-600 mt-0.5">
                Taux de récurrence: <span class="font-bold">25%</span> • Coût estimé: <span class="font-bold">$12,500</span>
              </div>
            </div>
            
            <div class="p-2 bg-orange-50 rounded border border-orange-200">
              <div class="flex justify-between">
                <span class="font-medium text-xs">Tablet Pro 12</span>
                <span class="px-2 py-0.5 bg-orange-100 text-orange-800 rounded text-xs">8 récurrences</span>
              </div>
              <div class="text-xs text-gray-600 mt-1">
                <div class="inline-stats">
                  <i class="fa-solid fa-truck text-gray-500"></i>
                  Département principal: <strong>Transport</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="mb-3">
          <h4 class="font-semibold text-gray-700 text-sm mb-2">Départements les plus concernés</h4>
          <div class="grid grid-cols-2 gap-2">
            <div class="p-2 bg-blue-50 rounded border border-blue-200 text-center">
              <div class="text-xs font-bold text-blue-700">1. Logistique</div>
              <div class="text-xs text-gray-600">18 incidents</div>
            </div>
            <div class="p-2 bg-green-50 rounded border border-green-200 text-center">
              <div class="text-xs font-bold text-green-700">2. Transport</div>
              <div class="text-xs text-gray-600">14 incidents</div>
            </div>
          </div>
        </div>
        
        <div class="flex justify-end gap-1.5 mt-4 pt-3 border-t">
          <button id="closeModalBtn" class="compact-btn bg-gray-300 text-gray-800 rounded">Fermer</button>
          <button class="compact-btn bg-gradient-to-r from-red-600 to-orange-500 text-white rounded">Exporter</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// --- Initialisation ultra-optimisée ---
document.addEventListener('DOMContentLoaded', function() {
    initCharts();
    initEventListeners();
    
    // Date par défaut
    const today = new Date().toISOString().split('T')[0];
    if (document.getElementById('reclamDate')) {
        document.getElementById('reclamDate').value = today;
    }
});

// --- Gestion événements optimisée ---
function initEventListeners() {
    const rForm = document.getElementById('newReclamForm');
    
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
    
    // Bouton analyse récurrence
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
    
    // Filtres optimisés
    const filterDebounce = debounce(filterReclamations, 250);
    document.getElementById('filterStatus')?.addEventListener('change', filterDebounce);
    document.getElementById('filterUrgence')?.addEventListener('change', filterDebounce);
    document.getElementById('filterCategorie')?.addEventListener('change', filterDebounce);
    document.getElementById('searchReclam')?.addEventListener('input', filterDebounce);
    
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
    
    // Optimisation pour mobile
    if (window.innerWidth < 640) {
        document.querySelectorAll('.compact-table td').forEach(td => {
            td.style.maxWidth = '120px';
            td.style.overflow = 'hidden';
            td.style.textOverflow = 'ellipsis';
            td.style.whiteSpace = 'nowrap';
        });
    }
}

// --- Debounce pour performances ---
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// --- Filtrage optimisé ---
function filterReclamations() {
    const statusFilter = document.getElementById('filterStatus')?.value;
    const urgenceFilter = document.getElementById('filterUrgence')?.value;
    const categorieFilter = document.getElementById('filterCategorie')?.value;
    const searchFilter = document.getElementById('searchReclam')?.value.toLowerCase() || '';
    
    const statusMap = {
        'Nouveau': 'new',
        'En cours': 'inprogress',
        'Résolu': 'resolu',
        'Fermé': 'closed'
    };
    
    const urgenceMap = {
        'Critique': 'critical',
        'Élevé': 'high',
        'Moyen': 'medium',
        'Faible': 'low'
    };
    
    let visibleCount = 0;
    
    document.querySelectorAll('#reclamationsTable tr').forEach(row => {
        const status = row.getAttribute('data-status');
        const urgence = row.getAttribute('data-urgence');
        const categorie = row.getAttribute('data-categorie');
        const produit = row.getAttribute('data-produit') || '';
        const departement = row.getAttribute('data-departement') || '';
        const rowText = row.textContent.toLowerCase() + produit.toLowerCase() + departement.toLowerCase();
        
        let show = true;
        
        if (statusFilter && statusFilter !== 'Tous statuts') {
            if (status !== statusMap[statusFilter]) show = false;
        }
        
        if (urgenceFilter && urgenceFilter !== 'Toutes urgences') {
            if (urgence !== urgenceMap[urgenceFilter]) show = false;
        }
        
        if (categorieFilter && categorieFilter !== 'Toutes catégories') {
            if (!categorie?.includes(categorieFilter)) show = false;
        }
        
        if (searchFilter && !rowText.includes(searchFilter)) {
            show = false;
        }
        
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
    });
    
    // Mettre à jour le compteur
    const counterElement = document.querySelector('.table-header p');
    if (counterElement) {
        counterElement.textContent = `${visibleCount} réclamations`;
    }
}

// --- Actions sur lignes optimisées ---
function addRowEventListeners(row) {
    // Bouton éditer
    row.querySelector('.edit-btn')?.addEventListener('click', function() {
        const id = row.querySelector('td:first-child .font-bold').textContent;
        showNotification(`📝 Édition de ${id}`, 'info');
    });
    
    // Bouton voir
    row.querySelector('.view-btn')?.addEventListener('click', function() {
        const produit = row.getAttribute('data-produit');
        const departement = row.getAttribute('data-departement');
        const message = produit ? `👁️ ${produit} - ${departement}` : '👁️ Détails';
        showNotification(message, 'info');
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

// --- Graphiques simplifiés ---
function initCharts() {
    // Initialisation légère pour mobile
    if (window.innerWidth > 768) {
        console.log('Graphiques disponibles pour desktop');
    }
}

// --- Notifications compactes ---
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-3 right-3 z-50 px-3 py-2 rounded shadow-lg text-white font-medium flex items-center gap-1 text-xs';
    
    const colors = {
        success: 'linear-gradient(135deg, #10b981, #059669)',
        warning: 'linear-gradient(135deg, #f59e0b, #d97706)',
        info: 'linear-gradient(135deg, #3b82f6, #1d4ed8)',
        error: 'linear-gradient(135deg, #ef4444, #dc2626)'
    };
    
    notification.style.background = colors[type] || colors.info;
    notification.innerHTML = `
        <i class="fa-solid fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} icon-sm"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 2000);
}
</script>
@endsection