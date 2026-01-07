@extends('layouts.clients')

@section('title', 'Opérations - Libération Produits')

@section('content')
<div class="release-container">
    <!-- En-tête -->
    <div class="page-header">
        <div class="header-main">
            <h1 class="page-title">Libération Produits</h1>
            <p class="page-subtitle">Checklist de vérification finale et autorisation de livraison</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary btn-sm" id="newReleaseBtn">
                <i class="fas fa-check-circle"></i> Nouvelle libération
            </button>
            <button class="btn btn-outline-secondary btn-sm" id="batchReleaseBtn">
                <i class="fas fa-layer-group"></i> Libération groupée
            </button>
        </div>
    </div>

    <!-- KPIs -->
    <div class="kpi-cards">
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="pendingCount">8</div>
                <div class="kpi-label">En attente</div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="approvedCount">142</div>
                <div class="kpi-label">Approuvés</div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="rejectedCount">6</div>
                <div class="kpi-label">Rejetés</div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-value" id="blockedCount">3</div>
                <div class="kpi-label">Bloqués</div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="filters-section">
        <div class="filter-row">
            <div class="filter-group">
                <select id="statusFilter" class="filter-select">
                    <option value="all">Tous statuts</option>
                    <option value="pending">En attente</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                    <option value="blocked">Bloqué</option>
                </select>
                
                <select id="productFilter" class="filter-select">
                    <option value="all">Tous produits</option>
                    <option value="prod_a">Produit A</option>
                    <option value="prod_b">Produit B</option>
                    <option value="prod_c">Produit C</option>
                </select>
                
                <input type="date" id="dateFilter" class="filter-select" value="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Rechercher lot, commande...">
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <!-- Tableau des libérations -->
        <div class="table-section">
            <div class="table-header">
                <h3>Libérations en attente de validation</h3>
                <div class="table-actions">
                    <button class="btn-icon" id="exportBtn" title="Exporter">
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
                            <th width="40">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Lot / Commande</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Client</th>
                            <th>Date Prod.</th>
                            <th>Contrôle final</th>
                            <th>Statut</th>
                            <th width="100">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="releaseTableBody">
                        <!-- Données chargées dynamiquement -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Panneau latéral -->
        <div class="sidebar">
            <!-- Checklist rapide -->
            <div class="widget">
                <div class="widget-header">
                    <h4><i class="fas fa-clipboard-list"></i> Checklist</h4>
                </div>
                <div class="widget-body">
                    <div class="checklist-items">
                        <div class="check-item">
                            <input type="checkbox" id="check1">
                            <label for="check1">Vérification exigences client</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" id="check2">
                            <label for="check2">Résultats contrôles conformes</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" id="check3">
                            <label for="check3">Documentation complète</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" id="check4">
                            <label for="check4">Traçabilité assurée</label>
                        </div>
                        <div class="check-item">
                            <input type="checkbox" id="check5">
                            <label for="check5">Emballage conforme</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistiques du jour -->
            <div class="widget">
                <div class="widget-header">
                    <h4><i class="fas fa-chart-bar"></i> Aujourd'hui</h4>
                </div>
                <div class="widget-body">
                    <div class="today-stats">
                        <div class="stat-row">
                            <span class="stat-label">Libérations:</span>
                            <span class="stat-value">24</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Rejets:</span>
                            <span class="stat-value">2</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">En attente:</span>
                            <span class="stat-value">8</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alertes -->
            <div class="widget">
                <div class="widget-header">
                    <h4><i class="fas fa-bell"></i> Alertes</h4>
                </div>
                <div class="widget-body">
                    <div class="alerts-list" id="releaseAlerts">
                        <!-- Alertes chargées dynamiquement -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal libération -->
<div id="releaseModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Autorisation de Libération</h3>
            <button class="modal-close" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="releaseForm">
                <!-- En-tête -->
                <div class="release-header">
                    <div class="release-info">
                        <div class="info-row">
                            <span class="label">Lot/Commande:</span>
                            <span class="value" id="releaseRef">LOT-2023-10-001</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Produit:</span>
                            <span class="value" id="releaseProduct">Produit A - REF001</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Quantité:</span>
                            <span class="value" id="releaseQuantity">250 unités</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Client:</span>
                            <span class="value" id="releaseClient">ABC Industries</span>
                        </div>
                    </div>
                    <div class="release-status">
                        <span class="status-badge pending">En attente</span>
                    </div>
                </div>
                
                <!-- Section 1: Vérification exigences client (8.2) -->
                <div class="form-section">
                    <h4><i class="fas fa-file-contract"></i> 1. Vérification des exigences client</h4>
                    <div class="checklist">
                        <div class="check-item">
                            <input type="radio" name="requirementsCheck" id="reqYes" value="yes" required>
                            <label for="reqYes">Toutes les exigences client sont satisfaites</label>
                        </div>
                        <div class="check-item">
                            <input type="radio" name="requirementsCheck" id="reqNo" value="no">
                            <label for="reqNo">Certaines exigences ne sont pas satisfaites</label>
                        </div>
                    </div>
                    
                    <div class="form-group" id="requirementsComment" style="display: none;">
                        <label>Commentaire:</label>
                        <textarea rows="2" placeholder="Préciser les exigences non satisfaites..."></textarea>
                    </div>
                </div>
                
                <!-- Section 2: Contrôle final (8.6) -->
                <div class="form-section">
                    <h4><i class="fas fa-search"></i> 2. Résultat du contrôle final</h4>
                    <div class="checklist">
                        <div class="check-item">
                            <input type="radio" name="finalCheck" id="finalConforme" value="conforme" required>
                            <label for="finalConforme">Conforme - Le produit peut être libéré</label>
                        </div>
                        <div class="check-item">
                            <input type="radio" name="finalCheck" id="finalNonConforme" value="non-conforme">
                            <label for="finalNonConforme">Non conforme - Doit être traité</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Rapport de contrôle:</label>
                        <textarea rows="2" placeholder="Résumé des résultats de contrôle..."></textarea>
                    </div>
                </div>
                
                <!-- Section 3: Vérifications supplémentaires -->
                <div class="form-section">
                    <h4><i class="fas fa-clipboard-check"></i> 3. Vérifications complémentaires</h4>
                    <div class="verification-grid">
                        <div class="verification-item">
                            <input type="checkbox" id="verif1">
                            <label for="verif1">Documents de traçabilité complets</label>
                        </div>
                        <div class="verification-item">
                            <input type="checkbox" id="verif2">
                            <label for="verif2">Emballage conforme aux spécifications</label>
                        </div>
                        <div class="verification-item">
                            <input type="checkbox" id="verif3">
                            <label for="verif3">Étiquetage correct et lisible</label>
                        </div>
                        <div class="verification-item">
                            <input type="checkbox" id="verif4">
                            <label for="verif4">Contrôle des quantités effectué</label>
                        </div>
                        <div class="verification-item">
                            <input type="checkbox" id="verif5">
                            <label for="verif5">Absence de dommages visibles</label>
                        </div>
                        <div class="verification-item">
                            <input type="checkbox" id="verif6">
                            <label for="verif6">Conformité réglementaire vérifiée</label>
                        </div>
                    </div>
                </div>
                
                <!-- Section 4: Décision et signature -->
                <div class="form-section">
                    <h4><i class="fas fa-user-check"></i> 4. Décision de libération</h4>
                    
                    <div class="decision-section">
                        <div class="form-group">
                            <label>Décision *</label>
                            <div class="decision-options">
                                <div class="decision-option">
                                    <input type="radio" name="decision" id="decisionApprove" value="approve" required>
                                    <label for="decisionApprove" class="decision-label approve">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Autoriser la libération</span>
                                        <small>Le produit est conforme et peut être livré</small>
                                    </label>
                                </div>
                                <div class="decision-option">
                                    <input type="radio" name="decision" id="decisionReject" value="reject">
                                    <label for="decisionReject" class="decision-label reject">
                                        <i class="fas fa-times-circle"></i>
                                        <span>Rejeter la libération</span>
                                        <small>Le produit n'est pas conforme</small>
                                    </label>
                                </div>
                                <div class="decision-option">
                                    <input type="radio" name="decision" id="decisionHold" value="hold">
                                    <label for="decisionHold" class="decision-label hold">
                                        <i class="fas fa-pause-circle"></i>
                                        <span>Mettre en attente</span>
                                        <small>Informations complémentaires requises</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="releaseComments">Commentaires justificatifs *</label>
                            <textarea id="releaseComments" rows="2" required placeholder="Justifier la décision prise..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="releaseSignatory">Nom du signataire *</label>
                            <input type="text" id="releaseSignatory" required placeholder="Nom et prénom">
                        </div>
                        
                        <div class="form-group">
                            <label for="releaseSignature">Signature électronique *</label>
                            <div class="signature-area">
                                <canvas id="signatureCanvas" width="400" height="100"></canvas>
                                <div class="signature-actions">
                                    <button type="button" class="btn-clear-signature">
                                        <i class="fas fa-eraser"></i> Effacer
                                    </button>
                                </div>
                                <input type="hidden" id="releaseSignature" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="approvalCheck" required>
                                Je certifie avoir effectué toutes les vérifications requises et valide cette autorisation de libération
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" id="cancelBtn">Annuler</button>
            <button class="btn btn-success btn-sm" id="saveDraftBtn">
                <i class="fas fa-save"></i> Enregistrer brouillon
            </button>
            <button class="btn btn-primary btn-sm" id="submitBtn" disabled>
                <i class="fas fa-check"></i> Valider la libération
            </button>
        </div>
    </div>
</div>

<!-- Modal dérogation -->
<div id="derogationModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Dérogation de libération</h3>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <form id="derogationForm">
                <div class="form-group">
                    <label>Motif de la dérogation *</label>
                    <textarea rows="3" required placeholder="Justifier la dérogation..."></textarea>
                </div>
                
                <div class="form-group">
                    <label>Niveau d'approbation requis *</label>
                    <select required>
                        <option value="">Sélectionner</option>
                        <option value="supervisor">Superviseur</option>
                        <option value="quality">Responsable qualité</option>
                        <option value="director">Directeur</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Conditions de livraison</label>
                    <textarea rows="2" placeholder="Conditions spécifiques..."></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
            <button class="btn btn-warning btn-sm" id="submitDerogationBtn">
                <i class="fas fa-exclamation-triangle"></i> Soumettre dérogation
            </button>
        </div>
    </div>
</div>

<script>
// Données de test
const releaseData = {
    releases: [
        {
            id: 1,
            ref: 'LOT-2023-10-001',
            product: 'Produit A',
            quantity: 250,
            client: 'ABC Industries',
            prodDate: '2023-10-24',
            finalCheck: 'pending',
            status: 'pending',
            priority: 'high'
        },
        {
            id: 2,
            ref: 'CMD-2023-0456',
            product: 'Produit B',
            quantity: 180,
            client: 'Techno Solutions',
            prodDate: '2023-10-23',
            finalCheck: 'conforme',
            status: 'approved',
            priority: 'medium'
        },
        {
            id: 3,
            ref: 'LOT-2023-10-003',
            product: 'Produit C',
            quantity: 320,
            client: 'Global Corp',
            prodDate: '2023-10-25',
            finalCheck: 'non-conforme',
            status: 'blocked',
            priority: 'high'
        },
        {
            id: 4,
            ref: 'LOT-2023-10-004',
            product: 'Produit A',
            quantity: 150,
            client: 'Manufacturing Plus',
            prodDate: '2023-10-25',
            finalCheck: 'pending',
            status: 'pending',
            priority: 'low'
        }
    ],
    
    kpis: {
        pending: 8,
        approved: 142,
        rejected: 6,
        blocked: 3
    },
    
    alerts: [
        { id: 1, type: 'danger', message: 'Lot LOT-2023-10-003 bloqué depuis 48h', time: '10:30' },
        { id: 2, type: 'warning', message: '2 libérations en attente > 24h', time: '09:15' },
        { id: 3, type: 'info', message: 'Contrôle qualité programmé à 14h', time: '08:45' }
    ]
};

// Variables globales
let signatureCanvas = null;
let isDrawing = false;

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    loadReleaseTable();
    loadAlerts();
    updateKPIs();
    setupEventListeners();
    initSignatureCanvas();
});

function setupEventListeners() {
    // Boutons d'action
    document.getElementById('newReleaseBtn').addEventListener('click', openReleaseModal);
    document.getElementById('batchReleaseBtn').addEventListener('click', openBatchRelease);
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('cancelBtn').addEventListener('click', closeModal);
    document.getElementById('saveDraftBtn').addEventListener('click', saveDraft);
    document.getElementById('submitBtn').addEventListener('click', submitRelease);
    
    // Filtres
    document.getElementById('statusFilter').addEventListener('change', filterReleases);
    document.getElementById('productFilter').addEventListener('change', filterReleases);
    document.getElementById('dateFilter').addEventListener('change', filterReleases);
    document.getElementById('searchInput').addEventListener('input', filterReleases);
    
    // Export/Refresh
    document.getElementById('exportBtn').addEventListener('click', exportData);
    document.getElementById('refreshBtn').addEventListener('click', refreshData);
    
    // Sélection multiple
    document.getElementById('selectAll').addEventListener('change', toggleSelectAll);
    
    // Validation formulaire
    document.getElementById('releaseForm').addEventListener('input', validateReleaseForm);
    document.getElementById('approvalCheck').addEventListener('change', validateReleaseForm);
    
    // Gestion dérogation
    const reqNo = document.getElementById('reqNo');
    const finalNonConforme = document.getElementById('finalNonConforme');
    
    reqNo.addEventListener('change', function() {
        document.getElementById('requirementsComment').style.display = this.checked ? 'block' : 'none';
        checkReleaseBlock();
    });
    
    finalNonConforme.addEventListener('change', function() {
        checkReleaseBlock();
    });
    
    // Options décision
    const decisionRadios = document.querySelectorAll('input[name="decision"]');
    decisionRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            updateSubmitButton(this.value);
        });
    });
}

function loadReleaseTable() {
    const tbody = document.getElementById('releaseTableBody');
    tbody.innerHTML = '';
    
    releaseData.releases.forEach(release => {
        const row = createReleaseRow(release);
        tbody.appendChild(row);
    });
}

function createReleaseRow(release) {
    const row = document.createElement('tr');
    
    // Status class
    let statusClass = '';
    let statusText = '';
    let statusIcon = '';
    
    switch(release.status) {
        case 'pending':
            statusClass = 'status-pending';
            statusText = 'En attente';
            statusIcon = 'fa-clock';
            break;
        case 'approved':
            statusClass = 'status-approved';
            statusText = 'Approuvé';
            statusIcon = 'fa-check-circle';
            break;
        case 'rejected':
            statusClass = 'status-rejected';
            statusText = 'Rejeté';
            statusIcon = 'fa-times-circle';
            break;
        case 'blocked':
            statusClass = 'status-blocked';
            statusText = 'Bloqué';
            statusIcon = 'fa-ban';
            break;
    }
    
    // Final check
    let checkClass = '';
    let checkText = '';
    
    switch(release.finalCheck) {
        case 'pending':
            checkClass = 'check-pending';
            checkText = 'À faire';
            break;
        case 'conforme':
            checkClass = 'check-conforme';
            checkText = 'Conforme';
            break;
        case 'non-conforme':
            checkClass = 'check-nonconforme';
            checkText = 'Non conforme';
            break;
    }
    
    row.innerHTML = `
        <td>
            <input type="checkbox" class="row-checkbox" data-id="${release.id}">
        </td>
        <td>
            <div class="ref-cell">
                <strong>${release.ref}</strong>
                ${release.priority === 'high' ? '<span class="priority-high">!</span>' : ''}
            </div>
        </td>
        <td>${release.product}</td>
        <td>${release.quantity}</td>
        <td>${release.client}</td>
        <td>${formatDateShort(release.prodDate)}</td>
        <td>
            <span class="check-badge ${checkClass}">${checkText}</span>
        </td>
        <td>
            <span class="status-badge ${statusClass}">
                <i class="fas ${statusIcon}"></i> ${statusText}
            </span>
        </td>
        <td>
            <div class="action-buttons">
                <button class="btn-icon btn-review" data-id="${release.id}" title="Vérifier">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn-icon btn-release" data-id="${release.id}" title="Libérer">
                    <i class="fas fa-check"></i>
                </button>
                ${release.status === 'blocked' ? '<button class="btn-icon btn-derogation" data-id="' + release.id + '" title="Dérogation"><i class="fas fa-exclamation-triangle"></i></button>' : ''}
            </div>
        </td>
    `;
    
    // Ajouter les écouteurs
    const reviewBtn = row.querySelector('.btn-review');
    const releaseBtn = row.querySelector('.btn-release');
    const derogationBtn = row.querySelector('.btn-derogation');
    
    reviewBtn.addEventListener('click', () => reviewRelease(release.id));
    releaseBtn.addEventListener('click', () => processRelease(release.id));
    if (derogationBtn) {
        derogationBtn.addEventListener('click', () => openDerogationModal(release.id));
    }
    
    return row;
}

function formatDateShort(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit' });
}

function loadAlerts() {
    const alertsList = document.getElementById('releaseAlerts');
    alertsList.innerHTML = '';
    
    releaseData.alerts.forEach(alert => {
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
    document.getElementById('pendingCount').textContent = releaseData.kpis.pending;
    document.getElementById('approvedCount').textContent = releaseData.kpis.approved;
    document.getElementById('rejectedCount').textContent = releaseData.kpis.rejected;
    document.getElementById('blockedCount').textContent = releaseData.kpis.blocked;
}

function filterReleases() {
    const status = document.getElementById('statusFilter').value;
    const product = document.getElementById('productFilter').value;
    const date = document.getElementById('dateFilter').value;
    const search = document.getElementById('searchInput').value.toLowerCase();
    
    console.log('Filtres:', { status, product, date, search });
    // Implémenter le filtrage réel ici
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function initSignatureCanvas() {
    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    signatureCanvas = ctx;
    
    // Configuration du canvas
    ctx.strokeStyle = '#007bff';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    
    // Événements de dessin
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Pour mobile
    canvas.addEventListener('touchstart', startDrawingTouch);
    canvas.addEventListener('touchmove', drawTouch);
    canvas.addEventListener('touchend', stopDrawing);
    
    // Bouton effacer
    document.querySelector('.btn-clear-signature').addEventListener('click', clearSignature);
}

function startDrawing(e) {
    isDrawing = true;
    const canvas = e.target;
    const rect = canvas.getBoundingClientRect();
    signatureCanvas.beginPath();
    signatureCanvas.moveTo(
        e.clientX - rect.left,
        e.clientY - rect.top
    );
}

function draw(e) {
    if (!isDrawing) return;
    const canvas = e.target;
    const rect = canvas.getBoundingClientRect();
    signatureCanvas.lineTo(
        e.clientX - rect.left,
        e.clientY - rect.top
    );
    signatureCanvas.stroke();
}

function stopDrawing() {
    isDrawing = false;
    signatureCanvas.closePath();
    updateSignatureData();
}

function startDrawingTouch(e) {
    e.preventDefault();
    const touch = e.touches[0];
    const mouseEvent = new MouseEvent('mousedown', {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    touch.target.dispatchEvent(mouseEvent);
}

function drawTouch(e) {
    e.preventDefault();
    const touch = e.touches[0];
    const mouseEvent = new MouseEvent('mousemove', {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    touch.target.dispatchEvent(mouseEvent);
}

function clearSignature() {
    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById('releaseSignature').value = '';
}

function updateSignatureData() {
    const canvas = document.getElementById('signatureCanvas');
    const dataURL = canvas.toDataURL();
    document.getElementById('releaseSignature').value = dataURL;
}

function openReleaseModal() {
    const modal = document.getElementById('releaseModal');
    document.getElementById('modalTitle').textContent = 'Nouvelle autorisation de libération';
    
    // Réinitialiser le formulaire
    document.getElementById('releaseForm').reset();
    clearSignature();
    
    // Cacher les sections conditionnelles
    document.getElementById('requirementsComment').style.display = 'none';
    
    modal.style.display = 'block';
    
    // Désactiver le bouton de soumission initialement
    document.getElementById('submitBtn').disabled = true;
}

function reviewRelease(id) {
    const release = releaseData.releases.find(r => r.id === id);
    if (release) {
        const modal = document.getElementById('releaseModal');
        document.getElementById('modalTitle').textContent = `Vérification ${release.ref}`;
        
        // Remplir les informations
        document.getElementById('releaseRef').textContent = release.ref;
        document.getElementById('releaseProduct').textContent = release.product;
        document.getElementById('releaseQuantity').textContent = `${release.quantity} unités`;
        document.getElementById('releaseClient').textContent = release.client;
        
        // Mode lecture seule
        const form = document.getElementById('releaseForm');
        const inputs = form.querySelectorAll('input, textarea, select, button, canvas');
        inputs.forEach(input => {
            if (input.type !== 'hidden') {
                input.disabled = true;
            }
        });
        
        modal.style.display = 'block';
        document.getElementById('submitBtn').style.display = 'none';
        document.getElementById('saveDraftBtn').style.display = 'none';
        document.getElementById('cancelBtn').textContent = 'Fermer';
    }
}

function processRelease(id) {
    const release = releaseData.releases.find(r => r.id === id);
    if (release) {
        openReleaseModal();
        
        // Pré-remplir avec les données du lot
        document.getElementById('releaseRef').textContent = release.ref;
        document.getElementById('releaseProduct').textContent = release.product;
        document.getElementById('releaseQuantity').textContent = `${release.quantity} unités`;
        document.getElementById('releaseClient').textContent = release.client;
        
        // Mode édition
        const form = document.getElementById('releaseForm');
        const inputs = form.querySelectorAll('input, textarea, select, button, canvas');
        inputs.forEach(input => {
            input.disabled = false;
        });
        
        document.getElementById('submitBtn').style.display = 'inline-block';
        document.getElementById('saveDraftBtn').style.display = 'inline-block';
        document.getElementById('cancelBtn').textContent = 'Annuler';
    }
}

function checkReleaseBlock() {
    const reqNoChecked = document.getElementById('reqNo').checked;
    const finalNonConformeChecked = document.getElementById('finalNonConforme').checked;
    
    if (reqNoChecked || finalNonConformeChecked) {
        // Afficher l'option dérogation
        showNotification('Une dérogation sera nécessaire pour libérer ce lot', 'warning');
    }
}

function validateReleaseForm() {
    const requiredFields = document.querySelectorAll('#releaseForm [required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (field.type === 'checkbox') {
            if (!field.checked) isValid = false;
        } else if (field.type === 'radio') {
            const name = field.name;
            const radioGroup = document.querySelectorAll(`input[name="${name}"]:checked`);
            if (radioGroup.length === 0) isValid = false;
        } else {
            if (!field.value.trim()) isValid = false;
        }
    });
    
    // Vérifier la signature
    const signature = document.getElementById('releaseSignature').value;
    if (!signature) isValid = false;
    
    // Vérifier les cases à cocher des vérifications
    const verifications = document.querySelectorAll('.verification-item input[type="checkbox"]');
    const checkedVerifications = Array.from(verifications).filter(cb => cb.checked).length;
    if (checkedVerifications < 4) { // Au moins 4 vérifications sur 6
        isValid = false;
    }
    
    document.getElementById('submitBtn').disabled = !isValid;
    return isValid;
}

function updateSubmitButton(decision) {
    const submitBtn = document.getElementById('submitBtn');
    
    switch(decision) {
        case 'approve':
            submitBtn.className = 'btn btn-success btn-sm';
            submitBtn.innerHTML = '<i class="fas fa-check"></i> Autoriser la libération';
            break;
        case 'reject':
            submitBtn.className = 'btn btn-danger btn-sm';
            submitBtn.innerHTML = '<i class="fas fa-times"></i> Rejeter la libération';
            break;
        case 'hold':
            submitBtn.className = 'btn btn-warning btn-sm';
            submitBtn.innerHTML = '<i class="fas fa-pause"></i> Mettre en attente';
            break;
    }
}

function saveDraft() {
    showNotification('Brouillon enregistré avec succès', 'info');
}

function submitRelease() {
    if (!validateReleaseForm()) {
        alert('Veuillez compléter toutes les vérifications obligatoires');
        return;
    }
    
    const decision = document.querySelector('input[name="decision"]:checked').value;
    let message = '';
    
    switch(decision) {
        case 'approve':
            message = 'Libération autorisée avec succès';
            releaseData.kpis.approved++;
            releaseData.kpis.pending--;
            break;
        case 'reject':
            message = 'Libération rejetée avec justification';
            releaseData.kpis.rejected++;
            releaseData.kpis.pending--;
            break;
        case 'hold':
            message = 'Libération mise en attente';
            break;
    }
    
    showNotification(message, 'success');
    closeModal();
    updateKPIs();
    loadReleaseTable();
}

function openDerogationModal(releaseId) {
    const modal = document.getElementById('derogationModal');
    modal.style.display = 'block';
    
    document.getElementById('submitDerogationBtn').addEventListener('click', function() {
        submitDerogation(releaseId);
    }, { once: true });
}

function submitDerogation(releaseId) {
    showNotification('Demande de dérogation soumise', 'info');
    closeModal();
    
    // Mettre à jour le statut
    const release = releaseData.releases.find(r => r.id === releaseId);
    if (release) {
        release.status = 'pending';
        loadReleaseTable();
    }
}

function openBatchRelease() {
    const selected = document.querySelectorAll('.row-checkbox:checked');
    if (selected.length === 0) {
        alert('Veuillez sélectionner au moins un lot à libérer');
        return;
    }
    
    if (confirm(`Libérer ${selected.length} lot(s) sélectionné(s) ?`)) {
        selected.forEach(checkbox => {
            const id = parseInt(checkbox.dataset.id);
            // Simuler la libération
            const release = releaseData.releases.find(r => r.id === id);
            if (release && release.status === 'pending') {
                release.status = 'approved';
                release.finalCheck = 'conforme';
            }
        });
        
        showNotification(`${selected.length} lot(s) libéré(s) avec succès`, 'success');
        updateKPIs();
        loadReleaseTable();
    }
}

function closeModal() {
    document.getElementById('releaseModal').style.display = 'none';
    document.getElementById('derogationModal').style.display = 'none';
}

function exportData() {
    showNotification('Export des données en cours...', 'info');
    setTimeout(() => {
        showNotification('Export terminé', 'success');
    }, 1000);
}

function refreshData() {
    showNotification('Actualisation des données...', 'info');
    setTimeout(() => {
        loadReleaseTable();
        showNotification('Données actualisées', 'success');
    }, 500);
}

function showNotification(message, type) {
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
.release-container {
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

.btn-warning {
    background: var(--warning);
    color: black;
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

.kpi-icon .fa-check-circle { background: var(--success-light); color: var(--success); }
.kpi-icon .fa-times-circle { background: var(--danger-light); color: var(--danger); }
.kpi-icon .fa-exclamation-triangle { background: var(--warning-light); color: #856404; }

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
}

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

.search-box {
    flex: 1;
    min-width: 200px;
    position: relative;
}

.search-box i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
    font-size: 13px;
}

.search-box input {
    width: 100%;
    padding: 8px 10px 8px 32px;
    border: 1px solid var(--border);
    border-radius: 4px;
    font-size: 13px;
}

/* Contenu principal */
.main-content {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 16px;
}

/* Tableau */
.table-section {
    grid-column: 1;
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
    min-width: 800px;
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
.ref-cell {
    display: flex;
    align-items: center;
    gap: 6px;
}

.priority-high {
    width: 18px;
    height: 18px;
    background: var(--danger);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: bold;
}

/* Badges */
.check-badge {
    padding: 4px 8px;
    border-radius: 3px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}

.check-pending { background: var(--warning-light); color: #856404; }
.check-conforme { background: var(--success-light); color: var(--success); }
.check-nonconforme { background: var(--danger-light); color: var(--danger); }

.status-badge {
    padding: 4px 8px;
    border-radius: 3px;
    font-size: 11px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.status-pending { background: var(--warning-light); color: #856404; }
.status-approved { background: var(--success-light); color: var(--success); }
.status-rejected { background: var(--danger-light); color: var(--danger); }
.status-blocked { background: #e9ecef; color: var(--gray); }

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 4px;
}

.btn-icon.btn-review:hover { color: var(--primary); background: var(--primary-light); }
.btn-icon.btn-release:hover { color: var(--success); background: var(--success-light); }
.btn-icon.btn-derogation:hover { color: var(--warning); background: var(--warning-light); }

/* Sidebar */
.sidebar {
    grid-column: 2;
    display: flex;
    flex-direction: column;
    gap: 16px;
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

.widget-header h4 {
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

/* Checklist */
.checklist-items {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.check-item {
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.check-item input[type="checkbox"] {
    margin-top: 3px;
}

.check-item label {
    font-size: 13px;
    cursor: pointer;
    line-height: 1.4;
}

/* Statistiques */
.today-stats {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6px 0;
    border-bottom: 1px solid var(--border);
}

.stat-row:last-child {
    border-bottom: none;
}

.stat-label {
    font-size: 13px;
    color: var(--gray);
}

.stat-value {
    font-size: 14px;
    font-weight: 600;
    color: var(--dark);
}

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
    max-height: 70vh;
    overflow-y: auto;
}

.modal-footer {
    padding: 16px 20px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
}

/* En-tête libération */
.release-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 16px;
    background: var(--light);
    border-radius: 6px;
    margin-bottom: 20px;
}

.release-info {
    flex: 1;
}

.info-row {
    display: flex;
    margin-bottom: 6px;
}

.info-row:last-child {
    margin-bottom: 0;
}

.info-row .label {
    width: 100px;
    font-weight: 500;
    color: var(--dark);
    font-size: 13px;
}

.info-row .value {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
}

/* Sections formulaire */
.form-section {
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border);
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.form-section h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--dark);
}

/* Checklist radio */
.checklist {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 12px;
}

.check-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: white;
    cursor: pointer;
    transition: all 0.2s;
}

.check-item:hover {
    background: var(--light);
}

.check-item input[type="radio"] {
    margin: 0;
}

.check-item label {
    flex: 1;
    cursor: pointer;
    font-size: 14px;
    margin: 0;
}

/* Grille vérifications */
.verification-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 10px;
}

.verification-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: white;
}

.verification-item input[type="checkbox"] {
    margin: 0;
}

.verification-item label {
    flex: 1;
    cursor: pointer;
    font-size: 13px;
    margin: 0;
}

/* Options décision */
.decision-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
    margin-bottom: 16px;
}

.decision-option input[type="radio"] {
    display: none;
}

.decision-label {
    display: block;
    padding: 12px;
    border: 2px solid var(--border);
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

.decision-label:hover {
    border-color: var(--primary);
    background: var(--primary-light);
}

.decision-option input[type="radio"]:checked + .decision-label {
    border-color: var(--primary);
    background: var(--primary-light);
}

.decision-label.approve {
    border-left-color: var(--success);
}

.decision-label.reject {
    border-left-color: var(--danger);
}

.decision-label.hold {
    border-left-color: var(--warning);
}

.decision-label i {
    font-size: 18px;
    margin-right: 8px;
}

.decision-label.approve i { color: var(--success); }
.decision-label.reject i { color: var(--danger); }
.decision-label.hold i { color: var(--warning); }

.decision-label span {
    font-weight: 600;
    font-size: 14px;
    display: block;
    margin-bottom: 4px;
}

.decision-label small {
    font-size: 12px;
    color: var(--gray);
    display: block;
}

/* Signature */
.signature-area {
    border: 1px solid var(--border);
    border-radius: 4px;
    padding: 12px;
    background: white;
}

#signatureCanvas {
    border: 1px solid var(--border);
    border-radius: 4px;
    background: white;
    cursor: crosshair;
    display: block;
    margin-bottom: 8px;
}

.signature-actions {
    display: flex;
    justify-content: flex-end;
}

.btn-clear-signature {
    padding: 6px 12px;
    border: 1px solid var(--border);
    background: white;
    color: var(--gray);
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-clear-signature:hover {
    border-color: var(--danger);
    color: var(--danger);
}

/* Checkbox label */
.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 14px;
    cursor: pointer;
    padding: 10px;
    border-radius: 6px;
    background: var(--light);
}

.checkbox-label:hover {
    background: #e9ecef;
}

.checkbox-label input[type="checkbox"] {
    margin-top: 3px;
}

/* Champs formulaire */
.form-group {
    margin-bottom: 16px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    font-size: 13px;
    color: var(--dark);
}

.form-group input[type="text"],
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid var(--border);
    border-radius: 4px;
    font-size: 14px;
}

.form-group textarea {
    resize: vertical;
    min-height: 60px;
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

.notification-warning {
    border-left-color: var(--warning);
    background: var(--warning-light);
    color: #856404;
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
@media (max-width: 992px) {
    .main-content {
        grid-template-columns: 1fr;
    }
    
    .sidebar {
        grid-column: 1;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        display: grid;
    }
}

@media (max-width: 768px) {
    .release-container {
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
    
    .filter-group,
    .search-box {
        width: 100%;
    }
    
    .filter-select {
        flex: 1;
        min-width: 0;
    }
    
    .verification-grid {
        grid-template-columns: 1fr;
    }
    
    .decision-options {
        grid-template-columns: 1fr;
    }
    
    .modal-content {
        width: 95%;
        margin: 10px auto;
    }
    
    .modal-body {
        padding: 16px;
    }
    
    .release-header {
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
    
    .sidebar {
        grid-template-columns: 1fr;
    }
    
    #signatureCanvas {
        width: 100% !important;
        height: 80px !important;
    }
}
</style>
@endsection