@extends('layouts')

@section('title', 'Adicionar Produto')

@section('content')
    <div class="mb-4">
        <h1 class="h3">Adicionar Novo Produto</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.store') }}" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="url" class="form-label">URL do Produto:</label>
            <input type="url" name="url" id="url" required class="form-control">
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Salvar
        </button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">
            ← Voltar
        </a>
    </form>
@endsection


