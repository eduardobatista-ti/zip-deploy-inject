<?php
/*
Plugin Name: Zip Deploy Inject
Description: Plugin para inserir códigos JS em elementos HTML do Elementor
Version: 1.0
Author: ZipCloud

*/

// Função para adicionar os códigos JS nos elementos HTML do Elementor
function inserir_codigos_js_no_elementor($content) {
    // Verifica se o Elementor está ativo
    if ( !did_action('elementor/loaded') ) {
        return $content;
    }

    // Pega todos os arquivos JS da pasta 'zip-js' do plugin
    $js_files = glob(ABSPATH . 'wp-content/zip-js/*.js');

    // Loop pelos arquivos JS
    foreach ($js_files as $js_file) {
        // Pega o nome do arquivo JS
        $file_name = basename($js_file, '.js');

        // Lê o conteúdo do arquivo JS
        $js_content = file_get_contents($js_file);

        // Adiciona o conteúdo do arquivo JS ao elemento HTML com o ID correspondente
        $content = str_replace('<div id="' . $file_name . '"></div>', '<div id="' . $file_name . '">' . $js_content . '</div>', $content);
    }

    return $content;
}
add_filter('the_content', 'inserir_codigos_js_no_elementor');
?>
