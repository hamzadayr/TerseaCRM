@extends('layouts.app')

@section('content')
<div class="container"><br>
    <div class="row"><br><br><br>
        <div class="col-10">
            <h2>Bienvenue sur votre espace employé</h2>
        </div>
        <div class="col-2 text-end">
            <a href="{{ route('logout') }}" class="btn btn-primary">Se déconnecter</a>
        </div>
    </div>
  
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Vos informations :</h2>
                    <p>Nom : {{ Auth::user()->name }}</p>
                    <p>Email : {{ Auth::user()->email }}</p>
                    <p>Téléphone : {{ Auth::user()->employee->phone }}</p>
                    <p>Address : {{ Auth::user()->employee->address }}</p>
                    <p>Date de naissance : {{ Auth::user()->employee->birthdate }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('storage/' . Auth::user()->employee->entreprise->logo) }}" alt="Logo de l'entreprise" class="img-fluid"><br><br>
                    <p>Nom de l'entreprise : {{ Auth::user()->employee->entreprise->name }}</p>
                    <p>Description de l'entreprise : {{ Auth::user()->employee->entreprise->description }}</p>
                </div>
               
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <h5>Modifier vos informations</h5>
                <form  id="updateEmployeeForm" class="bg-light">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" required>
                            <span class="error-message text-danger" id="name-error"></span>
                        </div>
                        <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->employee->phone }}" required>
                            <span class="error-message text-danger" id="phone-error"></span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="address" id="address" value="{{ Auth::user()->employee->address }}" required>
                            <span class="error-message text-danger" id="address-error"></span>
                        </div>
                        <label for="birthdate" class="col-sm-2 col-form-label">Date de naissance</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{ Auth::user()->employee->birthdate }}" required>
                            <span class="error-message text-danger" id="birthdate-error"></span>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" id="password">
                            <span class="error-message text-danger" id="password-error"></span>
                        </div>
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmer le mot de passe</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                            <span class="error-message text-danger" id="password-confirmation-error"></span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="offset-sm-10 col-sm-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitForm">Modifier</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>

</div>


<script>
          $('form').submit(function(event) {
            event.preventDefault(); // Empêche la soumission du formulaire standard
            // Récupérer les données du formulaire
            var form = $("#updateEmployeeForm");
            var formData = new FormData(form[0]);

            // Envoi des données avec AJAX
            $.ajax({
                url: "{{ route('employee.profile.update') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                     toastr.success(response.message, 'Success');
                     setTimeout(function() {
                        location.reload();
                     }, 2000); // 2000 ms (2 secondes)
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message, 'Erreur');
                }
            });
        });
    </script>
@endsection

