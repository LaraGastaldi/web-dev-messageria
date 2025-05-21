@extends('layout.app')

@section('title', __('view.Login'))

@section('content')

<div class="d-flex">
    <div class="">
        <livewire:forms.login-form />
    </div>
</div>