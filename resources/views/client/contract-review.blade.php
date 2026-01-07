@extends('layouts.clients')

@section('title', 'Opérations - Revue des Contrats')

@section('content')
<div class="contract-review-container">
    <!-- En-tête -->
    <div class="header-section">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title">Revue des Contrats</h1>
                <p class="page-subtitle">Validation des exigences client avant l'acceptation de la commande</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-primary" id="newContractBtn">
                    <i class="fas fa-plus"></i> Nouvelle Revue
                </button>
                <button class="btn btn-outline-secondary" id="exportBtn">
                    <i class="fas fa-download"></i> Exporter
                </button>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="stats-section">
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock text-warning"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" id="pendingCount">8</h3>
                    <p class="stat-label">En attente</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" id="approvedCount">24</h3>
                    <p class="stat-label">Approuvés</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-times-circle text-danger"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" id="rejectedCount">3</h3>
                    <p class="stat-label">Rejetés</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line text-primary"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" id="avgTime">2.4</h3>
                    <p class="stat-label">Jours (moyenne)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique -->
    <div class="chart-section">
        <div class="chart-card">
            <div class="chart-header">
                <h3><i class="fas fa-chart-bar"></i> Évolution des Revues de Contrat</h3>
                <select id="chartPeriod" class="form-select">
                    <option value="month">Ce mois</option>
                    <option value="quarter" selected>Ce trimestre</option>
                    <option value="year">Cette année</option>
                </select>
            </div>
            <div class="chart-body">
                <canvas id="contractsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Filtres et Tableau -->
    <div class="main-section">
        <div class="filters-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Rechercher par client, contrat, référence...">
            </div>
            <div class="filter-group">
                <select id="statusFilter" class="form-select">
                    <option value="all">Tous les statuts</option>
                    <option value="pending">En attente</option>
                    <option value="approved">Approuvé</option>
                    <option value="rejected">Rejeté</option>
                    <option value="revision">En révision</option>
                </select>
                <select id="priorityFilter" class="form-select">
                    <option value="all">Toutes priorités</option>
                    <option value="high">Haute</option>
                    <option value="medium">Moyenne</option>
                    <option value="low">Basse</option>
                </select>
                <input type="date" id="dateFilter" class="form-select">
            </div>
        </div>

        <!-- Tableau des contrats -->
        <div class="table-container">
            <table class="contracts-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>Référence</th>
                        <th>Client</th>
                        <th>Date Réception</th>
                        <th>Date Limite</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="contractsTableBody">
                    <!-- Données chargées dynamiquement -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-section">
            <div class="pagination-info">
                Affichage de <span id="startItem">1</span> à <span id="endItem">10</span> sur <span id="totalItems">35</span> contrats
            </div>
            <div class="pagination-controls">
                <button class="btn-pagination" id="prevPage" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="page-numbers">
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                </div>
                <button class="btn-pagination" id="nextPage">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Revue de Contrat -->
<div id="contractModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Nouvelle Revue de Contrat</h2>
            <button class="modal-close" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="contractForm">
                <!-- Section 1: Informations générales -->
                <div class="form-section">
                    <h3><i class="fas fa-info-circle"></i> Informations Générales</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contractRef">Référence Contrat *</label>
                            <input type="text" id="contractRef" required>
                        </div>
                        <div class="form-group">
                            <label for="clientName">Client *</label>
                            <input type="text" id="clientName" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="receptionDate">Date Réception *</label>
                            <input type="date" id="receptionDate" required>
                        </div>
                        <div class="form-group">
                            <label for="deadlineDate">Date Limite Réponse *</label>
                            <input type="date" id="deadlineDate" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="priority">Priorité *</label>
                            <select id="priority" required>
                                <option value="">Sélectionner</option>
                                <option value="high">Haute (≤ 2 jours)</option>
                                <option value="medium">Moyenne (3-5 jours)</option>
                                <option value="low">Basse (> 5 jours)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contactPerson">Responsable Client *</label>
                            <input type="text" id="contactPerson" required>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Exigences client -->
                <div class="form-section">
                    <h3><i class="fas fa-clipboard-check"></i> Exigences Client (8.2)</h3>
                    <div class="form-group">
                        <label for="requirements">Description des exigences *</label>
                        <textarea id="requirements" rows="3" required placeholder="Décrire les exigences spécifiques du client..."></textarea>
                    </div>
                    
                    <div class="requirements-checklist">
                        <div class="checklist-item">
                            <input type="checkbox" id="req1">
                            <label for="req1">Spécifications techniques claires et complètes</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="req2">
                            <label for="req2">Exigences de livraison définies</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="req3">
                            <label for="req3">Conditions de paiement acceptables</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="req4">
                            <label for="req4">Garanties et support spécifiés</label>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Exigences légales et réglementaires -->
                <div class="form-section">
                    <h3><i class="fas fa-scale-balanced"></i> Exigences Légales & Réglementaires</h3>
                    <div class="legal-checklist">
                        <div class="checklist-header">
                            <span>Vérification</span>
                            <span>Conforme</span>
                            <span>Commentaire</span>
                        </div>
                        <div class="checklist-row">
                            <label>Normes produits applicables</label>
                            <div class="radio-group">
                                <label><input type="radio" name="normes" value="yes"> Oui</label>
                                <label><input type="radio" name="normes" value="no"> Non</label>
                                <label><input type="radio" name="normes" value="na"> N/A</label>
                            </div>
                            <input type="text" placeholder="Préciser les normes...">
                        </div>
                        <div class="checklist-row">
                            <label>Réglementations spécifiques</label>
                            <div class="radio-group">
                                <label><input type="radio" name="regulations" value="yes"> Oui</label>
                                <label><input type="radio" name="regulations" value="no"> Non</label>
                                <label><input type="radio" name="regulations" value="na"> N/A</label>
                            </div>
                            <input type="text" placeholder="Préciser les réglementations...">
                        </div>
                        <div class="checklist-row">
                            <label>Exigences sécurité</label>
                            <div class="radio-group">
                                <label><input type="radio" name="safety" value="yes"> Oui</label>
                                <label><input type="radio" name="safety" value="no"> Non</label>
                                <label><input type="radio" name="safety" value="na"> N/A</label>
                            </div>
                            <input type="text" placeholder="Préciser les exigences...">
                        </div>
                    </div>
                </div>

                <!-- Section 4: Capacité de production -->
                <div class="form-section">
                    <h3><i class="fas fa-industry"></i> Vérification Capacité (8.1)</h3>
                    <div class="capacity-grid">
                        <div class="capacity-item">
                            <label>Capacité de production</label>
                            <div class="radio-group">
                                <label><input type="radio" name="capacity" value="yes" required> Suffisante</label>
                                <label><input type="radio" name="capacity" value="no"> Insuffisante</label>
                            </div>
                        </div>
                        <div class="capacity-item">
                            <label>Disponibilité ressources</label>
                            <div class="radio-group">
                                <label><input type="radio" name="resources" value="yes" required> Disponible</label>
                                <label><input type="radio" name="resources" value="no"> Non disponible</label>
                            </div>
                        </div>
                        <div class="capacity-item">
                            <label>Compétences requises</label>
                            <div class="radio-group">
                                <label><input type="radio" name="skills" value="yes" required> Disponible</label>
                                <label><input type="radio" name="skills" value="no"> Non disponible</label>
                            </div>
                        </div>
                        <div class="capacity-item">
                            <label>Délais réalisation</label>
                            <div class="radio-group">
                                <label><input type="radio" name="deadlines" value="yes" required> Réalisable</label>
                                <label><input type="radio" name="deadlines" value="no"> Non réalisable</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Risques et décision -->
                <div class="form-section">
                    <h3><i class="fas fa-triangle-exclamation"></i> Analyse des Risques & Décision</h3>
                    <div class="form-group">
                        <label for="riskAnalysis">Analyse des risques identifiés *</label>
                        <textarea id="riskAnalysis" rows="2" required placeholder="Décrire les risques potentiels..."></textarea>
                    </div>
                    
                    <div class="decision-section">
                        <label>Décision de la revue *</label>
                        <div class="decision-options">
                            <div class="decision-option">
                                <input type="radio" id="decisionApprove" name="decision" value="approved" required>
                                <label for="decisionApprove" class="decision-label approve">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Approuver le contrat</span>
                                    <small>L'organisme peut satisfaire à toutes les exigences</small>
                                </label>
                            </div>
                            <div class="decision-option">
                                <input type="radio" id="decisionReject" name="decision" value="rejected">
                                <label for="decisionReject" class="decision-label reject">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Rejeter le contrat</span>
                                    <small>L'organisme ne peut pas satisfaire aux exigences</small>
                                </label>
                            </div>
                            <div class="decision-option">
                                <input type="radio" id="decisionRevise" name="decision" value="revision">
                                <label for="decisionRevise" class="decision-label revise">
                                    <i class="fas fa-edit"></i>
                                    <span>Négocier révision</span>
                                    <small>Nécessite modifications des exigences</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="commentSection">
                        <label for="reviewComments">Commentaires justificatifs *</label>
                        <textarea id="reviewComments" rows="2" required placeholder="Justifier la décision prise..."></textarea>
                    </div>
                </div>

                <!-- Section 6: Validation -->
                <div class="form-section">
                    <h3><i class="fas fa-user-check"></i> Validation</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="reviewerName">Nom du réviseur *</label>
                            <input type="text" id="reviewerName" required>
                        </div>
                        <div class="form-group">
                            <label for="reviewDate">Date de la revue *</label>
                            <input type="date" id="reviewDate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="signature-label">
                            <input type="checkbox" id="approvalCheck" required>
                            Je certifie avoir vérifié toutes les exigences et valide cette revue de contrat
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" id="cancelBtn">Annuler</button>
            <button class="btn btn-primary" id="saveBtn" disabled>
                <i class="fas fa-save"></i> Enregistrer la revue
            </button>
            <button class="btn btn-success" id="submitBtn" style="display: none;">
                <i class="fas fa-check"></i> Soumettre pour approbation
            </button>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Données de test
const testData = {
    contracts: [
        {
            id: 1,
            ref: 'CT-2023-001',
            client: 'ABC Industries',
            receptionDate: '2023-10-15',
            deadlineDate: '2023-10-22',
            priority: 'high',
            status: 'pending',
            contact: 'M. Dupont',
            requirements: 'Production de 1000 pièces selon spécification XYZ',
            riskLevel: 'medium'
        },
        {
            id: 2,
            ref: 'CT-2023-002',
            client: 'Techno Solutions',
            receptionDate: '2023-10-10',
            deadlineDate: '2023-10-25',
            priority: 'medium',
            status: 'approved',
            contact: 'Mme. Martin',
            requirements: 'Maintenance annuelle équipement',
            riskLevel: 'low'
        },
        {
            id: 3,
            ref: 'CT-2023-003',
            client: 'Global Corp',
            receptionDate: '2023-10-05',
            deadlineDate: '2023-10-20',
            priority: 'high',
            status: 'rejected',
            contact: 'M. Johnson',
            requirements: 'Développement produit sur-mesure',
            riskLevel: 'high'
        },
        {
            id: 4,
            ref: 'CT-2023-004',
            client: 'Manufacturing Plus',
            receptionDate: '2023-10-18',
            deadlineDate: '2023-10-30',
            priority: 'low',
            status: 'pending',
            contact: 'M. Garcia',
            requirements: 'Fourniture composants standards',
            riskLevel: 'low'
        },
        {
            id: 5,
            ref: 'CT-2023-005',
            client: 'Innovation Tech',
            receptionDate: '2023-10-12',
            deadlineDate: '2023-10-19',
            priority: 'high',
            status: 'revision',
            contact: 'Mme. Chen',
            requirements: 'Prototype développement',
            riskLevel: 'medium'
        }
    ],
    
    stats: {
        pending: 8,
        approved: 24,
        rejected: 3,
        avgTime: 2.4
    },
    
    chartData: {
        month: {
            labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
            pending: [3, 5, 4, 6],
            approved: [8, 12, 10, 14],
            rejected: [1, 0, 2, 1]
        },
        quarter: {
            labels: ['Oct', 'Nov', 'Dec'],
            pending: [8, 12, 6],
            approved: [24, 28, 32],
            rejected: [3, 2, 4]
        },
        year: {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            pending: [25, 32, 28, 24],
            approved: [85, 92, 88, 95],
            rejected: [12, 8, 10, 9]
        }
    }
};

// Variables globales
let contractsChart = null;
let currentPage = 1;
const itemsPerPage = 10;

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    initializePage();
    setupEventListeners();
    loadContractsTable();
    initializeChart();
});

function initializePage() {
    updateStats();
    setDefaultDates();
}

function setupEventListeners() {
    // Boutons d'action
    document.getElementById('newContractBtn').addEventListener('click', openNewContractModal);
    document.getElementById('exportBtn').addEventListener('click', exportData);
    
    // Modal
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('cancelBtn').addEventListener('click', closeModal);
    document.getElementById('saveBtn').addEventListener('click', saveContract);
    document.getElementById('submitBtn').addEventListener('click', submitContract);
    
    // Fermer modal en cliquant en dehors
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('contractModal');
        if (event.target === modal) {
            closeModal();
        }
    });
    
    // Filtres
    document.getElementById('searchInput').addEventListener('input', filterContracts);
    document.getElementById('statusFilter').addEventListener('change', filterContracts);
    document.getElementById('priorityFilter').addEventListener('change', filterContracts);
    document.getElementById('dateFilter').addEventListener('change', filterContracts);
    document.getElementById('chartPeriod').addEventListener('change', updateChart);
    
    // Sélection multiple
    document.getElementById('selectAll').addEventListener('change', toggleSelectAll);
    
    // Validation formulaire
    document.getElementById('contractForm').addEventListener('input', validateForm);
    document.getElementById('approvalCheck').addEventListener('change', validateForm);
    
    // Décision radio buttons
    const decisionRadios = document.querySelectorAll('input[name="decision"]');
    decisionRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            updateSubmitButton(this.value);
        });
    });
    
    // Pagination
    document.getElementById('prevPage').addEventListener('click', goToPrevPage);
    document.getElementById('nextPage').addEventListener('click', goToNextPage);
}

function setDefaultDates() {
    const today = new Date().toISOString().split('T')[0];
    const nextWeek = new Date();
    nextWeek.setDate(nextWeek.getDate() + 7);
    const nextWeekStr = nextWeek.toISOString().split('T')[0];
    
    document.getElementById('receptionDate').value = today;
    document.getElementById('deadlineDate').value = nextWeekStr;
    document.getElementById('reviewDate').value = today;
}

function updateStats() {
    document.getElementById('pendingCount').textContent = testData.stats.pending;
    document.getElementById('approvedCount').textContent = testData.stats.approved;
    document.getElementById('rejectedCount').textContent = testData.stats.rejected;
    document.getElementById('avgTime').textContent = testData.stats.avgTime;
}

function initializeChart() {
    const ctx = document.getElementById('contractsChart').getContext('2d');
    const period = document.getElementById('chartPeriod').value;
    const data = testData.chartData[period];
    
    contractsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: 'En attente',
                    data: data.pending,
                    backgroundColor: '#ffc107',
                    borderColor: '#e0a800',
                    borderWidth: 1
                },
                {
                    label: 'Approuvés',
                    data: data.approved,
                    backgroundColor: '#28a745',
                    borderColor: '#218838',
                    borderWidth: 1
                },
                {
                    label: 'Rejetés',
                    data: data.rejected,
                    backgroundColor: '#dc3545',
                    borderColor: '#c82333',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de contrats'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Période'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
}

function updateChart() {
    const period = document.getElementById('chartPeriod').value;
    const data = testData.chartData[period];
    
    contractsChart.data.labels = data.labels;
    contractsChart.data.datasets[0].data = data.pending;
    contractsChart.data.datasets[1].data = data.approved;
    contractsChart.data.datasets[2].data = data.rejected;
    contractsChart.update();
}

function loadContractsTable() {
    const tbody = document.getElementById('contractsTableBody');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, testData.contracts.length);
    
    tbody.innerHTML = '';
    
    for (let i = startIndex; i < endIndex; i++) {
        const contract = testData.contracts[i];
        const row = createContractRow(contract);
        tbody.appendChild(row);
    }
    
    updatePaginationInfo();
}

function createContractRow(contract) {
    const row = document.createElement('tr');
    
    // Status class and icon
    let statusClass = '';
    let statusIcon = '';
    let statusText = '';
    
    switch(contract.status) {
        case 'pending':
            statusClass = 'status-pending';
            statusIcon = 'fa-clock';
            statusText = 'En attente';
            break;
        case 'approved':
            statusClass = 'status-approved';
            statusIcon = 'fa-check-circle';
            statusText = 'Approuvé';
            break;
        case 'rejected':
            statusClass = 'status-rejected';
            statusIcon = 'fa-times-circle';
            statusText = 'Rejeté';
            break;
        case 'revision':
            statusClass = 'status-revision';
            statusIcon = 'fa-edit';
            statusText = 'En révision';
            break;
    }
    
    // Priority class
    let priorityClass = '';
    let priorityText = '';
    
    switch(contract.priority) {
        case 'high':
            priorityClass = 'priority-high';
            priorityText = 'Haute';
            break;
        case 'medium':
            priorityClass = 'priority-medium';
            priorityText = 'Moyenne';
            break;
        case 'low':
            priorityClass = 'priority-low';
            priorityText = 'Basse';
            break;
    }
    
    row.innerHTML = `
        <td><input type="checkbox" class="contract-checkbox" data-id="${contract.id}"></td>
        <td><strong>${contract.ref}</strong></td>
        <td>${contract.client}</td>
        <td>${formatDate(contract.receptionDate)}</td>
        <td>${formatDate(contract.deadlineDate)}</td>
        <td><span class="priority-badge ${priorityClass}">${priorityText}</span></td>
        <td><span class="status-badge ${statusClass}"><i class="fas ${statusIcon}"></i> ${statusText}</span></td>
        <td>
            <button class="btn-action btn-view" data-id="${contract.id}" title="Voir">
                <i class="fas fa-eye"></i>
            </button>
            <button class="btn-action btn-edit" data-id="${contract.id}" title="Éditer">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn-action btn-delete" data-id="${contract.id}" title="Supprimer">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Ajouter les écouteurs d'événements
    const viewBtn = row.querySelector('.btn-view');
    const editBtn = row.querySelector('.btn-edit');
    const deleteBtn = row.querySelector('.btn-delete');
    
    viewBtn.addEventListener('click', () => viewContract(contract.id));
    editBtn.addEventListener('click', () => editContract(contract.id));
    deleteBtn.addEventListener('click', () => deleteContract(contract.id));
    
    return row;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR');
}

function updatePaginationInfo() {
    const totalItems = testData.contracts.length;
    const startItem = (currentPage - 1) * itemsPerPage + 1;
    const endItem = Math.min(currentPage * itemsPerPage, totalItems);
    
    document.getElementById('startItem').textContent = startItem;
    document.getElementById('endItem').textContent = endItem;
    document.getElementById('totalItems').textContent = totalItems;
    
    // Gérer les boutons de pagination
    document.getElementById('prevPage').disabled = currentPage === 1;
    document.getElementById('nextPage').disabled = endItem >= totalItems;
}

function goToPrevPage() {
    if (currentPage > 1) {
        currentPage--;
        loadContractsTable();
    }
}

function goToNextPage() {
    const totalPages = Math.ceil(testData.contracts.length / itemsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        loadContractsTable();
    }
}

function filterContracts() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const priorityFilter = document.getElementById('priorityFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;
    
    // Dans une vraie application, cette fonction filtrerait les données
    // Pour la démo, on simule le filtrage
    console.log('Filtrage avec:', { searchTerm, statusFilter, priorityFilter, dateFilter });
    
    // Recharger la table avec les données filtrées
    loadContractsTable();
}

function openNewContractModal() {
    const modal = document.getElementById('contractModal');
    document.getElementById('modalTitle').textContent = 'Nouvelle Revue de Contrat';
    resetForm();
    modal.style.display = 'block';
    document.getElementById('submitBtn').style.display = 'none';
    document.getElementById('saveBtn').style.display = 'block';
}

function viewContract(id) {
    const contract = testData.contracts.find(c => c.id === id);
    if (contract) {
        const modal = document.getElementById('contractModal');
        document.getElementById('modalTitle').textContent = `Revue de Contrat - ${contract.ref}`;
        fillFormWithData(contract);
        modal.style.display = 'block';
        
        // En mode visualisation, désactiver tous les champs
        const form = document.getElementById('contractForm');
        const inputs = form.querySelectorAll('input, select, textarea, button');
        inputs.forEach(input => {
            input.disabled = true;
        });
        
        document.getElementById('saveBtn').style.display = 'none';
        document.getElementById('submitBtn').style.display = 'none';
        document.getElementById('cancelBtn').textContent = 'Fermer';
    }
}

function editContract(id) {
    const contract = testData.contracts.find(c => c.id === id);
    if (contract) {
        const modal = document.getElementById('contractModal');
        document.getElementById('modalTitle').textContent = `Modifier Revue - ${contract.ref}`;
        fillFormWithData(contract);
        modal.style.display = 'block';
        
        // Réactiver tous les champs en mode édition
        const form = document.getElementById('contractForm');
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.disabled = false;
        });
        
        document.getElementById('saveBtn').style.display = 'block';
        document.getElementById('submitBtn').style.display = 'none';
        document.getElementById('cancelBtn').textContent = 'Annuler';
    }
}

function fillFormWithData(contract) {
    // Remplir les champs du formulaire avec les données du contrat
    document.getElementById('contractRef').value = contract.ref;
    document.getElementById('clientName').value = contract.client;
    document.getElementById('receptionDate').value = contract.receptionDate;
    document.getElementById('deadlineDate').value = contract.deadlineDate;
    document.getElementById('priority').value = contract.priority;
    document.getElementById('contactPerson').value = contract.contact;
    document.getElementById('requirements').value = contract.requirements;
    
    // Simuler d'autres champs pour la démo
    document.getElementById('reviewerName').value = 'Responsable Qualité';
    document.getElementById('reviewDate').value = new Date().toISOString().split('T')[0];
}

function resetForm() {
    document.getElementById('contractForm').reset();
    setDefaultDates();
    
    // Réactiver tous les champs
    const form = document.getElementById('contractForm');
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.disabled = false;
    });
    
    document.getElementById('cancelBtn').textContent = 'Annuler';
}

function closeModal() {
    const modal = document.getElementById('contractModal');
    modal.style.display = 'none';
}

function validateForm() {
    const requiredFields = document.querySelectorAll('#contractForm [required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
        }
    });
    
    const approvalCheck = document.getElementById('approvalCheck');
    if (!approvalCheck.checked) {
        isValid = false;
    }
    
    // Vérifier qu'une décision est sélectionnée
    const decisionSelected = document.querySelector('input[name="decision"]:checked');
    if (!decisionSelected) {
        isValid = false;
    }
    
    document.getElementById('saveBtn').disabled = !isValid;
    return isValid;
}

function updateSubmitButton(decision) {
    const submitBtn = document.getElementById('submitBtn');
    
    if (decision === 'approved') {
        submitBtn.className = 'btn btn-success';
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Approuver le contrat';
    } else if (decision === 'rejected') {
        submitBtn.className = 'btn btn-danger';
        submitBtn.innerHTML = '<i class="fas fa-times"></i> Rejeter le contrat';
    } else if (decision === 'revision') {
        submitBtn.className = 'btn btn-warning';
        submitBtn.innerHTML = '<i class="fas fa-edit"></i> Proposer révision';
    }
    
    submitBtn.style.display = 'block';
}

function saveContract() {
    if (validateForm()) {
        showNotification('Revue de contrat enregistrée avec succès', 'success');
        closeModal();
        
        // Simuler la mise à jour des statistiques
        testData.stats.pending++;
        updateStats();
        loadContractsTable();
    } else {
        showNotification('Veuillez remplir tous les champs obligatoires', 'error');
    }
}

function submitContract() {
    if (validateForm()) {
        const decision = document.querySelector('input[name="decision"]:checked').value;
        let message = '';
        
        switch(decision) {
            case 'approved':
                message = 'Contrat approuvé avec succès';
                testData.stats.approved++;
                testData.stats.pending--;
                break;
            case 'rejected':
                message = 'Contrat rejeté avec justification';
                testData.stats.rejected++;
                testData.stats.pending--;
                break;
            case 'revision':
                message = 'Proposition de révision envoyée au client';
                break;
        }
        
        showNotification(message, 'success');
        closeModal();
        updateStats();
        loadContractsTable();
        updateChart();
    }
}

function deleteContract(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette revue de contrat ?')) {
        // Simuler la suppression
        const index = testData.contracts.findIndex(c => c.id === id);
        if (index !== -1) {
            const status = testData.contracts[index].status;
            
            // Mettre à jour les stats
            switch(status) {
                case 'pending': testData.stats.pending--; break;
                case 'approved': testData.stats.approved--; break;
                case 'rejected': testData.stats.rejected--; break;
            }
            
            testData.contracts.splice(index, 1);
            
            showNotification('Revue de contrat supprimée avec succès', 'success');
            updateStats();
            loadContractsTable();
            updateChart();
        }
    }
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.contract-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function exportData() {
    showNotification('Export des données en cours...', 'info');
    
    // Simuler l'export
    setTimeout(() => {
        showNotification('Export terminé - Fichier téléchargé', 'success');
    }, 1000);
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        ${message}
        <button class="notification-close">&times;</button>
    `;
    
    document.body.appendChild(notification);
    
    // Animation d'entrée
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Fermer la notification
    notification.querySelector('.notification-close').addEventListener('click', function() {
        notification.remove();
    });
    
    // Supprimer automatiquement après 3 secondes
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 3000);
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
    --info: #17a2b8;
    --light: #f8f9fa;
    --dark: #343a40;
    --gray: #6c757d;
    --gray-light: #e9ecef;
    --border: #dee2e6;
    --shadow: 0 2px 4px rgba(0,0,0,0.1);
    --shadow-lg: 0 4px 12px rgba(0,0,0,0.15);
}

/* Reset et base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: #f5f7fa;
    color: var(--dark);
}

/* Conteneur principal */
.contract-review-container {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

/* Header */
.header-section {
    margin-bottom: 30px;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 20px;
}

.header-text {
    flex: 1;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 5px;
}

.page-subtitle {
    color: var(--gray);
    font-size: 16px;
}

.header-actions {
    display: flex;
    gap: 10px;
    flex-shrink: 0;
}

/* Boutons */
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow);
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: #0069d9;
}

.btn-secondary {
    background-color: var(--secondary);
    color: white;
}

.btn-success {
    background-color: var(--success);
    color: white;
}

.btn-outline-secondary {
    background-color: transparent;
    color: var(--secondary);
    border: 1px solid var(--secondary);
}

.btn-outline-secondary:hover {
    background-color: var(--secondary);
    color: white;
}

/* Statistiques */
.stats-section {
    margin-bottom: 30px;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: var(--shadow);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-icon .text-warning { background-color: var(--warning-light); }
.stat-icon .text-success { background-color: var(--success-light); }
.stat-icon .text-danger { background-color: var(--danger-light); }
.stat-icon .text-primary { background-color: var(--primary-light); }

.stat-value {
    font-size: 32px;
    font-weight: 700;
    color: var(--dark);
    line-height: 1;
    margin-bottom: 5px;
}

.stat-label {
    color: var(--gray);
    font-size: 14px;
    margin: 0;
}

/* Graphique */
.chart-section {
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: var(--shadow);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
}

.chart-header h3 {
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}

.chart-body {
    height: 300px;
    position: relative;
}

/* Filtres */
.filters-section {
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    box-shadow: var(--shadow);
}

.search-box {
    flex: 1;
    min-width: 300px;
    position: relative;
}

.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
}

.search-box input {
    width: 100%;
    padding: 10px 10px 10px 40px;
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 14px;
}

.filter-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.form-select {
    padding: 10px 15px;
    border: 1px solid var(--border);
    border-radius: 6px;
    background-color: white;
    color: var(--dark);
    font-size: 14px;
    min-width: 150px;
}

/* Tableau */
.table-container {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: var(--shadow);
    margin-bottom: 20px;
    overflow-x: auto;
}

.contracts-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1000px;
}

.contracts-table thead {
    background-color: var(--light);
}

.contracts-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: var(--dark);
    border-bottom: 2px solid var(--border);
    font-size: 14px;
}

.contracts-table td {
    padding: 15px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.contracts-table tbody tr:hover {
    background-color: var(--light);
}

/* Badges */
.status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.status-pending {
    background-color: var(--warning-light);
    color: #856404;
}

.status-approved {
    background-color: var(--success-light);
    color: var(--success);
}

.status-rejected {
    background-color: var(--danger-light);
    color: var(--danger);
}

.status-revision {
    background-color: #e7f1ff;
    color: var(--primary);
}

.priority-badge {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.priority-high {
    background-color: #f8d7da;
    color: #721c24;
}

.priority-medium {
    background-color: #fff3cd;
    color: #856404;
}

.priority-low {
    background-color: #d1ecf1;
    color: #0c5460;
}

/* Boutons d'action */
.btn-action {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 6px;
    background: none;
    color: var(--gray);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    margin: 0 2px;
}

.btn-action:hover {
    background-color: var(--light);
    color: var(--dark);
}

.btn-view:hover {
    color: var(--primary);
    background-color: var(--primary-light);
}

.btn-edit:hover {
    color: var(--warning);
    background-color: var(--warning-light);
}

.btn-delete:hover {
    color: var(--danger);
    background-color: var(--danger-light);
}

/* Pagination */
.pagination-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    flex-wrap: wrap;
    gap: 15px;
}

.pagination-info {
    color: var(--gray);
    font-size: 14px;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-pagination {
    width: 36px;
    height: 36px;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: white;
    color: var(--dark);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.btn-pagination:hover:not(:disabled) {
    background-color: var(--light);
    border-color: var(--gray);
}

.btn-pagination:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.page-numbers {
    display: flex;
    gap: 5px;
}

.page-btn {
    width: 36px;
    height: 36px;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: white;
    color: var(--dark);
    cursor: pointer;
    font-size: 14px;
}

.page-btn.active {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
}

.page-btn:hover:not(.active) {
    background-color: var(--light);
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
    background-color: rgba(0, 0, 0, 0.5);
    overflow-y: auto;
    padding: 20px;
}

.modal-content {
    background-color: white;
    margin: 20px auto;
    width: 90%;
    max-width: 1000px;
    border-radius: 10px;
    box-shadow: var(--shadow-lg);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    padding: 20px 30px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    font-size: 24px;
    font-weight: 600;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 28px;
    color: var(--gray);
    cursor: pointer;
    line-height: 1;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: var(--dark);
}

.modal-body {
    padding: 30px;
    max-height: 70vh;
    overflow-y: auto;
}

.modal-footer {
    padding: 20px 30px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

/* Formulaire */
.form-section {
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border);
}

.form-section:last-of-type {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.form-section h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--dark);
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.form-group {
    flex: 1;
    min-width: 200px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--dark);
    font-size: 14px;
}

.form-group input[type="text"],
.form-group input[type="date"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 14px;
    background-color: white;
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

/* Checklist */
.requirements-checklist {
    display: grid;
    gap: 12px;
    margin-top: 15px;
}

.checklist-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.checklist-item input[type="checkbox"] {
    margin-top: 3px;
}

.checklist-item label {
    font-size: 14px;
    color: var(--dark);
    line-height: 1.4;
}

/* Checklist légale */
.legal-checklist {
    border: 1px solid var(--border);
    border-radius: 6px;
    overflow: hidden;
}

.checklist-header {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: 20px;
    padding: 15px;
    background-color: var(--light);
    font-weight: 600;
    font-size: 14px;
}

.checklist-row {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: 20px;
    padding: 15px;
    border-top: 1px solid var(--border);
    align-items: center;
}

.checklist-row label {
    font-size: 14px;
    margin: 0;
}

.radio-group {
    display: flex;
    gap: 15px;
    align-items: center;
}

.radio-group label {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    cursor: pointer;
}

.checklist-row input[type="text"] {
    padding: 8px 12px;
    border: 1px solid var(--border);
    border-radius: 4px;
    font-size: 13px;
    min-width: 200px;
}

/* Grille capacité */
.capacity-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.capacity-item {
    padding: 15px;
    border: 1px solid var(--border);
    border-radius: 6px;
    background-color: var(--light);
}

.capacity-item label {
    display: block;
    margin-bottom: 10px;
    font-weight: 500;
    font-size: 14px;
}

/* Section décision */
.decision-section {
    margin-top: 20px;
}

.decision-section label {
    display: block;
    margin-bottom: 15px;
    font-weight: 500;
    font-size: 14px;
}

.decision-options {
    display: grid;
    gap: 10px;
}

.decision-option input[type="radio"] {
    display: none;
}

.decision-label {
    display: block;
    padding: 15px;
    border: 2px solid var(--border);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
}

.decision-label:hover {
    border-color: var(--primary);
    background-color: var(--primary-light);
}

.decision-option input[type="radio"]:checked + .decision-label {
    border-color: var(--primary);
    background-color: var(--primary-light);
}

.decision-label.approve {
    border-left-color: var(--success);
}

.decision-label.reject {
    border-left-color: var(--danger);
}

.decision-label.revise {
    border-left-color: var(--warning);
}

.decision-label i {
    font-size: 20px;
    margin-right: 10px;
}

.decision-label.approve i { color: var(--success); }
.decision-label.reject i { color: var(--danger); }
.decision-label.revise i { color: var(--warning); }

.decision-label span {
    font-weight: 600;
    font-size: 14px;
    display: block;
    margin-bottom: 5px;
}

.decision-label small {
    font-size: 12px;
    color: var(--gray);
    display: block;
}

/* Signature */
.signature-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 14px;
    cursor: pointer;
    padding: 10px;
    border-radius: 6px;
    background-color: var(--light);
}

.signature-label:hover {
    background-color: #e9ecef;
}

.signature-label input[type="checkbox"] {
    margin-top: 3px;
}

/* Notifications */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    background: white;
    box-shadow: var(--shadow-lg);
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
    background-color: var(--success-light);
    color: var(--success);
}

.notification-error {
    border-left-color: var(--danger);
    background-color: var(--danger-light);
    color: var(--danger);
}

.notification-info {
    border-left-color: var(--info);
    background-color: #d1ecf1;
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
    .contract-review-container {
        padding: 15px;
    }
    
    .header-content {
        flex-direction: column;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filters-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-box,
    .filter-group {
        width: 100%;
    }
    
    .form-select {
        min-width: 100%;
    }
    
    .modal-content {
        width: 95%;
        margin: 10px auto;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .chart-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .notification {
        left: 20px;
        right: 20px;
        min-width: auto;
        max-width: none;
    }
}

@media (max-width: 480px) {
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        flex-direction: column;
    }
    
    .form-group {
        min-width: 100%;
    }
    
    .checklist-row {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .checklist-row input[type="text"] {
        min-width: 100%;
    }
    
    .capacity-grid {
        grid-template-columns: 1fr;
    }
    
    .pagination-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .pagination-controls {
        justify-content: center;
    }
}
</style>
@endsection