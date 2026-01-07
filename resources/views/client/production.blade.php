@extends('layouts.clients')

@section('title', 'Opérations - Suivi de Production')

@section('content')
<div class="production-container">
    <!-- En-tête -->
    <div class="page-header">
        <div class="header-main">
            <h1 class="page-title">Suivi de Production</h1>
            <p class="page-subtitle">Saisie des données, traçabilité et KPIs de production</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary btn-sm" id="newProductionBtn">
                <i class="fas fa-plus"></i> Nouvelle saisie
            </button>
            <button class="btn btn-outline-secondary btn-sm" id="importBtn">
                <i class="fas fa-upload"></i>
            </button>
        </div>
    </div>

    <!-- KPIs rapides -->
    <div class="kpi-cards">
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-bullseye"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="ftyValue">94.2%</div>
                <div class="kpi-label">FTY</div>
                <div class="kpi-trend trend-up">
                    <i class="fas fa-arrow-up"></i> +1.2%
                </div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-trash"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="scrapValue">1.8%</div>
                <div class="kpi-label">Taux rebut</div>
                <div class="kpi-trend trend-down">
                    <i class="fas fa-arrow-down"></i> -0.3%
                </div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-industry"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="outputValue">2,450</div>
                <div class="kpi-label">Production/jour</div>
                <div class="kpi-trend trend-up">
                    <i class="fas fa-arrow-up"></i> +5.2%
                </div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="oeeValue">78.5%</div>
                <div class="kpi-label">OEE</div>
                <div class="kpi-trend trend-warning">
                    <i class="fas fa-minus"></i> -2.1%
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="filters-section">
        <div class="filter-row">
            <div class="filter-group">
                <select id="lineFilter" class="filter-select">
                    <option value="all">Toutes lignes</option>
                    <option value="line_a">Ligne A</option>
                    <option value="line_b">Ligne B</option>
                    <option value="line_c">Ligne C</option>
                </select>
                
                <select id="shiftFilter" class="filter-select">
                    <option value="all">Tous postes</option>
                    <option value="morning">Matins</option>
                    <option value="afternoon">Après-midi</option>
                    <option value="night">Nuit</option>
                </select>
                
                <input type="date" id="dateFilter" class="filter-select" value="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="view-options">
                <button class="view-btn active" data-view="table">
                    <i class="fas fa-table"></i>
                </button>
                <button class="view-btn" data-view="gantt">
                    <i class="fas fa-chart-gantt"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <!-- Tableau de production -->
        <div class="production-table-section active-view" id="tableView">
            <div class="table-header">
                <h3>Production du jour</h3>
                <div class="table-actions">
                    <button class="btn-icon" id="exportTableBtn" title="Exporter">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn-icon" id="refreshBtn" title="Actualiser">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Heure</th>
                            <th>Ligne</th>
                            <th>Produit</th>
                            <th>Lot</th>
                            <th>Quantité</th>
                            <th>Bons</th>
                            <th>Rebut</th>
                            <th>FTY</th>
                            <th>Opérateur</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productionTableBody">
                        <!-- Données chargées dynamiquement -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Vue Gantt -->
        <div class="gantt-section" id="ganttView">
            <div class="gantt-container">
                <div class="gantt-header">
                    <div class="time-scale">
                        <div class="time-label">06h</div>
                        <div class="time-label">08h</div>
                        <div class="time-label">10h</div>
                        <div class="time-label">12h</div>
                        <div class="time-label">14h</div>
                        <div class="time-label">16h</div>
                        <div class="time-label">18h</div>
                    </div>
                </div>
                <div class="gantt-body" id="ganttChart">
                    <!-- Graphique chargé dynamiquement -->
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-header">
                    <h4><i class="fas fa-chart-line"></i> Performance par ligne</h4>
                </div>
                <div class="stat-body">
                    <div class="line-performance">
                        <div class="line-item">
                            <div class="line-name">Ligne A</div>
                            <div class="line-stats">
                                <span class="stat-value">96.3%</span>
                                <span class="stat-label">FTY</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 96.3%"></div>
                            </div>
                        </div>
                        <div class="line-item">
                            <div class="line-name">Ligne B</div>
                            <div class="line-stats">
                                <span class="stat-value">92.1%</span>
                                <span class="stat-label">FTY</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 92.1%"></div>
                            </div>
                        </div>
                        <div class="line-item">
                            <div class="line-name">Ligne C</div>
                            <div class="line-stats">
                                <span class="stat-value">94.5%</span>
                                <span class="stat-label">FTY</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 94.5%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <h4><i class="fas fa-exclamation-triangle"></i> Alertes production</h4>
                </div>
                <div class="stat-body">
                    <div class="alerts-list" id="productionAlerts">
                        <!-- Alertes chargées dynamiquement -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal saisie production -->
<div id="productionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Saisie Production</h3>
            <button class="modal-close" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="productionForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="prodDate">Date *</label>
                        <input type="date" id="prodDate" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="prodTime">Heure *</label>
                        <input type="time" id="prodTime" required value="<?php echo date('H:i'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="prodLine">Ligne *</label>
                        <select id="prodLine" required>
                            <option value="">Sélectionner</option>
                            <option value="line_a">Ligne A</option>
                            <option value="line_b">Ligne B</option>
                            <option value="line_c">Ligne C</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="prodShift">Poste *</label>
                        <select id="prodShift" required>
                            <option value="">Sélectionner</option>
                            <option value="morning">Matin (06h-14h)</option>
                            <option value="afternoon">Après-midi (14h-22h)</option>
                            <option value="night">Nuit (22h-06h)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="prodProduct">Produit *</label>
                        <select id="prodProduct" required>
                            <option value="">Sélectionner</option>
                            <option value="prod_001">Produit A - REF001</option>
                            <option value="prod_002">Produit B - REF002</option>
                            <option value="prod_003">Produit C - REF003</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="prodLot">Numéro de lot *</label>
                        <input type="text" id="prodLot" required placeholder="Ex: LOT-2023-10-001">
                    </div>
                    
                    <div class="form-group">
                        <label for="prodOperator">Opérateur *</label>
                        <input type="text" id="prodOperator" required placeholder="Nom de l'opérateur">
                    </div>
                    
                    <div class="form-group">
                        <label for="prodQuantity">Quantité produite *</label>
                        <input type="number" id="prodQuantity" required min="1" placeholder="Nombre total">
                    </div>
                    
                    <div class="form-group">
                        <label for="prodGood">Quantité bonne *</label>
                        <input type="number" id="prodGood" required min="0" placeholder="Produits conformes">
                    </div>
                    
                    <div class="form-group">
                        <label for="prodScrap">Quantité rebut *</label>
                        <input type="number" id="prodScrap" required min="0" placeholder="Produits non-conformes">
                    </div>
                    
                    <div class="form-group span-2">
                        <label for="prodComments">Commentaires</label>
                        <textarea id="prodComments" rows="2" placeholder="Observations, arrêts, problèmes..."></textarea>
                    </div>
                </div>
                
                <!-- Calculs automatiques -->
                <div class="calculations">
                    <div class="calc-item">
                        <span>FTY calculé:</span>
                        <strong id="calcFTY">0%</strong>
                    </div>
                    <div class="calc-item">
                        <span>Taux rebut:</span>
                        <strong id="calcScrapRate">0%</strong>
                    </div>
                    <div class="calc-item">
                        <span>Différence:</span>
                        <strong id="calcDiff">0</strong>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" id="cancelBtn">Annuler</button>
            <button class="btn btn-success btn-sm" id="saveBtn">
                <i class="fas fa-save"></i> Enregistrer
            </button>
            <button class="btn btn-primary btn-sm" id="saveAndNewBtn">
                <i class="fas fa-plus-circle"></i> Enregistrer & Nouveau
            </button>
        </div>
    </div>
</div>

<!-- Modal traçabilité -->
<div id="traceabilityModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Traçabilité du lot</h3>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <div class="traceability-info">
                <div class="info-row">
                    <span class="label">Lot:</span>
                    <span class="value" id="traceLot"></span>
                </div>
                <div class="info-row">
                    <span class="label">Produit:</span>
                    <span class="value" id="traceProduct"></span>
                </div>
                <div class="info-row">
                    <span class="label">Date production:</span>
                    <span class="value" id="traceDate"></span>
                </div>
                <div class="info-row">
                    <span class="label">Ligne:</span>
                    <span class="value" id="traceLine"></span>
                </div>
            </div>
            
            <div class="traceability-history">
                <h4>Historique</h4>
                <div class="history-list" id="traceHistory"></div>
            </div>
        </div>
    </div>
</div>

<script>
// Données de test
const productionData = {
    entries: [
        {
            id: 1,
            time: '08:30',
            line: 'Ligne A',
            product: 'Produit A',
            lot: 'LOT-2023-10-001',
            quantity: 250,
            good: 242,
            scrap: 8,
            fty: 96.8,
            operator: 'J. Martin',
            date: '2023-10-25'
        },
        {
            id: 2,
            time: '10:15',
            line: 'Ligne B',
            product: 'Produit B',
            lot: 'LOT-2023-10-002',
            quantity: 180,
            good: 168,
            scrap: 12,
            fty: 93.3,
            operator: 'M. Dubois',
            date: '2023-10-25'
        },
        {
            id: 3,
            time: '12:45',
            line: 'Ligne C',
            product: 'Produit C',
            lot: 'LOT-2023-10-003',
            quantity: 320,
            good: 308,
            scrap: 12,
            fty: 96.3,
            operator: 'P. Bernard',
            date: '2023-10-25'
        },
        {
            id: 4,
            time: '14:30',
            line: 'Ligne A',
            product: 'Produit A',
            lot: 'LOT-2023-10-004',
            quantity: 280,
            good: 274,
            scrap: 6,
            fty: 97.9,
            operator: 'A. Laurent',
            date: '2023-10-25'
        }
    ],
    
    alerts: [
        { id: 1, type: 'warning', message: 'Ligne B: FTY < 94% depuis 2 heures', time: '10:30' },
        { id: 2, type: 'danger', message: 'Taux rebut > 3% sur Produit C', time: '13:15' },
        { id: 3, type: 'info', message: 'Maintenance préventive Ligne A à 16h', time: '15:45' }
    ],
    
    kpis: {
        fty: 94.2,
        scrap: 1.8,
        output: 2450,
        oee: 78.5
    }
};

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    loadProductionTable();
    loadAlerts();
    updateKPIs();
    setupEventListeners();
    setupFormCalculations();
});

function setupEventListeners() {
    // Boutons d'action
    document.getElementById('newProductionBtn').addEventListener('click', openProductionModal);
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('cancelBtn').addEventListener('click', closeModal);
    document.getElementById('saveBtn').addEventListener('click', saveProduction);
    document.getElementById('saveAndNewBtn').addEventListener('click', saveAndNew);
    
    // Filtres
    document.getElementById('lineFilter').addEventListener('change', filterProduction);
    document.getElementById('shiftFilter').addEventListener('change', filterProduction);
    document.getElementById('dateFilter').addEventListener('change', filterProduction);
    
    // View options
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            switchView(this.dataset.view);
        });
    });
    
    // Export
    document.getElementById('exportTableBtn').addEventListener('click', exportTable);
    document.getElementById('refreshBtn').addEventListener('click', refreshData);
    
    // Calculs automatiques
    document.getElementById('prodQuantity').addEventListener('input', calculateRates);
    document.getElementById('prodGood').addEventListener('input', calculateRates);
    document.getElementById('prodScrap').addEventListener('input', calculateRates);
}

function loadProductionTable() {
    const tbody = document.getElementById('productionTableBody');
    tbody.innerHTML = '';
    
    productionData.entries.forEach(entry => {
        const row = createProductionRow(entry);
        tbody.appendChild(row);
    });
}

function createProductionRow(entry) {
    const row = document.createElement('tr');
    
    // Déterminer la couleur FTY
    let ftyClass = '';
    if (entry.fty >= 95) {
        ftyClass = 'fty-excellent';
    } else if (entry.fty >= 92) {
        ftyClass = 'fty-good';
    } else if (entry.fty >= 90) {
        ftyClass = 'fty-warning';
    } else {
        ftyClass = 'fty-danger';
    }
    
    row.innerHTML = `
        <td>${entry.id}</td>
        <td>
            <div class="time-cell">${entry.time}</div>
            <div class="date-cell">${formatDateShort(entry.date)}</div>
        </td>
        <td>
            <span class="line-badge ${entry.line.toLowerCase().replace(' ', '-')}">
                ${entry.line}
            </span>
        </td>
        <td>${entry.product}</td>
        <td>
            <div class="lot-cell">
                <span class="lot-number">${entry.lot}</span>
                <button class="btn-trace" data-lot="${entry.lot}" title="Voir traçabilité">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </td>
        <td>${entry.quantity}</td>
        <td>${entry.good}</td>
        <td>
            <div class="scrap-cell ${entry.scrap > 10 ? 'scrap-high' : ''}">
                ${entry.scrap}
                <span class="scrap-percent">(${((entry.scrap/entry.quantity)*100).toFixed(1)}%)</span>
            </div>
        </td>
        <td>
            <div class="fty-cell ${ftyClass}">
                ${entry.fty.toFixed(1)}%
            </div>
        </td>
        <td>${entry.operator}</td>
        <td>
            <div class="action-buttons">
                <button class="btn-icon btn-edit" data-id="${entry.id}" title="Modifier">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon btn-delete" data-id="${entry.id}" title="Supprimer">
                    <i class="fas fa-trash"></i>
                </button>
                <button class="btn-icon btn-nc" data-id="${entry.id}" title="Déclarer non-conformité">
                    <i class="fas fa-exclamation-triangle"></i>
                </button>
            </div>
        </td>
    `;
    
    // Ajouter les écouteurs
    const traceBtn = row.querySelector('.btn-trace');
    const editBtn = row.querySelector('.btn-edit');
    const deleteBtn = row.querySelector('.btn-delete');
    const ncBtn = row.querySelector('.btn-nc');
    
    traceBtn.addEventListener('click', () => showTraceability(entry.lot));
    editBtn.addEventListener('click', () => editProduction(entry.id));
    deleteBtn.addEventListener('click', () => deleteProduction(entry.id));
    ncBtn.addEventListener('click', () => createNonConformity(entry.id));
    
    return row;
}

function formatDateShort(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit' });
}

function loadAlerts() {
    const alertsList = document.getElementById('productionAlerts');
    alertsList.innerHTML = '';
    
    productionData.alerts.forEach(alert => {
        const alertItem = document.createElement('div');
        alertItem.className = `alert-item alert-${alert.type}`;
        alertItem.innerHTML = `
            <div class="alert-icon">
                <i class="fas fa-${alert.type === 'danger' ? 'exclamation-circle' : alert.type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
            </div>
            <div class="alert-content">
                <div class="alert-message">${alert.message}</div>
                <div class="alert-time">${alert.time}</div>
            </div>
        `;
        alertsList.appendChild(alertItem);
    });
}

function updateKPIs() {
    document.getElementById('ftyValue').textContent = `${productionData.kpis.fty}%`;
    document.getElementById('scrapValue').textContent = `${productionData.kpis.scrap}%`;
    document.getElementById('outputValue').textContent = productionData.kpis.output.toLocaleString();
    document.getElementById('oeeValue').textContent = `${productionData.kpis.oee}%`;
}

function filterProduction() {
    const line = document.getElementById('lineFilter').value;
    const shift = document.getElementById('shiftFilter').value;
    const date = document.getElementById('dateFilter').value;
    
    console.log('Filtres:', { line, shift, date });
    // Implémenter le filtrage réel ici
}

function switchView(view) {
    document.getElementById('tableView').classList.remove('active-view');
    document.getElementById('ganttView').classList.remove('active-view');
    document.getElementById(view + 'View').classList.add('active-view');
}

function openProductionModal() {
    const modal = document.getElementById('productionModal');
    document.getElementById('modalTitle').textContent = 'Nouvelle saisie production';
    resetProductionForm();
    modal.style.display = 'block';
}

function editProduction(id) {
    const entry = productionData.entries.find(e => e.id === id);
    if (entry) {
        const modal = document.getElementById('productionModal');
        document.getElementById('modalTitle').textContent = 'Modifier saisie production';
        
        // Remplir le formulaire
        document.getElementById('prodDate').value = entry.date;
        document.getElementById('prodTime').value = entry.time + ':00';
        document.getElementById('prodLine').value = entry.line.toLowerCase().replace(' ', '_');
        document.getElementById('prodProduct').value = entry.product.toLowerCase().replace(' ', '_');
        document.getElementById('prodLot').value = entry.lot;
        document.getElementById('prodOperator').value = entry.operator;
        document.getElementById('prodQuantity').value = entry.quantity;
        document.getElementById('prodGood').value = entry.good;
        document.getElementById('prodScrap').value = entry.scrap;
        
        modal.style.display = 'block';
        calculateRates();
    }
}

function resetProductionForm() {
    document.getElementById('productionForm').reset();
    document.getElementById('prodDate').value = new Date().toISOString().split('T')[0];
    document.getElementById('prodTime').value = new Date().toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
    calculateRates();
}

function setupFormCalculations() {
    // Écouteurs pour les calculs automatiques
    const quantityInput = document.getElementById('prodQuantity');
    const goodInput = document.getElementById('prodGood');
    const scrapInput = document.getElementById('prodScrap');
    
    quantityInput.addEventListener('input', calculateRates);
    goodInput.addEventListener('input', calculateRates);
    scrapInput.addEventListener('input', calculateRates);
}

function calculateRates() {
    const quantity = parseInt(document.getElementById('prodQuantity').value) || 0;
    const good = parseInt(document.getElementById('prodGood').value) || 0;
    const scrap = parseInt(document.getElementById('prodScrap').value) || 0;
    
    // Calculer FTY
    const fty = quantity > 0 ? (good / quantity) * 100 : 0;
    document.getElementById('calcFTY').textContent = fty.toFixed(1) + '%';
    
    // Calculer taux rebut
    const scrapRate = quantity > 0 ? (scrap / quantity) * 100 : 0;
    document.getElementById('calcScrapRate').textContent = scrapRate.toFixed(1) + '%';
    
    // Calculer différence
    const diff = quantity - (good + scrap);
    document.getElementById('calcDiff').textContent = diff;
    
    // Mettre en forme selon les valeurs
    if (diff !== 0) {
        document.getElementById('calcDiff').className = 'text-danger';
    } else {
        document.getElementById('calcDiff').className = 'text-success';
    }
}

function validateProductionForm() {
    const requiredFields = [
        'prodDate', 'prodTime', 'prodLine', 'prodProduct', 
        'prodLot', 'prodOperator', 'prodQuantity', 'prodGood', 'prodScrap'
    ];
    
    let isValid = true;
    
    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error');
        } else {
            field.classList.remove('error');
        }
    });
    
    // Vérifier la cohérence des quantités
    const quantity = parseInt(document.getElementById('prodQuantity').value) || 0;
    const good = parseInt(document.getElementById('prodGood').value) || 0;
    const scrap = parseInt(document.getElementById('prodScrap').value) || 0;
    
    if (good + scrap !== quantity) {
        alert('La somme des bons et rebut doit être égale à la quantité produite');
        isValid = false;
    }
    
    return isValid;
}

function saveProduction() {
    if (!validateProductionForm()) {
        alert('Veuillez corriger les erreurs dans le formulaire');
        return;
    }
    
    // Créer l'entrée
    const newEntry = {
        id: productionData.entries.length + 1,
        time: document.getElementById('prodTime').value.substring(0, 5),
        line: document.getElementById('prodLine').value.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase()),
        product: document.getElementById('prodProduct').value.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase()),
        lot: document.getElementById('prodLot').value,
        quantity: parseInt(document.getElementById('prodQuantity').value),
        good: parseInt(document.getElementById('prodGood').value),
        scrap: parseInt(document.getElementById('prodScrap').value),
        fty: parseFloat(((parseInt(document.getElementById('prodGood').value) / parseInt(document.getElementById('prodQuantity').value)) * 100).toFixed(1)),
        operator: document.getElementById('prodOperator').value,
        date: document.getElementById('prodDate').value
    };
    
    // Ajouter aux données
    productionData.entries.unshift(newEntry);
    
    // Mettre à jour l'affichage
    loadProductionTable();
    updateKPIs();
    
    // Fermer modal
    closeModal();
    
    // Notification
    showNotification('Saisie production enregistrée avec succès', 'success');
}

function saveAndNew() {
    saveProduction();
    setTimeout(() => {
        openProductionModal();
    }, 100);
}

function deleteProduction(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette entrée de production ?')) {
        const index = productionData.entries.findIndex(e => e.id === id);
        if (index !== -1) {
            productionData.entries.splice(index, 1);
            loadProductionTable();
            showNotification('Entrée supprimée avec succès', 'success');
        }
    }
}

function createNonConformity(productionId) {
    const entry = productionData.entries.find(e => e.id === productionId);
    if (entry) {
        // Simuler la création d'une NC
        const ncData = {
            product: entry.product,
            lot: entry.lot,
            line: entry.line,
            quantity: entry.scrap,
            date: entry.date
        };
        
        localStorage.setItem('nc_prefill', JSON.stringify(ncData));
        showNotification('Redirection vers module non-conformité avec données pré-remplies', 'info');
        // window.location.href = '/non-conformities/create';
    }
}

function showTraceability(lotNumber) {
    const modal = document.getElementById('traceabilityModal');
    const entry = productionData.entries.find(e => e.lot === lotNumber);
    
    if (entry) {
        document.getElementById('traceLot').textContent = entry.lot;
        document.getElementById('traceProduct').textContent = entry.product;
        document.getElementById('traceDate').textContent = formatDateFull(entry.date);
        document.getElementById('traceLine').textContent = entry.line;
        
        // Historique simulé
        const historyList = document.getElementById('traceHistory');
        historyList.innerHTML = `
            <div class="history-item">
                <div class="history-date">${entry.date} ${entry.time}</div>
                <div class="history-action">Production sur ${entry.line}</div>
                <div class="history-details">${entry.quantity} unités - FTY: ${entry.fty}%</div>
            </div>
            <div class="history-item">
                <div class="history-date">${entry.date} 09:00</div>
                <div class="history-action">Contrôle qualité</div>
                <div class="history-details">${entry.good} unités conformes</div>
            </div>
        `;
        
        modal.style.display = 'block';
    }
}

function formatDateFull(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
}

function closeModal() {
    document.getElementById('productionModal').style.display = 'none';
    document.getElementById('traceabilityModal').style.display = 'none';
}

function exportTable() {
    showNotification('Export des données en cours...', 'info');
    setTimeout(() => {
        showNotification('Export terminé', 'success');
    }, 1000);
}

function refreshData() {
    showNotification('Actualisation des données...', 'info');
    setTimeout(() => {
        loadProductionTable();
        showNotification('Données actualisées', 'success');
    }, 500);
}

function showNotification(message, type) {
    // Notification simple
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        ${message}
        <button class="notification-close">&times;</button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    notification.querySelector('.notification-close').addEventListener('click', function() {
        notification.remove();
    });
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 3000);
}

// Fermer modal en cliquant en dehors
window.addEventListener('click', function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>

<style>
/* Variables */
:root {
    --primary: #007bff;
    --primary-light: #e3f2fd;
    --secondary: #6c757d;
    --success: #28a745;
    --success-light: #d4edda;
    --danger: #dc3545;
    --danger-light: #f8d7da;
    --warning: #ffc107;
    --warning-light: #fff3cd;
    --info: #17a2b8;
    --light: #f8f9fa;
    --dark: #343a40;
    --gray: #6c757d;
    --gray-light: #e9ecef;
    --border: #dee2e6;
    --shadow: 0 1px 3px rgba(0,0,0,0.1);
}

/* Base */
.production-container {
    padding: 16px;
    max-width: 1200px;
    margin: 0 auto;
}

/* En-tête */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 12px;
}

.header-main {
    flex: 1;
}

.page-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 4px;
}

.page-subtitle {
    color: var(--gray);
    font-size: 13px;
}

.header-actions {
    display: flex;
    gap: 8px;
}

/* Boutons */
.btn {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
}

.btn:hover {
    transform: translateY(-1px);
}

.btn-sm {
    padding: 6px 10px;
    font-size: 12px;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: #0069d9;
}

.btn-secondary {
    background: var(--secondary);
    color: white;
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-outline-secondary {
    background: white;
    color: var(--secondary);
    border: 1px solid var(--secondary);
}

.btn-outline-secondary:hover {
    background: var(--secondary);
    color: white;
}

/* KPIs */
.kpi-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 12px;
    margin-bottom: 16px;
}

.kpi-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: transform 0.2s;
}

.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.kpi-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.kpi-icon .fa-trash { background: var(--danger-light); color: var(--danger); }
.kpi-icon .fa-industry { background: var(--info); color: white; }
.kpi-icon .fa-clock { background: var(--warning-light); color: #856404; }

.kpi-content {
    flex: 1;
}

.kpi-value {
    font-size: 20px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 2px;
}

.kpi-label {
    font-size: 12px;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.kpi-trend {
    font-size: 11px;
    font-weight: 600;
}

.trend-up { color: var(--success); }
.trend-down { color: var(--danger); }
.trend-warning { color: var(--warning); }

/* Filtres */
.filters-section {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 12px;
    margin-bottom: 16px;
}

.filter-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.filter-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.filter-select {
    padding: 8px 10px;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: white;
    color: var(--dark);
    font-size: 13px;
    min-width: 120px;
}

.view-options {
    display: flex;
    gap: 4px;
}

.view-btn {
    width: 32px;
    height: 32px;
    border: 1px solid var(--border);
    background: white;
    color: var(--gray);
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.view-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.view-btn.active {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
}

/* Tableau */
.main-content {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.production-table-section,
.gantt-section {
    display: none;
}

.active-view {
    display: block;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.table-header h3 {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

.table-actions {
    display: flex;
    gap: 4px;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border: none;
    background: white;
    color: var(--gray);
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.btn-icon:hover {
    background: var(--light);
    color: var(--dark);
}

.table-container {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    overflow: hidden;
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1000px;
}

.data-table thead {
    background: var(--light);
}

.data-table th {
    padding: 10px 12px;
    text-align: left;
    font-weight: 600;
    color: var(--dark);
    font-size: 12px;
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
}

.data-table td {
    padding: 10px 12px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
    font-size: 13px;
}

.data-table tbody tr:hover {
    background: var(--light);
}

/* Cellules spéciales */
.time-cell {
    font-weight: 500;
    font-size: 13px;
}

.date-cell {
    font-size: 11px;
    color: var(--gray);
}

.line-badge {
    padding: 4px 8px;
    border-radius: 3px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}

.line-badge.ligne-a { background: #e3f2fd; color: #1565c0; }
.line-badge.ligne-b { background: #f3e5f5; color: #7b1fa2; }
.line-badge.ligne-c { background: #e8f5e9; color: #2e7d32; }

.lot-cell {
    display: flex;
    align-items: center;
    gap: 6px;
}

.lot-number {
    font-family: monospace;
    font-size: 12px;
}

.btn-trace {
    width: 20px;
    height: 20px;
    border: none;
    background: none;
    color: var(--gray);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
}

.btn-trace:hover {
    color: var(--primary);
}

.scrap-cell {
    font-weight: 500;
}

.scrap-cell.scrap-high {
    color: var(--danger);
    font-weight: 600;
}

.scrap-percent {
    font-size: 11px;
    color: var(--gray);
    margin-left: 4px;
}

.fty-cell {
    padding: 4px 8px;
    border-radius: 3px;
    font-weight: 600;
    text-align: center;
    font-size: 12px;
}

.fty-excellent { background: #e8f5e9; color: #2e7d32; }
.fty-good { background: #fff3e0; color: #ef6c00; }
.fty-warning { background: #fff3cd; color: #856404; }
.fty-danger { background: #f8d7da; color: #721c24; }

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 4px;
}

.btn-icon.btn-edit:hover { color: var(--primary); background: var(--primary-light); }
.btn-icon.btn-delete:hover { color: var(--danger); background: var(--danger-light); }
.btn-icon.btn-nc:hover { color: var(--warning); background: var(--warning-light); }

/* Statistiques */
.stats-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 16px;
}

.stat-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    overflow: hidden;
}

.stat-header {
    padding: 12px;
    background: var(--light);
    border-bottom: 1px solid var(--border);
}

.stat-header h4 {
    font-size: 14px;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.stat-body {
    padding: 12px;
}

/* Performance ligne */
.line-performance {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.line-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.line-name {
    width: 60px;
    font-size: 13px;
    font-weight: 500;
}

.line-stats {
    width: 60px;
    text-align: right;
}

.line-stats .stat-value {
    font-size: 14px;
    font-weight: 600;
    display: block;
}

.line-stats .stat-label {
    font-size: 11px;
    color: var(--gray);
    display: block;
}

.progress-bar {
    flex: 1;
    height: 8px;
    background: var(--gray-light);
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: var(--primary);
    border-radius: 4px;
}

.progress-fill[style*="96.3%"] { background: var(--success); }
.progress-fill[style*="92.1%"] { background: var(--warning); }
.progress-fill[style*="94.5%"] { background: #17a2b8; }

/* Alertes */
.alerts-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.alert-item {
    display: flex;
    gap: 10px;
    padding: 10px;
    border-radius: 4px;
    align-items: flex-start;
}

.alert-item.alert-danger {
    background: var(--danger-light);
    border-left: 3px solid var(--danger);
}

.alert-item.alert-warning {
    background: var(--warning-light);
    border-left: 3px solid var(--warning);
}

.alert-item.alert-info {
    background: #d1ecf1;
    border-left: 3px solid var(--info);
}

.alert-icon {
    color: inherit;
    font-size: 14px;
    margin-top: 2px;
}

.alert-content {
    flex: 1;
}

.alert-message {
    font-size: 13px;
    margin-bottom: 2px;
}

.alert-time {
    font-size: 11px;
    color: var(--gray);
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    overflow-y: auto;
    padding: 20px;
}

.modal-content {
    background: white;
    margin: 20px auto;
    width: 90%;
    max-width: 800px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    color: var(--gray);
    cursor: pointer;
    line-height: 1;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: var(--dark);
}

.modal-body {
    padding: 20px;
    max-height: 60vh;
    overflow-y: auto;
}

.modal-footer {
    padding: 16px 20px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
}

/* Formulaire */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 12px;
    margin-bottom: 16px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.span-2 {
    grid-column: span 2;
}

.form-group label {
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 4px;
    color: var(--dark);
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 8px 10px;
    border: 1px solid var(--border);
    border-radius: 4px;
    font-size: 13px;
}

.form-group textarea {
    resize: vertical;
    min-height: 60px;
}

.form-group input.error,
.form-group select.error,
.form-group textarea.error {
    border-color: var(--danger);
    background: var(--danger-light);
}

/* Calculs */
.calculations {
    display: flex;
    gap: 20px;
    padding: 12px;
    background: var(--light);
    border-radius: 6px;
    margin-top: 16px;
}

.calc-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.calc-item span {
    font-size: 12px;
    color: var(--gray);
    margin-bottom: 4px;
}

.calc-item strong {
    font-size: 16px;
    font-weight: 700;
}

.text-success { color: var(--success); }
.text-danger { color: var(--danger); }

/* Traçabilité */
.traceability-info {
    margin-bottom: 20px;
    padding: 16px;
    background: var(--light);
    border-radius: 6px;
}

.info-row {
    display: flex;
    margin-bottom: 8px;
}

.info-row:last-child {
    margin-bottom: 0;
}

.info-row .label {
    width: 120px;
    font-weight: 500;
    color: var(--dark);
}

.info-row .value {
    flex: 1;
    font-family: monospace;
}

.traceability-history h4 {
    font-size: 16px;
    margin-bottom: 12px;
    color: var(--dark);
}

.history-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.history-item {
    padding: 10px;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: white;
}

.history-date {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 4px;
}

.history-action {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 2px;
}

.history-details {
    font-size: 12px;
    color: var(--gray);
}

/* Notifications */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 16px;
    border-radius: 6px;
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1001;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 300px;
    max-width: 400px;
    border-left: 4px solid var(--primary);
}

.notification.show {
    transform: translateX(0);
}

.notification-success {
    border-left-color: var(--success);
    background: var(--success-light);
    color: var(--success);
}

.notification-error {
    border-left-color: var(--danger);
    background: var(--danger-light);
    color: var(--danger);
}

.notification-info {
    border-left-color: var(--info);
    background: #d1ecf1;
    color: #0c5460;
}

.notification-close {
    background: none;
    border: none;
    font-size: 20px;
    color: inherit;
    cursor: pointer;
    padding: 0;
    margin-left: 10px;
    opacity: 0.7;
}

.notification-close:hover {
    opacity: 1;
}

/* Responsive */
@media (max-width: 768px) {
    .production-container {
        padding: 12px;
    }
    
    .page-header {
        flex-direction: column;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .kpi-cards {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-row {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        width: 100%;
    }
    
    .filter-select {
        flex: 1;
        min-width: 0;
    }
    
    .view-options {
        align-self: flex-end;
    }
    
    .stats-section {
        grid-template-columns: 1fr;
    }
    
    .modal-content {
        width: 95%;
        margin: 10px auto;
    }
    
    .modal-body {
        padding: 16px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-group.span-2 {
        grid-column: span 1;
    }
    
    .calculations {
        flex-direction: column;
        gap: 12px;
    }
    
    .notification {
        left: 20px;
        right: 20px;
        min-width: auto;
        max-width: none;
    }
}

@media (max-width: 480px) {
    .kpi-cards {
        grid-template-columns: 1fr;
    }
    
    .data-table {
        font-size: 12px;
    }
    
    .data-table th,
    .data-table td {
        padding: 8px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 2px;
    }
    
    .btn-icon {
        width: 28px;
        height: 28px;
    }
}
</style>
@endsection