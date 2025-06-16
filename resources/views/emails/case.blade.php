<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nieuwe Case aangemaakt.</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f4f7;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        .header {
            background-color: #004080;
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px 25px;
        }
        .content h3 {
            color: #004080;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 6px;
            margin-top: 30px;
        }
        .content p {
            margin: 12px 0;
        }
        .footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #999;
        }
        .highlight {
            background-color: #f0f8ff;
            padding: 12px;
            border-radius: 5px;
            margin-top: 10px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nieuwe Case {{ $case->user->first_name }} </h2>
        </div>

        <div class="content">
            <p>Beste {{ $case->user->first_name }},</p>

            <p>Er is een nieuwe case aangemaakt voor uw voertuig. Hieronder vindt u de details:</p>

            <h3>Voertuig Informatie</h3>
            <div class="highlight">
                <strong>Merk:</strong> {{ $case->car->type->brand->name }}<br>
                <strong>Model:</strong> {{ $case->car->type->name }}<br>
                <strong>Kenteken:</strong> {{ $case->car->numberplate }}
            </div>

            <h3>Case Details</h3>
            <div class="highlight">
                <strong>Beschrijving:</strong><br>
                {{ $case->description }}
            </div>

            @if($case->offer)
            <h3>Offerte Informatie</h3>
            <div class="highlight">
                <strong>Bedrag:</strong> €{{ number_format($case->offer->price, 2, ',', '.') }}<br>
                
            </div>
            @endif

            <p>U kunt de status van uw case aanpassen via uw account op onze website.</p>
        </div>

        <div class="footer">
            <p>Dit is een automatisch gegenereerde e-mail. Gelieve niet te reageren op dit bericht.</p>
        </div>
    </div>
</body>
</html>
