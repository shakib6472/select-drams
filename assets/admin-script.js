jQuery(document).ready(function ($) {
    // Your JavaScript code here
    console.log('Admin script loaded for Select DRAMs plugin.');
    $('#select-upload-warehouse-form').on('submit', function (e) {
        $('.select-loader').css('display', 'flex');
    });
});