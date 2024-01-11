<div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ $filterName }}">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $filterName }}" aria-expanded="true" aria-controls="collapse{{ $filterName }}">
            {{ $filterName }}
        </button>
    </h2>
    <div id="collapse{{ $filterName }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $filterName }}">
        <div class="accordion-body">
            {{-- A forma como os href são preenchidos muda consoante o tipo de filtro do accordion --}}
            @switch ($filterName)
                @case('Host')
                    @foreach ($options as $filterResult)
                        @php $url['filters']['host'] = $filterResult->id @endphp
                        <a class="navbar-brand" href="/search/results/orderFilter/{{ $url['searchQuery'] }}/{{ $url['filters']['host'] }}/{{ $url['filters']['category'] }}/{{ $url['order_by'] }}/{{ $url['order_direction'] }}">
                            <p class="text-dark">{{ $filterResult->name }} ({{ $filterResult->count }})</p>
                        </a>
                    @endforeach
                    @break

                @case('Category')
                    @foreach ($options as $filterResult)
                        @php $url['filters']['category'] = $filterResult->id @endphp
                        <a class="navbar-brand" href="/search/results/orderFilter/{{ $url['searchQuery'] }}/{{ $url['filters']['host'] }}/{{ $url['filters']['category'] }}/{{ $url['order_by'] }}/{{ $url['order_direction'] }}">
                            <p class="text-dark">{{ $filterResult->name }} ({{ $filterResult->count }})</p>
                        </a>
                    @endforeach
                    @break
            @endswitch
        </div>
    </div>
</div>
