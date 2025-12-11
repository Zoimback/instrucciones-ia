<?php
/**
 * AJAX Carousel Plugin - Versión Corregida para Code Snippets
 * Shortcode: [ajax_posts_carousel]
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Ajax_Posts_Carousel' ) ) {

final class Ajax_Posts_Carousel {
    
    const VERSION = '1.0.0';
    
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
        add_shortcode( 'ajax_posts_carousel', array( $this, 'render_carousel_shortcode' ) );
    }
    
    public function enqueue_assets() {
        wp_enqueue_script( 'jquery' );
        
        wp_add_inline_style( 'wp-block-library', $this->get_carousel_css() );
        wp_add_inline_script( 'jquery', $this->get_carousel_js() );
        
        wp_localize_script( 'jquery', 'ajaxPostsCarousel', array(
            'ajaxUrl'  => esc_url_raw( rest_url( 'ajax-posts-carousel/v1/' ) ),
            'nonce'    => wp_create_nonce( 'wp_rest' ),
            'strings'  => array(
                'loading'   => __( 'Cargando...', 'ajax-posts-carousel' ),
                'error'     => __( 'Error al cargar el contenido', 'ajax-posts-carousel' ),
                'noItems'   => __( 'No hay elementos para mostrar', 'ajax-posts-carousel' ),
            )
        ) );
    }
    
    public function register_rest_routes() {
        register_rest_route( 'ajax-posts-carousel/v1', '/items', array(
            'methods'             => 'GET',
            'callback'            => array( $this, 'get_carousel_items' ),
            'permission_callback' => '__return_true',
            'args'                => array(
                'category' => array(
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field',
                ),
                'posts_per_page' => array(
                    'default'           => 6,
                    'sanitize_callback' => 'absint',
                ),
                'post_type' => array(
                    'default'           => 'post',
                    'sanitize_callback' => 'sanitize_text_field',
                ),
            ),
        ) );
    }
    
    public function get_carousel_items( $request ) {
        $post_type      = $request->get_param( 'post_type' );
        $category       = $request->get_param( 'category' );
        $posts_per_page = $request->get_param( 'posts_per_page' );
        
        $args = array(
            'post_type'      => $post_type,
            'posts_per_page' => $posts_per_page,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        
        if ( ! empty( $category ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $category,
                ),
            );
        }
        
        $query = new WP_Query( $args );
        $items = array();
        
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                
                $post_id = get_the_ID();
                
                $items[] = array(
                    'id'        => $post_id,
                    'title'     => get_the_title(),
                    'excerpt'   => wp_trim_words( get_the_excerpt(), 20 ),
                    'permalink' => get_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url( $post_id, 'medium' ),
                    'date'      => get_the_date(),
                    'author'    => get_the_author(),
                );
            }
            wp_reset_postdata();
        }
        
        return rest_ensure_response( array(
            'success' => true,
            'items'   => $items,
            'total'   => $query->found_posts,
        ) );
    }
    
    public function render_carousel_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'category'       => '',
            'posts_per_page' => 6,
            'post_type'      => 'post',
            'autoplay'       => 'true',
            'autoplay_speed' => 3000,
        ), $atts, 'ajax_posts_carousel' );
        
        $category       = sanitize_text_field( $atts['category'] );
        $posts_per_page = absint( $atts['posts_per_page'] );
        $post_type      = sanitize_text_field( $atts['post_type'] );
        $autoplay       = filter_var( $atts['autoplay'], FILTER_VALIDATE_BOOLEAN );
        $autoplay_speed = absint( $atts['autoplay_speed'] );
        
        $data_attrs = sprintf(
            'data-category="%s" data-posts-per-page="%d" data-post-type="%s" data-autoplay="%s" data-autoplay-speed="%d"',
            esc_attr( $category ),
            esc_attr( $posts_per_page ),
            esc_attr( $post_type ),
            esc_attr( $autoplay ? 'true' : 'false' ),
            esc_attr( $autoplay_speed )
        );
        
        ob_start();
        ?>
        <div class="ajax-posts-carousel-wrapper" <?php echo $data_attrs; ?>>
            <div class="ajax-posts-carousel-loading">
                <div class="ajax-posts-carousel-spinner"></div>
                <p>Cargando carrusel...</p>
            </div>
            
            <div class="ajax-posts-carousel-container" style="display: none;">
                <button class="ajax-posts-carousel-nav ajax-posts-carousel-prev" aria-label="Anterior">
                    <span>&lsaquo;</span>
                </button>
                
                <div class="ajax-posts-carousel-track-wrapper">
                    <div class="ajax-posts-carousel-track">
                    </div>
                </div>
                
                <button class="ajax-posts-carousel-nav ajax-posts-carousel-next" aria-label="Siguiente">
                    <span>&rsaquo;</span>
                </button>
            </div>
            
            <div class="ajax-posts-carousel-dots"></div>
            
            <div class="ajax-posts-carousel-error" style="display: none;">
                <p>Error al cargar el carrusel.</p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    private function get_carousel_css() {
        return '
            :root {
                --posts-carousel-primary: #00aa66;
                --posts-carousel-secondary: #333;
                --posts-carousel-bg: #fff;
                --posts-carousel-border: #e0e0e0;
                --posts-carousel-shadow: rgba(0, 0, 0, 0.1);
                --posts-carousel-transition: 0.3s ease;
                --posts-carousel-spacing: 1rem;
            }
            
            .ajax-posts-carousel-wrapper {
                position: relative;
                width: 100%;
                margin: 2rem auto;
                max-width: 1200px;
            }
            
            .ajax-posts-carousel-loading {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 3rem;
                text-align: center;
            }
            
            .ajax-posts-carousel-spinner {
                width: 50px;
                height: 50px;
                border: 4px solid var(--posts-carousel-border);
                border-top-color: var(--posts-carousel-primary);
                border-radius: 50%;
                animation: posts-carousel-spin 0.8s linear infinite;
            }
            
            @keyframes posts-carousel-spin {
                to { transform: rotate(360deg); }
            }
            
            .ajax-posts-carousel-loading p {
                margin-top: 1rem;
                color: var(--posts-carousel-secondary);
                font-size: 1rem;
            }
            
            .ajax-posts-carousel-container {
                position: relative;
                display: flex;
                align-items: center;
                gap: 1rem;
            }
            
            .ajax-posts-carousel-track-wrapper {
                flex: 1;
                overflow: hidden;
                position: relative;
            }
            
            .ajax-posts-carousel-track {
                display: flex;
                transition: transform var(--posts-carousel-transition);
                will-change: transform;
            }
            
            .ajax-posts-carousel-item {
                flex: 0 0 100%;
                padding: 0 var(--posts-carousel-spacing);
                box-sizing: border-box;
            }
            
            .ajax-posts-carousel-item-inner {
                background: var(--posts-carousel-bg);
                border: 1px solid var(--posts-carousel-border);
                border-radius: 8px;
                overflow: hidden;
                transition: transform var(--posts-carousel-transition), box-shadow var(--posts-carousel-transition);
                height: 100%;
                display: flex;
                flex-direction: column;
            }
            
            .ajax-posts-carousel-item-inner:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 20px var(--posts-carousel-shadow);
            }
            
            .ajax-posts-carousel-item-image {
                position: relative;
                width: 100%;
                padding-top: 66.67%;
                overflow: hidden;
                background: var(--posts-carousel-border);
            }
            
            .ajax-posts-carousel-item-image img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform var(--posts-carousel-transition);
            }
            
            .ajax-posts-carousel-item-inner:hover .ajax-posts-carousel-item-image img {
                transform: scale(1.05);
            }
            
            .ajax-posts-carousel-item-content {
                padding: 1.5rem;
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            
            .ajax-posts-carousel-item-title {
                margin: 0 0 0.75rem 0;
                font-size: 1.25rem;
                line-height: 1.4;
            }
            
            .ajax-posts-carousel-item-title a {
                color: var(--posts-carousel-secondary);
                text-decoration: none;
                transition: color var(--posts-carousel-transition);
            }
            
            .ajax-posts-carousel-item-title a:hover {
                color: var(--posts-carousel-primary);
            }
            
            .ajax-posts-carousel-item-meta {
                display: flex;
                gap: 1rem;
                margin-bottom: 0.75rem;
                font-size: 0.875rem;
                color: #666;
            }
            
            .ajax-posts-carousel-item-excerpt {
                margin: 0 0 1rem 0;
                color: #555;
                line-height: 1.6;
                flex: 1;
            }
            
            .ajax-posts-carousel-item-link {
                display: inline-flex;
                align-items: center;
                color: var(--posts-carousel-primary);
                text-decoration: none;
                font-weight: 600;
                transition: color var(--posts-carousel-transition);
            }
            
            .ajax-posts-carousel-nav {
                position: relative;
                width: 48px;
                height: 48px;
                border: 2px solid var(--posts-carousel-border);
                background: var(--posts-carousel-bg);
                color: var(--posts-carousel-secondary);
                border-radius: 50%;
                cursor: pointer;
                transition: all var(--posts-carousel-transition);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2rem;
                line-height: 1;
                flex-shrink: 0;
            }
            
            .ajax-posts-carousel-nav:hover:not(:disabled) {
                background: var(--posts-carousel-primary);
                color: white;
                border-color: var(--posts-carousel-primary);
                transform: scale(1.1);
            }
            
            .ajax-posts-carousel-nav:disabled {
                opacity: 0.3;
                cursor: not-allowed;
            }
            
            .ajax-posts-carousel-nav:focus {
                outline: 2px solid var(--posts-carousel-primary);
                outline-offset: 2px;
            }
            
            .ajax-posts-carousel-dots {
                display: flex;
                justify-content: center;
                gap: 0.5rem;
                margin-top: 1.5rem;
            }
            
            .ajax-posts-carousel-dot {
                width: 12px;
                height: 12px;
                border: 2px solid var(--posts-carousel-border);
                background: transparent;
                border-radius: 50%;
                cursor: pointer;
                transition: all var(--posts-carousel-transition);
                padding: 0;
            }
            
            .ajax-posts-carousel-dot:hover {
                border-color: var(--posts-carousel-primary);
                transform: scale(1.2);
            }
            
            .ajax-posts-carousel-dot.active {
                background: var(--posts-carousel-primary);
                border-color: var(--posts-carousel-primary);
            }
            
            .ajax-posts-carousel-dot:focus {
                outline: 2px solid var(--posts-carousel-primary);
                outline-offset: 2px;
            }
            
            .ajax-posts-carousel-error {
                padding: 2rem;
                text-align: center;
                color: #c00;
                background: #ffe0e0;
                border: 1px solid #ffb0b0;
                border-radius: 4px;
            }
            
            .ajax-posts-carousel-error p {
                margin: 0;
            }
            
            @media (min-width: 768px) {
                .ajax-posts-carousel-item {
                    flex: 0 0 50%;
                }
                
                .ajax-posts-carousel-item-title {
                    font-size: 1.125rem;
                }
            }
            
            @media (min-width: 1200px) {
                .ajax-posts-carousel-item {
                    flex: 0 0 33.333%;
                }
                
                .ajax-posts-carousel-wrapper {
                    margin: 3rem auto;
                }
            }
        ';
    }
    
    private function get_carousel_js() {
        return "
(function($) {
    'use strict';
    
    class AjaxPostsCarousel {
        constructor(element) {
            this.\$wrapper = $(element);
            this.\$container = this.\$wrapper.find('.ajax-posts-carousel-container');
            this.\$track = this.\$wrapper.find('.ajax-posts-carousel-track');
            this.\$loading = this.\$wrapper.find('.ajax-posts-carousel-loading');
            this.\$error = this.\$wrapper.find('.ajax-posts-carousel-error');
            this.\$dots = this.\$wrapper.find('.ajax-posts-carousel-dots');
            this.\$prevBtn = this.\$wrapper.find('.ajax-posts-carousel-prev');
            this.\$nextBtn = this.\$wrapper.find('.ajax-posts-carousel-next');
            
            this.currentIndex = 0;
            this.items = [];
            this.autoplayTimer = null;
            
            this.config = {
                category: this.\$wrapper.data('category') || '',
                postsPerPage: this.\$wrapper.data('posts-per-page') || 6,
                postType: this.\$wrapper.data('post-type') || 'post',
                autoplay: this.\$wrapper.data('autoplay') === true || this.\$wrapper.data('autoplay') === 'true',
                autoplaySpeed: this.\$wrapper.data('autoplay-speed') || 3000
            };
            
            this.init();
        }
        
        init() {
            this.bindEvents();
            this.loadItems();
        }
        
        bindEvents() {
            this.\$prevBtn.on('click', () => this.prev());
            this.\$nextBtn.on('click', () => this.next());
            
            let touchStartX = 0;
            let touchEndX = 0;
            
            this.\$track.on('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                this.stopAutoplay();
            });
            
            this.\$track.on('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe(touchStartX, touchEndX);
            });
            
            this.\$wrapper.on('mouseenter', () => this.stopAutoplay());
            this.\$wrapper.on('mouseleave', () => {
                if (this.config.autoplay) {
                    this.startAutoplay();
                }
            });
            
            this.\$wrapper.on('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    this.prev();
                } else if (e.key === 'ArrowRight') {
                    this.next();
                }
            });
            
            $(window).on('resize', () => this.updateCarousel());
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
        
        loadItems() {
            this.showLoading();
            
            const params = new URLSearchParams({
                category: this.config.category,
                posts_per_page: this.config.postsPerPage,
                post_type: this.config.postType
            });
            
            fetch(ajaxPostsCarousel.ajaxUrl + 'items?' + params.toString(), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': ajaxPostsCarousel.nonce
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.items && data.items.length > 0) {
                    this.items = data.items;
                    this.renderItems();
                    this.showCarousel();
                    
                    if (this.config.autoplay) {
                        this.startAutoplay();
                    }
                } else {
                    this.showError(ajaxPostsCarousel.strings.noItems);
                }
            })
            .catch(error => {
                console.error('Error loading carousel items:', error);
                this.showError(ajaxPostsCarousel.strings.error);
            });
        }
        
        renderItems() {
            this.\$track.empty();
            
            this.items.forEach((item, index) => {
                const itemEl = this.createItemElement(item, index);
                this.\$track.append(itemEl);
            });
            
            this.createDots();
            this.updateCarousel();
        }
        
        createItemElement(item, index) {
            const thumbnail = item.thumbnail || 'https://via.placeholder.com/400x300?text=Sin+Imagen';
            
            return $('<div class=\"ajax-posts-carousel-item\" data-index=\"' + index + '\">' +
                '<div class=\"ajax-posts-carousel-item-inner\">' +
                    '<div class=\"ajax-posts-carousel-item-image\">' +
                        '<img src=\"' + this.escapeHtml(thumbnail) + '\" alt=\"' + this.escapeHtml(item.title) + '\" loading=\"lazy\">' +
                    '</div>' +
                    '<div class=\"ajax-posts-carousel-item-content\">' +
                        '<h3 class=\"ajax-posts-carousel-item-title\">' +
                            '<a href=\"' + this.escapeHtml(item.permalink) + '\">' + this.escapeHtml(item.title) + '</a>' +
                        '</h3>' +
                        '<div class=\"ajax-posts-carousel-item-meta\">' +
                            '<span class=\"ajax-posts-carousel-item-date\">' + this.escapeHtml(item.date) + '</span>' +
                            '<span class=\"ajax-posts-carousel-item-author\">' + this.escapeHtml(item.author) + '</span>' +
                        '</div>' +
                        '<p class=\"ajax-posts-carousel-item-excerpt\">' + this.escapeHtml(item.excerpt) + '</p>' +
                        '<a href=\"' + this.escapeHtml(item.permalink) + '\" class=\"ajax-posts-carousel-item-link\">Leer más &rarr;</a>' +
                    '</div>' +
                '</div>' +
            '</div>');
        }
        
        createDots() {
            this.\$dots.empty();
            const itemsPerView = this.getItemsPerView();
            const totalSlides = Math.ceil(this.items.length / itemsPerView);
            
            for (let i = 0; i < totalSlides; i++) {
                const dot = $('<button class=\"ajax-posts-carousel-dot\" aria-label=\"Ir a slide ' + (i + 1) + '\"></button>');
                dot.on('click', () => {
                    this.goToSlide(i * itemsPerView);
                });
                this.\$dots.append(dot);
            }
            
            this.updateDots();
        }
        
        updateDots() {
            const currentSlide = Math.floor(this.currentIndex / this.getItemsPerView());
            this.\$dots.find('.ajax-posts-carousel-dot').removeClass('active');
            this.\$dots.find('.ajax-posts-carousel-dot').eq(currentSlide).addClass('active');
        }
        
        getItemsPerView() {
            const width = $(window).width();
            if (width >= 1200) return 3;
            if (width >= 768) return 2;
            return 1;
        }
        
        updateCarousel() {
            const itemsPerView = this.getItemsPerView();
            const itemWidth = 100 / itemsPerView;
            const maxIndex = this.items.length - itemsPerView;
            
            if (this.currentIndex > maxIndex) {
                this.currentIndex = Math.max(0, maxIndex);
            }
            
            const translateX = -(this.currentIndex * itemWidth);
            this.\$track.css('transform', 'translateX(' + translateX + '%)');
            
            this.\$prevBtn.prop('disabled', this.currentIndex === 0);
            this.\$nextBtn.prop('disabled', this.currentIndex >= maxIndex);
            
            this.updateDots();
        }
        
        prev() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
                this.updateCarousel();
                this.resetAutoplay();
            }
        }
        
        next() {
            const itemsPerView = this.getItemsPerView();
            const maxIndex = this.items.length - itemsPerView;
            
            if (this.currentIndex < maxIndex) {
                this.currentIndex++;
                this.updateCarousel();
                this.resetAutoplay();
            } else if (this.config.autoplay) {
                this.currentIndex = 0;
                this.updateCarousel();
            }
        }
        
        goToSlide(index) {
            const itemsPerView = this.getItemsPerView();
            const maxIndex = this.items.length - itemsPerView;
            this.currentIndex = Math.max(0, Math.min(index, maxIndex));
            this.updateCarousel();
            this.resetAutoplay();
        }
        
        startAutoplay() {
            if (this.config.autoplay) {
                this.autoplayTimer = setInterval(() => {
                    this.next();
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
        
        showLoading() {
            this.\$loading.show();
            this.\$container.hide();
            this.\$error.hide();
        }
        
        showCarousel() {
            this.\$loading.hide();
            this.\$container.show();
            this.\$error.hide();
        }
        
        showError(message) {
            this.\$loading.hide();
            this.\$container.hide();
            this.\$error.find('p').text(message);
            this.\$error.show();
        }
        
        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    }
    
    $(document).ready(function() {
        $('.ajax-posts-carousel-wrapper').each(function() {
            new AjaxPostsCarousel(this);
        });
    });
    
})(jQuery);
        ";
    }
}

new Ajax_Posts_Carousel();

}
