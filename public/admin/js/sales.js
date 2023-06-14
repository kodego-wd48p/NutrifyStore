$(function() {

        // admin sales table order/delivery status
    $('.btn-update-status').on('click', function() {
        const modal = $('#modal-update-sale-status');
        const saleId = $(this).data('id');
        const status = $(this).data('status')

        modal.find('[name="id"').val(saleId);
        modal.find('#status').val(status);

        modal.modal('show');
    });

    // admin sales table payment status
    $('.btn-update-payment-status').on('click', function() {
        const modal = $('#modal-update-payment-status');
        const saleId = $(this).data('id');
        const status = $(this).data('status')

        modal.find('[name="id"').val(saleId);
        modal.find('#payment_status').val(status);

        modal.modal('show');
    });
});