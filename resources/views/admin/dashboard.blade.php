@extends('.layout/layout-main')
@section('page_title', 'Dashboard')
@section('dashboard_select', 'active')

@section('container')

    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible ">
            <span class=""> {{session('message')}}</span>
        </div>
    @endif

    <h1>Dashboard</h1>
@endsection
