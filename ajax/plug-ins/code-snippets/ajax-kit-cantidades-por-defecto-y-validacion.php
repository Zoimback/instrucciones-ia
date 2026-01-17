<?php
/**
 * Snippet: Ajax Kit - Cantidades por Defecto y Validación
 * 
 * CSS: Etiquetas alineadas y controles visibles
 * JavaScript: Reordenar, añadir etiquetas, cantidades y precio dinámico
 */

// CSS: Etiquetas alineadas y controles visibles
add_action('wp_head', function() {
    if (is_product()) {
        $product = wc_get_product(get_queried_object_id());
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
                    display: flex;
                    flex-direction: column;
                    gap: 5px;
                }
                
                /* Descripción del producto */
                .ajax-product-description {
                    font-size: 12px;
                    color: #aaa !important;
                    line-height: 1.4;
                    margin-top: 5px;
                    font-weight: 400;
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
        $product = wc_get_product(get_queried_object_id());
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
            <script type="text/javascript">
            (function() { console.log('AJAX Kit Script Loading...'); var initKitScript = function() { console.log('AJAX Kit Script Executing...'); var $ = jQuery;
                var productConfig = {
                    112: { order: 1, default: 1, badge: 'required', label: '⚠️ OBLIGATORIO', section: 'hub', desc: 'Central de alarma Ajax Hub 2 4G en blanco. Gestiona hasta 100 dispositivos con conectividad 4G/2G integrada y Ethernet. Incluye 2 años de conectividad celular gratuita. Ideal para viviendas y negocios.' },
                    113: { order: 2, default: 1, badge: 'required', label: '⚠️ OBLIGATORIO', section: 'hub', desc: 'Central de alarma Ajax Hub 2 4G en negro. Gestiona hasta 100 dispositivos con conectividad 4G/2G integrada y Ethernet. Incluye 2 años de conectividad celular gratuita. Ideal para viviendas y negocios.' },
                    114: { order: 3, default: 0, badge: 'premium', label: '⭐ PREMIUM', section: 'hub', desc: 'Central premium Ajax Hub 2 Plus en blanco. Doble capacidad: hasta 200 dispositivos y usuarios. Comunicación redundante con 2 SIM 4G/2G. Procesador más potente. Actualización de +100€ sobre Hub 2 estándar.' },
                    115: { order: 4, default: 0, badge: 'premium', label: '⭐ PREMIUM', section: 'hub', desc: 'Central premium Ajax Hub 2 Plus en negro. Doble capacidad: hasta 200 dispositivos y usuarios. Comunicación redundante con 2 SIM 4G/2G. Procesador más potente. Actualización de +100€ sobre Hub 2 estándar.' },
                    116: { order: 10, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Teclado táctil inalámbrico Ajax en negro. Hasta 99 códigos PIN, vidrio templado, LED multicolor. Batería 4.5 años. Alcance 1700m. Montaje SmartBracket sin herramientas.' },
                    117: { order: 11, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Teclado táctil inalámbrico Ajax en blanco. Hasta 99 códigos PIN, vidrio templado, LED multicolor. Batería 4.5 años. Alcance 1700m. Montaje SmartBracket sin herramientas.' },
                    118: { order: 12, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'basic', desc: 'Teclado táctil Ajax Plus en negro con lector NFC. Hasta 99 códigos PIN + tarjetas/tags NFC ilimitados. Batería 3.5 años. Control rápido sin contacto con tecnología DESFire®.' },
                    119: { order: 13, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'basic', desc: 'Teclado táctil Ajax Plus en blanco con lector NFC. Hasta 99 códigos PIN + tarjetas/tags NFC ilimitados. Batería 3.5 años. Control rápido sin contacto con tecnología DESFire®.' },
                    120: { order: 19, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Sirena interior Ajax en blanco, 105 dB ajustables. LED indicador, función Chime, tonos personalizables. Batería 5 años. Alcance 2000m. Montaje SmartBracket sin herramientas.' },
                    121: { order: 18, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Sirena interior Ajax en negro, 105 dB ajustables. LED indicador, función Chime, tonos personalizables. Batería 5 años. Alcance 2000m. Montaje SmartBracket sin herramientas.' },
                    122: { order: 17, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Mando a distancia Ajax en blanco. 4 botones: armado, noche, desarmado y SOS. Batería 3 años. Alcance 1300m. Compacto con llavero incluido. Protección anti-clonación.' },
                    123: { order: 16, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Mando a distancia Ajax en negro. 4 botones: armado, noche, desarmado y SOS. Batería 3 años. Alcance 1300m. Compacto con llavero incluido. Protección anti-clonación.' },
                    124: { order: 15, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Contacto magnético Ajax Plus en blanco con sensor de vibración. Doble detección: apertura + golpes/taladros. Sensibilidad ajustable. Batería 7 años. Montaje rápido SmartBracket.' },
                    125: { order: 14, default: 1, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Contacto magnético Ajax Plus en negro con sensor de vibración. Doble detección: apertura + golpes/taladros. Sensibilidad ajustable. Batería 7 años. Montaje rápido SmartBracket.' },
                    126: { order: 13, default: 2, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Detector con cámara Ajax en blanco. Fotos HDR en 9 seg, visión nocturna IR, SmartDetect, inmunidad mascotas 80cm. Batería 5 años. Alcance 12m. Protocolo Wings para transmisión rápida.' },
                    127: { order: 12, default: 2, badge: 'included', label: '✓ INCLUIDO', section: 'basic', desc: 'Detector con cámara Ajax en negro. Fotos HDR en 9 seg, visión nocturna IR, SmartDetect, inmunidad mascotas 80cm. Batería 5 años. Alcance 12m. Protocolo Wings para transmisión rápida.' },
                    128: { order: 30, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector de inundación Ajax en blanco. Ultra compacto 14mm, protección IP65, 4 pares de contactos. Batería 5 años. Alcance 1300m. Integración con WaterStop para cierre automático.' },
                    129: { order: 31, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector de inundación Ajax en negro. Ultra compacto 14mm, protección IP65, 4 pares de contactos. Batería 5 años. Alcance 1300m. Integración con WaterStop para cierre automático.' },
                    130: { order: 32, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector de movimiento Ajax Plus en blanco con sensor de temperatura y micrófono. SmartDetect, inmunidad mascotas 80cm, alcance 12m. Batería 5 años. Doble verificación anti-falsas alarmas.' },
                    131: { order: 33, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector de movimiento Ajax Plus en negro con sensor de temperatura y micrófono. SmartDetect, inmunidad mascotas 80cm, alcance 12m. Batería 5 años. Doble verificación anti-falsas alarmas.' },
                    132: { order: 34, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector combinado Ajax en negro: movimiento (12m) + rotura cristales (9m). Algoritmo DualTone, inmunidad mascotas 80cm, 3 niveles sensibilidad. Batería 5 años. Doble protección en 1 dispositivo.' },
                    133: { order: 35, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector combinado Ajax en blanco: movimiento (12m) + rotura cristales (9m). Algoritmo DualTone, inmunidad mascotas 80cm, 3 niveles sensibilidad. Batería 5 años. Doble protección en 1 dispositivo.' },
                    134: { order: 36, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector de rotura de cristales Ajax en blanco. Algoritmo DualTone, alcance 9m, cobertura 180°, 3 niveles sensibilidad. Batería 7 años. Micrófono electret de alta precisión.' },
                    135: { order: 37, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector de rotura de cristales Ajax en negro. Algoritmo DualTone, alcance 9m, cobertura 180°, 3 niveles sensibilidad. Batería 7 años. Micrófono electret de alta precisión.' },
                    136: { order: 38, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector exterior Ajax con cámara PhOD en blanco. IP55, temperatura -25°C a +60°C, alcance 15m. Fotos HDR en <9 seg, visión nocturna IR. Inmunidad mascotas 80cm. Batería 4 años.' },
                    137: { order: 39, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector exterior Ajax con cámara PhOD en negro. IP55, temperatura -25°C a +60°C, alcance 15m. Fotos HDR en <9 seg, visión nocturna IR. Inmunidad mascotas 80cm. Batería 4 años.' },
                    138: { order: 40, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Tarjeta NFC Ajax Pass en negro. DESFire® EV1, ISO 14443, cifrado AES-128. Compatible KeyPad Plus. Formato cartera estándar. Sin batería, tecnología pasiva. Gestión remota desde app.' },
                    139: { order: 41, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Tarjeta NFC Ajax Pass en blanco. DESFire® EV1, ISO 14443, cifrado AES-128. Compatible KeyPad Plus. Formato cartera estándar. Sin batería, tecnología pasiva. Gestión remota desde app.' },
                    140: { order: 42, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Pack 10 llaveros NFC Ajax Tag en blanco. DESFire® EV1, ISO 14443, cifrado AES-128. Compatible KeyPad Plus. Compactos 40mm, resistentes a golpes/agua. Sin batería. Gestión remota app.' },
                    141: { order: 43, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Pack 10 llaveros NFC Ajax Tag en negro. DESFire® EV1, ISO 14443, cifrado AES-128. Compatible KeyPad Plus. Compactos 40mm, resistentes a golpes/agua. Sin batería. Gestión remota app.' },
                    144: { order: 44, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector Ajax 3 en 1: humo + calor + CO. Certificado EN 14604/EN 50291. Cámara óptica dual, sensor electroquímico CO. Sirena 85dB, LED RGB. Batería 7 años. Autodiagnóstico 24/7.' },
                    145: { order: 45, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: 'Detector Ajax 3 en 1: humo + calor + CO. Certificado EN 14604/EN 50291. Cámara óptica dual, sensor electroquímico CO. Sirena 85dB, LED RGB. Batería 7 años. Autodiagnóstico 24/7.' }
                };
                
                // Mapa de precios por producto
                var productPrices = {};
                
                var $productList = $('.woocommerce-grouped-product-list');
                var $rows = $productList.find('.woocommerce-grouped-product-list-item').detach();
                
                // Ocultar todos los precios estáticos
                $('.wp-block-woocommerce-product-price').hide();
                
                // Añadir precio dinámico después del título
                if (!$('.ajax-dynamic-price').length) {
                    var dynamicPriceHtml = '<div class="ajax-dynamic-price">0,00 €</div>';
                    $('.product_title, .wp-block-post-title, h1.entry-title').first().after(dynamicPriceHtml);
                }
                
                // Mover descripción al espacio de la galería
                // Movimiento de descripción omitido - tema FSE no tiene galería clásica
                
                <?php if ($other_kit_url): ?>
                var colorSwitchButton = '<a href="<?php echo esc_js($other_kit_url); ?>" class="ajax-color-switch"><?php echo esc_js($other_kit_name); ?></a>';
                $productList.before(colorSwitchButton);
                <?php endif; ?>
                
                var sectionsTabsHtml = '<div class="ajax-sections-tabs">' +
                    '<div class="ajax-section-tab hub-tab">🔴 CENTRAL DE ALARMA (Obligatorio - Solo 1)</div>' +
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
                    var config = productConfig[productId] || { order: 999, default: 0, badge: 'optional', label: 'OPCIONAL', section: 'optional', desc: '' };
                    
                    // Añadir descripción del producto debajo del nombre
                    if (config.desc) {
                        var labelContainer = $row.find('.woocommerce-grouped-product-list-item__label');
                        if (labelContainer.length && !labelContainer.find('.ajax-product-description').length) {
                            var description = '<div class="ajax-product-description">' + config.desc + '</div>';
                            labelContainer.append(description);
                        }
                    }
                    
                    // Extraer precio del producto
                    var priceText = $row.find('.woocommerce-Price-amount bdi').text();
                    var priceMatch = priceText.match(/[\d,]+/);
                    if (priceMatch) {
                        productPrices[productId] = parseFloat(priceMatch[0].replace(',', '.'));
                    }
                    
                    var qtyInput = $row.find('input.qty');
                    if (qtyInput.val() === '' || qtyInput.val() == 0) {
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
                
                // Validación Hub obligatorio y solo uno permitido
                var hubIds = [112, 113, 114, 115];
                
                function countSelectedHubs() {
                    var count = 0;
                    hubIds.forEach(function(id) {
                        var qty = parseInt($('input[name="quantity[' + id + ']"]').val()) || 0;
                        if (qty > 0) count += qty;
                    });
                    return count;
                }
                
                hubIds.forEach(function(hubId) {
                    $(document).on('change', 'input[name="quantity[' + hubId + ']"]', function() {
                        var currentQty = parseInt($(this).val()) || 0;
                        if (currentQty > 0) {
                            if (currentQty > 1) { $(this).val(1); currentQty = 1; }
                            hubIds.forEach(function(otherId) {
                                if (otherId !== hubId) { $('input[name="quantity[' + otherId + ']"]').val(0); }
                            });
                            updateTotalPrice();
                        }
                    });
                });
                
                $(document).on('click', '.woocommerce-grouped-product-list-item .quantity button, .woocommerce-grouped-product-list-item .quantity .quantity__button', function() {
                    var $row = $(this).closest('.woocommerce-grouped-product-list-item');
                    var $input = $row.find('input.qty');
                    var inputName = $input.attr('name');
                    var productId = parseInt(inputName.match(/\d+/)[0]);
                    
                    if (hubIds.indexOf(productId) !== -1) {
                        setTimeout(function() {
                            var currentQty = parseInt($input.val()) || 0;
                            if (currentQty > 0) {
                                if (currentQty > 1) { $input.val(1); }
                                hubIds.forEach(function(otherId) {
                                    if (otherId !== productId) { $('input[name="quantity[' + otherId + ']"]').val(0); }
                                });
                                updateTotalPrice();
                            }
                        }, 50);
                    }
                });
                
                $('button.single_add_to_cart_button').on('click', function(e) {
                    var hubCount = countSelectedHubs();
                    if (hubCount === 0) {
                        e.preventDefault();
                        alert('⚠️ ¡Hub Obligatorio!\n\nDebes seleccionar exactamente 1 Hub antes de añadir el kit al carrito.');
                        $('html, body').animate({ scrollTop: $('.ajax-sections-tabs').offset().top - 100 }, 500);
                        return false;
                    }
                    if (hubCount > 1) {
                        e.preventDefault();
                        alert('⚠️ ¡Solo un Hub por pedido!\n\nSolo puedes seleccionar 1 Hub por kit. Por favor, elige solo uno.');
                        $('html, body').animate({ scrollTop: $('.ajax-sections-tabs').offset().top - 100 }, 500);
                        return false;
                    }
                });
            }; if (document.readyState === 'complete') { initKitScript(); } else { window.addEventListener('load', initKitScript); } })();
            </script>
            <?php
        }
    }
}, PHP_INT_MAX);
