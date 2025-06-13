<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Offerte - {{ $offerData['case_id'] ?? 'N/A' }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }
        
        .header {
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-info {
            float: left;
            width: 60%;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }
        
        .company-details {
            color: #666;
            font-size: 12px;
        }
        
        .offer-info {
            float: right;
            width: 35%;
            text-align: right;
        }
        
        .offer-title {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        
        .offer-meta {
            font-size: 12px;
            color: #666;
        }
        
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 5px;
        }
        
        .customer-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .info-section-left {
            float: left;
            width: 48%;
            margin-right: 4%;
        }
        
        .info-section-right {
            float: right;
            width: 48%;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        
        .info-label {
            font-weight: bold;
            width: 120px;
            color: #495057;
        }
        
        .info-value {
            color: #212529;
        }
        
        .description-box {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            white-space: pre-line;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .items-table th {
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        
        .items-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .items-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .text-right {
            text-align: right;
        }
        
        .totals-section {
            float: right;
            width: 300px;
            margin-top: 20px;
        }
        
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .totals-table td {
            padding: 8px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .totals-table .label {
            font-weight: bold;
            text-align: left;
        }
        
        .totals-table .amount {
            text-align: right;
            font-weight: bold;
        }
        
        .total-final {
            background: #007bff;
            color: white;
            font-size: 16px;
        }
        
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 11px;
            color: #666;
            text-align: center;
        }
        
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header clearfix">
        <div class="company-info">
            <div class="company-name">{{ $mechanicData['company_name'] ?? 'N/A' }}</div>
            <div class="company-details">
                <div><strong>Adres:</strong> {{ $mechanicData['adress'] ?? 'N/A' }}</div>
                <div><strong>Email:</strong> {{ $mechanicData['email'] ?? 'N/A' }}</div>
                <div><strong>Telefoon:</strong> {{ $mechanicData['telephone'] ?? 'N/A' }}</div>
                <div><strong>BTW-nummer:</strong> {{ $mechanicData['vat'] ?? 'N/A' }}</div>
            </div>
        </div>
        
        <div class="offer-info">
            <div class="offer-title">OFFERTE</div>
            <div class="offer-meta">
                <div><strong>Offerte #:</strong> {{ $offerData['offer_number'] ?? 'N/A' }}</div>
                <div><strong>Datum:</strong> {{ $offerData['date'] ?? date('d-m-Y') }}</div>
                <div><strong>Case ID:</strong> {{ $offerData['case_id'] ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Customer and Vehicle Information Side by Side -->
    <div class="section clearfix">
        <div class="info-section-left">
            <div class="section-title">KLANT INFORMATIE</div>
            <div class="customer-info">
                <div class="info-row">
                    <span class="info-label">Naam:</span>
                    <span class="info-value">{{ $userData['name'] ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $userData['email'] ?? 'N/A' }}</span>
                </div>
                @if(!empty($userData['telephone']))
                <div class="info-row">
                    <span class="info-label">Telefoon:</span>
                    <span class="info-value">{{ $userData['telephone'] }}</span>
                </div>
                @endif
                @if(!empty($userData['vat']))
                <div class="info-row">
                    <span class="info-label">BTW-nummer:</span>
                    <span class="info-value">{{ $userData['vat'] }}</span>
                </div>
                @endif
            </div>
        </div>
        
        <div class="info-section-right">
            <div class="section-title">VOERTUIG INFORMATIE</div>
            <div class="customer-info">
                <div class="info-row">
                    <span class="info-label">Merk:</span>
                    <span class="info-value">{{ $carData['brand'] ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Model:</span>
                    <span class="info-value">{{ $carData['model'] ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kenteken:</span>
                    <span class="info-value">{{ $carData['numberplate'] ?? 'N/A' }}</span>
                </div>
                @if(!empty($carData['year']))
                <div class="info-row">
                    <span class="info-label">Bouwjaar:</span>
                    <span class="info-value">{{ $carData['year'] }}</span>
                </div>
                @endif
                @if(!empty($carData['fuel']))
                <div class="info-row">
                    <span class="info-label">Brandstof:</span>
                    <span class="info-value">{{ ucfirst($carData['fuel']) }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Problem Description -->
    @if(!empty($offerData['description']))
    <div class="section">
        <div class="section-title">PROBLEEM BESCHRIJVING & DIAGNOSE</div>
        <div class="description-box">{{ $offerData['description'] }}</div>
    </div>
    @endif

    <!-- Parts and Labour -->
    @if(!empty($offerData['items']) && count($offerData['items']) > 0)
    <div class="section">
        <div class="section-title">ONDERDELEN & ARBEID</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Beschrijving</th>
                    <th style="width: 15%; text-align: center;">Aantal</th>
                    <th style="width: 20%; text-align: right;">Prijs per eenheid</th>
                    <th style="width: 15%; text-align: right;">Totaal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offerData['items'] as $item)
                <tr>
                    <td>
                        <strong>{{ $item['name'] }}</strong>
                        @if($item['type'] === 'parts')
                            <br><small style="color: #666;">Onderdeel</small>
                        @else
                            <br><small style="color: #666;">Arbeid</small>
                        @endif
                    </td>
                    <td class="text-right">{{ $item['quantity'] }}</td>
                    <td class="text-right">€{{ number_format($item['price'], 2, ',', '.') }}</td>
                    <td class="text-right">€{{ number_format($item['quantity'] * $item['price'], 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Totals Section -->
    <div class="clearfix">
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td class="label">Subtotaal:</td>
                    <td class="amount">€{{ number_format($offerData['subtotal'], 2, ',', '.') }}</td>
                </tr>
                @if($offerData['vat_enabled'])
                <tr>
                    <td class="label">BTW (21%):</td>
                    <td class="amount">€{{ number_format($offerData['vat_amount'], 2, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="total-final">
                    <td class="label">TOTAAL:</td>
                    <td class="amount">€{{ number_format($offerData['total'], 2, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Terms and Conditions -->
    <div class="section" style="margin-top: 80px;">
        <div class="section-title">ALGEMENE VOORWAARDEN</div>
        <div style="font-size: 11px; color: #666;">
            <p><strong>Geldigheid:</strong> Deze offerte is geldig voor 30 dagen vanaf de offertedatum.</p>
            <p><strong>Betaling:</strong> Betaling dient te geschieden binnen 14 dagen na voltooiing van de werkzaamheden.</p>
            <p><strong>Garantie:</strong> Op alle uitgevoerde werkzaamheden en geleverde onderdelen wordt garantie verleend conform de wettelijke bepalingen.</p>
            <p><strong>Aansprakelijkheid:</strong> {{ $mechanicData['company_name'] ?? 'Het bedrijf' }} is niet aansprakelijk voor indirecte schade of gevolgschade.</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Deze offerte is automatisch gegenereerd op {{ date('d-m-Y H:i') }}</p>
        <p>{{ $mechanicData['company_name'] ?? 'Garage' }} | {{ $mechanicData['email'] ?? '' }} | {{ $mechanicData['telephone'] ?? '' }}</p>
    </div>
</body>
</html> 