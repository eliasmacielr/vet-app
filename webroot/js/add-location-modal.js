$(function() {
    // Field name modal form
    var inputName = $('#location-name');
    // For insert field error message
    var inputNameError = $('#location-name-error');
    // For insert general modal error
    var modalError = $('#modal-error');
    // modal
    var locationModal = $('#location-modal');

    $('#btn-location-cancel').on('click', function() {
        locationModal.modal('hide');
    });

    $('#btn-location').on('click', function() {
        locationModal.modal();
        inputName.val('');
        inputNameError.html('');
        modalError.html('');
    });

    $('#btn-location-save').on('click', function() {
        inputNameError.html('')
        modalError.html('')
        $.ajax({
                url: "<?= $this->Url->build(['controller' => 'Locations', 'action' => 'add', 'prefix' => 'system/ajax']) ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    name: inputName.val()
                }
            })
            .done(function(data) {
                if (data.response.status === true) {
                    locationModal.modal('hide');
                    var location = data.response.location;
                    var locationSelect = $('#location-id');
                    locationSelect.append($('<option>', {
                        value: location.id,
                        text: location.name
                    }));
                    locationSelect.val(location.id);
                    locationSelect.select2();
                } else {
                    inputNameError.html(data.response.errors.name)
                }
            })
            .fail(function() {
                modalError.html('Ocurrió un error por favor intente de nuevo')
            });
    });
});
