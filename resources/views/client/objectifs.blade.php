@extends('layouts.clients')

@section('title', 'Objectifs Qualité')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body { background-color: #f8fafc; }

    .page-container {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
        padding: 1rem 0;
    }

    .card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        padding: 2rem;
        transition: all 0.25s ease-in-out;
    }
    .card:hover { transform: translateY(-4px); }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1d4ed8;
        display: flex;
        align-items: center;
        gap: 10px;
        border-left: 5px solid #1d4ed8;
        padding-left: 10px;
        margin-bottom: 1.2rem;
    }

    .charts-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        align-items: center;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 12px;
    }

    .table th, .table td {
        padding: 12px 14px;
        text-align: center;
    }

    .table th {
        background-color: #f1f5f9;
        font-weight: 600;
        color: #1f2937;
    }

    .table tr:nth-child(even) { background: #f9fafb; }

    .alert {
        background: #fee2e2;
        color: #991b1b;
        border-left: 6px solid #dc2626;
        padding: 1rem 1.2rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    ul li strong { color: #0f172a; }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #374151;
    }

    .form-group input, .form-group select, .form-group textarea {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 0.9rem;
        background-color: #f9fafb;
    }

    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none;
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }

    .btn-submit {
        background: #2563eb;
        color: white;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-submit:hover { background: #1e40af; }

    canvas { max-height: 320px !important; }
</style>

<div class="page-container">

    {{-- SECTION 1 : Objectifs Qualité & Performance --}}
    <div class="card">
        <h2 class="section-title">
            <i class="fa-solid fa-chart-line"></i> Objectifs Qualité & Performance
        </h2>
        <div class="charts-container">
            <div>
                <canvas id="objectifsChart"></canvas>
            </div>
            <div>
                <canvas id="kpiChart"></canvas>
            </div>
        </div>
    </div>

    {{-- SECTION 2 : Formulaire d’ajout d’un Objectif Qualité --}}
    <div class="card">
        <h2 class="section-title">
            <i class="fa-solid fa-pen-to-square"></i> Définir un Nouvel Objectif Qualité
        </h2>

        <form id="objectifForm">
            <div class="form-grid">
                <div class="form-group">
                    <label>Intitulé de l’objectif</label>
                    <input type="text" placeholder="Ex : Améliorer la satisfaction client" required>
                </div>

                <div class="form-group">
                    <label>Processus associé</label>
                    <select>
                        <option>-- Sélectionner --</option>
                        <option>Commercial</option>
                        <option>Production</option>
                        <option>Contrôle Qualité</option>
                        <option>Support Client</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>KPI associé</label>
                    <select>
                        <option>-- Sélectionner --</option>
                        <option>NPS (Satisfaction Client)</option>
                        <option>Taux de Non-Conformités</option>
                        <option>Taux de Livraison à Temps</option>
                        <option>Taux de Productivité</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Responsable</label>
                    <input type="text" placeholder="Ex : Responsable Qualité">
                </div>

                <div class="form-group">
                    <label>Échéance</label>
                    <input type="date">
                </div>

                <div class="form-group">
                    <label>Valeur Cible (%)</label>
                    <input type="number" placeholder="Ex : 90">
                </div>

                <div class="form-group">
                    <label>Statut</label>
                    <select>
                        <option>En cours</option>
                        <option>Atteint</option>
                        <option>En retard</option>
                    </select>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>Description SMART</label>
                    <textarea rows="3" placeholder="Décrire en quoi cet objectif est Spécifique, Mesurable, Atteignable, Réaliste et Temporel."></textarea>
                </div>
            </div>

            <div class="mt-4 text-right">
                <button type="submit" class="btn-submit"><i class="fa-solid fa-check"></i> Enregistrer</button>
            </div>
        </form>
    </div>

    {{-- SECTION 3 : Suivi SMART --}}
    <div class="card">
        <h2 class="section-title">
            <i class="fa-solid fa-bullseye"></i> Suivi des Objectifs SMART
        </h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Objectif</th>
                    <th>Spécifique</th>
                    <th>Mesurable</th>
                    <th>Atteignable</th>
                    <th>Réaliste</th>
                    <th>Temporel</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Améliorer la satisfaction client</td>
                    <td>Note NPS > 85%</td>
                    <td>Suivi mensuel</td>
                    <td>Oui</td>
                    <td>Basé sur retours clients</td>
                    <td>Décembre 2025</td>
                    <td><span class="text-green-600 font-semibold">En bonne voie</span></td>
                </tr>
                <tr>
                    <td>Réduire les non-conformités</td>
                    <td>-25% d'ici fin 2025</td>
                    <td>Rapport trimestriel</td>
                    <td>Oui</td>
                    <td>Basé sur données internes</td>
                    <td>Fin 2025</td>
                    <td><span class="text-yellow-600 font-semibold">À surveiller</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- SECTION 4 : Liaison aux KPIs et Processus --}}
    <div class="card">
        <h2 class="section-title">
            <i class="fa-solid fa-link"></i> Liaison aux KPIs et Processus
        </h2>
        <ul class="list-disc ml-6 space-y-2 text-gray-700 leading-relaxed">
            <li><strong>Satisfaction Client</strong> → KPI : NPS, taux de fidélisation, délai de réponse.</li>
            <li><strong>Réduction des Non-Conformités</strong> → Processus : contrôle qualité, audit interne, CAPA.</li>
            <li><strong>Efficacité Opérationnelle</strong> → KPI : taux de conformité des livrables, rendement global.</li>
        </ul>
    </div>

    {{-- SECTION 5 : Alertes & Analyse Prédictive --}}
    <div class="card">
        <h2 class="section-title">
            <i class="fa-solid fa-bell"></i> Alertes & Analyse Prédictive
        </h2>

        <div class="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Risque détecté : <strong>diminution prévue de 5%</strong> du taux de satisfaction client sur les 2 prochains mois.
        </div>

        <p class="text-gray-700 mb-4">
            <strong>Suggestion automatique :</strong> renforcer la communication post-livraison et mener une enquête ciblée pour anticiper les causes.
        </p>

        <canvas id="predictionChart"></canvas>
    </div>

</div>

<script>
    // Graphique Objectifs Qualité
    new Chart(document.getElementById('objectifsChart'), {
        type: 'bar',
        data: {
            labels: ['Satisfaction Client', 'Non-Conformités', 'Formation', 'Productivité'],
            datasets: [{
                label: 'Progression (%)',
                data: [82, 65, 90, 75],
                backgroundColor: ['#3b82f6', '#ef4444', '#10b981', '#f59e0b'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Progression des Objectifs Qualité', font: { size: 16, weight: 'bold' } },
                legend: { display: false }
            },
            scales: { y: { beginAtZero: true, max: 100, ticks: { callback: v => v + '%' } } }
        }
    });

    // Graphique KPIs
    new Chart(document.getElementById('kpiChart'), {
        type: 'doughnut',
        data: {
            labels: ['Atteint', 'Restant'],
            datasets: [{ data: [72, 28], backgroundColor: ['#16a34a', '#e5e7eb'], borderWidth: 0 }]
        },
        options: {
            cutout: '70%',
            plugins: {
                title: { display: true, text: 'Taux d’Atteinte des KPIs', font: { size: 16, weight: 'bold' } },
                legend: { display: true, position: 'bottom' }
            }
        }
    });

    // Graphique prédictif
    new Chart(document.getElementById('predictionChart'), {
        type: 'line',
        data: {
            labels: ['Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Satisfaction Client (%)',
                data: [88, 87, 85, 83, 82, 80, 78],
                borderColor: '#1d4ed8',
                backgroundColor: 'rgba(29,78,216,0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointBackgroundColor: '#1d4ed8'
            }]
        },
        options: {
            plugins: {
                title: { display: true, text: 'Projection Prédictive de Satisfaction Client', font: { size: 16, weight: 'bold' } },
                legend: { display: false }
            },
            scales: { y: { min: 70, max: 100, ticks: { callback: v => v + '%' } } }
        }
    });
</script>
@endsection
