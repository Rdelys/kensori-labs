@extends('layouts.clients')

@section('title', 'Opérations - Non conformités production')

@section('content')
<div class="nc-container">
    <!-- En-tête avec indicateurs KPI -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-content">
                <div>
                    <div class="kpi-label">NC Ouvertes</div>
                    <div class="kpi-value">12</div>
                </div>
                <div class="kpi-icon nc-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <div class="kpi-trend positive">
                <i class="fas fa-arrow-down"></i>8% vs mois dernier
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-content">
                <div>
                    <div class="kpi-label">Taux NC Global</div>
                    <div class="kpi-value">2.3%</div>
                </div>
                <div class="kpi-icon rate-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="kpi-trend negative">
                <i class="fas fa-arrow-up"></i>0.5% vs cible
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-content">
                <div>
                    <div class="kpi-label">NC Résolues (7j)</div>
                    <div class="kpi-value">24</div>
                </div>
                <div class="kpi-icon resolved-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="kpi-trend positive">
                <i class="fas fa-arrow-up"></i>15% vs semaine dernière
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-content">
                <div>
                    <div class="kpi-label">Coût estimé NC</div>
                    <div class="kpi-value">€8,420</div>
                </div>
                <div class="kpi-icon cost-icon">
                    <i class="fas fa-euro-sign"></i>
                </div>
            </div>
            <div class="kpi-trend positive">
                <i class="fas fa-arrow-down"></i>€2,150 vs mois dernier
            </div>
        </div>
    </div>

    <!-- Section des graphiques -->
    <div class="charts-grid">
        <!-- Graphique 1: Tendances mensuelles -->
        <div class="chart-card">
            <div class="chart-header">
                <h3>Tendances mensuelles des NC</h3>
                <div class="chart-dropdown">
                    <button class="dropdown-btn">2024</button>
                </div>
            </div>
            <div class="chart-body">
                <canvas id="monthlyTrendsChart"></canvas>
            </div>
            <div class="chart-footer">
                <span class="chart-note">Objectif annuel : < 1.5% taux NC</span>
            </div>
        </div>

        <!-- Graphique 2: Répartition par type -->
        <div class="chart-card">
            <div class="chart-header">
                <h3>Répartition par type de défaut</h3>
            </div>
            <div class="chart-body">
                <canvas id="defectTypeChart"></canvas>
            </div>
            <div class="chart-footer">
                <div class="chart-footer-content">
                    <span class="chart-note">Total : 145 défauts cette année</span>
                    <button class="detail-btn" id="detailModalBtn">
                        <i class="fas fa-chart-pie"></i>Voir détail
                    </button>
                </div>
            </div>
        </div>

        <!-- Graphique 3: Taux de non-conformité par ligne -->
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title-group">
                    <h3>Taux de NC par ligne de production</h3>
                    <span class="chart-badge">Mois en cours</span>
                </div>
            </div>
            <div class="chart-body">
                <canvas id="linePerformanceChart"></canvas>
            </div>
            <div class="chart-footer">
                <div class="legend">
                    <span class="legend-item green">< 1%</span>
                    <span class="legend-item yellow">1-3%</span>
                    <span class="legend-item red">> 3%</span>
                </div>
                <span class="chart-note">Cible : < 1.5%</span>
            </div>
        </div>
    </div>

    <!-- Section principale: Liste des non-conformités -->
    <div class="main-card">
        <div class="card-header">
            <div class="header-content">
                <div class="header-title">
                    <h2>Liste des non-conformités</h2>
                    <p class="result-count" id="resultCount">Affichage de 12 non-conformités</p>
                </div>
                <div class="header-controls">
                    <div class="filter-grid">
                        <select class="filter-select" id="filterStatus">
                            <option value="">Tous statuts</option>
                            <option value="ouvert">Ouvert</option>
                            <option value="en_analyse">En analyse</option>
                            <option value="en_correction">En correction</option>
                            <option value="ferme">Fermé</option>
                        </select>
                        <select class="filter-select" id="filterLine">
                            <option value="">Toutes lignes</option>
                            <option value="L1">Ligne 1</option>
                            <option value="L2">Ligne 2</option>
                            <option value="L3">Ligne 3</option>
                            <option value="L4">Ligne 4</option>
                            <option value="L5">Ligne 5</option>
                        </select>
                        <div class="search-group">
                            <input type="text" class="search-input" id="searchInput" placeholder="Rechercher...">
                            <button class="search-clear" id="clearSearch">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="nc-table" id="ncTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Ligne/Poste</th>
                            <th>Référence</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Priorité</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ncTableBody">
                        <!-- Les données seront insérées ici par JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="footer-content">
                <div class="showing-text" id="showingText"></div>
                <nav class="pagination-container">
                    <ul class="pagination" id="pagination">
                        <!-- La pagination sera générée par JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Bouton d'action flottant -->
    <button class="floating-btn" id="newNCBtn">
        <i class="fas fa-plus"></i>
    </button>
</div>

<!-- Modal: Nouvelle non-conformité -->
<div class="modal" id="newNonConformityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Déclarer une nouvelle non-conformité</h3>
                <button type="button" class="modal-close" id="closeModal">&times;</button>
            </div>
            <form id="newNonConformityForm">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Ligne de production *</label>
                            <select class="form-control" required name="production_line">
                                <option value="">Sélectionner</option>
                                <option value="L1">Ligne 1</option>
                                <option value="L2">Ligne 2</option>
                                <option value="L3">Ligne 3</option>
                                <option value="L4">Ligne 4</option>
                                <option value="L5">Ligne 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Poste de travail</label>
                            <input type="text" class="form-control" name="workstation" placeholder="Ex: Poste de soudure">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Référence produit *</label>
                            <input type="text" class="form-control" required name="product_ref" placeholder="Ex: PROD-4521">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Numéro de lot/série *</label>
                            <input type="text" class="form-control" required name="batch_number" placeholder="Ex: LOT-2024-001">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Type de défaut *</label>
                        <select class="form-control" required name="defect_type">
                            <option value="">Sélectionner</option>
                            <option value="dimensionnel">Dimensionnel</option>
                            <option value="aspect">Aspect/Finition</option>
                            <option value="fonctionnel">Fonctionnel</option>
                            <option value="materiau">Matériau</option>
                            <option value="contamination">Contamination</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Description détaillée *</label>
                        <textarea class="form-control" rows="3" required name="description" 
                                  placeholder="Décrire précisément la non-conformité observée, les circonstances de détection..."></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Quantité affectée</label>
                            <input type="number" class="form-control" name="quantity" min="1" value="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Priorité</label>
                            <select class="form-control" name="priority">
                                <option value="basse">Basse</option>
                                <option value="moyenne" selected>Moyenne</option>
                                <option value="haute">Haute</option>
                                <option value="critique">Critique</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Détecté par *</label>
                            <input type="text" class="form-control" required name="detected_by" placeholder="Ex: Jean Dupont">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pièces jointes</label>
                        <input type="file" class="form-control" multiple accept="image/*,.pdf,.doc,.docx">
                        <div class="form-help">Formats acceptés: JPG, PNG, PDF, DOC (max. 5Mo)</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" id="cancelBtn">Annuler</button>
                    <button type="submit" class="btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Détails d'une NC -->
<div class="modal" id="detailModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Détails de la non-conformité</h3>
                <button type="button" class="modal-close" id="closeDetailModal">&times;</button>
            </div>
            <div class="modal-body" id="detailModalContent">
                <!-- Contenu chargé dynamiquement -->
            </div>
        </div>
    </div>
</div>

<style>
/* Variables CSS */
:root {
    --primary-color: #3498db;
    --secondary-color: #6c757d;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --border-color: #dee2e6;
    --shadow: 0 2px 4px rgba(0,0,0,0.1);
    --shadow-hover: 0 4px 8px rgba(0,0,0,0.15);
    --border-radius: 8px;
    --transition: all 0.3s ease;
}

/* Conteneur principal */
.nc-container {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

/* KPI Cards */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.kpi-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 20px;
    box-shadow: var(--shadow);
    border-left: 4px solid var(--primary-color);
    transition: var(--transition);
}

.kpi-card:nth-child(1) { border-left-color: var(--primary-color); }
.kpi-card:nth-child(2) { border-left-color: var(--warning-color); }
.kpi-card:nth-child(3) { border-left-color: var(--success-color); }
.kpi-card:nth-child(4) { border-left-color: var(--info-color); }

.kpi-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.kpi-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.kpi-label {
    font-size: 0.9rem;
    color: var(--secondary-color);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.kpi-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--dark-color);
    margin: 5px 0;
}

.kpi-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.nc-icon { background: rgba(52, 152, 219, 0.1); color: var(--primary-color); }
.rate-icon { background: rgba(255, 193, 7, 0.1); color: var(--warning-color); }
.resolved-icon { background: rgba(40, 167, 69, 0.1); color: var(--success-color); }
.cost-icon { background: rgba(23, 162, 184, 0.1); color: var(--info-color); }

.kpi-trend {
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.kpi-trend.positive { color: var(--success-color); }
.kpi-trend.negative { color: var(--danger-color); }

/* Graphiques */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.chart-header {
    padding: 20px 20px 10px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chart-header h3 {
    margin: 0;
    font-size: 1.1rem;
    color: var(--dark-color);
}

.chart-title-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.chart-badge {
    background: var(--light-color);
    color: var(--secondary-color);
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
}

.chart-body {
    padding: 20px;
    height: 250px;
}

.chart-footer {
    padding: 15px 20px;
    border-top: 1px solid var(--border-color);
    background: var(--light-color);
}

.chart-footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chart-note {
    font-size: 0.85rem;
    color: var(--secondary-color);
}

.detail-btn {
    background: transparent;
    border: 1px solid var(--primary-color);
    color: var(--primary-color);
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 0.85rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: var(--transition);
}

.detail-btn:hover {
    background: var(--primary-color);
    color: white;
}

.legend {
    display: flex;
    gap: 10px;
    margin-bottom: 5px;
}

.legend-item {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
}

.legend-item.green { background: #d4edda; color: #155724; }
.legend-item.yellow { background: #fff3cd; color: #856404; }
.legend-item.red { background: #f8d7da; color: #721c24; }

/* Tableau principal */
.main-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.card-header {
    padding: 20px;
    border-bottom: 1px solid var(--border-color);
}

.header-content {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

@media (min-width: 768px) {
    .header-content {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}

.header-title h2 {
    margin: 0 0 5px 0;
    font-size: 1.3rem;
    color: var(--dark-color);
}

.result-count {
    margin: 0;
    font-size: 0.9rem;
    color: var(--secondary-color);
}

.filter-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
}

@media (min-width: 768px) {
    .filter-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.filter-select {
    padding: 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    background: white;
    font-size: 0.9rem;
    color: var(--dark-color);
    cursor: pointer;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary-color);
}

.search-group {
    position: relative;
    display: flex;
}

.search-input {
    flex: 1;
    padding: 8px 35px 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    font-size: 0.9rem;
}

.search-clear {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    background: transparent;
    border: none;
    color: var(--secondary-color);
    padding: 0 10px;
    cursor: pointer;
}

.search-clear:hover {
    color: var(--danger-color);
}

.table-container {
    overflow-x: auto;
}

.nc-table {
    width: 100%;
    border-collapse: collapse;
}

.nc-table thead {
    background: var(--light-color);
}

.nc-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: var(--dark-color);
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    border-bottom: 2px solid var(--border-color);
}

.nc-table td {
    padding: 15px;
    border-bottom: 1px solid var(--border-color);
    vertical-align: top;
}

.nc-table tbody tr {
    transition: var(--transition);
}

.nc-table tbody tr:hover {
    background: rgba(52, 152, 219, 0.05);
}

.nc-table tbody tr.priority-high {
    background: rgba(255, 193, 7, 0.1);
}

.nc-table tbody tr.priority-critical {
    background: rgba(220, 53, 69, 0.1);
    font-weight: 600;
}

.badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-secondary { background: var(--secondary-color); color: white; }
.badge-info { background: var(--info-color); color: white; }
.badge-warning { background: var(--warning-color); color: var(--dark-color); }
.badge-success { background: var(--success-color); color: white; }
.badge-danger { background: var(--danger-color); color: white; }
.badge-primary { background: var(--primary-color); color: white; }
.badge-light { background: var(--light-color); color: var(--dark-color); border: 1px solid var(--border-color); }

.action-buttons {
    display: flex;
    gap: 5px;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border-radius: 4px;
    border: 1px solid var(--border-color);
    background: white;
    color: var(--secondary-color);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.btn-icon:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.btn-icon.danger:hover {
    border-color: var(--danger-color);
    color: var(--danger-color);
}

/* Pagination */
.card-footer {
    padding: 20px;
    border-top: 1px solid var(--border-color);
}

.footer-content {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

@media (min-width: 768px) {
    .footer-content {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}

.showing-text {
    font-size: 0.9rem;
    color: var(--secondary-color);
}

.pagination-container {
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 5px;
}

.pagination li {
    margin: 0;
}

.pagination a {
    display: block;
    padding: 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    color: var(--dark-color);
    text-decoration: none;
    font-size: 0.9rem;
    transition: var(--transition);
}

.pagination a:hover {
    background: var(--light-color);
    border-color: var(--primary-color);
}

.pagination li.active a {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.pagination li.disabled a {
    color: var(--secondary-color);
    pointer-events: none;
    opacity: 0.6;
}

/* Bouton flottant */
.floating-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    z-index: 1000;
    transition: var(--transition);
}

.floating-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(52, 152, 219, 0.4);
}

/* Modals */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 2000;
    align-items: center;
    justify-content: center;
}

.modal.active {
    display: flex;
}

.modal-dialog {
    background: white;
    border-radius: var(--border-radius);
    width: 90%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-lg {
    max-width: 1000px;
}

.modal-header {
    padding: 20px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 1.3rem;
    color: var(--dark-color);
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--secondary-color);
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: var(--danger-color);
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    padding: 20px;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

/* Formulaires */
.form-row {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
    margin-bottom: 15px;
}

@media (min-width: 768px) {
    .form-row {
        grid-template-columns: repeat(2, 1fr);
    }
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: var(--dark-color);
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    font-size: 0.9rem;
    transition: var(--transition);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.form-help {
    font-size: 0.85rem;
    color: var(--secondary-color);
    margin-top: 5px;
}

/* Boutons */
.btn-primary {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.btn-primary:hover {
    background: #2980b9;
}

.btn-secondary {
    background: var(--secondary-color);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.btn-secondary:hover {
    background: #5a6268;
}

/* Responsive */
@media (max-width: 768px) {
    .nc-container {
        padding: 10px;
    }
    
    .kpi-grid {
        grid-template-columns: 1fr;
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-body {
        height: 200px;
    }
    
    .nc-table th,
    .nc-table td {
        padding: 10px;
        font-size: 0.85rem;
    }
    
    .floating-btn {
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}

@media (max-width: 480px) {
    .modal-dialog {
        width: 95%;
        margin: 10px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .header-title h2 {
        font-size: 1.1rem;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Données statiques complètes
const ncData = [
    {
        id: "NC-2024-001",
        date: "2024-01-15",
        line: "L2",
        workstation: "Poste soudure",
        reference: "PROD-4521",
        batch: "LOT-2024-001",
        description: "Défaut dimensionnel sur pièce n°12 - tolérance dépassée de 0.5mm",
        defectType: "dimensionnel",
        priority: "haute",
        status: "en_analyse",
        quantity: 15,
        detectedBy: "Jean Dupont",
        cost: 420,
        actions: ["Lien avec Amélioration #45"]
    },
    {
        id: "NC-2024-002",
        date: "2024-01-16",
        line: "L1",
        workstation: "Poste contrôle final",
        reference: "PROD-1234",
        batch: "LOT-2024-002",
        description: "Rayure profonde sur face visible produit fini",
        defectType: "aspect",
        priority: "moyenne",
        status: "ouvert",
        quantity: 3,
        detectedBy: "Marie Lambert",
        cost: 150,
        actions: ["En attente analyse"]
    },
    {
        id: "NC-2024-003",
        date: "2024-01-17",
        line: "L3",
        workstation: "Poste assemblage",
        reference: "PROD-7890",
        batch: "LOT-2024-003",
        description: "Fonctionnement intermittent du module électronique",
        defectType: "fonctionnel",
        priority: "critique",
        status: "en_correction",
        quantity: 8,
        detectedBy: "Pierre Martin",
        cost: 1250,
        actions: ["Correction en cours"]
    },
    {
        id: "NC-2024-004",
        date: "2024-01-18",
        line: "L2",
        workstation: "Poste peinture",
        reference: "PROD-4521",
        batch: "LOT-2024-004",
        description: "Adhérence peinture insuffisante - test cross-cut échoué",
        defectType: "aspect",
        priority: "haute",
        status: "en_analyse",
        quantity: 25,
        detectedBy: "Sophie Bernard",
        cost: 680,
        actions: ["Analyse labo en cours"]
    },
    {
        id: "NC-2024-005",
        date: "2024-01-19",
        line: "L4",
        workstation: "Poste moulage",
        reference: "PROD-5678",
        batch: "LOT-2024-005",
        description: "Porosité excessive dans pièce moulée",
        defectType: "materiau",
        priority: "moyenne",
        status: "ferme",
        quantity: 12,
        detectedBy: "Thomas Leroy",
        cost: 320,
        actions: ["Résolu - changement paramètres"]
    },
    {
        id: "NC-2024-006",
        date: "2024-01-20",
        line: "L5",
        workstation: "Poste nettoyage",
        reference: "PROD-9012",
        batch: "LOT-2024-006",
        description: "Particules métalliques détectées en contrôle contamination",
        defectType: "contamination",
        priority: "critique",
        status: "en_correction",
        quantity: 45,
        detectedBy: "Nicolas Petit",
        cost: 2100,
        actions: ["Quarantaine produits"]
    },
    {
        id: "NC-2024-007",
        date: "2024-01-21",
        line: "L1",
        workstation: "Poste perçage",
        reference: "PROD-3456",
        batch: "LOT-2024-007",
        description: "Diamètre alésage hors tolérance (+0.1mm)",
        defectType: "dimensionnel",
        priority: "moyenne",
        status: "ouvert",
        quantity: 18,
        detectedBy: "Laura Dubois",
        cost: 450,
        actions: ["En attente décision"]
    },
    {
        id: "NC-2024-008",
        date: "2024-01-22",
        line: "L3",
        workstation: "Poste test",
        reference: "PROD-7891",
        batch: "LOT-2024-008",
        description: "Défaillance test pression à 80% pression nominale",
        defectType: "fonctionnel",
        priority: "haute",
        status: "en_analyse",
        quantity: 6,
        detectedBy: "Marc Moreau",
        cost: 890,
        actions: ["Investigation fournisseur joint"]
    },
    {
        id: "NC-2024-009",
        date: "2024-01-23",
        line: "L2",
        workstation: "Poste soudure",
        reference: "PROD-4522",
        batch: "LOT-2024-009",
        description: "Soudure poreuse - défaut de pénétration",
        defectType: "aspect",
        priority: "moyenne",
        status: "ferme",
        quantity: 9,
        detectedBy: "Eric Lefevre",
        cost: 270,
        actions: ["Formation opérateur réalisée"]
    },
    {
        id: "NC-2024-010",
        date: "2024-01-24",
        line: "L4",
        workstation: "Poste finition",
        reference: "PROD-5679",
        batch: "LOT-2024-010",
        description: "Éclat sur arête de coupe",
        defectType: "aspect",
        priority: "basse",
        status: "ouvert",
        quantity: 7,
        detectedBy: "Claire Rousseau",
        cost: 85,
        actions: ["Accepté avec dérogation"]
    },
    {
        id: "NC-2024-011",
        date: "2024-01-25",
        line: "L5",
        workstation: "Poste assemblage",
        reference: "PROD-9013",
        batch: "LOT-2024-011",
        description: "Vis de fixation manquante sur assemblage final",
        defectType: "autre",
        priority: "moyenne",
        status: "en_correction",
        quantity: 22,
        detectedBy: "David Blanc",
        cost: 330,
        actions: ["Retouche en cours"]
    },
    {
        id: "NC-2024-012",
        date: "2024-01-26",
        line: "L1",
        workstation: "Poste contrôle",
        reference: "PROD-3457",
        batch: "LOT-2024-012",
        description: "Déformation plastique après test de durée de vie",
        defectType: "materiau",
        priority: "haute",
        status: "en_analyse",
        quantity: 5,
        detectedBy: "Isabelle Martin",
        cost: 750,
        actions: ["Analyse métallurgique demandée"]
    }
];

// Configuration de pagination
let currentPage = 1;
const itemsPerPage = 5;
let filteredData = [...ncData];

// Initialisation des graphiques
function initCharts() {
    // Graphique 1: Tendances mensuelles
    const ctx1 = document.getElementById('monthlyTrendsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Non-conformités',
                data: [12, 15, 10, 8, 14, 18, 22, 16, 12, 10, 8, 6],
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }, {
                label: 'Objectif',
                data: [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10],
                borderColor: '#6c757d',
                borderWidth: 1,
                borderDash: [5, 5],
                tension: 0,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de NC'
                    }
                }
            }
        }
    });

    // Graphique 2: Répartition par type
    const ctx2 = document.getElementById('defectTypeChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Dimensionnel', 'Aspect', 'Fonctionnel', 'Matériau', 'Contamination', 'Autre'],
            datasets: [{
                data: [35, 28, 20, 12, 8, 7],
                backgroundColor: [
                    '#dc3545',
                    '#fd7e14',
                    '#ffc107',
                    '#20c997',
                    '#6f42c1',
                    '#6c757d'
                ],
                borderWidth: 1,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((context.parsed / total) * 100);
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Graphique 3: Performance par ligne
    const ctx3 = document.getElementById('linePerformanceChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Ligne 1', 'Ligne 2', 'Ligne 3', 'Ligne 4', 'Ligne 5'],
            datasets: [{
                label: 'Taux de NC (%)',
                data: [0.8, 2.5, 1.2, 3.8, 0.5],
                backgroundColor: function(context) {
                    const value = context.dataset.data[context.dataIndex];
                    if (value < 1) return '#20c997';
                    if (value <= 3) return '#ffc107';
                    return '#dc3545';
                },
                borderColor: function(context) {
                    const value = context.dataset.data[context.dataIndex];
                    if (value < 1) return '#198754';
                    if (value <= 3) return '#ffc107';
                    return '#dc3545';
                },
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    title: {
                        display: true,
                        text: 'Taux de NC (%)'
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Taux: ${context.parsed.y}%`;
                        }
                    }
                }
            }
        }
    });
}

// Fonction pour formater la date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

// Fonction pour obtenir la classe CSS du badge de statut
function getStatusBadgeClass(status) {
    const classes = {
        'ouvert': 'badge-secondary',
        'en_analyse': 'badge-info',
        'en_correction': 'badge-warning',
        'ferme': 'badge-success'
    };
    return classes[status] || 'badge-secondary';
}

// Fonction pour obtenir la classe CSS de priorité
function getPriorityClass(priority) {
    const classes = {
        'basse': '',
        'moyenne': '',
        'haute': 'priority-high',
        'critique': 'priority-critical'
    };
    return classes[priority] || '';
}

// Fonction pour obtenir la classe CSS du badge de priorité
function getPriorityBadgeClass(priority) {
    const classes = {
        'basse': 'badge-secondary',
        'moyenne': 'badge-primary',
        'haute': 'badge-warning',
        'critique': 'badge-danger'
    };
    return classes[priority] || 'badge-secondary';
}

// Fonction pour afficher les données dans le tableau
function renderTable() {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentData = filteredData.slice(startIndex, endIndex);
    
    const tbody = document.getElementById('ncTableBody');
    tbody.innerHTML = '';
    
    currentData.forEach(nc => {
        const row = document.createElement('tr');
        row.className = getPriorityClass(nc.priority);
        
        row.innerHTML = `
            <td class="nc-id">${nc.id}</td>
            <td>${formatDate(nc.date)}</td>
            <td>
                <div class="line-info">${nc.line}</div>
                <div class="workstation-info">${nc.workstation}</div>
            </td>
            <td>
                <div>${nc.reference}</div>
                <div class="batch-info">${nc.batch}</div>
            </td>
            <td class="description">${nc.description}</td>
            <td>
                <span class="badge badge-light">${nc.defectType}</span>
            </td>
            <td>
                <span class="badge ${getPriorityBadgeClass(nc.priority)}">
                    ${nc.priority}
                </span>
            </td>
            <td>
                <span class="badge ${getStatusBadgeClass(nc.status)}">
                    ${nc.status.replace('_', ' ')}
                </span>
            </td>
            <td>
                <div class="action-buttons">
                    <button class="btn-icon view-detail" data-id="${nc.id}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn-icon">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-icon danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </button>
                </div>
            </td>
        `;
        
        tbody.appendChild(row);
    });
    
    // Mettre à jour les compteurs
    document.getElementById('resultCount').textContent = 
        `Affichage de ${filteredData.length} non-conformité${filteredData.length > 1 ? 's' : ''}`;
    
    updatePagination();
    attachDetailEvents();
}

// Fonction pour mettre à jour la pagination
function updatePagination() {
    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';
    
    if (totalPages <= 1) return;
    
    // Bouton précédent
    const prevLi = document.createElement('li');
    prevLi.className = currentPage === 1 ? 'disabled' : '';
    prevLi.innerHTML = `<a href="#" data-page="${currentPage - 1}">Précédent</a>`;
    pagination.appendChild(prevLi);
    
    // Pages numérotées
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = currentPage === i ? 'active' : '';
        li.innerHTML = `<a href="#" data-page="${i}">${i}</a>`;
        pagination.appendChild(li);
    }
    
    // Bouton suivant
    const nextLi = document.createElement('li');
    nextLi.className = currentPage === totalPages ? 'disabled' : '';
    nextLi.innerHTML = `<a href="#" data-page="${currentPage + 1}">Suivant</a>`;
    pagination.appendChild(nextLi);
    
    // Mettre à jour le texte d'affichage
    const start = ((currentPage - 1) * itemsPerPage) + 1;
    const end = Math.min(currentPage * itemsPerPage, filteredData.length);
    document.getElementById('showingText').textContent = 
        `Affichage ${start} à ${end} sur ${filteredData.length}`;
    
    // Attacher les événements de pagination
    attachPaginationEvents();
}

// Fonction pour filtrer les données
function filterData() {
    const statusFilter = document.getElementById('filterStatus').value;
    const lineFilter = document.getElementById('filterLine').value;
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    filteredData = ncData.filter(nc => {
        // Filtre par statut
        if (statusFilter && nc.status !== statusFilter) return false;
        
        // Filtre par ligne
        if (lineFilter && nc.line !== lineFilter) return false;
        
        // Filtre par recherche
        if (searchTerm) {
            const searchFields = [
                nc.id,
                nc.reference,
                nc.batch,
                nc.description,
                nc.defectType,
                nc.detectedBy,
                nc.workstation
            ];
            return searchFields.some(field => 
                field.toLowerCase().includes(searchTerm)
            );
        }
        
        return true;
    });
    
    currentPage = 1;
    renderTable();
}

// Fonction pour afficher les détails d'une NC
function showDetail(id) {
    const nc = ncData.find(item => item.id === id);
    if (!nc) return;
    
    const content = document.getElementById('detailModalContent');
    content.innerHTML = `
        <div class="detail-grid">
            <div class="detail-column">
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4>Informations générales</h4>
                    </div>
                    <div class="detail-card-body">
                        <div class="detail-row">
                            <div class="detail-field">
                                <label>Identifiant</label>
                                <div class="detail-value">${nc.id}</div>
                            </div>
                            <div class="detail-field">
                                <label>Date de détection</label>
                                <div class="detail-value">${formatDate(nc.date)}</div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-field">
                                <label>Ligne/Poste</label>
                                <div class="detail-value">${nc.line} - ${nc.workstation}</div>
                            </div>
                            <div class="detail-field">
                                <label>Détecté par</label>
                                <div class="detail-value">${nc.detectedBy}</div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-field">
                                <label>Référence produit</label>
                                <div class="detail-value">${nc.reference}</div>
                            </div>
                            <div class="detail-field">
                                <label>Numéro de lot</label>
                                <div class="detail-value">${nc.batch}</div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-field">
                                <label>Type de défaut</label>
                                <div><span class="badge badge-light">${nc.defectType}</span></div>
                            </div>
                            <div class="detail-field">
                                <label>Quantité affectée</label>
                                <div class="detail-value">${nc.quantity} unités</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4>Description détaillée</h4>
                    </div>
                    <div class="detail-card-body">
                        <p>${nc.description}</p>
                        <div class="detail-actions">
                            <h5>Actions associées :</h5>
                            <ul>
                                ${nc.actions.map(action => `<li><i class="fas fa-arrow-right"></i>${action}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="detail-sidebar">
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4>Statut et priorité</h4>
                    </div>
                    <div class="detail-card-body">
                        <div class="status-group">
                            <div class="detail-field">
                                <label>Statut</label>
                                <div>
                                    <span class="badge ${getStatusBadgeClass(nc.status)}">
                                        ${nc.status.replace('_', ' ').toUpperCase()}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-field">
                                <label>Priorité</label>
                                <div>
                                    <span class="badge ${getPriorityBadgeClass(nc.priority)}">
                                        ${nc.priority.toUpperCase()}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-field">
                                <label>Coût estimé</label>
                                <div class="cost-value">€${nc.cost}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4>Actions rapides</h4>
                    </div>
                    <div class="detail-card-body">
                        <div class="action-grid">
                            <button class="action-btn warning">
                                <i class="fas fa-edit"></i>Modifier le statut
                            </button>
                            <button class="action-btn info">
                                <i class="fas fa-comment"></i>Ajouter un commentaire
                            </button>
                            <button class="action-btn danger">
                                <i class="fas fa-exclamation-triangle"></i>Ouvrir une amélioration
                            </button>
                            <button class="action-btn secondary">
                                <i class="fas fa-print"></i>Imprimer la fiche
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Ajouter du style supplémentaire pour le modal de détail
    const style = document.createElement('style');
    style.textContent = `
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        @media (min-width: 992px) {
            .detail-grid {
                grid-template-columns: 2fr 1fr;
            }
        }
        
        .detail-card {
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .detail-card-header {
            background: #e9ecef;
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .detail-card-header h4 {
            margin: 0;
            font-size: 1.1rem;
            color: #343a40;
        }
        
        .detail-card-body {
            padding: 20px;
        }
        
        .detail-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        @media (min-width: 768px) {
            .detail-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .detail-field label {
            display: block;
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-weight: 600;
            color: #343a40;
        }
        
        .cost-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #dc3545;
        }
        
        .detail-actions h5 {
            font-size: 1rem;
            color: #6c757d;
            margin: 15px 0 10px 0;
        }
        
        .detail-actions ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .detail-actions li {
            padding: 5px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-actions li i {
            color: #3498db;
        }
        
        .status-group .detail-field {
            margin-bottom: 15px;
        }
        
        .action-grid {
            display: grid;
            gap: 10px;
        }
        
        .action-btn {
            padding: 10px;
            border-radius: 4px;
            border: none;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .action-btn.warning {
            background: #ffc107;
            color: #343a40;
        }
        
        .action-btn.info {
            background: #17a2b8;
            color: white;
        }
        
        .action-btn.danger {
            background: #dc3545;
            color: white;
        }
        
        .action-btn.secondary {
            background: #6c757d;
            color: white;
        }
        
        .action-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
    `;
    content.appendChild(style);
    
    document.getElementById('detailModal').classList.add('active');
}

// Gestion des modals
function setupModals() {
    const newModal = document.getElementById('newNonConformityModal');
    const detailModal = document.getElementById('detailModal');
    const newBtn = document.getElementById('newNCBtn');
    const closeButtons = document.querySelectorAll('.modal-close');
    const cancelBtn = document.getElementById('cancelBtn');
    const detailModalBtn = document.getElementById('detailModalBtn');
    
    // Ouvrir modal nouvelle NC
    newBtn.addEventListener('click', () => {
        newModal.classList.add('active');
    });
    
    // Ouvrir modal détail (bouton du graphique)
    detailModalBtn.addEventListener('click', () => {
        // Afficher des données de détail par défaut
        showDetail('NC-2024-001');
    });
    
    // Fermer les modals
    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            newModal.classList.remove('active');
            detailModal.classList.remove('active');
        });
    });
    
    cancelBtn.addEventListener('click', () => {
        newModal.classList.remove('active');
    });
    
    // Fermer en cliquant en dehors
    [newModal, detailModal].forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    });
}

// Attacher les événements
function attachPaginationEvents() {
    document.querySelectorAll('#pagination a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = parseInt(this.getAttribute('data-page'));
            if (page && page !== currentPage) {
                currentPage = page;
                renderTable();
            }
        });
    });
}

function attachDetailEvents() {
    document.querySelectorAll('.view-detail').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            showDetail(id);
        });
    });
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les graphiques
    initCharts();
    
    // Rendre le tableau initial
    renderTable();
    
    // Configurer les modals
    setupModals();
    
    // Attacher les événements de filtre
    document.getElementById('filterStatus').addEventListener('change', filterData);
    document.getElementById('filterLine').addEventListener('change', filterData);
    document.getElementById('searchInput').addEventListener('input', filterData);
    
    // Effacer la recherche
    document.getElementById('clearSearch').addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        filterData();
    });
    
    // Gestion du formulaire de nouvelle NC
    document.getElementById('newNonConformityForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Simulation d'enregistrement
        alert('Non-conformité enregistrée avec succès!');
        document.getElementById('newNonConformityModal').classList.remove('active');
        this.reset();
    });
});
</script>
@endsection
