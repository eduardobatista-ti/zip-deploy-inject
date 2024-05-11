<?php
/**
 * Plugin Name: Zip Deploy Inject
 * Description: Plugin para inserir códigos JS em elementos HTML do Elementor
 * Version: 1.0
 * Author: ZipCloud
 */

require_once plugin_dir_path(__FILE__) . 'domain/PluginSettings.php';
require_once plugin_dir_path(__FILE__) . 'infrastructure/PluginAdminPage.php';

use ZipDeployInject\Infrastructure\PluginAdminPage;

new PluginAdminPage();
?>
