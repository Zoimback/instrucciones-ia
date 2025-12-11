<?php
// CSS: Etiquetas alineadas y controles visibles
add_action('wp_head', function() {
    if (is_product()) {
        global $product;
        if ($product && $product->get_type() === 'grouped') {
            ?>
            <style>
                .woocommerce-grouped-product-list-item {
                    padding: 15px;
                    margin-bottom: 12px;
                    border-radius: 4px;
                    border: 2px solid white !important;
                    background-color: #1a1a1a !important;
                    transition: all 0.3s ease;
                    display: grid !important;
                    grid-template-columns: 80px 1fr auto auto;
                    align-items: center;
                    gap: 15px;
                }
                
                .woocommerce-grouped-product-list-item:hover {
                    box-shadow: 0 3px 10px rgba(255,255,255,0.2);
                    border-color: #ddd !important;
                    background-color: #2a2a2a !important;
                }
                
                /* Controles de cantidad - siempre visibles */
                .woocommerce-grouped-product-list-item .quantity {
                    order: 1;
                }
                
                .woocommerce-grouped-product-list-item input[type="number"] {
                    opacity: 1 !important;
                    visibility: visible !important;
                }
                
                /* Botones +/- siempre visibles */
                .woocommerce-grouped-product-list-item .quantity button,
                .woocommerce-grouped-product-list-item .quantity .quantity__button {
                    opacity: 1 !important;
                    visibility: visible !important;
                    display: inline-block !important;
                }
                
                /* Label del producto */
                .woocommerce-grouped-product-list-item__label {
                    order: 2;
                    text-align: left;
                }
                
                /* Contenedor de precio + badge */
                .woocommerce-grouped-product-list-item__price {
                    order: 3;
                    text-align: right;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    justify-content: flex-end;
                }
                
                /* Asegurar que el texto sea visible */
                .woocommerce-grouped-product-list-item label,
                .woocommerce-grouped-product-list-item a,
                .woocommerce-grouped-product-list-item .woocommerce-Price-amount {
                    color: white !important;
                }
                
                /* Ocultar precio estático en TODOS sus lugares */
                .summary .price,
                p.price,
                .woocommerce-product-details__short-description + .price {
                    display: none !important;
                }
                
                /* Precio dinámico en la cabecera del producto */
                .ajax-dynamic-price {
                    font-size: 28px;
                    font-weight: 700;
                    color: #4caf50;
                    margin: 15px 0;
                    display: block !important;
                }
                
                /* Mover descripción al espacio de la imagen */
                .woocommerce-product-gallery {
                    order: 2;
                }
                
                .woocommerce-product-details__short-description {
                    background: #1a1a1a;
                    border: 2px solid #333;
                    border-radius: 8px;
                    padding: 25px;
                    margin: 20px 0;
                    color: #ddd;
                    line-height: 1.8;
                }
                
                .woocommerce-product-details__short-description h2,
                .woocommerce-product-details__short-description h3 {
                    color: #4caf50;
                    margin-top: 20px;
                    margin-bottom: 10px;
                }
                
                .woocommerce-product-details__short-description h2:first-child,
                .woocommerce-product-details__short-description h3:first-child {
                    margin-top: 0;
                }
                
                /* Espaciado después de la lista de productos */
                .woocommerce-grouped-product-list {
                    margin-bottom: 30px !important;
                }
                
                .woocommerce-grouped-product-list-item:last-child {
                    margin-bottom: 30px !important;
                }
                
                button.single_add_to_cart_button {
                    margin-top: 30px !important;
                }
                
                /* Etiquetas - ahora dentro del contenedor de precio */
                .ajax-product-badge {
                    display: inline-block;
                    padding: 4px 10px;
                    border-radius: 3px;
                    font-size: 10px;
                    font-weight: 700;
                    vertical-align: middle;
                    text-transform: uppercase;
                    letter-spacing: 0.3px;
                    white-space: nowrap;
                }
                
                .badge-required {
                    background-color: #d32f2f;
                    color: white;
                }
                
                .badge-premium {
                    background-color: #ff9800;
                    color: white;
                }
                
                .badge-included {
                    background-color: #4caf50;
                    color: white;
                }
                
                .badge-optional {
                    background-color: #757575;
                    color: white;
                }
                
                /* Link cambiar color */
                .ajax-color-switch {
                    display: inline-block;
                    margin: 15px 0;
                    padding: 10px 20px;
                    background: #333;
                    border: 2px solid white;
                    border-radius: 4px;
                    text-decoration: none;
                    color: white;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }
                
                .ajax-color-switch:hover {
                    background: #555;
                    color: white;
                    border-color: #ddd;
                }
                
                /* Contenedor de separadores en fila */
                .ajax-sections-tabs {
                    display: flex;
                    gap: 10px;
                    margin: 20px 0;
                    flex-wrap: wrap;
                }
                
                /* Separador de secciones - estilo tab */
                .ajax-section-tab {
                    padding: 10px 20px;
                    background: #2a2a2a;
                    border: 2px solid white;
                    border-radius: 4px;
                    font-weight: 600;
                    font-size: 13px;
                    color: white;
                    white-space: nowrap;
                    flex: 0 0 auto;
                }
                
                .ajax-section-tab.hub-tab {
                    border-color: #d32f2f;
                    background: #1a0000;
                }
                
                .ajax-section-tab.basic-tab {
                    border-color: #4caf50;
                    background: #001a00;
                }
                
                .ajax-section-tab.optional-tab {
                    border-color: #757575;
                    background: #1a1a1a;
                }
                
                /* Separación para cards de productos en archivo/shop */
                .woocommerce ul.products li.product,
                .woocommerce-page ul.products li.product {
                    margin-bottom: 30px !important;
                    padding-bottom: 20px !important;
                }
                
                .woocommerce ul.products li.product .button,
                .woocommerce-page ul.products li.product .button {
                    margin-top: 15px !important;
                }
            </style>
            <?php
        }
    } else {
        ?>
        <style>
            .woocommerce ul.products li.product,
            .woocommerce-page ul.products li.product {
                margin-bottom: 30px !important;
                padding-bottom: 20px !important;
            }
            
            .woocommerce ul.products li.product .button,
            .woocommerce-page ul.products li.product .button {
                margin-top: 15px !important;
            }
        </style>
        <?php
    }
});

// JavaScript: Reordenar, añadir etiquetas, cantidades y precio dinámico
add_action('wp_footer', function() {
    if (is_product()) {
        global $product;
        if ($product && $product->get_type() === 'grouped') {
            $product_id = $product->get_id();
            $other_kit_url = '';
            $other_kit_name = '';
            
            if ($product_id == 110) {
                $other_kit_url = get_permalink(111);
                $other_kit_name = 'Ver en Blanco →';
            } else if ($product_id == 111) {
                $other_kit_url = get_permalink(110);
                $other_kit_name = 'Ver en Negro →';
            }
            ?>
            <script>
            jQuery(document).ready(function($) {
                var productConfig = {
                    112: { order: 1, default: 1, badge: 'required', label: '⚠️ OBLIGATORIO', section: 'hub' },
                    113: { order: 2, default: 1, badge: 'required', label: '⚠️ OBLIGATORIO', section: 'hub' },
                    114: { order: 3, default: 0, badge: 'premium', label: '⭐ PREMIUM', section: 'hub' },
                    115: { order: 4, default: 0, badge: 'premium', label: '⭐ PREMIUM', section: 'hub' },
                    116: { order: 10, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    117: { order: 11, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    127: { order: 12, default: 2, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    126: { order: 13, default: 2, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    125: { order: 14, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    124: { order: 15, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    123: { order: 16, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    122: { order: 17, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    121: { order: 18, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    120: { order: 19, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic' },
                    128: { order: 30, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    129: { order: 31, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    130: { order: 32, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    131: { order: 33, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    132: { order: 34, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    133: { order: 35, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    134: { order: 36, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    135: { order: 37, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    136: { order: 38, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    137: { order: 39, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    138: { order: 40, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    139: { order: 41, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    140: { order: 42, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    141: { order: 43, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    144: { order: 44, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' },
                    145: { order: 45, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' }
                };
                
                // Mapa de precios por producto
                var productPrices = {};
                
                var $productList = $('.woocommerce-grouped-product-list');
                var $rows = $productList.find('.woocommerce-grouped-product-list-item').detach();
                
                // Ocultar todos los precios estáticos
                $('.summary .price, p.price').remove();
                
                // Añadir precio dinámico después del título
                if (!$('.ajax-dynamic-price').length) {
                    var dynamicPriceHtml = '<div class="ajax-dynamic-price">0,00 €</div>';
                    $('.product_title').after(dynamicPriceHtml);
                }
                
                // Mover descripción al espacio de la galería
                var description = $('.woocommerce-product-details__short-description').detach();
                $('.woocommerce-product-gallery').after(description);
                
                <?php if ($other_kit_url): ?>
                var colorSwitchButton = '<a href="<?php echo esc_js($other_kit_url); ?>" class="ajax-color-switch"><?php echo esc_js($other_kit_name); ?></a>';
                $productList.before(colorSwitchButton);
                <?php endif; ?>
                
                var sectionsTabsHtml = '<div class="ajax-sections-tabs">' +
                    '<div class="ajax-section-tab hub-tab">🔴 CENTRAL DE ALARMA (Obligatorio - Elige 1)</div>' +
                    '<div class="ajax-section-tab basic-tab">✅ KIT BÁSICO (Incluidos por defecto)</div>' +
                    '<div class="ajax-section-tab optional-tab">➕ COMPONENTES OPCIONALES</div>' +
                    '</div>';
                $productList.before(sectionsTabsHtml);
                
                var sortedRows = [];
                
                $rows.each(function() {
                    var $row = $(this);
                    var productId = $row.find('input.qty').attr('name');
                    if (!productId) return;
                    
                    productId = parseInt(productId.match(/\d+/)[0]);
                    var config = productConfig[productId] || { order: 999, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional' };
                    
                    // Extraer precio del producto
                    var priceText = $row.find('.woocommerce-Price-amount bdi').text();
                    var priceMatch = priceText.match(/[\d,]+/);
                    if (priceMatch) {
                        productPrices[productId] = parseFloat(priceMatch[0].replace(',', '.'));
                    }
                    
                    var qtyInput = $row.find('input.qty');
                    if (qtyInput.val() == 0) {
                        qtyInput.val(config.default);
                    }
                    
                    // Mover badge al contenedor de precio
                    if (config.badge) {
                        var priceContainer = $row.find('.woocommerce-grouped-product-list-item__price');
                        if (priceContainer.length && !priceContainer.find('.ajax-product-badge').length) {
                            var badge = '<span class="ajax-product-badge badge-' + config.badge + '">' + config.label + '</span>';
                            priceContainer.append(badge);
                        }
                    }
                    
                    sortedRows.push({ element: $row, order: config.order, section: config.section });
                });
                
                sortedRows.sort(function(a, b) { return a.order - b.order; });
                
                sortedRows.forEach(function(item) {
                    $productList.append(item.element);
                });
                
                // Función para calcular y actualizar el precio total
                function updateTotalPrice() {
                    var total = 0;
                    
                    $('.woocommerce-grouped-product-list-item').each(function() {
                        var $row = $(this);
                        var qtyInput = $row.find('input.qty');
                        var productId = parseInt(qtyInput.attr('name').match(/\d+/)[0]);
                        var quantity = parseInt(qtyInput.val()) || 0;
                        var price = productPrices[productId] || 0;
                        
                        total += quantity * price;
                    });
                    
                    $('.ajax-dynamic-price').text(total.toFixed(2).replace('.', ',') + ' €');
                }
                
                // Actualizar precio al cargar
                setTimeout(updateTotalPrice, 500);
                
                // Actualizar precio cuando cambien las cantidades
                $(document).on('change', '.woocommerce-grouped-product-list-item input.qty', function() {
                    updateTotalPrice();
                });
                
                // Actualizar también con los botones +/-
                $(document).on('click', '.quantity button, .quantity .quantity__button', function() {
                    setTimeout(updateTotalPrice, 100);
                });
                
                // Validación Hub obligatorio
                $('button.single_add_to_cart_button').on('click', function(e) {
                    var hubIds = [112, 113, 114, 115], hasHub = false;
                    hubIds.forEach(function(id) {
                        var qty = $('input[name="quantity[' + id + ']"]').val();
                        if (qty && parseInt(qty) > 0) hasHub = true;
                    });
                    if (!hasHub) {
                        e.preventDefault();
                        alert('⚠️ ¡Hub Obligatorio!\n\nDebes seleccionar al menos 1 Hub antes de añadir el kit al carrito.');
                        $('html, body').animate({ scrollTop: $('.ajax-sections-tabs').offset().top - 100 }, 500);
                    }
                });
            });
            </script>
            <?php
        }
    }
});