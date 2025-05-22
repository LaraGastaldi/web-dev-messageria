@extends('layouts.app')

@section('title', __('view.Messages'))

@section('content')

<div class="row">
    <div class="col-4">
        <div class="row">
            <div class="col-9 border-end p-3" style="height: 98vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-3 ps-4 pt-2">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #007bff; padding:">
                    </div>
                    </div>
                    <div class="col-6 pt-2 d-flex flex-column justify-content-center">
                        <h5>Username</h5>
                        <p>E-mail</p>
                    </div>
                    <div class="col-3">
                        <div class="text-end">
                            <button class="btn btn-primary" style="margin: 10px auto;">=</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">

    </div>
</div>

@endsection