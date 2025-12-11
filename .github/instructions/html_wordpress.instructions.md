---
description: "Conventions and best practices for LRA services on Ether using gRPC and Protocol Buffers."
applyTo: "**/*.html"
---

## HTML (estructura y templates en WP)

### Conceptos clave

- Templates siguen la template hierarchy (index.php, single.php, page.php, archive.php).
- Usa template parts (get_template_part()) para reusar markup.
- Emplea funciones de plantilla: the_title(), the_content(), get_template_part(), wp_head(), wp_footer().

### Buenas prácticas

- Semántica: usa etiquetas HTML5 (header, main, article, nav, footer).
- Escapar todo: esc_html( get_the_title() ), wp_kses_post( get_the_content() ).
- Accesibilidad (a11y): roles ARIA cuando haga falta, skip to content, alt en imágenes, labels en formularios.
- Evita duplicar contenido — usa get_template_part() y partials.
- Carga condicional: sólo renderiza lo necesario.
- Cuidado con el HTML generado por plugins — usa wp_kses para limpiar si lo vas a mostrar.

### Código práctico

#### Estructura básica de single.php

<?php get_header(); ?>
<main id="main" role="main">
    <?php
    while ( have_posts() ) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-labelledby="post-title-<?php the_ID(); ?>">
            <header class="entry-header">
                <h1 id="post-title-<?php the_ID(); ?>"><?php echo esc_html( get_the_title() ); ?></h1>
            </header>
            <div class="entry-content">
                <?php the_content(); // WP ya aplica filtros; si se muestra raw use wp_kses_post() ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>
<?php get_footer(); ?>

### Checklist HTML antes de publicar

- [ ] Uso de etiquetas semánticas.
- [ ] Títulos y landmarks para navegación a11y.
- [ ] alt en todas las imágenes.
- [ ] Evitar HTML inline innecesario; preferir clases.
- [ ] Evitar imprimir HTML sin escape.
- [ ] Validación rápida (W3C) si hay tiempo.