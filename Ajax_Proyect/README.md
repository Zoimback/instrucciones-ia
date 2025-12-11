# Backup WordPress - La Alarma Inteligente

Backup completo del sitio WordPress **DesarrolloLaAlarmaInteligente** (https://desarrollo.laalarmainteligente.es)

Fecha de backup: 11 de diciembre de 2025

## Contenido del Backup

### 📄 Páginas y Posts
- `/content/pages/` - Todas las páginas del sitio
- `/content/posts/` - Todas las entradas del blog

### 🔌 Plugins
- `/plugins/info.md` - Información detallada de todos los plugins instalados

### 🎨 Temas
- `/themes/info.md` - Información sobre los temas activos e instalados

### ⚙️ Configuración
- `/config/site-info.json` - Configuración general del sitio

### 💡 Code Snippets
- **NOTA**: El plugin Code Snippets no expone sus fragmentos a través de la REST API.
- Para exportar los snippets, accede manualmente a WordPress Admin → Snippets → Exportar
- O accede directamente a la base de datos tabla `wp_snippets`

## Uso

Este backup contiene el contenido y configuración del sitio en formato JSON y Markdown, facilitando su versionamiento en Git y restauración si es necesario.

## Limitaciones

- **Snippets de código**: No disponibles via API, requieren exportación manual
- **Archivos multimedia**: Solo se incluyen referencias (URLs), no los archivos físicos
- **Base de datos**: Este backup no incluye volcado completo de BD
