<?php

/*
 * Plugin Name:       Select Drams Picklist
 * Plugin URI:        https://github.com/shakib6472/
 * Description:       A Plugin to upload warehouse data to WooCommerce. & Generate Picklist.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shakib Shown
 * Author URI:        https://github.com/shakib6472/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       select-drams
 * Domain Path:       /languages
 */


namespace SelectDrams;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define('SELECT_DRAMS_VERSION', '1.0.0');
define('SELECT_DRAMS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SELECT_DRAMS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once SELECT_DRAMS_PLUGIN_DIR . 'classes/main.php';

// Initialize the plugin
new Main();



