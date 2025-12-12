<?php
/**
 * Code Snippet: Fix WooCommerce Product Images
 * Version: 3.0 - INSERCIÓN PROACTIVA
 * 
 * Descripción: Inserta la imagen destacada correcta en productos WooCommerce.
 *              El tema Ona Architecture FSE no tiene imagen en el template,
 *              así que este snippet la añade dinámicamente con JavaScript.
 * 
 * Scope: Frontend
 * Priority: 10
 * 
 * Cambios en v3.0 (Usuario eliminó imagen del template):
 * - La plantilla FSE ahora NO tiene imagen (columna vacía)
 * - El snippet INSERTA la imagen correcta usando JavaScript
 * - Elimina código innecesario de limpieza de imágenes incorrectas
 * - Enfoque: AÑADIR imagen, no eliminar
 * 
 * Solución v3.0 (Inserción Proactiva):
 * 1. JavaScript en <head>: Ejecuta lo antes posible (prioridad 1)
 * 2. Detecta columna vacía: Busca .wp-block-column sin contenido
 * 3. Inserta imagen correcta: Crea elemento <img> con featured_media del producto
 * 4. Multiple Attempts: 3 ejecuciones (inmediato, 50ms, 150ms) para máxima fiabilidad
 * 5. Dimensiones fijas: 500x500px, responsive, estilo consistente
 * 
 * Resultado: La imagen correcta aparece instantáneamente, sin flash, sin delay
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * JavaScript para insertar la imagen destacada del producto en la columna vacía
 * Ejecuta lo antes posible (wp_head prioridad 1)
 */
add_action( 'wp_head', 'ajax_insert_product_image_early', 1 );
function ajax_insert_product_image_early() {

    // Solo en páginas de producto
    if ( ! is_product() ) {
        return;
    }

    // Obtener el producto actual
    global $product;
    if ( ! $product ) {
        return;
    }

    // Obtener la URL de la imagen destacada
    $thumbnail_id = get_post_thumbnail_id( $product->get_id() );
    if ( ! $thumbnail_id ) {
        return;
    }

    $image_url = wp_get_attachment_image_url( $thumbnail_id, 'large' );
    $image_srcset = wp_get_attachment_image_srcset( $thumbnail_id, 'large' );
    $image_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
    $product_name = $product->get_name();

    ?>
    <script type="text/javascript">
    (function() {
        'use strict';

        var correctImageData = {
            url: <?php echo json_encode( $image_url ); ?>,
            srcset: <?php echo json_encode( $image_srcset ); ?>,
            alt: <?php echo json_encode( $image_alt ? $image_alt : $product_name ); ?>,
            productName: <?php echo json_encode( $product_name ); ?>
        };

        // Ejecutar lo ANTES posible - incluso antes de DOMContentLoaded
        function insertProductImage() {
            // 1. Buscar la columna VACÍA (izquierda) donde debe ir la imagen
            var columns = document.querySelectorAll('.wp-block-column');
            var imageColumn = null;

            // Buscar columna vacía (la columna de imagen del producto)
            columns.forEach(function(col) {
                // Columna con altura >500px, sin hijos, sin texto
                if (col.offsetHeight > 500 && col.children.length === 0 && !col.textContent.trim()) {
                    imageColumn = col;
                }
            });

            // Si no hay columna vacía, buscar la primera columna como fallback
            if (!imageColumn && columns.length > 0) {
                imageColumn = columns[0];
            }

            // Si hay columna H1 (título producto), usar la columna anterior como fallback
            if (!imageColumn) {
                var productTitle = document.querySelector('h1');
                if (productTitle) {
                    var titleColumn = productTitle.closest('.wp-block-column');
                    if (titleColumn) {
                        var parent = titleColumn.parentElement;
                        if (parent) {
                            var allCols = parent.querySelectorAll('.wp-block-column');
                            if (allCols.length > 1) {
                                // Tomar la columna ANTES del título
                                imageColumn = allCols[0];
                            }
                        }
                    }
                }
            }

            if (imageColumn && correctImageData.url) {
                // Verificar que no exista ya una imagen correcta
                var existingCorrectImage = imageColumn.querySelector('.product-image-fixed');
                if (existingCorrectImage) {
                    return; // Ya existe, no duplicar
                }

                // Limpiar cualquier contenido previo de la columna
                imageColumn.innerHTML = '';

                // Crear contenedor de imagen - Dimensiones fijas 500x500px
                var imageContainer = document.createElement('div');
                imageContainer.className = 'product-image-fixed';
                imageContainer.style.cssText = 'width: 500px; height: 500px; max-width: 100%; display: flex; align-items: center; justify-content: center; margin: 0 auto;';

                // Crear imagen con dimensiones estándar 500x500px
                var img = document.createElement('img');
                img.src = correctImageData.url;
                if (correctImageData.srcset) {
                    img.srcset = correctImageData.srcset;
                    img.sizes = 'auto, (max-width: 500px) 100vw, 500px';
                }
                img.alt = correctImageData.alt;
                img.style.cssText = 'width: 500px; height: 500px; max-width: 100%; object-fit: contain; border-radius: 12px; background: #fff; padding: 20px; border: 2px solid #fff; display: block;';

                imageContainer.appendChild(img);

                // Insertar en la columna de imagen
                imageColumn.appendChild(imageContainer);

                console.log('[Ajax Fix v3.0] Imagen 500x500 insertada en columna vacía');
            } else {
                console.warn('[Ajax Fix v3.0] No se encontró columna de imagen o URL inválida');
            }
        }

        // Ejecutar múltiples veces para capturar diferentes estados de carga
        if (document.readyState === 'loading') {
            // Ejecutar apenas sea posible
            document.addEventListener('DOMContentLoaded', insertProductImage);
        } else {
            // DOM ya cargado, ejecutar inmediatamente
            insertProductImage();
        }

        // Ejecutar también después de pequeños delays como seguridad adicional
        setTimeout(insertProductImage, 50);
        setTimeout(insertProductImage, 150);

    })();
    </script>
    <?php
}

/**
 * Asegurar que cada producto use su propia imagen destacada en loops
 * Sobreescribir completamente si es necesario
 */
add_filter( 'woocommerce_product_get_image', 'ajax_force_correct_product_thumbnail', 10, 5 );
function ajax_force_correct_product_thumbnail( $image, $product, $size, $attr, $placeholder ) {

    // Obtener el ID del producto actual
    $product_id = $product->get_id();

    // Obtener el ID de la imagen destacada de este producto específico
    $thumbnail_id = get_post_thumbnail_id( $product_id );

    // Si el producto tiene imagen destacada, usarla
    if ( $thumbnail_id ) {
        $image = wp_get_attachment_image(
            $thumbnail_id,
            $size,
            false,
            $attr
        );
    } 
    // Si no tiene imagen, usar placeholder
    else if ( $placeholder ) {
        $image = wc_placeholder_img( $size, $attr );
    }

    return $image;
}

/**
 * Limpiar cualquier cache que pueda estar causando el problema
 */
add_action( 'woocommerce_product_set_stock', 'ajax_clear_product_image_cache' );
add_action( 'save_post_product', 'ajax_clear_product_image_cache' );
function ajax_clear_product_image_cache( $product_id ) {

    // Limpiar transients
    delete_transient( 'wc_product_loop_' . $product_id );

    // Limpiar cache de WooCommerce
    if ( function_exists( 'wc_delete_product_transients' ) ) {
        wc_delete_product_transients( $product_id );
    }

    // Si LiteSpeed Cache está activo, purgar
    if ( class_exists( 'LiteSpeed_Cache_API' ) ) {
        do_action( 'litespeed_purge_post', $product_id );
    }
}
