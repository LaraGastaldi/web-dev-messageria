@extends('layouts.app')

@section('title', __('view.Login'))

@section('content')

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
    </header>
    <main class="px-3">
        <div class="card border-0 shadow mx-auto p-4" style="max-width: 400px;">
            <h1 class="h3 mb-3 fw-normal text-center">{{ __('view.Login') }}</h1>
            <livewire:pages.auth.login />
            <p>{{ __('view.Or') }} <a href="{{ route('register') }}">{{ __('view.Sign up') }}</a></p>
        </div>
    </main>
    <footer class="mt-auto text-white-50">
    </footer>
</div>

@endsection