<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details {
            margin-bottom: 20px;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bill for Case #{{ $case->id }}</h1>
        </div>

        <div class="details">
            <h2>Case Details</h2>
            <p><strong>Date:</strong> {{ $case->created_at->format('d/m/Y') }}</p>
            <p><strong>Description:</strong> {{ $case->description }}</p>
        </div>

        <div class="details">
            <h2>Vehicle Information</h2>
            <p><strong>Car:</strong> {{ $car->type->brand->name }} {{ $car->type->name }}</p>
            <p><strong>License Plate:</strong> {{ $car->numberplate }}</p>
            <p><strong>Year:</strong> {{ $car->year }}</p>
        </div>

        <div class="details">
            <h2>Service Provider</h2>
            <p><strong>Mechanic:</strong> {{ $mechanic->name }}</p>
            <p><strong>Company:</strong> {{ $mechanic->company_name }}</p>
            <p><strong>VAT:</strong> {{ $mechanic->vat }}</p>
        </div>

        <div class="price">
            Total Amount: €{{ number_format($offer->price, 2) }}
        </div>

        <div class="footer">
            <p>This is an automated bill for your case. Please contact the mechanic if you have any questions.</p>
            <p>Thank you for choosing our service!</p>
        </div>
    </div>
</body>
</html> 