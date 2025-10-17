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
                Analyse SWOT & PESTEL
            </h1>
            <p class="text-gray-500 mt-1">Module d’analyse stratégique et contextuelle du SMQ — ISO 9001:2015 Clauses 4.1 & 6.1</p>
        </div>
        <button id="openModal" class="mt-3 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            <i class="fa-solid fa-plus mr-1"></i> Ajouter une analyse
        </button>
    </div>

    <!-- SECTION 1 : PESTEL -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-earth-europe text-blue-500"></i> Analyse PESTEL
        </h2>
        <p class="text-gray-600 mb-6">Identifiez les facteurs externes influençant votre système de management de la qualité.</p>

        <div class="grid md:grid-cols-3 gap-6">
            @php
                $pestel = [
                    ['label'=>'Politique','icon'=>'fa-gavel','color'=>'blue','desc'=>'Stabilité gouvernementale, politiques industrielles, régulations fiscales.'],
                    ['label'=>'Économique','icon'=>'fa-sack-dollar','color'=>'green','desc'=>'Inflation, croissance, taux d’intérêt, accès au financement.'],
                    ['label'=>'Socioculturel','icon'=>'fa-people-group','color'=>'orange','desc'=>'Valeurs sociales, culture d’entreprise, comportement des clients.'],
                    ['label'=>'Technologique','icon'=>'fa-microchip','color'=>'indigo','desc'=>'Innovation, digitalisation, cybersécurité, obsolescence technologique.'],
                    ['label'=>'Environnemental','icon'=>'fa-leaf','color'=>'emerald','desc'=>'Normes écologiques, durabilité, empreinte carbone.'],
                    ['label'=>'Légal','icon'=>'fa-scale-balanced','color'=>'red','desc'=>'Conformité réglementaire, propriété intellectuelle, droit du travail.'],
                ];
            @endphp

            @foreach ($pestel as $f)
            <div class="bg-{{ $f['color'] }}-50 border-l-4 border-{{ $f['color'] }}-600 p-4 rounded-lg shadow-sm hover:shadow-md transition">
                <h3 class="font-semibold text-{{ $f['color'] }}-700 flex items-center">
                    <i class="fa-solid {{ $f['icon'] }} mr-2"></i> {{ $f['label'] }}
                </h3>
                <p class="text-gray-600 text-sm mt-1">{{ $f['desc'] }}</p>
                <div class="mt-3">
                    <label class="block text-xs text-gray-500">Impact (1–5)</label>
                    <input type="range" min="1" max="5" value="3" class="pestel-range w-full accent-{{ $f['color'] }}-600">
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            <canvas id="pestelChart" class="w-full h-72"></canvas>
        </div>
    </section>

    <!-- SECTION 2 : SWOT -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chess text-blue-500"></i> Analyse SWOT
        </h2>

        <div class="grid md:grid-cols-2 gap-6">
            @php
                $swot = [
                    ['label'=>'Forces','icon'=>'fa-thumbs-up','color'=>'green','items'=>['Personnel qualifié','Infrastructure moderne','Bonne réputation']],
                    ['label'=>'Faiblesses','icon'=>'fa-triangle-exclamation','color'=>'red','items'=>['Dépendance à quelques clients','Processus internes manuels']],
                    ['label'=>'Opportunités','icon'=>'fa-lightbulb','color'=>'blue','items'=>['Expansion marché','Digitalisation du SMQ']],
                    ['label'=>'Menaces','icon'=>'fa-skull-crossbones','color'=>'orange','items'=>['Concurrence accrue','Évolution rapide des normes']],
                ];
            @endphp

            @foreach ($swot as $s)
            <div class="bg-{{ $s['color'] }}-50 border-l-4 border-{{ $s['color'] }}-600 p-4 rounded-lg">
                <h3 class="font-semibold text-{{ $s['color'] }}-700 flex items-center">
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

        <div class="mt-8">
            <canvas id="swotChart" class="w-full h-72"></canvas>
        </div>
    </section>

    <!-- SECTION 3 : TOWS & TENDANCES -->
    <section class="bg-white shadow rounded-2xl p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-brain text-blue-500"></i> Synthèse Avancée & TOWS
        </h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg border overflow-x-auto">
                <table class="w-full text-sm text-gray-600 border">
                    <thead class="bg-gray-100">
                        <tr><th class="px-3 py-2">Stratégie</th><th class="px-3 py-2">Description</th></tr>
                    </thead>
                    <tbody>
                        <tr class="border-t"><td class="px-3 py-2 font-semibold">SO</td><td class="px-3 py-2">Exploiter les forces pour saisir les opportunités.</td></tr>
                        <tr class="border-t"><td class="px-3 py-2 font-semibold">ST</td><td class="px-3 py-2">Utiliser les forces pour contrer les menaces.</td></tr>
                        <tr class="border-t"><td class="px-3 py-2 font-semibold">WO</td><td class="px-3 py-2">Réduire les faiblesses en profitant des opportunités.</td></tr>
                        <tr class="border-t"><td class="px-3 py-2 font-semibold">WT</td><td class="px-3 py-2">Atténuer les faiblesses face aux menaces.</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border">
                <h3 class="font-semibold text-gray-700 mb-2 flex items-center"><i class="fa-solid fa-chart-line mr-2 text-green-500"></i> Tendances</h3>
                <canvas id="trendChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </section>

</div>

<!-- MODAL SAISIE -->
<div id="modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-lg relative">
        <button id="closeModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
        <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
            <i class="fa-solid fa-pen-to-square text-blue-600 mr-2"></i> Nouvelle Entrée SWOT/PESTEL
        </h3>
        <form id="addForm" class="space-y-4">
            <div>
                <label class="text-sm text-gray-600">Catégorie</label>
                <select class="w-full border-gray-300 rounded-lg mt-1">
                    <option>PESTEL - Politique</option>
                    <option>PESTEL - Économique</option>
                    <option>SWOT - Force</option>
                    <option>SWOT - Faiblesse</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Description</label>
                <textarea rows="3" class="w-full border-gray-300 rounded-lg mt-1"></textarea>
            </div>
            <button type="button" id="saveItem" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                <i class="fa-solid fa-check mr-1"></i> Enregistrer
            </button>
        </form>
    </div>
</div>

{{-- CHARTS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Radar PESTEL
    const pestelCtx = document.getElementById('pestelChart');
    const pestelChart = new Chart(pestelCtx, {
        type: 'radar',
        data: {
            labels: ['Politique','Économique','Socioculturel','Technologique','Environnemental','Légal'],
            datasets: [{ label: 'Impact', data:[3,4,3,4,2,3], borderColor:'#2563eb', backgroundColor:'rgba(37,99,235,0.3)' }]
        },
        options: { scales:{ r:{ suggestedMax:5 } }, plugins:{ legend:{ display:false } } }
    });
    document.querySelectorAll('.pestel-range').forEach((r,i)=>{
        r.addEventListener('input',()=>{
            pestelChart.data.datasets[0].data[i]=parseInt(r.value);
            pestelChart.update();
        });
    });

    // SWOT Bubble Chart
    new Chart(document.getElementById('swotChart'), {
        type:'bubble',
        data:{
            datasets:[
                {label:'Forces',data:[{x:1,y:5,r:12}],backgroundColor:'#22c55e'},
                {label:'Faiblesses',data:[{x:2,y:2,r:10}],backgroundColor:'#ef4444'},
                {label:'Opportunités',data:[{x:3,y:4,r:14}],backgroundColor:'#3b82f6'},
                {label:'Menaces',data:[{x:4,y:3,r:13}],backgroundColor:'#f97316'}
            ]
        },
        options:{ scales:{x:{display:false},y:{display:false}}, plugins:{legend:{position:'bottom'}} }
    });

    // Tendances
    new Chart(document.getElementById('trendChart'), {
        type:'line',
        data:{
            labels:['T1','T2','T3','T4'],
            datasets:[
                {label:'Opportunités',data:[3,4,5,5],borderColor:'#22c55e',tension:.3},
                {label:'Risques',data:[2,3,4,3],borderColor:'#ef4444',tension:.3}
            ]
        },
        options:{ scales:{y:{beginAtZero:true,max:5}} }
    });

    // Modal
    const modal=document.getElementById('modal');
    document.getElementById('openModal').onclick=()=>modal.classList.remove('hidden');
    document.getElementById('closeModal').onclick=()=>modal.classList.add('hidden');
    document.getElementById('saveItem').onclick=()=>{
        alert('Élément enregistré localement (simulation)');
        modal.classList.add('hidden');
    };
</script>
@endsection
