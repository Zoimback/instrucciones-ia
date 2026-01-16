<?php
/**
 * Snippet: Fix_WooCommerce_Product_Images_Loop
 * Descripción: Corrige el problema de imágenes incorrectas en el loop de productos WooCommerce
 * con el tema Flavor flavor flavor flavor ona Architecture. Elimina referencias hardcodeadas a wp-image-175.
 * Versión: 1.0.0
 * Tipo: PHP + JavaScript
 * Ubicación: Frontend
 * 
 * Etiquetas: front-end
 * 
 * PROBLEMA:
 * El tema Flavor  Ona Architecture tiene hardcodeado el ID de imagen 175 en el loop de productos,
 * lo que causa que todos los productos muestren la misma imagen incorrecta.
 * 
 * SOLUCIÓN:
 * Este snippet intercepta el output del loop y reemplaza las imágenes incorrectas
 * con las imágenes reales de cada producto.
 * 
 * INSTRUCCIONES:
 * 1. Copia este código en Code Snippets (Fragmentos > Añadir nuevo)
 * 2. Marca como "Ejecutar snippet en: Solo frontend"
 * 3. Activa el snippet
 */

// Evitar acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filtrar el HTML de la imagen del producto en el loop
 * Reemplaza cualquier referencia a wp-image-175 con la imagen correcta
 */
function fix_wc_product_loop_image_html( $html, $product ) {
    // Obtener el ID de la imagen destacada del producto
    $image_id = $product->get_image_id();
    
    if ( ! $image_id ) {
        // Si no hay imagen destacada, usar placeholder
        return wc_placeholder_img( 'woocommerce_thumbnail' );
    }
    
    // Obtener la URL de la imagen correcta
    $image_url = wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' );
    $image_srcset = wp_get_attachment_image_srcset( $image_id, 'woocommerce_thumbnail' );
    $image_sizes = wp_get_attachment_image_sizes( $image_id, 'woocommerce_thumbnail' );
    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
    
    if ( ! $image_alt ) {
        $image_alt = $product->get_name();
    }
    
    // Construir el HTML correcto de la imagen
    $new_html = sprintf(
        '<img src="%s" srcset="%s" sizes="%s" alt="%s" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-image-%d" loading="lazy" decoding="async" />',
        esc_url( $image_url ),
        esc_attr( $image_srcset ),
        esc_attr( $image_sizes ),
        esc_attr( $image_alt ),
        $image_id
    );
    
    return $new_html;
}
add_filter( 'woocommerce_product_get_image', 'fix_wc_product_loop_image_html', 9999, 2 );

/**
 * Asegurar que el thumbnail del producto use la imagen correcta
 */
function fix_post_thumbnail_in_loop( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    // Solo aplicar en contexto de WooCommerce
    if ( ! function_exists( 'is_woocommerce' ) ) {
        return $html;
    }
    
    // Verificar si es un producto
    if ( get_post_type( $post_id ) !== 'product' ) {
        return $html;
    }
    
    // Si el HTML contiene wp-image-175, reemplazarlo
    if ( strpos( $html, 'wp-image-175' ) !== false ) {
        $product = wc_get_product( $post_id );
        if ( $product ) {
            $correct_image_id = $product->get_image_id();
            if ( $correct_image_id && $correct_image_id != 175 ) {
                $html = wp_get_attachment_image( $correct_image_id, $size, false, $attr );
            }
        }
    }
    
    return $html;
}
add_filter( 'post_thumbnail_html', 'fix_post_thumbnail_in_loop', 9999, 5 );

/**
 * Filtrar directamente el output del loop de productos
 */
function start_product_loop_output_buffer() {
    if ( is_shop() || is_product_category() || is_product_tag() || is_woocommerce() ) {
        ob_start();
    }
}
add_action( 'woocommerce_before_shop_loop', 'start_product_loop_output_buffer', 1 );

function end_product_loop_output_buffer() {
    if ( is_shop() || is_product_category() || is_product_tag() || is_woocommerce() ) {
        $output = ob_get_clean();
        
        // Buscar y reemplazar referencias incorrectas a wp-image-175
        // Esto es un fix agresivo pero necesario para el tema Ona
        $output = preg_replace_callback(
            '/<img[^>]*class="[^"]*wp-image-175[^"]*"[^>]*>/i',
            function( $matches ) {
                global $product;
                
                // Intentar extraer el product ID del contexto
                preg_match( '/data-product[_-]?id=["\']?(\d+)["\']?/i', $matches[0], $id_match );
                
                if ( ! empty( $id_match[1] ) ) {
                    $prod = wc_get_product( $id_match[1] );
                    if ( $prod ) {
                        $image_id = $prod->get_image_id();
                        if ( $image_id && $image_id != 175 ) {
                            return wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array(
                                'class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail'
                            ));
                        }
                    }
                }
                
                return $matches[0];
            },
            $output
        );
        
        echo $output;
    }
}
add_action( 'woocommerce_after_shop_loop', 'end_product_loop_output_buffer', 9999 );

/**
 * JavaScript fallback para reemplazar imágenes en el cliente
 * Esto actúa como última línea de defensa
 */
function fix_product_images_js_fallback() {
    if ( ! is_shop() && ! is_product_category() && ! is_product_tag() && ! is_woocommerce() ) {
        return;
    }
    ?>
    <script id="fix-wc-product-images">
    (function() {
        'use strict';
        
        function fixProductImages() {
            // Buscar todas las imágenes con la clase incorrecta
            var incorrectImages = document.querySelectorAll('img.wp-image-175, img[class*="wp-image-175"]');
            
            incorrectImages.forEach(function(img) {
                // Buscar el contenedor del producto más cercano
                var productContainer = img.closest('.product, .wc-block-grid__product, [data-product-id]');
                
                if (productContainer) {
                    var productId = productContainer.dataset.productId || 
                                   productContainer.querySelector('[data-product-id]')?.dataset.productId ||
                                   productContainer.id?.replace('product-', '');
                    
                    if (productId) {
                        // Solicitar la imagen correcta via AJAX
                        fetch('<?php echo admin_url( 'admin-ajax.php' ); ?>?action=get_correct_product_image&product_id=' + productId)
                            .then(function(response) { return response.json(); })
                            .then(function(data) {
                                if (data.success && data.image_url) {
                                    img.src = data.image_url;
                                    img.srcset = data.srcset || '';
                                    img.classList.remove('wp-image-175');
                                    if (data.image_id) {
                                        img.classList.add('wp-image-' + data.image_id);
                                    }
                                }
                            })
                            .catch(function(err) {
                                console.warn('Error fixing product image:', err);
                            });
                    }
                }
            });
        }
        
        // Ejecutar cuando el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fixProductImages);
        } else {
            fixProductImages();
        }
        
        // También ejecutar después de que se carguen todas las imágenes
        window.addEventListener('load', fixProductImages);
        
        // Observer para productos cargados dinámicamente
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    setTimeout(fixProductImages, 100);
                }
            });
        });
        
        observer.observe(document.body, { childList: true, subtree: true });
    })();
    </script>
    <style>
        /* Ocultar brevemente las imágenes incorrectas mientras se corrigen */
        img.wp-image-175 {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        img.wp-image-175.fixed,
        img:not(.wp-image-175) {
            opacity: 1;
        }
        
        /* Placeholder mientras se carga la imagen correcta */
        .product .attachment-woocommerce_thumbnail {
            background: #f5f5f5;
            min-height: 200px;
            object-fit: contain;
        }
    </style>
    <?php
}
add_action( 'wp_footer', 'fix_product_images_js_fallback', 100 );

/**
 * Handler AJAX para obtener la imagen correcta del producto
 */
function ajax_get_correct_product_image() {
    $product_id = isset( $_GET['product_id'] ) ? absint( $_GET['product_id'] ) : 0;
    
    if ( ! $product_id ) {
        wp_send_json_error( 'No product ID provided' );
    }
    
    $product = wc_get_product( $product_id );
    
    if ( ! $product ) {
        wp_send_json_error( 'Product not found' );
    }
    
    $image_id = $product->get_image_id();
    
    if ( ! $image_id ) {
        wp_send_json_success( array(
            'image_url' => wc_placeholder_img_src( 'woocommerce_thumbnail' ),
            'srcset' => '',
            'image_id' => 0
        ));
    }
    
    wp_send_json_success( array(
        'image_url' => wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ),
        'srcset' => wp_get_attachment_image_srcset( $image_id, 'woocommerce_thumbnail' ),
        'image_id' => $image_id
    ));
}
add_action( 'wp_ajax_get_correct_product_image', 'ajax_get_correct_product_image' );
add_action( 'wp_ajax_nopriv_get_correct_product_image', 'ajax_get_correct_product_image' );

/**
 * Asegurar que las imágenes de productos usen el tamaño correcto
 */
function ensure_wc_thumbnail_size() {
    // Definir tamaño de thumbnail si no existe
    if ( ! has_image_size( 'woocommerce_thumbnail' ) ) {
        add_image_size( 'woocommerce_thumbnail', 500, 500, true );
    }
}
add_action( 'after_setup_theme', 'ensure_wc_thumbnail_size', 99 );
