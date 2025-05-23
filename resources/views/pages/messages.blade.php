@extends('layouts.app')

@push('styles')
<style>
    body {
        overflow: hidden; /* Prevents scrollbars */
        margin: 0;
    }
    
    .full-height-container {
        height: 100vh;
        display: flex;
        flex-direction: column;
    }
        
    .scrollable-column {
        overflow-y: auto; /* Enable vertical scrolling */
        height: 100vh; /* Prevents overflow */
        overflow-x: hidden;
    }
    .dropdown-toggle:::before {
        display: none !important; /* Hide the default caret */
    }
</style>
@endpush

@section('title', __('view.Messages'))

@section('content')
<div class="container-fluid full-height-container p-0">
    <div class="row g-0 flex-grow-1">
        <div class="col-md-3 border-end p-4">
            <div class="row border-bottom">
                <div class="col-3 ps-4 pt-2">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #007bff; padding:">
                    </div>
                </div>
                <div class="col-6 pt-2 d-flex flex-column justify-content-center">
                    <h5>{{ auth()->user()->username }}</h5>
                    <p>{{ auth()->user()->email }}</p>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item position-relative" href="#">
                                        Notificações
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            99+
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <livewire:forms.add-friend />
                    </div>
                </div>
            </div>
            <div class="scrollable-column">
                <div class="row">
                    <div class="col-12">
                        <h2 class="h5">Amigos</h2>
                        @if ($friends->isEmpty())
                            <p class="text-muted">Você não tem amigos ainda.</p>
                        @else
                        <ul class="list-group">
                            @foreach ($friends as $friend)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #007bff; margin-right: 10px;"></div>
                                        <span>{{ $friend->username }}</span>
                                    </div>
                                    <button class="btn btn-primary btn-sm">Enviar Mensagem</button>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-md-9 p-4">
            <h2>Right Column</h2>
            <p>This column matches the left column's height.</p>
        </div>
    </div>
</div>
{{-- <div class="container-fluid full-height">
    <div class="row full-height">
        <!-- Left Column -->
        <div class="col-md-4 p-0 bg-primary">
            <div class="h-100 p-4 text-white">
                
            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-md-8 p-0 bg-secondary">
            <div class="h-100 p-4">
                <h2>Right Column</h2>
                <p>This column takes up the other half.</p>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('scripts')
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script>
Pusher.logToConsole = true;
window.Pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
    cluster: 'sa1'
});
var channel = window.Pusher.subscribe('chat.{{ $channel }}');
channel.bind('message', function(data) {
    console.log(data);
    // Handle the message event
    // You can update the UI or perform any other actions here
});
</script>
@endpush