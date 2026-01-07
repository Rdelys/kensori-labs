@extends('layouts.clients')

@section('title', 'Registre des Réclamations')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* ===== RESET ET VARIABLES ===== */
:root {
    --primary-color: #3b82f6;
    --secondary-color: #6b7280;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #0ea5e9;
    --light-color: #f8fafc;
    --dark-color: #1f2937;
    --border-color: #e5e7eb;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --radius-sm: 0.375rem;
    --radius-md: 0.5rem;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* ===== CONTAINER PRINCIPAL ===== */
.nc-container {
    padding: 1rem;
    max-width: 1400px;
    margin: 0 auto;
    background: #f9fafb;
    min-height: 100vh;
}

/* ===== EN-TÊTE ===== */
.page-header {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 1.5rem;
}

@media (min-width: 640px) {
    .page-header {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}

.header-left h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-color);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.header-icon {
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, #ef4444, #f97316);
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-icon i {
    color: white;
    font-size: 0.9rem;
}

.header-subtitle {
    font-size: 0.875rem;
    color: var(--secondary-color);
    margin-top: 0.25rem;
}

.header-actions {
    display: flex;
    gap: 0.5rem;
}

/* ===== BOUTONS ===== */
.btn {
    padding: 0.5rem 1rem;
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    font-weight: 500;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.375rem;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-primary {
    background: linear-gradient(135deg, var(--danger-color), #f97316);
    color: white;
}

.btn-secondary {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: white;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
}

.btn-icon {
    width: 2rem;
    height: 2rem;
    padding: 0;
    justify-content: center;
}

/* ===== INDICATEURS KPI ===== */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

@media (min-width: 640px) {
    .kpi-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.kpi-card {
    background: white;
    border-radius: var(--radius-md);
    padding: 1rem;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    transition: all 0.2s ease;
}

.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.kpi-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.kpi-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.kpi-icon-red { background: rgba(239, 68, 68, 0.1); color: var(--danger-color); }
.kpi-icon-blue { background: rgba(59, 130, 246, 0.1); color: var(--primary-color); }
.kpi-icon-green { background: rgba(16, 185, 129, 0.1); color: var(--success-color); }
.kpi-icon-purple { background: rgba(139, 92, 246, 0.1); color: #8b5cf6; }

.kpi-text .label {
    font-size: 0.75rem;
    color: var(--secondary-color);
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.kpi-text .value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-color);
    margin: 0.125rem 0;
}

.kpi-text .trend {
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.trend-positive { color: var(--success-color); }
.trend-negative { color: var(--danger-color); }

/* ===== SECTION FILTRES - CORRIGÉE ===== */
.filters-section {
    background: white;
    border-radius: var(--radius-md);
    padding: 1rem;
    border: 1px solid var(--border-color);
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
}

.filters-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

@media (min-width: 768px) {
    .filters-container {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

.filters-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--dark-color);
    font-weight: 500;
}

.filters-label i {
    color: var(--secondary-color);
    font-size: 0.75rem;
}

/* ===== GRID DES FILTRES - CORRIGÉE ===== */
.filters-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
    width: 100%;
}

@media (min-width: 768px) {
    .filters-grid {
        display: flex;
        grid-template-columns: none;
        flex-wrap: nowrap;
        gap: 0.5rem;
        width: auto;
    }
}

.filter-select {
    padding: 0.5rem;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    background: white;
    font-size: 0.75rem;
    color: var(--dark-color);
    cursor: pointer;
    min-width: 120px;
    transition: border-color 0.2s ease;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-container {
    position: relative;
    grid-column: span 2;
}

@media (min-width: 768px) {
    .search-container {
        grid-column: auto;
        min-width: 180px;
    }
}

.search-input {
    width: 100%;
    padding: 0.5rem 2rem 0.5rem 0.75rem;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    background: white;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-icon {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary-color);
    font-size: 0.75rem;
    pointer-events: none;
}

/* ===== TABLEAU PRINCIPAL ===== */
.main-table-container {
    background: white;
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 1.5rem;
}

.table-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem;
}

.table-header-content {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

@media (min-width: 640px) {
    .table-header-content {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}

.table-title h2 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.table-title p {
    font-size: 0.75rem;
    opacity: 0.9;
}

.table-actions {
    display: flex;
    gap: 0.5rem;
}

.table-wrapper {
    overflow-x: auto;
}

.nc-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.75rem;
}

.nc-table thead {
    background: #f9fafb;
    border-bottom: 2px solid var(--border-color);
}

.nc-table th {
    padding: 0.75rem;
    text-align: left;
    font-weight: 600;
    color: var(--dark-color);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.nc-table td {
    padding: 0.75rem;
    border-bottom: 1px solid var(--border-color);
    vertical-align: top;
}

.nc-table tbody tr {
    transition: background-color 0.15s ease;
}

.nc-table tbody tr:hover {
    background-color: #f8fafc;
}

/* ===== BADGES ===== */
.badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.65rem;
    font-weight: 600;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
}

.status-badge {
    min-width: 70px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.status-new { background: #fef3c7; color: #92400e; }
.status-inprogress { background: #dbeafe; color: #1e40af; }
.status-resolved { background: #d1fae5; color: #065f46; }
.status-pending { background: #fef3c7; color: #92400e; }
.status-closed { background: #e5e7eb; color: #374151; }

.priority-high { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
.priority-medium { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
.priority-low { background: #d1fae5; color: #059669; border: 1px solid #a7f3d0; }
.priority-critical { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-weight: 700; }

.channel-badge {
    padding: 0.125rem 0.375rem;
    font-size: 0.65rem;
    border-radius: 0.25rem;
    margin-top: 0.25rem;
}

.bg-blue-100 { background: #dbeafe; color: #1e40af; }
.bg-green-100 { background: #d1fae5; color: #065f46; }
.bg-purple-100 { background: #e9d5ff; color: #7c3aed; }
.bg-red-100 { background: #fee2e2; color: #dc2626; }

/* ===== ACTIONS DU TABLEAU ===== */
.table-actions-cell {
    min-width: 120px;
}

.action-buttons {
    display: flex;
    gap: 0.25rem;
}

.action-btn {
    width: 1.75rem;
    height: 1.75rem;
    border: none;
    border-radius: var(--radius-sm);
    background: transparent;
    color: var(--secondary-color);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s ease;
    font-size: 0.75rem;
}

.action-btn:hover {
    background: #f3f4f6;
}

.edit-btn:hover { color: var(--primary-color); }
.view-btn:hover { color: var(--success-color); }
.delete-btn:hover { color: var(--danger-color); }
.close-btn:hover { color: #8b5cf6; }
.assign-btn:hover { color: var(--info-color); }
.escalate-btn:hover { color: #f97316; }

/* ===== PAGINATION ===== */
.pagination-container {
    padding: 1rem;
    border-top: 1px solid var(--border-color);
    background: #f9fafb;
}

.pagination-content {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
}

@media (min-width: 640px) {
    .pagination-content {
        flex-direction: row;
        justify-content: space-between;
    }
}

.pagination-info {
    font-size: 0.75rem;
    color: var(--secondary-color);
}

.pagination-info strong {
    color: var(--dark-color);
}

.pagination-nav {
    display: flex;
    gap: 0.25rem;
}

.page-btn {
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    background: white;
    color: var(--dark-color);
    font-size: 0.75rem;
    cursor: pointer;
    transition: all 0.15s ease;
}

.page-btn:hover {
    background: #f3f4f6;
    border-color: #d1d5db;
}

.page-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.page-btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ===== SECTION ANALYSE ===== */
.analysis-section {
    background: white;
    border-radius: var(--radius-md);
    padding: 1.5rem;
    border: 1px solid var(--border-color);
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
}

.analysis-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border-color);
}

.analysis-header h3 {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--dark-color);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.recurrence-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(1, 1fr);
    margin-bottom: 1.5rem;
}

@media (min-width: 768px) {
    .recurrence-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.recurrence-item {
    background: #f8fafc;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    padding: 1rem;
}

.recurrence-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.75rem;
}

.recurrence-title h4 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
}

.recurrence-title p {
    font-size: 0.75rem;
    color: var(--secondary-color);
}

.recurrence-count {
    font-size: 0.75rem;
    font-weight: 700;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
}

.bg-red-100 { background: #fee2e2; color: #dc2626; }
.bg-blue-100 { background: #dbeafe; color: #1e40af; }

.progress-bar {
    height: 0.5rem;
    background: #e5e7eb;
    border-radius: 0.25rem;
    overflow: hidden;
    margin: 0.5rem 0;
}

.progress-fill {
    height: 100%;
    border-radius: 0.25rem;
}

.bg-red-500 { background: #ef4444; }
.bg-orange-500 { background: #f97316; }
.bg-yellow-500 { background: #f59e0b; }
.bg-blue-500 { background: #3b82f6; }

.stats-item {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.75rem;
    color: var(--secondary-color);
    margin-top: 0.5rem;
}

/* ===== ACTIONS CORRECTIVES ===== */
.corrective-actions {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.corrective-actions h4 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 1rem;
}

.actions-grid {
    display: grid;
    gap: 0.75rem;
    grid-template-columns: repeat(1, 1fr);
}

@media (min-width: 768px) {
    .actions-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.action-item {
    background: #f0f9ff;
    border: 1px solid #bae6fd;
    border-radius: var(--radius-md);
    padding: 0.75rem;
}

.action-item:nth-child(2) {
    background: #f0fdf4;
    border-color: #bbf7d0;
}

.action-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.action-title {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--dark-color);
}

.action-status {
    font-size: 0.65rem;
    padding: 0.125rem 0.375rem;
    border-radius: 9999px;
    font-weight: 500;
}

.bg-green-100 { background: #d1fae5; color: #065f46; }
.bg-blue-100 { background: #dbeafe; color: #1e40af; }

.action-desc {
    font-size: 0.75rem;
    color: var(--secondary-color);
    margin-bottom: 0.5rem;
}

/* ===== OBJECTIF ===== */
.objectif-section {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.objectif-content {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    align-items: flex-start;
}

@media (min-width: 640px) {
    .objectif-content {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}

.objectif-text p:first-child {
    font-size: 0.75rem;
    color: var(--secondary-color);
    margin-bottom: 0.25rem;
}

.objectif-text p:last-child {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--success-color);
}

.objectif-progress {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.25rem;
}

.objectif-progress .stats {
    font-size: 0.75rem;
    color: var(--dark-color);
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.progress-bar-small {
    width: 6rem;
    height: 0.375rem;
    background: #e5e7eb;
    border-radius: 0.25rem;
    overflow: hidden;
}

.progress-fill-green {
    height: 100%;
    background: var(--success-color);
    border-radius: 0.25rem;
}

/* ===== MODALS ===== */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal.active {
    display: flex;
}

.modal-content {
    background: white;
    border-radius: var(--radius-md);
    width: 100%;
    max-width: 42rem;
    max-height: 85vh;
    overflow-y: auto;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.modal-header {
    padding: 1rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--dark-color);
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--secondary-color);
    cursor: pointer;
    width: 1.5rem;
    height: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.25rem;
    transition: background-color 0.15s ease;
}

.modal-close:hover {
    background: #f3f4f6;
    color: var(--danger-color);
}

.modal-body {
    padding: 1rem;
}

.modal-footer {
    padding: 1rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
}

/* ===== FORMULAIRES ===== */
.form-section {
    background: white;
    border-radius: var(--radius-md);
    padding: 1.5rem;
    border: 1px solid var(--border-color);
    margin-bottom: 1.5rem;
    display: none;
}

.form-section.active {
    display: block;
}

.form-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(1, 1fr);
}

@media (min-width: 768px) {
    .form-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.form-group {
    margin-bottom: 0.75rem;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    display: block;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--dark-color);
    margin-bottom: 0.25rem;
}

.form-label.required::after {
    content: " *";
    color: var(--danger-color);
}

.form-control {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    color: var(--dark-color);
    background: white;
    transition: border-color 0.15s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

textarea.form-control {
    min-height: 5rem;
    resize: vertical;
}

.form-actions {
    grid-column: 1 / -1;
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    padding-top: 1rem;
    margin-top: 1rem;
    border-top: 1px solid var(--border-color);
}

/* ===== NOTIFICATIONS ===== */
.notification {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 1100;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    font-size: 0.75rem;
    font-weight: 500;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.notification.success { background: linear-gradient(135deg, #10b981, #059669); }
.notification.warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
.notification.info { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
.notification.error { background: linear-gradient(135deg, #ef4444, #dc2626); }

/* ===== BOUTON FLOTTANT ===== */
.floating-btn {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--danger-color), #f97316);
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    z-index: 900;
    transition: all 0.2s ease;
}

.floating-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 640px) {
    .nc-container {
        padding: 0.5rem;
    }
    
    .kpi-grid {
        gap: 0.5rem;
    }
    
    .kpi-card {
        padding: 0.75rem;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
    }
    
    .search-container {
        grid-column: 1;
    }
    
    .nc-table {
        font-size: 0.7rem;
    }
    
    .nc-table th,
    .nc-table td {
        padding: 0.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.125rem;
    }
    
    .action-btn {
        width: 1.5rem;
        height: 1.5rem;
    }
    
    .floating-btn {
        bottom: 1rem;
        right: 1rem;
        width: 2.5rem;
        height: 2.5rem;
        font-size: 0.875rem;
    }
}

@media (max-width: 480px) {
    .kpi-grid {
        grid-template-columns: 1fr;
    }
    
    .table-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="nc-container">
    <!-- ===== EN-TÊTE ===== -->
    <div class="page-header">
        <div class="header-left">
            <h1>
                <div class="header-icon">
                    <i class="fas fa-flag"></i>
                </div>
                Registre des Réclamations
            </h1>
            <p class="header-subtitle">Suivi et traitement des réclamations clients</p>
        </div>
        <div class="header-actions">
            <button id="btnExportPDF" class="btn btn-secondary btn-sm">
                <i class="fas fa-file-pdf"></i>
                <span class="hidden sm:inline">Export PDF</span>
            </button>
            <button id="btnNewReclam" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                <span class="hidden sm:inline">Nouvelle</span>
            </button>
        </div>
    </div>

    <!-- ===== INDICATEURS KPI ===== -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-content">
                <div class="kpi-icon kpi-icon-red">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="kpi-text">
                    <div class="label">Ce mois</div>
                    <div class="value">24</div>
                    <div class="trend trend-positive">
                        <i class="fas fa-arrow-up"></i>
                        +3 vs mois dernier
                    </div>
                </div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-content">
                <div class="kpi-icon kpi-icon-blue">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="kpi-text">
                    <div class="label">En cours</div>
                    <div class="value">8</div>
                    <div class="progress-bar">
                        <div class="progress-fill bg-blue-500" style="width: 33%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-content">
                <div class="kpi-icon kpi-icon-green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="kpi-text">
                    <div class="label">Taux résolution</div>
                    <div class="value">92%</div>
                    <div class="trend trend-negative">
                        <i class="fas fa-arrow-down"></i>
                        Objectif: 95%
                    </div>
                </div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-content">
                <div class="kpi-icon kpi-icon-purple">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
                <div class="kpi-text">
                    <div class="label">Délai moyen</div>
                    <div class="value">3.2j</div>
                    <div class="trend trend-positive">
                        <i class="fas fa-arrow-down"></i>
                        -0.5j
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FILTRES ===== -->
    <div class="filters-section">
        <div class="filters-container">
            <div class="filters-label">
                <i class="fas fa-filter"></i>
                <span>Filtres rapides :</span>
            </div>
            <div class="filters-grid">
                <select id="filterStatus" class="filter-select">
                    <option value="">Tous statuts</option>
                    <option value="new">Nouveau</option>
                    <option value="inprogress">En cours</option>
                    <option value="resolved">Résolu</option>
                    <option value="closed">Fermé</option>
                </select>
                <select id="filterUrgence" class="filter-select">
                    <option value="">Toutes urgences</option>
                    <option value="critical">Critique</option>
                    <option value="high">Élevé</option>
                    <option value="medium">Moyen</option>
                    <option value="low">Faible</option>
                </select>
                <select id="filterCategorie" class="filter-select">
                    <option value="">Toutes catégories</option>
                    <option value="damaged">Produit endommagé</option>
                    <option value="delayed">Retard livraison</option>
                    <option value="billing">Erreur facturation</option>
                    <option value="service">Service client</option>
                </select>
                <div class="search-container">
                    <input type="text" id="searchReclam" class="search-input" placeholder="Rechercher...">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== TABLEAU PRINCIPAL ===== -->
    <div class="main-table-container">
        <div class="table-header">
            <div class="table-header-content">
                <div class="table-title">
                    <h2>
                        <i class="fas fa-list-check"></i>
                        Réclamations en cours
                    </h2>
                    <p id="tableCounter">24 réclamations - 8 en traitement</p>
                </div>
                <div class="table-actions">
                    <button id="btnNewAction" class="btn btn-sm" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Action</span>
                    </button>
                    <button id="btnAnalyseRecurrence" class="btn btn-sm" style="background: linear-gradient(135deg, #8b5cf6, #ec4899); color: white;">
                        <i class="fas fa-chart-pie"></i>
                        <span class="hidden sm:inline">Analyse</span>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="table-wrapper">
            <table class="nc-table">
                <thead>
                    <tr>
                        <th>ID / Client</th>
                        <th>Date / Canal</th>
                        <th>Catégorie</th>
                        <th>Urgence</th>
                        <th>Statut</th>
                        <th class="table-actions-cell">Actions</th>
                    </tr>
                </thead>
                <tbody id="reclamationsTable">
                    <!-- Exemple 1 -->
                    <tr data-id="1" data-status="resolved" data-urgence="high" data-categorie="damaged" data-produit="Smartphone X200" data-departement="Logistique">
                        <td>
                            <div class="font-bold">#REC-2025-001</div>
                            <div class="text-secondary">Client A</div>
                        </td>
                        <td>
                            <div>15/12/25</div>
                            <span class="channel-badge bg-blue-100">Email</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-box-open text-red-500"></i>
                                <span>Produit endommagé</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge priority-high">Élevé</span>
                        </td>
                        <td>
                            <span class="badge status-resolved">Résolu</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn view-btn" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Exemple 2 -->
                    <tr data-id="2" data-status="inprogress" data-urgence="medium" data-categorie="delayed" data-produit="Tablet Pro 12" data-departement="Transport">
                        <td>
                            <div class="font-bold">#REC-2025-002</div>
                            <div class="text-secondary">Client B</div>
                        </td>
                        <td>
                            <div>14/12/25</div>
                            <span class="channel-badge bg-green-100">Téléphone</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-truck text-orange-500"></i>
                                <span>Retard livraison</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge priority-medium">Moyen</span>
                        </td>
                        <td>
                            <span class="badge status-inprogress">En cours</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn view-btn" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn close-btn" title="Clôturer">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Exemple 3 -->
                    <tr data-id="3" data-status="resolved" data-urgence="low" data-categorie="billing" data-produit="Laptop Elite" data-departement="Comptabilité">
                        <td>
                            <div class="font-bold">#REC-2025-003</div>
                            <div class="text-secondary">Client C</div>
                        </td>
                        <td>
                            <div>13/12/25</div>
                            <span class="channel-badge bg-purple-100">App mobile</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-file-invoice-dollar text-purple-500"></i>
                                <span>Erreur facture</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge priority-low">Faible</span>
                        </td>
                        <td>
                            <span class="badge status-resolved">Résolu</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn view-btn" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Exemple 4 -->
                    <tr data-id="4" data-status="new" data-urgence="critical" data-categorie="service" data-produit="Support technique" data-departement="Service Client">
                        <td>
                            <div class="font-bold">#REC-2025-004</div>
                            <div class="text-secondary">Client D</div>
                        </td>
                        <td>
                            <div>12/12/25</div>
                            <span class="channel-badge bg-red-100">Réseau social</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-headset text-blue-500"></i>
                                <span>Service client</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge priority-critical">Critique</span>
                        </td>
                        <td>
                            <span class="badge status-new">Nouveau</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn view-btn" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn assign-btn" title="Assigner">
                                    <i class="fas fa-user-check"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Exemple 5 -->
                    <tr data-id="5" data-status="pending" data-urgence="medium" data-categorie="damaged" data-produit="Smartphone X200" data-departement="Qualité">
                        <td>
                            <div class="font-bold">#REC-2025-005</div>
                            <div class="text-secondary">Client E</div>
                        </td>
                        <td>
                            <div>11/12/25</div>
                            <span class="channel-badge bg-blue-100">Email</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-triangle-exclamation text-yellow-500"></i>
                                <span>Non conforme</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge priority-medium">Moyen</span>
                        </td>
                        <td>
                            <span class="badge status-pending">En attente</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn edit-btn" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn view-btn" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn escalate-btn" title="Escalader">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-content">
                <div class="pagination-info">
                    Affichage <strong>1-5</strong> de <strong>24</strong> réclamations
                </div>
                <div class="pagination-nav">
                    <button class="page-btn disabled">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ANALYSE DES RÉCURRENCES ===== -->
    <div class="analysis-section">
        <div class="analysis-header">
            <h3>
                <i class="fas fa-chart-line text-red-500"></i>
                Analyse des Récurrences
            </h3>
            <button id="btnExportAnalyse" class="btn btn-secondary btn-sm">
                <i class="fas fa-download"></i>
                <span class="hidden sm:inline">Export</span>
            </button>
        </div>
        
        <div class="recurrence-grid">
            <!-- Produit avec plus de problèmes -->
            <div class="recurrence-item">
                <div class="recurrence-header">
                    <div class="recurrence-title">
                        <h4>Produit le plus problématique</h4>
                        <p>Smartphone X200</p>
                    </div>
                    <span class="recurrence-count bg-red-100">12 incidents</span>
                </div>
                <div class="text-sm mb-2">Taux de récurrence: <strong class="text-red-600">25%</strong></div>
                <div class="progress-bar">
                    <div class="progress-fill bg-red-500" style="width: 25%"></div>
                </div>
                <div class="stats-item">
                    <i class="fas fa-building"></i>
                    Département principal: <strong>Logistique</strong>
                </div>
            </div>
            
            <!-- Top 3 produits récurrents -->
            <div class="recurrence-item">
                <h4 class="mb-3">Top 3 produits récurrents</h4>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-sm">
                            <span>Tablet Pro 12</span>
                            <strong class="text-orange-600">8 incidents</strong>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-orange-500" style="width: 16.7%"></div>
                        </div>
                        <div class="stats-item">
                            <i class="fas fa-truck"></i>
                            Dépt: Transport
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-sm">
                            <span>Laptop Elite</span>
                            <strong class="text-yellow-600">6 incidents</strong>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-yellow-500" style="width: 12.5%"></div>
                        </div>
                        <div class="stats-item">
                            <i class="fas fa-file-invoice"></i>
                            Dépt: Comptabilité
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Département le plus concerné -->
            <div class="recurrence-item">
                <div class="recurrence-header">
                    <div class="recurrence-title">
                        <h4>Département le plus concerné</h4>
                        <p>Logistique</p>
                    </div>
                    <span class="recurrence-count bg-blue-100">18 incidents</span>
                </div>
                <div class="text-sm mb-2">Part des récurrences: <strong class="text-blue-600">37.5%</strong></div>
                <div class="progress-bar">
                    <div class="progress-fill bg-blue-500" style="width: 37.5%"></div>
                </div>
                <div class="stats-item">
                    <i class="fas fa-box"></i>
                    Produit principal: <strong>Smartphone X200</strong>
                </div>
            </div>
            
            <!-- Tendance récurrente -->
            <div class="recurrence-item">
                <h4 class="mb-3">Tendance récurrente</h4>
                <div class="text-sm mb-3">Produits endommagés en transit représentent <strong class="text-red-600">45%</strong> des récurrences</div>
                <div class="space-y-2">
                    <div>
                        <div class="flex justify-between text-sm">
                            <span>Transports fragiles</span>
                            <span>42%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-red-400" style="width: 42%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm">
                            <span>Emballage inadéquat</span>
                            <span>35%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-orange-400" style="width: 35%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actions correctives -->
        <div class="corrective-actions">
            <h4>Actions correctives prioritaires</h4>
            <div class="actions-grid">
                <div class="action-item">
                    <div class="action-header">
                        <span class="action-title">Amélioration emballage smartphone</span>
                        <span class="action-status bg-green-100">En cours</span>
                    </div>
                    <p class="action-desc">Cible: -40% dommages</p>
                    <div class="stats-item">
                        <i class="fas fa-industry"></i>
                        Dépt: Logistique & Production
                    </div>
                </div>
                
                <div class="action-item">
                    <div class="action-header">
                        <span class="action-title">Formation transport fragile</span>
                        <span class="action-status bg-blue-100">Planifié</span>
                    </div>
                    <p class="action-desc">Janv 2026 - Équipe transport</p>
                    <div class="stats-item">
                        <i class="fas fa-users"></i>
                        Dépt: Transport & RH
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Objectif réduction -->
        <div class="objectif-section">
            <div class="objectif-content">
                <div class="objectif-text">
                    <p>Objectif réduction récurrences</p>
                    <p>-50% d'ici Juin 2026</p>
                </div>
                <div class="objectif-progress">
                    <div class="stats">
                        <span>Progression:</span>
                        <strong class="text-green-600">30%</strong>
                    </div>
                    <div class="progress-bar-small">
                        <div class="progress-fill-green" style="width: 30%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FORMULAIRE NOUVELLE RÉCLAMATION ===== -->
    <div id="newReclamForm" class="form-section">
        <h3 class="text-lg font-bold mb-4">Nouvelle réclamation</h3>
        <form id="reclamForm" class="form-grid">
            <div class="form-group full-width">
                <label class="form-label required">Client</label>
                <select class="form-control" required>
                    <option value="">Sélectionner un client</option>
                    <option>Client A</option>
                    <option>Client B</option>
                    <option>Client C</option>
                    <option>Client D</option>
                    <option>Client E</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label required">Produit</label>
                <select class="form-control" required>
                    <option value="">Sélectionner</option>
                    <option>Smartphone X200</option>
                    <option>Tablet Pro 12</option>
                    <option>Laptop Elite</option>
                    <option>Support technique</option>
                    <option>Autre</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label required">Catégorie</label>
                <select class="form-control" required>
                    <option value="">Sélectionner</option>
                    <option>Produit endommagé</option>
                    <option>Retard livraison</option>
                    <option>Erreur facturation</option>
                    <option>Service client</option>
                    <option>Produit non conforme</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Département</label>
                <select class="form-control">
                    <option value="">Sélectionner</option>
                    <option>Logistique</option>
                    <option>Transport</option>
                    <option>Service Client</option>
                    <option>Comptabilité</option>
                    <option>Qualité</option>
                </select>
            </div>
            
            <div class="form-group full-width">
                <label class="form-label required">Description</label>
                <textarea class="form-control" rows="3" required placeholder="Décrire la réclamation..."></textarea>
            </div>
            
            <div class="form-actions">
                <button type="button" id="cancelReclam" class="btn" style="background: #e5e7eb; color: #374151;">
                    Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- ===== MODAL ANALYSE DÉTAILLÉE ===== -->
    <div id="modalAnalyseRecurrence" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Analyse détaillée des récurrences</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h4 class="font-semibold mb-2">Analyse par type de produit</h4>
                    <div class="space-y-2">
                        <div class="p-3 bg-red-50 rounded border border-red-200">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-medium">Smartphone X200</span>
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">12 récurrences</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <div class="flex items-center gap-1 mb-1">
                                    <i class="fas fa-building"></i>
                                    Département principal: <strong>Logistique</strong>
                                </div>
                                <div>
                                    Taux de récurrence: <strong>25%</strong> • Coût estimé: <strong>$12,500</strong>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-3 bg-orange-50 rounded border border-orange-200">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-medium">Tablet Pro 12</span>
                                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-sm">8 récurrences</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-truck"></i>
                                    Département principal: <strong>Transport</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h4 class="font-semibold mb-2">Départements les plus concernés</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-blue-50 rounded border border-blue-200 text-center">
                            <div class="font-bold text-blue-700">1. Logistique</div>
                            <div class="text-sm text-gray-600">18 incidents</div>
                        </div>
                        <div class="p-3 bg-green-50 rounded border border-green-200 text-center">
                            <div class="font-bold text-green-700">2. Transport</div>
                            <div class="text-sm text-gray-600">14 incidents</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="closeModalBtn" class="btn" style="background: #e5e7eb; color: #374151;">
                    Fermer
                </button>
                <button class="btn btn-primary">Exporter</button>
            </div>
        </div>
    </div>
</div>

<!-- ===== BOUTON FLOTTANT ===== -->
<button class="floating-btn" id="floatingNewBtn">
    <i class="fas fa-plus"></i>
</button>

<script>
// Données statiques pour les réclamations
const reclamations = [
    { id: 1, numero: '#REC-2025-001', client: 'Client A', date: '2025-12-15', canal: 'Email', categorie: 'damaged', produit: 'Smartphone X200', departement: 'Logistique', urgence: 'high', statut: 'resolved' },
    { id: 2, numero: '#REC-2025-002', client: 'Client B', date: '2025-12-14', canal: 'Téléphone', categorie: 'delayed', produit: 'Tablet Pro 12', departement: 'Transport', urgence: 'medium', statut: 'inprogress' },
    { id: 3, numero: '#REC-2025-003', client: 'Client C', date: '2025-12-13', canal: 'App mobile', categorie: 'billing', produit: 'Laptop Elite', departement: 'Comptabilité', urgence: 'low', statut: 'resolved' },
    { id: 4, numero: '#REC-2025-004', client: 'Client D', date: '2025-12-12', canal: 'Réseau social', categorie: 'service', produit: 'Support technique', departement: 'Service Client', urgence: 'critical', statut: 'new' },
    { id: 5, numero: '#REC-2025-005', client: 'Client E', date: '2025-12-11', canal: 'Email', categorie: 'damaged', produit: 'Smartphone X200', departement: 'Qualité', urgence: 'medium', statut: 'pending' }
];

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    initEventListeners();
    initFilters();
    updateTableCounter();
});

// Gestion des événements
function initEventListeners() {
    const form = document.getElementById('newReclamForm');
    const modal = document.getElementById('modalAnalyseRecurrence');
    
    // Bouton nouvelle réclamation
    document.getElementById('btnNewReclam').addEventListener('click', () => {
        form.classList.toggle('active');
        if (form.classList.contains('active')) {
            form.scrollIntoView({ behavior: 'smooth' });
        }
    });
    
    // Bouton flottant
    document.getElementById('floatingNewBtn').addEventListener('click', () => {
        form.classList.add('active');
        form.scrollIntoView({ behavior: 'smooth' });
    });
    
    // Annuler formulaire
    document.getElementById('cancelReclam').addEventListener('click', () => {
        form.classList.remove('active');
    });
    
    // Soumission formulaire
    document.getElementById('reclamForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showNotification('Réclamation enregistrée avec succès', 'success');
        this.reset();
        form.classList.remove('active');
    });
    
    // Bouton nouvelle action
    document.getElementById('btnNewAction').addEventListener('click', () => {
        showNotification('Créez une action depuis la réclamation concernée', 'info');
    });
    
    // Bouton analyse récurrence
    document.getElementById('btnAnalyseRecurrence').addEventListener('click', () => {
        modal.classList.add('active');
    });
    
    // Bouton export PDF
    document.getElementById('btnExportPDF').addEventListener('click', () => {
        showNotification('PDF en cours de génération...', 'info');
        setTimeout(() => showNotification('PDF exporté avec succès', 'success'), 1000);
    });
    
    // Bouton export analyse
    document.getElementById('btnExportAnalyse').addEventListener('click', () => {
        showNotification('Analyse exportée', 'success');
    });
    
    // Fermer modal
    document.querySelectorAll('.modal-close, #closeModalBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.remove('active');
        });
    });
    
    // Fermer modal en cliquant en dehors
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
        }
    });
    
    // Actions sur les lignes du tableau
    document.querySelectorAll('#reclamationsTable tr').forEach(row => {
        addRowEventListeners(row);
    });
    
    // Filtres
    document.getElementById('filterStatus').addEventListener('change', filterReclamations);
    document.getElementById('filterUrgence').addEventListener('change', filterReclamations);
    document.getElementById('filterCategorie').addEventListener('change', filterReclamations);
    document.getElementById('searchReclam').addEventListener('input', debounce(filterReclamations, 300));
}

// Initialiser les filtres
function initFilters() {
    // Remplir les options de filtres si nécessaire
}

// Filtrage des réclamations
function filterReclamations() {
    const statusFilter = document.getElementById('filterStatus').value;
    const urgenceFilter = document.getElementById('filterUrgence').value;
    const categorieFilter = document.getElementById('filterCategorie').value;
    const searchFilter = document.getElementById('searchReclam').value.toLowerCase();
    
    let visibleCount = 0;
    
    document.querySelectorAll('#reclamationsTable tr').forEach(row => {
        const status = row.getAttribute('data-status');
        const urgence = row.getAttribute('data-urgence');
        const categorie = row.getAttribute('data-categorie');
        const produit = row.getAttribute('data-produit') || '';
        const departement = row.getAttribute('data-departement') || '';
        const rowText = row.textContent.toLowerCase();
        
        let show = true;
        
        // Filtre par statut
        if (statusFilter && status !== statusFilter) {
            show = false;
        }
        
        // Filtre par urgence
        if (urgenceFilter && urgence !== urgenceFilter) {
            show = false;
        }
        
        // Filtre par catégorie
        if (categorieFilter && categorie !== categorieFilter) {
            show = false;
        }
        
        // Filtre par recherche
        if (searchFilter) {
            const searchIn = rowText + produit.toLowerCase() + departement.toLowerCase();
            if (!searchIn.includes(searchFilter)) {
                show = false;
            }
        }
        
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
    });
    
    updateTableCounter(visibleCount);
}

// Mettre à jour le compteur du tableau
function updateTableCounter(count) {
    const counter = document.getElementById('tableCounter');
    if (counter) {
        const total = count !== undefined ? count : 5;
        counter.textContent = `${total} réclamations`;
    }
}

// Ajouter les événements aux lignes du tableau
function addRowEventListeners(row) {
    // Bouton éditer
    row.querySelector('.edit-btn')?.addEventListener('click', function() {
        const id = row.querySelector('td:first-child .font-bold').textContent;
        showNotification(`Édition de ${id}`, 'info');
    });
    
    // Bouton voir
    row.querySelector('.view-btn')?.addEventListener('click', function() {
        const produit = row.getAttribute('data-produit');
        showNotification(`Détails de ${produit}`, 'info');
    });
    
    // Bouton supprimer
    row.querySelector('.delete-btn')?.addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?')) {
            row.remove();
            showNotification('Réclamation supprimée', 'success');
            updateTableCounter();
        }
    });
    
    // Bouton clôturer
    row.querySelector('.close-btn')?.addEventListener('click', function() {
        const statusCell = row.querySelector('td:nth-child(5)');
        statusCell.innerHTML = '<span class="badge status-resolved">Résolu</span>';
        row.setAttribute('data-status', 'resolved');
        showNotification('Réclamation clôturée', 'success');
    });
    
    // Bouton assigner
    row.querySelector('.assign-btn')?.addEventListener('click', function() {
        showNotification('Réclamation assignée', 'info');
    });
    
    // Bouton escalader
    row.querySelector('.escalate-btn')?.addEventListener('click', function() {
        showNotification('Réclamation escaladée au responsable', 'warning');
    });
}

// Fonction debounce pour les filtres
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Afficher une notification
function showNotification(message, type) {
    // Supprimer les notifications existantes
    document.querySelectorAll('.notification').forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Adapter l'interface pour mobile
function adaptForMobile() {
    if (window.innerWidth < 640) {
        // Actions spécifiques pour mobile
    }
}

// Initialiser l'adaptation mobile
window.addEventListener('resize', adaptForMobile);
adaptForMobile();
</script>
@endsection