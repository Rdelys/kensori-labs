@extends('layouts.clients')

@section('title', 'Non-conformités / CAPA')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.compact-table th, .compact-table td { padding: 0.5rem 0.75rem; font-size: 0.875rem; }
.compact-card { padding: 1rem; }
.small-text { font-size: 0.75rem; }
.medium-text { font-size: 0.875rem; }
</style>

<div class="space-y-6 fade-in p-4">

  <!-- HEADER -->
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b pb-3 gap-3">
    <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
      <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
      Non-conformités & CAPA
    </h1>
    <div class="flex flex-wrap items-center gap-2">
      <button onclick="openNewNCModal()" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg shadow text-sm flex items-center gap-1">
        <i class="fa-solid fa-plus"></i>Nouvelle NC
      </button>
      <button onclick="openNewCAPAModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg shadow text-sm flex items-center gap-1">
        <i class="fa-solid fa-tools"></i>Créer CAPA
      </button>
      <div class="bg-gray-50 border rounded-lg p-2 text-xs text-gray-600">
        Version statique — Données d'exemple
      </div>
    </div>
  </div>

  <!-- KPI CARDS -->
  <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <div class="bg-white shadow rounded-xl compact-card text-center">
      <p class="small-text text-gray-500">NC actives</p>
      <h3 class="text-2xl font-bold text-red-600">7</h3>
      <p class="small-text text-gray-400 mt-1">Non résolues</p>
    </div>
    <div class="bg-white shadow rounded-xl compact-card text-center">
      <p class="small-text text-gray-500">CAPA en cours</p>
      <h3 class="text-2xl font-bold text-yellow-600">5</h3>
      <p class="small-text text-gray-400 mt-1">En implémentation</p>
    </div>
    <div class="bg-white shadow rounded-xl compact-card text-center">
      <p class="small-text text-gray-500">CAPA vérifiées</p>
      <h3 class="text-2xl font-bold text-green-600">12</h3>
      <p class="small-text text-gray-400 mt-1">Efficacité confirmée</p>
    </div>
    <div class="bg-white shadow rounded-xl compact-card text-center">
      <p class="small-text text-gray-500">Temps moyen</p>
      <h3 class="text-2xl font-bold text-purple-600">14 j</h3>
      <p class="small-text text-gray-400 mt-1">de résolution</p>
    </div>
    <div class="bg-white shadow rounded-xl compact-card text-center">
      <p class="small-text text-gray-500">Échéances</p>
      <h3 class="text-2xl font-bold text-orange-600">3</h3>
      <p class="small-text text-gray-400 mt-1">Cette semaine</p>
    </div>
  </div>

  <!-- CALENDRIER ÉCHÉANCES -->
  <div class="bg-white shadow rounded-xl p-4">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 gap-2">
      <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
        <i class="fa-solid fa-calendar-days text-orange-500"></i> Calendrier CAPA
      </h2>
      <button onclick="openEcheanceModal()" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1.5 rounded-lg shadow text-sm flex items-center gap-1">
        <i class="fa-solid fa-plus"></i> Ajouter échéance
      </button>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      <!-- Échéances à venir -->
      <div class="border rounded-lg p-3 bg-orange-50">
        <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-1 small-text">
          <i class="fa-solid fa-clock text-orange-500"></i> Cette semaine
        </h3>
        <div class="space-y-2">
          <div class="p-2 bg-white border border-orange-200 rounded">
            <div class="flex justify-between items-start">
              <div>
                <span class="font-medium medium-text">CAPA-014</span>
                <p class="small-text text-gray-600 mt-1">Réglage machine + formation</p>
              </div>
              <span class="px-1.5 py-0.5 bg-orange-100 text-orange-800 rounded-full text-xs font-bold">25/10</span>
            </div>
            <div class="mt-1 flex items-center small-text text-gray-500">
              <i class="fa-solid fa-user mr-1"></i>
              <span>R. Andrian</span>
            </div>
          </div>
          
          <div class="p-2 bg-white border border-orange-200 rounded">
            <div class="flex justify-between items-start">
              <div>
                <span class="font-medium medium-text">CAPA-016</span>
                <p class="small-text text-gray-600 mt-1">Procédures qualité</p>
              </div>
              <span class="px-1.5 py-0.5 bg-orange-100 text-orange-800 rounded-full text-xs font-bold">27/10</span>
            </div>
            <div class="mt-1 flex items-center small-text text-gray-500">
              <i class="fa-solid fa-user mr-1"></i>
              <span>M. Dupont</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Échéances du mois -->
      <div class="border rounded-lg p-3 bg-blue-50">
        <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-1 small-text">
          <i class="fa-solid fa-calendar-alt text-blue-500"></i> Ce mois
        </h3>
        <div class="space-y-2">
          <div class="p-2 bg-white border border-blue-200 rounded">
            <div class="flex justify-between items-start">
              <div>
                <span class="font-medium medium-text">CAPA-009</span>
                <p class="small-text text-gray-600 mt-1">Formation opérateurs</p>
              </div>
              <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">30/10</span>
            </div>
            <div class="mt-1 flex items-center small-text text-gray-500">
              <i class="fa-solid fa-user mr-1"></i>
              <span>H. Jean</span>
              <span class="ml-2 px-1.5 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">En cours</span>
            </div>
          </div>
          
          <div class="p-2 bg-white border border-blue-200 rounded">
            <div class="flex justify-between items-start">
              <div>
                <span class="font-medium medium-text">CAPA-017</span>
                <p class="small-text text-gray-600 mt-1">Audit fournisseurs</p>
              </div>
              <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">15/11</span>
            </div>
            <div class="mt-1 flex items-center small-text text-gray-500">
              <i class="fa-solid fa-user mr-1"></i>
              <span>L. Martin</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Échéances dépassées -->
      <div class="border rounded-lg p-3 bg-red-50">
        <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-1 small-text">
          <i class="fa-solid fa-exclamation-triangle text-red-500"></i> Dépassées
        </h3>
        <div class="space-y-2">
          <div class="p-2 bg-white border border-red-200 rounded">
            <div class="flex justify-between items-start">
              <div>
                <span class="font-medium medium-text">CAPA-012</span>
                <p class="small-text text-gray-600 mt-1">Documentation qualité</p>
              </div>
              <span class="px-1.5 py-0.5 bg-red-100 text-red-800 rounded-full text-xs font-bold">10/10</span>
            </div>
            <div class="mt-1 flex items-center justify-between">
              <div class="flex items-center small-text text-gray-500">
                <i class="fa-solid fa-user mr-1"></i>
                <span>P. Leroy</span>
              </div>
              <button onclick="openEcheanceReporter('CAPA-012')" class="text-xs text-blue-600 hover:text-blue-800">
                Reporter
              </button>
            </div>
          </div>
          
          <div class="p-2 bg-white border border-red-200 rounded">
            <div class="flex justify-between items-start">
              <div>
                <span class="font-medium medium-text">CAPA-013</span>
                <p class="small-text text-gray-600 mt-1">Contrôles supplémentaires</p>
              </div>
              <span class="px-1.5 py-0.5 bg-red-100 text-red-800 rounded-full text-xs font-bold">05/10</span>
            </div>
            <div class="mt-1 flex items-center justify-between">
              <div class="flex items-center small-text text-gray-500">
                <i class="fa-solid fa-user mr-1"></i>
                <span>S. Dubois</span>
              </div>
              <button onclick="openEcheanceReporter('CAPA-013')" class="text-xs text-blue-600 hover:text-blue-800">
                Reporter
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Graphique -->
    <div class="mt-4">
      <h3 class="font-semibold text-gray-700 mb-2 small-text">Planning des échéances</h3>
      <div class="h-48">
        <canvas id="echeancesChart"></canvas>
      </div>
    </div>
  </div>

  <!-- TABLEAU NC -->
  <div class="bg-white shadow rounded-xl p-4">
    <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-700">
      <i class="fa-solid fa-list-ul text-red-500"></i> Liste des NC
    </h2>

    <div class="overflow-x-auto">
      <table class="w-full text-sm compact-table">
        <thead class="bg-gray-100 text-gray-600 uppercase small-text">
          <tr>
            <th class="p-2 text-left">ID</th>
            <th class="p-2 text-left">Date</th>
            <th class="p-2 text-left">Processus</th>
            <th class="p-2 text-left">Description</th>
            <th class="p-2 text-left">Gravité</th>
            <th class="p-2 text-left">État</th>
            <th class="p-2 text-left">CAPA</th>
            <th class="p-2 text-left">Échéance</th>
            <th class="p-2 text-right">Actions</th>
          </tr>
        </thead>
        <tbody id="ncTableBody" class="divide-y text-gray-700 medium-text">
          <tr>
            <td class="p-2 font-medium">NC-021</td>
            <td class="p-2">03/10</td>
            <td class="p-2">Production</td>
            <td class="p-2">Produit hors tolérance</td>
            <td class="p-2">Élevée</td>
            <td class="p-2"><span class="px-1.5 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">Investigation</span></td>
            <td class="p-2"><a href="#" class="text-blue-600 hover:underline small-text">CAPA-014</a></td>
            <td class="p-2"><span class="px-1.5 py-0.5 bg-orange-100 text-orange-800 rounded-full text-xs">25/10</span></td>
            <td class="p-2 text-right">
              <button onclick="open5WhyModal('NC-021')" class="text-indigo-600 hover:text-indigo-800 mx-1" title="5 Pourquoi"><i class="fa-solid fa-question small-text"></i></button>
              <button onclick="openIshikawaModal('NC-021')" class="text-amber-600 hover:text-amber-800 mx-1" title="Ishikawa"><i class="fa-solid fa-network-wired small-text"></i></button>
              <button onclick="openNcView('NC-021')" class="text-green-600 hover:text-green-800 mx-1" title="Voir"><i class="fa-solid fa-eye small-text"></i></button>
              <button onclick="openActionFromNcModal('NC-021')" class="text-red-600 hover:text-red-800 mx-1" title="Créer action"><i class="fa-solid fa-plus small-text"></i></button>
            </td>
          </tr>

          <tr>
            <td class="p-2 font-medium">NC-019</td>
            <td class="p-2">25/09</td>
            <td class="p-2">Achats</td>
            <td class="p-2">Fourniture non conforme</td>
            <td class="p-2">Moyenne</td>
            <td class="p-2"><span class="px-1.5 py-0.5 bg-red-100 text-red-800 rounded-full text-xs">Ouverte</span></td>
            <td class="p-2"><span class="text-gray-400 small-text">—</span></td>
            <td class="p-2"><span class="px-1.5 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">Non définie</span></td>
            <td class="p-2 text-right">
              <button onclick="open5WhyModal('NC-019')" class="text-indigo-600 hover:text-indigo-800 mx-1"><i class="fa-solid fa-question small-text"></i></button>
              <button onclick="openIshikawaModal('NC-019')" class="text-amber-600 hover:text-amber-800 mx-1"><i class="fa-solid fa-network-wired small-text"></i></button>
              <button onclick="openNcView('NC-019')" class="text-green-600 hover:text-green-800 mx-1"><i class="fa-solid fa-eye small-text"></i></button>
              <button onclick="openActionFromNcModal('NC-019')" class="text-red-600 hover:text-red-800 mx-1"><i class="fa-solid fa-plus small-text"></i></button>
            </td>
          </tr>

          <tr>
            <td class="p-2 font-medium">NC-017</td>
            <td class="p-2">12/09</td>
            <td class="p-2">Support</td>
            <td class="p-2">Erreur ticket client</td>
            <td class="p-2">Faible</td>
            <td class="p-2"><span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded-full text-xs">Clôturée</span></td>
            <td class="p-2"><a href="#" class="text-blue-600 hover:underline small-text">CAPA-011</a></td>
            <td class="p-2"><span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded-full text-xs">Terminée</span></td>
            <td class="p-2 text-right">
              <button onclick="open5WhyModal('NC-017')" class="text-indigo-600 hover:text-indigo-800 mx-1"><i class="fa-solid fa-question small-text"></i></button>
              <button onclick="openIshikawaModal('NC-017')" class="text-amber-600 hover:text-amber-800 mx-1"><i class="fa-solid fa-network-wired small-text"></i></button>
              <button onclick="openNcView('NC-017')" class="text-green-600 hover:text-green-800 mx-1"><i class="fa-solid fa-eye small-text"></i></button>
              <button onclick="openActionFromNcModal('NC-017')" class="text-red-600 hover:text-red-800 mx-1"><i class="fa-solid fa-plus small-text"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- SYNTHÈSE CAPA -->
    <div class="mt-4 border-t pt-3">
      <h3 class="font-semibold text-gray-700 mb-2 small-text">Synthèse CAPA</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="p-3 bg-gray-50 rounded border border-orange-200">
          <div class="flex justify-between items-start">
            <div>
              <div class="small-text text-gray-500">CAPA-014</div>
              <div class="font-semibold mt-1 medium-text">Réglage machine + formation</div>
            </div>
            <span class="px-1.5 py-0.5 bg-orange-100 text-orange-800 rounded-full text-xs">25/10</span>
          </div>
          <div class="small-text text-gray-400 mt-1">R. Andrian</div>
          <div class="text-sm mt-2"><span class="px-1.5 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">En cours</span></div>
          <div class="mt-2 flex gap-1">
            <button onclick="openCapaActionModal('CAPA-014')" class="px-2 py-1 bg-blue-600 text-white rounded text-xs flex-1">Vérifier</button>
            <button onclick="openEcheanceReporter('CAPA-014')" class="px-2 py-1 bg-gray-600 text-white rounded text-xs">Reporter</button>
          </div>
        </div>
        
        <div class="p-3 bg-gray-50 rounded border border-green-200">
          <div class="flex justify-between items-start">
            <div>
              <div class="small-text text-gray-500">CAPA-011</div>
              <div class="font-semibold mt-1 medium-text">Contrôle qualité</div>
            </div>
            <span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded-full text-xs">Terminée</span>
          </div>
          <div class="small-text text-gray-400 mt-1">L. Razan</div>
          <div class="text-sm mt-2"><span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded-full text-xs">Vérifiée</span></div>
          <div class="mt-2">
            <button onclick="openCapaActionModal('CAPA-011')" class="w-full px-2 py-1 bg-blue-600 text-white rounded text-xs">Ajouter vérif</button>
          </div>
        </div>
        
        <div class="p-3 bg-gray-50 rounded border border-blue-200">
          <div class="flex justify-between items-start">
            <div>
              <div class="small-text text-gray-500">CAPA-009</div>
              <div class="font-semibold mt-1 medium-text">Formation opérateurs</div>
            </div>
            <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs">30/10</span>
          </div>
          <div class="small-text text-gray-400 mt-1">H. Jean</div>
          <div class="text-sm mt-2"><span class="px-1.5 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">En cours</span></div>
          <div class="mt-2 flex gap-1">
            <button onclick="openCapaActionModal('CAPA-009')" class="px-2 py-1 bg-blue-600 text-white rounded text-xs flex-1">Suivi</button>
            <button onclick="openEcheanceReporter('CAPA-009')" class="px-2 py-1 bg-gray-600 text-white rounded text-xs">Reporter</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ANALYSES GRAPHIQUES -->
  <div class="bg-white shadow rounded-xl p-4">
    <h2 class="text-lg font-semibold mb-3 text-gray-700 flex items-center gap-2">
        <i class="fa-solid fa-chart-simple text-gray-700"></i> Analyses & Pareto
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- CAMEMBERT -->
        <div class="flex flex-col items-center">
            <label class="small-text text-gray-600 mb-2">Répartition NC</label>
            <div class="w-64 h-64">
                <canvas id="ncDistributionChart"></canvas>
            </div>
        </div>

        <!-- PARETO -->
        <div class="flex flex-col items-center">
            <label class="small-text text-gray-600 mb-2">Diagramme Pareto</label>
            <div class="w-full h-64">
                <canvas id="paretoChart"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <button onclick="exportSummary()" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg text-sm">
            <i class="fa-solid fa-file-export mr-1"></i>Exporter synthèse (PDF fictif)
        </button>
    </div>
  </div>

  <!-- 5 WHY & ISHIKAWA -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <!-- 5 WHY -->
    <div class="bg-white shadow rounded-xl p-4">
      <h3 class="font-semibold mb-2 text-gray-700"><i class="fa-solid fa-question text-indigo-600"></i> 5 Pourquoi — NC-021</h3>
      <p class="small-text text-gray-500 mb-3">Analyse complète enregistrée</p>

      <div class="space-y-1.5">
        <div class="p-2 border rounded bg-gray-50">
          <div class="small-text text-gray-500">Pourquoi 1</div>
          <div class="font-medium medium-text">Réglage machine incorrect</div>
        </div>
        <div class="p-2 border rounded bg-gray-50">
          <div class="small-text text-gray-500">Pourquoi 2</div>
          <div class="font-medium medium-text">Gabarit obsolète utilisé</div>
        </div>
        <div class="p-2 border rounded bg-gray-50">
          <div class="small-text text-gray-500">Pourquoi 3</div>
          <div class="font-medium medium-text">Procédure non diffusée</div>
        </div>
        <div class="p-2 border rounded bg-gray-50">
          <div class="small-text text-gray-500">Pourquoi 4</div>
          <div class="font-medium medium-text">Pas d'accusé de lecture</div>
        </div>
        <div class="p-2 border rounded bg-gray-50">
          <div class="small-text text-gray-500">Pourquoi 5 (racine)</div>
          <div class="font-medium text-red-600 medium-text">Absence workflow documentaire</div>
        </div>
      </div>

      <div class="mt-3 flex gap-2">
        <button onclick="openActionFrom5Why('NC-021')" class="px-3 py-1.5 bg-indigo-600 text-white rounded text-sm">Créer CAPA</button>
        <button onclick="open5WhyEdit('NC-021')" class="px-3 py-1.5 border rounded text-gray-700 text-sm">Éditer</button>
      </div>
    </div>

    <!-- ISHIKAWA -->
    <div class="bg-white shadow rounded-xl p-4">
      <h3 class="font-semibold mb-2 text-gray-700"><i class="fa-solid fa-network-wired text-amber-600"></i> Ishikawa — NC-019</h3>
      <p class="small-text text-gray-500 mb-3">Causes par catégorie 6M</p>

      <div class="grid grid-cols-2 gap-2">
        <div class="border rounded p-2 bg-gray-50">
          <div class="small-text text-gray-500">Méthode</div>
          <ul class="mt-1 text-gray-700 small-text list-disc list-inside">
            <li>Procédure non respectée</li>
            <li>Instructions incomplètes</li>
          </ul>
        </div>
        <div class="border rounded p-2 bg-gray-50">
          <div class="small-text text-gray-500">Matière</div>
          <ul class="mt-1 text-gray-700 small-text list-disc list-inside">
            <li>Variabilité fournisseur</li>
          </ul>
        </div>

        <div class="border rounded p-2 bg-gray-50">
          <div class="small-text text-gray-500">Main-d'œuvre</div>
          <ul class="mt-1 text-gray-700 small-text list-disc list-inside">
            <li>Opérateur non formé</li>
          </ul>
        </div>
        <div class="border rounded p-2 bg-gray-50">
          <div class="small-text text-gray-500">Milieu</div>
          <ul class="mt-1 text-gray-700 small-text list-disc list-inside">
            <li>Stockage non conforme</li>
          </ul>
        </div>

        <div class="border rounded p-2 bg-gray-50">
          <div class="small-text text-gray-500">Matériel</div>
          <ul class="mt-1 text-gray-700 small-text list-disc list-inside">
            <li>Outillage mal étalonné</li>
          </ul>
        </div>
        <div class="border rounded p-2 bg-gray-50">
          <div class="small-text text-gray-500">Mesure</div>
          <ul class="mt-1 text-gray-700 small-text list-disc list-inside">
            <li>Étalonnage non à jour</li>
          </ul>
        </div>
      </div>

      <div class="mt-3 flex gap-2">
        <button onclick="openActionFromIshikawa('NC-019')" class="px-3 py-1.5 bg-amber-600 text-white rounded text-sm">Créer action</button>
        <button onclick="generateIshikawaPdf()" class="px-3 py-1.5 border rounded text-gray-700 text-sm">Exporter</button>
      </div>
    </div>
  </div>

  <!-- VÉRIFICATION EFFICACITÉ -->
  <div class="bg-white shadow rounded-xl p-4">
    <h3 class="font-semibold mb-2 text-gray-700"><i class="fa-solid fa-check-double text-green-600"></i> Vérification CAPA</h3>
    <p class="small-text text-gray-500 mb-3">Vérifications réalisées</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
      <div class="p-3 bg-gray-50 rounded">
        <div class="small-text text-gray-500">CAPA-014</div>
        <div class="font-semibold mt-1 small-text">Vérifié le 10/10</div>
        <div class="mt-1 small-text"><strong class="text-green-600">Efficace</strong></div>
      </div>
      <div class="p-3 bg-gray-50 rounded">
        <div class="small-text text-gray-500">CAPA-011</div>
        <div class="font-semibold mt-1 small-text">Vérifié le 20/09</div>
        <div class="mt-1 small-text"><strong class="text-green-600">Efficace</strong></div>
      </div>
      <div class="p-3 bg-gray-50 rounded">
        <div class="small-text text-gray-500">CAPA-009</div>
        <div class="font-semibold mt-1 small-text">Vérifié le 30/09</div>
        <div class="mt-1 small-text"><strong class="text-yellow-600">Partiellement</strong></div>
      </div>
    </div>

    <div class="mt-4">
      <h4 class="font-semibold text-gray-700 mb-2 small-text">Historique</h4>
      <div class="overflow-x-auto">
        <table class="w-full text-sm compact-table">
          <thead class="bg-gray-100 text-gray-600 small-text">
            <tr>
              <th class="p-2 text-left">CAPA</th>
              <th class="p-2 text-left">Date</th>
              <th class="p-2 text-left">Critère</th>
              <th class="p-2 text-left">Résultat</th>
            </tr>
          </thead>
          <tbody id="capaVerificationTable" class="divide-y text-gray-700 small-text">
            <tr>
              <td class="p-2">CAPA-014</td>
              <td class="p-2">10/10</td>
              <td class="p-2">&lt;1 NC / 30j</td>
              <td class="p-2"><span class="text-green-600 font-semibold">Efficace</span></td>
            </tr>
            <tr>
              <td class="p-2">CAPA-011</td>
              <td class="p-2">20/09</td>
              <td class="p-2">Rejet &lt; 1%</td>
              <td class="p-2"><span class="text-green-600 font-semibold">Efficace</span></td>
            </tr>
            <tr>
              <td class="p-2">CAPA-009</td>
              <td class="p-2">30/09</td>
              <td class="p-2">100% formés</td>
              <td class="p-2"><span class="text-yellow-600 font-semibold">Partiel</span></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        <button onclick="openCapaVerifyModal()" class="px-3 py-1.5 bg-green-600 text-white rounded text-sm">Ajouter vérification</button>
      </div>
    </div>
  </div>

</div>

<!-- MODALS COMPACT -->
<!-- New NC -->
<div id="newNcModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-5 relative">
    <h3 class="text-lg font-semibold mb-3">Nouvelle NC</h3>
    <button onclick="closeNewNCModal()" class="absolute top-3 right-3 text-gray-500"><i class="fa-solid fa-xmark"></i></button>
    <form id="newNcForm" class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div><label class="small-text text-gray-600">Processus</label><input id="ncProcess" type="text" class="w-full border rounded p-2 text-sm" value="Production"></div>
      <div><label class="small-text text-gray-600">Date</label><input id="ncDate" type="date" class="w-full border rounded p-2 text-sm" value="2025-10-18"></div>
      <div class="md:col-span-2"><label class="small-text text-gray-600">Description</label><textarea id="ncDescription" class="w-full border rounded p-2 text-sm" rows="2">Pièce hors tolérance</textarea></div>
      <div><label class="small-text text-gray-600">Gravité</label><select id="ncSeverity" class="w-full border rounded p-2 text-sm"><option>Faible</option><option selected>Moyenne</option><option>Élevée</option></select></div>
      <div><label class="small-text text-gray-600">Source</label><input id="ncSource" type="text" class="w-full border rounded p-2 text-sm" value="Audit Interne"></div>
      <div class="md:col-span-2 flex justify-end gap-2 pt-3">
        <button type="button" onclick="closeNewNCModal()" class="px-3 py-1.5 border rounded text-gray-600 text-sm">Annuler</button>
        <button type="submit" class="px-3 py-1.5 bg-red-600 text-white rounded text-sm">Créer NC</button>
      </div>
    </form>
  </div>
</div>

<!-- New CAPA -->
<div id="newCapaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-5 relative">
    <h3 class="text-lg font-semibold mb-3">Nouvelle CAPA</h3>
    <button onclick="closeNewCAPAModal()" class="absolute top-3 right-3 text-gray-500"><i class="fa-solid fa-xmark"></i></button>
    <form id="newCapaForm" class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div><label class="small-text text-gray-600">NC associée</label><input id="capaNc" type="text" class="w-full border rounded p-2 text-sm" value="NC-021"></div>
      <div><label class="small-text text-gray-600">Responsable</label><input id="capaResp" type="text" class="w-full border rounded p-2 text-sm" value="R. Andrian"></div>
      <div class="md:col-span-2"><label class="small-text text-gray-600">Action corrective</label><textarea id="capaAction" class="w-full border rounded p-2 text-sm" rows="2">Réglage machine ; formation ; documentation</textarea></div>
      <div><label class="small-text text-gray-600">Date cible</label><input id="capaDate" type="date" class="w-full border rounded p-2 text-sm" value="2025-10-30" required></div>
      <div><label class="small-text text-gray-600">Priorité</label><select id="capaPriority" class="w-full border rounded p-2 text-sm"><option selected>Haute</option><option>Normale</option><option>Basse</option></select></div>
      <div class="md:col-span-2 flex justify-end gap-2 pt-3">
        <button type="button" onclick="closeNewCAPAModal()" class="px-3 py-1.5 border rounded text-gray-600 text-sm">Annuler</button>
        <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white rounded text-sm">Créer CAPA</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL ÉCHÉANCE -->
<div id="echeanceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-5 relative">
    <h3 class="text-lg font-semibold mb-3">Nouvelle échéance</h3>
    <button onclick="closeEcheanceModal()" class="absolute top-3 right-3 text-gray-500"><i class="fa-solid fa-xmark"></i></button>
    <form id="echeanceForm" class="space-y-3">
      <div><label class="small-text text-gray-600">CAPA</label><select id="echeanceCapa" class="w-full border rounded p-2 text-sm"><option value="">Sélectionner...</option><option>CAPA-014</option><option>CAPA-009</option></select></div>
      <div><label class="small-text text-gray-600">Date *</label><input id="echeanceDate" type="date" class="w-full border rounded p-2 text-sm" required></div>
      <div><label class="small-text text-gray-600">Responsable *</label><input id="echeanceResponsable" type="text" class="w-full border rounded p-2 text-sm" placeholder="Nom" required></div>
      <div><label class="small-text text-gray-600">Commentaire</label><textarea id="echeanceComment" class="w-full border rounded p-2 text-sm" rows="2" placeholder="Notes..."></textarea></div>
      <div class="flex justify-end gap-2 pt-3">
        <button type="button" onclick="closeEcheanceModal()" class="px-3 py-1.5 border rounded text-gray-600 text-sm">Annuler</button>
        <button type="submit" class="px-3 py-1.5 bg-orange-600 text-white rounded text-sm">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL REPORTER -->
<div id="reporterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-sm p-5 relative">
    <h3 class="text-lg font-semibold mb-3">Reporter échéance</h3>
    <button onclick="closeReporterModal()" class="absolute top-3 right-3 text-gray-500"><i class="fa-solid fa-xmark"></i></button>
    <form id="reporterForm" class="space-y-3">
      <div><label class="small-text text-gray-600">CAPA</label><input id="reporterCapa" type="text" class="w-full border rounded p-2 text-sm bg-gray-50" readonly></div>
      <div><label class="small-text text-gray-600">Nouvelle date</label><input id="reporterDate" type="date" class="w-full border rounded p-2 text-sm" required></div>
      <div><label class="small-text text-gray-600">Motif</label><select id="reporterMotif" class="w-full border rounded p-2 text-sm"><option>Retard fournisseur</option><option>Indisponibilité</option><option>Technique</option></select></div>
      <div class="flex justify-end gap-2 pt-3">
        <button type="button" onclick="closeReporterModal()" class="px-3 py-1.5 border rounded text-gray-600 text-sm">Annuler</button>
        <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white rounded text-sm">Reporter</button>
      </div>
    </form>
  </div>
</div>

<!-- AUTRES MODALS (version compacte) -->
<div id="fiveWhyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-5 relative max-h-[90vh] overflow-y-auto">
    <h3 class="text-lg font-semibold mb-3">5 Pourquoi — <span id="fwNcId">NC-XXX</span></h3>
    <button onclick="close5WhyModal()" class="absolute top-3 right-3 text-gray-500"><i class="fa-solid fa-xmark"></i></button>
    <form id="fiveWhyForm" class="space-y-3">
      <input id="fwHiddenNc" type="hidden" value="">
      <div><label class="small-text text-gray-600">Pourquoi 1</label><input id="fw1" type="text" class="w-full border rounded p-2 text-sm" value="Réglage machine incorrect"></div>
      <div><label class="small-text text-gray-600">Pourquoi 2</label><input id="fw2" type="text" class="w-full border rounded p-2 text-sm" value="Gabarit obsolète"></div>
      <div><label class="small-text text-gray-600">Pourquoi 3</label><input id="fw3" type="text" class="w-full border rounded p-2 text-sm" value="Procédure non diffusée"></div>
      <div><label class="small-text text-gray-600">Pourquoi 4</label><input id="fw4" type="text" class="w-full border rounded p-2 text-sm" value="Pas d'accusé de lecture"></div>
      <div><label class="small-text text-gray-600">Pourquoi 5</label><input id="fw5" type="text" class="w-full border rounded p-2 text-sm" value="Absence workflow documentaire"></div>
      <div class="flex justify-between gap-2 pt-3">
        <button type="button" onclick="openActionFrom5Why(document.getElementById('fwHiddenNc').value)" class="px-3 py-1.5 bg-red-600 text-white rounded text-sm">Créer action</button>
        <div class="flex gap-2">
          <button type="button" onclick="close5WhyModal()" class="px-3 py-1.5 border rounded text-gray-600 text-sm">Fermer</button>
          <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white rounded text-sm">Sauvegarder</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="actionFromNcModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-sm p-5 relative">
    <h3 class="text-lg font-semibold mb-3">Action — <span id="afnNcId">NC-XXX</span></h3>
    <button onclick="closeActionFromNcModal()" class="absolute top-3 right-3 text-gray-500"><i class="fa-solid fa-xmark"></i></button>
    <form id="actionFromNcForm" class="space-y-3">
      <input id="afnHiddenNc" type="hidden" value="">
      <div><label class="small-text text-gray-600">Type</label><select id="afnType" class="w-full border rounded p-2 text-sm"><option>Corrective</option><option>Préventive</option></select></div>
      <div><label class="small-text text-gray-600">Responsable</label><input id="afnResp" type="text" class="w-full border rounded p-2 text-sm" placeholder="Nom"></div>
      <div><label class="small-text text-gray-600">Échéance</label><input id="afnDate" type="date" class="w-full border rounded p-2 text-sm" required></div>
      <div><label class="small-text text-gray-600">Description</label><textarea id="afnDesc" class="w-full border rounded p-2 text-sm" rows="2" placeholder="Description..."></textarea></div>
      <div class="flex justify-end gap-2 pt-3">
        <button type="button" onclick="closeActionFromNcModal()" class="px-3 py-1.5 border rounded text-gray-600 text-sm">Annuler</button>
        <button type="submit" class="px-3 py-1.5 bg-red-600 text-white rounded text-sm">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

<script>
  /* ========== GESTION ÉCHÉANCES ========== */
  function openEcheanceModal() {
    document.getElementById('echeanceModal').classList.remove('hidden');
    const today = new Date();
    const nextWeek = new Date(today);
    nextWeek.setDate(today.getDate() + 7);
    document.getElementById('echeanceDate').value = nextWeek.toISOString().split('T')[0];
  }
  
  function closeEcheanceModal() { document.getElementById('echeanceModal').classList.add('hidden'); }
  
  function openEcheanceReporter(capaId) {
    document.getElementById('reporterCapa').value = capaId;
    const today = new Date();
    const twoWeeks = new Date(today);
    twoWeeks.setDate(today.getDate() + 14);
    document.getElementById('reporterDate').value = twoWeeks.toISOString().split('T')[0];
    document.getElementById('reporterModal').classList.remove('hidden');
  }
  
  function closeReporterModal() { document.getElementById('reporterModal').classList.add('hidden'); }
  
  document.getElementById('echeanceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const capa = document.getElementById('echeanceCapa').value;
    const date = document.getElementById('echeanceDate').value;
    const responsable = document.getElementById('echeanceResponsable').value;
    
    if (!capa || !date || !responsable) {
      alert('Remplissez tous les champs');
      return;
    }
    
    const echeancesSection = document.querySelector('.bg-orange-50 .space-y-2');
    if (echeancesSection) {
      const newEcheance = document.createElement('div');
      newEcheance.className = 'p-2 bg-white border border-orange-200 rounded';
      newEcheance.innerHTML = `
        <div class="flex justify-between items-start">
          <div>
            <span class="font-medium medium-text">${capa}</span>
            <p class="small-text text-gray-600 mt-1">Nouvelle échéance</p>
          </div>
          <span class="px-1.5 py-0.5 bg-orange-100 text-orange-800 rounded-full text-xs">${formatDate(date)}</span>
        </div>
        <div class="mt-1 flex items-center small-text text-gray-500">
          <i class="fa-solid fa-user mr-1"></i><span>${responsable}</span>
        </div>
      `;
      echeancesSection.appendChild(newEcheance);
    }
    
    updateEcheanceCount();
    alert(`✅ Échéance ajoutée pour ${capa}`);
    e.target.reset();
    closeEcheanceModal();
  });
  
  document.getElementById('reporterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const capa = document.getElementById('reporterCapa').value;
    const newDate = document.getElementById('reporterDate').value;
    const motif = document.getElementById('reporterMotif').value;
    
    const overdueSection = document.querySelector('.bg-red-50 .space-y-2');
    if (overdueSection) {
      const overdueItems = overdueSection.querySelectorAll('div');
      overdueItems.forEach(item => {
        if (item.querySelector('.font-medium')?.textContent?.includes(capa)) {
          const dateSpan = item.querySelector('.px-1.5.py-0.5.bg-red-100');
          if (dateSpan) {
            dateSpan.textContent = formatDate(newDate);
            dateSpan.className = 'px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs';
          }
        }
      });
    }
    
    alert(`📅 ${capa} reportée au ${formatDate(newDate)}`);
    e.target.reset();
    closeReporterModal();
    updateEcheanceCount();
  });
  
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR');
  }
  
  function updateEcheanceCount() {
    const thisWeekSection = document.querySelector('.bg-orange-50 .space-y-2');
    const count = thisWeekSection ? thisWeekSection.children.length : 0;
    const countElement = document.querySelector('.bg-white.shadow.rounded-xl.p-4.text-center:last-child h3');
    if (countElement) countElement.textContent = count;
  }
  
  updateEcheanceCount();

  /* ========== FONCTIONS EXISTANTES ========== */
  function openNewNCModal(){ document.getElementById('newNcModal').classList.remove('hidden'); }
  function closeNewNCModal(){ document.getElementById('newNcModal').classList.add('hidden'); }
  function openNewCAPAModal(){ document.getElementById('newCapaModal').classList.remove('hidden'); }
  function closeNewCAPAModal(){ document.getElementById('newCapaModal').classList.add('hidden'); }

  document.getElementById('newNcForm').addEventListener('submit', function(e){
    e.preventDefault();
    const tbody = document.getElementById('ncTableBody');
    const id = 'NC-' + (100 + tbody.querySelectorAll('tr').length + 1);
    const process = document.getElementById('ncProcess').value;
    const date = document.getElementById('ncDate').value;
    const desc = document.getElementById('ncDescription').value;
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td class="p-2 font-medium">${id}</td>
      <td class="p-2">${formatDate(date)}</td>
      <td class="p-2">${process}</td>
      <td class="p-2">${desc}</td>
      <td class="p-2">Moyenne</td>
      <td class="p-2"><span class="px-1.5 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">Planifié</span></td>
      <td class="p-2"><span class="text-gray-400 small-text">—</span></td>
      <td class="p-2"><span class="px-1.5 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">En attente</span></td>
      <td class="p-2 text-right">
        <button onclick="open5WhyModal('${id}')" class="text-indigo-600 hover:text-indigo-800 mx-1"><i class="fa-solid fa-question small-text"></i></button>
        <button onclick="openIshikawaModal('${id}')" class="text-amber-600 hover:text-amber-800 mx-1"><i class="fa-solid fa-network-wired small-text"></i></button>
        <button onclick="openNcView('${id}')" class="text-green-600 hover:text-green-800 mx-1"><i class="fa-solid fa-eye small-text"></i></button>
        <button onclick="openActionFromNcModal('${id}')" class="text-red-600 hover:text-red-800 mx-1"><i class="fa-solid fa-plus small-text"></i></button>
      </td>
    `;
    tbody.prepend(tr);
    alert('✅ NC créée');
    e.target.reset();
    closeNewNCModal();
  });

  document.getElementById('newCapaForm').addEventListener('submit', function(e){
    e.preventDefault();
    const capaDate = document.getElementById('capaDate').value;
    const capaNc = document.getElementById('capaNc').value;
    
    const thisWeekSection = document.querySelector('.bg-orange-50 .space-y-2');
    if (thisWeekSection) {
      const newEcheance = document.createElement('div');
      newEcheance.className = 'p-2 bg-white border border-orange-200 rounded';
      newEcheance.innerHTML = `
        <div class="flex justify-between items-start">
          <div>
            <span class="font-medium medium-text">Nouvelle CAPA</span>
            <p class="small-text text-gray-600 mt-1">Pour ${capaNc}</p>
          </div>
          <span class="px-1.5 py-0.5 bg-orange-100 text-orange-800 rounded-full text-xs">${formatDate(capaDate)}</span>
        </div>
        <div class="mt-1 flex items-center small-text text-gray-500">
          <i class="fa-solid fa-user mr-1"></i><span>${document.getElementById('capaResp').value}</span>
        </div>
      `;
      thisWeekSection.appendChild(newEcheance);
    }
    
    updateEcheanceCount();
    alert('✅ CAPA créée');
    e.target.reset();
    closeNewCAPAModal();
  });

  /* 5 Why modal */
  function open5WhyModal(nc){
    document.getElementById('fwNcId').innerText = nc;
    document.getElementById('fwHiddenNc').value = nc;
    document.getElementById('fiveWhyModal').classList.remove('hidden');
  }
  function close5WhyModal(){ document.getElementById('fiveWhyModal').classList.add('hidden'); }
  document.getElementById('fiveWhyForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert('✅ 5 Pourquoi sauvegardé');
    close5WhyModal();
  });

  function open5WhyEdit(nc){ open5WhyModal(nc); }

  /* Ishikawa modal */
  function openIshikawaModal(nc){
    document.getElementById('ikNcId').innerText = nc;
    alert('Ishikawa pour ' + nc + ' (simulation)');
  }

  /* Export */
  function exportSummary(){ alert('Export PDF (simulation)'); }
  function openNcView(nc){ alert('Détail ' + nc); }

  /* ACTION FROM NC */
  function openActionFromNcModal(nc){
    document.getElementById('afnNcId').innerText = nc;
    document.getElementById('afnHiddenNc').value = nc;
    document.getElementById('actionFromNcModal').classList.remove('hidden');
  }
  function closeActionFromNcModal(){ document.getElementById('actionFromNcModal').classList.add('hidden'); }

  function openActionFrom5Why(nc){
    if(!nc) nc = document.getElementById('fwHiddenNc').value || 'NC-XXX';
    openActionFromNcModal(nc);
  }

  function openActionFromIshikawa(nc){
    if(!nc) nc = document.getElementById('ikNcId').innerText || 'NC-XXX';
    openActionFromNcModal(nc);
  }

  document.getElementById('actionFromNcForm').addEventListener('submit', function(e){
    e.preventDefault();
    const nc = document.getElementById('afnHiddenNc').value || 'NC-NEW';
    const type = document.getElementById('afnType').value;
    const resp = document.getElementById('afnResp').value || '—';
    const date = document.getElementById('afnDate').value || '—';
    alert('✅ Action créée pour ' + nc);
    e.target.reset();
    closeActionFromNcModal();
  });

  /* CAPA verification */
  function openCapaVerifyModal(capaId = 'CAPA-014'){
    alert('Vérification pour ' + capaId + ' (simulation)');
  }
  function openCapaActionModal(capaId){ openCapaVerifyModal(capaId); }

  /* Charts */
  new Chart(document.getElementById('ncDistributionChart'), {
    type: 'doughnut',
    data: {
      labels: ['Production','Achats','Logistique','Support','Qualité'],
      datasets: [{
        data: [35,20,15,18,12],
        backgroundColor: ['#EF4444','#F59E0B','#3B82F6','#10B981','#8B5CF6']
      }]
    },
    options: { responsive:true, plugins:{ legend:{ position:'bottom', labels: { font: { size: 10 } } } } }
  });

  // Pareto chart
  (function(){
    const labels = ['Procédure','Fourniture','Outillage','Opérateur','Stockage','Autres'];
    const values = [28,18,12,10,8,6];
    const cum = [];
    const total = values.reduce((a,b)=>a+b,0);
    let sum=0;
    values.forEach(v=>{ sum+=v; cum.push(Math.round((sum/total)*100)); });

    const ctx = document.getElementById('paretoChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          type: 'bar',
          label: 'Occurrences',
          data: values,
          backgroundColor: '#3B82F6'
        },{
          type: 'line',
          label: 'Cumul (%)',
          data: cum,
          borderColor: '#EF4444',
          yAxisID: 'percent',
          tension: 0.3,
          fill:false,
          pointBackgroundColor:'#EF4444'
        }]
      },
      options: {
        responsive:true,
        scales:{
          y:{ beginAtZero:true, ticks: { font: { size: 10 } } },
          percent:{ type:'linear', position:'right', min:0, max:100, grid:{display:false}, ticks:{callback: v => v + '%', font: { size: 10 } } }
        },
        plugins:{ legend:{ position:'bottom', labels: { font: { size: 10 } } } }
      }
    });
  })();

  // Graphique des échéances
  new Chart(document.getElementById('echeancesChart'), {
    type: 'bar',
    data: {
      labels: ['20-26 oct', '27-2 nov', '3-9 nov', '10-16 nov', '17-23 nov'],
      datasets: [{
        data: [3,2,1,4,2],
        backgroundColor: ['rgba(249,115,22,0.7)','rgba(59,130,246,0.7)','rgba(16,185,129,0.7)','rgba(139,92,246,0.7)','rgba(239,68,68,0.7)'],
        borderColor: ['rgb(249,115,22)','rgb(59,130,246)','rgb(16,185,129)','rgb(139,92,246)','rgb(239,68,68)'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: { beginAtZero: true, ticks: { font: { size: 10 } } },
        x: { ticks: { font: { size: 10 } } }
      },
      plugins: { legend: { display: false } }
    }
  });

</script>

@endsection