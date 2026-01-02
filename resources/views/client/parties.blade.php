@extends('layouts.clients')

@section('title', 'Parties intéressées & Contexte de l’organisation')

@section('content')
<!-- FONT AWESOME -->
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

/* ===== LAYOUT ===== */
.container-main {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1.5rem;
    background: #ffffff;
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
    max-width: 500px;
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
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--gray-500);
    cursor: pointer;
    padding: 0.5rem;
}

.modal-close:hover {
    color: var(--gray-700);
}

.modal-body {
    margin-bottom: 1.5rem;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

/* ===== HEADER ===== */
.page-header {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.page-header-content {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
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
    width: 44px;
    height: 44px;
    background: var(--primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.page-text h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gray-900);
    margin: 0;
    line-height: 1.2;
}

.page-text p {
    color: var(--gray-600);
    font-size: 0.9rem;
    margin-top: 0.25rem;
    max-width: 600px;
}

.header-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* ===== SECTIONS ===== */
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
    gap: 0.75rem;
    margin-bottom: 1.25rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--gray-100);
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
    width: 36px;
    height: 36px;
    background: var(--primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.section-title h2 {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
}

.section-subtitle {
    color: var(--gray-600);
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

.section-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* ===== FORMULAIRES AMÉLIORÉS ===== */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-label i {
    color: var(--primary);
}

.form-control {
    width: 100%;
    padding: 0.625rem 0.875rem;
    background: #ffffff;
    border: 2px solid var(--gray-300);
    border-radius: var(--radius-md);
    font-size: 0.9rem;
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
    background-size: 1rem;
    padding-right: 2.25rem;
}

/* Édition spécifique Jeux Internes/Externes */
.enjeux-toggle {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.enjeux-toggle button {
    padding: 0.5rem 1rem;
    border: 1px solid var(--gray-300);
    background: var(--gray-50);
    border-radius: var(--radius-md);
    font-size: 0.85rem;
    cursor: pointer;
    transition: var(--transition);
}

.enjeux-toggle button.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.enjeux-container {
    display: none;
}

.enjeux-container.active {
    display: block;
}

/* Range slider amélioré */
.range-slider-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.5rem;
}

.range-slider {
    flex: 1;
    height: 6px;
    -webkit-appearance: none;
    appearance: none;
    background: var(--gray-300);
    border-radius: 3px;
    outline: none;
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
    font-weight: 600;
    color: var(--primary);
    background: var(--primary-light);
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
    font-size: 0.8rem;
    min-width: 80px;
    text-align: center;
}

/* ===== BOUTONS COMPACTS ===== */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
    padding: 0.625rem 1.25rem;
    border: none;
    border-radius: var(--radius-md);
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
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
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
}

.btn-icon {
    width: 32px;
    height: 32px;
    padding: 0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===== TABLEAUX RESPONSIVES ===== */
.table-container {
    overflow-x: auto;
    border-radius: var(--radius-md);
    border: 1px solid var(--gray-200);
    background: #ffffff;
    margin-bottom: 1.25rem;
    -webkit-overflow-scrolling: touch;
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
    padding: 0.75rem;
    text-align: left;
    font-weight: 600;
    color: var(--gray-700);
    border-bottom: 2px solid var(--gray-200);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.data-table td {
    padding: 0.75rem;
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

/* Badges */
.table-badge {
    display: inline-block;
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    font-size: 0.7rem;
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
    grid-template-columns: repeat(auto-fit, minmin(300px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.chart-card {
    background: #ffffff;
    border-radius: var(--radius-lg);
    padding: 1.25rem;
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
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--gray-900);
}

.chart-container {
    height: 200px;
    position: relative;
}

/* ===== SWOT ANALYSIS ===== */
.swot-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.swot-card {
    padding: 1.25rem;
    border-radius: var(--radius-md);
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
    margin-bottom: 0.75rem;
}

.swot-icon {
    width: 28px;
    height: 28px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
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
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0;
}

.swot-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.swot-list li {
    padding: 0.375rem 0;
    border-bottom: 1px dashed rgba(0,0,0,0.1);
    font-size: 0.85rem;
    color: var(--gray-700);
}

.swot-list li:last-child {
    border-bottom: none;
}

.swot-list li::before {
    content: '•';
    margin-right: 0.5rem;
    font-weight: bold;
}

/* ===== PROCESS MAP ÉDITABLE ===== */
.process-map-container {
    background: var(--gray-50);
    border-radius: var(--radius-md);
    padding: 1rem;
    border: 1px dashed var(--gray-300);
    min-height: 350px;
    position: relative;
    overflow: hidden;
    margin-bottom: 1rem;
    background-image: 
        linear-gradient(to right, var(--gray-200) 1px, transparent 1px),
        linear-gradient(to bottom, var(--gray-200) 1px, transparent 1px);
    background-size: 30px 30px;
}

.process-node {
    position: absolute;
    background: #ffffff;
    border: 1px solid;
    border-radius: var(--radius-md);
    padding: 0.75rem;
    min-width: 160px;
    max-width: 200px;
    cursor: move;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    font-size: 0.85rem;
    z-index: 1;
}

.process-node:hover {
    box-shadow: var(--shadow-md);
    z-index: 10;
}

.process-node.editing {
    border-color: var(--primary) !important;
    box-shadow: 0 0 0 2px var(--primary-light) !important;
    z-index: 100 !important;
}

.process-node-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid;
}

.process-node-title {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.375rem;
    flex: 1;
    cursor: text;
}

.process-node-title-input {
    width: 100%;
    border: none;
    background: transparent;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--gray-900);
    font-family: inherit;
    outline: none;
    padding: 0.125rem;
}

.process-node-actions {
    display: flex;
    gap: 0.25rem;
}

.process-node-action-btn {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    border: none;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.7rem;
    transition: var(--transition);
}

.process-node-action-btn:hover {
    background: var(--primary);
    color: white;
}

.process-node-content {
    font-size: 0.8rem;
    color: var(--gray-600);
}

.process-node-description {
    margin-top: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px dashed var(--gray-300);
}

.process-node-description textarea {
    width: 100%;
    border: 1px solid var(--gray-300);
    border-radius: var(--radius-sm);
    padding: 0.375rem;
    font-size: 0.8rem;
    font-family: inherit;
    resize: vertical;
    min-height: 60px;
    outline: none;
}

.process-node-description textarea:focus {
    border-color: var(--primary);
}

.process-node-process { border-color: var(--primary); }
.process-node-support { border-color: var(--success); }
.process-node-management { border-color: var(--warning); }

/* Lignes de connexion */
.process-connection {
    position: absolute;
    pointer-events: none;
    z-index: 0;
}

.connection-line {
    stroke: var(--gray-400);
    stroke-width: 2;
    stroke-dasharray: 5;
}

.process-map-actions {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    gap: 0.5rem;
    z-index: 100;
}

/* ===== FORMULAIRES ÉDITABLES ===== */
.editable-form {
    position: relative;
}

.edit-toggle {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    z-index: 10;
}

.editable-field {
    position: relative;
}

.editable-field:hover .edit-btn {
    opacity: 1;
}

.edit-btn {
    position: absolute;
    right: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
    background: var(--primary-light);
    border: none;
    color: var(--primary);
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    transition: var(--transition);
}

.edit-btn:hover {
    background: var(--primary);
    color: white;
}

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
        padding: 1.25rem;
    }
    
    .section {
        padding: 1.25rem;
    }
    
    .page-icon {
        width: 40px;
        height: 40px;
    }
    
    .page-text h1 {
        font-size: 1.35rem;
    }
    
    .section-title h2 {
        font-size: 1.1rem;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .header-actions .btn {
        flex: 1;
        min-width: 0;
    }
    
    .enjeux-toggle {
        flex-direction: column;
        width: 100%;
    }
    
    .enjeux-toggle button {
        width: 100%;
    }
    
    .process-map-container {
        min-height: 300px;
    }
    
    .process-node {
        min-width: 140px;
        padding: 0.5rem;
    }
}

@media (max-width: 480px) {
    .container-main {
        padding: 0.75rem;
    }
    
    .section {
        padding: 1rem;
    }
    
    .page-text h1 {
        font-size: 1.25rem;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .modal-content {
        padding: 1.5rem;
        margin: 0.5rem;
    }
    
    .process-map-container {
        min-height: 250px;
    }
}

/* Indicateurs d'édition */
.editing {
    border-color: var(--primary) !important;
    box-shadow: 0 0 0 2px var(--primary-light) !important;
}

.saved-indicator {
    position: fixed;
    bottom: 1rem;
    right: 1rem;
    background: var(--success);
    color: white;
    padding: 0.75rem 1.25rem;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    animation: slideInUp 0.3s ease;
    z-index: 1000;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<!-- MODALE DE CONFIRMATION -->
<div class="modal-overlay" id="confirmationModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 0.5rem;"></i>
                Modifications enregistrées
            </h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Vos modifications ont été sauvegardées avec succès.</p>
            <div style="background: var(--gray-50); padding: 1rem; border-radius: var(--radius-md); margin-top: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-clock" style="color: var(--gray-500);"></i>
                    <span style="font-size: 0.9rem; color: var(--gray-600);">Dernière sauvegarde : <span id="lastSaveTime">À l'instant</span></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal()">Fermer</button>
            <button class="btn btn-primary" onclick="viewHistory()">
                <i class="fa-solid fa-history"></i> Voir l'historique
            </button>
        </div>
    </div>
</div>

<!-- MODALE D'ÉDITION DE PROCESSUS -->
<div class="modal-overlay" id="processModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fa-solid fa-diagram-project" style="color: var(--primary); margin-right: 0.5rem;"></i>
                Éditer le Processus
            </h3>
            <button class="modal-close" onclick="closeProcessModal()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="processForm">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-heading"></i> Nom du Processus
                    </label>
                    <input type="text" class="form-control" id="processName" required>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-tag"></i> Type de Processus
                    </label>
                    <select class="form-control" id="processType">
                        <option value="process">Processus Opérationnel</option>
                        <option value="support">Processus de Support</option>
                        <option value="management">Processus de Management</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-align-left"></i> Description
                    </label>
                    <textarea class="form-control" id="processDescription" rows="3" placeholder="Décrivez le processus..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-user-tie"></i> Responsable
                    </label>
                    <input type="text" class="form-control" id="processResponsible" placeholder="Nom du responsable">
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-bullseye"></i> Objectifs
                    </label>
                    <textarea class="form-control" id="processObjectives" rows="2" placeholder="Objectifs du processus..."></textarea>
                </div>
                <input type="hidden" id="processId">
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeProcessModal()">Annuler</button>
            <button class="btn btn-danger" onclick="deleteProcess()" id="deleteProcessBtn">
                <i class="fa-solid fa-trash"></i> Supprimer
            </button>
            <button class="btn btn-primary" onclick="saveProcess()">
                <i class="fa-solid fa-save"></i> Enregistrer
            </button>
        </div>
    </div>
</div>

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
                    <p>Gestion complète du contexte qualité</p>
                </div>
            </div>
            <div class="header-actions">
                <button class="btn btn-primary" onclick="addStakeholder()">
                    <i class="fa-solid fa-user-plus"></i> Ajouter Partie
                </button>
                <button class="btn btn-outline">
                    <i class="fa-solid fa-file-export"></i> Exporter
                </button>
                <button class="btn btn-outline">
                    <i class="fa-solid fa-robot"></i> Analyse IA
                </button>
            </div>
        </div>
    </div>

    <!-- SECTION 1: CONTEXTE ORGANISATIONNEL ÉDITABLE -->
    <section class="section editable-form" id="contextSection">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <h2>Contexte de l'Organisation</h2>
                    <p class="section-subtitle">Analyse des enjeux internes et externes</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-outline" onclick="toggleEditMode('context')" id="editContextBtn">
                    <i class="fa-solid fa-pen"></i> Éditer
                </button>
                <button class="btn btn-sm btn-primary" onclick="saveSection('context')" id="saveContextBtn" style="display: none;">
                    <i class="fa-solid fa-save"></i> Enregistrer
                </button>
            </div>
        </div>

        <!-- Toggle Enjeux Internes/Externes -->
        <div class="enjeux-toggle">
            <button class="active" onclick="showEnjeux('internes')">
                <i class="fa-solid fa-users-gear"></i> Enjeux Internes
            </button>
            <button onclick="showEnjeux('externes')">
                <i class="fa-solid fa-globe"></i> Enjeux Externes
            </button>
        </div>

        <form class="form-grid" id="contextForm">
            <!-- Enjeux Internes -->
            <div class="enjeux-container active" id="enjeux-internes">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-industry"></i> Structure Organisationnelle
                    </label>
                    <textarea rows="3" class="form-control editable-field" id="structureInput" 
                        placeholder="Décrivez la structure, hiérarchie, départements..."
                        data-original="Structure décentralisée avec 5 départements fonctionnels et équipes projets agiles.">
Structure décentralisée avec 5 départements fonctionnels et équipes projets agiles.</textarea>
                    <button class="edit-btn" onclick="enableEdit('structureInput')">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-brain"></i> Compétences & Savoir-faire
                    </label>
                    <textarea rows="3" class="form-control editable-field" id="competencesInput"
                        placeholder="Décrivez les compétences clés, formation, expertise..."
                        data-original="Équipe R&D hautement qualifiée, besoin de formation continue sur nouvelles technologies.">
Équipe R&D hautement qualifiée, besoin de formation continue sur nouvelles technologies.</textarea>
                    <button class="edit-btn" onclick="enableEdit('competencesInput')">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-microchip"></i> Infrastructure & Technologie
                    </label>
                    <textarea rows="3" class="form-control editable-field" id="infrastructureInput"
                        placeholder="Décrivez l'infrastructure, équipements, systèmes informatiques..."
                        data-original="Infrastructure moderne mais certains équipements de production nécessitent mise à jour.">
Infrastructure moderne mais certains équipements de production nécessitent mise à jour.</textarea>
                    <button class="edit-btn" onclick="enableEdit('infrastructureInput')">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
            </div>

            <!-- Enjeux Externes -->
            <div class="enjeux-container" id="enjeux-externes">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-scale-balanced"></i> Environnement Légal & Réglementaire
                    </label>
                    <textarea rows="3" class="form-control editable-field" id="legalInput"
                        placeholder="Décrivez les lois, régulations, normes applicables..."
                        data-original="Nouvelle réglementation environnementale RE2020, normes ISO à maintenir.">
Nouvelle réglementation environnementale RE2020, normes ISO à maintenir.</textarea>
                    <button class="edit-btn" onclick="enableEdit('legalInput')">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-chart-line"></i> Environnement Économique
                    </label>
                    <textarea rows="3" class="form-control editable-field" id="economicInput"
                        placeholder="Décrivez les tendances économiques, marchés, concurrence..."
                        data-original="Marché en croissance de 8% annuel, concurrence accrue avec entrants internationaux.">
Marché en croissance de 8% annuel, concurrence accrue avec entrants internationaux.</textarea>
                    <button class="edit-btn" onclick="enableEdit('economicInput')">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-people-group"></i> Environnement Social
                    </label>
                    <textarea rows="3" class="form-control editable-field" id="socialInput"
                        placeholder="Décrivez les attentes sociétales, valeurs, tendances sociales..."
                        data-original="Attentes fortes sur RSE, diversité et inclusion, équilibre vie pro/perso.">
Attentes fortes sur RSE, diversité et inclusion, équilibre vie pro/perso.</textarea>
                    <button class="edit-btn" onclick="enableEdit('socialInput')">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <div class="form-label">
                    <i class="fa-solid fa-chart-line"></i> Méthode d'Analyse
                </div>
                <select class="form-control" id="analysisMethod">
                    <option>PESTEL (Recommandé)</option>
                    <option>Analyse SWOT</option>
                    <option>Forces de Porter</option>
                    <option>Analyse VUCA</option>
                </select>
            </div>
        </form>
    </section>

    <!-- SECTION 2: FORMULAIRE PARTIES INTÉRESSÉES ÉDITABLE -->
    <section class="section editable-form" id="stakeholdersSection">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div>
                    <h2>Enregistrement des Parties Intéressées</h2>
                    <p class="section-subtitle">Identification et suivi des parties pertinentes</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-outline" onclick="toggleEditMode('stakeholders')" id="editStakeholdersBtn">
                    <i class="fa-solid fa-pen"></i> Éditer
                </button>
                <button class="btn btn-sm btn-success" onclick="saveStakeholder()" id="saveStakeholderBtn">
                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                </button>
            </div>
        </div>

        <form class="form-grid" id="stakeholderForm">
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-building"></i> Nom / Organisation
                </label>
                <input type="text" class="form-control" id="stakeholderName" placeholder="Ex: Client ABC Corporation">
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-tag"></i> Catégorie
                </label>
                <select class="form-control" id="stakeholderCategory">
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
                <textarea rows="3" class="form-control editable-field" id="expectationsInput" 
                    placeholder="Décrire les attentes, exigences et contraintes spécifiques..."
                    data-original="Qualité produit élevée, délais respectés, support technique réactif 24/7">
Qualité produit élevée, délais respectés, support technique réactif 24/7</textarea>
                <button class="edit-btn" onclick="enableEdit('expectationsInput')">
                    <i class="fa-solid fa-pen"></i>
                </button>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-chart-simple"></i> Influence sur le SMQ
                </label>
                <div class="range-slider-container">
                    <input type="range" min="1" max="5" value="3" class="range-slider" id="influenceRange">
                    <span class="range-slider-value" id="influenceValue">Moyenne (3/5)</span>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-user-tie"></i> Responsable
                </label>
                <input type="text" class="form-control editable-field" id="responsibleInput" 
                    placeholder="Nom du responsable dédié"
                    data-original="Marie Dubois">
                <button class="edit-btn" onclick="enableEdit('responsibleInput')">
                    <i class="fa-solid fa-pen"></i>
                </button>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-comments"></i> Fréquence de Contact
                </label>
                <select class="form-control" id="contactFrequency">
                    <option>Quotidien</option>
                    <option>Hebdomadaire</option>
                    <option selected>Mensuel</option>
                    <option>Trimestriel</option>
                </select>
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1rem;">
                    <button type="reset" class="btn btn-outline" onclick="resetForm()">
                        <i class="fa-solid fa-eraser"></i> Effacer
                    </button>
                    <button type="button" class="btn btn-success" onclick="saveStakeholder()">
                        <i class="fa-solid fa-floppy-disk"></i> Enregistrer Partie
                    </button>
                </div>
            </div>
        </form>
    </section>

    <!-- SECTION 3: BASE CENTRALISÉE ÉDITABLE -->
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
                <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                    <div style="position: relative; flex: 1; min-width: 200px;">
                        <input type="text" placeholder="Rechercher..." class="form-control" style="padding-left: 2.25rem;">
                        <i class="fa-solid fa-search" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                    </div>
                    <button class="btn btn-sm btn-outline" onclick="toggleEditTable()" id="editTableBtn">
                        <i class="fa-solid fa-pen"></i> Modifier Tableau
                    </button>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table" id="stakeholdersTable">
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
                    <tr id="row-1" data-editable="true">
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #1d4ed8); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.9rem;">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;" class="editable" data-field="name">Client A Corporation</div>
                                    <div style="font-size: 0.8rem; color: var(--gray-500);" class="editable" data-field="email">client@corp.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="type">
                                <option selected>Client</option>
                                <option>Fournisseur</option>
                                <option>Employé</option>
                            </select>
                            <span class="table-badge badge-client">Client</span>
                        </td>
                        <td style="max-width: 250px;">
                            <textarea class="form-control editable-field" style="display: none; font-size: 0.8rem; padding: 0.375rem;" data-field="expectations" rows="2">Qualité produit élevée, délais respectés, support technique réactif 24/7</textarea>
                            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; font-size: 0.85rem;">
                                Qualité produit élevée, délais respectés, support technique réactif 24/7
                            </div>
                        </td>
                        <td>
                            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="influence">
                                <option>Très faible</option>
                                <option>Faible</option>
                                <option selected>Moyenne</option>
                                <option>Élevée</option>
                                <option>Critique</option>
                            </select>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="width: 60px; height: 4px; background: var(--gray-300); border-radius: 2px;">
                                    <div style="width: 100%; height: 100%; background: var(--danger); border-radius: 2px;"></div>
                                </div>
                                <span class="table-badge badge-high">Élevée</span>
                            </div>
                        </td>
                        <td>
                            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="status">
                                <option selected>Actif</option>
                                <option>En attente</option>
                                <option>Inactif</option>
                            </select>
                            <span style="display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.8rem; color: var(--success);">
                                <i class="fa-solid fa-circle-check"></i> Actif
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.375rem;">
                                <button class="btn-icon btn-outline" onclick="editRow(1)" id="editBtn-1">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn-icon btn-outline" onclick="saveRow(1)" id="saveBtn-1" style="display: none;">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn-icon btn-outline" onclick="deleteRow(1)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr id="row-2" data-editable="true">
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #047857); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.9rem;">
                                    <i class="fa-solid fa-truck"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;" class="editable" data-field="name">Fournisseur B Logistics</div>
                                    <div style="font-size: 0.8rem; color: var(--gray-500);" class="editable" data-field="email">logistics@supplier.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="type">
                                <option>Client</option>
                                <option selected>Fournisseur</option>
                                <option>Employé</option>
                            </select>
                            <span class="table-badge badge-supplier">Fournisseur</span>
                        </td>
                        <td style="max-width: 250px;">
                            <textarea class="form-control editable-field" style="display: none; font-size: 0.8rem; padding: 0.375rem;" data-field="expectations" rows="2">Paiement sous 30 jours, commandes prévisionnelles, communication transparente</textarea>
                            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; font-size: 0.85rem;">
                                Paiement sous 30 jours, commandes prévisionnelles, communication transparente
                            </div>
                        </td>
                        <td>
                            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="influence">
                                <option>Très faible</option>
                                <option>Faible</option>
                                <option selected>Moyenne</option>
                                <option>Élevée</option>
                                <option>Critique</option>
                            </select>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="width: 60px; height: 4px; background: var(--gray-300); border-radius: 2px;">
                                    <div style="width: 80%; height: 100%; background: var(--warning); border-radius: 2px;"></div>
                                </div>
                                <span class="table-badge badge-medium">Moyenne</span>
                            </div>
                        </td>
                        <td>
                            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="status">
                                <option>Actif</option>
                                <option selected>En attente</option>
                                <option>Inactif</option>
                            </select>
                            <span style="display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.8rem; color: var(--warning);">
                                <i class="fa-solid fa-circle-exclamation"></i> En attente
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.375rem;">
                                <button class="btn-icon btn-outline" onclick="editRow(2)" id="editBtn-2">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn-icon btn-outline" onclick="saveRow(2)" id="saveBtn-2" style="display: none;">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn-icon btn-outline" onclick="deleteRow(2)">
                                    <i class="fa-solid fa-trash"></i>
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
                            <div style="display: flex; flex-wrap: wrap; gap: 0.375rem;">
                                <span class="table-badge badge-client">Production</span>
                                <span class="table-badge badge-supplier">Logistique</span>
                                <span class="table-badge" style="background: var(--info-light); color: var(--info);">Service Client</span>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                <div style="display: flex; justify-content: space-between; font-size: 0.8rem;">
                                    <span>Taux de conformité:</span>
                                    <span style="font-weight: 600; color: var(--success);">98%</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 0.8rem;">
                                    <span>Délai moyen:</span>
                                    <span style="font-weight: 600; color: var(--primary);">3.2 jours</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <span class="table-badge" style="background: var(--warning-light); color: var(--warning);">Non-conformité produit</span>
                                <span class="table-badge badge-high">Retard livraison</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- SECTION 5: GRAPHIQUES COMPACTS -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fa-solid fa-chart-column" style="color: var(--primary);"></i>
                    <span>Niveau d'Influence</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="influenceChart"></canvas>
            </div>
        </div>
    </div>

    <!-- SECTION 6: ANALYSE SWOT COMPACTE -->
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
        </div>

        <div class="swot-grid">
            <div class="swot-card swot-strengths">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <h3>Forces</h3>
                </div>
                <ul class="swot-list">
                    <li>Équipe qualité expérimentée</li>
                    <li>Processus documentés</li>
                    <li>Technologies avancées</li>
                </ul>
            </div>
            <div class="swot-card swot-weaknesses">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-minus"></i>
                    </div>
                    <h3>Faiblesses</h3>
                </div>
                <ul class="swot-list">
                    <li>Dépendance fournisseurs</li>
                    <li>Système informatique vieillissant</li>
                    <li>Processus administratifs lourds</li>
                </ul>
            </div>
            <div class="swot-card swot-opportunities">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                    <h3>Opportunités</h3>
                </div>
                <ul class="swot-list">
                    <li>Marché en croissance</li>
                    <li>Subventions digitalisation</li>
                    <li>Nouveaux marchés</li>
                </ul>
            </div>
            <div class="swot-card swot-threats">
                <div class="swot-header">
                    <div class="swot-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3>Menaces</h3>
                </div>
                <ul class="swot-list">
                    <li>Concurrence agressive</li>
                    <li>Évolution réglementaire</li>
                    <li>Pénurie compétences</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- SECTION 7: CARTOGRAPHIE DES PROCESSUS ÉDITABLE -->
    <section class="section">
        <div class="section-header">
            <div class="section-title">
                <div class="section-icon">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div>
                    <h2>Cartographie des Processus</h2>
                    <p class="section-subtitle">Visualisation et édition des interactions</p>
                </div>
            </div>
            <div class="section-actions">
                <button class="btn btn-sm btn-primary" onclick="addProcessNode()">
                    <i class="fa-solid fa-plus"></i> Ajouter Processus
                </button>
                <button class="btn btn-sm btn-outline" onclick="toggleProcessEditMode()" id="toggleProcessEditBtn">
                    <i class="fa-solid fa-pen"></i> Mode Édition
                </button>
                <button class="btn btn-sm btn-success" onclick="saveProcessMap()" id="saveProcessMapBtn" style="display: none;">
                    <i class="fa-solid fa-save"></i> Enregistrer
                </button>
            </div>
        </div>

        <div class="process-map-container" id="processMap">
            <!-- Actions de la carte -->
            <div class="process-map-actions">
                <button class="btn btn-sm btn-outline" onclick="clearProcessMap()" title="Effacer la carte">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <button class="btn btn-sm btn-outline" onclick="exportProcessMap()" title="Exporter">
                    <i class="fa-solid fa-download"></i>
                </button>
            </div>
            
            <!-- Légende -->
            <div style="position: absolute; bottom: 1rem; left: 1rem; background: white; padding: 0.5rem 1rem; border-radius: var(--radius-md); border: 1px solid var(--gray-200); box-shadow: var(--shadow-sm); font-size: 0.8rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                    <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--primary);"></div>
                    <span>Opérationnel</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                    <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--success);"></div>
                    <span>Support</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 12px; height: 12px; border-radius: 50%; background: var(--warning);"></div>
                    <span>Management</span>
                </div>
            </div>
            
            <!-- Nœuds de processus seront ajoutés ici dynamiquement -->
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
    const influenceValue = document.getElementById('influenceValue');
    
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
    
    // Récupérer les données originales pour les champs éditables
    document.querySelectorAll('.editable-field').forEach(field => {
        field.setAttribute('data-original', field.value);
    });
});

// Variables globales pour la cartographie
let processCount = 0;
let selectedProcessId = null;
let processEditMode = false;
let isDragging = false;
let dragOffset = { x: 0, y: 0 };
let processes = [];

// Fonctions pour l'édition spécifique Jeux Internes/Externes
function showEnjeux(type) {
    // Mettre à jour les boutons actifs
    document.querySelectorAll('.enjeux-toggle button').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Afficher le bon conteneur
    document.querySelectorAll('.enjeux-container').forEach(container => {
        container.classList.remove('active');
    });
    document.getElementById(`enjeux-${type}`).classList.add('active');
}

// Fonctions pour l'édition des formulaires
let editMode = {
    context: false,
    stakeholders: false
};

function toggleEditMode(section) {
    const sectionElement = document.getElementById(`${section}Section`);
    const editBtn = document.getElementById(`edit${section.charAt(0).toUpperCase() + section.slice(1)}Btn`);
    const saveBtn = document.getElementById(`save${section.charAt(0).toUpperCase() + section.slice(1)}Btn`);
    
    editMode[section] = !editMode[section];
    
    if (editMode[section]) {
        sectionElement.classList.add('editing');
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-flex';
        
        // Activer tous les champs éditables
        sectionElement.querySelectorAll('.editable-field').forEach(field => {
            field.removeAttribute('readonly');
            field.style.borderColor = 'var(--primary)';
        });
    } else {
        sectionElement.classList.remove('editing');
        editBtn.style.display = 'inline-flex';
        saveBtn.style.display = 'none';
        
        // Désactiver tous les champs éditables
        sectionElement.querySelectorAll('.editable-field').forEach(field => {
            field.setAttribute('readonly', true);
            field.style.borderColor = '';
        });
    }
}

function enableEdit(fieldId) {
    const field = document.getElementById(fieldId);
    if (field.hasAttribute('readonly')) {
        field.removeAttribute('readonly');
        field.focus();
        field.style.borderColor = 'var(--primary)';
        field.style.boxShadow = '0 0 0 2px var(--primary-light)';
        
        // Stocker la valeur originale si ce n'est pas déjà fait
        if (!field.hasAttribute('data-original')) {
            field.setAttribute('data-original', field.value);
        }
    }
}

function saveSection(section) {
    // Simuler la sauvegarde
    const sectionElement = document.getElementById(`${section}Section`);
    const fields = sectionElement.querySelectorAll('.editable-field');
    
    fields.forEach(field => {
        if (field.hasAttribute('data-original')) {
            field.setAttribute('data-original', field.value);
        }
        field.setAttribute('readonly', true);
        field.style.borderColor = '';
        field.style.boxShadow = '';
    });
    
    // Afficher la modal de confirmation
    showConfirmationModal();
    
    // Désactiver le mode édition
    toggleEditMode(section);
}

function saveStakeholder() {
    // Simuler l'enregistrement d'une nouvelle partie
    const name = document.getElementById('stakeholderName').value;
    const category = document.getElementById('stakeholderCategory').value;
    
    if (!name) {
        alert('Veuillez saisir un nom pour la partie intéressée.');
        return;
    }
    
    // Réinitialiser le formulaire
    document.getElementById('stakeholderForm').reset();
    document.getElementById('influenceValue').textContent = 'Moyenne (3/5)';
    
    // Afficher la modal de confirmation
    showConfirmationModal(`Nouvelle partie "${name}" (${category}) enregistrée avec succès.`);
}

function resetForm() {
    if (confirm('Êtes-vous sûr de vouloir réinitialiser le formulaire ? Toutes les modifications seront perdues.')) {
        document.getElementById('stakeholderForm').reset();
        document.getElementById('influenceValue').textContent = 'Moyenne (3/5)';
        
        // Restaurer les valeurs originales des champs éditables
        document.querySelectorAll('#stakeholderForm .editable-field').forEach(field => {
            if (field.hasAttribute('data-original')) {
                field.value = field.getAttribute('data-original');
            }
        });
    }
}

// Fonctions pour l'édition du tableau
let tableEditMode = false;

function toggleEditTable() {
    tableEditMode = !tableEditMode;
    const btn = document.getElementById('editTableBtn');
    
    if (tableEditMode) {
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Terminer';
        btn.classList.remove('btn-outline');
        btn.classList.add('btn-primary');
        
        // Afficher tous les boutons d'édition
        document.querySelectorAll('[id^="editBtn-"]').forEach(btn => {
            btn.style.display = 'flex';
        });
    } else {
        btn.innerHTML = '<i class="fa-solid fa-pen"></i> Modifier Tableau';
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline');
        
        // Masquer tous les boutons d'édition et sauvegarde
        document.querySelectorAll('[id^="editBtn-"], [id^="saveBtn-"]').forEach(btn => {
            btn.style.display = 'none';
        });
        
        // Masquer les champs d'édition et réafficher les valeurs
        document.querySelectorAll('tr[data-editable="true"]').forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach(cell => {
                const inputs = cell.querySelectorAll('select, textarea');
                const displays = cell.querySelectorAll('.editable, .table-badge, span');
                
                inputs.forEach(input => input.style.display = 'none');
                displays.forEach(display => display.style.display = '');
            });
        });
    }
}

function editRow(rowId) {
    const row = document.getElementById(`row-${rowId}`);
    const editBtn = document.getElementById(`editBtn-${rowId}`);
    const saveBtn = document.getElementById(`saveBtn-${rowId}`);
    
    // Masquer les éléments d'affichage et afficher les champs d'édition
    const cells = row.querySelectorAll('td');
    cells.forEach(cell => {
        const inputs = cell.querySelectorAll('select, textarea');
        const displays = cell.querySelectorAll('.editable, .table-badge, span');
        
        inputs.forEach(input => {
            input.style.display = 'block';
            // Récupérer la valeur actuelle
            const fieldName = input.getAttribute('data-field');
            const displayElement = cell.querySelector(`[data-field="${fieldName}"]`);
            if (displayElement && displayElement.textContent) {
                if (input.tagName === 'SELECT') {
                    input.value = getValueForSelect(displayElement.textContent);
                } else {
                    input.value = displayElement.textContent.trim();
                }
            }
        });
        
        displays.forEach(display => display.style.display = 'none');
    });
    
    editBtn.style.display = 'none';
    saveBtn.style.display = 'flex';
}

function saveRow(rowId) {
    const row = document.getElementById(`row-${rowId}`);
    const editBtn = document.getElementById(`editBtn-${rowId}`);
    const saveBtn = document.getElementById(`saveBtn-${rowId}`);
    
    // Mettre à jour les éléments d'affichage avec les nouvelles valeurs
    const cells = row.querySelectorAll('td');
    cells.forEach(cell => {
        const inputs = cell.querySelectorAll('select, textarea');
        const displays = cell.querySelectorAll('.editable, .table-badge, span');
        
        inputs.forEach(input => {
            const fieldName = input.getAttribute('data-field');
            const displayElement = cell.querySelector(`[data-field="${fieldName}"]`);
            
            if (displayElement) {
                if (input.tagName === 'SELECT') {
                    // Mettre à jour le badge ou le texte
                    if (fieldName === 'type') {
                        updateTypeBadge(cell, input.value);
                    } else if (fieldName === 'influence') {
                        updateInfluenceDisplay(cell, input.value);
                    } else if (fieldName === 'status') {
                        updateStatusDisplay(cell, input.value);
                    } else {
                        displayElement.textContent = input.value;
                    }
                } else {
                    displayElement.textContent = input.value;
                }
            }
        });
        
        inputs.forEach(input => input.style.display = 'none');
        displays.forEach(display => display.style.display = '');
    });
    
    editBtn.style.display = 'flex';
    saveBtn.style.display = 'none';
    
    // Afficher la modal de confirmation
    showConfirmationModal('Les modifications ont été enregistrées.');
}

function deleteRow(rowId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette partie intéressée ?')) {
        const row = document.getElementById(`row-${rowId}`);
        row.style.opacity = '0.5';
        
        // Animation de suppression
        setTimeout(() => {
            row.remove();
            showConfirmationModal('La partie intéressée a été supprimée.');
        }, 300);
    }
}

function updateTypeBadge(cell, value) {
    const badge = cell.querySelector('.table-badge');
    if (badge) {
        badge.className = 'table-badge ';
        badge.textContent = value;
        
        switch(value.toLowerCase()) {
            case 'client':
                badge.classList.add('badge-client');
                break;
            case 'fournisseur':
                badge.classList.add('badge-supplier');
                break;
            default:
                badge.style.background = 'var(--gray-200)';
                badge.style.color = 'var(--gray-700)';
        }
    }
}

function updateInfluenceDisplay(cell, value) {
    const badge = cell.querySelector('.table-badge');
    const bar = cell.querySelector('div > div');
    
    if (badge) {
        badge.className = 'table-badge ';
        
        switch(value.toLowerCase()) {
            case 'critique':
            case 'élevée':
                badge.classList.add('badge-high');
                if (bar) bar.style.width = '100%';
                break;
            case 'moyenne':
                badge.classList.add('badge-medium');
                if (bar) bar.style.width = '80%';
                break;
            default:
                badge.style.background = 'var(--gray-200)';
                badge.style.color = 'var(--gray-700)';
                if (bar) bar.style.width = '40%';
        }
        
        badge.textContent = value;
    }
}

function updateStatusDisplay(cell, value) {
    const statusSpan = cell.querySelector('span');
    if (statusSpan) {
        const icon = statusSpan.querySelector('i');
        
        switch(value.toLowerCase()) {
            case 'actif':
                statusSpan.style.color = 'var(--success)';
                if (icon) icon.className = 'fa-solid fa-circle-check';
                break;
            case 'en attente':
                statusSpan.style.color = 'var(--warning)';
                if (icon) icon.className = 'fa-solid fa-circle-exclamation';
                break;
            case 'inactif':
                statusSpan.style.color = 'var(--danger)';
                if (icon) icon.className = 'fa-solid fa-circle-xmark';
                break;
        }
        
        statusSpan.innerHTML = `<i class="${icon.className}"></i> ${value}`;
    }
}

function getValueForSelect(text) {
    // Convertir le texte affiché en valeur pour le select
    const mappings = {
        'Client': 'Client',
        'Fournisseur': 'Fournisseur',
        'Employé': 'Employé',
        'Élevée': 'Élevée',
        'Moyenne': 'Moyenne',
        'Faible': 'Faible',
        'Actif': 'Actif',
        'En attente': 'En attente',
        'Inactif': 'Inactif'
    };
    
    return mappings[text] || text;
}

// Fonctions pour la cartographie des processus éditables
function initializeProcessMap() {
    // Données initiales des processus
    processes = [
        {
            id: 1,
            title: 'Direction Stratégique',
            type: 'management',
            description: 'Définition des orientations stratégiques et allocation des ressources',
            responsible: 'Directeur Général',
            objectives: 'Alignement stratégique, performance organisationnelle',
            x: 100,
            y: 50
        },
        {
            id: 2,
            title: 'Développement Produit',
            type: 'process',
            description: 'Conception et développement de nouveaux produits',
            responsible: 'Directeur R&D',
            objectives: 'Innovation, time-to-market, qualité produit',
            x: 300,
            y: 50
        },
        {
            id: 3,
            title: 'Production',
            type: 'process',
            description: 'Fabrication des produits selon les spécifications',
            responsible: 'Directeur Production',
            objectives: 'Efficacité, qualité, délais',
            x: 200,
            y: 150
        },
        {
            id: 4,
            title: 'Gestion des Ressources Humaines',
            type: 'support',
            description: 'Recrutement, formation et développement du personnel',
            responsible: 'Directeur RH',
            objectives: 'Compétences, motivation, rétention',
            x: 100,
            y: 250
        },
        {
            id: 5,
            title: 'Contrôle Qualité',
            type: 'support',
            description: 'Vérification de la conformité des produits',
            responsible: 'Responsable Qualité',
            objectives: 'Conformité, amélioration continue',
            x: 300,
            y: 250
        }
    ];
    
    processCount = processes.length;
    
    // Créer les nœuds
    processes.forEach(process => {
        createProcessNode(process);
    });
    
    // Dessiner les connexions
    drawConnections();
}

function createProcessNode(process) {
    const container = document.getElementById('processMap');
    const node = document.createElement('div');
    
    node.className = `process-node process-node-${process.type}`;
    node.id = `process-node-${process.id}`;
    node.style.left = `${process.x}px`;
    node.style.top = `${process.y}px`;
    node.dataset.processId = process.id;
    
    const icon = process.type === 'process' ? 'fa-gears' : 
                 process.type === 'support' ? 'fa-life-ring' : 'fa-chart-line';
    
    node.innerHTML = `
        <div class="process-node-header">
            <div class="process-node-title">
                <i class="fa-solid ${icon}"></i>
                <span class="process-title-text">${process.title}</span>
                <input type="text" class="process-node-title-input" value="${process.title}" style="display: none;">
            </div>
            <div class="process-node-actions">
                <button class="process-node-action-btn" onclick="editProcess(${process.id})" title="Éditer">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="process-node-action-btn" onclick="deleteProcessNode(${process.id})" title="Supprimer">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="process-node-content">
            <div style="font-size: 0.75rem;">
                <i class="fa-solid fa-hashtag"></i>
                ID: P${process.id.toString().padStart(3, '0')}
            </div>
            <div class="process-node-description" style="display: none;">
                <textarea placeholder="Description du processus...">${process.description || ''}</textarea>
            </div>
        </div>
    `;
    
    container.appendChild(node);
    
    // Ajouter les événements de drag & drop
    makeDraggable(node, process.id);
    
    // Événement double-clic pour éditer le titre
    const titleElement = node.querySelector('.process-title-text');
    const titleInput = node.querySelector('.process-node-title-input');
    
    titleElement.addEventListener('dblclick', function() {
        if (processEditMode) {
            titleElement.style.display = 'none';
            titleInput.style.display = 'block';
            titleInput.focus();
            titleInput.select();
        }
    });
    
    titleInput.addEventListener('blur', function() {
        titleElement.style.display = 'block';
        titleInput.style.display = 'none';
        const newTitle = titleInput.value.trim();
        if (newTitle && newTitle !== process.title) {
            titleElement.textContent = newTitle;
            process.title = newTitle;
            updateProcessInArray(process.id, { title: newTitle });
        }
    });
    
    titleInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            titleInput.blur();
        }
    });
}

function makeDraggable(element, processId) {
    element.addEventListener('mousedown', startDrag);
    
    function startDrag(e) {
        if (!processEditMode) return;
        
        e.preventDefault();
        isDragging = true;
        selectedProcessId = processId;
        
        const rect = element.getBoundingClientRect();
        const containerRect = document.getElementById('processMap').getBoundingClientRect();
        
        dragOffset.x = e.clientX - rect.left + containerRect.left;
        dragOffset.y = e.clientY - rect.top + containerRect.top;
        
        element.style.cursor = 'grabbing';
        element.style.zIndex = '1000';
        
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', stopDrag);
    }
    
    function drag(e) {
        if (!isDragging) return;
        
        const container = document.getElementById('processMap');
        const containerRect = container.getBoundingClientRect();
        
        let x = e.clientX - dragOffset.x;
        let y = e.clientY - dragOffset.y;
        
        // Limites
        x = Math.max(10, Math.min(x, container.clientWidth - element.offsetWidth - 10));
        y = Math.max(10, Math.min(y, container.clientHeight - element.offsetHeight - 10));
        
        element.style.left = `${x}px`;
        element.style.top = `${y}px`;
        
        // Mettre à jour la position dans le tableau
        updateProcessInArray(selectedProcessId, { x, y });
        
        // Redessiner les connexions
        drawConnections();
    }
    
    function stopDrag() {
        if (!isDragging) return;
        
        isDragging = false;
        element.style.cursor = 'grab';
        element.style.zIndex = '1';
        selectedProcessId = null;
        
        document.removeEventListener('mousemove', drag);
        document.removeEventListener('mouseup', stopDrag);
    }
}

function updateProcessInArray(id, updates) {
    const index = processes.findIndex(p => p.id === id);
    if (index !== -1) {
        processes[index] = { ...processes[index], ...updates };
    }
}

function drawConnections() {
    // Supprimer les anciennes connexions
    document.querySelectorAll('.process-connection').forEach(el => el.remove());
    
    // Connexions prédéfinies (pour la démonstration)
    const connections = [
        { from: 1, to: 2 },
        { from: 1, to: 3 },
        { from: 2, to: 3 },
        { from: 3, to: 5 },
        { from: 4, to: 3 }
    ];
    
    const container = document.getElementById('processMap');
    
    connections.forEach(conn => {
        const fromNode = document.getElementById(`process-node-${conn.from}`);
        const toNode = document.getElementById(`process-node-${conn.to}`);
        
        if (fromNode && toNode) {
            const fromRect = fromNode.getBoundingClientRect();
            const toRect = toNode.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();
            
            const fromX = fromRect.left - containerRect.left + fromRect.width / 2;
            const fromY = fromRect.top - containerRect.top + fromRect.height / 2;
            const toX = toRect.left - containerRect.left + toRect.width / 2;
            const toY = toRect.top - containerRect.top + toRect.height / 2;
            
            const svgNS = "http://www.w3.org/2000/svg";
            const svg = document.createElementNS(svgNS, "svg");
            svg.classList.add('process-connection');
            svg.style.width = '100%';
            svg.style.height = '100%';
            svg.style.position = 'absolute';
            svg.style.top = '0';
            svg.style.left = '0';
            svg.style.pointerEvents = 'none';
            
            const line = document.createElementNS(svgNS, "line");
            line.setAttribute('x1', fromX);
            line.setAttribute('y1', fromY);
            line.setAttribute('x2', toX);
            line.setAttribute('y2', toY);
            line.setAttribute('class', 'connection-line');
            
            svg.appendChild(line);
            container.appendChild(svg);
        }
    });
}

function toggleProcessEditMode() {
    processEditMode = !processEditMode;
    const toggleBtn = document.getElementById('toggleProcessEditBtn');
    const saveBtn = document.getElementById('saveProcessMapBtn');
    const processMap = document.getElementById('processMap');
    
    if (processEditMode) {
        processMap.style.borderColor = 'var(--primary)';
        processMap.style.boxShadow = '0 0 0 2px var(--primary-light)';
        toggleBtn.innerHTML = '<i class="fa-solid fa-check"></i> Terminer Édition';
        toggleBtn.classList.remove('btn-outline');
        toggleBtn.classList.add('btn-primary');
        saveBtn.style.display = 'inline-flex';
        
        // Activer le drag & drop sur tous les nœuds
        document.querySelectorAll('.process-node').forEach(node => {
            node.style.cursor = 'grab';
        });
    } else {
        processMap.style.borderColor = '';
        processMap.style.boxShadow = '';
        toggleBtn.innerHTML = '<i class="fa-solid fa-pen"></i> Mode Édition';
        toggleBtn.classList.remove('btn-primary');
        toggleBtn.classList.add('btn-outline');
        saveBtn.style.display = 'none';
        
        // Désactiver le drag & drop
        document.querySelectorAll('.process-node').forEach(node => {
            node.style.cursor = 'default';
        });
    }
}

function addProcessNode() {
    processCount++;
    const container = document.getElementById('processMap');
    const containerRect = container.getBoundingClientRect();
    
    // Position aléatoire mais dans les limites
    const x = Math.random() * (containerRect.width - 200) + 50;
    const y = Math.random() * (containerRect.height - 150) + 50;
    
    const types = ['process', 'support', 'management'];
    const type = types[Math.floor(Math.random() * types.length)];
    
    const newProcess = {
        id: processCount,
        title: `Nouveau Processus ${processCount}`,
        type: type,
        description: '',
        responsible: '',
        objectives: '',
        x: x,
        y: y
    };
    
    processes.push(newProcess);
    createProcessNode(newProcess);
    drawConnections();
    
    // Ouvrir la modal d'édition
    editProcess(processCount);
}

function editProcess(processId) {
    const process = processes.find(p => p.id === processId);
    if (!process) return;
    
    selectedProcessId = processId;
    
    // Remplir le formulaire modal
    document.getElementById('processId').value = processId;
    document.getElementById('processName').value = process.title;
    document.getElementById('processType').value = process.type;
    document.getElementById('processDescription').value = process.description || '';
    document.getElementById('processResponsible').value = process.responsible || '';
    document.getElementById('processObjectives').value = process.objectives || '';
    
    // Afficher la modal
    document.getElementById('processModal').classList.add('active');
}

function saveProcess() {
    const processId = parseInt(document.getElementById('processId').value);
    const process = processes.find(p => p.id === processId);
    
    if (process) {
        process.title = document.getElementById('processName').value;
        process.type = document.getElementById('processType').value;
        process.description = document.getElementById('processDescription').value;
        process.responsible = document.getElementById('processResponsible').value;
        process.objectives = document.getElementById('processObjectives').value;
        
        // Mettre à jour l'affichage
        const node = document.getElementById(`process-node-${processId}`);
        if (node) {
            const titleElement = node.querySelector('.process-title-text');
            const iconElement = node.querySelector('.fa-solid');
            
            titleElement.textContent = process.title;
            
            // Mettre à jour l'icône selon le type
            const icon = process.type === 'process' ? 'fa-gears' : 
                        process.type === 'support' ? 'fa-life-ring' : 'fa-chart-line';
            iconElement.className = `fa-solid ${icon}`;
            
            // Mettre à jour la classe CSS
            node.className = `process-node process-node-${process.type}`;
        }
        
        closeProcessModal();
        showConfirmationModal('Processus mis à jour avec succès.');
    }
}

function deleteProcess() {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce processus ?')) {
        const processId = parseInt(document.getElementById('processId').value);
        deleteProcessNode(processId);
        closeProcessModal();
    }
}

function deleteProcessNode(processId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce processus ?')) {
        // Supprimer du tableau
        const index = processes.findIndex(p => p.id === processId);
        if (index !== -1) {
            processes.splice(index, 1);
        }
        
        // Supprimer le nœud du DOM
        const node = document.getElementById(`process-node-${processId}`);
        if (node) {
            node.style.opacity = '0.5';
            setTimeout(() => {
                node.remove();
                drawConnections();
                showConfirmationModal('Processus supprimé avec succès.');
            }, 300);
        }
    }
}

function closeProcessModal() {
    document.getElementById('processModal').classList.remove('active');
    selectedProcessId = null;
}

function saveProcessMap() {
    // Simuler la sauvegarde de la carte
    localStorage.setItem('processMapData', JSON.stringify(processes));
    showConfirmationModal('Cartographie des processus sauvegardée.');
}

function clearProcessMap() {
    if (confirm('Êtes-vous sûr de vouloir effacer toute la cartographie ?')) {
        processes = [];
        document.querySelectorAll('.process-node').forEach(node => node.remove());
        document.querySelectorAll('.process-connection').forEach(conn => conn.remove());
        showConfirmationModal('Cartographie effacée.');
    }
}

function exportProcessMap() {
    // Simuler l'export
    const data = {
        processes: processes,
        exportDate: new Date().toISOString(),
        version: '1.0'
    };
    
    const dataStr = JSON.stringify(data, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
    
    const exportFileDefaultName = `cartographie-processus-${new Date().toISOString().split('T')[0]}.json`;
    
    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
    
    showConfirmationModal('Cartographie exportée avec succès.');
}

// Fonctions pour la modale
function showConfirmationModal(message) {
    const modal = document.getElementById('confirmationModal');
    const now = new Date();
    const timeString = now.toLocaleTimeString('fr-FR', { 
        hour: '2-digit', 
        minute: '2-digit',
        second: '2-digit'
    });
    
    document.getElementById('lastSaveTime').textContent = timeString;
    
    if (message) {
        modal.querySelector('.modal-body p').textContent = message;
    }
    
    modal.classList.add('active');
    
    // Afficher l'indicateur de sauvegarde
    showSavedIndicator();
}

function closeModal() {
    document.getElementById('confirmationModal').classList.remove('active');
}

function viewHistory() {
    closeModal();
    alert('Fonctionnalité historique à implémenter');
}

function showSavedIndicator() {
    // Créer ou mettre à jour l'indicateur
    let indicator = document.querySelector('.saved-indicator');
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.className = 'saved-indicator';
        document.body.appendChild(indicator);
    }
    
    indicator.innerHTML = `
        <i class="fa-solid fa-circle-check"></i>
        <span>Modifications enregistrées</span>
    `;
    
    // Masquer après 3 secondes
    setTimeout(() => {
        indicator.style.opacity = '0';
        indicator.style.transform = 'translateY(20px)';
        setTimeout(() => {
            if (indicator.parentNode) {
                indicator.parentNode.removeChild(indicator);
            }
        }, 300);
    }, 3000);
}

function addStakeholder() {
    // Simuler l'ajout d'une nouvelle partie
    const newRow = document.createElement('tr');
    newRow.id = 'row-new';
    newRow.setAttribute('data-editable', 'true');
    
    newRow.innerHTML = `
        <td>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #7c3aed); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.9rem;">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <div style="font-weight: 600;" class="editable" data-field="name">Nouvelle Partie</div>
                    <div style="font-size: 0.8rem; color: var(--gray-500);" class="editable" data-field="email">email@exemple.com</div>
                </div>
            </div>
        </td>
        <td>
            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="type">
                <option selected>Client</option>
                <option>Fournisseur</option>
                <option>Employé</option>
            </select>
            <span class="table-badge badge-client">Client</span>
        </td>
        <td style="max-width: 250px;">
            <textarea class="form-control editable-field" style="display: none; font-size: 0.8rem; padding: 0.375rem;" data-field="expectations" rows="2">À définir</textarea>
            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; font-size: 0.85rem;">
                À définir
            </div>
        </td>
        <td>
            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="influence">
                <option>Très faible</option>
                <option>Faible</option>
                <option selected>Moyenne</option>
                <option>Élevée</option>
                <option>Critique</option>
            </select>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 60px; height: 4px; background: var(--gray-300); border-radius: 2px;">
                    <div style="width: 60%; height: 100%; background: var(--warning); border-radius: 2px;"></div>
                </div>
                <span class="table-badge badge-medium">Moyenne</span>
            </div>
        </td>
        <td>
            <select class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; width: auto; display: none;" data-field="status">
                <option selected>Actif</option>
                <option>En attente</option>
                <option>Inactif</option>
            </select>
            <span style="display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.8rem; color: var(--success);">
                <i class="fa-solid fa-circle-check"></i> Actif
            </span>
        </td>
        <td>
            <div style="display: flex; gap: 0.375rem;">
                <button class="btn-icon btn-outline" onclick="editRow('new')" id="editBtn-new">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="btn-icon btn-outline" onclick="saveRow('new')" id="saveBtn-new" style="display: none;">
                    <i class="fa-solid fa-check"></i>
                </button>
                <button class="btn-icon btn-outline" onclick="deleteRow('new')">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </td>
    `;
    
    // Ajouter à la fin du tableau
    const tbody = document.querySelector('#stakeholdersTable tbody');
    tbody.appendChild(newRow);
    
    // Activer le mode édition
    editRow('new');
    
    showConfirmationModal('Nouvelle partie intéressée ajoutée. Veuillez compléter les informations.');
}

// Fonctions pour les graphiques
function initializeCharts() {
    // Graphique d'influence simplifié
    const ctx1 = document.getElementById('influenceChart');
    if (ctx1) {
        new Chart(ctx1.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Clients', 'Fournisseurs', 'Employés', 'Autorités'],
                datasets: [{
                    label: 'Influence',
                    data: [5, 4, 3, 5],
                    backgroundColor: [
                        'rgba(37, 99, 235, 0.8)',
                        'rgba(22, 163, 74, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(220, 38, 38, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, max: 5 }
                }
            }
        });
    }
}
</script>
@endsection