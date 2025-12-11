---
description: "Conventions and best practices for LRA services on Ether using gRPC and Protocol Buffers."
applyTo: "**/*.java, **/*.js"
---

## JavaScript (incluye Gutenberg / React)

### Conceptos clave

- WP moderno usa JS para el editor Gutenberg (React) y para interacción frontend.
- Usa los paquetes oficiales @wordpress/* cuando trabajes con bloques.
- Se recomienda compilar ESNext con Babel + webpack / @wordpress/scripts.

### Buenas prácticas

- Enqueúa scripts correctamente con wp_enqueue_script() y declara dependencias (wp-element, wp-i18n, wp-api, etc.).
- No mezcles React global: usa las dependencias de WP (wp.element) en lugar de empacar React si no es necesario.
- Protege llamadas REST con nonces y capability checks en el servidor.
- Separación de responsabilidad: lógica del DOM vs estado; usa componentes.
- Usa ES Modules y build step (transpilar con Babel / webpack o @wordpress/scripts).
- Internacionalización JS: usa wp-i18n (__, sprintf), y wp_set_script_translations().
- Evita acceder al DOM directamente cuando uses React/Gutenberg.
- Usa fetch o wp.apiFetch para llamadas a la REST API.
- Minifica y versiona para cache busting.

### Código práctico

#### Enqueue con localize y dependencia

```php
function mi_plugin_enqueue_js() {
    wp_enqueue_script(
        'mi-plugin-app',
        plugin_dir_url( __FILE__ ) . 'build/app.js',
        ['wp-element', 'wp-api-fetch'],
        filemtime( plugin_dir_path( __FILE__ ) . 'build/app.js' ),
        true
    );

    wp_set_script_translations( 'mi-plugin-app', 'mi-plugin', plugin_dir_path( __FILE__ ) . 'languages' );

    wp_localize_script( 'mi-plugin-app', 'MiPlugin', [
        'nonce' => wp_create_nonce( 'wp_rest' ),
        'rest_url' => esc_url_raw( rest_url( 'mi-plugin/v1' ) )
    ] );
}
add_action( 'wp_enqueue_scripts', 'mi_plugin_enqueue_js' );
```

#### Ejemplo básico de fetch con wp.apiFetch

```javascript
import apiFetch from '@wordpress/api-fetch';

apiFetch({
    path: '/mi-plugin/v1/item',
    method: 'POST',
    data: { foo: 'bar' }
}).then( res => {
    console.log( res );
}).catch( err => {
    console.error( err );
});
```


#### Gutenberg: registrar bloque con @wordpress/scripts (index.js)

```javascript
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';

registerBlockType( 'mi-plugin/mi-bloque', {
    title: __( 'Mi Bloque', 'mi-plugin' ),
    icon: 'smiley',
    category: 'widgets',
    edit: ( { attributes, setAttributes } ) => (
        <div>
            <RichText
                tagName="p"
                value={ attributes.content }
                onChange={ content => setAttributes({ content }) }
            />
        </div>
    ),
    save: ( { attributes } ) => (
        <RichText.Content tagName="p" value={ attributes.content } />
    ),
} );
```

### Checklist JS antes de publicar

- [ ] Scripts encolados con dependencias y versiones.
- [ ] No exponer secretos; usar nonces y capability checks.
- [ ] Transpilar & minificar para producción.
- [ ] Traducciones JS con wp_set_script_translations.
- [ ] Evitar manipulación directa del DOM si usas React.
- [ ] Tests (jest) para lógica crítica.
- [ ] Revisión de performance (bundle size).

### Herramientas recomendadas

- @wordpress/scripts (simplifica build)
- webpack + Babel (si config propia)
- apiFetch (wp-api-fetch)
- eslint (config de WP si existe)
- jest (tests)
- bundle analyzer