@extends('layouts.clients')

@section('title', 'Parties intéressées & Contexte de l’organisation')

@section('content')
<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- 🌟 STYLE SIMPLIFIÉ FOND BLANC -->
<style>
/* ===== VARIABLES GLOBALES ===== */
:root {
    --primary: #2563eb;
    --primary-light: rgba(37, 99, 235, 0.1);
    --primary-dark: #1d4ed8;
    --success: #16a34a;
    --success-light: rgba(22, 163, 74, 0.1);
    --warning: #f59e0b;
    --warning-light: rgba(245, 158, 11, 0.1);
    --danger: #dc2626;
    --danger-light: rgba(220, 38, 38, 0.1);
    --info: #0891b2;
    --info-light: rgba(8, 145, 178, 0.1);
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 14px;
    --radius-xl: 18px;
    --transition: all 0.2s ease;
}

/* ===== RESET & BASE ===== */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: var(--gray-800);
    background: #ffffff; /* Fond blanc pur */
    line-height: 1.5;
}

/* ===== LAYOUT ===== */
.container-main {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1.5rem;
    background: #ffffff; /* Assurance fond blanc */
}

/* ===== HEADER ===== */
.page-header {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-md);
}

.page-header-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

@media (min-width: 768px) {
    .page-header-content {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

.page-title {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-icon {
    width: 48px;
    height: 48px;
    background: var(--primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.page-text h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--gray-900);
    margin: 0;
}

.page-text p {
    color: var(--gray-600);
    font-size: 0.95rem;
    margin-top: 0.5rem;
    max-width: 600px;
}

.header-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

/* ===== SECTIONS ===== */
.section {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.section:hover {
    box-shadow: var(--shadow-md);
}

.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--gray-100);
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-icon {
    width: 40px;
    height: 40px;
    background: var(--primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.section-title h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
}

.section-subtitle {
    color: var(--gray-600);
    font-size: 0.9rem;
    margin-top: 0.25rem;
}

.section-actions {
    display: flex;
    gap: 0.5rem;
}

/* ===== FORMULAIRES ===== */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.25rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 1px solid var(--gray-300);
    border-radius: var(--radius-md);
    font-size: 0.95rem;
    color: var(--gray-800);
    transition: var(--transition);
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

textarea.form-control {
    min-height: 100px;
    resize: vertical;
    line-height: 1.5;
}

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232563eb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.25rem;
    padding-right: 2.5rem;
}

/* Range slider */
.range-slider {
    width: 100%;
    height: 6px;
    -webkit-appearance: none;
    appearance: none;
    background: var(--gray-200);
    border-radius: 3px;
    outline: none;
    margin-top: 0.5rem;
}

.range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    background: white;
    border: 2px solid var(--primary);
    border-radius: 50%;
    cursor: pointer;
    box-shadow: var(--shadow-sm);
}

.range-slider-value {
    display: inline-block;
    margin-left: 0.75rem;
    font-weight: 600;
    color: var(--primary);
    background: var(--primary-light);
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
    font-size: 0.8rem;
}

/* ===== BOUTONS ===== */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: var(--radius-md);
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--primary);
    color: var(--primary);
}

.btn-outline:hover {
    background: var(--primary-light);
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
}

.btn-icon {
    width: 36px;
    height: 36px;
    padding: 0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===== TABLEAUX ===== */
.table-container {
    overflow-x: auto;
    border-radius: var(--radius-lg);
    border: 1px solid var(--gray-200);
    background: #ffffff;
    margin-bottom: 1.5rem;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

.data-table thead {
    background: var(--gray-50);
}

.data-table th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: var(--gray-700);
    border-bottom: 2px solid var(--gray-200);
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.data-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--gray-100);
    vertical-align: middle;
    color: var(--gray-700);
}

.data-table tbody tr:hover {
    background: var(--gray-50);
}

.data-table tbody tr:last-child td {
    border-bottom: none;
}

/* Badges */
.table-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-client {
    background: var(--primary-light);
    color: var(--primary);
}

.badge-supplier {
    background: var(--success-light);
    color: var(--success);
}

.badge-high {
    background: var(--danger-light);
    color: var(--danger);
}

.badge-medium {
    background: var(--warning-light);
    color: var(--warning);
}

/* ===== GRAPHIQUES ===== */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.chart-card {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.chart-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.chart-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-900);
}

.chart-container {
    height: 250px;
    position: relative;
}

/* ===== SWOT ANALYSIS ===== */
.swot-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.swot-card {
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    background: #ffffff;
    border: 1px solid;
}

.swot-strengths {
    border-color: var(--success);
    background: var(--success-light);
}

.swot-weaknesses {
    border-color: var(--danger);
    background: var(--danger-light);
}

.swot-opportunities {
    border-color: var(--primary);
    background: var(--primary-light);
}

.swot-threats {
    border-color: var(--warning);
    background: var(--warning-light);
}

.swot-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.swot-icon {
    width: 32px;
    height: 32px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
}

.swot-strengths .swot-icon {
    background: var(--success);
}

.swot-weaknesses .swot-icon {
    background: var(--danger);
}

.swot-opportunities .swot-icon {
    background: var(--primary);
}

.swot-threats .swot-icon {
    background: var(--warning);
}

.swot-header h3 {
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
}

.swot-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.swot-list li {
    padding: 0.5rem 0;
    border-bottom: 1px dashed rgba(0,0,0,0.1);
    font-size: 0.9rem;
    color: var(--gray-700);
}

.swot-list li:last-child {
    border-bottom: none;
}

.swot-list li::before {
    content: '•';
    margin-right: 0.5rem;
}

/* ===== PROCESS MAP ===== */
.process-map-container {
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    border: 1px dashed var(--gray-300);
    min-height: 400px;
    position: relative;
    overflow: hidden;
    margin-bottom: 1rem;
    background-image: 
        linear-gradient(to right, var(--gray-200) 1px, transparent 1px),
        linear-gradient(to bottom, var(--gray-200) 1px, transparent 1px);
    background-size: 40px 40px;
}

.process-node {
    position: absolute;
    background: #ffffff;
    border: 1px solid;
    border-radius: var(--radius-md);
    padding: 1rem;
    min-width: 180px;
    cursor: move;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.process-node:hover {
    box-shadow: var(--shadow-md);
    z-index: 10;
}

.process-node-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid;
}

.process-node-title {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 1rem;
}

.process-node-content {
    font-size: 0.85rem;
    color: var(--gray-600);
}

.process-node-process { border-color: var(--primary); }
.process-node-support { border-color: var(--success); }
.process-node-management { border-color: var(--warning); }

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .container-main {
        padding: 1rem;
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }
    
    .section {
        padding: 1.5rem;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .swot-grid {
        grid-template-columns: 1fr;
    }
    
    .header-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .header-actions .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .container-main {
        padding: 1rem;
    }
    
    .page-text h1 {
        font-size: 1.5rem;
    }
    
    .section-title h2 {
        font-size: 1.1rem;
    }
}
</style>

<div class="container-main">

    <!-- HEADER PRINCIPAL -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <div class="page-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="page-text">
                    <h1>Parties Intéressées & Contexte Organisationnel</h1>
                    <p>Module ISO 9001:2015 - Clauses 4.1 à 4.4 | Gestion complète du contexte qualité</p>
                </div>
            </div>
            <div class="header-actions">
                <button class="btn btn-primary">
                    <i class="fa-solid fa-user-plus"></i> Ajouter Partie
                </button>
                <button class="btn btn-outline">
                    <i class="fa-solid fa-file-export"></i> Exporter Rapport
                </button>
                <button class="btn btn-outline">
                    <i class="fa-solid fa-robot"></i> Analyse IA
                </button>
            </div>
        </div>
    </div>

    <!-- SECTION 1: CONTEXTE ORGANISATIONNEL -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <h2>Contexte de l'Organisation</h2>
                    <p class="section-subtitle">ISO 9001:2015 - Clause 4.1 | Analyse des enjeux internes et externes</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-outline">
                    <i class="fa-solid fa-history"></i> Historique
                </button>
                <button class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-save"></i> Sauvegarder
                </button>
            </div>
        </div>

        <form class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-users-gear"></i> Enjeux Internes
                </label>
                <textarea rows="4" class="form-control" placeholder="Culture organisationnelle, compétences, ressources, infrastructure, technologies internes, structure...">
- Culture qualité forte avec engagement de la direction
- Compétences techniques élevées mais vieillissement de la population
- Infrastructure moderne mais obsolescence programmée
- Processus bien documentés mais lourdeur administrative
                </textarea>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-globe"></i> Enjeux Externes
                </label>
                <textarea rows="4" class="form-control" placeholder="Environnement légal, économique, social, technologique, concurrentiel, écologique...">
- Nouvelle réglementation environnementale (RE2020)
- Concurrence accrue avec l'arrivée de nouveaux acteurs internationaux
- Évolution des attentes clients vers plus de digitalisation
- Risques géopolitiques affectant les chaînes d'approvisionnement
                </textarea>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-chart-line"></i> Méthode d'Analyse
                </label>
                <select class="form-control">
                    <option>PESTEL (Recommandé)</option>
                    <option>Analyse SWOT</option>
                    <option>Forces de Porter</option>
                    <option>Analyse VUCA</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-calendar-check"></i> Période de Révision
                </label>
                <select class="form-control">
                    <option>Trimestrielle</option>
                    <option selected>Semestrielle</option>
                    <option>Annuelle</option>
                </select>
            </div>
        </form>
    </section>

    <!-- SECTION 2: FORMULAIRE PARTIES INTÉRESSÉES -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div>
                    <h2>Enregistrement des Parties Intéressées</h2>
                    <p class="section-subtitle">ISO 9001:2015 - Clause 4.2 | Identification et suivi des parties pertinentes</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-success">
                    <i class="fa-solid fa-file-import"></i> Importer
                </button>
            </div>
        </div>

        <form class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-building"></i> Nom / Organisation
                </label>
                <input type="text" class="form-control" placeholder="Ex: Client ABC Corporation">
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-tag"></i> Catégorie
                </label>
                <select class="form-control">
                    <option>Client</option>
                    <option>Fournisseur</option>
                    <option>Employé</option>
                    <option>Actionnaire</option>
                    <option>Organisme de régulation</option>
                    <option>Communauté locale</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-bullseye"></i> Besoins et Attentes
                </label>
                <textarea rows="3" class="form-control" placeholder="Décrire les attentes, exigences et contraintes spécifiques..."></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-chart-simple"></i> Influence sur le SMQ
                </label>
                <input type="range" min="1" max="5" value="3" class="range-slider" id="influenceRange">
                <span class="range-slider-value">Moyenne (3/5)</span>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-user-tie"></i> Responsable
                </label>
                <input type="text" class="form-control" placeholder="Nom du responsable dédié">
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-comments"></i> Fréquence de Contact
                </label>
                <select class="form-control">
                    <option>Quotidien</option>
                    <option>Hebdomadaire</option>
                    <option>Mensuel</option>
                    <option>Trimestriel</option>
                </select>
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                    <button type="reset" class="btn btn-outline">
                        <i class="fa-solid fa-eraser"></i> Effacer
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </section>

    <!-- SECTION 3: BASE CENTRALISÉE -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-database"></i>
                </div>
                <div>
                    <h2>Base Centralisée des Parties Intéressées</h2>
                    <p class="section-subtitle">Vue d'ensemble et gestion des relations</p>
                </div>
            </div>
            <div class="section-actions">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="position: relative;">
                        <input type="text" placeholder="Rechercher..." class="form-control" style="padding-left: 2.5rem; width: 250px;">
                        <i class="fa-solid fa-search" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    </div>
                    <button class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-filter"></i> Filtrer
                    </button>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Partie Intéressée</th>
                        <th>Type</th>
                        <th>Besoins / Attentes</th>
                        <th>Influence</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #1d4ed8); display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">Client A Corporation</div>
                                    <div style="font-size: 0.85rem; color: var(--gray-500);">client@corp.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="table-badge badge-client">Client</span></td>
                        <td style="max-width: 300px;">
                            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                Qualité produit élevée, délais respectés, support technique réactif 24/7
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 100%; background: var(--danger);"></div>
                                </div>
                                <span class="table-badge badge-high">Élevée</span>
                            </div>
                        </td>
                        <td>
                            <span style="display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.85rem; color: var(--success);">
                                <i class="fa-solid fa-circle-check"></i> Actif
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button class="btn-icon btn-outline">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn-icon btn-outline">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn-icon btn-outline">
                                    <i class="fa-solid fa-chart-line"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #047857); display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fa-solid fa-truck"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">Fournisseur B Logistics</div>
                                    <div style="font-size: 0.85rem; color: var(--gray-500);">logistics@supplier.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="table-badge badge-supplier">Fournisseur</span></td>
                        <td style="max-width: 300px;">
                            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                Paiement sous 30 jours, commandes prévisionnelles, communication transparente
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 80%; background: var(--warning);"></div>
                                </div>
                                <span class="table-badge badge-medium">Moyenne</span>
                            </div>
                        </td>
                        <td>
                            <span style="display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.85rem; color: var(--warning);">
                                <i class="fa-solid fa-circle-exclamation"></i> En attente
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button class="btn-icon btn-outline">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn-icon btn-outline">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- SECTION 4: LIEN BESOINS ↔ PROCESSUS -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-link"></i>
                </div>
                <div>
                    <h2>Traçabilité : Exigences ↔ Processus ↔ Risques</h2>
                    <p class="section-subtitle">Association entre les attentes des parties et les processus impactés</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus"></i> Nouveau Lien
                </button>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Partie</th>
                        <th>Exigences Spécifiques</th>
                        <th>Processus Impactés</th>
                        <th>Indicateurs (KPIs)</th>
                        <th>Risques Associés</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Clients</strong></td>
                        <td>Qualité produit, délais livraison, support technique 24/7</td>
                        <td>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                <span class="table-badge badge-client">Production</span>
                                <span class="table-badge badge-supplier">Logistique</span>
                                <span class="table-badge" style="background: var(--info-light); color: var(--info);">Service Client</span>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                    <span>Taux de conformité:</span>
                                    <span style="font-weight: 600; color: var(--success);">98%</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                    <span>Délai moyen:</span>
                                    <span style="font-weight: 600; color: var(--primary);">3.2 jours</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                    <span>Satisfaction:</span>
                                    <span style="font-weight: 600; color: #8b5cf6;">4.5/5</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <span class="table-badge" style="background: var(--warning-light); color: var(--warning);">Non-conformité produit</span>
                                <span class="table-badge badge-high">Retard livraison</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Fournisseurs</strong></td>
                        <td>Paiement sous 30 jours, commandes prévisionnelles, qualité matière</td>
                        <td>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                <span class="table-badge badge-client">Achats</span>
                                <span class="table-badge badge-supplier">Logistique</span>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                    <span>Qualité matière:</span>
                                    <span style="font-weight: 600; color: var(--success);">95%</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                    <span>Délai fourn.:</span>
                                    <span style="font-weight: 600; color: var(--primary);">2.5 jours</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <span class="table-badge badge-high">Rupture stock</span>
                                <span class="table-badge" style="background: var(--warning-light); color: var(--warning);">Qualité insuffisante</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- SECTION 5: GRAPHIQUES -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fa-solid fa-chart-column" style="color: var(--primary);"></i>
                    <span>Niveau d'Influence des Parties</span>
                </div>
                <button class="btn btn-sm btn-outline">
                    <i class="fa-solid fa-expand"></i>
                </button>
            </div>
            <div class="chart-container">
                <canvas id="influenceChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fa-solid fa-chart-radar" style="color: var(--success);"></i>
                    <span>Analyse PESTEL</span>
                </div>
                <button class="btn btn-sm btn-outline">
                    <i class="fa-solid fa-download"></i>
                </button>
            </div>
            <div class="chart-container">
                <canvas id="pestelChart"></canvas>
            </div>
        </div>
    </div>

    <!-- SECTION 6: ANALYSE SWOT -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-chess-board"></i>
                </div>
                <div>
                    <h2>Analyse SWOT du SMQ</h2>
                    <p class="section-subtitle">Évaluation des forces, faiblesses, opportunités et menaces</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-primary">
                    <i class="fa-solid fa-robot"></i> Générer TOWS
                </button>
            </div>
        </div>

        <div class="swot-grid">
            <div class="swot-card swot-strengths">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <h3>Forces Internes</h3>
                </div>
                <ul class="swot-list">
                    <li>Équipe qualité certifiée et expérimentée</li>
                    <li>Processus documentés et maîtrisés</li>
                    <li>Technologies de production avancées</li>
                    <li>Réseau de fournisseurs qualifiés</li>
                    <li>Culture d'amélioration continue</li>
                </ul>
            </div>

            <div class="swot-card swot-weaknesses">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-minus"></i>
                    </div>
                    <h3>Faiblesses Internes</h3>
                </div>
                <ul class="swot-list">
                    <li>Dépendance à certains fournisseurs clés</li>
                    <li>Système informatique vieillissant</li>
                    <li>Turnover élevé dans certaines équipes</li>
                    <li>Processus administratifs lourds</li>
                    <li>Formation continue insuffisante</li>
                </ul>
            </div>

            <div class="swot-card swot-opportunities">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                    <h3>Opportunités Externes</h3>
                </div>
                <ul class="swot-list">
                    <li>Marché en croissance dans l'industrie 4.0</li>
                    <li>Subventions pour la digitalisation</li>
                    <li>Nouveaux marchés internationaux</li>
                    <li>Évolution vers l'économie circulaire</li>
                    <li>Partenariats stratégiques possibles</li>
                </ul>
            </div>

            <div class="swot-card swot-threats">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3>Menaces Externes</h3>
                </div>
                <ul class="swot-list">
                    <li>Concurrence internationale agressive</li>
                    <li>Évolution réglementaire rapide</li>
                    <li>Variation des prix des matières premières</li>
                    <li>Risques géopolitiques</li>
                    <li>Pénurie de compétences techniques</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- SECTION 7: CARTOGRAPHIE DES PROCESSUS -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div>
                    <h2>Cartographie Interactive des Processus</h2>
                    <p class="section-subtitle">ISO 9001:2015 - Clause 4.4 | Visualisation des interactions</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-success" onclick="addProcessNode()">
                    <i class="fa-solid fa-plus"></i> Nouveau Processus
                </button>
                <button class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-download"></i> Exporter
                </button>
            </div>
        </div>

        <div class="process-map-container" id="processMap">
            <!-- Nœuds de processus ajoutés dynamiquement -->
        </div>

        <div style="display: flex; justify-content: center; margin-top: 1rem;">
            <div style="display: inline-flex; align-items: center; gap: 1.5rem; font-size: 0.85rem; color: var(--gray-600);">
                <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--primary);"></div>
                    Processus Opérationnels
                </span>
                <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--success);"></div>
                    Processus de Support
                </span>
                <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--warning);"></div>
                    Processus de Management
                </span>
            </div>
        </div>
    </section>

</div>

{{-- CHARTS & INTERACTIONS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des graphiques
    initializeCharts();
    
    // Initialisation de la cartographie
    initializeProcessMap();
    
    // Gestion du slider d'influence
    const influenceSlider = document.getElementById('influenceRange');
    const influenceValue = document.querySelector('.range-slider-value');
    
    if (influenceSlider) {
        influenceSlider.addEventListener('input', function() {
            const value = this.value;
            let text = '';
            
            switch(parseInt(value)) {
                case 1: text = 'Très faible (1/5)'; break;
                case 2: text = 'Faible (2/5)'; break;
                case 3: text = 'Moyenne (3/5)'; break;
                case 4: text = 'Élevée (4/5)'; break;
                case 5: text = 'Critique (5/5)'; break;
            }
            
            influenceValue.textContent = text;
        });
    }
});

function initializeCharts() {
    // Graphique d'influence
    const ctx1 = document.getElementById('influenceChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Clients', 'Fournisseurs', 'Employés', 'Autorités', 'Partenaires', 'Communauté'],
            datasets: [{
                label: 'Niveau d\'Influence',
                data: [5, 4, 3, 5, 3, 2],
                backgroundColor: [
                    'rgba(37, 99, 235, 0.8)',
                    'rgba(22, 163, 74, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(220, 38, 38, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(8, 145, 178, 0.8)'
                ],
                borderColor: [
                    '#2563eb',
                    '#16a34a',
                    '#f59e0b',
                    '#dc2626',
                    '#8b5cf6',
                    '#0891b2'
                ],
                borderWidth: 1,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(31, 41, 55, 0.9)',
                    titleColor: '#f9fafb',
                    bodyColor: '#d1d5db',
                    cornerRadius: 6,
                    callbacks: {
                        label: function(context) {
                            return `Influence: ${context.raw}/5`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    grid: {
                        color: 'rgba(209, 213, 219, 0.3)'
                    },
                    ticks: {
                        color: '#6b7280',
                        stepSize: 1
                    },
                    title: {
                        display: true,
                        text: 'Niveau d\'Influence (1-5)',
                        color: '#4b5563',
                        font: {
                            weight: '600'
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(209, 213, 219, 0.3)'
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            }
        }
    });

    // Graphique PESTEL
    const ctx2 = document.getElementById('pestelChart').getContext('2d');
    new Chart(ctx2, {
        type: 'radar',
        data: {
            labels: ['Politique', 'Économique', 'Socioculturel', 'Technologique', 'Environnemental', 'Légal'],
            datasets: [{
                label: 'Impact sur le SMQ',
                data: [3, 4, 2, 5, 3, 4],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                pointBackgroundColor: '#2563eb',
                pointBorderColor: '#fff',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    angleLines: {
                        color: 'rgba(209, 213, 219, 0.5)'
                    },
                    grid: {
                        color: 'rgba(209, 213, 219, 0.3)'
                    },
                    pointLabels: {
                        color: '#4b5563',
                        font: {
                            weight: '600'
                        }
                    },
                    ticks: {
                        color: '#6b7280',
                        backdropColor: 'transparent'
                    },
                    suggestedMin: 0,
                    suggestedMax: 5
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#4b5563'
                    }
                }
            }
        }
    });
}

let processCount = 0;
const processTypes = ['process', 'support', 'management'];

function initializeProcessMap() {
    const processes = [
        { id: 1, title: 'Direction & Leadership', type: 'management', x: 100, y: 100 },
        { id: 2, title: 'Planification Stratégique', type: 'management', x: 300, y: 100 },
        { id: 3, title: 'Gestion des Ressources', type: 'support', x: 500, y: 100 },
        { id: 4, title: 'Production', type: 'process', x: 200, y: 250 },
        { id: 5, title: 'Contrôle Qualité', type: 'process', x: 400, y: 250 },
        { id: 6, title: 'Logistique', type: 'support', x: 100, y: 400 },
        { id: 7, title: 'Service Client', type: 'support', x: 500, y: 400 },
    ];

    processes.forEach(process => {
        addProcessToMap(process);
    });
}

function addProcessNode() {
    processCount++;
    const type = processTypes[Math.floor(Math.random() * processTypes.length)];
    
    const process = {
        id: processCount,
        title: `Nouveau Processus ${processCount}`,
        type: type,
        x: Math.random() * 600 + 50,
        y: Math.random() * 300 + 50
    };
    
    addProcessToMap(process);
}

function addProcessToMap(process) {
    const container = document.getElementById('processMap');
    const node = document.createElement('div');
    
    node.className = `process-node process-node-${process.type}`;
    node.id = `process-${process.id}`;
    node.style.left = `${process.x}px`;
    node.style.top = `${process.y}px`;
    
    const icon = process.type === 'process' ? 'fa-gears' : 
                 process.type === 'support' ? 'fa-life-ring' : 'fa-chart-line';
    
    node.innerHTML = `
        <div class="process-node-header">
            <div class="process-node-title">
                <i class="fa-solid ${icon}"></i>
                ${process.title}
            </div>
            <div style="display: flex; gap: 0.25rem;">
                <button class="btn-icon" onclick="editProcess(${process.id})" style="width: 24px; height: 24px;">
                    <i class="fa-solid fa-edit" style="font-size: 0.75rem;"></i>
                </button>
                <button class="btn-icon" onclick="deleteProcess(${process.id})" style="width: 24px; height: 24px;">
                    <i class="fa-solid fa-trash" style="font-size: 0.75rem;"></i>
                </button>
            </div>
        </div>
        <div class="process-node-content">
            <div style="font-size: 0.8rem;">
                <i class="fa-solid fa-hashtag"></i>
                ID: P${process.id.toString().padStart(3, '0')}
            </div>
        </div>
    `;
    
    container.appendChild(node);
    makeDraggable(node);
}

function makeDraggable(element) {
    let isDragging = false;
    let offsetX, offsetY;
    
    element.addEventListener('mousedown', startDrag);
    
    function startDrag(e) {
        isDragging = true;
        offsetX = e.offsetX;
        offsetY = e.offsetY;
        element.style.cursor = 'grabbing';
        element.style.zIndex = '1000';
        
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', stopDrag);
    }
    
    function drag(e) {
        if (!isDragging) return;
        
        const container = document.getElementById('processMap');
        const rect = container.getBoundingClientRect();
        
        let x = e.clientX - rect.left - offsetX;
        let y = e.clientY - rect.top - offsetY;
        
        // Limites
        x = Math.max(10, Math.min(x, container.clientWidth - element.offsetWidth - 10));
        y = Math.max(10, Math.min(y, container.clientHeight - element.offsetHeight - 10));
        
        element.style.left = `${x}px`;
        element.style.top = `${y}px`;
    }
    
    function stopDrag() {
        isDragging = false;
        element.style.cursor = 'grab';
        element.style.zIndex = '1';
        
        document.removeEventListener('mousemove', drag);
        document.removeEventListener('mouseup', stopDrag);
    }
}

function editProcess(id) {
    const node = document.getElementById(`process-${id}`);
    const titleElement = node.querySelector('.process-node-title');
    const currentTitle = titleElement.textContent.trim();
    
    const newTitle = prompt('Modifier le nom du processus:', currentTitle);
    if (newTitle && newTitle !== currentTitle) {
        titleElement.innerHTML = `<i class="fa-solid fa-gears"></i>${newTitle}`;
    }
}

function deleteProcess(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce processus ?')) {
        const node = document.getElementById(`process-${id}`);
        if (node) {
            node.remove();
        }
    }
}
</script>
@endsection