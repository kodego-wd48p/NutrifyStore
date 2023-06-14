$(function() {
    // for search function
    if ($(".select2-product-search").length) {
        $(".select2-product-search").select2({
            placeholder: 'Search Products',
        });
    }
    // admin purchase table
    $('#product_selector').on('change', function() {
        if ($(this).val()) {
            const product = JSON.parse($(this).val());

            if ($('tr#product-' + product.id).length) {
                const currentQuantity = $('tr#product-' + product.id).find('.quantity').val();
                $('tr#product-' + product.id).find('.quantity').val(parseInt(currentQuantity, 10) + 1);
                $('tr#product-' + product.id).find('.quantity').trigger('change');
            } else {
                let row = '<tr id="product-' + product.id + '">';
                row += '<td><input type="hidden" name="product_id[]" value="' + product.id + '" />' + product.name + '</td>';
                row += '<td><input type="text" name="expiration[]" class="form-control datepicker" placeholder="Expiration" /></td>';
                row += '<td><input type="number" value="' + product.cost + '" name="cost[]" class="form-control cost" placeholder="Unit Cost" /></td>';
                row += '<td><input type="number" value="1" name="quantity[]" class="form-control quantity" placeholder="Quantity" /></td>';
                row += '<td class="subtotal">' + new Intl.NumberFormat().format(product.cost) + '</td>' 
                row += '</tr>';

                $('table#products').find('tbody').prepend(row);
                $('.datepicker').datepicker({orientation: "bottom left"});
            }

            $(this).val(null).trigger('change');
        }
    });
    
    $(document).on('change', '.cost, .quantity', function () {
        const cost = $(this).parents('tr').find('.cost').val();
        const quantity = $(this).parents('tr').find('.quantity').val();

        // calculate new subtotal
        const subtotal = parseFloat(cost) * parseInt(quantity, 10);
        $(this).parents('tr').find('.subtotal').html(new Intl.NumberFormat().format(subtotal));
    });
});