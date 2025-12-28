<h2>Relatório de pedidos - Últimos 7 dias</h2>

@forelse ($resumo as $status => $dados)
    <p>
        <strong>Status:</strong> {{ ucfirst($status) }} <br>
        Quantidade: {{ $dados['quantidade'] }} <br>
        Valor total: R$ {{ number_format($dados['valor_total'], 2, ',', '.') }}
    </p>
@empty
    <p>Nenhum pedido registrado nos últimos 7 dias.</p>
@endforelse
