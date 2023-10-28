@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <div class="sidebar">
            @include('admin.sidebar')
        </div>
        <div class="main-content">
            <div class="card">
                <div class="card-header">Tableau de bord de l'administrateur</div>
                <div class="card-body">
                    <h5>Bienvenue, Administrateur</h5>
                    <p>Vous pouvez gérer les entreprises, les employés et les invitations à partir de ce tableau de bord.</p>
                    <div class="row">
                    <div class="card col-md-3 mb-3 me-5">
                        <div class="card-body">
                            <h5 class="card-title">Total des Employés</h5>
                            <p class="card-text">{{ $totalEmployees ?? 0}}</p>
                            <a href="{{ route('admin.employees') }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>

                    <div class="card col-md-3 mb-3 me-5">
                        <div class="card-body">
                            <h5 class="card-title">Total des Entreprises</h5>
                            <p class="card-text">{{ $totalCompanies ?? 0 }}</p>
                            <a href="{{ route('entreprises.index') }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>

                    <div class="card col-md-3 mb-3 me-5">
                        <div class="card-body">
                            <h5 class="card-title">Invitations Envoyées</h5>
                            <p class="card-text">{{ $totalInvitations ?? 0 }}</p>
                            <a href="{{ route('admin.employees') }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                    </div>
                    <div class="history-section">
                        <h2>Historique</h2>
                        <ul>
                            @foreach($history as $event)
                                <li>{{ $event->created_at }} - {{ $event->action_message }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
