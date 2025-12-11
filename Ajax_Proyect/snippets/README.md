# Code Snippets - Cómo Exportarlos

## ⚠️ Importante

El plugin **Code Snippets** no expone sus fragmentos de código a través de la REST API de WordPress, por lo que **NO es posible** extraerlos automáticamente desde herramientas externas.

## 📝 Fragmentos Conocidos

Basándonos en el contenido del sitio, sabemos que existe al menos:

1. **AJAX Posts Carousel** - Carrusel de posts con carga AJAX
   - Mencionado en la página "Prueba Carrusel AJAX"
   - Necesita activarse desde Snippets para funcionar
   - Incluye HTML, CSS y JavaScript para el carrusel

2. **Ajax Benefits Cards** - Tarjetas de beneficios
   - Shortcode: `[ajax_benefits]`
   - Página de prueba: "Prueba Tarjetas AJAX Benefits"

## 🔧 Cómo Exportar Manualmente los Snippets

### Opción 1: Desde el Panel de WordPress (Recomendado)

1. Accede al panel de administración de WordPress
2. Ve a **Snippets** en el menú lateral
3. Haz clic en **Exportar** (Export)
4. Selecciona los snippets que quieres exportar (o todos)
5. Haz clic en **Descargar archivo de exportación**
6. Guarda el archivo JSON generado

### Opción 2: Desde la Base de Datos

Los snippets se almacenan en la tabla `wp_snippets` de la base de datos MySQL.

```sql
-- Ver todos los snippets
SELECT * FROM wp_snippets;

-- Exportar snippets específicos
SELECT 
    id,
    name,
    description,
    code,
    tags,
    scope,
    priority,
    active
FROM wp_snippets 
WHERE active = 1;
```

**Acceso a base de datos**:
- Host: localhost (o el proporcionado por Hostinger)
- Base de datos: nombre de tu BD de WordPress
- Usuario: usuario de BD de WordPress
- Contraseña: contraseña de BD

Puedes acceder vía:
- **phpMyAdmin** desde el panel de Hostinger
- **MySQL Workbench** localmente
- **Terminal** con `mysql` CLI

### Opción 3: Via FTP/SFTP

Si tienes acceso al servidor, puedes hacer un backup de toda la instalación:

```bash
# Carpetas importantes a respaldar
/wp-content/plugins/code-snippets/
/wp-content/uploads/
```

## 📦 Formato de Exportación

El plugin Code Snippets exporta en formato JSON similar a este:

```json
{
  "generator": "Code Snippets",
  "date_created": "2025-12-11",
  "snippets": [
    {
      "id": 1,
      "name": "AJAX Posts Carousel",
      "description": "Carrusel de posts con carga AJAX",
      "code": "...",
      "tags": ["ajax", "carousel"],
      "scope": "global",
      "priority": 10,
      "active": true
    }
  ]
}
```

## 🔄 Cómo Importar Snippets

Una vez exportados:

1. Ve a **Snippets → Importar**
2. Sube el archivo JSON
3. Selecciona qué snippets importar
4. Verifica que se activen correctamente

## 🌐 Acceso al Panel de WordPress

**URL de administración**: <https://desarrollo.laalarmainteligente.es/wp-admin/>

**Credenciales**: (solicitar al administrador)

## 💡 Alternativa: Recrear desde Cero

Si no puedes exportar, podrías recrear los snippets conocidos:

### AJAX Posts Carousel

Este snippet probablemente incluye:

- **HTML**: Estructura del carrusel y wrapper
- **CSS**: Estilos responsive, animaciones, navegación
- **JavaScript**: Lógica AJAX para cargar posts, navegación, autoplay
- **PHP**: Shortcode handler y endpoint AJAX

Funcionalidades:
- Carga dinámica de posts via AJAX
- Responsive (1, 2 o 3 columnas según viewport)
- Autoplay configurable
- Navegación con flechas y dots
- Soporte táctil y teclado

### Ajax Benefits Cards

Este snippet probablemente genera tarjetas de beneficios de Ajax Systems:

- Sin cuotas mensuales
- Control total desde móvil
- Privacidad garantizada
- Tecnología europea premiada

## 📋 Checklist de Backup

- [ ] Exportar snippets desde WordPress Admin
- [ ] Guardar archivo JSON en lugar seguro
- [ ] Hacer backup de base de datos (tabla `wp_snippets`)
- [ ] Documentar funcionalidad de cada snippet
- [ ] Probar importación en entorno de desarrollo
- [ ] Versionarlo en Git (este repositorio)

## 🔗 Referencias

- [Code Snippets Documentation](https://codesnippets.pro/docs/)
- [Code Snippets GitHub](https://github.com/codesnippets/code-snippets)

---

**Última actualización**: 11 de diciembre de 2025
