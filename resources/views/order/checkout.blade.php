@extends('layouts.app')

@section('title')
    ExciteExpedition | Payment
@endsection

@section('content')
    {{-- Shopping Cart --}}
    <div class="card">
        <div class="card-header"><h1>{{ __("Checkout") }}</h1></div>
        <div class="card-body">
            <h2>{{__("Itens a Comprar")}}</h2>
            <table class="table rounded">
                <thead>
                <tr>
                    <th>{{ __("Item") }}</th>
                    <th>{{ __("Quantidade") }}</th>
                    <th>{{ __("Total com iva") }}</th>
                    <th class="text-secondary">{{ __("Total sem iva") }}</th>
                </tr>
                </thead>
                @foreach($shoppingCartItems as $item)
                    <tr>
                        <td><a class="activity-link" href="{{ route('showDetails', ['id' => $item->id]) }}">{{ /* Põe a primeira letra de cada palavra em maiúscula */ ucwords(__($item->name), ' ') }}</a></td>
                        <td>
                            <form class="no-background" method="post">
                                @csrf
                                <span class="input-group-btn btn-group-sm">
                                    <button type="submit" class="quantity-left-minus btn btn-danger btn-number btn-sm"
                                            data-type="minus" data-field="" formaction="{{ route('order.remove_from_cart', ['item_id' => $item->id]) }}">
                                        <span>-</span>
                                    </button>
                                </span>

                                <span class="number">{{ $item->qty }}</span>

                                <span class="input-group-btn btn-group-sm">
                                    <input type="submit" class="quantity-right-plus btn btn-success btn-number btn-sm"
                                           data-type="plus" formaction="{{ route('order.add_to_cart', ['item_id' => $item->id]) }}" value="+">
                                </span>
                            </form>
                        <td>{{ $item->total }}€</td>
                        <td class="text-secondary">{{ $item->subtotal }}€</td>
                    </tr>
                @endforeach
                <tr class="secondary-color row-highlight">
                    <td>{{ __('Total') }}</td>
                    <td>{{ $total_qty }}</td>
                    <td>{{ $total_amount_tax_included }}€</td>
                    <td>{{ $total_amount }}€</td>
                </tr>
            </table>
        </div>
        {{-- Payment --}}
        <form action="/session" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-primary" id="checkout-live-button">{{ __('Checkout') }}</button>
        </form>

        {{-- Generate PDF Link --}}
        <a href="{{ route('generate-pdf') }}" class="btn btn-primary">{{ __('Generate PDF') }}</a>
    </div>
@endsection

