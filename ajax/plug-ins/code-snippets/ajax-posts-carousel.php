<?php
/**
 * Snippet: AJAX Posts Carousel - Shortcode [ajax_posts_carousel]
 * Descripción: Carrusel de beneficios para productos AJAX Systems
 * Versión: 2.0.2
 * Tipo: PHP Class + CSS + JavaScript
 * Ubicación: Frontend
 * 
 * Etiquetas: front-end
 * 
 * INSTRUCCIONES:
 * 1. Copia este código en Code Snippets (Fragmentos > Añadir nuevo)
 * 2. Marca como "Ejecutar snippet en: Solo frontend"
 * 3. Activa el snippet
 * 4. Usa el shortcode [ajax_posts_carousel] en cualquier página o post
 */

// Evitar acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Clase principal para el carrusel de beneficios AJAX
 */
class Ajax_Posts_Carousel {
    
    /**
     * Versión del snippet
     */
    const VERSION = '2.0.2';
    
    /**
     * Beneficios estáticos para mostrar en el carrusel
     */
    private static $benefits = array(
        array(
            'title' => 'Instalación Profesional',
            'description' => 'Instalación realizada por técnicos certificados AJAX Systems. Configuración completa del sistema y formación personalizada.',
            'icon' => 'dashicons-admin-tools'
        ),
        array(
            'title' => 'Sin Cuotas Mensuales',
            'description' => 'Tu sistema de alarma sin costes recurrentes. Pago único y control total desde tu smartphone.',
            'icon' => 'dashicons-money-alt'
        ),
        array(
            'title' => 'Tecnología Inalámbrica',
            'description' => 'Sistema 100% inalámbrico con protocolo Jeweller. Alcance de hasta 2000m y encriptación de nivel bancario.',
            'icon' => 'dashicons-wifi'
        ),
        array(
            'title' => 'App Gratuita',
            'description' => 'Control total desde la app AJAX para iOS y Android. Notificaciones instantáneas y gestión remota.',
            'icon' => 'dashicons-smartphone'
        ),
        array(
            'title' => 'Garantía 2 Años',
            'description' => 'Todos los productos AJAX incluyen 2 años de garantía oficial del fabricante.',
            'icon' => 'dashicons-shield'
        ),
        array(
            'title' => 'Soporte 24/7',
            'description' => 'Asistencia técnica disponible las 24 horas. Resolvemos tus dudas cuando las necesites.',
            'icon' => 'dashicons-phone'
        ),
        array(
            'title' => 'Envío Gratis',
            'description' => 'Envío gratuito en pedidos superiores a 100€. Entrega en 24-48 horas en península.',
            'icon' => 'dashicons-car'
        )
    );
    
    /**
     * Constructor
     */
    public function __construct() {
        add_shortcode( 'ajax_posts_carousel', array( $this, 'render_carousel' ) );
        add_action( 'wp_head', array( $this, 'add_styles' ), 100 );
        add_action( 'wp_footer', array( $this, 'add_scripts' ), 100 );
    }
    
    /**
     * Renderizar el carrusel
     */
    public function render_carousel( $atts ) {
        $atts = shortcode_atts( array(
            'title' => '¿Por qué elegir AJAX Systems?',
            'items_visible' => 3,
            'autoplay' => 'true',
            'autoplay_speed' => 5000
        ), $atts, 'ajax_posts_carousel' );
        
        ob_start();
        ?>
        <div class="ajax-benefits-carousel-wrapper" 
             data-items-visible="<?php echo esc_attr( $atts['items_visible'] ); ?>"
             data-autoplay="<?php echo esc_attr( $atts['autoplay'] ); ?>"
             data-autoplay-speed="<?php echo esc_attr( $atts['autoplay_speed'] ); ?>">
            
            <?php if ( ! empty( $atts['title'] ) ) : ?>
                <h2 class="ajax-benefits-title"><?php echo esc_html( $atts['title'] ); ?></h2>
            <?php endif; ?>
            
            <div class="ajax-benefits-carousel">
                <button class="carousel-nav carousel-prev" aria-label="Anterior">
                    <span class="dashicons dashicons-arrow-left-alt2"></span>
                </button>
                
                <div class="carousel-viewport">
                    <div class="carousel-track">
                        <?php foreach ( self::$benefits as $index => $benefit ) : ?>
                            <div class="carousel-item" data-index="<?php echo $index; ?>">
                                <div class="benefit-card">
                                    <div class="benefit-icon">
                                        <span class="dashicons <?php echo esc_attr( $benefit['icon'] ); ?>"></span>
                                    </div>
                                    <h3 class="benefit-title"><?php echo esc_html( $benefit['title'] ); ?></h3>
                                    <p class="benefit-description"><?php echo esc_html( $benefit['description'] ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <button class="carousel-nav carousel-next" aria-label="Siguiente">
                    <span class="dashicons dashicons-arrow-right-alt2"></span>
                </button>
            </div>
            
            <div class="carousel-dots">
                <?php for ( $i = 0; $i < count( self::$benefits ); $i++ ) : ?>
                    <button class="carousel-dot<?php echo $i === 0 ? ' active' : ''; ?>" 
                            data-index="<?php echo $i; ?>" 
                            aria-label="Ir a slide <?php echo $i + 1; ?>"></button>
                <?php endfor; ?>
            </div>
            
            <div class="benefits-summary">
                <p><strong>AJAX Systems</strong> - Líder europeo en sistemas de seguridad inalámbricos</p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Añadir estilos CSS
     */
    public function add_styles() {
        ?>
        <style id="ajax-benefits-carousel-css">
            /* Wrapper principal */
            .ajax-benefits-carousel-wrapper {
                max-width: 1200px;
                margin: 3rem auto;
                padding: 2rem 1rem;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            }
            
            /* Título */
            .ajax-benefits-title {
                text-align: center;
                font-size: 2rem;
                font-weight: 700;
                color: #1a1a1a;
                margin-bottom: 2rem;
            }
            
            /* Contenedor del carrusel */
            .ajax-benefits-carousel {
                position: relative;
                display: flex;
                align-items: center;
                gap: 1rem;
            }
            
            /* Viewport */
            .carousel-viewport {
                overflow: hidden;
                flex: 1;
            }
            
            /* Track */
            .carousel-track {
                display: flex;
                transition: transform 0.4s ease-in-out;
            }
            
            /* Items */
            .carousel-item {
                flex: 0 0 calc(33.333% - 1rem);
                padding: 0.5rem;
                box-sizing: border-box;
            }
            
            /* Tarjeta de beneficio */
            .benefit-card {
                background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
                border-radius: 16px;
                padding: 2rem 1.5rem;
                text-align: center;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                height: 100%;
                min-height: 280px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .benefit-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            }
            
            /* Icono */
            .benefit-icon {
                width: 70px;
                height: 70px;
                background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
            }
            
            .benefit-icon .dashicons {
                font-size: 32px;
                width: 32px;
                height: 32px;
                color: #ffffff;
            }
            
            /* Título del beneficio */
            .benefit-title {
                font-size: 1.25rem;
                font-weight: 600;
                color: #1a1a1a;
                margin: 0 0 1rem 0;
            }
            
            /* Descripción */
            .benefit-description {
                font-size: 0.95rem;
                color: #666;
                line-height: 1.6;
                margin: 0;
                flex-grow: 1;
            }
            
            /* Navegación */
            .carousel-nav {
                background: #e74c3c;
                border: none;
                width: 45px;
                height: 45px;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                flex-shrink: 0;
            }
            
            .carousel-nav:hover {
                background: #c0392b;
                transform: scale(1.1);
            }
            
            .carousel-nav .dashicons {
                font-size: 24px;
                width: 24px;
                height: 24px;
                color: #ffffff;
            }
            
            /* Dots */
            .carousel-dots {
                display: flex;
                justify-content: center;
                gap: 0.5rem;
                margin-top: 1.5rem;
            }
            
            .carousel-dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                border: 2px solid #e74c3c;
                background: transparent;
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 0;
            }
            
            .carousel-dot.active,
            .carousel-dot:hover {
                background: #e74c3c;
            }
            
            /* Resumen */
            .benefits-summary {
                text-align: center;
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px solid #eee;
            }
            
            .benefits-summary p {
                color: #666;
                font-size: 1rem;
                margin: 0;
            }
            
            .benefits-summary strong {
                color: #e74c3c;
            }
            
            /* Responsive: Tablet */
            @media (max-width: 992px) {
                .carousel-item {
                    flex: 0 0 calc(50% - 0.5rem);
                }
            }
            
            /* Responsive: Móvil */
            @media (max-width: 640px) {
                .ajax-benefits-title {
                    font-size: 1.5rem;
                }
                
                .carousel-item {
                    flex: 0 0 100%;
                }
                
                .carousel-nav {
                    width: 38px;
                    height: 38px;
                }
                
                .benefit-card {
                    min-height: 240px;
                    padding: 1.5rem 1rem;
                }
                
                .benefit-icon {
                    width: 60px;
                    height: 60px;
                }
                
                .benefit-icon .dashicons {
                    font-size: 28px;
                    width: 28px;
                    height: 28px;
                }
            }
        </style>
        <?php
    }
    
    /**
     * Añadir scripts JavaScript
     */
    public function add_scripts() {
        ?>
        <script id="ajax-benefits-carousel-js">
        (function() {
            'use strict';
            
            class AjaxBenefitsCarousel {
                constructor(wrapper) {
                    this.wrapper = wrapper;
                    this.track = wrapper.querySelector('.carousel-track');
                    this.items = wrapper.querySelectorAll('.carousel-item');
                    this.dots = wrapper.querySelectorAll('.carousel-dot');
                    this.prevBtn = wrapper.querySelector('.carousel-prev');
                    this.nextBtn = wrapper.querySelector('.carousel-next');
                    
                    this.currentIndex = 0;
                    this.itemsVisible = parseInt(wrapper.dataset.itemsVisible) || 3;
                    this.autoplay = wrapper.dataset.autoplay === 'true';
                    this.autoplaySpeed = parseInt(wrapper.dataset.autoplaySpeed) || 5000;
                    this.autoplayInterval = null;
                    
                    this.init();
                }
                
                init() {
                    this.updateItemsVisible();
                    this.bindEvents();
                    
                    if (this.autoplay) {
                        this.startAutoplay();
                    }
                    
                    window.addEventListener('resize', () => {
                        this.updateItemsVisible();
                        this.goToSlide(this.currentIndex);
                    });
                }
                
                updateItemsVisible() {
                    const width = window.innerWidth;
                    if (width <= 640) {
                        this.itemsVisible = 1;
                    } else if (width <= 992) {
                        this.itemsVisible = 2;
                    } else {
                        this.itemsVisible = parseInt(this.wrapper.dataset.itemsVisible) || 3;
                    }
                }
                
                bindEvents() {
                    this.prevBtn.addEventListener('click', () => this.prev());
                    this.nextBtn.addEventListener('click', () => this.next());
                    
                    this.dots.forEach((dot, index) => {
                        dot.addEventListener('click', () => this.goToSlide(index));
                    });
                    
                    // Pausar autoplay en hover
                    this.wrapper.addEventListener('mouseenter', () => this.stopAutoplay());
                    this.wrapper.addEventListener('mouseleave', () => {
                        if (this.autoplay) this.startAutoplay();
                    });
                    
                    // Touch/Swipe support
                    let touchStartX = 0;
                    let touchEndX = 0;
                    
                    this.track.addEventListener('touchstart', (e) => {
                        touchStartX = e.changedTouches[0].screenX;
                    }, { passive: true });
                    
                    this.track.addEventListener('touchend', (e) => {
                        touchEndX = e.changedTouches[0].screenX;
                        this.handleSwipe(touchStartX, touchEndX);
                    }, { passive: true });
                }
                
                handleSwipe(startX, endX) {
                    const threshold = 50;
                    const diff = startX - endX;
                    
                    if (Math.abs(diff) > threshold) {
                        if (diff > 0) {
                            this.next();
                        } else {
                            this.prev();
                        }
                    }
                }
                
                goToSlide(index) {
                    const maxIndex = this.items.length - this.itemsVisible;
                    this.currentIndex = Math.max(0, Math.min(index, maxIndex));
                    
                    const itemWidth = 100 / this.itemsVisible;
                    const offset = -this.currentIndex * itemWidth;
                    this.track.style.transform = `translateX(${offset}%)`;
                    
                    this.updateDots();
                }
                
                prev() {
                    this.goToSlide(this.currentIndex - 1);
                }
                
                next() {
                    const maxIndex = this.items.length - this.itemsVisible;
                    if (this.currentIndex >= maxIndex) {
                        this.goToSlide(0);
                    } else {
                        this.goToSlide(this.currentIndex + 1);
                    }
                }
                
                updateDots() {
                    this.dots.forEach((dot, index) => {
                        dot.classList.toggle('active', index === this.currentIndex);
                    });
                }
                
                startAutoplay() {
                    this.stopAutoplay();
                    this.autoplayInterval = setInterval(() => this.next(), this.autoplaySpeed);
                }
                
                stopAutoplay() {
                    if (this.autoplayInterval) {
                        clearInterval(this.autoplayInterval);
                        this.autoplayInterval = null;
                    }
                }
            }
            
            // Inicializar cuando el DOM esté listo
            document.addEventListener('DOMContentLoaded', function() {
                const carousels = document.querySelectorAll('.ajax-benefits-carousel-wrapper');
                carousels.forEach(wrapper => new AjaxBenefitsCarousel(wrapper));
            });
        })();
        </script>
        <?php
    }
}

// Inicializar la clase
new Ajax_Posts_Carousel();
