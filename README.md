# Select Drams Picklist

A WordPress plugin for WooCommerce that enables warehouse data upload and picklist generation for efficient inventory management.

![WordPress](https://img.shields.io/badge/WordPress-5.2+-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.2+-green.svg)
![WooCommerce](https://img.shields.io/badge/WooCommerce-Compatible-purple.svg)
![Version](https://img.shields.io/badge/Version-1.0.0-orange.svg)

## 📋 Description

Select Drams Picklist is a comprehensive WordPress plugin designed to streamline warehouse operations for WooCommerce stores. It allows administrators to upload warehouse data via CSV/XLSX files and automatically assigns aisle and bay information to products for efficient picking operations.

## ✨ Features

- **📁 File Upload Support**: Upload warehouse data using CSV or XLSX files
- **🏪 Warehouse Management**: Assign warehouse locations (aisle and bay) to WooCommerce products
- **🔧 Product Integration**: Seamlessly integrates with WooCommerce product data tabs
- **📊 Excel Processing**: Built-in support for Excel (.xlsx) files using SimpleXLSX library
- **🎨 Admin Interface**: Clean and intuitive admin interface with loading animations
- **🔍 SKU Matching**: Automatically matches products by SKU from uploaded files
- **📝 Meta Field Management**: Stores warehouse information as custom meta fields

## 🔧 Installation

1. **Download the Plugin**
   ```bash
   git clone https://github.com/shakib6472/select-drams.git
   ```

2. **Upload to WordPress**
   - Upload the plugin folder to `/wp-content/plugins/`
   - Or install via WordPress admin dashboard

3. **Activate the Plugin**
   - Go to `Plugins` in your WordPress admin
   - Find "Select Drams Picklist" and click `Activate`

4. **Requirements Check**
   - Ensure WooCommerce is installed and activated
   - Verify PHP version 7.2 or higher
   - WordPress 5.2 or higher required

## 📖 Usage

### Uploading Warehouse Data

1. Navigate to **Select Drams > Upload Warehouse** in your WordPress admin
2. Prepare your CSV/XLSX file with the following columns:
   - Column 1: Product SKU
   - Column 2: Product Name
   - Column 3: Price
   - Column 4: Aisle
   - Column 5: Bay

3. Upload your file and the plugin will:
   - Match products by SKU
   - Update aisle and bay information
   - Show processing status with loading animation

### Managing Product Warehouse Info

1. Edit any WooCommerce product
2. Navigate to the **Warehouse Info** tab
3. Enter or modify:
   - Warehouse name/code
   - Aisle number/code
   - Bay number/code

### File Format Example

**CSV Format:**
```csv
SKU001,Product Name 1,29.99,A1,B3
SKU002,Product Name 2,39.99,A2,B1
SKU003,Product Name 3,19.99,B1,C2
```

**XLSX Format:**
| SKU    | Product Name    | Price | Aisle | Bay |
|--------|----------------|-------|-------|-----|
| SKU001 | Product Name 1 | 29.99 | A1    | B3  |
| SKU002 | Product Name 2 | 39.99 | A2    | B1  |
| SKU003 | Product Name 3 | 19.99 | B1    | C2  |

## 🏗️ Technical Architecture

### File Structure
```
select-drams/
├── select-drams.php          # Main plugin file
├── classes/
│   └── main.php             # Core plugin functionality
├── pages/
│   ├── admin.php            # Main admin page
│   └── upload.php           # File upload interface
├── assets/
│   ├── admin-style.css      # Admin styling
│   └── admin-script.js      # Admin JavaScript
├── libs/
│   ├── SimpleXLSX.php       # Excel processing library
│   └── SimpleXLSXEx.php     # Extended Excel functionality
└── README.md                # This file
```

### Key Classes and Functions

**Main Class (`classes/main.php`)**
- `__construct()`: Initialize hooks and actions
- `admin_menu()`: Register admin menu pages
- `warehouse_product_data_tab()`: Add warehouse tab to products
- `add_aisle_and_bay_fields()`: Render warehouse input fields
- `save_aisle_and_bay_meta()`: Save warehouse metadata

**Upload Processing (`pages/upload.php`)**
- CSV file processing with `fgetcsv()`
- XLSX file processing with SimpleXLSX library
- Product matching by SKU using `wc_get_product_id_by_sku()`
- Meta field updates with `update_post_meta()`

## 🔌 Hooks and Filters

### Actions Used
- `admin_enqueue_scripts`: Load admin assets
- `init`: Plugin initialization
- `admin_menu`: Register admin pages
- `woocommerce_product_data_tabs`: Add product tabs
- `woocommerce_product_data_panels`: Add form fields
- `woocommerce_process_product_meta`: Save product data

### Custom Meta Fields
- `_warehouse`: Warehouse identifier
- `_aisle`: Aisle location
- `_bay`: Bay location

## 📋 Requirements

- **WordPress**: 5.2 or higher
- **PHP**: 7.2 or higher
- **WooCommerce**: Latest stable version
- **Dependencies**: 
  - SimpleXLSX library (included)
  - jQuery (WordPress core)

## 🛠️ Development

### Local Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/shakib6472/select-drams.git
   cd select-drams
   ```

2. **Set up WordPress environment**
   - Use XAMPP, WAMP, or similar local server
   - Place plugin in `/wp-content/plugins/select-drams/`

3. **Enable WordPress debugging**
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   ```

### Code Standards
- Follow WordPress Coding Standards
- Use proper sanitization for user inputs
- Implement proper error handling
- Use WordPress hooks and filters appropriately

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the GPL v2 or later - see the [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html) for details.

## 👨‍💻 Author

**Shakib Shown**
- GitHub: [@shakib6472](https://github.com/shakib6472)
- Plugin URI: [https://github.com/shakib6472/](https://github.com/shakib6472/)

## 📝 Changelog

### Version 1.0.0
- Initial release
- CSV and XLSX file upload support
- WooCommerce product integration
- Warehouse location management
- Admin interface with loading animations

## 🐛 Issues and Support

If you encounter any issues or need support:

1. Check the [Issues](https://github.com/shakib6472/select-drams/issues) page
2. Create a new issue with detailed information
3. Include WordPress and PHP version details
4. Provide steps to reproduce the problem

## 🔮 Future Enhancements

- [ ] Bulk product creation for non-existing SKUs
- [ ] Picklist generation and printing functionality
- [ ] Advanced warehouse location management
- [ ] Product location history tracking
- [ ] API endpoints for external integrations
- [ ] Multi-warehouse support
- [ ] Barcode scanning integration
- [ ] Inventory level tracking

## 📊 Screenshots

*Screenshots will be added to showcase the admin interface, upload process, and product integration.*

---
 
**Note**: This plugin requires WooCommerce to be installed and activated. Ensure you have proper backups before uploading large datasets.
 