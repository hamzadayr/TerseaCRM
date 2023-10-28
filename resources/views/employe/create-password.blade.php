@extends('layouts.app') <!-- Assurez-vous d'utiliser le layout approprié -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Bienvenue sur votre espace employé</div><br>
                    <H5>Terminer votre inscription pour rejoindre l'entreprise <span class="text-danger"> {{ $invitation->entreprise->name}}  </span></H5>
                    <div class="card-body">
                        <h2>Créez votre mot de passe</h2>

                        <form method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="emai">Email</label>
                                <input type="text" value="{{ $invitation->email}} " class="form-control"  disabled>
                                <input type="text" value="{{ $invitation->token}}" id="token" class="form-control"  hidden>
                            </div>

                            <div class="form-group">
                                <label for="name">Nom complet</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Répétez le mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Créer le mot de passe</button>
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
            var token = $('#token').val();
            var name = $('#name').val();
            var password = $('#password').val();
            var password_confirmation = $('#password_confirmation').val();
            // Envoi des données avec AJAX
            $.ajax({
                url: "{{ route('invitations.complete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    token: token,
                    name: name,
                    password: password,
                    password_confirmation: password_confirmation
                },
                success: function(response) {
                     toastr.success(response.message, 'Success');
                     setTimeout(function() {
                        window.location.href = "{{ route('login')}}";
                     }, 3000); // 3000 ms (3 secondes)
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message, 'Erreur');
                }
            });
        });
    </script>
@endsection
