@extends('layouts.app')

@section('title')
    ExciteExpedetion | Index
@endsection

@section('content')
    <!-- Filtros -->
    <div class="accordion" id="filterAccordion">
        <h2 class="accordion-header" id="headingFilter">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                FILTRAR POR
            </button>
        </h2>
        <div id="collapseFilter" class="accordion-collapse collapse" aria-labelledby="headingFilter">
            <div class="accordion-body">
                <!-- Host -->              <!-- Categoria -->
                @include('includes.accordion', ['filterName' => 'Category', 'options' => $possibleFilterOptions['category']])
            </div>
        </div>

        <!-- Ordenações -->
        <div class="accordion" id="orderAccordion">
            <h2 class="accordion-header" id="headingFilter">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    ORDENAR POR
                </button>
            </h2>
            <div id="collapseOrder" class="accordion-collapse collapse" aria-labelledby="headingOrder">
                <div class="accordion-body bg-white">

                    <!-- Titulo (A-Z) -->
                    <a class="navbar-brand" href="/search/results/orderFilter/{{ $url['searchQuery'] }}/{{ $url['filters']['category'] }} }}/title/asc">
                        <p class="text-dark">Titulo (A-Z)</p>
                    </a>

                </div>
            </div>
        </div>

        <!-- Resultados -->
        <div class="container">
            <div class="row row-cols-3">
                @foreach ($results as $item)
                    <div class="col my-5">
                        <a class="navbar-activity activity-link" class="activity-link" href="{{ route('showDetails', $item->item_id) }}">
                            <p>{{ $item->item_name }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
