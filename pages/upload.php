<?php
// Upload page content
use Shuchkin\SimpleXLSX;
// if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['warehouse_file'])) {
    // Handle the uploaded file 
    $file = $_FILES['warehouse_file'];
    //check is the file is a csv or xlsx
    if ($file['type'] !== 'text/csv' && $file['type'] !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        echo '<div class="notice notice-error is-dismissible"><p>' . __('Please upload a valid CSV or XLSX file.', 'select-drams') . '</p></div>';
    } else {
        echo '<div class="notice notice-success is-dismissible"><p>' . __('File Processing', 'select-drams') . '</p></div>';
        // Check if the file is an XLSX file
        if ($file['type'] === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {

            // Include the SimpleXLSX library
            require_once SELECT_DRAMS_PLUGIN_DIR . 'libs/SimpleXLSX.php';
            $xlsx = new SimpleXLSX($file['tmp_name']);
            $data = $xlsx->rows();

            foreach ($data as $row) {
                $product_SKU = isset($row[0]) ? $row[0] : '';
                $product_name = isset($row[1]) ? $row[1] : '';
                $price = isset($row[2]) ? $row[2] : '';
                $aisle = isset($row[3]) ? $row[3] : '';
                $bay = isset($row[4]) ? $row[4] : '';

                // find the product by SKU
                $product_id = wc_get_product_id_by_sku($product_SKU);
                //match the name with the product name
                if ($product_id) {
                    $product = wc_get_product($product_id);
                    // Update aisle and bay meta fields
                    update_post_meta($product_id, '_aisle', $aisle);
                    update_post_meta($product_id, '_bay', $bay);
                }
            }
            echo '<div class="notice notice-success is-dismissible"><p>' . __('file processed successfully!', 'select-drams') . '</p></div>';
        } else {
            // Process the CSV file
            $file_path = $file['tmp_name'];
            $index = 1; // Initialize index for debugging purposes
            if (($handle = fopen($file_path, 'r')) !== FALSE) {
                while (($data = fgetcsv($handle, 50000, ',')) !== FALSE) {
                    // Process each row of the CSV  
                    $index++;
                }
                fclose($handle);
                echo '<div class="notice notice-success is-dismissible"><p>' . __('CSV file processed successfully!', 'select-drams') . '</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>' . __('Error opening the CSV file.', 'select-drams') . '</p></div>';
            }
        }
    }
}
// if (isset($_GET['processed']) && $_GET['processed'] == '1') {
//     echo '<p class="notice notice-success is-dismissible"> All Aisle & Bay successfully uploaded </p>';
// }
?>
<div class="wrap">
    <div class="select-loader">
        <div class="lds-hourglass" bis_skin_checked="1"></div>
        <h1><?php _e('Processing...', 'select-drams'); ?></h1>
    </div>
    <div class="select-drams">
        
        <h1><?php _e('Upload Warehouse CSV', 'select-drams'); ?></h1>
        <?php _e('Upload a CSV or XLSX file containing warehouse information. The first column should contain the product SKU, followed by product name, price, aisle, and bay.', 'select-drams'); ?>
        <form method="post" id="select-upload-warehouse-form" enctype="multipart/form-data">
            <input type="file" name="warehouse_file" id="warehouse_file"
                accept=".csv, .xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/csv" />
            <input type="submit" value="<?php _e('Upload', 'select-drams'); ?>" />
        </form>
    </div>
</div>