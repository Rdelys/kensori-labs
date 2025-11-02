@extends('layouts.clients')

@section('title', 'Non-conformités / CAPA')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-8 fade-in p-6">

  <!-- HEADER -->
  <div class="flex items-center justify-between border-b pb-4">
    <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-3">
      <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
      Non-conformités & CAPA
    </h1>
    <div class="flex items-center gap-3">
      <button onclick="openNewNCModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
        <i class="fa-solid fa-plus mr-2"></i>Nouvelle NC
      </button>
      <button onclick="openNewCAPAModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
        <i class="fa-solid fa-tools mr-2"></i>Créer CAPA
      </button>
      <div class="bg-gray-50 border rounded-lg p-3 text-sm text-gray-600">
        <div>Version statique conforme au CDC — Données d'exemple complètes</div>
      </div>
    </div>
  </div>

  <!-- KPI CARDS -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white shadow rounded-2xl p-5 text-center">
      <p class="text-sm text-gray-500">NC actives</p>
      <h3 class="text-3xl font-bold text-red-600">7</h3>
      <p class="text-xs text-gray-400 mt-1">NC non résolues</p>
    </div>
    <div class="bg-white shadow rounded-2xl p-5 text-center">
      <p class="text-sm text-gray-500">CAPA en cours</p>
      <h3 class="text-3xl font-bold text-yellow-600">5</h3>
      <p class="text-xs text-gray-400 mt-1">Actions en implémentation</p>
    </div>
    <div class="bg-white shadow rounded-2xl p-5 text-center">
      <p class="text-sm text-gray-500">CAPA vérifiées</p>
      <h3 class="text-3xl font-bold text-green-600">12</h3>
      <p class="text-xs text-gray-400 mt-1">Efficacité confirmée</p>
    </div>
    <div class="bg-white shadow rounded-2xl p-5 text-center">
      <p class="text-sm text-gray-500">Temps moyen résolution</p>
      <h3 class="text-3xl font-bold text-purple-600">14 j</h3>
      <p class="text-xs text-gray-400 mt-1">depuis déclaration</p>
    </div>
  </div>

  <!-- MAIN GRID: TABLE + ANALYSES -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT: NC Table -->
    <div class="lg:col-span-2 bg-white shadow rounded-2xl p-6">
      <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-700">
        <i class="fa-solid fa-list-ul text-red-500"></i> Liste complète des NC (exemples)
      </h2>

      <div class="overflow-x-auto">
        <table class="w-full text-sm table-auto border-collapse">
          <thead class="bg-gray-100 text-gray-600 uppercase">
            <tr>
              <th class="p-3 text-left">ID</th>
              <th class="p-3 text-left">Date</th>
              <th class="p-3 text-left">Processus</th>
              <th class="p-3 text-left">Description</th>
              <th class="p-3 text-left">Gravité</th>
              <th class="p-3 text-left">État</th>
              <th class="p-3 text-left">CAPA</th>
              <th class="p-3 text-right">Actions</th>
            </tr>
          </thead>
          <tbody id="ncTableBody" class="divide-y text-gray-700">
            <tr>
              <td class="p-3 font-medium">NC-021</td>
              <td class="p-3">2025-10-03</td>
              <td class="p-3">Production</td>
              <td class="p-3">Produit hors tolérance dimensionnelle</td>
              <td class="p-3">Élevée</td>
              <td class="p-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Investigation</span></td>
              <td class="p-3"><a href="#" class="text-blue-600 hover:underline">CAPA-014</a></td>
              <td class="p-3 text-right">
                <button onclick="open5WhyModal('NC-021')" class="text-indigo-600 hover:text-indigo-800 mr-3" title="5 Pourquoi"><i class="fa-solid fa-question"></i></button>
                <button onclick="openIshikawaModal('NC-021')" class="text-amber-600 hover:text-amber-800 mr-3" title="Ishikawa"><i class="fa-solid fa-network-wired"></i></button>
                <button onclick="openNcView('NC-021')" class="text-green-600 hover:text-green-800" title="Voir"><i class="fa-solid fa-eye"></i></button>
                <button onclick="openActionFromNcModal('NC-021')" class="text-red-600 hover:text-red-800 ml-2" title="Créer action"><i class="fa-solid fa-plus"></i></button>
              </td>
            </tr>

            <tr>
              <td class="p-3 font-medium">NC-019</td>
              <td class="p-3">2025-09-25</td>
              <td class="p-3">Achats</td>
              <td class="p-3">Fourniture non conforme (matière)</td>
              <td class="p-3">Moyenne</td>
              <td class="p-3"><span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Ouverte</span></td>
              <td class="p-3"><a href="#" class="text-gray-600">—</a></td>
              <td class="p-3 text-right">
                <button onclick="open5WhyModal('NC-019')" class="text-indigo-600 hover:text-indigo-800 mr-3"><i class="fa-solid fa-question"></i></button>
                <button onclick="openIshikawaModal('NC-019')" class="text-amber-600 hover:text-amber-800 mr-3"><i class="fa-solid fa-network-wired"></i></button>
                <button onclick="openNcView('NC-019')" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-eye"></i></button>
                <button onclick="openActionFromNcModal('NC-019')" class="text-red-600 hover:text-red-800 ml-2"><i class="fa-solid fa-plus"></i></button>
              </td>
            </tr>

            <tr>
              <td class="p-3 font-medium">NC-017</td>
              <td class="p-3">2025-09-12</td>
              <td class="p-3">Support</td>
              <td class="p-3">Erreur traitement ticket client</td>
              <td class="p-3">Faible</td>
              <td class="p-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Clôturée</span></td>
              <td class="p-3"><a href="#" class="text-blue-600 hover:underline">CAPA-011</a></td>
              <td class="p-3 text-right">
                <button onclick="open5WhyModal('NC-017')" class="text-indigo-600 hover:text-indigo-800 mr-3"><i class="fa-solid fa-question"></i></button>
                <button onclick="openIshikawaModal('NC-017')" class="text-amber-600 hover:text-amber-800 mr-3"><i class="fa-solid fa-network-wired"></i></button>
                <button onclick="openNcView('NC-017')" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-eye"></i></button>
                <button onclick="openActionFromNcModal('NC-017')" class="text-red-600 hover:text-red-800 ml-2"><i class="fa-solid fa-plus"></i></button>
              </td>
            </tr>

            <tr>
              <td class="p-3 font-medium">NC-015</td>
              <td class="p-3">2025-08-02</td>
              <td class="p-3">RH</td>
              <td class="p-3">Manque de formation opérateurs (nouveau process)</td>
              <td class="p-3">Moyenne</td>
              <td class="p-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En cours</span></td>
              <td class="p-3"><a href="#" class="text-blue-600 hover:underline">CAPA-009</a></td>
              <td class="p-3 text-right">
                <button onclick="open5WhyModal('NC-015')" class="text-indigo-600 hover:text-indigo-800 mr-3"><i class="fa-solid fa-question"></i></button>
                <button onclick="openIshikawaModal('NC-015')" class="text-amber-600 hover:text-amber-800 mr-3"><i class="fa-solid fa-network-wired"></i></button>
                <button onclick="openNcView('NC-015')" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-eye"></i></button>
                <button onclick="openActionFromNcModal('NC-015')" class="text-red-600 hover:text-red-800 ml-2"><i class="fa-solid fa-plus"></i></button>
              </td>
            </tr>

            <tr>
              <td class="p-3 font-medium">NC-013</td>
              <td class="p-3">2025-07-18</td>
              <td class="p-3">Logistique</td>
              <td class="p-3">Colis mal étiqueté — livraison client erronée</td>
              <td class="p-3">Moyenne</td>
              <td class="p-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En cours</span></td>
              <td class="p-3"><a href="#" class="text-gray-600">—</a></td>
              <td class="p-3 text-right">
                <button onclick="open5WhyModal('NC-013')" class="text-indigo-600 hover:text-indigo-800 mr-3"><i class="fa-solid fa-question"></i></button>
                <button onclick="openIshikawaModal('NC-013')" class="text-amber-600 hover:text-amber-800 mr-3"><i class="fa-solid fa-network-wired"></i></button>
                <button onclick="openNcView('NC-013')" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-eye"></i></button>
                <button onclick="openActionFromNcModal('NC-013')" class="text-red-600 hover:text-red-800 ml-2"><i class="fa-solid fa-plus"></i></button>
              </td>
            </tr>

            <tr>
              <td class="p-3 font-medium">NC-011</td>
              <td class="p-3">2025-06-20</td>
              <td class="p-3">Qualité Fournisseur</td>
              <td class="p-3">Non-conformité fournisseur — spécification non respectée</td>
              <td class="p-3">Élevée</td>
              <td class="p-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Clôturée</span></td>
              <td class="p-3"><a href="#" class="text-blue-600 hover:underline">CAPA-005</a></td>
              <td class="p-3 text-right">
                <button onclick="open5WhyModal('NC-011')" class="text-indigo-600 hover:text-indigo-800 mr-3"><i class="fa-solid fa-question"></i></button>
                <button onclick="openIshikawaModal('NC-011')" class="text-amber-600 hover:text-amber-800 mr-3"><i class="fa-solid fa-network-wired"></i></button>
                <button onclick="openNcView('NC-011')" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-eye"></i></button>
                <button onclick="openActionFromNcModal('NC-011')" class="text-red-600 hover:text-red-800 ml-2"><i class="fa-solid fa-plus"></i></button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

      <!-- CAPA SUMMARY -->
      <div class="mt-6 border-t pt-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Synthèse CAPA (exemples)</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="p-4 bg-gray-50 rounded-lg">
            <div class="text-xs text-gray-500">CAPA-014</div>
            <div class="font-semibold mt-1">Réglage machine + formation</div>
            <div class="text-xs text-gray-400 mt-1">Responsable: R. Andrian</div>
            <div class="text-sm mt-2"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En implémentation</span></div>
            <div class="mt-3">
              <button onclick="openCapaActionModal('CAPA-014')" class="px-3 py-1 bg-blue-600 text-white rounded text-sm">Ajouter vérification</button>
            </div>
          </div>
          <div class="p-4 bg-gray-50 rounded-lg">
            <div class="text-xs text-gray-500">CAPA-011</div>
            <div class="font-semibold mt-1">Contrôle qualité fournisseur</div>
            <div class="text-xs text-gray-400 mt-1">Responsable: L. Razan</div>
            <div class="text-sm mt-2"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Vérifiée</span></div>
            <div class="mt-3">
              <button onclick="openCapaActionModal('CAPA-011')" class="px-3 py-1 bg-blue-600 text-white rounded text-sm">Ajouter vérification</button>
            </div>
          </div>
          <div class="p-4 bg-gray-50 rounded-lg">
            <div class="text-xs text-gray-500">CAPA-009</div>
            <div class="font-semibold mt-1">Programme formation opérateurs</div>
            <div class="text-xs text-gray-400 mt-1">Responsable: H. Jean</div>
            <div class="text-sm mt-2"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En implémentation</span></div>
            <div class="mt-3">
              <button onclick="openCapaActionModal('CAPA-009')" class="px-3 py-1 bg-blue-600 text-white rounded text-sm">Ajouter vérification</button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- RIGHT: ANALYSES GRAPHIQUES & PARETO -->
    <div class="bg-white shadow rounded-2xl p-6">
      <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
        <i class="fa-solid fa-chart-simple text-gray-700"></i> Analyses & Pareto
      </h2>

      <div class="space-y-4">
        <div>
          <label class="text-sm text-gray-600">Répartition NC par processus</label>
          <canvas id="ncDistributionChart" width="300" height="220"></canvas>
        </div>

        <div>
          <label class="text-sm text-gray-600">Diagramme Pareto — Causes (exemple)</label>
          <canvas id="paretoChart" width="300" height="220"></canvas>
          <p class="text-xs text-gray-500 mt-2">Pareto généré sur les causes enregistrées — montre 80/20 des causes principales.</p>
        </div>

        <div class="mt-3">
          <button onclick="exportSummary()" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg">
            <i class="fa-solid fa-file-export mr-2"></i>Exporter synthèse CAPA (PDF fictif)
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- 5 WHY & ISHIKAWA DETAILED AREA -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- 5 WHY PANEL (filled examples) -->
    <div class="bg-white shadow rounded-2xl p-6">
      <h3 class="text-lg font-semibold mb-3 text-gray-700"><i class="fa-solid fa-question text-indigo-600"></i> Outil 5 Pourquoi — Exemple NC-021</h3>
      <p class="text-sm text-gray-500 mb-4">Analyse complète enregistrée pour NC-021 (Production).</p>

      <div class="space-y-2">
        <div class="p-3 border rounded-lg bg-gray-50">
          <div class="text-xs text-gray-500">Pourquoi 1</div>
          <div class="font-medium">La pièce est hors tolérance — réglage machine incorrect</div>
        </div>
        <div class="p-3 border rounded-lg bg-gray-50">
          <div class="text-xs text-gray-500">Pourquoi 2</div>
          <div class="font-medium">L’opérateur a appliqué un gabarit obsolète</div>
        </div>
        <div class="p-3 border rounded-lg bg-gray-50">
          <div class="text-xs text-gray-500">Pourquoi 3</div>
          <div class="font-medium">La procédure mise à jour n'a pas été diffusée aux équipes</div>
        </div>
        <div class="p-3 border rounded-lg bg-gray-50">
          <div class="text-xs text-gray-500">Pourquoi 4</div>
          <div class="font-medium">Pas d’accusé de lecture requis lors de la diffusion</div>
        </div>
        <div class="p-3 border rounded-lg bg-gray-50">
          <div class="text-xs text-gray-500">Pourquoi 5 (cause racine)</div>
          <div class="font-medium text-red-600">Absence de workflow de gestion documentaire et de formation associée</div>
        </div>
      </div>

      <div class="mt-4 flex gap-3">
        <button onclick="openActionFrom5Why('NC-021')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Créer action CAPA depuis l'analyse</button>
        <button onclick="open5WhyEdit('NC-021')" class="px-4 py-2 border rounded-lg text-gray-700">Éditer</button>
      </div>
    </div>

    <!-- ISHIKAWA DETAILED -->
    <div class="bg-white shadow rounded-2xl p-6">
      <h3 class="text-lg font-semibold mb-3 text-gray-700"><i class="fa-solid fa-network-wired text-amber-600"></i> Diagramme d'Ishikawa — Exemple NC-019</h3>
      <p class="text-sm text-gray-500 mb-4">Causes listées par catégorie (6M).</p>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div class="border rounded-lg p-3 bg-gray-50">
          <div class="text-xs text-gray-500">Méthode</div>
          <ul class="mt-2 text-sm text-gray-700 list-disc list-inside">
            <li>Procédure de contrôle lot non respectée</li>
            <li>Instructions de réception incomplètes</li>
          </ul>
        </div>
        <div class="border rounded-lg p-3 bg-gray-50">
          <div class="text-xs text-gray-500">Matière</div>
          <ul class="mt-2 text-sm text-gray-700 list-disc list-inside">
            <li>Variabilité fournisseur sur lot</li>
          </ul>
        </div>

        <div class="border rounded-lg p-3 bg-gray-50">
          <div class="text-xs text-gray-500">Main-d'œuvre</div>
          <ul class="mt-2 text-sm text-gray-700 list-disc list-inside">
            <li>Opérateur non formé au nouveau critère d'acceptation</li>
          </ul>
        </div>
        <div class="border rounded-lg p-3 bg-gray-50">
          <div class="text-xs text-gray-500">Milieu</div>
          <ul class="mt-2 text-sm text-gray-700 list-disc list-inside">
            <li>Conditions de stockage non conformes temporairement</li>
          </ul>
        </div>

        <div class="border rounded-lg p-3 bg-gray-50">
          <div class="text-xs text-gray-500">Matériel</div>
          <ul class="mt-2 text-sm text-gray-700 list-disc list-inside">
            <li>Outillage d'inspection mal étalonné</li>
          </ul>
        </div>
        <div class="border rounded-lg p-3 bg-gray-50">
          <div class="text-xs text-gray-500">Mesure</div>
          <ul class="mt-2 text-sm text-gray-700 list-disc list-inside">
            <li>Étalonnage non à jour pour instrument critique</li>
          </ul>
        </div>
      </div>

      <div class="mt-4 flex gap-3">
        <button onclick="openActionFromIshikawa('NC-019')" class="px-4 py-2 bg-amber-600 text-white rounded-lg">Créer action depuis Ishikawa</button>
        <button onclick="generateIshikawaPdf()" class="px-4 py-2 border rounded-lg text-gray-700">Exporter Ishikawa (fictif)</button>
      </div>
    </div>
  </div>

  <!-- VERIFICATION EFFICACITE CAPA + HISTORIQUE -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h3 class="text-lg font-semibold mb-3 text-gray-700"><i class="fa-solid fa-check-double text-green-600"></i> Vérification d'efficacité CAPA</h3>
    <p class="text-sm text-gray-500 mb-4">Enregistrements des vérifications réalisées après implémentation (exemples statiques).</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="p-4 bg-gray-50 rounded-lg">
        <div class="text-xs text-gray-500">CAPA</div>
        <div class="font-semibold mt-1">CAPA-014</div>
        <div class="text-xs text-gray-400 mt-1">Vérifié le 2025-10-10</div>
        <div class="mt-2 text-sm">Résultat : <strong class="text-green-600">Efficace</strong></div>
      </div>
      <div class="p-4 bg-gray-50 rounded-lg">
        <div class="text-xs text-gray-500">CAPA</div>
        <div class="font-semibold mt-1">CAPA-011</div>
        <div class="text-xs text-gray-400 mt-1">Vérifié le 2025-09-20</div>
        <div class="mt-2 text-sm">Résultat : <strong class="text-green-600">Efficace</strong></div>
      </div>
      <div class="p-4 bg-gray-50 rounded-lg">
        <div class="text-xs text-gray-500">CAPA</div>
        <div class="font-semibold mt-1">CAPA-009</div>
        <div class="text-xs text-gray-400 mt-1">Vérifié le 2025-09-30</div>
        <div class="mt-2 text-sm">Résultat : <strong class="text-yellow-600">Partiellement</strong></div>
      </div>
    </div>

    <div class="mt-6">
      <h4 class="font-semibold text-gray-700 mb-3">Historique des vérifications</h4>
      <div class="overflow-x-auto">
        <table class="w-full text-sm table-auto">
          <thead class="bg-gray-100 text-gray-600 uppercase">
            <tr>
              <th class="p-3 text-left">CAPA</th>
              <th class="p-3 text-left">Date vérification</th>
              <th class="p-3 text-left">Critère</th>
              <th class="p-3 text-left">Résultat</th>
              <th class="p-3 text-left">Commentaire</th>
            </tr>
          </thead>
          <tbody id="capaVerificationTable" class="divide-y text-gray-700">
            <tr>
              <td class="p-3">CAPA-014</td>
              <td class="p-3">2025-10-10</td>
              <td class="p-3"><small>&lt;1 NC similaire / 30j</small></td>
              <td class="p-3"><span class="text-green-600 font-semibold">Efficace</span></td>
              <td class="p-3">Aucun retour NC sur 45 jours.</td>
            </tr>
            <tr>
              <td class="p-3">CAPA-011</td>
              <td class="p-3">2025-09-20</td>
              <td class="p-3"><small>Taux rejet fournisseur &lt; 1%</small></td>
              <td class="p-3"><span class="text-green-600 font-semibold">Efficace</span></td>
              <td class="p-3">Amélioration constatée, contractualisation contrôles fournisseur.</td>
            </tr>
            <tr>
              <td class="p-3">CAPA-009</td>
              <td class="p-3">2025-09-30</td>
              <td class="p-3"><small>100% opérateurs formés</small></td>
              <td class="p-3"><span class="text-yellow-600 font-semibold">Partiellement</span></td>
              <td class="p-3">Formation faite ; besoin d'évaluation post-formation.</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-4">
        <button onclick="openCapaVerifyModal()" class="px-4 py-2 bg-green-600 text-white rounded-lg">Ajouter vérification CAPA</button>
      </div>
    </div>
  </div>

  <!-- LEAN SIX SIGMA (DMAIC) TEMPLATE -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h3 class="text-lg font-semibold mb-3 text-gray-700"><i class="fa-solid fa-chart-line text-purple-600"></i> Lean Six Sigma — DMAIC (exemple projet)</h3>
    <p class="text-sm text-gray-500 mb-4">Projet : Réduction NC process Production — objectif : -30% NC en 3 mois.</p>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
      <div class="p-4 bg-gray-50 rounded-lg col-span-1">
        <h4 class="font-semibold text-sm">Define</h4>
        <p class="text-xs text-gray-500 mt-2">Problème : 8 NC / semaine moyenne sur S1.</p>
      </div>
      <div class="p-4 bg-gray-50 rounded-lg col-span-1">
        <h4 class="font-semibold text-sm">Measure</h4>
        <p class="text-xs text-gray-500 mt-2">Collecte : NC par poste, temps d'arrêt, lot fournisseur.</p>
      </div>
      <div class="p-4 bg-gray-50 rounded-lg col-span-1">
        <h4 class="font-semibold text-sm">Analyze</h4>
        <p class="text-xs text-gray-500 mt-2">Outils : Pareto, Ishikawa, 5Why — Cause racine identifiée : formation & documentation.</p>
      </div>
      <div class="p-4 bg-gray-50 rounded-lg col-span-1">
        <h4 class="font-semibold text-sm">Improve</h4>
        <p class="text-xs text-gray-500 mt-2">Actions : mise à jour doc, formation ciblée, étalonnage instruments.</p>
      </div>
      <div class="p-4 bg-gray-50 rounded-lg col-span-1">
        <h4 class="font-semibold text-sm">Control</h4>
        <p class="text-xs text-gray-500 mt-2">Plan 30/60/90j, KPI dashboard, audit post-implémentation.</p>
      </div>
    </div>

    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="text-sm text-gray-600">Mesure — NC / semaine (exemple)</label>
        <canvas id="dmaicChart" width="400" height="200"></canvas>
      </div>
      <div>
        <label class="text-sm text-gray-600">Pareto (causes) résumé</label>
        <canvas id="paretoSmall" width="400" height="200"></canvas>
        <div class="mt-3">
          <button onclick="openDmaicMeasureModal()" class="px-3 py-2 bg-indigo-600 text-white rounded">Ajouter mesure (simulée)</button>
        </div>
      </div>
    </div>

  </div>

</div>

<!-- MODALS (statics) -->
<!-- New NC -->
<div id="newNcModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-2xl p-6 relative">
    <h3 class="text-xl font-semibold mb-4 text-gray-700">Créer une nouvelle Non-conformité</h3>
    <button onclick="closeNewNCModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>
    <form id="newNcForm" class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div>
        <label class="text-sm text-gray-600">Processus</label>
        <input id="ncProcess" type="text" class="w-full border rounded-lg p-2 text-sm" value="Production">
      </div>
      <div>
        <label class="text-sm text-gray-600">Date</label>
        <input id="ncDate" type="date" class="w-full border rounded-lg p-2 text-sm" value="2025-10-18">
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-gray-600">Description</label>
        <textarea id="ncDescription" class="w-full border rounded-lg p-2 text-sm" rows="3">Exemple: pièce hors tolérance T.</textarea>
      </div>
      <div>
        <label class="text-sm text-gray-600">Gravité</label>
        <select id="ncSeverity" class="w-full border rounded-lg p-2 text-sm">
          <option>Faible</option>
          <option selected>Moyenne</option>
          <option>Élevée</option>
        </select>
      </div>
      <div>
        <label class="text-sm text-gray-600">Source</label>
        <input id="ncSource" type="text" class="w-full border rounded-lg p-2 text-sm" value="Audit Interne">
      </div>

      <div class="md:col-span-2 flex justify-end gap-3 pt-3">
        <button type="button" onclick="closeNewNCModal()" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Créer NC (statique)</button>
      </div>
    </form>
  </div>
</div>

<!-- New CAPA -->
<div id="newCapaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-2xl p-6 relative">
    <h3 class="text-xl font-semibold mb-4 text-gray-700">Créer CAPA</h3>
    <button onclick="closeNewCAPAModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>
    <form id="newCapaForm" class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div>
        <label class="text-sm text-gray-600">NC associée</label>
        <input id="capaNc" type="text" class="w-full border rounded-lg p-2 text-sm" value="NC-021">
      </div>
      <div>
        <label class="text-sm text-gray-600">Responsable</label>
        <input id="capaResp" type="text" class="w-full border rounded-lg p-2 text-sm" value="R. Andrian">
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-gray-600">Action corrective</label>
        <textarea id="capaAction" class="w-full border rounded-lg p-2 text-sm" rows="3">Réglage machine ; formation opérateurs ; mise à jour doc.</textarea>
      </div>
      <div>
        <label class="text-sm text-gray-600">Date cible</label>
        <input id="capaDate" type="date" class="w-full border rounded-lg p-2 text-sm" value="2025-10-30">
      </div>
      <div>
        <label class="text-sm text-gray-600">Priorité</label>
        <select id="capaPriority" class="w-full border rounded-lg p-2 text-sm">
          <option selected>Haute</option>
          <option>Normale</option>
          <option>Basse</option>
        </select>
      </div>

      <div class="md:col-span-2 flex justify-end gap-3 pt-3">
        <button type="button" onclick="closeNewCAPAModal()" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Créer CAPA (statique)</button>
      </div>
    </form>
  </div>
</div>

<!-- 5 WHY Modal (edit) -->
<div id="fiveWhyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-2xl p-6 relative">
    <h3 class="text-lg font-semibold mb-3">5 Pourquoi — <span id="fwNcId">NC-XXX</span></h3>
    <button onclick="close5WhyModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>

    <form id="fiveWhyForm" class="space-y-3">
      <input id="fwHiddenNc" type="hidden" value="">
      <div>
        <label class="text-sm text-gray-600">Pourquoi 1</label>
        <input id="fw1" type="text" class="w-full border rounded-lg p-2 text-sm" value="La pièce hors tolérance — réglage machine incorrect">
      </div>
      <div>
        <label class="text-sm text-gray-600">Pourquoi 2</label>
        <input id="fw2" type="text" class="w-full border rounded-lg p-2 text-sm" value="Opérateur a appliqué un gabarit obsolète">
      </div>
      <div>
        <label class="text-sm text-gray-600">Pourquoi 3</label>
        <input id="fw3" type="text" class="w-full border rounded-lg p-2 text-sm" value="Procédure mise à jour non diffusée">
      </div>
      <div>
        <label class="text-sm text-gray-600">Pourquoi 4</label>
        <input id="fw4" type="text" class="w-full border rounded-lg p-2 text-sm" value="Pas d'accusé de lecture requis">
      </div>
      <div>
        <label class="text-sm text-gray-600">Pourquoi 5</label>
        <input id="fw5" type="text" class="w-full border rounded-lg p-2 text-sm" value="Absence de workflow documentaire et formation">
      </div>

      <div class="flex justify-between gap-3 pt-2">
        <div>
          <button type="button" onclick="openActionFrom5Why(document.getElementById('fwHiddenNc').value)" class="px-4 py-2 bg-red-600 text-white rounded-lg">Créer action depuis 5Why</button>
        </div>
        <div class="flex gap-3">
          <button type="button" onclick="close5WhyModal()" class="px-4 py-2 border rounded-lg text-gray-600">Fermer</button>
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Sauvegarder (statique)</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Ishikawa Modal -->
<div id="ishikawaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-3xl p-6 relative">
    <h3 class="text-lg font-semibold mb-3">Ishikawa — <span id="ikNcId">NC-XXX</span></h3>
    <button onclick="closeIshikawaModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="border rounded-lg p-3 bg-gray-50">
        <svg id="ishikawaSvgModal" class="w-full h-64"></svg>
      </div>
      <div>
        <label class="text-sm text-gray-600">Ajouter cause</label>
        <input id="ikCauseInput" type="text" class="w-full border rounded-lg p-2 text-sm" placeholder="Ex: Outillage mal étalonné">
        <div class="mt-3 flex justify-end gap-2">
          <button onclick="addIshikawaModalCause()" class="px-4 py-2 bg-amber-600 text-white rounded-lg">Ajouter</button>
        </div>

        <div id="ikList" class="mt-4 text-sm text-gray-700 space-y-2">
          <div class="p-2 border rounded">Outillage mal étalonné (Matériel)</div>
          <div class="p-2 border rounded">Procédure non à jour (Méthode)</div>
        </div>

        <div class="mt-4">
          <button onclick="openActionFromIshikawa(document.getElementById('ikNcId').innerText)" class="px-4 py-2 bg-amber-600 text-white rounded-lg">Créer action depuis Ishikawa</button>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-3 pt-4">
      <button onclick="closeIshikawaModal()" class="px-4 py-2 border rounded-lg text-gray-600">Fermer</button>
    </div>
  </div>
</div>

<!-- ACTION FROM NC Modal -->
<div id="actionFromNcModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-lg p-6 relative">
    <h3 class="text-lg font-semibold mb-3">Créer action — <span id="afnNcId">NC-XXX</span></h3>
    <button onclick="closeActionFromNcModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>

    <form id="actionFromNcForm" class="space-y-3">
      <input id="afnHiddenNc" type="hidden" value="">
      <div>
        <label class="text-sm text-gray-600">Type d'action</label>
        <select id="afnType" class="w-full border rounded-lg p-2 text-sm">
          <option>Corrective</option>
          <option>Préventive</option>
        </select>
      </div>
      <div>
        <label class="text-sm text-gray-600">Responsable</label>
        <input id="afnResp" type="text" class="w-full border rounded-lg p-2 text-sm" placeholder="Nom responsable">
      </div>
      <div>
        <label class="text-sm text-gray-600">Échéance</label>
        <input id="afnDate" type="date" class="w-full border rounded-lg p-2 text-sm">
      </div>
      <div>
        <label class="text-sm text-gray-600">Description</label>
        <textarea id="afnDesc" class="w-full border rounded-lg p-2 text-sm" rows="3" placeholder="Décrire l'action..."></textarea>
      </div>

      <div class="flex justify-end gap-3 pt-2">
        <button type="button" onclick="closeActionFromNcModal()" class="px-4 py-2 border rounded-lg text-gray-600">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Enregistrer action (simulée)</button>
      </div>
    </form>
  </div>
</div>

<!-- ACTION FROM 5WHY Modal (reuse action modal) -->
<!-- we will reuse actionFromNcModal for 5Why by setting its hidden field -->

<!-- ACTION FROM ISHIKAWA Modal (reuse action modal) -->
<!-- CAPA VERIFY Modal -->
<div id="capaVerifyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-2xl p-6 relative">
    <h3 class="text-lg font-semibold mb-3">Ajouter vérification CAPA — <span id="cvCapaId">CAPA-XXX</span></h3>
    <button onclick="closeCapaVerifyModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>

    <form id="capaVerifyForm" class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <input id="cvHiddenCapa" type="hidden" value="">
      <div>
        <label class="text-sm text-gray-600">Date vérification</label>
        <input id="cvDate" type="date" class="w-full border rounded-lg p-2 text-sm" value="">
      </div>
      <div>
        <label class="text-sm text-gray-600">Résultat</label>
        <select id="cvResult" class="w-full border rounded-lg p-2 text-sm">
          <option>Efficace</option>
          <option>Partiellement</option>
          <option>Non efficace</option>
        </select>
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-gray-600">Critère vérifié</label>
        <input id="cvCriteria" type="text" class="w-full border rounded-lg p-2 text-sm" placeholder="Ex: &lt;1 NC similaire / 30j">
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-gray-600">Commentaire</label>
        <textarea id="cvComment" class="w-full border rounded-lg p-2 text-sm" rows="3" placeholder="Commentaire..."></textarea>
      </div>

      <div class="md:col-span-2 flex justify-end gap-3 pt-2">
        <button type="button" onclick="closeCapaVerifyModal()" class="px-4 py-2 border rounded-lg text-gray-600">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">Ajouter vérification</button>
      </div>
    </form>
  </div>
</div>

<!-- DMAIC Add Measure Modal -->
<div id="dmaicMeasureModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-lg p-6 relative">
    <h3 class="text-lg font-semibold mb-3">Ajouter mesure DMAIC</h3>
    <button onclick="closeDmaicMeasureModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>

    <form id="dmaicMeasureForm" class="space-y-3">
      <div>
        <label class="text-sm text-gray-600">Semaine</label>
        <input id="dmaicWeek" type="text" class="w-full border rounded-lg p-2 text-sm" placeholder="S6">
      </div>
      <div>
        <label class="text-sm text-gray-600">NC / semaine</label>
        <input id="dmaicValue" type="number" class="w-full border rounded-lg p-2 text-sm" placeholder="4">
      </div>
      <div class="flex justify-end gap-3 pt-2">
        <button type="button" onclick="closeDmaicMeasureModal()" class="px-4 py-2 border rounded-lg text-gray-600">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Ajouter mesure</button>
      </div>
    </form>
  </div>
</div>

<script>
  /* Modal controls */
  function openNewNCModal(){ document.getElementById('newNcModal').classList.remove('hidden'); }
  function closeNewNCModal(){ document.getElementById('newNcModal').classList.add('hidden'); }
  function openNewCAPAModal(){ document.getElementById('newCapaModal').classList.remove('hidden'); }
  function closeNewCAPAModal(){ document.getElementById('newCapaModal').classList.add('hidden'); }

  /* New NC form (simulated) */
  document.getElementById('newNcForm').addEventListener('submit', function(e){
    e.preventDefault();
    // Append a new static NC row to table (simulation)
    const tbody = document.getElementById('ncTableBody');
    const id = 'NC-' + (100 + tbody.querySelectorAll('tr').length + 1);
    const process = document.getElementById('ncProcess').value;
    const date = document.getElementById('ncDate').value;
    const desc = document.getElementById('ncDescription').value;
    const grav = document.getElementById('ncSeverity').value;
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td class="p-3 font-medium">${id}</td>
      <td class="p-3">${date}</td>
      <td class="p-3">${process}</td>
      <td class="p-3">${desc}</td>
      <td class="p-3">${grav}</td>
      <td class="p-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Planifié</span></td>
      <td class="p-3"><a href="#" class="text-gray-600">—</a></td>
      <td class="p-3 text-right">
        <button onclick="open5WhyModal('${id}')" class="text-indigo-600 hover:text-indigo-800 mr-3"><i class="fa-solid fa-question"></i></button>
        <button onclick="openIshikawaModal('${id}')" class="text-amber-600 hover:text-amber-800 mr-3"><i class="fa-solid fa-network-wired"></i></button>
        <button onclick="openNcView('${id}')" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-eye"></i></button>
        <button onclick="openActionFromNcModal('${id}')" class="text-red-600 hover:text-red-800 ml-2"><i class="fa-solid fa-plus"></i></button>
      </td>
    `;
    tbody.prepend(tr);
    alert('✅ NC créée (simulation)');
    e.target.reset();
    closeNewNCModal();
  });

  /* New CAPA form (simulated) */
  document.getElementById('newCapaForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert('✅ CAPA créée (simulation)');
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
    alert('✅ 5 Pourquoi sauvegardé (simulation)');
    close5WhyModal();
  });

  function open5WhyEdit(nc){
    open5WhyModal(nc);
  }

  /* Ishikawa modal */
  function openIshikawaModal(nc){
    document.getElementById('ikNcId').innerText = nc;
    document.getElementById('ishikawaModal').classList.remove('hidden');
    drawIshikawaSample();
  }
  function closeIshikawaModal(){ document.getElementById('ishikawaModal').classList.add('hidden'); }
  function addIshikawaModalCause(){
    const txt = document.getElementById('ikCauseInput').value.trim();
    if(!txt) return alert('Entrez une cause.');
    const list = document.getElementById('ikList');
    const el = document.createElement('div'); el.className='p-2 border rounded'; el.innerText = txt;
    list.prepend(el);
    document.getElementById('ikCauseInput').value='';
    drawIshikawaSample();
  }

  function drawIshikawaSample(){
    const svg = document.getElementById('ishikawaSvgModal');
    const w = svg.clientWidth || 600;
    const h = 260;
    svg.innerHTML = '';
    svg.setAttribute('viewBox','0 0 '+w+' '+h);
    // simple fishbone: spine + bones
    const ns = 'http://www.w3.org/2000/svg';
    const line = document.createElementNS(ns,'line');
    line.setAttribute('x1',20); line.setAttribute('y1',h/2);
    line.setAttribute('x2',w-20); line.setAttribute('y2',h/2);
    line.setAttribute('stroke','#374151'); line.setAttribute('stroke-width',2);
    svg.appendChild(line);
    const bones = ['Méthode','Matière','Main-d’œuvre','Milieu','Matériel','Mesure'];
    bones.forEach((b,i)=>{
      const y = (i+1)*(h/(bones.length+1));
      const lx = 20 + (w-40)*0.55;
      const bone = document.createElementNS(ns,'line');
      bone.setAttribute('x1',lx); bone.setAttribute('y1',h/2);
      bone.setAttribute('x2',lx+60); bone.setAttribute('y2',y);
      bone.setAttribute('stroke','#9CA3AF'); bone.setAttribute('stroke-width',2);
      svg.appendChild(bone);
      const text = document.createElementNS(ns,'text');
      text.setAttribute('x', lx+66); text.setAttribute('y', y+4);
      text.setAttribute('fill','#374151'); text.setAttribute('font-size',12);
      text.textContent = b;
      svg.appendChild(text);
    });
  }

  /* Export (static) */
  function exportSummary(){ alert('Export synthèse (PDF) — fonction statique (à implémenter backend).'); }

  /* Nc view */
  function openNcView(nc){ alert('Affichage détail NC ' + nc + ' (statique).'); }

  /* ACTION FROM NC / 5WHY / ISHIKAWA */
  function openActionFromNcModal(nc){
    document.getElementById('afnNcId').innerText = nc;
    document.getElementById('afnHiddenNc').value = nc;
    document.getElementById('actionFromNcModal').classList.remove('hidden');
  }
  function closeActionFromNcModal(){ document.getElementById('actionFromNcModal').classList.add('hidden'); }

  // Reuse the same modal for actions created from 5Why or Ishikawa
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
    const desc = document.getElementById('afnDesc').value || '—';

    // Simulate adding an action row inside CAPA summary area (could be extended)
    const row = document.createElement('div');
    row.className = 'p-3 border rounded bg-gray-50 mt-2';
    row.innerHTML = `<div class="text-xs text-gray-500">${nc} — ${type}</div>
                     <div class="font-medium">${desc}</div>
                     <div class="text-xs text-gray-400 mt-1">Resp: ${resp} — Échéance: ${date}</div>`;
    // append to CAPA summary first card for demo
    const container = document.querySelector('.lg\\:col-span-2 .mt-6 .grid') || document.querySelector('.lg\\:col-span-2');
    if(container) container.prepend(row);
    alert('✅ Action enregistrée (simulation) — liée à ' + nc);
    e.target.reset();
    closeActionFromNcModal();
  });

  /* CAPA verification modal */
  function openCapaVerifyModal(capaId = 'CAPA-014'){
    document.getElementById('cvCapaId').innerText = capaId;
    document.getElementById('cvHiddenCapa').value = capaId;
    document.getElementById('capaVerifyModal').classList.remove('hidden');
  }
  function closeCapaVerifyModal(){ document.getElementById('capaVerifyModal').classList.add('hidden'); }

  function openCapaActionModal(capaId){
    openCapaVerifyModal(capaId);
  }

  document.getElementById('capaVerifyForm').addEventListener('submit', function(e){
    e.preventDefault();
    const capa = document.getElementById('cvHiddenCapa').value || 'CAPA-XXX';
    const date = document.getElementById('cvDate').value || new Date().toISOString().slice(0,10);
    const result = document.getElementById('cvResult').value;
    const criteria = document.getElementById('cvCriteria').value || '';
    const comment = document.getElementById('cvComment').value || '';

    // Append to verification table
    const tbody = document.getElementById('capaVerificationTable');
    const tr = document.createElement('tr');
    tr.innerHTML = `<td class="p-3">${capa}</td>
                    <td class="p-3">${date}</td>
                    <td class="p-3">${criteria}</td>
                    <td class="p-3"><span class="${ result === 'Efficace' ? 'text-green-600' : result === 'Partiellement' ? 'text-yellow-600' : 'text-red-600'} font-semibold">${result}</span></td>
                    <td class="p-3">${comment}</td>`;
    tbody.prepend(tr);
    alert('✅ Vérification CAPA ajoutée (simulation)');
    e.target.reset();
    closeCapaVerifyModal();
  });

  /* DMAIC measure modal */
  function openDmaicMeasureModal(){ document.getElementById('dmaicMeasureModal').classList.remove('hidden'); }
  function closeDmaicMeasureModal(){ document.getElementById('dmaicMeasureModal').classList.add('hidden'); }

  document.getElementById('dmaicMeasureForm').addEventListener('submit', function(e){
    e.preventDefault();
    const week = document.getElementById('dmaicWeek').value || 'Sx';
    const value = Number(document.getElementById('dmaicValue').value) || 0;

    // For simulation, update the dmaicChart dataset
    try {
      const chart = Chart.getChart('dmaicChart'); // Chart.js 3+ method
      if(chart){
        chart.data.labels.push(week);
        chart.data.datasets[0].data.push(value);
        chart.update();
      }
    } catch(err){
      // fallback: nothing
    }

    alert('✅ Mesure DMAIC ajoutée (simulation)');
    e.target.reset();
    closeDmaicMeasureModal();
  });

  /* Ishikawa export (static) */
  function generateIshikawaPdf(){ alert('Export Ishikawa (fictif) — fonctionnalité backend requise pour réel.'); }

  /* Charts: NC distribution */
  new Chart(document.getElementById('ncDistributionChart'), {
    type: 'doughnut',
    data: {
      labels: ['Production','Achats','Logistique','Support','Qualité Fournisseur'],
      datasets: [{
        data: [35, 20, 15, 18, 12],
        backgroundColor: ['#EF4444','#F59E0B','#3B82F6','#10B981','#8B5CF6']
      }]
    },
    options: { responsive:true, plugins:{ legend:{ position:'bottom' } } }
  });

  // Pareto chart : bars with cumulative line
  (function(){
    const labels = ['Procédure non utilisée','Fourniture défectueuse','Outillage','Erreur opérateur','Condition stockage','Autres'];
    const values = [28,18,12,10,8,6]; // counts %
    const cum = [];
    const total = values.reduce((a,b)=>a+b,0);
    let sum=0;
    values.forEach(v=>{ sum+=v; cum.push(Math.round((sum/total)*100)); });

    const ctx = document.getElementById('paretoChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0,0,0,300);
    gradient.addColorStop(0,'#3B82F6'); gradient.addColorStop(1,'#60A5FA');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          type: 'bar',
          label: 'Occurrences',
          data: values,
          backgroundColor: gradient
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
          y:{ beginAtZero:true, position:'left', title:{display:true,text:'Occurrences'} },
          percent:{ type:'linear', position:'right', min:0, max:100, grid:{display:false}, ticks:{callback: v => v + '%'}, title:{display:true,text:'Cumul (%)'} }
        },
        plugins:{ legend:{ position:'bottom' } }
      }
    });
  })();

  // DMAIC sample charts
  new Chart(document.getElementById('dmaicChart'), {
    type: 'line',
    data: {
      labels: ['S1','S2','S3','S4','S5'],
      datasets: [{ label:'NC / semaine', data:[8,7,6,5,4], borderColor:'#EF4444', tension:0.3, fill:false }]
    },
    options:{ responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }
  });

  new Chart(document.getElementById('paretoSmall'), {
    type: 'bar',
    data: {
      labels: ['Procédure','Fourniture','Outillage','Opérateur'],
      datasets: [{ label:'Occurrences', data:[28,18,12,10], backgroundColor:'#3B82F6' }]
    },
    options:{ responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }
  });

</script>

@endsection
