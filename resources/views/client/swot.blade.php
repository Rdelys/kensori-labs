@extends('layouts.clients')

@section('title', 'SWOT / PESTEL')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="space-y-10 fade-in">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between border-b pb-4">
        <div>
            <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-blue-600"></i>
                SWOT & PESTEL
            </h1>
        </div>
        <button id="toggleForm" class="mt-3 md:mt-0 bg-gradient-to-r from-blue-600 to-blue-500 hover:shadow-lg text-white px-4 py-2 rounded-xl shadow transition">
            <i class="fa-solid fa-plus mr-1"></i> Ajouter une analyse
        </button>
    </div>

    <!-- 🔹 FORMULAIRE AFFICHABLE / MASQUABLE -->
    <section id="analysisFormSection" class="hidden bg-white shadow-lg rounded-2xl p-6 border border-blue-100 animate-fadeIn">
        <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
            <i class="fa-solid fa-pen-to-square text-blue-600 mr-2"></i> Nouvelle Entrée SWOT / PESTEL
        </h3>
        <form id="addForm" class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="text-sm text-gray-600">Catégorie</label>
                <select id="category" class="w-full border-gray-300 rounded-lg mt-1 focus:ring-blue-500 focus:border-blue-500">
                    <option>PESTEL - Politique</option>
                    <option>PESTEL - Économique</option>
                    <option>PESTEL - Socioculturel</option>
                    <option>PESTEL - Technologique</option>
                    <option>PESTEL - Environnemental</option>
                    <option>PESTEL - Légal</option>
                    <option>SWOT - Force</option>
                    <option>SWOT - Faiblesse</option>
                    <option>SWOT - Opportunité</option>
                    <option>SWOT - Menace</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Impact / Importance (1 à 5)</label>
                <input id="impact" type="range" min="1" max="5" value="3" class="w-full accent-blue-600">
            </div>
            <div class="md:col-span-2">
                <label class="text-sm text-gray-600">Description</label>
                <textarea id="description" rows="3" class="w-full border-gray-300 rounded-lg mt-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Décrivez brièvement l’élément analysé..."></textarea>
            </div>
            <div class="md:col-span-2 flex justify-end gap-2">
                <button type="button" id="cancelForm" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition">
                    <i class="fa-solid fa-xmark mr-1"></i> Annuler
                </button>
                <button type="button" id="saveItem" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    <i class="fa-solid fa-check mr-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </section>

    <!-- 🧭 SECTION 1 : PESTEL -->
    <section class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-earth-europe text-blue-500"></i> Analyse PESTEL (Facteurs Externes)
        </h2>
        <p class="text-gray-600 mb-6">
            Identifiez les <strong>facteurs macro-environnementaux</strong> pouvant impacter le système de management de la qualité.
        </p>

        <div class="grid md:grid-cols-3 gap-6">
            @php
                $pestel = [
                    ['label'=>'Politique','icon'=>'fa-gavel','color'=>'blue','desc'=>'Stabilité gouvernementale, régulations, politiques publiques.'],
                    ['label'=>'Économique','icon'=>'fa-sack-dollar','color'=>'green','desc'=>'Inflation, croissance, accès au financement, taux de change.'],
                    ['label'=>'Socioculturel','icon'=>'fa-people-group','color'=>'orange','desc'=>'Valeurs sociales, comportements clients, évolution des besoins.'],
                    ['label'=>'Technologique','icon'=>'fa-microchip','color'=>'indigo','desc'=>'Digitalisation, IA, innovation, cybersécurité, veille techno.'],
                    ['label'=>'Environnemental','icon'=>'fa-leaf','color'=>'emerald','desc'=>'Durabilité, empreinte carbone, conformité environnementale.'],
                    ['label'=>'Légal','icon'=>'fa-scale-balanced','color'=>'red','desc'=>'Lois, normes, propriété intellectuelle, droit du travail.'],
                ];
            @endphp

            @foreach ($pestel as $f)
            <div class="bg-{{ $f['color'] }}-50 border-l-4 border-{{ $f['color'] }}-600 p-4 rounded-xl shadow-sm hover:shadow-md transition transform hover:-translate-y-1">
                <h3 class="font-semibold text-{{ $f['color'] }}-700 flex items-center text-base">
                    <i class="fa-solid {{ $f['icon'] }} mr-2"></i> {{ $f['label'] }}
                </h3>
                <p class="text-gray-600 text-sm mt-1 leading-relaxed">{{ $f['desc'] }}</p>
                <div class="mt-3">
                    <label class="block text-xs text-gray-500">Impact (1–5)</label>
                    <input type="range" min="1" max="5" value="3" class="pestel-range w-full accent-{{ $f['color'] }}-600">
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
            <div class="w-full max-w-xl">
                <canvas id="pestelChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </section>

    <!-- ⚙️ SECTION 2 : SWOT -->
    <section class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chess text-blue-500"></i> Analyse SWOT (Facteurs Internes)
        </h2>

        <div class="grid md:grid-cols-2 gap-6">
            @php
                $swot = [
                    ['label'=>'Forces','icon'=>'fa-thumbs-up','color'=>'green','items'=>['Compétences clés','Réactivité client','Leadership qualité']],
                    ['label'=>'Faiblesses','icon'=>'fa-triangle-exclamation','color'=>'red','items'=>['Systèmes obsolètes','Manque d’automatisation']],
                    ['label'=>'Opportunités','icon'=>'fa-lightbulb','color'=>'blue','items'=>['Croissance du marché digital','Partenariats stratégiques']],
                    ['label'=>'Menaces','icon'=>'fa-skull-crossbones','color'=>'orange','items'=>['Concurrence accrue','Instabilité réglementaire']],
                ];
            @endphp

            @foreach ($swot as $s)
            <div class="bg-{{ $s['color'] }}-50 border-l-4 border-{{ $s['color'] }}-600 p-4 rounded-xl shadow-sm hover:shadow-md transition transform hover:-translate-y-1">
                <h3 class="font-semibold text-{{ $s['color'] }}-700 flex items-center text-base">
                    <i class="fa-solid {{ $s['icon'] }} mr-2"></i> {{ $s['label'] }}
                </h3>
                <ul class="text-gray-600 text-sm mt-2 space-y-1 list-disc pl-5">
                    @foreach ($s['items'] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
                <button class="text-xs text-{{ $s['color'] }}-700 hover:underline mt-2 add-item" data-type="{{ $s['label'] }}">+ Ajouter</button>
            </div>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
            <div class="w-full max-w-xl">
                <canvas id="swotChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </section>

    <!-- 🔍 SYNTHÈSE TOWS -->
    <section class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-brain text-blue-500"></i> Synthèse Stratégique (TOWS)
        </h2>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg border overflow-x-auto shadow-sm">
                <table class="w-full text-sm text-gray-600 border rounded-xl overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 font-semibold text-gray-700">Stratégie</th>
                            <th class="px-3 py-2 font-semibold text-gray-700">Orientation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t hover:bg-gray-50"><td class="px-3 py-2 font-semibold">SO</td><td class="px-3 py-2">Exploiter les forces pour saisir les opportunités.</td></tr>
                        <tr class="border-t hover:bg-gray-50"><td class="px-3 py-2 font-semibold">ST</td><td class="px-3 py-2">Utiliser les forces pour contrer les menaces.</td></tr>
                        <tr class="border-t hover:bg-gray-50"><td class="px-3 py-2 font-semibold">WO</td><td class="px-3 py-2">Réduire les faiblesses en profitant des opportunités.</td></tr>
                        <tr class="border-t hover:bg-gray-50"><td class="px-3 py-2 font-semibold">WT</td><td class="px-3 py-2">Atténuer les faiblesses face aux menaces.</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="fa-solid fa-chart-line mr-2 text-green-500"></i> Évolution Risques / Opportunités
                </h3>
                <div class="w-full h-60">
                    <canvas id="trendChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- CHARTS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Radar PESTEL dynamique
    const pestelCtx = document.getElementById('pestelChart');
    const pestelChart = new Chart(pestelCtx, {
        type: 'radar',
        data: {
            labels: ['Politique','Économique','Socioculturel','Technologique','Environnemental','Légal'],
            datasets: [{ label: 'Impact', data:[3,4,3,4,2,3], borderColor:'#2563eb', backgroundColor:'rgba(37,99,235,0.25)' }]
        },
        options: { scales:{ r:{ suggestedMax:5 } }, plugins:{ legend:{ display:false } } }
    });
    document.querySelectorAll('.pestel-range').forEach((r,i)=>{
        r.addEventListener('input',()=>{
            pestelChart.data.datasets[0].data[i]=parseInt(r.value);
            pestelChart.update();
        });
    });

    // SWOT Chart
    new Chart(document.getElementById('swotChart'), {
        type:'bubble',
        data:{
            datasets:[
                {label:'Forces',data:[{x:1,y:5,r:10}],backgroundColor:'#22c55e'},
                {label:'Faiblesses',data:[{x:2,y:2,r:9}],backgroundColor:'#ef4444'},
                {label:'Opportunités',data:[{x:3,y:4,r:11}],backgroundColor:'#3b82f6'},
                {label:'Menaces',data:[{x:4,y:3,r:10}],backgroundColor:'#f97316'}
            ]
        },
        options:{ scales:{x:{display:false},y:{display:false}}, plugins:{legend:{position:'bottom'}} }
    });

    // Trend Chart
    new Chart(document.getElementById('trendChart'), {
        type:'line',
        data:{
            labels:['T1','T2','T3','T4'],
            datasets:[
                {label:'Opportunités',data:[3,4,5,5],borderColor:'#22c55e',tension:.35},
                {label:'Risques',data:[2,3,4,3],borderColor:'#ef4444',tension:.35}
            ]
        },
        options:{ scales:{y:{beginAtZero:true,max:5}}, plugins:{legend:{position:'bottom'}} }
    });

    // 🎛️ Formulaire Toggle
    const toggleBtn = document.getElementById('toggleForm');
    const formSection = document.getElementById('analysisFormSection');
    const cancelBtn = document.getElementById('cancelForm');

    toggleBtn.addEventListener('click', () => {
        formSection.classList.toggle('hidden');
    });
    cancelBtn.addEventListener('click', () => {
        formSection.classList.add('hidden');
    });

    // Simulation d’enregistrement
    document.getElementById('saveItem').addEventListener('click', () => {
        alert('Nouvelle entrée SWOT/PESTEL enregistrée localement (simulation).');
        formSection.classList.add('hidden');
    });
</script>

<style>
    .animate-fadeIn {
        animation: fadeIn .3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
