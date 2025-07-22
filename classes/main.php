<?php

namespace SelectDrams;

class Main
{
    public function __construct()
    {
        // Initialization code here 
        add_action('admin_enqueue_scripts', [$this, 'admin_style_script']);
        add_action('init', [$this, 'activate']);
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('woocommerce_product_data_tabs', [$this, 'warehouse_product_data_tab']);
        add_action('woocommerce_product_data_panels', [$this, 'add_aisle_and_bay_fields']);
        add_action('woocommerce_process_product_meta', [$this, 'save_aisle_and_bay_meta']);
        add_action('add_meta_boxes', [$this, 'add_select_drams_picklist_box']);
        add_action('wp_ajax_print_picklist', [$this, 'handle_print_picklist']);
        add_filter('manage_edit-shop_order_columns', [$this, 'add_print_picklist_column']);
        add_action('manage_shop_order_posts_custom_column', [$this, 'render_print_picklist_button'], 10, 2);


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


    public function add_select_drams_picklist_box()
    {
        add_meta_box(
            'select_drams_picklist',              // ID
            'Select Drams Picklist',              // Title
            [$this, 'render_select_drams_picklist_box'],   // Callback
            'shop_order',                         // Post type
            'side',                               // Context ('side', 'normal', 'advanced')
            'default'                             // Priority
        );
    }

    public function render_select_drams_picklist_box($post)
    {
        ?>
        <div style="text-align: center;">
            <button type="button" class="button button-primary print-picklist-btn"
                data-order-id="<?php echo esc_attr($post->ID); ?>">
                Print Picklist
            </button>
        </div>
        <iframe id="print_picklist_iframe" style="display:none;"></iframe>
        <?php
    }

    public function handle_print_picklist()
    {
        $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

        if (!$order_id) {
            wp_die('Invalid Order ID');
        }

        // Path to the template file
        $template_path = SELECT_DRAMS_PLUGIN_DIR . '/print-picklist-template.php';

        if (file_exists($template_path)) {
            include $template_path;
        }  

        exit;
    }

    public function add_print_picklist_column($columns)
    {
        $columns['print_picklist'] = 'Print Picklist';
        return $columns;
    }

    public function render_print_picklist_button($column, $post_id)
    {
        if ($column === 'print_picklist') {
            ?>
            <div style="text-align: center;">
                <button type="button" class="button button-primary print-picklist-btn"
                    data-order-id="<?php echo esc_attr($post_id); ?>">
                    Print Picklist
                </button>
                <iframe id="print_picklist_iframe_<?php echo esc_attr($post_id); ?>" style="display:none;"></iframe>
            </div>
            <?php
        }
    }


}
