@extends('layouts.clients')

@section('title', 'Opérations - Tableau de Bord')

@section('content')
<div class="operations-dashboard">
    <!-- En-tête avec filtres -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="dashboard-title">Tableau de Bord Opérationnel</h1>
                <p class="dashboard-subtitle">Vue synthétique des KPIs, alertes et statuts de planification</p>
            </div>
            <div class="header-filters">
                <div class="filters-container">
                    <select id="periodFilter" class="form-select-sm">
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="quarter" selected>Ce trimestre</option>
                        <option value="year">Cette année</option>
                    </select>
                    <select id="lineFilter" class="form-select-sm">
                        <option value="all">Toutes les lignes</option>
                        <option value="line_a">Ligne A</option>
                        <option value="line_b">Ligne B</option>
                        <option value="line_c">Ligne C</option>
                    </select>
                    <button id="refreshBtn" class="btn-refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertes urgentes -->
    <div id="alertsSection" class="alerts-container">
        <div class="alert alert-warning">
            <div class="alert-content">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="alert-text">
                    <strong id="alertCount">2 alertes critiques</strong> nécessitent votre attention
                    <span id="alertDetails">(1 ligne surchargée, 1 fournisseur en zone rouge)</span>
                </div>
            </div>
            <a href="#" class="btn btn-alert" id="viewAlertsBtn">Voir les alertes</a>
        </div>
    </div>

    <!-- Section KPIs Principaux -->
    <div class="kpis-container">
        <!-- KPI FTY -->
        <div class="kpi-card">
            <div class="kpi-card-body">
                <div class="kpi-header">
                    <div class="kpi-info">
                        <span class="kpi-label">FTY </span>
                        <h3 id="ftyValue" class="kpi-value">94.2%</h3>
                        <div id="ftyTrend" class="kpi-trend trend-up">
                            <i class="fas fa-arrow-up"></i> <span>+1.2%</span> vs mois dernier
                        </div>
                    </div>
                    <div class="kpi-icon">
                        <div class="icon-container bg-primary-light">
                            <i class="fas fa-bullseye text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="kpi-progress">
                    <div class="progress-bar-container">
                        <div id="ftyProgress" class="progress-bar bg-success" style="width: 94.2%"></div>
                    </div>
                    <div class="progress-labels">
                        <small>Objectif: <span id="ftyTarget">95%</span></small>
                        <small><span id="ftyCurrent">94.2%</span></small>
                    </div>
                </div>
                <button class="btn btn-outline-primary btn-full" id="analyzeFtyBtn">
                    <i class="fas fa-chart-line"></i> Analyser
                </button>
            </div>
        </div>

        <!-- KPI Taux de Rebut -->
        <div class="kpi-card">
            <div class="kpi-card-body">
                <div class="kpi-header">
                    <div class="kpi-info">
                        <span class="kpi-label">Taux de Rebut </span>
                        <h3 id="scrapValue" class="kpi-value">1.8%</h3>
                        <div id="scrapTrend" class="kpi-trend trend-down">
                            <i class="fas fa-arrow-down"></i> <span>-0.3%</span> vs mois dernier
                        </div>
                    </div>
                    <div class="kpi-icon">
                        <div class="icon-container bg-danger-light">
                            <i class="fas fa-trash text-danger"></i>
                        </div>
                    </div>
                </div>
                <div class="kpi-progress">
                    <div class="progress-bar-container">
                        <div id="scrapProgress" class="progress-bar bg-danger" style="width: 36%"></div>
                    </div>
                    <div class="progress-labels">
                        <small>Objectif: <span id="scrapTarget">&lt;1.5%</span></small>
                        <small><span id="scrapCurrent">1.8%</span></small>
                    </div>
                </div>
                <button class="btn btn-outline-danger btn-full" id="investigateScrapBtn">
                    <i class="fas fa-search"></i> Investiguer
                </button>
            </div>
        </div>

        <!-- KPI TNCF -->
        <div class="kpi-card">
            <div class="kpi-card-body">
                <div class="kpi-header">
                    <div class="kpi-info">
                        <span class="kpi-label">TNCF </span>
                        <h3 id="tncfValue" class="kpi-value">2.1%</h3>
                        <div id="tncfTrend" class="kpi-trend trend-warning">
                            <i class="fas fa-exclamation-triangle"></i> <span>Seuil dépassé</span>
                        </div>
                    </div>
                    <div class="kpi-icon">
                        <div class="icon-container bg-warning-light">
                            <i class="fas fa-truck text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="kpi-alert">
                    <div id="supplierAlert" class="alert-mini alert-warning-mini">
                        <small><i class="fas fa-info-circle"></i> <span id="redSuppliersCount">2</span> fournisseurs en zone rouge</small>
                    </div>
                </div>
                <button class="btn btn-outline-warning btn-full" id="viewSuppliersBtn">
                    <i class="fas fa-list"></i> Voir fournisseurs
                </button>
            </div>
        </div>

        <!-- KPI Respect Délais -->
        <div class="kpi-card">
            <div class="kpi-card-body">
                <div class="kpi-header">
                    <div class="kpi-info">
                        <span class="kpi-label">Taux de Respect Délais</span>
                        <h3 id="onTimeValue" class="kpi-value">97.5%</h3>
                        <div id="onTimeTrend" class="kpi-trend trend-up">
                            <i class="fas fa-arrow-up"></i> <span>+0.8%</span> vs mois dernier
                        </div>
                    </div>
                    <div class="kpi-icon">
                        <div class="icon-container bg-success-light">
                            <i class="fas fa-clock text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="kpi-progress">
                    <div class="progress-bar-container">
                        <div id="onTimeProgress" class="progress-bar bg-success" style="width: 97.5%"></div>
                    </div>
                    <div class="progress-labels">
                        <small>Objectif: <span id="onTimeTarget">98%</span></small>
                        <small><span id="onTimeCurrent">97.5%</span></small>
                    </div>
                </div>
                <button class="btn btn-outline-success btn-full" id="planScheduleBtn">
                    <i class="fas fa-calendar-alt"></i> Planifier
                </button>
            </div>
        </div>
    </div>

    <!-- Graphiques et Visualisations -->
    <div class="charts-container">
        <!-- Graphique Performance Fournisseurs -->
        <div class="chart-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-chart-bar text-primary"></i>
                    <h5>Performance Fournisseurs </h5>
                </div>
                <div class="chart-filter">
                    <label class="switch">
                        <input type="checkbox" id="showAllSuppliers" checked>
                        <span class="slider"></span>
                    </label>
                    <span class="filter-label">Afficher tous les fournisseurs</span>
                </div>
            </div>
            <div class="card-body">
                <div id="supplierChart" class="chart-content">
                    <!-- Graphique à barres dynamique -->
                </div>
                <div class="chart-legends">
                    <div class="legend-item">
                        <span class="legend-color bg-success"></span>
                        <span class="legend-text">Vert (&lt;1%)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color bg-warning"></span>
                        <span class="legend-text">Orange (1-3%)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color bg-danger"></span>
                        <span class="legend-text">Rouge (&gt;3%)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jauge FTY -->
        <div class="chart-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-gauge-high text-success"></i>
                    <h5>Efficacité Opérationnelle - FTY </h5>
                </div>
                <div class="chart-filter">
                    <select id="ftyProductFilter" class="form-select-sm">
                        <option value="all">Tous les produits</option>
                        <option value="product_a">Produit A</option>
                        <option value="product_b">Produit B</option>
                        <option value="product_c">Produit C</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="gauge-wrapper">
                    <div class="gauge-container">
                        <div class="gauge-background"></div>
                        <div id="gaugeNeedle" class="gauge-value"></div>
                        <div class="gauge-center">
                            <span id="gaugeValue" class="gauge-text">94.2%</span>
                            <div class="gauge-subtitle">Taux de Rendement Premier Coup</div>
                        </div>
                    </div>
                </div>
                <div class="gauge-actions">
                    <button class="btn btn-primary" id="rootCauseBtn">
                        <i class="fas fa-search"></i> Analyser les causes racines
                    </button>
                    <p class="action-note">
                        Cliquez pour créer une non-conformité pré-remplie avec les données de production
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Planification et Alertes -->
    <div class="planning-container">
        <!-- Alertes Capacité -->
        <div class="planning-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-bell text-warning"></i>
                    <h5>Alertes Capacité </h5>
                </div>
                <div class="card-filter">
                    <select id="alertTypeFilter" class="form-select-sm">
                        <option value="all">Tous les types</option>
                        <option value="capacity">Capacité</option>
                        <option value="stock">Stock</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div id="alertsList" class="alerts-list">
                    <!-- Alertes chargées dynamiquement -->
                </div>
            </div>
        </div>

        <!-- Statuts Planification -->
        <div class="planning-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-calendar-check text-primary"></i>
                    <h5>Statuts Planification </h5>
                </div>
            </div>
            <div class="card-body">
                <div class="planning-item">
                    <div class="planning-header">
                        <span>Commandes en cours</span>
                        <span id="ordersCount" class="planning-count">24/30</span>
                    </div>
                    <div class="progress-container">
                        <div id="ordersProgress" class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                </div>
                <div class="planning-item">
                    <div class="planning-header">
                        <span>Projets Conception </span>
                        <span id="projectsCount" class="planning-count">3/5</span>
                    </div>
                    <div class="progress-container">
                        <div id="projectsProgress" class="progress-bar bg-info" style="width: 60%"></div>
                    </div>
                </div>
                <div class="planning-item">
                    <div class="planning-header">
                        <span>Revues Contrat </span>
                        <span id="reviewsCount" class="planning-count">8/10</span>
                    </div>
                    <div class="progress-container">
                        <div id="reviewsProgress" class="progress-bar bg-success" style="width: 80%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="planning-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-bolt text-success"></i>
                    <h5>Actions Rapides</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="{{ route('client.contract-review') }}" class="btn btn-action btn-action-primary">
                        <i class="fas fa-file-contract"></i>
                        <span>Nouvelle Revue de Contrat </span>
                    </a>
                    <a href="{{ route('client.production') }}" class="btn btn-action btn-action-success">
                        <i class="fas fa-industry"></i>
                        <span>Saisie Production </span>
                    </a>
                    <a href="{{ route('client.release') }}" class="btn btn-action btn-action-warning">
                        <i class="fas fa-clipboard-check"></i>
                        <span>Libération Produit </span>
                    </a>
                    <a href="{{ route('client.nonconformities') }}" class="btn btn-action btn-action-danger">
                        <i class="fas fa-circle-exclamation"></i>
                        <span>Déclarer Non-Conformité </span>
                    </a>
                </div>
                <div class="last-update">
                    <i class="fas fa-clock"></i>
                    <span id="lastUpdate">Dernière mise à jour: {{ now()->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Données statiques pour les tests -->
<script>
// Données de test
const testData = {
    periods: {
        week: {
            fty: 93.5,
            scrap: 2.1,
            tncf: 2.5,
            onTime: 96.8,
            redSuppliers: 3,
            orders: '18/25',
            ordersPercent: 72,
            projects: '2/4',
            projectsPercent: 50,
            reviews: '5/8',
            reviewsPercent: 62.5
        },
        month: {
            fty: 94.2,
            scrap: 1.8,
            tncf: 2.1,
            onTime: 97.5,
            redSuppliers: 2,
            orders: '24/30',
            ordersPercent: 80,
            projects: '3/5',
            projectsPercent: 60,
            reviews: '8/10',
            reviewsPercent: 80
        },
        quarter: {
            fty: 94.8,
            scrap: 1.5,
            tncf: 1.9,
            onTime: 98.2,
            redSuppliers: 1,
            orders: '28/35',
            ordersPercent: 80,
            projects: '4/6',
            projectsPercent: 66.7,
            reviews: '9/12',
            reviewsPercent: 75
        },
        year: {
            fty: 95.3,
            scrap: 1.2,
            tncf: 1.6,
            onTime: 98.7,
            redSuppliers: 0,
            orders: '32/40',
            ordersPercent: 80,
            projects: '5/7',
            projectsPercent: 71.4,
            reviews: '10/15',
            reviewsPercent: 66.7
        }
    },
    
    lines: {
        all: { fty: 94.2, scrap: 1.8 },
        line_a: { fty: 96.1, scrap: 0.9 },
        line_b: { fty: 92.5, scrap: 2.8 },
        line_c: { fty: 94.0, scrap: 1.7 }
    },
    
    products: {
        all: { fty: 94.2 },
        product_a: { fty: 96.5 },
        product_b: { fty: 93.2 },
        product_c: { fty: 92.8 }
    },
    
    suppliers: [
        { name: 'Fournisseur A', tncf: 0.8, status: 'green', category: 'Composants' },
        { name: 'Fournisseur B', tncf: 3.2, status: 'red', category: 'Matières' },
        { name: 'Fournisseur C', tncf: 2.1, status: 'orange', category: 'Emballage' },
        { name: 'Fournisseur D', tncf: 0.5, status: 'green', category: 'Composants' },
        { name: 'Fournisseur E', tncf: 4.1, status: 'red', category: 'Matières' },
        { name: 'Fournisseur F', tncf: 1.2, status: 'orange', category: 'Emballage' },
        { name: 'Fournisseur G', tncf: 0.9, status: 'green', category: 'Composants' }
    ],
    
    alerts: [
        { id: 1, type: 'capacity', title: 'Ligne B - Surcharge', description: 'Capacité à 115% cette semaine', severity: 'high', line: 'line_b' },
        { id: 2, type: 'stock', title: 'Manque Matières Premières', description: 'Stock critique pour le produit XYZ', severity: 'high', line: 'all' },
        { id: 3, type: 'maintenance', title: 'Maintenance Préventive', description: 'Prévue le 15/12 pour la Ligne A', severity: 'medium', line: 'line_a' },
        { id: 4, type: 'capacity', title: 'Ligne C - Sous-utilisation', description: 'Capacité à 65% cette semaine', severity: 'low', line: 'line_c' },
        { id: 5, type: 'stock', title: 'Stock Sécurité Bas', description: 'Produit ABC en dessous du seuil', severity: 'medium', line: 'all' }
    ]
};

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    initializeDashboard();
    setupEventListeners();
    updateDashboard('quarter', 'all', 'all');
});

function initializeDashboard() {
    renderSupplierChart();
    renderAlertsList();
    updateGauge(94.2);
}

function setupEventListeners() {
    document.getElementById('periodFilter').addEventListener('change', function() {
        const period = this.value;
        const line = document.getElementById('lineFilter').value;
        const product = document.getElementById('ftyProductFilter').value;
        updateDashboard(period, line, product);
    });
    
    document.getElementById('lineFilter').addEventListener('change', function() {
        const line = this.value;
        const period = document.getElementById('periodFilter').value;
        const product = document.getElementById('ftyProductFilter').value;
        updateDashboard(period, line, product);
    });
    
    document.getElementById('ftyProductFilter').addEventListener('change', function() {
        const product = this.value;
        const period = document.getElementById('periodFilter').value;
        const line = document.getElementById('lineFilter').value;
        updateDashboard(period, line, product);
    });
    
    document.getElementById('alertTypeFilter').addEventListener('change', function() {
        renderAlertsList(this.value);
    });
    
    document.getElementById('showAllSuppliers').addEventListener('change', function() {
        renderSupplierChart(this.checked);
    });
    
    document.getElementById('refreshBtn').addEventListener('click', function() {
        refreshDashboard();
    });
    
    document.getElementById('viewAlertsBtn').addEventListener('click', function(e) {
        e.preventDefault();
        showNotification('Redirection vers la liste complète des alertes...', 'info');
    });
    
    document.getElementById('analyzeFtyBtn').addEventListener('click', function() {
        const ftyValue = document.getElementById('ftyValue').textContent;
        showNotification(`Analyse du FTY (${ftyValue}) - Ouverture du module d'analyse...`, 'info');
    });
    
    document.getElementById('rootCauseBtn').addEventListener('click', function() {
        const product = document.getElementById('ftyProductFilter').value;
        showNotification(`Création d'une non-conformité pour analyse des causes racines (Produit: ${product})`, 'success');
    });
}

function updateDashboard(period, line, product) {
    const data = testData.periods[period];
    const lineData = testData.lines[line];
    const productData = testData.products[product];
    
    updateKPIs(data, lineData, productData);
    updateCounters(data);
    updateGauge(productData.fty);
    updateSupplierStats(data.redSuppliers);
    updateLastUpdate();
    updateAlertsCount();
}

function updateKPIs(data, lineData, productData) {
    // FTY
    document.getElementById('ftyValue').textContent = `${lineData.fty}%`;
    document.getElementById('ftyCurrent').textContent = `${lineData.fty}%`;
    document.getElementById('ftyProgress').style.width = `${lineData.fty}%`;
    
    // Taux de Rebut
    document.getElementById('scrapValue').textContent = `${lineData.scrap}%`;
    document.getElementById('scrapCurrent').textContent = `${lineData.scrap}%`;
    document.getElementById('scrapProgress').style.width = `${(lineData.scrap / 5) * 100}%`;
    
    // TNCF
    document.getElementById('tncfValue').textContent = `${data.tncf}%`;
    
    // Respect Délais
    document.getElementById('onTimeValue').textContent = `${data.onTime}%`;
    document.getElementById('onTimeCurrent').textContent = `${data.onTime}%`;
    document.getElementById('onTimeProgress').style.width = `${data.onTime}%`;
}

function updateCounters(data) {
    document.getElementById('ordersCount').textContent = data.orders;
    document.getElementById('ordersProgress').style.width = `${data.ordersPercent}%`;
    
    document.getElementById('projectsCount').textContent = data.projects;
    document.getElementById('projectsProgress').style.width = `${data.projectsPercent}%`;
    
    document.getElementById('reviewsCount').textContent = data.reviews;
    document.getElementById('reviewsProgress').style.width = `${data.reviewsPercent}%`;
}

function updateGauge(value) {
    const gaugeNeedle = document.getElementById('gaugeNeedle');
    const gaugeValue = document.getElementById('gaugeValue');
    
    const rotation = (value / 100) * 180;
    gaugeNeedle.style.transform = `rotate(${rotation}deg)`;
    gaugeValue.textContent = `${value}%`;
}

function updateSupplierStats(redCount) {
    document.getElementById('redSuppliersCount').textContent = redCount;
    
    const supplierAlert = document.getElementById('supplierAlert');
    const tncfTrend = document.getElementById('tncfTrend');
    
    let alertText = '';
    let alertClass = '';
    let trendClass = '';
    
    if (redCount === 0) {
        alertText = 'Aucun fournisseur en zone rouge';
        alertClass = 'alert-success-mini';
        trendClass = 'trend-up';
    } else if (redCount === 1) {
        alertText = '1 fournisseur en zone rouge';
        alertClass = 'alert-warning-mini';
        trendClass = 'trend-warning';
    } else {
        alertText = `${redCount} fournisseurs en zone rouge`;
        alertClass = 'alert-danger-mini';
        trendClass = 'trend-down';
    }
    
    supplierAlert.className = `alert-mini ${alertClass}`;
    tncfTrend.className = `kpi-trend ${trendClass}`;
    supplierAlert.querySelector('small').innerHTML = 
        `<i class="fas fa-info-circle"></i> ${alertText}`;
}

function renderSupplierChart(showAll = true) {
    const container = document.getElementById('supplierChart');
    const suppliers = showAll ? testData.suppliers : testData.suppliers.slice(0, 5);
    
    let html = '<div class="bar-chart">';
    
    suppliers.forEach(supplier => {
        const height = Math.min(supplier.tncf * 20, 120);
        const statusClass = supplier.status === 'green' ? 'success' : supplier.status === 'orange' ? 'warning' : 'danger';
        
        html += `
            <div class="bar-column">
                <div class="bar-wrapper">
                    <div class="bar-icon">
                        <div class="icon-mini bg-${statusClass}-light">
                            <i class="fas fa-warehouse text-${statusClass}"></i>
                        </div>
                    </div>
                    <div class="bar-container">
                        <div class="bar bg-${statusClass}" style="height: ${height}px;"></div>
                    </div>
                    <div class="bar-labels">
                        <span class="bar-value">${supplier.tncf}%</span>
                        <span class="bar-label">${supplier.name}</span>
                    </div>
                </div>
            </div>
        `;
    });
    
    html += '</div>';
    container.innerHTML = html;
}

function renderAlertsList(typeFilter = 'all') {
    const container = document.getElementById('alertsList');
    const filteredAlerts = typeFilter === 'all' 
        ? testData.alerts 
        : testData.alerts.filter(alert => alert.type === typeFilter);
    
    let html = '';
    
    filteredAlerts.forEach(alert => {
        let badgeClass = '';
        let icon = '';
        
        switch(alert.severity) {
            case 'high':
                badgeClass = 'badge-danger';
                icon = 'fa-exclamation';
                break;
            case 'medium':
                badgeClass = 'badge-warning';
                icon = 'fa-exclamation-triangle';
                break;
            case 'low':
                badgeClass = 'badge-info';
                icon = 'fa-info-circle';
                break;
        }
        
        html += `
            <div class="alert-item">
                <div class="alert-item-content">
                    <span class="alert-badge ${badgeClass}">
                        <i class="fas ${icon}"></i>
                    </span>
                    <div class="alert-item-details">
                        <h6>${alert.title}</h6>
                        <p>${alert.description}</p>
                        <small><i class="fas fa-industry"></i> ${alert.line === 'all' ? 'Toutes lignes' : alert.line}</small>
                    </div>
                </div>
            </div>
        `;
    });
    
    if (filteredAlerts.length === 0) {
        html = `
            <div class="no-alerts">
                <i class="fas fa-check-circle text-success"></i>
                <p>Aucune alerte pour ce filtre</p>
            </div>
        `;
    }
    
    container.innerHTML = html;
}

function updateAlertsCount() {
    const currentLine = document.getElementById('lineFilter').value;
    const filteredAlerts = testData.alerts.filter(alert => 
        alert.line === 'all' || alert.line === currentLine
    );
    
    const criticalCount = filteredAlerts.filter(alert => alert.severity === 'high').length;
    
    document.getElementById('alertCount').textContent = `${criticalCount} alerte${criticalCount > 1 ? 's' : ''} critique${criticalCount > 1 ? 's' : ''}`;
    
    if (criticalCount > 0) {
        document.getElementById('alertsSection').style.display = 'block';
        document.getElementById('alertDetails').textContent = 
            `(${filteredAlerts.length} alerte${filteredAlerts.length > 1 ? 's' : ''} au total)`;
    } else {
        document.getElementById('alertsSection').style.display = 'none';
    }
}

function updateLastUpdate() {
    const now = new Date();
    const formattedDate = now.toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
    
    document.getElementById('lastUpdate').innerHTML = 
        `Dernière mise à jour: ${formattedDate}`;
}

function refreshDashboard() {
    const refreshBtn = document.getElementById('refreshBtn');
    const icon = refreshBtn.querySelector('i');
    
    icon.className = 'fas fa-spinner fa-spin';
    refreshBtn.disabled = true;
    
    setTimeout(() => {
        const period = document.getElementById('periodFilter').value;
        const line = document.getElementById('lineFilter').value;
        const product = document.getElementById('ftyProductFilter').value;
        
        testData.periods[period].fty += (Math.random() - 0.5) * 0.5;
        testData.periods[period].fty = Math.min(Math.max(testData.periods[period].fty, 90), 100);
        
        testData.periods[period].scrap += (Math.random() - 0.5) * 0.2;
        testData.periods[period].scrap = Math.min(Math.max(testData.periods[period].scrap, 0.5), 5);
        
        updateDashboard(period, line, product);
        
        icon.className = 'fas fa-sync-alt';
        refreshBtn.disabled = false;
        
        showNotification('Tableau de bord actualisé avec succès', 'success');
    }, 1000);
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        ${message}
        <button type="button" class="notification-close">&times;</button>
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
</script>

<style>
/* Variables CSS */
:root {
    --primary: #007bff;
    --primary-light: rgba(0, 123, 255, 0.1);
    --secondary: #6c757d;
    --success: #28a745;
    --success-light: rgba(40, 167, 69, 0.1);
    --danger: #dc3545;
    --danger-light: rgba(220, 53, 69, 0.1);
    --warning: #ffc107;
    --warning-light: rgba(255, 193, 7, 0.1);
    --info: #17a2b8;
    --light: #f8f9fa;
    --dark: #343a40;
    --white: #ffffff;
    --gray: #6c757d;
    --gray-light: #f8f9fa;
    --border-color: #dee2e6;
    --shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    --shadow-lg: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

/* Styles généraux */
.operations-dashboard {
    padding: 20px;
    background-color: var(--gray-light);
    min-height: 100vh;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
}

/* En-tête */
.dashboard-header {
    margin-bottom: 20px;
}

.header-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
}

.header-text {
    flex: 1;
    min-width: 300px;
}

.dashboard-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 4px;
}

.dashboard-subtitle {
    color: var(--gray);
    font-size: 14px;
    margin: 0;
}

.header-filters {
    flex-shrink: 0;
}

.filters-container {
    display: flex;
    gap: 8px;
    align-items: center;
}

.form-select-sm {
    padding: 6px 12px;
    font-size: 14px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    background-color: var(--white);
    color: var(--dark);
}

.btn-refresh {
    padding: 6px 12px;
    border: 1px solid var(--primary);
    border-radius: 4px;
    background-color: var(--white);
    color: var(--primary);
    cursor: pointer;
    transition: all 0.2s;
}

.btn-refresh:hover {
    background-color: var(--primary);
    color: var(--white);
}

.btn-refresh:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Alertes */
.alerts-container {
    margin-bottom: 20px;
}

.alert {
    padding: 16px;
    border-radius: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.alert-warning {
    background-color: #fff3cd;
    border: 1px solid #ffeaa7;
    color: #856404;
}

.alert-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-icon {
    font-size: 20px;
}

.alert-text {
    flex: 1;
}

.btn-alert {
    padding: 6px 16px;
    background-color: #ffc107;
    color: #000;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    white-space: nowrap;
}

.btn-alert:hover {
    background-color: #e0a800;
}

/* KPIs */
.kpis-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.kpi-card {
    background: var(--white);
    border-radius: 8px;
    box-shadow: var(--shadow);
    border-left: 4px solid var(--primary);
    transition: transform 0.2s, box-shadow 0.2s;
}

.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.kpi-card:nth-child(2) {
    border-left-color: var(--danger);
}

.kpi-card:nth-child(3) {
    border-left-color: var(--warning);
}

.kpi-card:nth-child(4) {
    border-left-color: var(--success);
}

.kpi-card-body {
    padding: 16px;
}

.kpi-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}

.kpi-label {
    font-size: 12px;
    color: var(--gray);
    text-transform: uppercase;
    display: block;
    margin-bottom: 4px;
}

.kpi-value {
    font-size: 28px;
    font-weight: 600;
    color: var(--dark);
    margin: 0 0 4px 0;
}

.kpi-trend {
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.trend-up { color: var(--success); }
.trend-down { color: var(--danger); }
.trend-warning { color: var(--warning); }

.icon-container {
    padding: 8px;
    border-radius: 6px;
}

.bg-primary-light { background-color: var(--primary-light); }
.bg-success-light { background-color: var(--success-light); }
.bg-danger-light { background-color: var(--danger-light); }
.bg-warning-light { background-color: var(--warning-light); }

.text-primary { color: var(--primary); }
.text-success { color: var(--success); }
.text-danger { color: var(--danger); }
.text-warning { color: var(--warning); }

/* Barres de progression */
.kpi-progress {
    margin: 16px 0;
}

.progress-bar-container {
    height: 6px;
    background-color: var(--border-color);
    border-radius: 3px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    border-radius: 3px;
    transition: width 0.3s ease;
}

.progress-labels {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: var(--gray);
    margin-top: 4px;
}

/* Alertes mini */
.kpi-alert {
    margin: 16px 0;
}

.alert-mini {
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 12px;
}

.alert-warning-mini {
    background-color: var(--warning-light);
    color: #856404;
}

.alert-success-mini {
    background-color: var(--success-light);
    color: var(--success);
}

.alert-danger-mini {
    background-color: var(--danger-light);
    color: var(--danger);
}

/* Boutons */
.btn {
    padding: 8px 16px;
    border: 1px solid;
    border-radius: 4px;
    background-color: transparent;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.2s;
}

.btn:hover {
    transform: translateY(-1px);
}

.btn-full {
    width: 100%;
}

.btn-outline-primary {
    color: var(--primary);
    border-color: var(--primary);
}

.btn-outline-primary:hover {
    background-color: var(--primary);
    color: var(--white);
}

.btn-outline-success {
    color: var(--success);
    border-color: var(--success);
}

.btn-outline-success:hover {
    background-color: var(--success);
    color: var(--white);
}

.btn-outline-danger {
    color: var(--danger);
    border-color: var(--danger);
}

.btn-outline-danger:hover {
    background-color: var(--danger);
    color: var(--white);
}

.btn-outline-warning {
    color: var(--warning);
    border-color: var(--warning);
}

.btn-outline-warning:hover {
    background-color: var(--warning);
    color: var(--dark);
}

.btn-primary {
    background-color: var(--primary);
    color: var(--white);
    border: 1px solid var(--primary);
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

/* Graphiques */
.charts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.chart-card {
    background: var(--white);
    border-radius: 8px;
    box-shadow: var(--shadow);
    overflow: hidden;
}

.card-header {
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.card-title {
    display: flex;
    align-items: center;
    gap: 8px;
}

.card-title h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.chart-filter {
    display: flex;
    align-items: center;
    gap: 8px;
}

.switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 20px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: var(--primary);
}

input:checked + .slider:before {
    transform: translateX(20px);
}

.filter-label {
    font-size: 12px;
    color: var(--gray);
}

.card-body {
    padding: 16px;
}

/* Graphique à barres */
.chart-content {
    min-height: 200px;
}

.bar-chart {
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
    height: 200px;
    padding: 20px 0;
}

.bar-column {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
}

.bar-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    width: 100%;
}

.bar-icon {
    margin-bottom: 8px;
}

.icon-mini {
    padding: 6px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.bar-container {
    flex: 1;
    width: 100%;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.bar {
    width: 60%;
    border-radius: 3px 3px 0 0;
    transition: height 0.3s ease;
}

.bar-labels {
    margin-top: 8px;
    text-align: center;
}

.bar-value {
    display: block;
    font-size: 12px;
    font-weight: 600;
}

.bar-label {
    display: block;
    font-size: 10px;
    color: var(--gray);
    margin-top: 2px;
}

.chart-legends {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 20px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 2px;
}

.bg-success { background-color: var(--success); }
.bg-warning { background-color: var(--warning); }
.bg-danger { background-color: var(--danger); }
.bg-info { background-color: var(--info); }
.bg-primary { background-color: var(--primary); }

.legend-text {
    font-size: 12px;
    color: var(--gray);
}

/* Jauge */
.gauge-wrapper {
    text-align: center;
}

.gauge-container {
    position: relative;
    width: 200px;
    height: 100px;
    margin: 0 auto 20px;
    overflow: hidden;
}

.gauge-background {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 100px 100px 0 0;
    background: var(--border-color);
    overflow: hidden;
}

.gauge-value {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 100px 100px 0 0;
    background: linear-gradient(90deg, var(--success) 0%, var(--warning) 50%, var(--danger) 100%);
    clip-path: polygon(50% 50%, 0 0, 200px 0);
    transform-origin: center bottom;
    transition: transform 1s ease;
}

.gauge-center {
    position: absolute;
    width: 140px;
    height: 70px;
    background: var(--white);
    border-radius: 70px 70px 0 0;
    bottom: 0;
    left: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
}

.gauge-text {
    font-size: 28px;
    font-weight: 600;
    color: var(--dark);
}

.gauge-subtitle {
    font-size: 12px;
    color: var(--gray);
}

.gauge-actions {
    text-align: center;
}

.action-note {
    font-size: 12px;
    color: var(--gray);
    margin-top: 8px;
}

/* Planification */
.planning-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 16px;
}

.planning-card {
    background: var(--white);
    border-radius: 8px;
    box-shadow: var(--shadow);
    overflow: hidden;
}

.card-filter {
    flex-shrink: 0;
}

/* Alertes liste */
.alerts-list {
    max-height: 300px;
    overflow-y: auto;
}

.alert-item {
    padding: 12px;
    border-bottom: 1px solid var(--border-color);
    transition: background-color 0.2s;
}

.alert-item:hover {
    background-color: var(--light);
}

.alert-item:last-child {
    border-bottom: none;
}

.alert-item-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.alert-badge {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.badge-danger { background-color: var(--danger); color: white; }
.badge-warning { background-color: var(--warning); color: black; }
.badge-info { background-color: var(--info); color: white; }

.alert-item-details {
    flex: 1;
}

.alert-item-details h6 {
    margin: 0 0 4px 0;
    font-size: 14px;
    font-weight: 600;
}

.alert-item-details p {
    margin: 0 0 4px 0;
    font-size: 12px;
    color: var(--gray);
}

.alert-item-details small {
    font-size: 11px;
    color: var(--gray);
    display: flex;
    align-items: center;
    gap: 4px;
}

.no-alerts {
    text-align: center;
    padding: 40px 20px;
    color: var(--gray);
}

.no-alerts i {
    font-size: 32px;
    margin-bottom: 12px;
    display: block;
}

.no-alerts p {
    margin: 0;
    font-size: 14px;
}

/* Statuts planification */
.planning-item {
    margin-bottom: 20px;
}

.planning-item:last-child {
    margin-bottom: 0;
}

.planning-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    font-size: 14px;
}

.planning-count {
    font-weight: 600;
    color: var(--dark);
}

.progress-container {
    height: 10px;
    background-color: var(--border-color);
    border-radius: 5px;
    overflow: hidden;
}

/* Actions rapides */
.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 16px;
}

.btn-action {
    padding: 12px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s;
    font-size: 14px;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.btn-action-primary {
    background-color: var(--primary-light);
    color: var(--primary);
}

.btn-action-success {
    background-color: var(--success-light);
    color: var(--success);
}

.btn-action-warning {
    background-color: var(--warning-light);
    color: #856404;
}

.btn-action-danger {
    background-color: var(--danger-light);
    color: var(--danger);
}

.last-update {
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--gray);
}

/* Notifications */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 16px 20px;
    border-radius: 6px;
    background: var(--white);
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 300px;
    max-width: 400px;
}

.notification.show {
    transform: translateX(0);
}

.notification-success {
    border-left: 4px solid var(--success);
    background-color: var(--success-light);
    color: var(--success);
}

.notification-info {
    border-left: 4px solid var(--info);
    background-color: rgba(23, 162, 184, 0.1);
    color: var(--info);
}

.notification-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: inherit;
    padding: 0;
    margin-left: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .operations-dashboard {
        padding: 12px;
    }
    
    .header-content {
        flex-direction: column;
    }
    
    .filters-container {
        width: 100%;
        justify-content: flex-start;
    }
    
    .kpis-container,
    .charts-container,
    .planning-container {
        grid-template-columns: 1fr;
    }
    
    .chart-card {
        min-width: 100%;
    }
    
    .gauge-container {
        width: 150px;
        height: 75px;
    }
    
    .gauge-center {
        width: 105px;
        height: 52.5px;
        left: 22.5px;
    }
    
    .gauge-text {
        font-size: 20px;
    }
    
    .notification {
        left: 12px;
        right: 12px;
        min-width: auto;
        max-width: none;
    }
}

@media (max-width: 480px) {
    .dashboard-title {
        font-size: 20px;
    }
    
    .kpi-value {
        font-size: 24px;
    }
    
    .card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .card-title,
    .chart-filter {
        width: 100%;
    }
}
</style>
@endsection