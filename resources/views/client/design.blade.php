@extends('layouts.clients')

@section('title', 'Opérations - Conception & Développement')

@section('content')
<div class="design-development-container">
    <!-- En-tête -->
    <div class="page-header">
        <div class="header-main">
            <h1 class="page-title">Conception & Développement (8.3)</h1>
            <p class="page-subtitle">Suivi des projets et revues de conception</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary btn-sm" id="newProjectBtn">
                <i class="fas fa-plus"></i> Nouveau
            </button>
            <button class="btn btn-outline-secondary btn-sm" id="reportBtn">
                <i class="fas fa-chart-pie"></i>
            </button>
        </div>
    </div>

    <!-- Tabs phases -->
    <div class="phase-tabs-container">
        <div class="tabs-scroll">
            <button class="phase-tab active" data-phase="all">Tous</button>
            <button class="phase-tab" data-phase="initiation">Initiation</button>
            <button class="phase-tab" data-phase="planning">Planification</button>
            <button class="phase-tab" data-phase="execution">Exécution</button>
            <button class="phase-tab" data-phase="verification">Vérification</button>
            <button class="phase-tab" data-phase="validation">Validation</button>
            <button class="phase-tab" data-phase="closed">Clôturés</button>
        </div>
    </div>

    <!-- Stats rapides -->
    <div class="quick-stats">
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value" id="activeProjects">12</span>
                <span class="stat-label">Actifs</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-flag-checkered"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value" id="completedMilestones">48</span>
                <span class="stat-label">Jalons</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value" id="delayedProjects">3</span>
                <span class="stat-label">Retards</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value" id="pendingReviews">7</span>
                <span class="stat-label">Revues</span>
            </div>
        </div>
    </div>

    <!-- Barre de recherche et filtres -->
    <div class="search-filters">
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" id="projectSearch" placeholder="Rechercher un projet...">
        </div>
        <div class="filters-container">
            <select id="statusFilter" class="filter-select">
                <option value="all">Statut</option>
                <option value="on-track">Dans les temps</option>
                <option value="at-risk">À risque</option>
                <option value="delayed">En retard</option>
            </select>
            <select id="priorityFilter" class="filter-select">
                <option value="all">Priorité</option>
                <option value="critical">Critique</option>
                <option value="high">Haute</option>
                <option value="medium">Moyenne</option>
            </select>
        </div>
    </div>

    <!-- Tableau compact -->
    <div class="table-container">
        <table class="compact-table">
            <thead>
                <tr>
                    <th width="40"></th>
                    <th>Projet</th>
                    <th width="120">Responsable</th>
                    <th width="100">Phase</th>
                    <th width="120">Progression</th>
                    <th width="80">Jalons</th>
                    <th width="100">Actions</th>
                </tr>
            </thead>
            <tbody id="projectsTableBody">
                <!-- Données chargées dynamiquement -->
            </tbody>
        </table>
    </div>

    <!-- Widgets compactes -->
    <div class="compact-widgets">
        <div class="widget">
            <div class="widget-header">
                <h3><i class="fas fa-exclamation-circle"></i> En retard</h3>
            </div>
            <div class="widget-body">
                <div class="delayed-list" id="delayedProjectsList"></div>
            </div>
        </div>
        
        <div class="widget">
            <div class="widget-header">
                <h3><i class="fas fa-calendar-alt"></i> Revues à venir</h3>
            </div>
            <div class="widget-body">
                <div class="reviews-list" id="upcomingReviewsList"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal projet -->
<div id="projectModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Nouveau Projet</h3>
            <button class="modal-close" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="projectForm">
                <!-- Onglets compacts -->
                <div class="modal-tabs">
                    <button class="modal-tab-btn active" data-tab="info">Info</button>
                    <button class="modal-tab-btn" data-tab="planning">Plan</button>
                    <button class="modal-tab-btn" data-tab="reviews">Revues</button>
                    <button class="modal-tab-btn" data-tab="documents">Docs</button>
                </div>
                
                <!-- Onglet Info -->
                <div class="tab-content active" id="tab-info">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Référence *</label>
                            <input type="text" id="projectRef" required>
                        </div>
                        <div class="form-group">
                            <label>Nom *</label>
                            <input type="text" id="projectName" required>
                        </div>
                        <div class="form-group">
                            <label>Catégorie *</label>
                            <select id="projectCategory" required>
                                <option value="">Sélectionner</option>
                                <option value="new-product">Nouveau produit</option>
                                <option value="improvement">Amélioration</option>
                                <option value="rnd">R&D</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Priorité *</label>
                            <select id="projectPriority" required>
                                <option value="">Sélectionner</option>
                                <option value="critical">Critique</option>
                                <option value="high">Haute</option>
                                <option value="medium">Moyenne</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date début *</label>
                            <input type="date" id="startDate" required>
                        </div>
                        <div class="form-group">
                            <label>Date fin *</label>
                            <input type="date" id="endDate" required>
                        </div>
                        <div class="form-group span-2">
                            <label>Responsable *</label>
                            <input type="text" id="projectManager" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="projectDescription" rows="2"></textarea>
                    </div>
                </div>
                
                <!-- Onglet Planification -->
                <div class="tab-content" id="tab-planning">
                    <div class="form-group">
                        <label>Jalons principaux</label>
                        <div class="milestones-list">
                            <div class="milestone-item">
                                <input type="text" placeholder="Nom du jalon">
                                <input type="date" placeholder="Date">
                            </div>
                            <button type="button" class="btn-add-milestone">
                                <i class="fas fa-plus"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Onglet Revues -->
                <div class="tab-content" id="tab-reviews">
                    <div class="reviews-checklist">
                        <div class="check-item">
                            <input type="checkbox" id="review1">
                            <label for="review1">Revue initiale de conception</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" id="review2">
                            <label for="review2">Revue détaillée</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" id="review3">
                            <label for="review3">Revue finale</label>
                        </div>
                    </div>
                </div>
                
                <!-- Onglet Documents -->
                <div class="tab-content" id="tab-documents">
                    <div class="documents-list">
                        <div class="doc-item">
                            <i class="fas fa-file-alt"></i>
                            <span>Plan de conception</span>
                            <button class="btn-upload">Upload</button>
                        </div>
                        <div class="doc-item">
                            <i class="fas fa-file-signature"></i>
                            <span>Comptes-rendus</span>
                            <button class="btn-upload">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" id="cancelBtn">Annuler</button>
            <button class="btn btn-primary btn-sm" id="saveProjectBtn">Créer</button>
        </div>
    </div>
</div>

<script>
// Données de test
const testData = {
    projects: [
        {
            id: 1,
            ref: 'PD-2023-001',
            name: 'Nouveau système filtration',
            manager: 'M. Dubois',
            phase: 'execution',
            progress: 65,
            milestones: '4/6',
            startDate: '2023-09-01',
            endDate: '2023-12-15',
            status: 'on-track',
            priority: 'high',
            category: 'new-product'
        },
        {
            id: 2,
            ref: 'PD-2023-002',
            name: 'Amélioration interface',
            manager: 'J. Martin',
            phase: 'verification',
            progress: 85,
            milestones: '5/6',
            startDate: '2023-08-15',
            endDate: '2023-11-30',
            status: 'at-risk',
            priority: 'medium',
            category: 'improvement'
        },
        {
            id: 3,
            ref: 'PD-2023-003',
            name: 'Prototype robotique',
            manager: 'P. Bernard',
            phase: 'validation',
            progress: 90,
            milestones: '6/7',
            startDate: '2023-07-01',
            endDate: '2023-10-31',
            status: 'delayed',
            priority: 'critical',
            category: 'rnd'
        },
        {
            id: 4,
            ref: 'PD-2023-004',
            name: 'Système IoT',
            manager: 'A. Laurent',
            phase: 'planning',
            progress: 30,
            milestones: '2/5',
            startDate: '2023-10-01',
            endDate: '2024-02-28',
            status: 'on-track',
            priority: 'high',
            category: 'new-product'
        }
    ],
    
    delayedProjects: [
        { id: 3, ref: 'PD-2023-003', name: 'Prototype robotique', delay: 15 },
        { id: 5, ref: 'PD-2023-005', name: 'Application mobile', delay: 8 }
    ],
    
    upcomingReviews: [
        { project: 'PD-2023-001', type: 'Revue conception', date: '2023-10-25' },
        { project: 'PD-2023-002', type: 'Revue vérification', date: '2023-10-28' }
    ]
};

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    loadProjectsTable();
    loadWidgets();
    setupEventListeners();
    updateStats();
});

function setupEventListeners() {
    document.getElementById('newProjectBtn').addEventListener('click', openNewProjectModal);
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('cancelBtn').addEventListener('click', closeModal);
    document.getElementById('saveProjectBtn').addEventListener('click', saveProject);
    
    // Tabs phases
    document.querySelectorAll('.phase-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.phase-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            filterByPhase(this.dataset.phase);
        });
    });
    
    // Modal tabs
    document.querySelectorAll('.modal-tab-btn').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.modal-tab-btn').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            document.getElementById(`tab-${this.dataset.tab}`).classList.add('active');
        });
    });
    
    // Filtres
    document.getElementById('projectSearch').addEventListener('input', filterProjects);
    document.getElementById('statusFilter').addEventListener('change', filterProjects);
    document.getElementById('priorityFilter').addEventListener('change', filterProjects);
}

function loadProjectsTable() {
    const tbody = document.getElementById('projectsTableBody');
    tbody.innerHTML = '';
    
    testData.projects.forEach(project => {
        const row = createProjectRow(project);
        tbody.appendChild(row);
    });
}

function createProjectRow(project) {
    const row = document.createElement('tr');
    
    // Phase badge
    let phaseClass = '';
    let phaseText = '';
    switch(project.phase) {
        case 'initiation': phaseClass = 'phase-init'; phaseText = 'Init'; break;
        case 'planning': phaseClass = 'phase-plan'; phaseText = 'Plan'; break;
        case 'execution': phaseClass = 'phase-exec'; phaseText = 'Exec'; break;
        case 'verification': phaseClass = 'phase-verif'; phaseText = 'Verif'; break;
        case 'validation': phaseClass = 'phase-valid'; phaseText = 'Valid'; break;
        case 'closed': phaseClass = 'phase-closed'; phaseText = 'Clos'; break;
    }
    
    // Status color
    let progressColor = '';
    switch(project.status) {
        case 'on-track': progressColor = 'progress-success'; break;
        case 'at-risk': progressColor = 'progress-warning'; break;
        case 'delayed': progressColor = 'progress-danger'; break;
    }
    
    row.innerHTML = `
        <td>
            <input type="checkbox" class="row-checkbox">
        </td>
        <td>
            <div class="project-info">
                <div class="project-ref">${project.ref}</div>
                <div class="project-name">${project.name}</div>
                <div class="project-dates">
                    ${formatDateShort(project.startDate)} - ${formatDateShort(project.endDate)}
                </div>
            </div>
        </td>
        <td>
            <div class="project-manager">${project.manager}</div>
        </td>
        <td>
            <span class="phase-badge ${phaseClass}">${phaseText}</span>
        </td>
        <td>
            <div class="progress-container">
                <div class="progress-bar ${progressColor}" style="width: ${project.progress}%"></div>
                <span class="progress-text">${project.progress}%</span>
            </div>
        </td>
        <td>
            <div class="milestones">${project.milestones}</div>
        </td>
        <td>
            <div class="action-buttons">
                <button class="btn-icon" title="Voir">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn-icon" title="Éditer">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </td>
    `;
    
    return row;
}

function formatDateShort(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', { month: 'short', day: 'numeric' });
}

function loadWidgets() {
    // Projets en retard
    const delayedList = document.getElementById('delayedProjectsList');
    delayedList.innerHTML = '';
    testData.delayedProjects.forEach(project => {
        const item = document.createElement('div');
        item.className = 'delayed-item';
        item.innerHTML = `
            <div class="delayed-info">
                <strong>${project.ref}</strong>
                <small>${project.name}</small>
            </div>
            <div class="delayed-days">+${project.delay}j</div>
        `;
        delayedList.appendChild(item);
    });
    
    // Revues à venir
    const reviewsList = document.getElementById('upcomingReviewsList');
    reviewsList.innerHTML = '';
    testData.upcomingReviews.forEach(review => {
        const item = document.createElement('div');
        item.className = 'review-item';
        item.innerHTML = `
            <div class="review-project">${review.project}</div>
            <div class="review-date">${formatDateShort(review.date)}</div>
        `;
        reviewsList.appendChild(item);
    });
}

function updateStats() {
    document.getElementById('activeProjects').textContent = testData.projects.length;
    document.getElementById('completedMilestones').textContent = '48';
    document.getElementById('delayedProjects').textContent = testData.delayedProjects.length;
    document.getElementById('pendingReviews').textContent = testData.upcomingReviews.length;
}

function filterByPhase(phase) {
    console.log('Filtre phase:', phase);
}

function filterProjects() {
    const search = document.getElementById('projectSearch').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    const priority = document.getElementById('priorityFilter').value;
    
    console.log('Filtres:', { search, status, priority });
}

function openNewProjectModal() {
    const modal = document.getElementById('projectModal');
    document.getElementById('modalTitle').textContent = 'Nouveau Projet';
    setDefaultDates();
    modal.style.display = 'block';
}

function setDefaultDates() {
    const today = new Date();
    const nextMonth = new Date();
    nextMonth.setMonth(nextMonth.getMonth() + 3);
    
    document.getElementById('startDate').value = today.toISOString().split('T')[0];
    document.getElementById('endDate').value = nextMonth.toISOString().split('T')[0];
}

function closeModal() {
    document.getElementById('projectModal').style.display = 'none';
}

function saveProject() {
    // Validation simple
    const ref = document.getElementById('projectRef').value;
    const name = document.getElementById('projectName').value;
    
    if (!ref || !name) {
        alert('Veuillez remplir les champs obligatoires');
        return;
    }
    
    // Simuler l'ajout
    const newProject = {
        id: testData.projects.length + 1,
        ref: ref,
        name: name,
        manager: document.getElementById('projectManager').value,
        phase: 'initiation',
        progress: 0,
        milestones: '0/0',
        startDate: document.getElementById('startDate').value,
        endDate: document.getElementById('endDate').value,
        status: 'on-track',
        priority: document.getElementById('projectPriority').value,
        category: document.getElementById('projectCategory').value
    };
    
    testData.projects.unshift(newProject);
    loadProjectsTable();
    updateStats();
    closeModal();
    showNotification('Projet créé avec succès');
}

function showNotification(message) {
    // Simple notification
    alert(message);
}
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
    --light: #f8f9fa;
    --dark: #343a40;
    --gray: #6c757d;
    --gray-light: #e9ecef;
    --border: #dee2e6;
    --shadow: 0 1px 3px rgba(0,0,0,0.1);
}

/* Reset et base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-size: 14px;
    line-height: 1.4;
    color: var(--dark);
}

/* Conteneur principal */
.design-development-container {
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

.btn-outline-secondary {
    background: white;
    color: var(--secondary);
    border: 1px solid var(--secondary);
}

.btn-outline-secondary:hover {
    background: var(--secondary);
    color: white;
}

/* Tabs phases */
.phase-tabs-container {
    margin-bottom: 16px;
    overflow-x: auto;
}

.tabs-scroll {
    display: flex;
    gap: 4px;
    padding-bottom: 4px;
}

.phase-tab {
    padding: 8px 12px;
    border: none;
    background: var(--gray-light);
    border-radius: 4px;
    color: var(--gray);
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s;
}

.phase-tab:hover {
    background: var(--border);
    color: var(--dark);
}

.phase-tab.active {
    background: var(--primary);
    color: white;
}

/* Stats rapides */
.quick-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 12px;
    margin-bottom: 16px;
}

.stat-item {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.stat-icon {
    width: 36px;
    height: 36px;
    border-radius: 6px;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-size: 20px;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 11px;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Barre de recherche et filtres */
.search-filters {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.search-container {
    flex: 1;
    min-width: 200px;
    position: relative;
}

.search-container i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
    font-size: 13px;
}

.search-container input {
    width: 100%;
    padding: 8px 10px 8px 32px;
    border: 1px solid var(--border);
    border-radius: 4px;
    font-size: 13px;
}

.filters-container {
    display: flex;
    gap: 8px;
}

.filter-select {
    padding: 8px 10px;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: white;
    color: var(--dark);
    font-size: 13px;
    min-width: 100px;
}

/* Tableau */
.table-container {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    overflow: hidden;
    margin-bottom: 16px;
    overflow-x: auto;
}

.compact-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

.compact-table thead {
    background: var(--light);
}

.compact-table th {
    padding: 10px 12px;
    text-align: left;
    font-weight: 600;
    color: var(--dark);
    font-size: 12px;
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
}

.compact-table td {
    padding: 10px 12px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.compact-table tbody tr:hover {
    background: var(--light);
}

/* Checkbox */
.row-checkbox {
    width: 16px;
    height: 16px;
}

/* Infos projet */
.project-info {
    min-width: 200px;
}

.project-ref {
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 2px;
}

.project-name {
    font-size: 12px;
    color: var(--dark);
    margin-bottom: 4px;
}

.project-dates {
    font-size: 11px;
    color: var(--gray);
}

.project-manager {
    font-size: 13px;
    white-space: nowrap;
}

/* Badges phase */
.phase-badge {
    padding: 4px 8px;
    border-radius: 3px;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
    display: inline-block;
    min-width: 50px;
}

.phase-init { background: #e3f2fd; color: #1565c0; }
.phase-plan { background: #f3e5f5; color: #7b1fa2; }
.phase-exec { background: #e8f5e9; color: #2e7d32; }
.phase-verif { background: #fff3e0; color: #ef6c00; }
.phase-valid { background: #e0f7fa; color: #006064; }
.phase-closed { background: #f5f5f5; color: #616161; }

/* Barre de progression */
.progress-container {
    position: relative;
    height: 20px;
    background: var(--gray-light);
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    border-radius: 10px;
    transition: width 0.3s;
}

.progress-success { background: var(--success); }
.progress-warning { background: var(--warning); }
.progress-danger { background: var(--danger); }

.progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 10px;
    font-weight: 600;
    color: white;
    z-index: 1;
}

/* Jalons */
.milestones {
    font-size: 13px;
    font-weight: 500;
    text-align: center;
}

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 4px;
}

.btn-icon {
    width: 28px;
    height: 28px;
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

.btn-icon:hover i.fa-eye { color: var(--primary); }
.btn-icon:hover i.fa-edit { color: var(--warning); }

/* Widgets */
.compact-widgets {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 16px;
    margin-top: 16px;
}

.widget {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    overflow: hidden;
}

.widget-header {
    padding: 12px;
    background: var(--light);
    border-bottom: 1px solid var(--border);
}

.widget-header h3 {
    font-size: 14px;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.widget-body {
    padding: 12px;
}

/* Listes dans widgets */
.delayed-list,
.reviews-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.delayed-item,
.review-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px;
    border-radius: 4px;
    background: var(--light);
}

.delayed-info strong,
.review-project {
    font-size: 12px;
    font-weight: 600;
    display: block;
    margin-bottom: 2px;
}

.delayed-info small {
    font-size: 11px;
    color: var(--gray);
}

.delayed-days {
    font-size: 12px;
    font-weight: 600;
    color: var(--danger);
    background: var(--danger-light);
    padding: 2px 6px;
    border-radius: 3px;
}

.review-date {
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
    max-width: 600px;
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

/* Modal tabs */
.modal-tabs {
    display: flex;
    gap: 4px;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 4px;
}

.modal-tab-btn {
    padding: 8px 16px;
    border: none;
    background: none;
    color: var(--gray);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border-radius: 4px 4px 0 0;
    transition: all 0.2s;
}

.modal-tab-btn:hover {
    background: var(--light);
    color: var(--dark);
}

.modal-tab-btn.active {
    background: var(--primary);
    color: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

/* Form grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

/* Milestones */
.milestones-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.milestone-item {
    display: flex;
    gap: 8px;
}

.milestone-item input {
    flex: 1;
}

.btn-add-milestone {
    padding: 8px 12px;
    border: 1px dashed var(--border);
    background: none;
    color: var(--gray);
    border-radius: 4px;
    cursor: pointer;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
    align-self: flex-start;
}

.btn-add-milestone:hover {
    border-color: var(--primary);
    color: var(--primary);
}

/* Checklist */
.reviews-checklist {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.check-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.check-item input[type="checkbox"] {
    width: 16px;
    height: 16px;
}

.check-item label {
    font-size: 13px;
    cursor: pointer;
}

/* Documents */
.documents-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.doc-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border: 1px solid var(--border);
    border-radius: 4px;
}

.doc-item i {
    color: var(--gray);
    font-size: 16px;
}

.doc-item span {
    flex: 1;
    font-size: 13px;
}

.btn-upload {
    padding: 4px 8px;
    border: 1px solid var(--border);
    background: white;
    color: var(--gray);
    border-radius: 3px;
    font-size: 11px;
    cursor: pointer;
}

.btn-upload:hover {
    border-color: var(--primary);
    color: var(--primary);
}

/* Responsive */
@media (max-width: 768px) {
    .design-development-container {
        padding: 12px;
    }
    
    .page-header {
        flex-direction: column;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .quick-stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .search-filters {
        flex-direction: column;
    }
    
    .filters-container {
        width: 100%;
    }
    
    .filter-select {
        flex: 1;
    }
    
    .compact-widgets {
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
}

@media (max-width: 480px) {
    .quick-stats {
        grid-template-columns: 1fr;
    }
    
    .stat-item {
        padding: 10px;
    }
    
    .modal-tabs {
        overflow-x: auto;
        flex-wrap: nowrap;
    }
    
    .modal-tab-btn {
        white-space: nowrap;
    }
}
</style>
@endsection