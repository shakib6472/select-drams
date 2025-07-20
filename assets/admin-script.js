jQuery(document).ready(function ($) {
    // Your JavaScript code here 
    console.log('Admin script loaded for Select DRAMs plugin.');
    $('#select-upload-warehouse-form').on('submit', function (e) {
        $('.select-loader').css('display', 'flex');
    });

    $('.print-picklist-btn').on('click', function (e) {
        console.log('Print picklist button clicked');
        e.preventDefault();
        $('.print-picklist-btn').prop('disabled', true).after('<span class="spinner is-active"></span>');

        var orderId = $(this).data('order-id');
        var iframe = document.getElementById('print_picklist_iframe');

        // Optional future loading spinner:
        // $(this).prop('disabled', true).after('<span class="spinner is-active"></span>');

        iframe.src = ajaxurl + '?action=print_picklist&order_id=' + orderId;

        iframe.onload = function () {
            // $('.spinner').remove();
            // $('.print-picklist-btn').prop('disabled', false);
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        };
        
        $('.print-picklist-btn').prop('disabled', false).next('.spinner').remove();
    });

});


