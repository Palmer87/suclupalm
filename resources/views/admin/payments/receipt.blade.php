<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement #{{ $payment->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #eee;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #3366cc;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #3366cc;
        }

        .receipt-title {
            text-align: center;
            text-transform: uppercase;
            font-size: 28px;
            letter-spacing: 2px;
            margin: 20px 0;
            color: #3366cc;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #666;
        }

        .value {
            font-weight: bold;
        }

        .payment-details {
            margin: 40px 0;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .amount-big {
            font-size: 24px;
            text-align: center;
            padding: 15px;
            border: 2px dashed #3366cc;
            margin: 20px 0;
            background: #fff;
        }

        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            width: 200px;
            text-align: center;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            margin-top: 60px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
            white-space: nowrap;
            pointer-events: none;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }

            .receipt-container {
                border: none;
            }
        }
    </style>
</head>

<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()"
            style="padding: 10px 20px; cursor: pointer; background: #3366cc; color: white; border: none; border-radius: 4px;">Imprimer
            le reçu</button>
        <button onclick="window.close()"
            style="padding: 10px 20px; cursor: pointer; background: #666; color: white; border: none; border-radius: 4px; margin-left: 10px;">Fermer</button>
    </div>

    <div class="receipt-container">
        <div class="watermark">PAYÉ</div>

        <div class="header">
            <div class="logo">SGS - ÉCOLE</div>
            <div style="text-align: right;">
                <div class="value">REÇU #{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div>Date: {{ \Carbon\Carbon::parse($payment->date_paiement)->format('d/m/Y') }}</div>
            </div>
        </div>

        <div class="receipt-title">Reçu de Paiement</div>

        <div class="info-row">
            <div>
                <span class="label">Élève:</span>
                <span class="value">{{ $payment->facture->inscription->student->nom }}
                    {{ $payment->facture->inscription->student->prenom }}</span>
            </div>
            <div>
                <span class="label">Matricule:</span>
                <span class="value">{{ $payment->facture->inscription->student->matricule }}</span>
            </div>
        </div>

        <div class="info-row">
            <div>
                <span class="label">Classe:</span>
                <span class="value">{{ $payment->facture->inscription->classe->nom }}</span>
            </div>
            <div>
                <span class="label">Facture:</span>
                <span class="value">#{{ $payment->facture->id }}</span>
            </div>
        </div>

        <div class="payment-details">
            <div class="info-row">
                <span class="label">Mode de paiement:</span>
                <span class="value">{{ ucfirst($payment->mode_paiement) }}</span>
            </div>
            @if($payment->reference)
                <div class="info-row">
                    <span class="label">Référence:</span>
                    <span class="value">{{ $payment->reference }}</span>
                </div>
            @endif

            <div class="amount-big">
                {{ number_format($payment->montant, 0, ',', ' ') }} FCFA
            </div>

            <div style="font-style: italic; text-align: center;">
                Arrêté le présent reçu à la somme de : <strong>{{ $amountInWords }} francs CFA</strong>.
            </div>
        </div>

        <div style="margin-top: 20px;">
            <div class="info-row">
                <span class="label">Total Facture:</span>
                <span>{{ number_format($payment->facture->montant_total, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="info-row">
                <span class="label">Déjà Payé:</span>
                <span>{{ number_format($payment->facture->payments->where('date_paiement', '<=', $payment->date_paiement)->sum('montant'), 0, ',', ' ') }}
                    FCFA</span>
            </div>
            <div class="info-row" style="border-top: 1px solid #ddd; padding-top: 10px;">
                <span class="label" style="color: #d9534f;">Reste à Payer:</span>
                <span class="value" style="color: #d9534f;">{{ number_format($payment->facture->reste, 0, ',', ' ') }}
                    FCFA</span>
            </div>
        </div>

        <div class="footer">
            <div class="signature-box">Signature Parent</div>
            <div class="signature-box">Cachet de l'École</div>
        </div>

        <div style="margin-top: 40px; font-size: 10px; text-align: center; color: #999;">
            Généré le {{ date('d/m/Y H:i') }} par le système SGS.
        </div>
    </div>
</body>

</html>