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
                        <h5>Formulaire d'invitation d'un nouvel employé</h5>                    
                         <form class="bg-light">
                             @csrf
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Adresse e-mail</label>
                                <div class="col-sm-3">
                                    <input type="email" class="form-control" name="email" id="email" required>
                                    <span class="error-message text-danger" id="email-error"></span>
                                </div>
                                <label for="entreprise_id" class="col-sm-3 col-form-label">Entreprise d'affectation</label>
                                <div class="col-sm-4">
                                <select class="form-select" id="entreprise_id" name="entreprise_id" required>
                                    <option value="">Sélectionnez une entreprise</option>
                                    @foreach($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}">{{ $entreprise->name }}</option>
                                    @endforeach
                                </select>
                                    <span class="error-message text-danger" id="email-error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="offset-sm-10 col-sm-2">
                                    <button type="submit" class="btn btn-primary btn-lg"  id="submitForm">Envoyer</button>
                                </div>
                            </div>                    
                         </form>
                    </div>
                     <h5>Liste des invitations</h5>               
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Email de l'invité</th>
                                <th>Entreprise</th>
                                <th>Émetteur de l'invitation</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($invitations as $invitation)
                            <tr>
                                <td> {{ $invitation->email }}</td>
                                <td> {{ $invitation->entreprise->name }}</td>
                                <td> {{ $invitation->user->name }}</td>
                                <td> 
                                    @if($invitation->status == "pending")
                                       <span class="badge text-bg-primary">Envoyé</span>
                                    @elseif($invitation->status == "confirmed")
                                       <span class="badge text-bg-success">Confirmé</span>
                                    @else
                                      <span class="badge text-bg-danger">Annulé</span>
                                    @endif
                                </td>
                                <td>
                                   @if($invitation->status == "pending")
                                         <a href="#" onclick="confirmDelete({{ $invitation->id }});" class="text-danger">Annulé</a>
                                   @endif
                                </td>
                            </tr>
                        @endforeach                           
                        
                        </tbody>
                    </table>
   
                </div>
            </div>


    
        </div>
    </div>

<script>
         function confirmDelete(invitationId) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-center",
            };
            toastr.warning("Voulez-vous vraiment annuler cette invitation ?", "Confirmation", {
                timeOut: 0, // La notification ne se ferme pas automatiquement
                extendedTimeOut: 0, // La notification ne se ferme pas automatiquement
                closeHtml: '<button id="confirm-yes"><i class="fas fa-check"></i> Oui</button> <button><i class="fas fa-times"></i> Non</button>',
            });
            $('#confirm-yes').click(function () {
                        // L'utilisateur a confirmé la suppression, exécutez ici la logique de suppression
                        refuseInvitation(invitationId);
                        toastr.clear(); // Fermez la notification
                    
             });
        }

        function refuseInvitation(invitationId) {
                    $.ajax({
                        type: 'GET',
                        url: ' /invitations/cancel/' + invitationId ,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (data) {
                                toastr.success(data.message, 'Success');
                                setTimeout(function() {
                                    location.reload();
                                }, 3000); // 3000 ms (3 secondes)
                        },
                        error: function (data,status) {
                            toastr.error(data.responseJSON.message, 'Erreur');
                        }
                    });
            }


        $('form').submit(function(event) {
            event.preventDefault(); // Empêche la soumission du formulaire standard

            // Récupérer les données du formulaire
            var email = $('#email').val();
            var entreprise_id = $('#entreprise_id').val();

            // Envoi des données avec AJAX
            $.ajax({
                url: "{{ route('invitations.invite') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email,
                    entreprise_id: entreprise_id
                },
                success: function(response) {
                     toastr.success(response.message, 'Success');
                     setTimeout(function() {
                         location.reload();
                     }, 3000); // 3000 ms (3 secondes)
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message, 'Erreur');
                }
            });
        });

</script>
    
@endsection
