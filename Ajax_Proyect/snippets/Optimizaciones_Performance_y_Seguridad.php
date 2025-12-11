<?php

/**
 * Optimizaciones de Performance y Seguridad
 * - Limpia preloads innecesarios
 * - Añade security headers
 * - Oculta X-Powered-By
 */

// Remover preloads innecesarios de WooCommerce y plugins
add_filter('wp_resource_hints', function($hints, $relation_type) {
    if ('preload' === $relation_type) {
        // Lista de archivos que NO necesitan preload
        $remove_preloads = [
            'blocks-components.js',
            'wordcount.min.js',
            'blocks-checkout.js',
            'mini-cart',
            'paypal-payments',
            'woocommerce-payments',
            'autop.min.js',
            'warning.min.js',
            'a11y.min.js',
            'sanitize',
            'style-engine.min.js',
            'primitives.min.js',
            'dom-ready.min.js',
            'lodash.min.js'
        ];
        
        foreach ($hints as $key => $hint) {
            foreach ($remove_preloads as $needle) {
                if (strpos($hint['href'], $needle) !== false) {
                    unset($hints[$key]);
                    break;
                }
            }
        }
    }
    return $hints;
}, 10, 2);

// Añadir Security Headers
add_action('send_headers', function() {
    if (!is_admin()) {
        // Prevenir clickjacking
        header('X-Frame-Options: SAMEORIGIN');
        
        // Prevenir MIME sniffing
        header('X-Content-Type-Options: nosniff');
        
        // XSS Protection (para navegadores antiguos)
        header('X-XSS-Protection: 1; mode=block');
        
        // Referrer Policy
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        // Permissions Policy (antes Feature-Policy)
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
        
        // HSTS - Strict Transport Security (6 meses)
        if (is_ssl()) {
            header('Strict-Transport-Security: max-age=15768000; includeSubDomains; preload');
        }
    }
});

// Ocultar X-Powered-By header
header_remove('X-Powered-By');
add_filter('wp_headers', function($headers) {
    unset($headers['X-Powered-By']);
    return $headers;
});

// Deshabilitar XML-RPC si no se usa (mejora seguridad)
add_filter('xmlrpc_enabled', '__return_false');

// Remover version de WordPress del head (seguridad)
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// Descargar Stripe.js solo en checkout
add_action('wp_enqueue_scripts', function() {
    if (!is_checkout() && !is_cart()) {
        wp_dequeue_script('stripe');
    }
}, 100);