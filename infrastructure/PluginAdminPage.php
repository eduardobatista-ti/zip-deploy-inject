<?php
// infrastructure/PluginAdminPage.php

namespace ZipDeployInject\Infrastructure;

use ZipDeployInject\Domain\PluginSettings;

class PluginAdminPage {
    private $plugin_settings;

    public function __construct() {
        $this->plugin_settings = new PluginSettings();
        add_action('admin_menu', array($this, 'addAdminMenu'));
        add_action('admin_init', array($this, 'registerSettings'));
    }

    public function addAdminMenu() {
        add_options_page('Zip Deploy Inject Settings', 'Zip Deploy Inject', 'manage_options', 'zip-deploy-inject', array($this, 'renderAdminPage'));
    }

    public function registerSettings() {
        register_setting('zip-deploy-inject-settings-group', 'zip_deploy_github_repo_url');
    }

    public function renderAdminPage() {
        ?>
        <div class="wrap">
            <h2>Zip Deploy Inject Settings</h2>
            <form method="post" action="options.php">
                <?php settings_fields('zip-deploy-inject-settings-group'); ?>
                <?php do_settings_sections('zip-deploy-inject-settings-group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">GitHub Repository URL</th>
                        <td>
                            <input type="text" name="zip_deploy_github_repo_url" value="<?php echo esc_attr($this->plugin_settings->getGithubRepoUrl()); ?>" />
                            <?php submit_button('Save Settings'); ?>
                            <?php if (isset($_POST['zip_deploy_github_repo_url'])): ?>
                                <?php if ($this->plugin_settings->testGithubConnection()): ?>
                                    <div id="message" class="updated notice is-dismissible"><p>Connected to GitHub Repository.</p></div>
                                <?php else: ?>
                                    <div id="message" class="error notice is-dismissible"><p>Failed to connect to GitHub Repository.</p></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
    }
}
?>