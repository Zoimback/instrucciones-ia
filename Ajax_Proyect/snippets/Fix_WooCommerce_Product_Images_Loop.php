<?php
/**
 * Code Snippet: Fix WooCommerce Product Images
 * 
 * Descripción: Corrige el problema de imágenes incorrectas en productos WooCommerce.
 *              El tema Ona Architecture está mostrando una imagen hardcodeada (wp-image-175)
 *              del starter-kit en lugar de usar la imagen destacada de cada producto.
 * 
 * Scope: Frontend
 * Priority: 10
 * 
 * Problema identificado:
 * - El tema FSE Ona Architecture inserta una imagen fija (ID 175) en todos los productos
 * - La imagen del starter-kit se muestra en lugar de la featured_media de cada producto
 * - El template del tema tiene la imagen hardcodeada
 * 
 * Solución:
 * - Eliminar la imagen incorrecta del contenido con JavaScript (fallback)
 * - Filtrar el contenido del producto para eliminar imágenes incorrectas
 * - Forzar el uso de la imagen destacada correcta EN LA COLUMNA IZQUIERDA con dimensiones 500x500px
 */

if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
}

/**
 * Eliminar cualquier hook personalizado del tema que pueda estar
 * interfiriendo con las imágenes de productos
 */
add_action( 'after_setup_theme', 'ajax_fix_woocommerce_product_images', 20 );
function ajax_fix_woocommerce_product_images() {

// Eliminar todos los hooks que puedan estar sobreescribiendo la imagen
remove_all_actions( 'woocommerce_before_shop_loop_item_title', 10 );

// Restaurar la función estándar de WooCommerce para mostrar imágenes
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// También aplicar a productos individuales
remove_all_actions( 'woocommerce_before_single_product_summary', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
}

/**
 * Filtrar el contenido del producto para eliminar bloques de imagen incorrectos
 * que el tema FSE puede estar insertando
 */
add_filter( 'the_content', 'ajax_remove_incorrect_product_images', 5 );
function ajax_remove_incorrect_product_images( $content ) {

// Solo aplicar en páginas de producto individual
if ( ! is_product() ) {
return $content;
}

// Eliminar cualquier imagen con la clase wp-image-175 (starter-kit)
$content = preg_replace(
'/<figure[^>]*class="[^"]*wp-image-175[^"]*"[^>]*>.*?<\/figure>/is',
'',
$content
);

// Eliminar imágenes específicas del starter-kit
$content = preg_replace(
'/<img[^>]*starter-kit-negro-ajax-con-camaras[^>]*>/i',
'',
$content
);

return $content;
}

/**
 * JavaScript para eliminar la imagen incorrecta del DOM
 * y reemplazarla con la imagen destacada correcta EN LA COLUMNA IZQUIERDA (500x500px)
 */
add_action( 'wp_footer', 'ajax_remove_incorrect_image_js', 999 );
function ajax_remove_incorrect_image_js() {

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
var correctImageData = {
url: <?php echo json_encode( $image_url ); ?>,
srcset: <?php echo json_encode( $image_srcset ); ?>,
alt: <?php echo json_encode( $image_alt ? $image_alt : $product_name ); ?>,
productName: <?php echo json_encode( $product_name ); ?>
};

// Esperar a que el DOM esté listo
if (document.readyState === 'loading') {
document.addEventListener('DOMContentLoaded', fixProductImage);
} else {
fixProductImage();
}

function fixProductImage() {
// 1. Eliminar imagen incorrecta wp-image-175 (starter-kit)
var incorrectImages = document.querySelectorAll('.wp-image-175, img[src*="starter-kit"]');

incorrectImages.forEach(function(img) {
var figure = img.closest('figure');
if (figure && !figure.closest('.related') && !figure.closest('.upsells')) {
figure.remove();
} else if (!img.closest('.related') && !img.closest('.upsells')) {
img.remove();
}
});

// Eliminar cualquier imagen insertada previamente de forma incorrecta
var oldFixedImages = document.querySelectorAll('.product-image-fixed');
oldFixedImages.forEach(function(el) {
el.remove();
});

// 2. Buscar la columna VACÍA (izquierda) donde debe ir la imagen
var columns = document.querySelectorAll('.wp-block-column');
var imageColumn = null;

// Buscar columna vacía (la columna de imagen del producto)
columns.forEach(function(col) {
if (col.offsetHeight > 500 && col.children.length === 0 && !col.textContent.trim()) {
imageColumn = col;
}
});

// Si no hay columna vacía, buscar la que tiene el h1 como fallback
if (!imageColumn) {
var productTitle = document.querySelector('h1');
if (productTitle) {
imageColumn = productTitle.closest('.wp-block-column');
}
}

if (imageColumn && correctImageData.url) {
// Verificar que no exista ya una imagen correcta
var existingCorrectImage = imageColumn.querySelector('.product-image-fixed');
if (existingCorrectImage) {
return; // Ya existe, no duplicar
}

// Crear contenedor de imagen - Dimensiones fijas 500x500px
var imageContainer = document.createElement('div');
imageContainer.className = 'product-image-fixed';
imageContainer.style.cssText = 'width: 500px; height: 500px; max-width: 100%; display: flex; align-items: center; justify-content: center;';

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

console.log('[Ajax Fix] Imagen 500x500 insertada en columna correcta');
} else {
console.error('[Ajax Fix] No se encontró columna de imagen o URL inválida');
}
}
})();
</script>
<?php
}

/**
 * Asegurar que cada producto use su propia imagen destacada
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
