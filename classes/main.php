<?php

namespace SelectDrams;

 class Main
{
    public function __construct()
    {
        // Initialization code here
        error_log('Select Drams plugin initialized.');
        add_action('admin_enqueue_scripts', [$this, 'admin_style_script']);
        add_action('init', [$this, 'activate']);
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('woocommerce_product_data_tabs', [$this, 'warehouse_product_data_tab']);
        add_action('woocommerce_product_data_panels', [$this, 'add_aisle_and_bay_fields']); 
        add_action('woocommerce_process_product_meta', [$this, 'save_aisle_and_bay_meta']);
    }

    public function admin_style_script()
    {
        // Enqueue admin styles and scripts
        wp_enqueue_style('select-drams-admin-style', SELECT_DRAMS_PLUGIN_URL . 'assets/admin-style.css', array(), SELECT_DRAMS_VERSION);
        wp_enqueue_script('jquery');
        wp_enqueue_script('select-drams-admin-script', SELECT_DRAMS_PLUGIN_URL . 'assets/admin-script.js', array('jquery'), SELECT_DRAMS_VERSION, true);
    }

    public function activate()
    {
        // Activation code here
        flush_rewrite_rules();
    }

    public function admin_menu()
    {
        // Add admin menu items
        add_menu_page(
            __('Select Drams', 'select-drams'),
            __('Select Drams', 'select-drams'),
            'manage_options',
            'select-drams',
            [$this, 'select_drams_page'],
            'dashicons-admin-generic',
            1
        );
        add_submenu_page(
            'select-drams',
            __('Upload Warehouse', 'select-drams'),
            __('Upload Warehouse', 'select-drams'),
            'manage_options',
            'select-drams-upload',
            [$this, 'select_drams_upload_page']
        );
    }

    public function select_drams_page()
    {
        // include the main page content
        include SELECT_DRAMS_PLUGIN_DIR . 'pages/admin.php';

    }

    public function select_drams_upload_page()
    {
        // include the upload page content
        include SELECT_DRAMS_PLUGIN_DIR . 'pages/upload.php';
    }

    public function warehouse_product_data_tab($tabs)
    {
        $tabs['warehouse_tab'] = array(
            'label' => __('Warehouse Info', 'select-drams'),
            'target' => 'warehouse_product_data',
            'class' => array(),
            'priority' => 60,
            
        );
        return $tabs;
    }

    public function add_aisle_and_bay_fields()
    {
        ?>
        <div id="warehouse_product_data" class="panel woocommerce_options_panel">
            <div class="options_group"> <?php
            woocommerce_wp_text_input(array(
                'id' => '_warehouse',
                'label' => __('Warehouse', 'select-drams'),
                'desc_tip' => true,
                'description' => __('Enter the warehouse name or code.', 'select-drams'),
            ));
            woocommerce_wp_text_input(array(
                'id' => '_aisle',
                'label' => __('Aisle', 'select-drams'),
                'desc_tip' => true,
                'description' => __('Enter the aisle number or code.', 'select-drams'),
            ));
            woocommerce_wp_text_input(array(
                'id' => '_bay',
                'label' => __('Bay', 'select-drams'),
                'desc_tip' => true,
                'description' => __('Enter the bay number or code.', 'select-drams'),
            ));
            ?>
            </div>
        </div>
        <?php
    }

    public function save_aisle_and_bay_meta($post_id)
    {

        if (isset($_POST['_warehouse'])) {
            update_post_meta($post_id, '_warehouse', sanitize_text_field($_POST['_warehouse']));
        }
        if (isset($_POST['_aisle'])) {
            update_post_meta($post_id, '_aisle', sanitize_text_field($_POST['_aisle']));
        }
        if (isset($_POST['_bay'])) {
            update_post_meta($post_id, '_bay', sanitize_text_field($_POST['_bay']));
        }

    }

}
