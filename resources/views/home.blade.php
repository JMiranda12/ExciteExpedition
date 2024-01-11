@extends('layouts.app')

@section('title')
    ExciteExpedition | Home
@endsection

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="row row-cols-3">
            @foreach ( $activities as $activity)
                <div class="col my-5">
                    <a class="navbar-brand activity-link" href="/details/{{ $activity->item_id }}">
                        <img src="{{ asset('storage/image/' . $activity->photos->first()->path) }}" class="img-fluid activity-cover" alt="Photo of activity: {{ ucwords($activity->title, ' ') }}">
                        <p>{{ ucwords($activity->title, ' ') }}</p>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $activities->links() }}
    </div>
@endsection
