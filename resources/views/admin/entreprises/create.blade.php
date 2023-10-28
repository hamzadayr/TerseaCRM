    <form  method="post" action="{{ route('entreprises.store') }}" id="create-entreprise-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nom de l'entreprise</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"/>
            <span class="error-message text-danger"></span>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            <span class="error-message text-danger"></span>
        </div>

        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo" class="form-control-file">
            <span class="error-message text-danger"></span>

        </div>

        <button type="button" class="btn btn-primary" id="submitForm">Ajouter</button>
    </form>
    
    <script>
      
       
            $("#submitForm").click(function (e) {
                e.preventDefault();

                var form = $("#create-entreprise-form");
                var formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('.error-message').empty();
                        $('#create-entreprise-form')[0].reset();
                        toastr.success('Entreprise ajoutée avec succès !', 'Succès');
                        setTimeout(function() {
                            location.reload();
                        }, 3000); // 3000 ms (3 secondes)
                    },
                    error: function (xhr) {
                        toastr.error('Veuillez remplir tous les champs correctement.', 'Erreur');
                        var errors = xhr.responseJSON.errors;
                        displayErrors(errors);

                    }
                });
            });
    


    function displayErrors(errors) {
        $.each(errors, function (field, error) {
            let errorMessage = error.join(', ');
            let inputField = $(`#${field}`);
            inputField.next('.error-message').text(errorMessage);
        });
    }
    </script>
