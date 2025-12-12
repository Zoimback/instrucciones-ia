<?php
/**
 * AJAX Systems Benefits Carousel - Carrusel Estático de Beneficios
 * Shortcode: [ajax_posts_carousel]
 * Version: 2.0.1 - CORREGIDO
 * 
 * CHANGELOG:
 * - v2.0.1: Fixed quote escaping in line 517 (createDots method)
 * - Changed: var dot = $("<button class='ajax-benefits-dot' ...>"); 
 * - To: var dot = $('<button class="ajax-benefits-dot" ...>');
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Ajax_Posts_Carousel' ) ) {

final class Ajax_Posts_Carousel {
    
    const VERSION = '2.0.1';
    
    private static $instance = null;
    
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_shortcode( 'ajax_posts_carousel', array( $this, 'render_carousel_shortcode' ) );
    }
    
    public function enqueue_assets() {
        wp_enqueue_script( 'jquery' );
        
        wp_add_inline_style( 'wp-block-library', $this->get_carousel_css() );
        wp_add_inline_script( 'jquery', $this->get_carousel_js() );
    }
    
    private function get_static_benefits() {
        return array(
            array(
                'number' => '1',
                'title'  => 'Seguridad profesional sin cuotas',
                'content' => 'Ajax ofrece tecnología que compite con las alarmas de empresas tradicionales, pero sin contratos ni mensualidades. Paga una vez y es tuya para siempre.'
            ),
            array(
                'number' => '2',
                'title'  => 'Control total desde tu móvil',
                'content' => 'Armado, desarmado, alertas, eventos, historial, cámaras opcionales… Todo desde una App rápida y encriptada. Tu móvil se convierte en tu central de seguridad.'
            ),
            array(
                'number' => '3',
                'title'  => 'Privacidad al 100 %',
                'content' => 'A diferencia de otras compañías, Ajax no almacena tus datos, tus códigos ni tus imágenes. Todo se queda en tu casa y en tu teléfono.'
            ),
            array(
                'number' => '4',
                'title'  => 'Tecnología europea premiada',
                'content' => 'Fabricado en Europa, Ajax es uno de los sistemas de seguridad más galardonados del continente por su fiabilidad, diseño, alcance inalámbrico y estabilidad.'
            ),
            array(
                'number' => '5',
                'title'  => 'Sensores precisos, rápidos y sin cables',
                'content' => 'Detección de movimiento, apertura, humo, rotura de cristal, inundación, cámaras, sirenas… Todo inalámbrico y con batería de larga duración.'
            ),
            array(
                'number' => '6',
                'title'  => 'Alertas instantáneas y fiables',
                'content' => 'La comunicación encriptada y los canales múltiples permiten recibir avisos en tu móvil más rápido que muchas centrales tradicionales.'
            ),
            array(
                'number' => '7',
                'title'  => 'Instalación rápida y sin obras',
                'content' => 'Se instala en minutos, sin cables, sin taladros (en la mayoría de casos) y sin necesidad de técnicos.'
            ),
        );
    }
    
    public function render_carousel_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'autoplay'       => 'true',
            'autoplay_speed' => 5000,
        ), $atts, 'ajax_posts_carousel' );
        
        $autoplay       = filter_var( $atts['autoplay'], FILTER_VALIDATE_BOOLEAN );
        $autoplay_speed = absint( $atts['autoplay_speed'] );
        
        $benefits = $this->get_static_benefits();
        
        $data_attrs = sprintf(
            'data-autoplay="%s" data-autoplay-speed="%d"',
            esc_attr( $autoplay ? 'true' : 'false' ),
            esc_attr( $autoplay_speed )
        );
        
        ob_start();
        ?>
        <div class="ajax-benefits-carousel-wrapper" <?php echo $data_attrs; ?>>
            <h2 class="ajax-benefits-title">¿Por qué elegir AJAX Systems para proteger tu hogar?</h2>
            
            <div class="ajax-benefits-carousel-container">
                <button class="ajax-benefits-nav ajax-benefits-prev" aria-label="Anterior">
                    <span>&lsaquo;</span>
                </button>
                
                <div class="ajax-benefits-track-wrapper">
                    <div class="ajax-benefits-track">
                        <?php foreach ( $benefits as $benefit ) : ?>
                            <div class="ajax-benefits-item">
                                <div class="ajax-benefits-item-inner">
                                    <div class="ajax-benefits-number"><?php echo esc_html( $benefit['number'] ); ?></div>
                                    <h3 class="ajax-benefits-item-title"><?php echo esc_html( $benefit['title'] ); ?></h3>
                                    <p class="ajax-benefits-item-content"><?php echo esc_html( $benefit['content'] ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <button class="ajax-benefits-nav ajax-benefits-next" aria-label="Siguiente">
                    <span>&rsaquo;</span>
                </button>
            </div>
            
            <div class="ajax-benefits-dots"></div>
            
            <div class="ajax-benefits-summary">
                <h3>En resumen</h3>
                <p>Ajax es la mejor opción si buscas seguridad profesional, sin cuotas, con control total desde tu smartphone. Y todo con un coste menor que el de un móvil nuevo.</p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    private function get_carousel_css() {
        return <<<'CSS'
:root {
    --ajax-benefits-primary: #00aa66;
    --ajax-benefits-secondary: #333;
    --ajax-benefits-bg: #fff;
    --ajax-benefits-border: #e0e0e0;
    --ajax-benefits-shadow: rgba(0, 0, 0, 0.1);
    --ajax-benefits-transition: 400ms ease-in-out;
    --ajax-benefits-spacing: 1.5rem;
    --ajax-benefits-item-width: 100;
}

.ajax-benefits-carousel-wrapper {
    position: relative;
    width: 100%;
    margin: 0;
    padding: 3rem 2rem;
    background: #000000;
}

.ajax-benefits-title {
    text-align: center;
    color: #ffffff;
    font-size: 2.5rem;
    margin: 0 auto 3rem auto;
    max-width: 1400px;
    font-weight: 700;
    line-height: 1.2;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.ajax-benefits-carousel-container {
    position: relative;
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 0 auto 2rem auto;
    max-width: 900px;
}

.ajax-benefits-track-wrapper {
    flex: 1;
    overflow: hidden;
    position: relative;
    min-height: 320px;
}

.ajax-benefits-track {
    display: flex;
    transition: transform 400ms ease-in-out;
    will-change: transform;
    height: 100%;
}

.ajax-benefits-item {
    flex: 0 0 100%;
    padding: 0 var(--ajax-benefits-spacing);
    box-sizing: border-box;
    height: 100%;
}

.ajax-benefits-item-inner {
    background: var(--ajax-benefits-bg);
    border: 2px solid var(--ajax-benefits-primary);
    border-radius: 12px;
    padding: 2.5rem;
    height: 100%;
    min-height: 350px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all var(--ajax-benefits-transition);
    position: relative;
    overflow: hidden;
}

.ajax-benefits-item-inner::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--ajax-benefits-primary) 0%, #00dd88 100%);
}

.ajax-benefits-item-inner:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px var(--ajax-benefits-shadow);
    border-color: #00dd88;
}

.ajax-benefits-number {
    position: absolute;
    top: -15px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--ajax-benefits-primary) 0%, #00dd88 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(0, 170, 102, 0.4);
}

.ajax-benefits-item-title {
    margin: 0 0 1rem 0;
    font-size: 1.5rem;
    line-height: 1.3;
    color: var(--ajax-benefits-secondary);
    font-weight: 700;
    padding-right: 60px;
}

.ajax-benefits-item-content {
    margin: 0;
    color: #555;
    line-height: 1.7;
    font-size: 1.05rem;
    flex: 1;
}

.ajax-benefits-nav {
    position: relative;
    width: 56px;
    height: 56px;
    border: 3px solid var(--ajax-benefits-primary);
    background: rgba(0, 170, 102, 0.1);
    color: var(--ajax-benefits-primary);
    border-radius: 50%;
    cursor: pointer;
    transition: all var(--ajax-benefits-transition);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    line-height: 1;
    flex-shrink: 0;
    backdrop-filter: blur(10px);
}

.ajax-benefits-nav:hover:not(:disabled) {
    background: var(--ajax-benefits-primary);
    color: white;
    border-color: #00dd88;
    transform: scale(1.15);
    box-shadow: 0 6px 20px rgba(0, 170, 102, 0.4);
}

.ajax-benefits-nav:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

.ajax-benefits-nav:focus {
    outline: 3px solid var(--ajax-benefits-primary);
    outline-offset: 3px;
}

.ajax-benefits-dots {
    display: flex;
    justify-content: center;
    gap: 0.75rem;
    margin: 2rem auto;
    max-width: 1400px;
}

.ajax-benefits-dot {
    width: 14px;
    height: 14px;
    border: 2px solid rgba(0, 170, 102, 0.5);
    background: transparent;
    border-radius: 50%;
    cursor: pointer;
    transition: all var(--ajax-benefits-transition);
    padding: 0;
}

.ajax-benefits-dot:hover {
    border-color: var(--ajax-benefits-primary);
    background: rgba(0, 170, 102, 0.3);
    transform: scale(1.3);
}

.ajax-benefits-dot.active {
    background: var(--ajax-benefits-primary);
    border-color: var(--ajax-benefits-primary);
    box-shadow: 0 0 12px rgba(0, 170, 102, 0.6);
}

.ajax-benefits-dot:focus {
    outline: 2px solid var(--ajax-benefits-primary);
    outline-offset: 3px;
}

.ajax-benefits-summary {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(0, 170, 102, 0.3);
    border-radius: 12px;
    padding: 2rem;
    margin: 3rem auto 0 auto;
    max-width: 900px;
    text-align: center;
}

.ajax-benefits-summary h3 {
    color: var(--ajax-benefits-primary);
    font-size: 1.8rem;
    margin: 0 0 1rem 0;
    font-weight: 700;
}

.ajax-benefits-summary p {
    color: #e0e0e0;
    font-size: 1.15rem;
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 768px) {
    .ajax-benefits-carousel-wrapper {
        padding: 2rem 1rem;
    }
    
    .ajax-benefits-title {
        font-size: 1.75rem;
    }
    
    .ajax-benefits-track-wrapper {
        min-height: 280px;
    }
    
    .ajax-benefits-item-inner {
        padding: 2rem 1.5rem;
    }
    
    .ajax-benefits-item-title {
        font-size: 1.25rem;
    }
    
    .ajax-benefits-item-content {
        font-size: 1rem;
    }
    
    .ajax-benefits-nav {
        width: 48px;
        height: 48px;
        font-size: 2rem;
    }
    
    .ajax-benefits-number {
        width: 45px;
        height: 45px;
        font-size: 1.3rem;
        top: -12px;
        right: 15px;
    }
    
    .ajax-benefits-summary {
        padding: 1.5rem;
    }
    
    .ajax-benefits-summary h3 {
        font-size: 1.5rem;
    }
    
    .ajax-benefits-summary p {
        font-size: 1rem;
    }
}

@media (min-width: 768px) {
    .ajax-benefits-item {
        flex: 0 0 100%;
    }
}

@media (min-width: 1200px) {
    .ajax-benefits-item {
        flex: 0 0 100%;
    }
}
CSS;
    }
    
    private function get_carousel_js() {
        return <<<'JAVASCRIPT'
(function($) {
    'use strict';
    
    class AjaxBenefitsCarousel {
        constructor(element) {
            this.$wrapper = $(element);
            this.$container = this.$wrapper.find('.ajax-benefits-carousel-container');
            this.$track = this.$wrapper.find('.ajax-benefits-track');
            this.$dots = this.$wrapper.find('.ajax-benefits-dots');
            this.$prevBtn = this.$wrapper.find('.ajax-benefits-prev');
            this.$nextBtn = this.$wrapper.find('.ajax-benefits-next');
            
            if (this.$wrapper.length === 0 || this.$track.length === 0) {
                console.error('Ajax Benefits Carousel: Required elements not found');
                return;
            }
            
            this.currentIndex = 0;
            this.totalItems = this.$track.find('.ajax-benefits-item').length;
            this.autoplayTimer = null;
            
            this.config = {
                autoplay: this.$wrapper.data('autoplay') === true || this.$wrapper.data('autoplay') === 'true',
                autoplaySpeed: this.$wrapper.data('autoplay-speed') || 8000
            };
            
            this.init();
        }
        
        init() {
            this.bindEvents();
            this.createDots();
            this.updateCarousel();
            
            if (this.config.autoplay) {
                this.startAutoplay();
            }
            this.$wrapper.attr('tabindex', '0');
        }
        
        bindEvents() {
            var self = this;
            
            this.$prevBtn.on('click', function() { self.prev(); });
            this.$nextBtn.on('click', function() { self.next(); });
            
            var touchStartX = 0;
            var touchEndX = 0;
            
            this.$track.on('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                self.stopAutoplay();
            });
            
            this.$track.on('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                self.handleSwipe(touchStartX, touchEndX);
            });
            
            this.$wrapper.on('mouseenter', function() { self.stopAutoplay(); });
            this.$wrapper.on('mouseleave', function() {
                if (self.config.autoplay) {
                    self.startAutoplay();
                }
            });
            
            this.$wrapper.on('keydown', function(e) {
                if (e.key === 'ArrowLeft' || e.keyCode === 37) {
                    self.prev();
                } else if (e.key === 'ArrowRight' || e.keyCode === 39) {
                    self.next();
                }
            });
            
            $(window).on('resize', function() { self.updateCarousel(); });
        }
        
        handleSwipe(startX, endX) {
            const diff = startX - endX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    this.next();
                } else {
                    this.prev();
                }
            }
        }
        
        createDots() {
            var self = this;
            this.$dots.empty();
            var itemsPerView = this.getItemsPerView();
            var totalSlides = Math.ceil(this.totalItems / itemsPerView);
            
            for (var i = 0; i < totalSlides; i++) {
                (function(index) {
                    var dot = $('<button class="ajax-benefits-dot" aria-label="Ir a slide ' + (index + 1) + '"></button>');
                    dot.on('click', function() {
                        self.goToSlide(index * itemsPerView);
                    });
                    self.$dots.append(dot);
                })(i);
            }
            
            this.updateDots();
        }
        
        updateDots() {
            var currentSlide = Math.floor(this.currentIndex / this.getItemsPerView());
            this.$dots.find('.ajax-benefits-dot').removeClass('active');
            this.$dots.find('.ajax-benefits-dot').eq(currentSlide).addClass('active');
        }
        
        getItemsPerView() {
            return 1;
        }
        
        updateCarousel() {
            var itemsPerView = this.getItemsPerView();
            var itemWidth = 100;
            var maxIndex = this.totalItems - itemsPerView;
            
            if (this.currentIndex > maxIndex) {
                this.currentIndex = Math.max(0, maxIndex);
            }
            
            var translateX = -(this.currentIndex * itemWidth);
            this.$track.css('transform', 'translateX(' + translateX + '%)');
            this.$prevBtn.prop('disabled', false);
            this.$nextBtn.prop('disabled', false);
            
            this.updateDots();
        }
        
        prev() {
            var itemsPerView = this.getItemsPerView();
            var maxIndex = this.totalItems - itemsPerView;
            if (this.currentIndex > 0) {
                this.currentIndex--;
            } else {
                this.currentIndex = maxIndex;
            }
            this.updateCarousel();
            this.resetAutoplay();
        }
        
        next() {
            var itemsPerView = this.getItemsPerView();
            var maxIndex = this.totalItems - itemsPerView;
            
            if (this.currentIndex < maxIndex) {
                this.currentIndex++;
            } else {
                this.currentIndex = 0;
            }
            this.updateCarousel();
            this.resetAutoplay();
        }
        
        goToSlide(index) {
            var itemsPerView = this.getItemsPerView();
            var maxIndex = this.totalItems - itemsPerView;
            this.currentIndex = Math.max(0, Math.min(index, maxIndex));
            this.updateCarousel();
            this.resetAutoplay();
        }
        
        startAutoplay() {
            var self = this;
            if (this.config.autoplay) {
                this.autoplayTimer = setInterval(function() {
                    self.next();
                }, this.config.autoplaySpeed);
            }
        }
        
        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        }
        
        resetAutoplay() {
            this.stopAutoplay();
            if (this.config.autoplay) {
                this.startAutoplay();
            }
        }
    }
    
    $(document).ready(function() {
        $('.ajax-benefits-carousel-wrapper').each(function() {
            new AjaxBenefitsCarousel(this);
        });
    });
    
})(jQuery);
JAVASCRIPT;
    }
}

// Inicializar el carrusel usando el patrón Singleton
add_action( 'plugins_loaded', function() {
    Ajax_Posts_Carousel::get_instance();
} );

}
