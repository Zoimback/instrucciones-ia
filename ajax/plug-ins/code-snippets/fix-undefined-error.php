<?php
/**
 * Snippet: Fix undefined Error
 * Descripción: Corrige el error de wcSettings undefined en WooCommerce
 * Versión: 1.0.0
 * Tipo: JavaScript inline
 * Ubicación: Frontend (head)
 * 
 * Etiquetas: front-end
 * 
 * PROBLEMA:
 * Algunos scripts intentan acceder a wcSettings antes de que WooCommerce lo defina,
 * causando errores "wcSettings is not defined" en la consola.
 * 
 * SOLUCIÓN:
 * Este snippet inicializa wcSettings como objeto vacío si no existe,
 * previniendo errores de referencia.
 * 
 * INSTRUCCIONES:
 * 1. Copia este código en Code Snippets (Fragmentos > Añadir nuevo)
 * 2. Marca como "Ejecutar snippet en: Solo frontend"
 * 3. Establece prioridad alta (número bajo) para que se ejecute primero
 * 4. Activa el snippet
 */

// Evitar acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Inicializar wcSettings si no existe
 * Prioridad 1 para ejecutarse lo antes posible en wp_head
 */
function fix_wcsettings_undefined_error() {
    ?>
    <script id="fix-wcsettings-undefined">
    // Inicializar wcSettings si no existe para prevenir errores de referencia
    if (typeof wcSettings === 'undefined') {
        window.wcSettings = window.wcSettings || {};
    }
    
    // También asegurar que wc existe
    if (typeof wc === 'undefined') {
        window.wc = window.wc || {};
    }
    
    // Asegurar que wcBlocksConfig existe (usado por bloques de WooCommerce)
    if (typeof wcBlocksConfig === 'undefined') {
        window.wcBlocksConfig = window.wcBlocksConfig || {};
    }
    </script>
    <?php
}
add_action( 'wp_head', 'fix_wcsettings_undefined_error', 1 );

/**
 * También añadir en wp_footer por si algún script lo necesita tarde
 */
function fix_wcsettings_undefined_error_footer() {
    ?>
    <script id="fix-wcsettings-undefined-footer">
    // Re-verificar que wcSettings existe después de que todos los scripts se carguen
    window.wcSettings = window.wcSettings || {};
    window.wc = window.wc || {};
    window.wcBlocksConfig = window.wcBlocksConfig || {};
    </script>
    <?php
}
add_action( 'wp_footer', 'fix_wcsettings_undefined_error_footer', 1 );
