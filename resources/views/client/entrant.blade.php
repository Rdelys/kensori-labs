@extends('layouts.clients')

@section('title', 'Stock entrant')

@section('content')
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --gray-color: #95a5a6;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: 700;
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #219653;
            transform: translateY(-2px);
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
        }

        .btn-outline:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        /* KPI Section */
        .kpi-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: var(--transition);
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .kpi-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .kpi-info {
            flex: 1;
        }

        .kpi-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .kpi-label {
            font-size: 0.9rem;
            color: var(--gray-color);
            font-weight: 500;
        }

        .kpi-trend {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .trend-up {
            color: var(--success-color);
        }

        .trend-down {
            color: var(--accent-color);
        }

        /* Charts Section */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .charts-container {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .action-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #e3f2fd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--secondary-color);
            font-size: 1.5rem;
        }

        .action-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Form Section (Inline, not modal) */
        .form-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            display: none; /* Hidden by default */
        }

        .form-section.active {
            display: block;
            animation: formSlideIn 0.5s ease-out;
        }

        @keyframes formSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .close-form {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray-color);
            transition: var(--transition);
        }

        .close-form:hover {
            color: var(--accent-color);
        }

        /* Data Table */
        .data-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .search-filter {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-box {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            width: 200px;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background-color: white;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .data-table th {
            background-color: #f1f5f9;
            color: var(--primary-color);
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }

        .data-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table tr:hover {
            background-color: #f8fafc;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-received {
            background-color: #d4edda;
            color: #155724;
        }

        .status-partial {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-delayed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-quality {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--secondary-color);
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .action-btn:hover {
            color: var(--primary-color);
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-input {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .products-table th,
        .products-table td {
            padding: 12px;
            border: 1px solid #e2e8f0;
            text-align: left;
        }

        .products-table th {
            background-color: #f8fafc;
            font-weight: 600;
        }

        .add-product-btn {
            background-color: #f1f5f9;
            color: var(--secondary-color);
            border: 1px dashed #cbd5e1;
            width: 100%;
            padding: 12px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .add-product-btn:hover {
            background-color: #e2e8f0;
        }

        /* Alert Section */
        .alerts-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }

        .alert-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .alert-warning {
            background-color: var(--warning-color);
        }

        .alert-danger {
            background-color: var(--accent-color);
        }

        .alert-info {
            background-color: var(--secondary-color);
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .alert-desc {
            font-size: 0.9rem;
            color: var(--gray-color);
        }

        .alert-time {
            font-size: 0.8rem;
            color: var(--gray-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
            
            .kpi-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            
            .kpi-card {
                padding: 15px;
            }
            
            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .chart-card {
                padding: 15px;
            }
            
            .chart-container {
                height: 250px;
            }
            
            .form-section, .data-section, .alerts-section {
                padding: 15px;
            }
            
            .search-box {
                width: 100%;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .kpi-container {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .charts-container {
                gap: 15px;
            }
        }

        /* Animation for alerts */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }

        /* Scan simulation */
        .scan-area {
            border: 2px dashed var(--secondary-color);
            border-radius: var(--border-radius);
            padding: 40px;
            text-align: center;
            margin-bottom: 20px;
            background-color: #f8fafc;
            cursor: pointer;
            transition: var(--transition);
        }

        .scan-area:hover {
            background-color: #e3f2fd;
        }

        .scan-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .scan-text {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .scan-hint {
            font-size: 0.9rem;
            color: var(--gray-color);
        }

        /* Form toggle button */
        .form-toggle-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .form-toggle-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            color: var(--primary-color);
            transition: var(--transition);
        }

        .form-toggle-btn:hover {
            background-color: #e2e8f0;
            border-color: var(--secondary-color);
        }

        .form-toggle-btn i {
            transition: transform 0.3s ease;
        }

        .form-toggle-btn.collapsed i {
            transform: rotate(180deg);
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title">
                <i class="fas fa-boxes"></i> Gestion du Stock Entrant
            </h1>
            <div class="header-actions">
                <button class="btn btn-outline" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Actualiser
                </button>
                <button class="btn btn-primary" id="newReceptionBtn">
                    <i class="fas fa-truck-loading"></i> Nouvelle Réception
                </button>
                <button class="btn btn-warning" id="quickInventoryBtn">
                    <i class="fas fa-clipboard-check"></i> Inventaire Rapide
                </button>
            </div>
        </div>

        <!-- KPI Section -->
        <div class="kpi-container">
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #3498db;">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">18</div>
                    <div class="kpi-label">Livraisons Attendues Aujourd'hui</div>
                    <div class="kpi-trend trend-up">
                        <i class="fas fa-arrow-up"></i> 3 vs hier
                    </div>
                </div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #2ecc71;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">92%</div>
                    <div class="kpi-label">Taux de Conformité</div>
                    <div class="kpi-trend trend-up">
                        <i class="fas fa-arrow-up"></i> 2% vs hier
                    </div>
                </div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #e74c3c;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">5</div>
                    <div class="kpi-label">Non-Conformités du Jour</div>
                    <div class="kpi-trend trend-down">
                        <i class="fas fa-arrow-down"></i> 3 vs hier
                    </div>
                </div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #f39c12;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">1.8h</div>
                    <div class="kpi-label">Temps Moyen de Réception</div>
                    <div class="kpi-trend trend-down">
                        <i class="fas fa-arrow-down"></i> 0.4h vs hier
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <div class="action-card" id="scanBarcodeBtn">
                <div class="action-icon">
                    <i class="fas fa-barcode"></i>
                </div>
                <div class="action-label">Scanner Code-barres</div>
            </div>
            
            <div class="action-card" id="quickCheckinBtn">
                <div class="action-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="action-label">Réception Rapide</div>
            </div>
            
            <div class="action-card" id="qcControlBtn">
                <div class="action-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="action-label">Contrôle Qualité</div>
            </div>
            
            <div class="action-card" id="locationAssignBtn">
                <div class="action-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="action-label">Assigner Emplacement</div>
            </div>
            
            <div class="action-card" id="ncReportBtn">
                <div class="action-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="action-label">Rapport NC</div>
            </div>
            
            <div class="action-card" id="supplierRatingBtn">
                <div class="action-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="action-label">Évaluer Fournisseur</div>
            </div>
        </div>

        <!-- Form Toggle Button -->
        <div class="form-toggle-container">
            <button class="form-toggle-btn collapsed" id="formToggleBtn">
                <i class="fas fa-chevron-down"></i>
                <span>Afficher le formulaire de nouvelle réception</span>
            </button>
        </div>

        <!-- Form Section (Inline, not modal) -->
        <div class="form-section" id="receptionFormSection">
            <div class="form-header">
                <h3 class="form-title">
                    <i class="fas fa-truck-loading"></i> Nouvelle Réception
                </h3>
                <button class="close-form" id="closeFormBtn">&times;</button>
            </div>
            <div class="form-body">
                <form id="receptionForm">
                    <div class="scan-area" id="scanArea">
                        <div class="scan-icon">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <div class="scan-text">Scanner le Bon de Livraison</div>
                        <div class="scan-hint">Cliquez ici pour scanner ou importer le BL</div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="blNumber">N° Bon de Livraison</label>
                            <input type="text" class="form-input" id="blNumber" placeholder="Ex: BL-2023-0456" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="supplierName">Fournisseur</label>
                            <select class="form-input" id="supplierName" required>
                                <option value="">Sélectionner un fournisseur</option>
                                <option value="1">TechnoParts SA</option>
                                <option value="2">ElectroPlus Distribution</option>
                                <option value="3">MecaPro Industries</option>
                                <option value="4">AutoSolution France</option>
                                <option value="5">LogiTech Europe</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="receptionDate">Date de Réception</label>
                            <input type="datetime-local" class="form-input" id="receptionDate" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="expectedDate">Date Attendue</label>
                            <input type="date" class="form-input" id="expectedDate" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group" style="flex: 1;">
                            <label class="form-label" for="contactPerson">Contact Fournisseur</label>
                            <input type="text" class="form-input" id="contactPerson" placeholder="Nom et coordonnées">
                        </div>
                        
                        <div class="form-group" style="flex: 1;">
                            <label class="form-label" for="orderReference">Référence Commande</label>
                            <input type="text" class="form-input" id="orderReference" placeholder="N° commande fournisseur">
                        </div>
                    </div>
                    
                    <h4 style="margin: 25px 0 15px 0; color: var(--primary-color);">Produits Reçus</h4>
                    
                    <button type="button" class="add-product-btn" id="addReceivedProductBtn">
                        <i class="fas fa-plus"></i> Ajouter un Produit Reçu
                    </button>
                    
                    <table class="products-table" id="receivedProductsTable">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Désignation</th>
                                <th>Quantité Attendue</th>
                                <th>Quantité Reçue</th>
                                <th>N° Lot/Série</th>
                                <th>Emplacement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="receivedProductsTableBody">
                            <tr>
                                <td><input type="text" class="form-input" placeholder="REF-001" style="width: 100%;"></td>
                                <td><input type="text" class="form-input" placeholder="Moteur électrique 5kW" style="width: 100%;"></td>
                                <td><input type="number" class="form-input" value="10" min="0" style="width: 100%;"></td>
                                <td><input type="number" class="form-input" value="10" min="0" style="width: 100%;"></td>
                                <td><input type="text" class="form-input" placeholder="LOT-2023-09" style="width: 100%;"></td>
                                <td><input type="text" class="form-input" placeholder="A-12-34" style="width: 100%;"></td>
                                <td style="text-align: center;">
                                    <button type="button" class="action-btn remove-received-product">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="form-group" style="margin-top: 20px;">
                        <label class="form-label" for="qualityNotes">Notes de Qualité / Observations</label>
                        <textarea class="form-input" id="qualityNotes" rows="3" placeholder="Observations sur la qualité, emballage, etc."></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="cancelReceptionBtn">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer la Réception</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Réceptions par Fournisseur (7 derniers jours)</h3>
                    <select class="filter-select">
                        <option>7 jours</option>
                        <option>30 jours</option>
                        <option>90 jours</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="suppliersChart"></canvas>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Statut des Réceptions (Ce mois)</h3>
                    <select class="filter-select">
                        <option>Ce mois</option>
                        <option>Mois dernier</option>
                        <option>Cette année</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Alerts Section -->
        <div class="alerts-section">
            <div class="section-header">
                <h2 class="section-title">Alertes et Rappels</h2>
                <button class="btn btn-outline" id="markAllReadBtn">
                    <i class="fas fa-check-double"></i> Tout marquer comme lu
                </button>
            </div>
            
            <div id="alertsContainer">
                <!-- Alerts will be populated by JavaScript -->
            </div>
        </div>

        <!-- Data Table -->
        <div class="data-section">
            <div class="section-header">
                <h2 class="section-title">Réceptions Récentes</h2>
                <div class="search-filter">
                    <input type="text" class="search-box" placeholder="Rechercher...">
                    <select class="filter-select" id="statusFilter">
                        <option>Tous les statuts</option>
                        <option>En attente</option>
                        <option>Partiellement reçu</option>
                        <option>Reçu</option>
                        <option>Contrôle qualité</option>
                        <option>En retard</option>
                    </select>
                    <select class="filter-select" id="supplierFilter">
                        <option>Tous les fournisseurs</option>
                        <option>TechnoParts SA</option>
                        <option>ElectroPlus Distribution</option>
                        <option>MecaPro Industries</option>
                        <option>AutoSolution France</option>
                        <option>LogiTech Europe</option>
                    </select>
                </div>
            </div>
            
            <div class="table-container">
                <table class="data-table" id="receptionsTable">
                    <thead>
                        <tr>
                            <th>N° Bon de Livraison</th>
                            <th>Fournisseur</th>
                            <th>Date Réception</th>
                            <th>Produits</th>
                            <th>Quantité</th>
                            <th>Statut</th>
                            <th>Contrôle QC</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="receptionsTableBody">
                        <!-- Data will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                <div style="color: var(--gray-color); font-size: 0.9rem;">
                    Affichage de <span id="startRow">1</span> à <span id="endRow">10</span> sur <span id="totalRows">32</span> réceptions
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-outline" id="prevPageBtn">
                        <i class="fas fa-chevron-left"></i> Précédent
                    </button>
                    <button class="btn btn-outline" id="nextPageBtn">
                        Suivant <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Sample data for receptions
        const receptionsData = [
            { id: 1, blNumber: "BL-2023-0456", supplier: "TechnoParts SA", receptionDate: "2023-10-16T09:30:00", products: "3 produits", quantity: "45 pièces", status: "received", qcStatus: "Passé", expectedDate: "2023-10-16" },
            { id: 2, blNumber: "BL-2023-0457", supplier: "ElectroPlus Distribution", receptionDate: "2023-10-16T10:15:00", products: "5 produits", quantity: "120 pièces", status: "partial", qcStatus: "En cours", expectedDate: "2023-10-16" },
            { id: 3, blNumber: "BL-2023-0458", supplier: "MecaPro Industries", receptionDate: "2023-10-15T14:20:00", products: "2 produits", quantity: "30 pièces", status: "quality", qcStatus: "En attente", expectedDate: "2023-10-14" },
            { id: 4, blNumber: "BL-2023-0459", supplier: "AutoSolution France", receptionDate: "2023-10-15T11:45:00", products: "7 produits", quantity: "85 pièces", status: "pending", qcStatus: "Non effectué", expectedDate: "2023-10-17" },
            { id: 5, blNumber: "BL-2023-0460", supplier: "LogiTech Europe", receptionDate: "2023-10-14T16:30:00", products: "4 produits", quantity: "60 pièces", status: "delayed", qcStatus: "Échoué", expectedDate: "2023-10-12" },
            { id: 6, blNumber: "BL-2023-0461", supplier: "TechnoParts SA", receptionDate: "2023-10-14T08:15:00", products: "1 produit", quantity: "25 pièces", status: "received", qcStatus: "Passé", expectedDate: "2023-10-14" },
            { id: 7, blNumber: "BL-2023-0462", supplier: "ElectroPlus Distribution", receptionDate: "2023-10-13T13:40:00", products: "6 produits", quantity: "150 pièces", status: "received", qcStatus: "Passé", expectedDate: "2023-10-13" },
            { id: 8, blNumber: "BL-2023-0463", supplier: "MecaPro Industries", receptionDate: "2023-10-12T10:00:00", products: "3 produits", quantity: "40 pièces", status: "quality", qcStatus: "En cours", expectedDate: "2023-10-12" },
            { id: 9, blNumber: "BL-2023-0464", supplier: "AutoSolution France", receptionDate: "2023-10-11T15:20:00", products: "2 produits", quantity: "35 pièces", status: "partial", qcStatus: "Passé", expectedDate: "2023-10-11" },
            { id: 10, blNumber: "BL-2023-0465", supplier: "LogiTech Europe", receptionDate: "2023-10-10T09:10:00", products: "5 produits", quantity: "90 pièces", status: "delayed", qcStatus: "Échoué", expectedDate: "2023-10-08" },
            { id: 11, blNumber: "BL-2023-0466", supplier: "TechnoParts SA", receptionDate: "2023-10-09T14:55:00", products: "4 produits", quantity: "55 pièces", status: "received", qcStatus: "Passé", expectedDate: "2023-10-09" },
            { id: 12, blNumber: "BL-2023-0467", supplier: "ElectroPlus Distribution", receptionDate: "2023-10-08T11:30:00", products: "3 produits", quantity: "70 pièces", status: "pending", qcStatus: "Non effectué", expectedDate: "2023-10-10" },
            { id: 13, blNumber: "BL-2023-0468", supplier: "MecaPro Industries", receptionDate: "2023-10-07T16:45:00", products: "2 produits", quantity: "20 pièces", status: "received", qcStatus: "Passé", expectedDate: "2023-10-07" },
            { id: 14, blNumber: "BL-2023-0469", supplier: "AutoSolution France", receptionDate: "2023-10-06T08:20:00", products: "6 produits", quantity: "110 pièces", status: "quality", qcStatus: "En attente", expectedDate: "2023-10-06" },
            { id: 15, blNumber: "BL-2023-0470", supplier: "LogiTech Europe", receptionDate: "2023-10-05T13:15:00", products: "1 produit", quantity: "15 pièces", status: "partial", qcStatus: "En cours", expectedDate: "2023-10-05" }
        ];

        // Sample alerts data
        const alertsData = [
            { id: 1, type: "warning", title: "Livraison en retard", desc: "BL-2023-0460 de LogiTech Europe a 2 jours de retard", time: "Il y a 2 heures" },
            { id: 2, type: "danger", title: "Non-conformité détectée", desc: "3 pièces défectueuses dans la réception BL-2023-0457", time: "Il y a 3 heures" },
            { id: 3, type: "info", title: "Contrôle qualité en attente", desc: "2 réceptions nécessitent un contrôle QC", time: "Il y a 5 heures" },
            { id: 4, type: "warning", title: "Stock minimum atteint", desc: "Le produit REF-512 est en dessous du stock de sécurité", time: "Il y a 1 jour" },
            { id: 5, type: "info", title: "Inventaire planifié", desc: "Inventaire tournant de la Zone B prévu demain", time: "Il y a 2 jours" }
        ];

        // Pagination variables
        let currentPage = 1;
        const rowsPerPage = 10;
        let filteredReceptions = [...receptionsData];

        // DOM Elements
        const newReceptionBtn = document.getElementById('newReceptionBtn');
        const quickInventoryBtn = document.getElementById('quickInventoryBtn');
        const refreshBtn = document.getElementById('refreshBtn');
        const scanBarcodeBtn = document.getElementById('scanBarcodeBtn');
        const quickCheckinBtn = document.getElementById('quickCheckinBtn');
        const qcControlBtn = document.getElementById('qcControlBtn');
        const locationAssignBtn = document.getElementById('locationAssignBtn');
        const ncReportBtn = document.getElementById('ncReportBtn');
        const supplierRatingBtn = document.getElementById('supplierRatingBtn');
        const markAllReadBtn = document.getElementById('markAllReadBtn');
        
        const receptionFormSection = document.getElementById('receptionFormSection');
        const formToggleBtn = document.getElementById('formToggleBtn');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const receptionForm = document.getElementById('receptionForm');
        const scanArea = document.getElementById('scanArea');
        const addReceivedProductBtn = document.getElementById('addReceivedProductBtn');
        const receivedProductsTableBody = document.getElementById('receivedProductsTableBody');
        
        const searchBox = document.querySelector('.search-box');
        const statusFilter = document.getElementById('statusFilter');
        const supplierFilter = document.getElementById('supplierFilter');
        const receptionsTableBody = document.getElementById('receptionsTableBody');
        const alertsContainer = document.getElementById('alertsContainer');
        const prevPageBtn = document.getElementById('prevPageBtn');
        const nextPageBtn = document.getElementById('nextPageBtn');
        const startRowEl = document.getElementById('startRow');
        const endRowEl = document.getElementById('endRow');
        const totalRowsEl = document.getElementById('totalRows');

        // Initialize date fields with current date/time
        const now = new Date();
        const nowFormatted = now.toISOString().slice(0, 16);
        if (document.getElementById('receptionDate')) {
            document.getElementById('receptionDate').value = nowFormatted;
            document.getElementById('expectedDate').valueAsDate = now;
        }

        // Initialize charts
        let suppliersChart, statusChart;

        // Function to initialize charts
        function initializeCharts() {
            // Suppliers Chart
            const suppliersCtx = document.getElementById('suppliersChart').getContext('2d');
            suppliersChart = new Chart(suppliersCtx, {
                type: 'bar',
                data: {
                    labels: ['TechnoParts SA', 'ElectroPlus Dist.', 'MecaPro Ind.', 'AutoSolution', 'LogiTech Europe', 'Autres'],
                    datasets: [
                        {
                            label: 'Nombre de Réceptions',
                            data: [12, 8, 6, 4, 3, 5],
                            backgroundColor: '#3498db',
                            borderColor: '#2980b9',
                            borderWidth: 1
                        },
                        {
                            label: 'Quantité Totale',
                            data: [450, 320, 280, 180, 120, 210],
                            backgroundColor: '#2ecc71',
                            borderColor: '#27ae60',
                            borderWidth: 1,
                            hidden: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 2
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

            // Status Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            statusChart = new Chart(statusCtx, {
                type: 'pie',
                data: {
                    labels: ['Reçues', 'Partielles', 'En attente', 'Contrôle QC', 'En retard'],
                    datasets: [{
                        data: [45, 15, 20, 12, 8],
                        backgroundColor: [
                            '#2ecc71',
                            '#3498db',
                            '#f39c12',
                            '#17a2b8',
                            '#e74c3c'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        }

        // Function to render alerts
        function renderAlerts() {
            alertsContainer.innerHTML = '';
            
            alertsData.forEach(alert => {
                const alertEl = document.createElement('div');
                alertEl.className = 'alert-item';
                
                let iconClass;
                switch(alert.type) {
                    case 'warning': iconClass = 'alert-warning'; break;
                    case 'danger': iconClass = 'alert-danger'; break;
                    case 'info': iconClass = 'alert-info'; break;
                    default: iconClass = 'alert-info';
                }
                
                let icon;
                switch(alert.type) {
                    case 'warning': icon = 'fa-exclamation-triangle'; break;
                    case 'danger': icon = 'fa-times-circle'; break;
                    case 'info': icon = 'fa-info-circle'; break;
                    default: icon = 'fa-info-circle';
                }
                
                alertEl.innerHTML = `
                    <div class="alert-icon ${iconClass}">
                        <i class="fas ${icon}"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">${alert.title}</div>
                        <div class="alert-desc">${alert.desc}</div>
                    </div>
                    <div class="alert-time">${alert.time}</div>
                `;
                
                alertsContainer.appendChild(alertEl);
            });
        }

        // Function to render receptions table
        function renderReceptionsTable() {
            receptionsTableBody.innerHTML = '';
            
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, filteredReceptions.length);
            
            for (let i = startIndex; i < endIndex; i++) {
                const reception = filteredReceptions[i];
                const row = document.createElement('tr');
                
                // Determine status badge class
                let statusClass, statusText;
                switch(reception.status) {
                    case 'pending':
                        statusClass = 'status-pending';
                        statusText = 'En attente';
                        break;
                    case 'partial':
                        statusClass = 'status-partial';
                        statusText = 'Partiellement reçu';
                        break;
                    case 'received':
                        statusClass = 'status-received';
                        statusText = 'Reçu';
                        break;
                    case 'quality':
                        statusClass = 'status-quality';
                        statusText = 'Contrôle qualité';
                        break;
                    case 'delayed':
                        statusClass = 'status-delayed';
                        statusText = 'En retard';
                        break;
                    default:
                        statusClass = 'status-pending';
                        statusText = 'En attente';
                }
                
                // Determine QC status color
                let qcColor;
                switch(reception.qcStatus) {
                    case 'Passé': qcColor = '#2ecc71'; break;
                    case 'Échoué': qcColor = '#e74c3c'; break;
                    case 'En cours': qcColor = '#f39c12'; break;
                    case 'En attente': qcColor = '#3498db'; break;
                    default: qcColor = '#95a5a6';
                }
                
                // Format dates
                const receptionDate = new Date(reception.receptionDate);
                const formattedDate = receptionDate.toLocaleDateString('fr-FR') + ' ' + receptionDate.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
                const formattedExpectedDate = new Date(reception.expectedDate).toLocaleDateString('fr-FR');
                
                row.innerHTML = `
                    <td>${reception.blNumber}</td>
                    <td>${reception.supplier}</td>
                    <td>${formattedDate}</td>
                    <td>${reception.products}</td>
                    <td>${reception.quantity}</td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    <td style="color: ${qcColor}; font-weight: 600;">${reception.qcStatus}</td>
                    <td>
                        <div class="action-icons">
                            <button class="action-btn" title="Voir détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn" title="QC">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                receptionsTableBody.appendChild(row);
            }
            
            // Update pagination info
            startRowEl.textContent = startIndex + 1;
            endRowEl.textContent = endIndex;
            totalRowsEl.textContent = filteredReceptions.length;
            
            // Update button states
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = endIndex >= filteredReceptions.length;
        }

        // Function to filter receptions
        function filterReceptions() {
            const searchTerm = searchBox.value.toLowerCase();
            const statusFilterValue = statusFilter.value;
            const supplierFilterValue = supplierFilter.value;
            
            filteredReceptions = receptionsData.filter(reception => {
                // Search filter
                const matchesSearch = reception.blNumber.toLowerCase().includes(searchTerm) || 
                                     reception.supplier.toLowerCase().includes(searchTerm) ||
                                     reception.products.toLowerCase().includes(searchTerm);
                
                // Status filter
                let matchesStatus = true;
                if (statusFilterValue !== "Tous les statuts") {
                    const statusMap = {
                        "En attente": "pending",
                        "Partiellement reçu": "partial",
                        "Reçu": "received",
                        "Contrôle qualité": "quality",
                        "En retard": "delayed"
                    };
                    matchesStatus = reception.status === statusMap[statusFilterValue];
                }
                
                // Supplier filter
                let matchesSupplier = true;
                if (supplierFilterValue !== "Tous les fournisseurs") {
                    matchesSupplier = reception.supplier === supplierFilterValue;
                }
                
                return matchesSearch && matchesStatus && matchesSupplier;
            });
            
            currentPage = 1;
            renderReceptionsTable();
        }

        // Function to toggle form visibility
        function toggleForm() {
            const isVisible = receptionFormSection.classList.contains('active');
            
            if (isVisible) {
                // Hide form
                receptionFormSection.classList.remove('active');
                formToggleBtn.classList.add('collapsed');
                formToggleBtn.innerHTML = '<i class="fas fa-chevron-down"></i><span>Afficher le formulaire de nouvelle réception</span>';
            } else {
                // Show form
                receptionFormSection.classList.add('active');
                formToggleBtn.classList.remove('collapsed');
                formToggleBtn.innerHTML = '<i class="fas fa-chevron-up"></i><span>Masquer le formulaire de nouvelle réception</span>';
                
                // Scroll to form smoothly
                receptionFormSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Function to add received product row to form
        function addReceivedProductRow() {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" class="form-input" placeholder="REF-001" style="width: 100%;"></td>
                <td><input type="text" class="form-input" placeholder="Moteur électrique 5kW" style="width: 100%;"></td>
                <td><input type="number" class="form-input" value="10" min="0" style="width: 100%;"></td>
                <td><input type="number" class="form-input" value="10" min="0" style="width: 100%;"></td>
                <td><input type="text" class="form-input" placeholder="LOT-2023-09" style="width: 100%;"></td>
                <td><input type="text" class="form-input" placeholder="A-12-34" style="width: 100%;"></td>
                <td style="text-align: center;">
                    <button type="button" class="action-btn remove-received-product">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            receivedProductsTableBody.appendChild(row);
            
            // Add event listener to the new remove button
            row.querySelector('.remove-received-product').addEventListener('click', function() {
                // Only remove if there's more than one row
                if (receivedProductsTableBody.children.length > 1) {
                    row.remove();
                } else {
                    alert("Au moins un produit est requis.");
                }
            });
        }

        // Function to reset form
        function resetForm() {
            receptionForm.reset();
            
            // Reset products table to one row
            receivedProductsTableBody.innerHTML = `
                <tr>
                    <td><input type="text" class="form-input" placeholder="REF-001" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" placeholder="Moteur électrique 5kW" style="width: 100%;"></td>
                    <td><input type="number" class="form-input" value="10" min="0" style="width: 100%;"></td>
                    <td><input type="number" class="form-input" value="10" min="0" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" placeholder="LOT-2023-09" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" placeholder="A-12-34" style="width: 100%;"></td>
                    <td style="text-align: center;">
                        <button type="button" class="action-btn remove-received-product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            
            // Reset dates
            const now = new Date();
            const nowFormatted = now.toISOString().slice(0, 16);
            document.getElementById('receptionDate').value = nowFormatted;
            document.getElementById('expectedDate').valueAsDate = now;
        }

        // Event Listeners for main actions
        newReceptionBtn.addEventListener('click', function() {
            // Show form when clicking "Nouvelle Réception" button
            if (!receptionFormSection.classList.contains('active')) {
                toggleForm();
            }
        });

        quickInventoryBtn.addEventListener('click', function() {
            alert("Fonctionnalité d'inventaire rapide à venir prochainement!");
        });

        refreshBtn.addEventListener('click', function() {
            // Add loading animation
            refreshBtn.querySelector('i').classList.add('fa-spin');
            
            // Simulate data refresh
            setTimeout(() => {
                refreshBtn.querySelector('i').classList.remove('fa-spin');
                
                // Show notification
                const notification = document.createElement('div');
                notification.textContent = "Données de réception actualisées!";
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background-color: var(--success-color);
                    color: white;
                    padding: 15px 20px;
                    border-radius: var(--border-radius);
                    box-shadow: var(--box-shadow);
                    z-index: 1001;
                    animation: fadeInOut 3s ease-in-out;
                `;
                
                document.body.appendChild(notification);
                
                // Add CSS for animation
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes fadeInOut {
                        0% { opacity: 0; transform: translateY(-20px); }
                        15% { opacity: 1; transform: translateY(0); }
                        85% { opacity: 1; transform: translateY(0); }
                        100% { opacity: 0; transform: translateY(-20px); }
                    }
                `;
                document.head.appendChild(style);
                
                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
                
            }, 1000);
        });

        // Form toggle button
        formToggleBtn.addEventListener('click', toggleForm);

        // Close form button
        closeFormBtn.addEventListener('click', function() {
            toggleForm();
        });

        // Quick action buttons
        scanBarcodeBtn.addEventListener('click', function() {
            // Show form if hidden
            if (!receptionFormSection.classList.contains('active')) {
                toggleForm();
            }
            
            // Simulate scanning after a delay
            setTimeout(() => {
                document.getElementById('blNumber').value = "BL-2023-0471";
                document.getElementById('supplierName').value = "2";
                alert("Bon de livraison scanné avec succès! Les champs ont été pré-remplis.");
            }, 500);
        });

        quickCheckinBtn.addEventListener('click', function() {
            alert("Mode réception rapide activé. Préparez-vous à scanner les produits.");
            // In a real app, this would activate a continuous scanning mode
        });

        qcControlBtn.addEventListener('click', function() {
            alert("Ouverture du module de contrôle qualité...");
            // In a real app, this would open the QC module
        });

        locationAssignBtn.addEventListener('click', function() {
            alert("Assignation d'emplacements en masse...");
            // In a real app, this would open the location assignment tool
        });

        ncReportBtn.addEventListener('click', function() {
            alert("Génération du rapport des non-conformités...");
            // In a real app, this would generate and download an NC report
        });

        supplierRatingBtn.addEventListener('click', function() {
            alert("Ouverture du module d'évaluation des fournisseurs...");
            // In a real app, this would open the supplier rating module
        });

        markAllReadBtn.addEventListener('click', function() {
            alertsContainer.innerHTML = '<div style="text-align: center; padding: 20px; color: var(--gray-color);">Toutes les alertes ont été marquées comme lues.</div>';
        });

        scanArea.addEventListener('click', function() {
            // Simulate scanning
            scanArea.innerHTML = `
                <div class="scan-icon">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div class="scan-text">Scan en cours...</div>
                <div class="scan-hint">Veuillez pointer le scanner vers le code-barres</div>
            `;
            
            setTimeout(() => {
                scanArea.innerHTML = `
                    <div class="scan-icon" style="color: #2ecc71;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="scan-text">Scan réussi!</div>
                    <div class="scan-hint">BL-2023-0472 a été détecté automatiquement</div>
                `;
                
                // Auto-fill form fields
                document.getElementById('blNumber').value = "BL-2023-0472";
                document.getElementById('supplierName').value = "1";
                document.getElementById('orderReference').value = "CMD-FOURN-5678";
                
                // Add a product row with scanned data
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><input type="text" class="form-input" value="REF-512" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" value="Capteur de pression 5Bar" style="width: 100%;"></td>
                    <td><input type="number" class="form-input" value="50" min="0" style="width: 100%;"></td>
                    <td><input type="number" class="form-input" value="50" min="0" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" value="LOT-2023-10" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" placeholder="B-08-15" style="width: 100%;"></td>
                    <td style="text-align: center;">
                        <button type="button" class="action-btn remove-received-product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                receivedProductsTableBody.appendChild(newRow);
                
            }, 2000);
        });

        receptionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const blNumber = document.getElementById('blNumber').value;
            const supplierName = document.getElementById('supplierName').value;
            const receptionDate = document.getElementById('receptionDate').value;
            const expectedDate = document.getElementById('expectedDate').value;
            
            // In a real application, you would send this data to a server
            // For this demo, we'll just show an alert and reset the form
            alert(`Réception ${blNumber} enregistrée avec succès!`);
            
            // Reset form
            resetForm();
            
            // Refresh the table to show the new reception
            setTimeout(() => {
                alert("Tableau actualisé avec la nouvelle réception");
            }, 500);
        });

        addReceivedProductBtn.addEventListener('click', addReceivedProductRow);

        // Search and filter event listeners
        searchBox.addEventListener('input', filterReceptions);
        statusFilter.addEventListener('change', filterReceptions);
        supplierFilter.addEventListener('change', filterReceptions);

        // Pagination event listeners
        prevPageBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderReceptionsTable();
            }
        });

        nextPageBtn.addEventListener('click', function() {
            if (currentPage * rowsPerPage < filteredReceptions.length) {
                currentPage++;
                renderReceptionsTable();
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
            renderAlerts();
            renderReceptionsTable();
            
            // Add event listeners to existing remove product buttons
            document.querySelectorAll('.remove-received-product').forEach(button => {
                button.addEventListener('click', function() {
                    // Only remove if there's more than one row
                    if (receivedProductsTableBody.children.length > 1) {
                        button.closest('tr').remove();
                    } else {
                        alert("Au moins un produit est requis.");
                    }
                });
            });
        });

        // Simulate real-time updates
        setInterval(() => {
            // Randomly update KPI values for simulation
            const kpiValues = document.querySelectorAll('.kpi-value');
            if (kpiValues.length >= 4) {
                // Update expected deliveries with small random variation
                const currentDeliveries = parseInt(kpiValues[0].textContent);
                const variation = Math.floor(Math.random() * 3) - 1; // -1, 0, or 1
                kpiValues[0].textContent = Math.max(0, currentDeliveries + variation);
                
                // Update compliance rate with small random variation
                const currentRate = parseFloat(kpiValues[1].textContent);
                const rateVariation = (Math.random() * 0.3) - 0.15; // -0.15 to 0.15
                kpiValues[1].textContent = (Math.max(85, Math.min(99, currentRate + rateVariation))).toFixed(1) + '%';
                
                // Add pulse animation to status badges for pending receptions
                const statusBadges = document.querySelectorAll('.status-badge.status-pending');
                statusBadges.forEach(badge => {
                    badge.classList.toggle('pulse');
                });
            }
        }, 7000);
    </script>
@endsection