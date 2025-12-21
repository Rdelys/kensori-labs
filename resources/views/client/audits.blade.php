@extends('layouts.clients')

@section('title', 'Audits internes')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
/* Styles améliorés */
#newAuditFormContainer, #newActionFormContainer, #newOutilFormContainer, #newNCFormContainer { 
    display: none; 
    animation: slideDown 0.3s ease;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: none; }
}

/* Effets hover améliorés */
.hover-lift:hover {
    transform: translateY(-3px);
    transition: all 0.2s ease;
}

/* Styles des cartes */
.card-hover {
    transition: all 0.3s ease;
    border-left: 4px solid;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0,0,0,0.1);
}

/* Badges de sévérité */
.badge-critical { background: linear-gradient(135deg, #ef4444, #dc2626); }
.badge-major { background: linear-gradient(135deg, #f97316, #ea580c); }
.badge-minor { background: linear-gradient(135deg, #f59e0b, #d97706); }
.badge-observation { background: linear-gradient(135deg, #eab308, #ca8a04); }

/* Animations pour les indicateurs */
.indicator-animate {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Table styling amélioré */
.table-striped tbody tr:nth-child(odd) {
    background-color: rgba(249, 250, 251, 0.5);
}

.table-hover tbody tr:hover {
    background-color: rgba(59, 130, 246, 0.05);
}

/* Boutons stylés */
.btn-glow {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.btn-glow:after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: 0.5s;
}

.btn-glow:hover:after {
    left: 100%;
}

/* Progress bars */
.progress-bar {
    height: 8px;
    border-radius: 4px;
    overflow: hidden;
    background-color: #e5e7eb;
}

.progress-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.5s ease;
}

/* Styles pour les graphiques */
.chart-container {
    position: relative;
    width: 100%;
    height: 300px;
}

/* Correction pour éviter l'élargissement infini */
canvas {
    max-width: 100%;
    display: block;
}
</style>

<div class="space-y-10">

  <!-- ===== ENTÊTE ===== -->
  <div class="flex items-center justify-between border-b pb-6">
    <div>
      <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
          <i class="fa-solid fa-clipboard-check text-white text-2xl"></i>
        </div>
        <span>Audits internes</span>
      </h1>
      <p class="text-gray-600 mt-2 ml-1">Suivi, planification et analyse des audits qualité</p>
    </div>
    <div class="flex gap-3">
      <button id="btnExportPDF" class="btn-glow bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
        <i class="fa-solid fa-file-pdf text-lg"></i> Exporter PDF
      </button>
      <button id="btnNewAudit" class="btn-glow bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
        <i class="fa-solid fa-plus"></i> Nouvel audit
      </button>
    </div>
  </div>

  <!-- ===== INDICATEURS ===== -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-gradient-to-br from-blue-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-blue-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 rounded-full mb-4">
        <i class="fa-solid fa-calendar-check text-blue-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Audits planifiés</p>
      <h3 class="text-4xl font-bold text-blue-700 mt-2 indicator-animate">8</h3>
      <div class="mt-3 text-xs text-blue-600 font-medium">+2 ce mois</div>
    </div>
    
    <div class="bg-gradient-to-br from-green-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-green-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-green-100 rounded-full mb-4">
        <i class="fa-solid fa-check-double text-green-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Audits réalisés</p>
      <h3 class="text-4xl font-bold text-green-700 mt-2">5</h3>
      <div class="progress-bar mt-3">
        <div class="progress-fill bg-gradient-to-r from-green-400 to-emerald-500" style="width: 63%"></div>
      </div>
    </div>
    
    <div class="bg-gradient-to-br from-red-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-red-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-red-100 rounded-full mb-4">
        <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Non-conformités</p>
      <h3 class="text-4xl font-bold text-red-700 mt-2">3</h3>
      <div class="mt-3 text-xs text-red-600 font-medium">Dont 1 majeure</div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-purple-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-purple-100 rounded-full mb-4">
        <i class="fa-solid fa-chart-line text-purple-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Taux d'achèvement</p>
      <h3 class="text-4xl font-bold text-purple-700 mt-2">62%</h3>
      <div class="progress-bar mt-3">
        <div class="progress-fill bg-gradient-to-r from-purple-400 to-violet-500" style="width: 62%"></div>
      </div>
    </div>
  </div>

  <!-- ===== RÉSUMÉ DES NC ===== -->
  <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
        <div class="p-2 bg-red-100 rounded-lg">
          <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
        </div>
        Résumé des non-conformités (NC)
      </h2>
      <button id="btnNewNC" class="bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Ajouter NC
      </button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Carte NC 1 -->
      <div class="card-hover border-l-4 border-red-500 border border-gray-200 rounded-xl p-5 bg-gradient-to-br from-red-50 to-white hover-lift">
        <div class="flex justify-between items-start mb-3">
          <span class="badge-critical text-white px-3 py-1.5 rounded-full text-xs font-bold shadow">NC-001</span>
          <div class="text-right">
            <span class="text-xs text-gray-500 block">15/09/2025</span>
            <span class="text-xs font-medium text-gray-700">N° Audit: A-2025-045</span>
          </div>
        </div>
        <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
          <i class="fa-solid fa-industry text-red-500"></i>
          Processus: Production
        </h4>
        <p class="text-sm text-gray-700 mb-4 leading-relaxed">Documentation des procédures non mise à jour selon la révision 2025. Manquement constaté lors de l'audit qualité mensuel.</p>
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold bg-red-100 text-red-800 px-3 py-1.5 rounded-full flex items-center gap-1">
            <i class="fa-solid fa-circle text-red-500 text-xs"></i> Majeure
          </span>
          <div class="text-right">
            <div class="text-xs font-medium text-gray-700">Resp: J. Dupont</div>
            <div class="text-xs text-gray-500">Échéance: 30/10/2025</div>
          </div>
        </div>
      </div>
      
      <!-- Carte NC 2 -->
      <div class="card-hover border-l-4 border-orange-500 border border-gray-200 rounded-xl p-5 bg-gradient-to-br from-orange-50 to-white hover-lift">
        <div class="flex justify-between items-start mb-3">
          <span class="badge-major text-white px-3 py-1.5 rounded-full text-xs font-bold shadow">NC-002</span>
          <div class="text-right">
            <span class="text-xs text-gray-500 block">22/09/2025</span>
            <span class="text-xs font-medium text-gray-700">N° Audit: A-2025-048</span>
          </div>
        </div>
        <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
          <i class="fa-solid fa-truck text-orange-500"></i>
          Processus: Achats
        </h4>
        <p class="text-sm text-gray-700 mb-4 leading-relaxed">Évaluation des fournisseurs non réalisée annuellement comme requis par la procédure PR-ACH-03.</p>
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold bg-orange-100 text-orange-800 px-3 py-1.5 rounded-full flex items-center gap-1">
            <i class="fa-solid fa-circle text-orange-500 text-xs"></i> Mineure
          </span>
          <div class="text-right">
            <div class="text-xs font-medium text-gray-700">Resp: M. Martin</div>
            <div class="text-xs text-gray-500">Échéance: 15/11/2025</div>
          </div>
        </div>
      </div>
      
      <!-- Carte NC 3 -->
      <div class="card-hover border-l-4 border-yellow-500 border border-gray-200 rounded-xl p-5 bg-gradient-to-br from-yellow-50 to-white hover-lift">
        <div class="flex justify-between items-start mb-3">
          <span class="badge-minor text-white px-3 py-1.5 rounded-full text-xs font-bold shadow">NC-003</span>
          <div class="text-right">
            <span class="text-xs text-gray-500 block">05/10/2025</span>
            <span class="text-xs font-medium text-gray-700">N° Audit: A-2025-052</span>
          </div>
        </div>
        <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
          <i class="fa-solid fa-screwdriver-wrench text-yellow-500"></i>
          Processus: Maintenance
        </h4>
        <p class="text-sm text-gray-700 mb-4 leading-relaxed">Calibration des instruments dépassée de 15 jours pour 3 équipements critiques de contrôle qualité.</p>
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold bg-yellow-100 text-yellow-800 px-3 py-1.5 rounded-full flex items-center gap-1">
            <i class="fa-solid fa-circle text-yellow-500 text-xs"></i> Observation
          </span>
          <div class="text-right">
            <div class="text-xs font-medium text-gray-700">Resp: P. Leroy</div>
            <div class="text-xs text-gray-500">Échéance: 20/10/2025</div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Sujets concernés -->
    <div class="mt-8 pt-6 border-t border-gray-200">
      <h4 class="font-semibold text-gray-700 mb-4 flex items-center gap-2 text-lg">
        <div class="p-2 bg-blue-100 rounded-lg">
          <i class="fa-solid fa-tags text-blue-600"></i>
        </div>
        Sujets concernés
      </h4>
      <div class="flex flex-wrap gap-3">
        <span class="bg-gradient-to-r from-blue-100 to-blue-50 text-blue-800 text-sm font-medium px-4 py-2 rounded-full border border-blue-200 flex items-center gap-2">
          <i class="fa-solid fa-file-contract"></i> Documentation QMS
        </span>
        <span class="bg-gradient-to-r from-green-100 to-green-50 text-green-800 text-sm font-medium px-4 py-2 rounded-full border border-green-200 flex items-center gap-2">
          <i class="fa-solid fa-truck"></i> Gestion fournisseurs
        </span>
        <span class="bg-gradient-to-r from-purple-100 to-purple-50 text-purple-800 text-sm font-medium px-4 py-2 rounded-full border border-purple-200 flex items-center gap-2">
          <i class="fa-solid fa-screwdriver-wrench"></i> Maintenance équipements
        </span>
        <span class="bg-gradient-to-r from-red-100 to-red-50 text-red-800 text-sm font-medium px-4 py-2 rounded-full border border-red-200 flex items-center gap-2">
          <i class="fa-solid fa-flask-vial"></i> Contrôle qualité
        </span>
        <span class="bg-gradient-to-r from-indigo-100 to-indigo-50 text-indigo-800 text-sm font-medium px-4 py-2 rounded-full border border-indigo-200 flex items-center gap-2">
          <i class="fa-solid fa-graduation-cap"></i> Formation personnel
        </span>
      </div>
    </div>
  </div>

  <!-- ===== FORMULAIRE NOUVELLE NC ===== -->
  <div id="newNCFormContainer" class="bg-gradient-to-br from-red-50 to-white p-8 rounded-2xl shadow-xl border border-red-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-red-100 rounded-lg">
        <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
      </div>
      Déclarer une nouvelle non-conformité
    </h2>
    <form id="newNCForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Audit source *</label>
        <select id="ncAudit" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" required>
          <option value="">Sélectionner l'audit</option>
          <option value="A-2025-045">A-2025-045 - Production (15/09/2025)</option>
          <option value="A-2025-048">A-2025-048 - Achats (22/09/2025)</option>
          <option value="A-2025-052">A-2025-052 - Maintenance (05/10/2025)</option>
        </select>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Référence NC *</label>
        <input type="text" id="ncReference" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Ex: NC-2025-004" required>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Date de détection *</label>
        <input type="date" id="ncDate" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Processus concerné *</label>
        <select id="ncProcess" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" required>
          <option value="">Sélectionner</option>
          <option>Production</option>
          <option>Achats</option>
          <option>RH</option>
          <option>Maintenance</option>
          <option>Qualité</option>
          <option>Logistique</option>
        </select>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Sévérité *</label>
        <select id="ncSeverity" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" required>
          <option value="">Sélectionner</option>
          <option value="critical" class="text-red-700">Critique</option>
          <option value="major" class="text-orange-700">Majeure</option>
          <option value="minor" class="text-yellow-700">Mineure</option>
          <option value="observation" class="text-blue-700">Observation</option>
        </select>
      </div>
      
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Description de la non-conformité *</label>
        <textarea id="ncDescription" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Décrire précisément la non-conformité constatée..." required></textarea>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Responsable traitement *</label>
        <select id="ncResponsible" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" required>
          <option value="">Sélectionner</option>
          <option>J. Dupont</option>
          <option>M. Martin</option>
          <option>P. Leroy</option>
          <option>A. Razafy</option>
          <option>S. Bernard</option>
        </select>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Échéance de correction *</label>
        <input type="date" id="ncDeadline" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
      </div>
      
      <div class="md:col-span-2 flex justify-end gap-3 pt-4">
        <button type="button" id="cancelNC" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Enregistrer la NC
        </button>
      </div>
    </form>
  </div>

  <!-- ===== PLANNING ===== -->
  <div id="auditSection" class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-blue-100 rounded-lg">
        <i class="fa-solid fa-calendar-days text-blue-600 text-xl"></i>
      </div>
      Planning des audits
    </h2>
    <div class="overflow-x-auto rounded-xl border border-gray-200">
      <table class="w-full border-collapse table-striped table-hover">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 uppercase text-sm">
          <tr>
            <th class="py-4 px-4 text-left font-semibold">Date</th>
            <th class="py-4 px-4 text-left font-semibold">Processus</th>
            <th class="py-4 px-4 text-left font-semibold">Auditeur</th>
            <th class="py-4 px-4 text-left font-semibold">Statut</th>
            <th class="py-4 px-4 text-left font-semibold">Outils utilisés</th>
            <th class="py-4 px-4 text-left font-semibold">Constats</th>
            <th class="py-4 px-4 text-left font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody id="auditTableBody" class="text-gray-700">
          <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
            <td class="py-4 px-4 font-medium">05/10/2025</td>
            <td class="py-4 px-4">
              <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                Production
              </div>
            </td>
            <td class="py-4 px-4">
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                  <span class="text-blue-700 font-medium">AR</span>
                </div>
                A. Razafy
              </div>
            </td>
            <td class="py-4 px-4">
              <span class="bg-yellow-100 text-yellow-800 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">Planifié</span>
            </td>
            <td class="py-4 px-4">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">Check-list ISO</span>
                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">Enregistrements</span>
              </div>
            </td>
            <td class="py-4 px-4">
              <span class="text-green-600 font-medium">RAS</span>
            </td>
            <td class="py-4 px-4">
              <button class="text-blue-600 hover:text-blue-800 p-1">
                <i class="fa-solid fa-eye"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ===== FORM NOUVEL AUDIT ===== -->
  <div id="newAuditFormContainer" class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-xl border border-blue-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-blue-100 rounded-lg">
        <i class="fa-solid fa-plus text-blue-600"></i>
      </div>
      Créer un nouvel audit
    </h2>
    <form id="newAuditForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Date d'audit *</label>
        <input type="date" id="auditDate" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Processus *</label>
        <input type="text" id="auditProcess" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: RH, Production..." required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Auditeur *</label>
        <input type="text" id="auditAuditeur" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Nom auditeur" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Statut *</label>
        <select id="auditStatut" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
          <option>Planifié</option>
          <option>En cours</option>
          <option>Clôturé</option>
        </select>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Outils utilisés</label>
        <input type="text" id="auditOutils" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Check-list, ISO Doc, Application mobile">
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Constats / Observations</label>
        <textarea id="auditConstats" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
      </div>
      <div class="md:col-span-2 flex justify-end gap-3 pt-4">
        <button type="button" id="cancelAudit" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Enregistrer l'audit
        </button>
      </div>
    </form>
  </div>

  <!-- ===== FORM ACTION ===== -->
  <div id="newActionFormContainer" class="bg-gradient-to-br from-red-50 to-white p-8 rounded-2xl shadow-xl border border-red-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-red-100 rounded-lg">
        <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
      </div>
      Ajouter une action corrective / préventive
    </h2>
    <form id="newActionForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 font-medium mb-2">Audit concerné *</label>
        <input type="text" id="actionAudit" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Ex: Audit Production du 05/10/2025" required>
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-2">Type d'action *</label>
        <select id="actionType" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
          <option>Corrective</option>
          <option>Préventive</option>
          <option>Amélioration</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-2">Responsable *</label>
        <input type="text" id="actionResp" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-2">Échéance *</label>
        <input type="date" id="actionDate" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 font-medium mb-2">Description *</label>
        <textarea id="actionDesc" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required></textarea>
      </div>
      <div class="md:col-span-2 flex justify-end gap-3">
        <button type="button" id="cancelAction" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Enregistrer l'action
        </button>
      </div>
    </form>
  </div>

  <!-- ===== FORM OUTIL ===== -->
  <div id="newOutilFormContainer" class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-xl border border-green-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-green-100 rounded-lg">
        <i class="fa-solid fa-toolbox text-green-600"></i>
      </div>
      Ajouter un outil / moyen d'audit
    </h2>
    <form id="newOutilForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Nom de l'outil *</label>
        <input type="text" id="outilNom" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Type *</label>
        <select id="outilType" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
          <option>Formulaire</option>
          <option>Application</option>
          <option>Instrument</option>
          <option>Logiciel</option>
          <option>Check-list</option>
        </select>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Utilisation</label>
        <textarea id="outilUsage" rows="2" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
      </div>
      <div class="md:col-span-2 flex justify-end gap-3">
        <button type="button" id="cancelOutil" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Enregistrer l'outil
        </button>
      </div>
    </form>
  </div>

  <!-- ===== BOUTONS D'AJOUT ===== -->
  <div class="flex justify-end gap-4">
    <button id="btnNewAction" class="btn-glow bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
      <i class="fa-solid fa-plus"></i> Nouvelle action
    </button>
    <button id="btnNewOutil" class="btn-glow bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
      <i class="fa-solid fa-wrench"></i> Nouvel outil
    </button>
  </div>

  <!-- ===== GRAPHIQUES ===== -->
  <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold mb-8 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-blue-100 rounded-lg">
        <i class="fa-solid fa-chart-pie text-blue-600 text-xl"></i>
      </div>
      Synthèse des audits
    </h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
      <div class="chart-container">
        <canvas id="auditStatusChart"></canvas>
        <p class="text-sm text-gray-600 mt-4 font-medium text-center">Répartition des audits par statut</p>
      </div>
      <div class="chart-container">
        <canvas id="ncProcessChart"></canvas>
        <p class="text-sm text-gray-600 mt-4 font-medium text-center">Non-conformités par processus</p>
      </div>
    </div>
  </div>
</div>

<script>
// --- Gestion affichage des formulaires
const auditForm = document.getElementById('newAuditFormContainer');
const actionForm = document.getElementById('newActionFormContainer');
const outilForm = document.getElementById('newOutilFormContainer');
const ncForm = document.getElementById('newNCFormContainer');

// Bouton pour ouvrir le formulaire NC
document.getElementById('btnNewNC').onclick = () => {
    ncForm.style.display = 'block';
    ncForm.scrollIntoView({behavior: 'smooth'});
};

// Bouton pour annuler le formulaire NC
document.getElementById('cancelNC').onclick = () => {
    ncForm.style.display = 'none';
};

// Gestion des autres formulaires
document.getElementById('btnNewAudit').onclick = () => {
    auditForm.style.display = 'block';
    auditForm.scrollIntoView({behavior: 'smooth'});
};

document.getElementById('cancelAudit').onclick = () => {
    auditForm.style.display = 'none';
};

document.getElementById('btnNewAction').onclick = () => {
    actionForm.style.display = 'block';
    actionForm.scrollIntoView({behavior: 'smooth'});
};

document.getElementById('cancelAction').onclick = () => {
    actionForm.style.display = 'none';
};

document.getElementById('btnNewOutil').onclick = () => {
    outilForm.style.display = 'block';
    outilForm.scrollIntoView({behavior: 'smooth'});
};

document.getElementById('cancelOutil').onclick = () => {
    outilForm.style.display = 'none';
};

// --- Formulaire Nouvelle NC
document.getElementById('newNCForm').onsubmit = e => {
    e.preventDefault();
    
    // Récupération des données
    const ncRef = document.getElementById('ncReference').value;
    const ncDate = document.getElementById('ncDate').value;
    const ncProcess = document.getElementById('ncProcess').value;
    const ncSeverity = document.getElementById('ncSeverity').value;
    const ncDesc = document.getElementById('ncDescription').value;
    const ncResp = document.getElementById('ncResponsible').value;
    const ncDeadline = document.getElementById('ncDeadline').value;
    
    // Formatage de la date
    const formattedDate = new Date(ncDate).toLocaleDateString('fr-FR');
    const formattedDeadline = new Date(ncDeadline).toLocaleDateString('fr-FR');
    
    // Déterminer les couleurs selon la sévérité
    let severityColor, severityBg, severityText;
    switch(ncSeverity) {
        case 'critical':
            severityColor = 'red';
            severityBg = 'from-red-50 to-white';
            severityText = 'Critique';
            break;
        case 'major':
            severityColor = 'orange';
            severityBg = 'from-orange-50 to-white';
            severityText = 'Majeure';
            break;
        case 'minor':
            severityColor = 'yellow';
            severityBg = 'from-yellow-50 to-white';
            severityText = 'Mineure';
            break;
        default:
            severityColor = 'blue';
            severityBg = 'from-blue-50 to-white';
            severityText = 'Observation';
    }
    
    // Créer une nouvelle carte NC
    const ncContainer = document.querySelector('#newNCFormContainer').previousElementSibling.querySelector('.grid');
    const newNCCard = document.createElement('div');
    newNCCard.className = `card-hover border-l-4 border-${severityColor}-500 border border-gray-200 rounded-xl p-5 bg-gradient-to-br ${severityBg} hover-lift`;
    newNCCard.innerHTML = `
        <div class="flex justify-between items-start mb-3">
            <span class="badge-${ncSeverity} text-white px-3 py-1.5 rounded-full text-xs font-bold shadow">${ncRef}</span>
            <div class="text-right">
                <span class="text-xs text-gray-500 block">${formattedDate}</span>
                <span class="text-xs font-medium text-gray-700">Nouvelle NC</span>
            </div>
        </div>
        <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
            <i class="fa-solid fa-${getProcessIcon(ncProcess)} text-${severityColor}-500"></i>
            Processus: ${ncProcess}
        </h4>
        <p class="text-sm text-gray-700 mb-4 leading-relaxed">${ncDesc}</p>
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold bg-${severityColor}-100 text-${severityColor}-800 px-3 py-1.5 rounded-full flex items-center gap-1">
                <i class="fa-solid fa-circle text-${severityColor}-500 text-xs"></i> ${severityText}
            </span>
            <div class="text-right">
                <div class="text-xs font-medium text-gray-700">Resp: ${ncResp}</div>
                <div class="text-xs text-gray-500">Échéance: ${formattedDeadline}</div>
            </div>
        </div>
    `;
    
    // Ajouter la nouvelle carte au début
    ncContainer.prepend(newNCCard);
    
    // Mettre à jour le compteur de NC
    const ncCounter = document.querySelector('.text-4xl.font-bold.text-red-700');
    const currentCount = parseInt(ncCounter.textContent);
    ncCounter.textContent = currentCount + 1;
    
    // Notification
    showNotification('✅ Nouvelle non-conformité enregistrée avec succès', 'success');
    
    // Réinitialiser le formulaire
    e.target.reset();
    ncForm.style.display = 'none';
};

// Fonction pour obtenir l'icône selon le processus
function getProcessIcon(process) {
    const icons = {
        'Production': 'industry',
        'Achats': 'truck',
        'RH': 'users',
        'Maintenance': 'screwdriver-wrench',
        'Qualité': 'flask-vial',
        'Logistique': 'boxes'
    };
    return icons[process] || 'clipboard-check';
}

// --- Formulaire Nouvel audit
document.getElementById('newAuditForm').onsubmit = e => {
    e.preventDefault();
    const date = auditDate.value;
    const process = auditProcess.value;
    const auditeur = auditAuditeur.value;
    const statut = auditStatut.value;
    const outils = auditOutils.value;
    const constats = auditConstats.value;
    
    // Formatage de la date
    const formattedDate = new Date(date).toLocaleDateString('fr-FR');
    
    // Déterminer la couleur du statut
    let statusColor, statusBg, statusText;
    switch(statut) {
        case 'Clôturé':
            statusColor = 'green';
            statusBg = 'bg-green-100 text-green-800';
            break;
        case 'En cours':
            statusColor = 'blue';
            statusBg = 'bg-blue-100 text-blue-800';
            break;
        default:
            statusColor = 'yellow';
            statusBg = 'bg-yellow-100 text-yellow-800';
    }
    
    const tbody = document.getElementById('auditTableBody');
    const tr = document.createElement('tr');
    tr.className = 'border-b border-gray-100 hover:bg-blue-50/50 transition';
    tr.innerHTML = `
        <td class="py-4 px-4 font-medium">${formattedDate}</td>
        <td class="py-4 px-4">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                ${process}
            </div>
        </td>
        <td class="py-4 px-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-blue-700 font-medium">${auditeur.split(' ').map(n => n[0]).join('')}</span>
                </div>
                ${auditeur}
            </div>
        </td>
        <td class="py-4 px-4">
            <span class="${statusBg} px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">${statut}</span>
        </td>
        <td class="py-4 px-4">
            <div class="flex flex-wrap gap-1">
                ${outils.split(',').map(tool => `<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">${tool.trim()}</span>`).join('')}
            </div>
        </td>
        <td class="py-4 px-4">
            <span class="${constats === 'RAS' ? 'text-green-600' : 'text-gray-700'} font-medium">${constats || 'RAS'}</span>
        </td>
        <td class="py-4 px-4">
            <button class="text-blue-600 hover:text-blue-800 p-1">
                <i class="fa-solid fa-eye"></i>
            </button>
        </td>
    `;
    tbody.appendChild(tr);
    
    showNotification('✅ Nouvel audit ajouté avec succès', 'success');
    e.target.reset();
    auditForm.style.display = 'none';
};

// --- Actions et Outils simulés
document.getElementById('newActionForm').onsubmit = e => {
    e.preventDefault();
    showNotification('✅ Action corrective enregistrée', 'success');
    e.target.reset();
    actionForm.style.display = 'none';
};

document.getElementById('newOutilForm').onsubmit = e => {
    e.preventDefault();
    showNotification('✅ Outil d\'audit enregistré', 'success');
    e.target.reset();
    outilForm.style.display = 'none';
};

// --- Fonction de notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white font-medium flex items-center gap-3`;
    
    if (type === 'success') {
        notification.style.background = 'linear-gradient(135deg, #10b981, #059669)';
    } else {
        notification.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
    }
    
    notification.innerHTML = `
        <i class="fa-solid fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-xl"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// --- Export PDF
document.getElementById('btnExportPDF').onclick = () => {
    showNotification('📄 Génération du PDF en cours...', 'success');
    
    setTimeout(() => {
        html2pdf().set({
            margin: 1,
            filename: 'Registre_Audits_QMS.pdf',
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },
            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
        }).from(document.getElementById('auditSection').parentElement).save();
        
        setTimeout(() => {
            showNotification('✅ PDF exporté avec succès', 'success');
        }, 1000);
    }, 500);
};

// --- Graphiques corrigés
let auditStatusChartInstance = null;
let ncProcessChartInstance = null;

function initCharts() {
    // Détruire les anciennes instances si elles existent
    if (auditStatusChartInstance) {
        auditStatusChartInstance.destroy();
    }
    if (ncProcessChartInstance) {
        ncProcessChartInstance.destroy();
    }
    
    // Créer les nouveaux graphiques
    const auditCtx = document.getElementById('auditStatusChart').getContext('2d');
    auditStatusChartInstance = new Chart(auditCtx, {
        type: 'doughnut',
        data: {
            labels: ['Planifiés', 'Clôturés', 'En cours', 'En retard'],
            datasets: [{
                data: [8, 5, 2, 1],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(249, 115, 22, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    'rgb(59, 130, 246)',
                    'rgb(34, 197, 94)',
                    'rgb(249, 115, 22)',
                    'rgb(239, 68, 68)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 13
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    cornerRadius: 6
                }
            },
            cutout: '65%'
        }
    });
    
    const ncCtx = document.getElementById('ncProcessChart').getContext('2d');
    ncProcessChartInstance = new Chart(ncCtx, {
        type: 'bar',
        data: {
            labels: ['Production', 'Achats', 'Maintenance', 'RH', 'Qualité'],
            datasets: [{
                label: 'Non-conformités',
                data: [4, 2, 3, 1, 2],
                backgroundColor: 'rgba(239, 68, 68, 0.7)',
                borderColor: 'rgb(239, 68, 68)',
                borderWidth: 1,
                borderRadius: 6,
                hoverBackgroundColor: 'rgba(239, 68, 68, 0.9)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 13
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    cornerRadius: 6
                }
            }
        }
    });
}

// Initialiser les graphiques au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    initCharts();
});

// --- Mettre à jour la date par défaut dans les formulaires
const today = new Date().toISOString().split('T')[0];
document.getElementById('auditDate').value = today;
document.getElementById('ncDate').value = today;

// Date d'échéance par défaut (30 jours)
const deadline = new Date();
deadline.setDate(deadline.getDate() + 30);
document.getElementById('ncDeadline').value = deadline.toISOString().split('T')[0];
document.getElementById('actionDate').value = deadline.toISOString().split('T')[0];
</script>
@endsection