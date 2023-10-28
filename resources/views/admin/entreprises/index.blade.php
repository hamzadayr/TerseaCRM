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
                    <h5>Liste des Entreprises</h5>

                    <!-- Bouton pour ajouter une entreprise -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCompanyModal">
                        Ajouter une entreprise
                    </button>   
                    <br><br>
                    <table id="entreprisesTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th class="action-column">Actions</th>
                            </tr>
                        </thead>
                    </table>
   
                </div>
            </div>

            <div class="modal fade" id="newCompanyModal" tabindex="-1" aria-labelledby="newCompanyModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newCompanyModalLabel">Ajouter une nouvelle entreprise</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('admin.entreprises.create') {{-- Incluez le formulaire create.blade.php ici --}}
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>



    <script>
        
        function confirmDelete(entrepriseId) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-center",
            };
            toastr.warning("Voulez-vous vraiment supprimer cette entreprise ?", "Confirmation", {
                timeOut: 0, // La notification ne se ferme pas automatiquement
                extendedTimeOut: 0, // La notification ne se ferme pas automatiquement
                closeHtml: '<button id="confirm-yes"><i class="fas fa-check"></i> Oui</button> <button><i class="fas fa-times"></i> Non</button>',
            });
            $('#confirm-yes').click(function () {
                        // L'utilisateur a confirmé la suppression, exécutez ici la logique de suppression
                        deleteEntreprise(entrepriseId);
                        toastr.clear(); // Fermez la notification
                    
             });
        }

        function deleteEntreprise(entrepriseId) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/entreprises/' + entrepriseId + '/destroy',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (data,status) {
                            if (status == 'success') {
                                toastr.success(data.message, status);
                                setTimeout(function() {
                                    location.reload();
                                }, 3000); // 3000 ms (3 secondes)
                            } else {
                                toastr.error(data.message, status);
                            }
                        },
                        error: function (data,status) {
                            toastr.error(data.responseJSON.message, status);
                        }
                    });
            }
            
            $('#entreprisesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                processing: true,
                ajax: "{{ route('entreprises.show') }}",
                columns: [
                    {
                        data: 'logo',
                        name: 'logo',
                        render: function (data, type, full, meta) {
                            return data
                                ? '<img src="{{ asset('storage/') }}/' + data + '" width="50" height="50" />'
                                : '';
                        }
                    },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                   
                    {
                        data: 'id',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            let entrepriseId = data; // Récupérez l'ID de l'entreprise
                            // Ici, vous pouvez générer les liens d'action (éditer et supprimer).
                            return '<a href="/entreprise/' + data + '/edit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Éditer"><i class="fa fa-pencil"></i></a>  <a href="#" onclick="confirmDelete(' + entrepriseId + ');" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                        },
                    },
                ]
            });

           

    </script>
    
@endsection
