function deleteConfirm(deleteBtn, confirmModal, confirmBtn, cancelBtn) {
    var _form;

    $('button[name="' + deleteBtn + '"]').on('click', function (e) {
        e.preventDefault();
        _form = $(this).closest('form');
        var deleteConfirmModal = $(confirmModal);
        deleteConfirmModal.modal({backdrop: 'static', keyboard: false});
        deleteConfirmModal.one('click', cancelBtn, function () {
            deleteConfirmModal.modal('toggle');
        });
    });

    $(confirmBtn).on('click', function (e) {
        e.preventDefault();
        _form.trigger('submit'); // submit the form
    });
}
