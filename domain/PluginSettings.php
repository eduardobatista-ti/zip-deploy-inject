<?php
// domain/PluginSettings.php

namespace ZipDeployInject\Domain;

class PluginSettings {
    private $github_repo_url;

    public function __construct() {
        $this->github_repo_url = get_option('zip_deploy_github_repo_url', '');
    }

    public function getGithubRepoUrl() {
        return $this->github_repo_url;
    }

    public function setGithubRepoUrl($url) {
        update_option('zip_deploy_github_repo_url', $url);
        $this->github_repo_url = $url;
    }

    public function testGithubConnection() {
        $response = wp_remote_get($this->github_repo_url);

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            return true;
        }

        return false;
    }
}
?>
