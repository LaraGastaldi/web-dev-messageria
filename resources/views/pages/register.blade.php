@extends('layouts.app')

@section('title', __('view.Register'))

@section('content')

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
    </header>
    <main class="px-3">
        <div class="card border-0 shadow mx-auto p-4" style="max-width: 400px;">
            <h1 class="h3 mb-3 fw-normal text-center">{{ __('view.Register') }}</h1>
            <livewire:pages.auth.register />
        </div>
    </main>
    <footer class="mt-auto text-white-50">
    </footer>
</div>