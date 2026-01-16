<?php
/**
 * Snippet: Estilos CSS para Tabla Comparativa
 * 
 * Estilos profesionales para la tabla comparativa de Ajax vs Alarmas con cuotas
 * en la página principal
 * 
 * Etiquetas: css, tabla, comparativa, estilos
 */

add_action('wp_head', function() {
?>
<style>
/* Estilos para la tabla comparativa - Integrado con el diseño oscuro del sitio */
.wp-block-table table,
table.comparison-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 40px 0;
    background: #f5f5f5; /* Fondo claro para mejor legibilidad */
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 2px solid #ddd;
}

/* Encabezado de la tabla */
.wp-block-table thead th,
table.comparison-table thead th {
    background: linear-gradient(135deg, #5ae4aa 0%, #3dc98a 100%);
    color: #000000;
    padding: 20px 15px;
    font-weight: 700;
    font-size: 15px;
    text-align: center;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Primera columna (características) */
.wp-block-table tbody th,
.wp-block-table tbody td:first-child,
table.comparison-table tbody th,
table.comparison-table tbody td:first-child {
    background: #eef7f2; /* Columna de características más clara */
    font-weight: 600;
    color: #1a1a1a;
    text-align: left;
    padding: 18px 20px;
    border-right: 2px solid #ddd;
}

/* Celdas de contenido */
.wp-block-table tbody td,
table.comparison-table tbody td {
    padding: 18px 15px;
    text-align: center;
    border-bottom: 1px solid #e6e6e6;
    color: #222; /* Texto oscuro sobre fondo claro */
    font-size: 15px;
    vertical-align: middle;
    background: #ffffff; /* Celdas con fondo blanco */
}

/* Filas alternas */
.wp-block-table tbody tr:nth-child(even) td:not(:first-child),
table.comparison-table tbody tr:nth-child(even) td:not(:first-child) {
    background: #f9fafb; /* Filas alternas claras */
}

.wp-block-table tbody tr:nth-child(odd) td:not(:first-child),
table.comparison-table tbody tr:nth-child(odd) td:not(:first-child) {
    background: #ffffff;
}

/* Efecto hover en filas */
.wp-block-table tbody tr:hover td,
table.comparison-table tbody tr:hover td {
    background: #eef7f2 !important; /* Hover suave y claro */
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(90, 228, 170, 0.15);
}

.wp-block-table tbody tr:hover td:first-child,
table.comparison-table tbody tr:hover td:first-child {
    background: #e3f3ea !important;
}

/* Símbolos de check - Verde brillante */
.wp-block-table tbody td:has(span:contains('✔')),
.wp-block-table tbody td > *:contains('✔'),
table.comparison-table tbody td:has(span:contains('✔')),
table.comparison-table tbody td > *:contains('✔') {
    color: #5ae4aa !important;
    font-weight: 700;
    font-size: 20px;
}

/* Símbolos de cross - Rojo */
.wp-block-table tbody td:has(span:contains('✘')),
.wp-block-table tbody td > *:contains('✘'),
table.comparison-table tbody td:has(span:contains('✘')),
table.comparison-table tbody td > *:contains('✘') {
    color: #f44336 !important;
    font-weight: 700;
    font-size: 20px;
}

/* Estilo para valores numéricos y texto especial */
.wp-block-table tbody td strong,
table.comparison-table tbody td strong {
    color: #00aa66; /* Mantener acento en tono verde */
    font-weight: 700;
}

/* Última fila sin borde inferior */
.wp-block-table tbody tr:last-child td,
table.comparison-table tbody tr:last-child td {
    border-bottom: none;
}

/* Mejorar legibilidad de texto en celdas */
.wp-block-table tbody td,
.wp-block-table tbody th,
table.comparison-table tbody td,
table.comparison-table tbody th {
    line-height: 1.6;
}

/* Responsive para móviles */
@media (max-width: 768px) {
    .wp-block-table,
    table.comparison-table {
        font-size: 13px;
    }
    
    .wp-block-table thead th,
    table.comparison-table thead th {
        padding: 15px 8px;
        font-size: 13px;
    }
    
    .wp-block-table tbody th,
    .wp-block-table tbody td,
    table.comparison-table tbody th,
    table.comparison-table tbody td {
        padding: 12px 8px;
        font-size: 13px;
    }
}

/* Contenedor de tabla para mejor presentación */
.wp-block-table {
    margin: 40px auto;
    max-width: 100%;
    overflow-x: auto;
}

/* Sombra adicional para destacar */
.wp-block-table:hover,
table.comparison-table:hover {
    box-shadow: 0 6px 30px rgba(90, 228, 170, 0.12);
    transition: box-shadow 0.3s ease;
}
</style>
<?php
});
