---
description: "Conventions and best practices for LRA services on Ether using gRPC and Protocol Buffers."
applyTo: "**/*.php"
---

## PHP (núcleo del desarrollo en WordPress)

### Conceptos clave

WordPress está escrito en PHP: plugins, themes y la mayoría de la lógica se implementa con PHP.

Trabaja con hooks (actions & filters), el API de opciones, $wpdb, shortcodes, widgets, REST API.

Sigue las WordPress Coding Standards (nombres, indentación, sanitización, etc.)

### Buenas prácticas

- Sanitiza y valida TODO lo que venga del usuario (sanitize_text_field, intval, wp_kses_post, etc.).
- Escapa todo lo que imprimas (esc_html, esc_attr, esc_url, wp_kses si permites HTML).
- Usa nonces para formularios/acciones que modifican estado (wp_nonce_field, wp_verify_nonce).
- Prefija nombres de funciones, clases y opciones para evitar colisiones (ej. mi_plugin_).
- No tocar core — usa hooks o filtros; no edites los archivos de WordPress.
- Usa OOP y namespaces en plugins complejos; favorece la separación de responsabilidades.
- Carga sólo lo necesario (lazy load de includes, carga condicional de scripts/styles).
- Internacionalización (i18n): __(), _e(), esc_html__(), textdomain en el plugin/theme.
- Usa WP-CLI para tareas repetitivas y PHPUnit para tests.
- Lleva control de versiones (Git) y revisiones de seguridad antes del deploy.

### Código práctico

#### Registro básico de plugin (header obligatorio)

```php
<?php
/**
 * Plugin Name: Mi Plugin Ejemplo
 * Description: Ejemplo mínimo con buenas prácticas.
 * Version: 1.0.0
 * Text Domain: mi-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // evitar acceso directo
}

final class Mi_Plugin {
    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function init() {
        load_plugin_textdomain( 'mi-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    public function enqueue_scripts() {
        wp_enqueue_script( 'mi-plugin-js', plugin_dir_url( __FILE__ ) . 'build/app.js', ['wp-element'], '1.0.0', true );
        wp_localize_script( 'mi-plugin-js', 'MiPluginData', [
            'nonce' => wp_create_nonce( 'mi_plugin_nonce' ),
            'rest_url' => esc_url_raw( rest_url( 'mi-plugin/v1/' ) ),
        ] );
    }
}

new Mi_Plugin();
```


#### Sanitizar/escapar ejemplo en un formulario

```php
if ( isset( $_POST['mi_submit'] ) && wp_verify_nonce( $_POST['mi_nonce'], 'mi_action' ) ) {
    $name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    // Guardar con update_option o en tabla personalizada
    update_option( 'mi_plugin_name', $name );
}
```

#### Registrar REST route seguro

```php
add_action( 'rest_api_init', function() {
    register_rest_route( 'mi-plugin/v1', '/item/', [
        'methods' => 'POST',
        'callback' => 'mi_plugin_create_item',
        'permission_callback' => function() {
            return current_user_can( 'edit_posts' );
        }
    ] );
});

function mi_plugin_create_item( WP_REST_Request $request ) {
    $nonce = $request->get_header( 'X-WP-Nonce' );
    if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
        return new WP_Error( 'rest_forbidden', 'Nonce inválido', [ 'status' => 403 ] );
    }
    $data = sanitize_text_field( $request->get_param( 'data' ) );
    // procesar y responder
    return rest_ensure_response( [ 'ok' => true ] );
}
```

### Checklist PHP antes de publicar

- [ ] Todas las entradas del usuario sanitizadas.
- [ ] Todas las salidas escapadas.
- [ ] Nonces en formularios/acciones.
- [ ] Prefijos en funciones/acciones/filers y textdomain.
- [ ] WP Coding Standards (usa phpcs + wpcs).
- [ ] Tests unitarios básicos si la lógica es crítica.
- [ ] Revisado para inyecciones SQL: usa $wpdb->prepare si consultas personalizadas.
- [ ] Cargas condicionales (scripts, includes).
- [ ] Documentación y readme.

### Herramientas recomendadas

- phpcs + WordPress Coding Standards
- WP-CLI
- PHPUnit (para tests)
- Composer (para autoload en plugins avanzados)
- Debug: WP_DEBUG, Query Monitor plugin