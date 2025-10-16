@extends('layouts.clients')

@section('title', 'SWOT / PESTEL')

@section('content')
<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="space-y-10 fade-in">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between border-b pb-4">
        <div>
            <h1 class="text-3xl font-semibold text-gray-800">
                <i class="fa-solid fa-chart-line text-blue-600 mr-2"></i>
                Analyse SWOT & PESTEL
            </h1>
            <p class="text-gray-500 mt-1">Module d’analyse stratégique et contextuelle du SMQ — ISO 9001:2015 Clauses 4.1 & 6.1</p>
        </div>
    </div>

    <!-- SECTION 1 : ANALYSE PESTEL -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-earth-europe text-blue-500"></i> Analyse PESTEL
        </h2>
        <p class="text-gray-600 mb-6">Identifiez les facteurs externes influençant votre système de management de la qualité.</p>

        <!-- Facteurs PESTEL -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-blue-700"><i class="fa-solid fa-gavel mr-2"></i> Politique</h3>
                <p class="text-gray-600 text-sm mt-1">Stabilité gouvernementale, politiques industrielles, régulations fiscales.</p>
            </div>
            <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-green-700"><i class="fa-solid fa-sack-dollar mr-2"></i> Économique</h3>
                <p class="text-gray-600 text-sm mt-1">Inflation, croissance, taux d’intérêt, accès au financement.</p>
            </div>
            <div class="bg-orange-50 border-l-4 border-orange-600 p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-orange-700"><i class="fa-solid fa-people-group mr-2"></i> Socioculturel</h3>
                <p class="text-gray-600 text-sm mt-1">Valeurs sociales, culture d’entreprise, comportement des clients.</p>
            </div>
            <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-indigo-700"><i class="fa-solid fa-microchip mr-2"></i> Technologique</h3>
                <p class="text-gray-600 text-sm mt-1">Innovation, digitalisation, cybersécurité, obsolescence technologique.</p>
            </div>
            <div class="bg-emerald-50 border-l-4 border-emerald-600 p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-emerald-700"><i class="fa-solid fa-leaf mr-2"></i> Environnemental</h3>
                <p class="text-gray-600 text-sm mt-1">Normes écologiques, durabilité, empreinte carbone.</p>
            </div>
            <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-red-700"><i class="fa-solid fa-scale-balanced mr-2"></i> Légal</h3>
                <p class="text-gray-600 text-sm mt-1">Conformité réglementaire, propriété intellectuelle, droit du travail.</p>
            </div>
        </div>

        <!-- Graphique radar -->
        <div class="mt-8">
            <canvas id="pestelChart" class="w-full h-72"></canvas>
        </div>
    </section>

    <!-- SECTION 2 : ANALYSE SWOT -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chess text-blue-500"></i> Analyse SWOT
        </h2>
        <p class="text-gray-600 mb-6">Évaluez les forces, faiblesses, opportunités et menaces liées à votre organisation.</p>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded-lg">
                <h3 class="font-semibold text-green-700"><i class="fa-solid fa-thumbs-up mr-2"></i> Forces</h3>
                <ul class="text-gray-600 text-sm mt-2 space-y-1 list-disc pl-5">
                    <li>Personnel qualifié et engagé</li>
                    <li>Infrastructure technologique moderne</li>
                    <li>Bonne réputation auprès des clients</li>
                </ul>
            </div>

            <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg">
                <h3 class="font-semibold text-red-700"><i class="fa-solid fa-triangle-exclamation mr-2"></i> Faiblesses</h3>
                <ul class="text-gray-600 text-sm mt-2 space-y-1 list-disc pl-5">
                    <li>Dépendance à quelques clients clés</li>
                    <li>Processus internes encore manuels</li>
                </ul>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-lg">
                <h3 class="font-semibold text-blue-700"><i class="fa-solid fa-lightbulb mr-2"></i> Opportunités</h3>
                <ul class="text-gray-600 text-sm mt-2 space-y-1 list-disc pl-5">
                    <li>Expansion vers de nouveaux marchés</li>
                    <li>Adoption d’outils digitaux de qualité (QMS intelligent)</li>
                </ul>
            </div>

            <div class="bg-orange-50 border-l-4 border-orange-600 p-4 rounded-lg">
                <h3 class="font-semibold text-orange-700"><i class="fa-solid fa-skull-crossbones mr-2"></i> Menaces</h3>
                <ul class="text-gray-600 text-sm mt-2 space-y-1 list-disc pl-5">
                    <li>Concurrence accrue</li>
                    <li>Évolution rapide des normes</li>
                </ul>
            </div>
        </div>

        <!-- Graphique SWOT -->
        <div class="mt-8">
            <canvas id="swotChart" class="w-full h-72"></canvas>
        </div>
    </section>

    <!-- SECTION 3 : ANALYSE AVANCÉE & TENDANCES -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-brain text-blue-500"></i> Synthèse Avancée & TOWS
        </h2>
        <p class="text-gray-600 mb-6">Croisez vos données SWOT pour définir des stratégies (TOWS) et visualisez les tendances de risques et opportunités.</p>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg border">
                <h3 class="font-semibold text-gray-700 mb-2"><i class="fa-solid fa-crosshairs mr-2 text-blue-500"></i> Matrice TOWS</h3>
                <table class="w-full text-sm text-left text-gray-600 border">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2">Stratégies</th>
                            <th class="px-3 py-2">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-3 py-2 font-semibold">SO (Forces-Opportunités)</td>
                            <td class="px-3 py-2">Exploiter la compétence interne pour saisir de nouveaux marchés.</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-3 py-2 font-semibold">ST (Forces-Menaces)</td>
                            <td class="px-3 py-2">Utiliser la réputation pour contrer la concurrence.</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-3 py-2 font-semibold">WO (Faiblesses-Opportunités)</td>
                            <td class="px-3 py-2">Digitaliser les processus pour réduire les faiblesses.</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-3 py-2 font-semibold">WT (Faiblesses-Menaces)</td>
                            <td class="px-3 py-2">Mettre en place un plan de continuité pour limiter les risques.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border">
                <h3 class="font-semibold text-gray-700 mb-2"><i class="fa-solid fa-chart-line mr-2 text-green-500"></i> Tendances des Risques & Opportunités</h3>
                <canvas id="trendChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </section>

    <!-- SECTION 4 : OUTILS D’ANALYSE DES RISQUES -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation text-blue-500"></i> Outils d’Analyse des Risques et Opportunités
        </h2>
        <ul class="list-disc pl-6 text-gray-600 space-y-2">
            <li><strong>Analyse de criticité :</strong> croisement probabilité / gravité pour hiérarchiser les risques.</li>
            <li><strong>Cartographie des risques :</strong> représentation graphique pour visualiser les zones critiques.</li>
            <li><strong>Analyse prédictive :</strong> identification des tendances à partir des données historiques.</li>
            <li><strong>Alertes intelligentes :</strong> détection automatique des écarts et notifications proactives.</li>
        </ul>
    </section>
</div>

{{-- CHARTS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // PESTEL Radar Chart
    const pestelCtx = document.getElementById('pestelChart').getContext('2d');
    new Chart(pestelCtx, {
        type: 'radar',
        data: {
            labels: ['Politique', 'Économique', 'Socioculturel', 'Technologique', 'Environnemental', 'Légal'],
            datasets: [{
                label: 'Impact (1-5)',
                data: [3, 4, 2, 5, 3, 4],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.3)'
            }]
        },
        options: { scales: { r: { beginAtZero: true, suggestedMax: 5 } } }
    });

    // SWOT Bubble Chart
    const swotCtx = document.getElementById('swotChart').getContext('2d');
    new Chart(swotCtx, {
        type: 'bubble',
        data: {
            datasets: [
                { label: 'Forces', data: [{x:1,y:5,r:12}], backgroundColor:'#22c55e' },
                { label: 'Faiblesses', data: [{x:2,y:2,r:10}], backgroundColor:'#ef4444' },
                { label: 'Opportunités', data: [{x:3,y:4,r:14}], backgroundColor:'#3b82f6' },
                { label: 'Menaces', data: [{x:4,y:3,r:13}], backgroundColor:'#f97316' },
            ]
        },
        options: {
            scales: { x: { display:false }, y: { display:false, beginAtZero:true } },
            plugins: { legend: { position:'bottom' } }
        }
    });

    // Tendance Risks & Opportunities Line Chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4'],
            datasets: [
                { label: 'Opportunités', data: [3,4,5,5], borderColor:'#22c55e', tension:0.3 },
                { label: 'Risques', data: [2,3,4,3], borderColor:'#ef4444', tension:0.3 }
            ]
        },
        options: { scales: { y: { beginAtZero: true, max:5 } } }
    });
</script>
@endsection
