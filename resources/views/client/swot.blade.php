@extends('layouts.clients')

@section('title', 'SWOT / PESTEL')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    background: #ffffff;
    line-height: 1.5;
}

/* ===== LAYOUT COMPACT ===== */
.container-main {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1rem;
    background: #ffffff;
}

@media (min-width: 768px) {
    .container-main {
        padding: 1.5rem;
    }
}

/* ===== FORMULAIRES VISIBLES ET AMÉLIORÉS ===== */
.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    background: var(--gray-50);
    padding: 0.5rem 0.75rem;
    border-radius: var(--radius-sm);
    border-left: 3px solid var(--primary);
}

.form-label i {
    color: var(--primary);
    width: 16px;
    text-align: center;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 2px solid var(--gray-300);
    border-radius: var(--radius-md);
    font-size: 0.95rem;
    color: var(--gray-800);
    transition: var(--transition);
    font-family: inherit;
    box-shadow: var(--shadow-sm);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

.form-control:hover {
    border-color: var(--gray-400);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
    line-height: 1.6;
}

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232563eb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.25rem;
    padding-right: 2.5rem;
}

/* Range slider amélioré et visible */
.range-slider-container {
    background: var(--gray-50);
    padding: 1rem;
    border-radius: var(--radius-md);
    border: 1px solid var(--gray-200);
    margin-top: 0.5rem;
}

.range-slider {
    width: 100%;
    height: 8px;
    -webkit-appearance: none;
    appearance: none;
    background: linear-gradient(to right, var(--danger), var(--warning), var(--success));
    border-radius: 4px;
    outline: none;
    margin: 0.5rem 0;
}

.range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 24px;
    height: 24px;
    background: white;
    border: 3px solid var(--primary);
    border-radius: 50%;
    cursor: pointer;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
}

.range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.1);
    border-color: var(--primary-dark);
}

.range-slider-value {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    background: var(--primary);
    padding: 0.5rem 1rem;
    border-radius: var(--radius-md);
    font-size: 0.9rem;
    min-width: 100px;
    text-align: center;
    margin-top: 0.5rem;
    box-shadow: var(--shadow-sm);
}

.range-labels {
    display: flex;
    justify-content: space-between;
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: var(--gray-600);
}

.range-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.range-dot {
    width: 8px;
    height: 8px;
    background: var(--gray-400);
    border-radius: 50%;
}

/* ===== GRID FORMULAIRES ===== */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

/* ===== BOUTONS VISIBLES ===== */
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
    text-decoration: none;
    white-space: nowrap;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn:active {
    transform: translateY(0);
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

.btn-success:hover {
    background: #15803d;
}

.btn-outline {
    background: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
}

.btn-outline:hover {
    background: var(--primary-light);
}

.btn-danger {
    background: var(--danger);
    color: white;
}

.btn-danger:hover {
    background: #b91c1c;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
}

/* ===== SECTIONS COMPACTES ===== */
.section {
    background: #ffffff;
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.section:hover {
    box-shadow: var(--shadow-md);
}

.section-header {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--gray-100);
}

@media (min-width: 768px) {
    .section-header {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
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
    font-weight: 700;
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
    flex-wrap: wrap;
}

/* ===== PESTEL CARDS ===== */
.pestel-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
    margin: 1.5rem 0;
}

.pestel-card {
    background: #ffffff;
    border-radius: var(--radius-md);
    padding: 1.25rem;
    border: 2px solid;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.pestel-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.pestel-card.politique { border-color: #3b82f6; background: rgba(59, 130, 246, 0.05); }
.pestel-card.economique { border-color: #10b981; background: rgba(16, 185, 129, 0.05); }
.pestel-card.socioculturel { border-color: #f59e0b; background: rgba(245, 158, 11, 0.05); }
.pestel-card.technologique { border-color: #8b5cf6; background: rgba(139, 92, 246, 0.05); }
.pestel-card.environnemental { border-color: #059669; background: rgba(5, 150, 105, 0.05); }
.pestel-card.legal { border-color: #dc2626; background: rgba(220, 38, 38, 0.05); }

.pestel-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.pestel-icon {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.pestel-politique .pestel-icon { background: #3b82f6; }
.pestel-economique .pestel-icon { background: #10b981; }
.pestel-socioculturel .pestel-icon { background: #f59e0b; }
.pestel-technologique .pestel-icon { background: #8b5cf6; }
.pestel-environnemental .pestel-icon { background: #059669; }
.pestel-legal .pestel-icon { background: #dc2626; }

.pestel-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--gray-900);
    margin: 0;
}

.pestel-description {
    font-size: 0.9rem;
    color: var(--gray-600);
    line-height: 1.5;
    margin-bottom: 1rem;
}

/* ===== SWOT GRID ===== */
.swot-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
    margin: 1.5rem 0;
}

.swot-card {
    border-radius: var(--radius-md);
    padding: 1.25rem;
    border: 2px solid;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.swot-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.swot-strengths { border-color: #16a34a; background: rgba(22, 163, 74, 0.05); }
.swot-weaknesses { border-color: #dc2626; background: rgba(220, 38, 38, 0.05); }
.swot-opportunities { border-color: #2563eb; background: rgba(37, 99, 235, 0.05); }
.swot-threats { border-color: #f59e0b; background: rgba(245, 158, 11, 0.05); }

.swot-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.swot-icon {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.swot-strengths .swot-icon { background: #16a34a; }
.swot-weaknesses .swot-icon { background: #dc2626; }
.swot-opportunities .swot-icon { background: #2563eb; }
.swot-threats .swot-icon { background: #f59e0b; }

.swot-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--gray-900);
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
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.swot-list li:last-child {
    border-bottom: none;
}

.swot-list li::before {
    content: '•';
    color: inherit;
    font-weight: bold;
}

.swot-actions {
    margin-top: 1rem;
    display: flex;
    gap: 0.5rem;
}

/* ===== CHARTS CONTAINERS ===== */
.charts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.chart-card {
    background: #ffffff;
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.chart-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
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

/* ===== TOOLS TABLE ===== */
.table-container {
    overflow-x: auto;
    border-radius: var(--radius-md);
    border: 1px solid var(--gray-200);
    background: #ffffff;
    margin: 1.5rem 0;
    -webkit-overflow-scrolling: touch;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
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
    font-size: 0.9rem;
}

.data-table tbody tr:hover {
    background: var(--gray-50);
}

.data-table tbody tr:last-child td {
    border-bottom: none;
}

/* ===== MODALE ===== */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal-overlay.active {
    display: flex;
}

.modal-content {
    background: white;
    border-radius: var(--radius-xl);
    padding: 2rem;
    width: 100%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: var(--shadow-xl);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--gray-200);
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-900);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--gray-500);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: var(--radius-sm);
}

.modal-close:hover {
    background: var(--gray-100);
    color: var(--gray-700);
}

/* ===== ANIMATIONS ===== */


/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .pestel-grid,
    .swot-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .charts-container {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .section {
        padding: 1.25rem;
    }
    
    .pestel-grid,
    .swot-grid {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .section-actions {
        width: 100%;
    }
    
    .section-actions .btn {
        flex: 1;
        min-width: 0;
    }
}

@media (max-width: 480px) {
    .container-main {
        padding: 0.75rem;
    }
    
    .section {
        padding: 1rem;
    }
    
    .section-title h2 {
        font-size: 1.1rem;
    }
    
    .btn {
        padding: 0.625rem 1.25rem;
        font-size: 0.85rem;
    }
    
    .modal-content {
        padding: 1.5rem;
        margin: 0.5rem;
    }
}

/* Indicateurs visuels */
.impact-indicator {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.impact-low { background: var(--success-light); color: var(--success); }
.impact-medium { background: var(--warning-light); color: var(--warning); }
.impact-high { background: var(--danger-light); color: var(--danger); }

/* Badges */
.badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-pestel { background: rgba(37, 99, 235, 0.1); color: var(--primary); }
.badge-swot { background: rgba(22, 163, 74, 0.1); color: var(--success); }
</style>

<!-- MODALE D'AJOUT -->
<div class="modal-overlay" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fa-solid fa-plus-circle" style="color: var(--primary);"></i>
                Nouvelle Analyse SWOT / PESTEL
            </h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="analysisForm" class="form-grid">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-tag"></i> Type d'Analyse
                    </label>
                    <select class="form-control" id="analysisType" required>
                        <option value="">Sélectionnez un type</option>
                        <option value="pestel">PESTEL</option>
                        <option value="swot">SWOT</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-layer-group"></i> Catégorie
                    </label>
                    <select class="form-control" id="analysisCategory" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <!-- Options seront remplies dynamiquement -->
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-heading"></i> Titre / Description
                    </label>
                    <input type="text" class="form-control" id="analysisTitle" 
                           placeholder="Ex: Nouvelle réglementation environnementale" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-align-left"></i> Détails
                    </label>
                    <textarea class="form-control" id="analysisDetails" rows="4" 
                              placeholder="Décrivez en détail l'élément analysé..."></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-bullseye"></i> Impact sur l'Organisation
                    </label>
                    <div class="range-slider-container">
                        <input type="range" min="1" max="5" value="3" class="range-slider" id="impactRange">
                        <div class="range-labels">
                            <div class="range-label">
                                <div class="range-dot"></div>
                                <span>Très faible</span>
                            </div>
                            <div class="range-label">
                                <div class="range-dot"></div>
                                <span>Faible</span>
                            </div>
                            <div class="range-label">
                                <div class="range-dot"></div>
                                <span>Moyen</span>
                            </div>
                            <div class="range-label">
                                <div class="range-dot"></div>
                                <span>Élevé</span>
                            </div>
                            <div class="range-label">
                                <div class="range-dot"></div>
                                <span>Critique</span>
                            </div>
                        </div>
                        <div class="range-slider-value" id="impactValue">Moyen (3/5)</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-user-tie"></i> Responsable de Suivi
                    </label>
                    <input type="text" class="form-control" id="analysisResponsible" 
                           placeholder="Nom du responsable">
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-calendar"></i> Date de Révision
                    </label>
                    <input type="date" class="form-control" id="analysisReviewDate">
                </div>
            </form>
        </div>
        <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
            <button class="btn btn-outline" onclick="closeModal()">
                <i class="fa-solid fa-times"></i> Annuler
            </button>
            <button class="btn btn-success" onclick="saveAnalysis()">
                <i class="fa-solid fa-save"></i> Enregistrer
            </button>
        </div>
    </div>
</div>

<div class="container-main">

    <!-- HEADER PRINCIPAL -->
    <div class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <h2>Analyse SWOT & PESTEL</h2>
                    <p class="section-subtitle">Évaluation stratégique des facteurs internes et externes</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-primary" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Nouvelle Analyse
                </button>
                <button class="btn btn-outline">
                    <i class="fa-solid fa-file-export"></i> Exporter
                </button>
                <button class="btn btn-outline">
                    <i class="fa-solid fa-robot"></i> Analyse IA
                </button>
            </div>
        </div>
        
        <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); padding: 1.5rem; border-radius: var(--radius-md); margin-top: 1rem;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fa-solid fa-circle-info" style="color: var(--primary); font-size: 1.5rem;"></i>
                <div>
                    <h3 style="font-weight: 600; color: var(--gray-800); margin-bottom: 0.25rem;">Comment utiliser cette analyse</h3>
                    <p style="color: var(--gray-600); font-size: 0.9rem;">
                        Identifiez les forces/faiblesses internes (SWOT) et les opportunités/menaces externes (PESTEL) pour élaborer votre stratégie qualité.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 1: PESTEL - FACTEURS EXTERNES -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                    <i class="fa-solid fa-earth-europe"></i>
                </div>
                <div>
                    <h2>Analyse PESTEL</h2>
                    <p class="section-subtitle">Facteurs macro-environnementaux externes</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-outline" onclick="addPestelItem()">
                    <i class="fa-solid fa-plus"></i> Ajouter Facteur
                </button>
            </div>
        </div>

        <div class="pestel-grid">
            <!-- Politique -->
            <div class="pestel-card pestel-politique">
                <div class="pestel-header">
                    <div class="pestel-icon">
                        <i class="fa-solid fa-gavel"></i>
                    </div>
                    <h3 class="pestel-title">Politique</h3>
                </div>
                <p class="pestel-description">
                    Stabilité gouvernementale, régulations, politiques publiques, relations internationales.
                </p>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-bullseye"></i> Niveau d'Impact
                    </label>
                    <input type="range" min="1" max="5" value="3" class="range-slider" data-category="politique">
                    <div class="range-slider-value" style="margin-top: 0.5rem;">Moyen (3/5)</div>
                </div>
                <div class="swot-actions">
                    <button class="btn btn-sm btn-outline" onclick="editPestel('politique')">
                        <i class="fa-solid fa-edit"></i> Éditer
                    </button>
                    <button class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-chart-line"></i> Suivi
                    </button>
                </div>
            </div>

            <!-- Économique -->
            <div class="pestel-card pestel-economique">
                <div class="pestel-header">
                    <div class="pestel-icon">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                    <h3 class="pestel-title">Économique</h3>
                </div>
                <p class="pestel-description">
                    Inflation, croissance économique, taux de change, accès au financement, pouvoir d'achat.
                </p>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-bullseye"></i> Niveau d'Impact
                    </label>
                    <input type="range" min="1" max="5" value="4" class="range-slider" data-category="economique">
                    <div class="range-slider-value" style="margin-top: 0.5rem;">Élevé (4/5)</div>
                </div>
                <div class="swot-actions">
                    <button class="btn btn-sm btn-outline" onclick="editPestel('economique')">
                        <i class="fa-solid fa-edit"></i> Éditer
                    </button>
                    <button class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-chart-line"></i> Suivi
                    </button>
                </div>
            </div>

            <!-- Socioculturel -->
            <div class="pestel-card pestel-socioculturel">
                <div class="pestel-header">
                    <div class="pestel-icon">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <h3 class="pestel-title">Socioculturel</h3>
                </div>
                <p class="pestel-description">
                    Valeurs sociales, comportements clients, évolution des besoins, tendances démographiques.
                </p>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-bullseye"></i> Niveau d'Impact
                    </label>
                    <input type="range" min="1" max="5" value="3" class="range-slider" data-category="socioculturel">
                    <div class="range-slider-value" style="margin-top: 0.5rem;">Moyen (3/5)</div>
                </div>
                <div class="swot-actions">
                    <button class="btn btn-sm btn-outline" onclick="editPestel('socioculturel')">
                        <i class="fa-solid fa-edit"></i> Éditer
                    </button>
                    <button class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-chart-line"></i> Suivi
                    </button>
                </div>
            </div>

            <!-- Technologique -->
            <div class="pestel-card pestel-technologique">
                <div class="pestel-header">
                    <div class="pestel-icon">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <h3 class="pestel-title">Technologique</h3>
                </div>
                <p class="pestel-description">
                    Digitalisation, intelligence artificielle, innovation, cybersécurité, veille technologique.
                </p>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-bullseye"></i> Niveau d'Impact
                    </label>
                    <input type="range" min="1" max="5" value="5" class="range-slider" data-category="technologique">
                    <div class="range-slider-value" style="margin-top: 0.5rem;">Critique (5/5)</div>
                </div>
                <div class="swot-actions">
                    <button class="btn btn-sm btn-outline" onclick="editPestel('technologique')">
                        <i class="fa-solid fa-edit"></i> Éditer
                    </button>
                    <button class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-chart-line"></i> Suivi
                    </button>
                </div>
            </div>

            <!-- Environnemental -->
            <div class="pestel-card pestel-environnemental">
                <div class="pestel-header">
                    <div class="pestel-icon">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h3 class="pestel-title">Environnemental</h3>
                </div>
                <p class="pestel-description">
                    Durabilité, empreinte carbone, conformité environnementale, changement climatique.
                </p>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-bullseye"></i> Niveau d'Impact
                    </label>
                    <input type="range" min="1" max="5" value="4" class="range-slider" data-category="environnemental">
                    <div class="range-slider-value" style="margin-top: 0.5rem;">Élevé (4/5)</div>
                </div>
                <div class="swot-actions">
                    <button class="btn btn-sm btn-outline" onclick="editPestel('environnemental')">
                        <i class="fa-solid fa-edit"></i> Éditer
                    </button>
                    <button class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-chart-line"></i> Suivi
                    </button>
                </div>
            </div>

            <!-- Légal -->
            <div class="pestel-card pestel-legal">
                <div class="pestel-header">
                    <div class="pestel-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="pestel-title">Légal</h3>
                </div>
                <p class="pestel-description">
                    Lois, normes, propriété intellectuelle, droit du travail, réglementations sectorielles.
                </p>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-bullseye"></i> Niveau d'Impact
                    </label>
                    <input type="range" min="1" max="5" value="5" class="range-slider" data-category="legal">
                    <div class="range-slider-value" style="margin-top: 0.5rem;">Critique (5/5)</div>
                </div>
                <div class="swot-actions">
                    <button class="btn btn-sm btn-outline" onclick="editPestel('legal')">
                        <i class="fa-solid fa-edit"></i> Éditer
                    </button>
                    <button class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-chart-line"></i> Suivi
                    </button>
                </div>
            </div>
        </div>

        <!-- Graphique PESTEL -->
        <div class="chart-card" style="margin-top: 2rem;">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fa-solid fa-chart-radar" style="color: #3b82f6;"></i>
                    <span>Radar d'Impact PESTEL</span>
                </div>
                <button class="btn btn-sm btn-outline">
                    <i class="fa-solid fa-download"></i> Exporter
                </button>
            </div>
            <div class="chart-container">
                <canvas id="pestelRadarChart"></canvas>
            </div>
        </div>
    </section>

    <!-- SECTION 2: SWOT - FACTEURS INTERNES -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon" style="background: linear-gradient(135deg, #16a34a, #15803d);">
                    <i class="fa-solid fa-chess-board"></i>
                </div>
                <div>
                    <h2>Analyse SWOT</h2>
                    <p class="section-subtitle">Forces, Faiblesses, Opportunités, Menaces internes</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-outline" onclick="addSwotItem()">
                    <i class="fa-solid fa-plus"></i> Ajouter Élément
                </button>
                <button class="btn btn-sm btn-primary" onclick="generateTows()">
                    <i class="fa-solid fa-brain"></i> Générer TOWS
                </button>
            </div>
        </div>

        <div class="swot-grid">
            <!-- Forces -->
            <div class="swot-card swot-strengths">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                    <h3 class="swot-title">Forces</h3>
                </div>
                <ul class="swot-list">
                    <li>Compétences techniques élevées de l'équipe R&D</li>
                    <li>Fort engagement de la direction qualité</li>
                    <li>Processus bien documentés et maîtrisés</li>
                    <li>Culture d'amélioration continue ancrée</li>
                </ul>
                <div class="form-group" style="margin-top: 1rem;">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-plus-circle"></i> Ajouter une force
                    </label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="form-control" style="flex: 1;" placeholder="Nouvelle force...">
                        <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Faiblesses -->
            <div class="swot-card swot-weaknesses">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3 class="swot-title">Faiblesses</h3>
                </div>
                <ul class="swot-list">
                    <li>Systèmes informatiques vieillissants</li>
                    <li>Dépendance à certains fournisseurs clés</li>
                    <li>Processus administratifs lourds</li>
                    <li>Turnover élevé dans certaines équipes</li>
                </ul>
                <div class="form-group" style="margin-top: 1rem;">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-plus-circle"></i> Ajouter une faiblesse
                    </label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="form-control" style="flex: 1;" placeholder="Nouvelle faiblesse...">
                        <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Opportunités -->
            <div class="swot-card swot-opportunities">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-lightbulb"></i>
                    </div>
                    <h3 class="swot-title">Opportunités</h3>
                </div>
                <ul class="swot-list">
                    <li>Croissance du marché dans l'industrie 4.0</li>
                    <li>Subventions disponibles pour la digitalisation</li>
                    <li>Nouveaux marchés internationaux accessibles</li>
                    <li>Partenariats stratégiques possibles</li>
                </ul>
                <div class="form-group" style="margin-top: 1rem;">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-plus-circle"></i> Ajouter une opportunité
                    </label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="form-control" style="flex: 1;" placeholder="Nouvelle opportunité...">
                        <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menaces -->
            <div class="swot-card swot-threats">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-skull-crossbones"></i>
                    </div>
                    <h3 class="swot-title">Menaces</h3>
                </div>
                <ul class="swot-list">
                    <li>Concurrence internationale agressive</li>
                    <li>Évolution réglementaire rapide</li>
                    <li>Pénurie de compétences techniques</li>
                    <li>Risques géopolitiques affectant les chaînes</li>
                </ul>
                <div class="form-group" style="margin-top: 1rem;">
                    <label class="form-label" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-plus-circle"></i> Ajouter une menace
                    </label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" class="form-control" style="flex: 1;" placeholder="Nouvelle menace...">
                        <button class="btn btn-sm btn-success">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques SWOT -->
        <div class="charts-container">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <i class="fa-solid fa-chart-column" style="color: #16a34a;"></i>
                        <span>Priorisation SWOT</span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="swotBarChart"></canvas>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <i class="fa-solid fa-chart-pie" style="color: #8b5cf6;"></i>
                        <span>Répartition des Éléments</span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="swotPieChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: SYNTHÈSE TOWS -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                    <i class="fa-solid fa-brain"></i>
                </div>
                <div>
                    <h2>Synthèse Stratégique TOWS</h2>
                    <p class="section-subtitle">Stratégies issues de la matrice SWOT × PESTEL</p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Type de Stratégie</th>
                        <th>Description</th>
                        <th>Actions Recommandées</th>
                        <th>Priorité</th>
                        <th>Échéance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge badge-pestel">SO</span> Offensive</td>
                        <td>Exploiter les forces pour saisir les opportunités</td>
                        <td>Lancer un nouveau produit innovant sur le marché digital</td>
                        <td><span class="impact-indicator impact-high">Haute</span></td>
                        <td>3 mois</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-pestel">ST</span> Défensive</td>
                        <td>Utiliser les forces pour contrer les menaces</td>
                        <td>Renforcer la cybersécurité face aux menaces informatiques</td>
                        <td><span class="impact-indicator impact-high">Haute</span></td>
                        <td>1 mois</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-pestel">WO</span> Adaptative</td>
                        <td>Réduire les faiblesses en profitant des opportunités</td>
                        <td>Former les équipes aux nouvelles technologies avec les subventions</td>
                        <td><span class="impact-indicator impact-medium">Moyenne</span></td>
                        <td>6 mois</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-pestel">WT</span> Survivaliste</td>
                        <td>Atténuer les faiblesses face aux menaces</td>
                        <td>Diversifier les fournisseurs pour réduire les risques de rupture</td>
                        <td><span class="impact-indicator impact-medium">Moyenne</span></td>
                        <td>4 mois</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Graphique d'évolution -->
        <div class="chart-card" style="margin-top: 2rem;">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fa-solid fa-chart-line" style="color: #f59e0b;"></i>
                    <span>Évolution des Facteurs Stratégiques</span>
                </div>
                <select class="form-control" style="width: auto; padding: 0.375rem 0.75rem;">
                    <option>6 derniers mois</option>
                    <option>1 an</option>
                    <option>2 ans</option>
                </select>
            </div>
            <div class="chart-container">
                <canvas id="trendChart"></canvas>
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
    
    // Gestion des sliders de range
    initializeRangeSliders();
    
    // Configuration des événements du formulaire
    setupFormEvents();
});

// Initialisation des graphiques
function initializeCharts() {
    // Radar PESTEL
    const pestelCtx = document.getElementById('pestelRadarChart').getContext('2d');
    new Chart(pestelCtx, {
        type: 'radar',
        data: {
            labels: ['Politique', 'Économique', 'Socioculturel', 'Technologique', 'Environnemental', 'Légal'],
            datasets: [{
                label: 'Impact Actuel',
                data: [3, 4, 3, 5, 4, 5],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                borderWidth: 2,
                pointBackgroundColor: '#2563eb',
                pointRadius: 4,
            }, {
                label: 'Impact Cible',
                data: [4, 5, 4, 5, 5, 5],
                borderColor: '#16a34a',
                backgroundColor: 'rgba(22, 163, 74, 0.1)',
                borderWidth: 2,
                borderDash: [5, 5],
                pointBackgroundColor: '#16a34a',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    angleLines: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    pointLabels: {
                        color: '#4b5563',
                        font: {
                            size: 12
                        }
                    },
                    ticks: {
                        display: false,
                        max: 5,
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#4b5563',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Bar chart SWOT
    const swotBarCtx = document.getElementById('swotBarChart').getContext('2d');
    new Chart(swotBarCtx, {
        type: 'bar',
        data: {
            labels: ['Forces', 'Faiblesses', 'Opportunités', 'Menaces'],
            datasets: [{
                label: 'Nombre d\'Éléments',
                data: [4, 4, 4, 4],
                backgroundColor: [
                    'rgba(22, 163, 74, 0.8)',
                    'rgba(220, 38, 38, 0.8)',
                    'rgba(37, 99, 235, 0.8)',
                    'rgba(245, 158, 11, 0.8)'
                ],
                borderColor: [
                    '#16a34a',
                    '#dc2626',
                    '#2563eb',
                    '#f59e0b'
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
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            }
        }
    });

    // Pie chart SWOT
    const swotPieCtx = document.getElementById('swotPieChart').getContext('2d');
    new Chart(swotPieCtx, {
        type: 'pie',
        data: {
            labels: ['Forces', 'Faiblesses', 'Opportunités', 'Menaces'],
            datasets: [{
                data: [4, 4, 4, 4],
                backgroundColor: [
                    'rgba(22, 163, 74, 0.8)',
                    'rgba(220, 38, 38, 0.8)',
                    'rgba(37, 99, 235, 0.8)',
                    'rgba(245, 158, 11, 0.8)'
                ],
                borderColor: [
                    '#16a34a',
                    '#dc2626',
                    '#2563eb',
                    '#f59e0b'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#4b5563',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Trend chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Opportunités',
                data: [3, 4, 4, 5, 4, 5],
                borderColor: '#16a34a',
                backgroundColor: 'rgba(22, 163, 74, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }, {
                label: 'Risques',
                data: [4, 3, 3, 4, 3, 4],
                borderColor: '#dc2626',
                backgroundColor: 'rgba(220, 38, 38, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#4b5563',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: '#6b7280',
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            }
        }
    });
}

// Gestion des sliders de range
function initializeRangeSliders() {
    // Slider dans la modale
    const impactRange = document.getElementById('impactRange');
    const impactValue = document.getElementById('impactValue');
    
    if (impactRange && impactValue) {
        updateRangeValue(impactRange.value);
        
        impactRange.addEventListener('input', function() {
            updateRangeValue(this.value);
        });
    }
    
    // Sliders dans les cartes PESTEL
    document.querySelectorAll('.pestel-card .range-slider').forEach(slider => {
        const valueDisplay = slider.nextElementSibling;
        
        slider.addEventListener('input', function() {
            const value = parseInt(this.value);
            let text = '';
            
            switch(value) {
                case 1: text = 'Très faible (1/5)'; break;
                case 2: text = 'Faible (2/5)'; break;
                case 3: text = 'Moyen (3/5)'; break;
                case 4: text = 'Élevé (4/5)'; break;
                case 5: text = 'Critique (5/5)'; break;
            }
            
            if (valueDisplay) {
                valueDisplay.textContent = text;
            }
        });
    });
}

function updateRangeValue(value) {
    const impactValue = document.getElementById('impactValue');
    let text = '';
    
    switch(parseInt(value)) {
        case 1: text = 'Très faible (1/5)'; break;
        case 2: text = 'Faible (2/5)'; break;
        case 3: text = 'Moyen (3/5)'; break;
        case 4: text = 'Élevé (4/5)'; break;
        case 5: text = 'Critique (5/5)'; break;
    }
    
    if (impactValue) {
        impactValue.textContent = text;
    }
}

// Configuration des événements du formulaire
function setupFormEvents() {
    const analysisType = document.getElementById('analysisType');
    const analysisCategory = document.getElementById('analysisCategory');
    
    if (analysisType && analysisCategory) {
        analysisType.addEventListener('change', function() {
            updateCategoryOptions(this.value);
        });
        
        // Initialiser les options
        updateCategoryOptions(analysisType.value);
    }
}

function updateCategoryOptions(type) {
    const categorySelect = document.getElementById('analysisCategory');
    
    if (!categorySelect) return;
    
    // Vider les options actuelles
    categorySelect.innerHTML = '<option value="">Sélectionnez une catégorie</option>';
    
    if (type === 'pestel') {
        const pestelCategories = [
            { value: 'politique', label: 'Politique' },
            { value: 'economique', label: 'Économique' },
            { value: 'socioculturel', label: 'Socioculturel' },
            { value: 'technologique', label: 'Technologique' },
            { value: 'environnemental', label: 'Environnemental' },
            { value: 'legal', label: 'Légal' }
        ];
        
        pestelCategories.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.value;
            option.textContent = cat.label;
            categorySelect.appendChild(option);
        });
    } else if (type === 'swot') {
        const swotCategories = [
            { value: 'forces', label: 'Forces' },
            { value: 'faiblesses', label: 'Faiblesses' },
            { value: 'opportunites', label: 'Opportunités' },
            { value: 'menaces', label: 'Menaces' }
        ];
        
        swotCategories.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.value;
            option.textContent = cat.label;
            categorySelect.appendChild(option);
        });
    }
}

// Fonctions pour la modale
function openAddModal() {
    document.getElementById('addModal').classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Réinitialiser le formulaire
    document.getElementById('analysisForm').reset();
    document.getElementById('impactValue').textContent = 'Moyen (3/5)';
    
    // Focus sur le premier champ
    setTimeout(() => {
        document.getElementById('analysisType').focus();
    }, 100);
}

function closeModal() {
    document.getElementById('addModal').classList.remove('active');
    document.body.style.overflow = '';
}

function saveAnalysis() {
    // Récupérer les valeurs du formulaire
    const type = document.getElementById('analysisType').value;
    const category = document.getElementById('analysisCategory').value;
    const title = document.getElementById('analysisTitle').value;
    const details = document.getElementById('analysisDetails').value;
    const impact = document.getElementById('impactRange').value;
    const responsible = document.getElementById('analysisResponsible').value;
    const reviewDate = document.getElementById('analysisReviewDate').value;
    
    // Validation simple
    if (!type || !category || !title) {
        alert('Veuillez remplir les champs obligatoires : Type, Catégorie et Titre.');
        return;
    }
    
    // Simuler l'enregistrement
    console.log('Nouvelle analyse enregistrée:', {
        type, category, title, details, impact, responsible, reviewDate
    });
    
    // Afficher un message de confirmation
    showNotification('Analyse enregistrée avec succès !', 'success');
    
    // Fermer la modale
    closeModal();
    
    // Rafraîchir l'affichage (simulation)
    setTimeout(() => {
        alert('L\'analyse a été ajoutée à la base de données. Rafraîchissement de l\'affichage.');
    }, 300);
}

// Fonctions pour les actions
function addPestelItem() {
    openAddModal();
    document.getElementById('analysisType').value = 'pestel';
    document.getElementById('analysisType').dispatchEvent(new Event('change'));
}

function addSwotItem() {
    openAddModal();
    document.getElementById('analysisType').value = 'swot';
    document.getElementById('analysisType').dispatchEvent(new Event('change'));
}

function editPestel(category) {
    openAddModal();
    document.getElementById('analysisType').value = 'pestel';
    document.getElementById('analysisType').dispatchEvent(new Event('change'));
    
    // Pré-remplir avec la catégorie sélectionnée
    setTimeout(() => {
        document.getElementById('analysisCategory').value = category;
        document.getElementById('analysisTitle').value = `Modification ${category}`;
        document.getElementById('analysisTitle').focus();
    }, 100);
}

function generateTows() {
    showNotification('Génération de la matrice TOWS en cours...', 'info');
    
    // Simulation de génération
    setTimeout(() => {
        showNotification('Matrice TOWS générée avec succès !', 'success');
        
        // Ajouter une nouvelle ligne dans le tableau
        const table = document.querySelector('.data-table tbody');
        if (table) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><span class="badge badge-pestel">SO</span> Nouvelle Stratégie</td>
                <td>Stratégie générée automatiquement</td>
                <td>Actions à définir</td>
                <td><span class="impact-indicator impact-medium">Moyenne</span></td>
                <td>À définir</td>
            `;
            table.appendChild(newRow);
            
            // Animation d'ajout
            newRow.style.opacity = '0';
            setTimeout(() => {
                newRow.style.transition = 'opacity 0.3s ease';
                newRow.style.opacity = '1';
            }, 10);
        }
    }, 1500);
}

// Fonction d'affichage de notification
function showNotification(message, type = 'info') {
    // Créer l'élément de notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid ${type === 'success' ? 'fa-circle-check' : type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-info'}" 
               style="color: ${type === 'success' ? '#16a34a' : type === 'error' ? '#dc2626' : '#2563eb'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Styles de la notification
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-lg);
        z-index: 1001;
        animation: slideInRight 0.3s ease;
        border-left: 4px solid ${type === 'success' ? '#16a34a' : type === 'error' ? '#dc2626' : '#2563eb'};
    `;
    
    // Ajouter au body
    document.body.appendChild(notification);
    
    // Supprimer après 3 secondes
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
    
    // Ajouter les animations CSS si elles n'existent pas
    if (!document.querySelector('#notification-animations')) {
        const style = document.createElement('style');
        style.id = 'notification-animations';
        style.textContent = `
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            @keyframes slideOutRight {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }
        `;
        document.head.appendChild(style);
    }
}

// Gestion des entrées dans les cartes SWOT
document.querySelectorAll('.swot-card .form-control').forEach(input => {
    const button = input.nextElementSibling;
    
    if (button) {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addSwotListItem(this);
            }
        });
        
        button.addEventListener('click', function() {
            const inputField = this.previousElementSibling;
            addSwotListItem(inputField);
        });
    }
});

function addSwotListItem(inputField) {
    const value = inputField.value.trim();
    if (!value) return;
    
    const card = inputField.closest('.swot-card');
    const list = card.querySelector('.swot-list');
    
    if (list) {
        const newItem = document.createElement('li');
        newItem.innerHTML = `<span>${value}</span>`;
        list.appendChild(newItem);
        
        // Animation d'ajout
        newItem.style.opacity = '0';
        setTimeout(() => {
            newItem.style.transition = 'opacity 0.3s ease';
            newItem.style.opacity = '1';
        }, 10);
        
        // Réinitialiser le champ
        inputField.value = '';
        inputField.focus();
        
        // Mettre à jour les graphiques (simulation)
        showNotification('Élément SWOT ajouté', 'success');
    }
}

// Fermer la modale avec Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Fermer la modale en cliquant à l'extérieur
document.getElementById('addModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>

<style>
/* Styles supplémentaires pour les notifications */
.notification {
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Amélioration de la visibilité des inputs sur mobile */
@media (max-width: 768px) {
    .form-control {
        padding: 0.875rem 1rem;
        font-size: 1rem;
    }
    
    .form-label {
        padding: 0.625rem 0.875rem;
    }
    
    .range-slider {
        height: 10px;
    }
    
    .range-slider::-webkit-slider-thumb {
        width: 28px;
        height: 28px;
    }
}

/* Focus visible pour l'accessibilité */
.form-control:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 2px;
}

.btn:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 2px;
}

/* Amélioration du contraste */
@media (prefers-contrast: high) {
    .form-control {
        border-width: 3px;
    }
    
    .btn {
        border-width: 2px;
    }
}
</style>
@endsection