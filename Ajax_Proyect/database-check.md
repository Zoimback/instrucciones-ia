# Verificación de Snippets en Base de Datos

## Tabla wp_snippets

Los fragmentos de código se almacenan en la tabla `wp_snippets` de la base de datos MySQL.

### Consultas SQL para obtener snippets:

```sql
-- Ver todos los snippets activos
SELECT 
    id,
    name,
    description,
    code,
    tags,
    scope,
    priority,
    active,
    modified
FROM wp_snippets 
WHERE active = 1
ORDER BY priority DESC;

-- Ver TODOS los snippets (activos e inactivos)
SELECT 
    id,
    name,
    description,
    LEFT(code, 100) as code_preview,
    tags,
    scope,
    priority,
    active
FROM wp_snippets 
ORDER BY id;

-- Exportar snippets como JSON
SELECT JSON_OBJECT(
    'id', id,
    'name', name,
    'description', description,
    'code', code,
    'tags', tags,
    'scope', scope,
    'priority', priority,
    'active', active
) as snippet_json
FROM wp_snippets;
```

### Cómo acceder:

1. **phpMyAdmin** (Panel Hostinger):
   - URL: https://hpanel.hostinger.com
   - Ir a Bases de datos → phpMyAdmin
   - Seleccionar tu base de datos WordPress
   - Buscar tabla `wp_snippets`
   - Ejecutar las consultas SQL anteriores

2. **MySQL Workbench**:
   - Conectar a la base de datos remota
   - Usar credenciales de wp-config.php
   - Ejecutar consultas

3. **Terminal SSH**:
   ```bash
   mysql -u usuario -p nombre_bd -e "SELECT * FROM wp_snippets;"
   ```

### Estructura de la tabla wp_snippets:

```sql
DESCRIBE wp_snippets;
```

Columnas típicas:
- `id` - ID único del snippet
- `name` - Nombre del snippet
- `description` - Descripción
- `code` - Código PHP/HTML/CSS/JS
- `tags` - Etiquetas separadas por comas
- `scope` - Ámbito (global, admin, frontend, etc.)
- `priority` - Orden de ejecución
- `active` - 1 = activo, 0 = inactivo
- `modified` - Fecha de última modificación
- `shared_network` - Para multisite
- `network` - Para multisite

