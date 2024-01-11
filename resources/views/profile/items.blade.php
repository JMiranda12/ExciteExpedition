@extends('layouts.app')

@section('title')
    ExciteExpedition | Your activities
@endsection

@section('content')
    <div class="container">
        <div class="header">
            <h2>{{ __("Your Activities") }}</h2>
        </div>
        <div class="row m-3">
            <a class="btn-lg btn-primary text-center" href="{{ route('activity.create') }}">{{ __("Host new activity") }}</a>
        </div>
        @if(session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="row row-cols-3">
            @forelse ( $items as $item)
                <div class="col my-5">
                    <a class="navbar-brand activity-link" href="/details/{{ $item->id }}">
                        <img src="/app/public/images/skydive.jpg" class="img-fluid" alt="Photo of activity: {{ ucwords($item->name, ' ') }}">
                        <p>{{ ucwords($item->name, ' ') }}</p>
                    </a>
                </div>
            @empty
                <h3>{{ __("You didn't host any activity") }}</h3>
            @endforelse
        </div>

        {{ $items->links() }}
    </div>
@endsection
