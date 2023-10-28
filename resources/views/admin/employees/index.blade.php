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
                    <div class="offset-sm-9 col-sm-3">
                        <button type="button" class="btn btn-primary btn-lg">
                            <a class="nav-link" href="{{ route('admin.invitations') }}">
                                   Gérer les invitations 
                            </a>
                        </button>
                     </div><br>  
                     <h5>Liste des employees</h5>               
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width:10%">Photo</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Birthdate</th>
                                <th>Entreprise</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employe)
                            <tr>
                                <td><img src="{{ asset('images/employe.png') }}" width="75%"> </td>
                                <td> {{ $employe->user->name }}</td>
                                <td> {{ $employe->user->email }}</td>
                                <td> {{ $employe->address }}</td>
                                <td> {{ $employe->phone }}</td>
                                <td> {{ $employe->birthdate }}</td>
                                <td> {{ $employe->entreprise->name }}</td>
                            </tr>
                        @endforeach                           
                        
                        </tbody>
                    </table>
   
                </div>
            </div>


    
        </div>
    </div>


    
@endsection
