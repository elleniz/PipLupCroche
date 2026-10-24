<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Compra</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body style="font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; padding: 20px;">

    <div class="container">

        <h1 class="text-center fw-bold"
            style="color: #6d3f36;">
            PipLup Crochê
        </h1>

        <h3 class="text-center mb-4">
            {{ $titulo }}
        </h3>

        <p class="text-end">
            Data do relatório: {{ $date }}
        </p>

        <p style="margin-top: 30px; margin-bottom: 30px; text-align: center;">

            <span style="display: inline-block; width: 42%; margin-right: 4%; text-align: center; vertical-align: top;">
                <span style="display: block; font-size: 13px; color: #6d3f36; margin-bottom: 8px;">
                    NÚMERO TOTAL DE COMPRAS
                </span>

                <strong style="font-size: 32px; color: #6d3f36;">
                    {{ $totalVendas }}
                </strong>
            </span>

            <span style="display: inline-block; width: 42%; text-align: center; vertical-align: top;">
                <span style="display: block; font-size: 13px; color: #6d3f36; margin-bottom: 8px;">
                    VALOR TOTAL GASTO
                </span>

                <strong style="font-size: 28px; color: #6d3f36;">
                    R$ {{ number_format($valorArrecadado, 2, ',', '.') }}
                </strong>
            </span>

        </p>

        <table class="table table-bordered"
               style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #e7b9bd;">
                    <th style="padding: 8px; border: 1px solid #999;">ID</th>
                    <th style="padding: 8px; border: 1px solid #999;">Fornecedor</th>
                    <th style="padding: 8px; border: 1px solid #999;">Data da compra</th>
                    <th style="padding: 8px; border: 1px solid #999;">Valor total</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($dados as $compra)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #999;">
                            {{ $compra->id }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #999;">
                            {{ $compra->fornecedor }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #999;">
                            {{ $compra->data_compra }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #999;">
                            R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 8px; border: 1px solid #999;">
                            Nenhuma compra cadastrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>
</html>
