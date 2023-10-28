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
                    <div class="bg-light">
                        <h5>Formulaire d'ajout d'un nouvel administrateur</h5>                    
                         <form  method="post" action="{{ route('admin.add-admin') }}" id="addAdminForm" class="bg-light">
                             @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <span class="error-message text-danger" id="name-error"></span>
                                </div>
                                <label for="email" class="col-sm-2 col-form-label">Adresse e-mail</label>
                                <div class="col-sm-4">
                                    <input type="email" class="form-control" name="email" id="email" required>
                                    <span class="error-message text-danger" id="email-error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <span class="error-message text-danger" id="password-error"></span>
                                </div>
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmer le mot de passe</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                    <span class="error-message text-danger" id="password-confirmation-error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="offset-sm-10 col-sm-2">
                                    <button type="button" class="btn btn-primary btn-lg"  id="submitForm">Confirmer</button>
                                </div>
                            </div>                    
                         </form>
                    </div>
                  

                    <h5>Liste des Administrateurs</h5>                    
                    <table id="entreprisesTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width:30%">Photo</th>
                                <th>Nom</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td><img src="{{ asset('images/admin.png') }}" width="25%"> </td>
                                <td> {{ $admin->name }}</td>
                                <td> {{ $admin->email }}</td>
                            </tr>
                        @endforeach                           
                        
                        </tbody>
                    </table>
   
                </div>
            </div>


    
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Validation du formulaire
            $("#submitForm").click(function (e) {
                e.preventDefault();

                var form = $("#addAdminForm");
                var formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Afficher un message de succès
                        toastr.success('Administrateur ajouté avec succès.');
                        setTimeout(function() {
                             location.reload();
                        }, 3000); // 3000 ms (3 secondes)

                    },
                    error: function(response) {
                        // Afficher les messages d'erreur
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;

                            for (var error in errors) {
                                if (errors.hasOwnProperty(error)) {
                                    $('#'+error+'-error').html(errors[error][0]);
                                }
                            }
                        }

                        // Afficher un message d'erreur
                        toastr.error('Une erreur s\'est produite lors de l\'ajout de l\'administrateur.');
                    }
                });
            });
        });
    </script>

    
@endsection
