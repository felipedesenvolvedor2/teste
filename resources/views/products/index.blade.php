@extends('layouts')

@section('title', 'Lista de Produtos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Produtos Monitorados</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Adicionar Produto
    </a>
</div>

@forelse ($products as $product)
<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title text-primary">{{ $product->name ?? 'Nome não definido' }}</h5>
        <p><strong>URL:</strong> <a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></p>

        @if ($product->priceHistories->count())
        <h6>Histórico de Preços:</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Data</th>
                        <th>Preço (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->priceHistories->sortByDesc('scraped_at') as $history)
                    <tr>
                        <td>{{ $history->scraped_at->format('d/m/Y H:i') }}</td>
                        <td class="text-success fw-semibold">{{ number_format($history->price, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted"><em>Sem histórico ainda.</em></p>
        @endif
    </div>
</div>
@empty
<div class="alert alert-warning">
    Nenhum produto monitorado ainda.
</div>
@endforelse

<div class="d-flex justify-content-center mt-4">
    {{ $products->links() }}
</div>

@endsection