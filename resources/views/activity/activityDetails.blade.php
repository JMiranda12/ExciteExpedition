@extends('layouts.app')

@section('title')
    ExciteExpedition | {{ $activity->title }} details
@endsection

@section('content')
    <div class="container scolor activity-details">
        <div class="row">
        <div class="col">
            <img src="{{ asset('storage/image/' . $activity->photos->first()->path) }}" class="custom-left-align img-fluid " alt="Photo of activity: {{ ucwords($activity->title, ' ') }}">
        </div>
            <div class="col">
                <h1>{{ ucwords($activity->title, ' ') }}</h1>

                <h3>ANFITRIÃO</h3>
                <p>{{ $activity->user->name }}</p>

                <h3>PRICE</h3>
                <p>{{ $item->price }}€</p>

                <h3>DESCRIPTION</h3>
                <p>{{ $activity->description }}</p>

                <h3>DETALHES DO PRODUTO</h3>
                <p>Idioma: {{ $language->name }}</p>
                <p>Tipo de produto: {{ $itemType->type }}</p>

                <h3>CATEGORIAS</h3>
                @foreach ($categories as $category)
                    <p>{{ $category->name }}</p>
                @endforeach

                <!-- Botão de comprar -->
                <form method="POST" action="{{ route('order.add_to_cart') }}">
                    @csrf
                    <input type="hidden" name="item_id" value={{ $item->id }}>
                    <input type="submit" class="buy-button btn btn-primary" value="{{ __('Adicionar ao carrinho') }}">

                    <div class="response">
                        @if(session('message'))
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
