<?php
/**
 * Snippet: Espaciado entre productos relacionados y footer
 * Descripción: Añade margen inferior a las secciones de productos para separarlas del footer
 * Tipo: CSS inline
 * Ubicación: Frontend
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
 * Añadir CSS personalizado para espaciado de productos y footer
 */
function woocommerce_product_footer_spacing() {
    ?>
    <style id="wc-product-footer-spacing">
        /* Espaciado para productos relacionados y botones antes del footer */
        .related.products,
        .upsells.products,
        .woocommerce-product-details,
        .product-page-content {
            margin-bottom: 4rem !important;
            padding-bottom: 2rem !important;
        }

        /* Espaciado específico para botones de añadir al carrito */
        .woocommerce .products .button,
        .woocommerce ul.products li.product .button,
        .woocommerce .product .button {
            margin-bottom: 1.5rem !important;
        }

        /* Asegurar espacio en la sección de productos relacionados */
        .related.products::after,
        .upsells.products::after {
            content: '';
            display: block;
            height: 3rem;
        }

        /* Espaciado general para el contenido de producto */
        .woocommerce-page .site-main,
        .single-product .site-main {
            padding-bottom: 3rem !important;
        }

        /* Espaciado para el grid de productos */
        .woocommerce ul.products {
            margin-bottom: 3rem !important;
        }

        /* Espaciado para la sección completa de WooCommerce */
        .woocommerce {
            padding-bottom: 2rem !important;
        }

        /* Espaciado adicional antes del footer */
        .site-footer {
            margin-top: 3rem !important;
        }

        /* Responsive: mantener espaciado en móviles */
        @media (max-width: 768px) {
            .related.products,
            .upsells.products {
                margin-bottom: 3rem !important;
                padding-bottom: 1.5rem !important;
            }
            
            .woocommerce-page .site-main,
            .single-product .site-main {
                padding-bottom: 2rem !important;
            }

            .site-footer {
                margin-top: 2rem !important;
            }
        }

        /* Tablet */
        @media (min-width: 769px) and (max-width: 1024px) {
            .related.products,
            .upsells.products {
                margin-bottom: 3.5rem !important;
                padding-bottom: 1.75rem !important;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'woocommerce_product_footer_spacing', 999 );
