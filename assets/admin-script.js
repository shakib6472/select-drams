jQuery(document).ready(function ($) {
    // Your JavaScript code here  
    $('#select-upload-warehouse-form').on('submit', function (e) {
        $('.select-loader').css('display', 'flex');
        
    });

    $('.print-picklist-btn').on('click', function (e) {
        e.preventDefault();

        var $btn = $(this);
        var orderId = $btn.data('order-id');
        var iframe = document.getElementById('print_picklist_iframe_' + orderId);
        if (!iframe) {
            iframe = document.getElementById('print_picklist_iframe');
        }



        // Disable the button and show spinner
        $btn.prop('disabled', true).after('<span class="spinner is-active"></span>');
        // Attach onload BEFORE setting the src
        iframe.onload = function () {
            console.log('Iframe loaded. Triggering print...');
            // Add fallback timeout
            var fallback = setTimeout(function () {
                $btn.prop('disabled', false).next('.spinner').remove();
            }, 3000);

            try {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            } catch (err) {
                console.error('Print error:', err);
                clearTimeout(fallback);
                $btn.prop('disabled', false).next('.spinner').remove();
            }

            // Try onafterprint
            iframe.contentWindow.onafterprint = function () {
                clearTimeout(fallback);
                $btn.prop('disabled', false).next('.spinner').remove();
            };
        };

        // Now set iframe src to trigger load
        iframe.src = ajaxurl + '?action=print_picklist&order_id=' + orderId;
    });


});


