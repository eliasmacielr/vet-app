function quickFormBreed(urlSpecies, urlBreed) {
    // Field name modal form
    var inputName = $('#breed-name');
    // For insert field error message
    var inputNameError = $('#breed-name-error');
    // For insert general modal error
    var modalError = $('#modal-error');
    // modal
    var breedModal = $('#breed-modal');
    // loading state of species
    var speciesLoading = $('#species-loading')
    // breed form
    var breedForm = $('#breed-form');
    // btn breed save
    var btnBreedSave = $('#btn-breed-save');
    // species select options
    var selectSpecies = $('#select-species');
    // For insert field error message
    var selectSpeciesError = $('#species-select-error');

    $('#btn-breed-cancel').on('click', function() {
        breedModal.modal('hide');
    });

    $('#btn-breed-add').on('click', function() {
        breedModal.modal();
        inputName.val('');
        inputNameError.html('');
        selectSpeciesError.html('')
        modalError.html('');
        breedForm.hide();
        speciesLoading.show();
        btnBreedSave.prop('disabled', true);

        $.ajax({
            url: urlSpecies,
            type: 'GET',
            dataType: 'json'
        })
        .done(function(data) {
            selectSpecies.empty();
            selectSpecies.append($('<option>', {
                value: '',
                text: ''
            }));
            $.each(data.species, function(index, value) {
                selectSpecies.append($('<option>', {
                    value: value.id,
                    text: value.name
                }));
            });
            selectSpecies.select2({
                minimumResultsForSearch: Infinity
            });
            speciesLoading.hide('fast', function() {
                breedForm.show('slow');
                btnBreedSave.prop('disabled', false);
            });
        })
        .fail(function() {
            modalError.html('Ocurrió un error al intentar abrir el formulario');
        });

    });

    btnBreedSave.on('click', function() {
        inputNameError.html('');
        selectSpeciesError.html('');
        modalError.html('');
        $.ajax({
            url: urlBreed,
            type: 'POST',
            dataType: 'json',
            data: {species_id: selectSpecies.find(':selected').val(), name: inputName.val()}
        })
        .done(function(data) {
            if (data.status === true) {
                breedModal.modal('hide');
                var breed = data.breed;
                var breedSelect = $('#breed-id');
                breedSelect.append($('<option>', {
                    value: breed.id,
                    text: breed.name
                }));
                breedSelect.val(breed.id);
                breedSelect.select2();
            } else {
                inputNameError.html(data.errors.name)
                selectSpeciesError.html(data.errors.species_id)
            }
        })
        .fail(function() {
            modalError.html('Ocurrió un error por favor intente de nuevo');
        });
    });
}

function quickFormLocation(urlLocation) {
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

    $('#btn-location-add').on('click', function() {
        locationModal.modal();
        inputName.val('');
        inputNameError.html('');
        modalError.html('');
    });

    $('#btn-location-save').on('click', function() {
        inputNameError.html('')
        modalError.html('')
        $.ajax({
            url: urlLocation,
            type: 'POST',
            dataType: 'json',
            data: {name: inputName.val()}
        })
        .done(function(data) {
            if (data.status === true) {
                locationModal.modal('hide');
                var location = data.location;
                var locationSelect = $('#location-id');
                locationSelect.append($('<option>', {
                    value: location.id,
                    text: location.name
                }));
                locationSelect.val(location.id);
                locationSelect.select2();
            } else {
                inputNameError.html(data.errors.name)
            }
        })
        .fail(function() {
            modalError.html('Ocurrió un error por favor intente de nuevo')
        });
    });
}

function quickFormVaccine(urlVaccine) {
    // Field name modal form
    var inputName = $('#vaccine-name');
    // For insert field error message
    var inputNameError = $('#vaccine-name-error');
    // For insert general modal error
    var modalError = $('#modal-error');
    // modal
    var vaccineModal = $('#vaccine-modal');

    $('#btn-vaccine-cancel').on('click', function() {
        vaccineModal.modal('hide');
    });

    $('#btn-vaccine-add').on('click', function() {
        vaccineModal.modal();
        inputName.val('');
        inputNameError.html('');
        modalError.html('');
    });

    $('#btn-vaccine-save').on('click', function() {
        inputNameError.html('')
        modalError.html('')
        $.ajax({
            url: urlVaccine,
            type: 'POST',
            dataType: 'json',
            data: {name: inputName.val()}
        })
        .done(function(data) {
            if (data.status === true) {
                vaccineModal.modal('hide');
                var vaccine = data.vaccine;
                var vaccineSelect = $('#vaccine-id');
                vaccineSelect.append($('<option>', {
                    value: vaccine.id,
                    text: vaccine.name
                }));
                vaccineSelect.val(vaccine.id);
                vaccineSelect.select2();
            } else {
                inputNameError.html(data.errors.name)
            }
        })
        .fail(function() {
            modalError.html('Ocurrió un error por favor intente de nuevo')
        });
    });
}
