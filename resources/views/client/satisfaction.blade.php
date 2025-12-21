@extends('layouts.clients')

@section('title', 'Satisfaction client')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
#newSurveyForm, #newReclamForm, #newActionForm, #newEvaluationForm {display: none; animation: slideDown 0.3s ease;}
@keyframes slideDown {from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:none}}

/* Styles améliorés */
.hover-lift:hover {transform: translateY(-3px); transition: all 0.2s ease;}
.card-hover {transition: all 0.3s ease;}
.card-hover:hover {transform: translateY(-5px); box-shadow: 0 12px 20px rgba(0,0,0,0.1);}
.btn-glow {box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);}
.indicator-animate {animation: pulse 2s infinite;}
@keyframes pulse {0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
.progress-bar {height: 8px; border-radius: 4px; overflow: hidden; background-color: #e5e7eb;}
.progress-fill {height: 100%; border-radius: 4px; transition: width 0.5s ease;}
.table-striped tbody tr:nth-child(odd) {background-color: rgba(249, 250, 251, 0.5);}
.table-hover tbody tr:hover {background-color: rgba(59, 130, 246, 0.05);}
.chart-container {position: relative; width: 100%; height: 300px;}
canvas {max-width: 100%; display: block;}
</style>

<div class="space-y-10">

  <!-- ===== ENTÊTE ===== -->
  <div class="flex items-center justify-between border-b pb-6">
    <div>
      <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
        <div class="p-3 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl shadow-lg">
          <i class="fa-solid fa-face-smile text-white text-2xl"></i>
        </div>
        <span>Satisfaction client</span>
      </h1>
      <p class="text-gray-600 mt-2 ml-1">Mesure, analyse et amélioration continue de la satisfaction client</p>
    </div>
    <div class="flex gap-3">
      <button id="btnExportPDF" class="btn-glow bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
        <i class="fa-solid fa-file-pdf text-lg"></i> Exporter PDF
      </button>
      <button id="btnNewSurvey" class="btn-glow bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
        <i class="fa-solid fa-plus"></i> Nouvelle enquête
      </button>
    </div>
  </div>

  <!-- ===== INDICATEURS ===== -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-gradient-to-br from-green-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-green-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-green-100 rounded-full mb-4">
        <i class="fa-solid fa-chart-line text-green-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Satisfaction globale</p>
      <h3 class="text-4xl font-bold text-green-700 mt-2 indicator-animate">87%</h3>
      <div class="progress-bar mt-3">
        <div class="progress-fill bg-gradient-to-r from-green-400 to-emerald-500" style="width: 87%"></div>
      </div>
    </div>
    
    <div class="bg-gradient-to-br from-blue-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-blue-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 rounded-full mb-4">
        <i class="fa-solid fa-arrow-trend-up text-blue-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Score NPS</p>
      <h3 class="text-4xl font-bold text-blue-700 mt-2">+42</h3>
      <div class="mt-3 text-xs text-blue-600 font-medium">+6 vs trimestre précédent</div>
    </div>
    
    <div class="bg-gradient-to-br from-red-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-red-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-red-100 rounded-full mb-4">
        <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Réclamations</p>
      <h3 class="text-4xl font-bold text-red-700 mt-2">6</h3>
      <div class="mt-3 text-xs text-red-600 font-medium">2 en cours de traitement</div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-50 to-white shadow-lg rounded-2xl p-6 text-center hover-lift border border-purple-100">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-purple-100 rounded-full mb-4">
        <i class="fa-solid fa-clipboard-check text-purple-600 text-xl"></i>
      </div>
      <p class="text-gray-500 text-sm font-medium">Enquêtes réalisées</p>
      <h3 class="text-4xl font-bold text-purple-700 mt-2">4</h3>
      <div class="progress-bar mt-3">
        <div class="progress-fill bg-gradient-to-r from-purple-400 to-violet-500" style="width: 80%"></div>
      </div>
    </div>
  </div>

  <!-- ===== CRITÈRES D'ÉVALUATION ===== -->
  <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
        <div class="p-2 bg-blue-100 rounded-lg">
          <i class="fa-solid fa-clipboard-check text-blue-600 text-xl"></i>
        </div>
        Critères d'évaluation de la satisfaction client
      </h2>
      <button id="btnNewEvaluation" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Nouvelle évaluation
      </button>
    </div>
    
    <div class="mb-6">
      <p class="text-gray-700 mb-3">L'enquête de satisfaction client est réalisée sur la base des critères suivants :</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Critère 1 -->
      <div class="card-hover bg-gradient-to-br from-blue-50 to-white border-l-4 border-blue-500 border border-gray-200 rounded-xl p-5 hover-lift">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-blue-100 p-3 rounded-xl">
            <i class="fa-solid fa-star text-blue-600 text-xl"></i>
          </div>
          <h3 class="font-bold text-blue-800 text-lg">Qualité des produits</h3>
        </div>
        <ul class="text-sm text-gray-700 space-y-2">
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Conformité aux spécifications</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Fiabilité et durabilité</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Performance technique</span>
          </li>
        </ul>
        <div class="mt-4 pt-3 border-t border-blue-100">
          <div class="flex items-center justify-between">
            <span class="text-xs text-gray-500">Score moyen :</span>
            <span class="text-blue-700 font-bold">4.5/5</span>
          </div>
        </div>
      </div>
      
      <!-- Critère 2 -->
      <div class="card-hover bg-gradient-to-br from-green-50 to-white border-l-4 border-green-500 border border-gray-200 rounded-xl p-5 hover-lift">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-green-100 p-3 rounded-xl">
            <i class="fa-solid fa-truck-fast text-green-600 text-xl"></i>
          </div>
          <h3 class="font-bold text-green-800 text-lg">Service livraison</h3>
        </div>
        <ul class="text-sm text-gray-700 space-y-2">
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Respect des délais</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">État des colis à réception</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Communication sur le suivi</span>
          </li>
        </ul>
        <div class="mt-4 pt-3 border-t border-green-100">
          <div class="flex items-center justify-between">
            <span class="text-xs text-gray-500">Score moyen :</span>
            <span class="text-green-700 font-bold">4.2/5</span>
          </div>
        </div>
      </div>
      
      <!-- Critère 3 -->
      <div class="card-hover bg-gradient-to-br from-purple-50 to-white border-l-4 border-purple-500 border border-gray-200 rounded-xl p-5 hover-lift">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-purple-100 p-3 rounded-xl">
            <i class="fa-solid fa-headset text-purple-600 text-xl"></i>
          </div>
          <h3 class="font-bold text-purple-800 text-lg">Support client</h3>
        </div>
        <ul class="text-sm text-gray-700 space-y-2">
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Réactivité aux demandes</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Qualité des réponses</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Résolution des problèmes</span>
          </li>
        </ul>
        <div class="mt-4 pt-3 border-t border-purple-100">
          <div class="flex items-center justify-between">
            <span class="text-xs text-gray-500">Score moyen :</span>
            <span class="text-purple-700 font-bold">4.0/5</span>
          </div>
        </div>
      </div>
      
      <!-- Critère 4 -->
      <div class="card-hover bg-gradient-to-br from-yellow-50 to-white border-l-4 border-yellow-500 border border-gray-200 rounded-xl p-5 hover-lift">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-yellow-100 p-3 rounded-xl">
            <i class="fa-solid fa-file-invoice-dollar text-yellow-600 text-xl"></i>
          </div>
          <h3 class="font-bold text-yellow-800 text-lg">Facturation</h3>
        </div>
        <ul class="text-sm text-gray-700 space-y-2">
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Clarté des factures</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Justesse des montants</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Délais de paiement</span>
          </li>
        </ul>
        <div class="mt-4 pt-3 border-t border-yellow-100">
          <div class="flex items-center justify-between">
            <span class="text-xs text-gray-500">Score moyen :</span>
            <span class="text-yellow-700 font-bold">4.3/5</span>
          </div>
        </div>
      </div>
      
      <!-- Critère 5 -->
      <div class="card-hover bg-gradient-to-br from-indigo-50 to-white border-l-4 border-indigo-500 border border-gray-200 rounded-xl p-5 hover-lift">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-indigo-100 p-3 rounded-xl">
            <i class="fa-solid fa-handshake-simple text-indigo-600 text-xl"></i>
          </div>
          <h3 class="font-bold text-indigo-800 text-lg">Relation commerciale</h3>
        </div>
        <ul class="text-sm text-gray-700 space-y-2">
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Écoute des besoins</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Professionnalisme des équipes</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Flexibilité aux demandes</span>
          </li>
        </ul>
        <div class="mt-4 pt-3 border-t border-indigo-100">
          <div class="flex items-center justify-between">
            <span class="text-xs text-gray-500">Score moyen :</span>
            <span class="text-indigo-700 font-bold">4.4/5</span>
          </div>
        </div>
      </div>
      
      <!-- Critère 6 -->
      <div class="card-hover bg-gradient-to-br from-red-50 to-white border-l-4 border-red-500 border border-gray-200 rounded-xl p-5 hover-lift">
        <div class="flex items-center gap-3 mb-4">
          <div class="bg-red-100 p-3 rounded-xl">
            <i class="fa-solid fa-rotate-left text-red-600 text-xl"></i>
          </div>
          <h3 class="font-bold text-red-800 text-lg">Traitement des réclamations</h3>
        </div>
        <ul class="text-sm text-gray-700 space-y-2">
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Rapidité de traitement</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Adéquation des solutions</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
            <span class="font-medium">Suivi post-résolution</span>
          </li>
        </ul>
        <div class="mt-4 pt-3 border-t border-red-100">
          <div class="flex items-center justify-between">
            <span class="text-xs text-gray-500">Score moyen :</span>
            <span class="text-red-700 font-bold">3.8/5</span>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Méthodologie -->
    <div class="mt-8 pt-8 border-t border-gray-200">
      <h4 class="font-semibold text-gray-700 mb-4 flex items-center gap-2 text-lg">
        <div class="p-2 bg-blue-100 rounded-lg">
          <i class="fa-solid fa-magnifying-glass-chart text-blue-600"></i>
        </div>
        Méthodologie d'évaluation
      </h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gradient-to-br from-gray-50 to-white p-5 rounded-xl border border-gray-200">
          <h5 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-ruler text-blue-500"></i>
            Échelle de notation
          </h5>
          <div class="space-y-3">
            <div class="flex items-center justify-between p-2 bg-gradient-to-r from-red-50 to-red-100 rounded-lg">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">1</span>
                <span class="text-gray-700 font-medium">Très insatisfait</span>
              </div>
              <span class="text-red-600 font-bold">0-20%</span>
            </div>
            <div class="flex items-center justify-between p-2 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold">2</span>
                <span class="text-gray-700 font-medium">Insatisfait</span>
              </div>
              <span class="text-orange-600 font-bold">21-40%</span>
            </div>
            <div class="flex items-center justify-between p-2 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold">3</span>
                <span class="text-gray-700 font-medium">Neutre</span>
              </div>
              <span class="text-yellow-600 font-bold">41-60%</span>
            </div>
            <div class="flex items-center justify-between p-2 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">4</span>
                <span class="text-gray-700 font-medium">Satisfait</span>
              </div>
              <span class="text-blue-600 font-bold">61-80%</span>
            </div>
            <div class="flex items-center justify-between p-2 bg-gradient-to-r from-green-50 to-green-100 rounded-lg">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">5</span>
                <span class="text-gray-700 font-medium">Très satisfait</span>
              </div>
              <span class="text-green-600 font-bold">81-100%</span>
            </div>
          </div>
        </div>
        
        <div class="bg-gradient-to-br from-indigo-50 to-white p-5 rounded-xl border border-indigo-200">
          <h5 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-calculator text-indigo-500"></i>
            Calcul du Net Promoter Score (NPS)
          </h5>
          <div class="space-y-4">
            <div class="bg-white p-3 rounded-lg border">
              <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                <span class="font-bold text-green-700">Promoteurs (9-10)</span>
              </div>
              <p class="text-sm text-gray-600">Clients très satisfaits, fidèles et prescripteurs</p>
              <div class="mt-2 text-right">
                <span class="text-green-600 font-bold">45%</span>
              </div>
            </div>
            
            <div class="bg-white p-3 rounded-lg border">
              <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                <span class="font-bold text-blue-700">Passifs (7-8)</span>
              </div>
              <p class="text-sm text-gray-600">Clients satisfaits mais peu engagés</p>
              <div class="mt-2 text-right">
                <span class="text-blue-600 font-bold">35%</span>
              </div>
            </div>
            
            <div class="bg-white p-3 rounded-lg border">
              <div class="flex items-center gap-2 mb-1">
                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                <span class="font-bold text-red-700">Détracteurs (0-6)</span>
              </div>
              <p class="text-sm text-gray-600">Clients insatisfaits, risque de désertion</p>
              <div class="mt-2 text-right">
                <span class="text-red-600 font-bold">20%</span>
              </div>
            </div>
            
            <div class="mt-4 p-3 bg-gradient-to-r from-indigo-100 to-blue-100 rounded-lg">
              <p class="text-center font-bold text-indigo-800">
                NPS = 45% (Promoteurs) - 20% (Détracteurs) = <span class="text-2xl">+25</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== FORMULAIRE NOUVELLE ÉVALUATION ===== -->
  <div id="newEvaluationForm" class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-xl border border-blue-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-blue-100 rounded-lg">
        <i class="fa-solid fa-star-half-stroke text-blue-600"></i>
      </div>
      Nouvelle évaluation de satisfaction
    </h2>
    <form id="evaluationForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Client *</label>
        <select id="evalClient" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" required>
          <option value="">Sélectionner un client</option>
          <option>Client A</option>
          <option>Client B</option>
          <option>Client C</option>
          <option>Client D</option>
        </select>
      </div>
      
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Date d'évaluation *</label>
        <input type="date" id="evalDate" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
      
      <div class="md:col-span-2">
        <h4 class="font-semibold text-gray-700 mb-4">Évaluation par critère (1-5)</h4>
        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border rounded-lg">
              <label class="block text-gray-700 mb-2 font-medium">Qualité produit</label>
              <select id="evalQualite" class="w-full p-2 border rounded" required>
                <option value="">Note</option>
                <option>1 - Très insatisfait</option>
                <option>2 - Insatisfait</option>
                <option>3 - Neutre</option>
                <option>4 - Satisfait</option>
                <option>5 - Très satisfait</option>
              </select>
            </div>
            
            <div class="p-4 bg-white border rounded-lg">
              <label class="block text-gray-700 mb-2 font-medium">Service livraison</label>
              <select id="evalLivraison" class="w-full p-2 border rounded" required>
                <option value="">Note</option>
                <option>1 - Très insatisfait</option>
                <option>2 - Insatisfait</option>
                <option>3 - Neutre</option>
                <option>4 - Satisfait</option>
                <option>5 - Très satisfait</option>
              </select>
            </div>
            
            <div class="p-4 bg-white border rounded-lg">
              <label class="block text-gray-700 mb-2 font-medium">Support client</label>
              <select id="evalSupport" class="w-full p-2 border rounded" required>
                <option value="">Note</option>
                <option>1 - Très insatisfait</option>
                <option>2 - Insatisfait</option>
                <option>3 - Neutre</option>
                <option>4 - Satisfait</option>
                <option>5 - Très satisfait</option>
              </select>
            </div>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border rounded-lg">
              <label class="block text-gray-700 mb-2 font-medium">Facturation</label>
              <select id="evalFacturation" class="w-full p-2 border rounded" required>
                <option value="">Note</option>
                <option>1 - Très insatisfait</option>
                <option>2 - Insatisfait</option>
                <option>3 - Neutre</option>
                <option>4 - Satisfait</option>
                <option>5 - Très satisfait</option>
              </select>
            </div>
            
            <div class="p-4 bg-white border rounded-lg">
              <label class="block text-gray-700 mb-2 font-medium">Relation commerciale</label>
              <select id="evalRelation" class="w-full p-2 border rounded" required>
                <option value="">Note</option>
                <option>1 - Très insatisfait</option>
                <option>2 - Insatisfait</option>
                <option>3 - Neutre</option>
                <option>4 - Satisfait</option>
                <option>5 - Très satisfait</option>
              </select>
            </div>
            
            <div class="p-4 bg-white border rounded-lg">
              <label class="block text-gray-700 mb-2 font-medium">Traitement réclamations</label>
              <select id="evalReclamations" class="w-full p-2 border rounded">
                <option value="">Note</option>
                <option>1 - Très insatisfait</option>
                <option>2 - Insatisfait</option>
                <option>3 - Neutre</option>
                <option>4 - Satisfait</option>
                <option>5 - Très satisfait</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Recommandation (NPS) *</label>
        <div class="flex items-center justify-between mb-2">
          <span class="text-red-600 font-medium">0 - Pas du tout probable</span>
          <span class="text-green-600 font-medium">10 - Extrêmement probable</span>
        </div>
        <input type="range" id="evalNPS" min="0" max="10" value="7" class="w-full h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer">
        <div class="flex justify-between text-xs text-gray-500 mt-1">
          <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span>
        </div>
        <div class="mt-2 text-center">
          <span id="npsValue" class="text-blue-600 font-bold text-lg">7</span>
          <span class="text-gray-600 ml-2">/ 10</span>
        </div>
      </div>
      
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Commentaires</label>
        <textarea id="evalComment" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Commentaires du client..."></textarea>
      </div>
      
      <div class="md:col-span-2 flex justify-end gap-3 pt-4">
        <button type="button" id="cancelEvaluation" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-500 hover:from-blue-700 hover:to-indigo-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Enregistrer l'évaluation
        </button>
      </div>
    </form>
  </div>

  <!-- ===== FORMULAIRE NOUVELLE ENQUÊTE ===== -->
  <div id="newSurveyForm" class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-xl border border-blue-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-blue-100 rounded-lg">
        <i class="fa-solid fa-poll text-blue-600"></i>
      </div>
      Créer une nouvelle enquête de satisfaction
    </h2>
    <form id="surveyForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Titre de l'enquête *</label>
        <input id="surveyTitle" type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Enquête satisfaction T4 2025" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Canal de diffusion *</label>
        <select id="surveyCanal" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
          <option>Email</option>
          <option>QR Code</option>
          <option>Portail client</option>
          <option>Téléphone</option>
          <option>Formulaire web</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Date de lancement *</label>
        <input id="surveyDate" type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Date de clôture *</label>
        <input id="surveyCloture" type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Critères à évaluer</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
          <label class="flex items-center gap-2 p-3 bg-white border rounded-lg cursor-pointer">
            <input type="checkbox" class="rounded text-blue-600" checked>
            <span>Qualité produit</span>
          </label>
          <label class="flex items-center gap-2 p-3 bg-white border rounded-lg cursor-pointer">
            <input type="checkbox" class="rounded text-blue-600" checked>
            <span>Service livraison</span>
          </label>
          <label class="flex items-center gap-2 p-3 bg-white border rounded-lg cursor-pointer">
            <input type="checkbox" class="rounded text-blue-600" checked>
            <span>Support client</span>
          </label>
          <label class="flex items-center gap-2 p-3 bg-white border rounded-lg cursor-pointer">
            <input type="checkbox" class="rounded text-blue-600">
            <span>Facturation</span>
          </label>
          <label class="flex items-center gap-2 p-3 bg-white border rounded-lg cursor-pointer">
            <input type="checkbox" class="rounded text-blue-600">
            <span>Relation commerciale</span>
          </label>
          <label class="flex items-center gap-2 p-3 bg-white border rounded-lg cursor-pointer">
            <input type="checkbox" class="rounded text-blue-600">
            <span>Traitement réclamations</span>
          </label>
        </div>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Objectif</label>
        <textarea id="surveyObjectif" rows="2" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Objectifs de l'enquête..."></textarea>
      </div>
      <div class="md:col-span-2 text-right space-x-2">
        <button type="button" id="cancelSurvey" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Créer l'enquête
        </button>
      </div>
    </form>
  </div>

  <!-- ===== TABLEAU ENQUÊTES ===== -->
  <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-blue-100 rounded-lg">
        <i class="fa-solid fa-clipboard-list text-blue-600 text-xl"></i>
      </div>
      Historique des enquêtes
    </h2>
    <div class="overflow-x-auto rounded-xl border border-gray-200">
      <table class="w-full border-collapse table-striped table-hover">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 uppercase text-sm">
          <tr>
            <th class="py-4 px-4 text-left font-semibold">Date</th>
            <th class="py-4 px-4 text-left font-semibold">Campagne</th>
            <th class="py-4 px-4 text-left font-semibold">Canal</th>
            <th class="py-4 px-4 text-left font-semibold">Taux réponse</th>
            <th class="py-4 px-4 text-left font-semibold">Satisfaction</th>
            <th class="py-4 px-4 text-left font-semibold">NPS</th>
            <th class="py-4 px-4 text-left font-semibold">Critères évalués</th>
          </tr>
        </thead>
        <tbody id="surveyTable" class="text-gray-700">
          <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
            <td class="py-4 px-4 font-medium">10/09/2025</td>
            <td class="py-4 px-4 font-medium">Livraison T3</td>
            <td class="py-4 px-4">
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-bold">Email</span>
            </td>
            <td class="py-4 px-4">
              <div class="flex items-center gap-2">
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-green-500 h-2 rounded-full" style="width: 78%"></div>
                </div>
                <span class="text-sm">78%</span>
              </div>
            </td>
            <td class="py-4 px-4">
              <span class="text-green-600 font-bold">89%</span>
            </td>
            <td class="py-4 px-4">
              <span class="text-blue-600 font-bold">+44</span>
            </td>
            <td class="py-4 px-4">
              <div class="flex flex-wrap gap-1">
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Qualité</span>
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Livraison</span>
              </div>
            </td>
          </tr>
          <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
            <td class="py-4 px-4 font-medium">15/08/2025</td>
            <td class="py-4 px-4 font-medium">Support après-vente</td>
            <td class="py-4 px-4">
              <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-bold">Portail</span>
            </td>
            <td class="py-4 px-4">
              <div class="flex items-center gap-2">
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                </div>
                <span class="text-sm">65%</span>
              </div>
            </td>
            <td class="py-4 px-4">
              <span class="text-green-600 font-bold">85%</span>
            </td>
            <td class="py-4 px-4">
              <span class="text-blue-600 font-bold">+38</span>
            </td>
            <td class="py-4 px-4">
              <div class="flex flex-wrap gap-1">
                <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Support</span>
                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Réclamations</span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ===== FORMULAIRE RÉCLAMATION CLIENT ===== -->
  <div id="newReclamForm" class="bg-gradient-to-br from-red-50 to-white p-8 rounded-2xl shadow-xl border border-red-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-red-100 rounded-lg">
        <i class="fa-solid fa-envelope text-red-600"></i>
      </div>
      Nouvelle réclamation client
    </h2>
    <form id="reclamForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Client *</label>
        <input id="reclamClient" type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Nom du client" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Date *</label>
        <input id="reclamDate" type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Objet *</label>
        <input id="reclamObjet" type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Objet de la réclamation" required>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Description détaillée *</label>
        <textarea id="reclamDetail" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Décrire précisément la réclamation..." required></textarea>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Critère concerné *</label>
        <select id="reclamCritere" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white" required>
          <option value="">Sélectionner</option>
          <option>Qualité des produits</option>
          <option>Service livraison</option>
          <option>Support client</option>
          <option>Facturation</option>
          <option>Relation commerciale</option>
          <option>Traitement réclamations</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Niveau d'urgence *</label>
        <select id="reclamUrgence" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
          <option>Normal</option>
          <option>Élevé</option>
          <option>Critique</option>
        </select>
      </div>
      <div class="md:col-span-2 flex justify-end gap-3 pt-4">
        <button type="button" id="cancelReclam" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Enregistrer la réclamation
        </button>
      </div>
    </form>
  </div>

  <!-- ===== FORMULAIRE ACTION D'AMÉLIORATION ===== -->
  <div id="newActionForm" class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-xl border border-green-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-green-100 rounded-lg">
        <i class="fa-solid fa-lightbulb text-green-600"></i>
      </div>
      Nouvelle action d'amélioration
    </h2>
    <form id="actionForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 font-medium mb-2">Origine *</label>
        <select id="actionOrigine" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
          <option>Enquête satisfaction</option>
          <option>Réclamation client</option>
          <option>Suggestion client</option>
          <option>Analyse interne</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-2">Responsable *</label>
        <input id="actionResp" type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Nom du responsable" required>
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-2">Échéance *</label>
        <input id="actionDate" type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-2">Critère impacté *</label>
        <select id="actionCritere" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white" required>
          <option value="">Sélectionner</option>
          <option>Qualité des produits</option>
          <option>Service livraison</option>
          <option>Support client</option>
          <option>Facturation</option>
          <option>Relation commerciale</option>
          <option>Traitement réclamations</option>
        </select>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 font-medium mb-2">Description de l'action *</label>
        <textarea id="actionDesc" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Décrire l'action d'amélioration..." required></textarea>
      </div>
      <div class="md:col-span-2 flex justify-end gap-3 pt-4">
        <button type="button" id="cancelAction" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition">Annuler</button>
        <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg transition flex items-center gap-2">
          <i class="fa-solid fa-save"></i> Valider l'action
        </button>
      </div>
    </form>
  </div>

  <!-- ===== BOUTONS D'AJOUT ===== -->
  <div class="flex justify-end gap-4">
    <button id="btnNewReclam" class="btn-glow bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
      <i class="fa-solid fa-envelope"></i> Nouvelle réclamation
    </button>
    <button id="btnNewAction" class="btn-glow bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 font-medium">
      <i class="fa-solid fa-lightbulb"></i> Nouvelle action
    </button>
  </div>

  <!-- ===== GRAPHIQUES ===== -->
  <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold mb-8 text-gray-800 flex items-center gap-3">
      <div class="p-2 bg-blue-100 rounded-lg">
        <i class="fa-solid fa-chart-line text-blue-600 text-xl"></i>
      </div>
      Analyse de la satisfaction client
    </h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
      <div class="chart-container">
        <canvas id="npsChart"></canvas>
        <p class="text-sm text-gray-600 mt-4 font-medium text-center">Évolution du Net Promoter Score</p>
      </div>
      <div class="chart-container">
        <canvas id="satisfactionChart"></canvas>
        <p class="text-sm text-gray-600 mt-4 font-medium text-center">Répartition du niveau de satisfaction</p>
      </div>
    </div>
    
    <!-- Graphique par critère -->
    <div class="mt-10">
      <h3 class="text-xl font-bold mb-6 text-gray-800 flex items-center gap-3">
        <div class="p-2 bg-blue-100 rounded-lg">
          <i class="fa-solid fa-chart-bar text-blue-500"></i>
        </div>
        Satisfaction par critère d'évaluation
      </h3>
      <div class="chart-container">
        <canvas id="critereChart"></canvas>
        <p class="text-sm text-gray-600 mt-4 font-medium text-center">Score moyen par critère (sur 5)</p>
      </div>
    </div>
  </div>
</div>

<script>
// --- Gestion affichage des formulaires
const sForm = document.getElementById('newSurveyForm');
const rForm = document.getElementById('newReclamForm');
const aForm = document.getElementById('newActionForm');
const eForm = document.getElementById('newEvaluationForm');

// Gestion du bouton d'évaluation
document.getElementById('btnNewEvaluation').onclick = () => {
    eForm.style.display = 'block';
    eForm.scrollIntoView({behavior: 'smooth'});
};
document.getElementById('cancelEvaluation').onclick = () => {
    eForm.style.display = 'none';
};

// Gestion des autres boutons
document.getElementById('btnNewSurvey').onclick = () => {
    sForm.style.display = 'block';
    sForm.scrollIntoView({behavior: 'smooth'});
};
document.getElementById('cancelSurvey').onclick = () => {
    sForm.style.display = 'none';
};

document.getElementById('btnNewReclam').onclick = () => {
    rForm.style.display = 'block';
    rForm.scrollIntoView({behavior: 'smooth'});
};
document.getElementById('cancelReclam').onclick = () => {
    rForm.style.display = 'none';
};

document.getElementById('btnNewAction').onclick = () => {
    aForm.style.display = 'block';
    aForm.scrollIntoView({behavior: 'smooth'});
};
document.getElementById('cancelAction').onclick = () => {
    aForm.style.display = 'none';
};

// --- Suivi de la valeur NPS
document.getElementById('evalNPS').addEventListener('input', function() {
    document.getElementById('npsValue').textContent = this.value;
});

// --- Formulaire d'évaluation
document.getElementById('evaluationForm').onsubmit = e => {
    e.preventDefault();
    
    const client = document.getElementById('evalClient').value;
    const nps = document.getElementById('evalNPS').value;
    
    showNotification(`✅ Évaluation enregistrée pour ${client} (NPS: ${nps}/10)`, 'success');
    e.target.reset();
    document.getElementById('npsValue').textContent = '7';
    eForm.style.display = 'none';
};

// --- Formulaire d'enquête
document.getElementById('surveyForm').onsubmit = e => {
    e.preventDefault();
    const title = document.getElementById('surveyTitle').value;
    const canal = document.getElementById('surveyCanal').value;
    const date = document.getElementById('surveyDate').value;
    
    const tbody = document.getElementById('surveyTable');
    const tr = document.createElement('tr');
    tr.className = 'border-b border-gray-100 hover:bg-blue-50/50 transition';
    tr.innerHTML = `
        <td class="py-4 px-4 font-medium">${date}</td>
        <td class="py-4 px-4 font-medium">${title}</td>
        <td class="py-4 px-4">
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-bold">${canal}</span>
        </td>
        <td class="py-4 px-4">
            <div class="flex items-center gap-2">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: ${Math.floor(Math.random()*20)+70}%"></div>
                </div>
                <span class="text-sm">${Math.floor(Math.random()*20)+70}%</span>
            </div>
        </td>
        <td class="py-4 px-4">
            <span class="text-green-600 font-bold">${Math.floor(Math.random()*10)+85}%</span>
        </td>
        <td class="py-4 px-4">
            <span class="text-blue-600 font-bold">+${Math.floor(Math.random()*10)+35}</span>
        </td>
        <td class="py-4 px-4">
            <div class="flex flex-wrap gap-1">
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Qualité</span>
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Livraison</span>
            </div>
        </td>
    `;
    tbody.appendChild(tr);
    
    showNotification('✅ Nouvelle enquête créée avec succès', 'success');
    e.target.reset();
    sForm.style.display = 'none';
};

// --- Formulaire réclamation
document.getElementById('reclamForm').onsubmit = e => {
    e.preventDefault();
    const client = document.getElementById('reclamClient').value;
    showNotification(`⚠️ Réclamation enregistrée pour ${client}`, 'warning');
    e.target.reset();
    rForm.style.display = 'none';
};

// --- Formulaire action
document.getElementById('actionForm').onsubmit = e => {
    e.preventDefault();
    const resp = document.getElementById('actionResp').value;
    showNotification(`💡 Action d'amélioration assignée à ${resp}`, 'success');
    e.target.reset();
    aForm.style.display = 'none';
};

// --- Fonction de notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white font-medium flex items-center gap-3`;
    
    if (type === 'success') {
        notification.style.background = 'linear-gradient(135deg, #10b981, #059669)';
    } else if (type === 'warning') {
        notification.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
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
            filename: 'Satisfaction_Client_Rapport.pdf',
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },
            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
        }).from(document.querySelector('.space-y-10')).save();
        
        setTimeout(() => {
            showNotification('✅ PDF exporté avec succès', 'success');
        }, 1000);
    }, 500);
};

// --- Initialisation des graphiques
let npsChartInstance, satisfactionChartInstance, critereChartInstance;

function initCharts() {
    // Détruire les anciennes instances
    if (npsChartInstance) npsChartInstance.destroy();
    if (satisfactionChartInstance) satisfactionChartInstance.destroy();
    if (critereChartInstance) critereChartInstance.destroy();
    
    // Graphique NPS
    npsChartInstance = new Chart(document.getElementById('npsChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'NPS',
                data: [32, 34, 36, 38, 40, 41, 42, 43, 44, 45, 46, 47],
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {legend: {display: false}},
            scales: {
                y: {
                    beginAtZero: false,
                    min: 30,
                    max: 50,
                    grid: {color: 'rgba(0, 0, 0, 0.05)'}
                },
                x: {
                    grid: {display: false}
                }
            }
        }
    });
    
    // Graphique satisfaction
    satisfactionChartInstance = new Chart(document.getElementById('satisfactionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Très satisfait', 'Satisfait', 'Neutre', 'Insatisfait'],
            datasets: [{
                data: [45, 35, 15, 5],
                backgroundColor: ['#16A34A', '#60A5FA', '#FBBF24', '#EF4444'],
                borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff'],
                borderWidth: 3,
                hoverOffset: 20
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
                        font: {size: 12}
                    }
                }
            },
            cutout: '65%'
        }
    });
    
    // Graphique par critère
    critereChartInstance = new Chart(document.getElementById('critereChart'), {
        type: 'bar',
        data: {
            labels: ['Qualité', 'Livraison', 'Support', 'Facturation', 'Relation', 'Réclamations'],
            datasets: [{
                label: 'Score moyen',
                data: [4.5, 4.2, 4.0, 4.3, 4.4, 3.8],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(234, 179, 8, 0.8)',
                    'rgba(99, 102, 241, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    'rgb(59, 130, 246)',
                    'rgb(34, 197, 94)',
                    'rgb(168, 85, 247)',
                    'rgb(234, 179, 8)',
                    'rgb(99, 102, 241)',
                    'rgb(239, 68, 68)'
                ],
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    ticks: {stepSize: 1},
                    grid: {color: 'rgba(0, 0, 0, 0.05)'}
                },
                x: {
                    grid: {display: false}
                }
            },
            plugins: {
                legend: {display: false},
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Score: ${context.raw}/5`;
                        }
                    }
                }
            }
        }
    });
}

// Initialiser les graphiques
document.addEventListener('DOMContentLoaded', function() {
    initCharts();
    
    // Mettre à jour les dates par défaut
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('surveyDate').value = today;
    document.getElementById('reclamDate').value = today;
    document.getElementById('actionDate').value = today;
    document.getElementById('evalDate').value = today;
    
    // Date de clôture par défaut (30 jours)
    const cloture = new Date();
    cloture.setDate(cloture.getDate() + 30);
    document.getElementById('surveyCloture').value = cloture.toISOString().split('T')[0];
    
    // Date d'échéance par défaut (15 jours)
    const deadline = new Date();
    deadline.setDate(deadline.getDate() + 15);
    document.getElementById('actionDate').value = deadline.toISOString().split('T')[0];
});
</script>
@endsection