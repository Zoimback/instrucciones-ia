---
description: "Conventions and best practices for LRA services on Ether using gRPC and Protocol Buffers."
applyTo: "**/*.css"
---

## CSS (estilos y rendimiento)

### Conceptos clave

- WordPress permite estilos frontend y admin/editor (add_editor_style o theme.json, enqueue).
- Para Gutenberg usar editor-style y theme.json para bloques.
- Gestión de CSS: preprocesadores (Sass), metodologías (BEM, ITCSS), variables CSS.

### Buenas prácticas

- Encolar CSS via wp_enqueue_style() (no inline en la medida de lo posible).
- theme.json: si tu tema apunta a WP moderno, configura colores, tipografías y presets ahí (simplifica compatibilidad con bloques).
- Metodología: usa BEM o ITCSS para mantener escalabilidad y evitar colisiones.
- No abuses de !important.
- Variables CSS para tokens de diseño (colores, espaciados).
- Critical CSS: considera inline el CSS crítico y lazy-load del resto.
- Optimiza assets: minificación, concatenación, purgecss para eliminar CSS no usado.
- Responsive first: usa mobile-first y media queries incrementales.
- Accesibilidad visual: contraste, foco visible, tamaños legibles.
- Editor styles: sincroniza estilos editor/frontend para WYSIWYG en Gutenberg.

### Código práctico

#### Enqueue CSS en tema o plugin

```php
function mi_theme_enqueue_styles() {
    wp_enqueue_style( 'mi-theme-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'mi_theme_enqueue_styles' );
```

#### Ejemplo BEM y variables

```css
:root {
  --brand: #0a6;
  --space-1: 0.5rem;
  --space-2: 1rem;
}

.card { 
  border-radius: 0.5rem;
  padding: var(--space-2);
}
.card__title {
  font-size: 1.125rem;
}
```

#### Uso de theme.json (fragmento)

```json
{
  "version": 2,
  "settings": {
    "color": {
      "palette": [
        { "name": "Primary", "slug": "primary", "color": "#0a6" }
      ]
    },
    "typography": {
      "fontSizes": [
        { "name": "Small", "size": 12, "slug": "small" }
      ]
    }
  }
}
```

### Checklist CSS antes de publicar

- [ ] Estilos encolados, no inline.
- [ ] CSS crítico identificado y cargado eficientemente.
- [ ] Uso de variables y una metodología (BEM/ITCSS).
- [ ] Responsive checks (breakpoints).
- [ ] Accessible focus, contrast, font sizes.
- [ ] Minificación y eliminación de CSS muerto.
- [ ] Editor styles para bloques si aplica.

### Herramientas recomendadas

- Sass, PostCSS (autoprefixer)
- PurgeCSS / purgecss + PostCSS
- CSSNano o similar para minificar
- Lighthouse / PageSpeed / WebPageTest
- stylelint