# Investigación: Amazon Black Friday URL

## 🎯 Objetivo
Acceder y explorar la siguiente URL de Amazon España Black Friday utilizando Chrome MCP:
```
https://www.amazon.es/blackfriday/3?ref_=pe_205892261_1450473451
```

## 🔧 Herramientas Utilizadas
- **Playwright Browser MCP**: Navegador automatizado integrado
- **Chrome DevTools MCP**: Intentado pero requiere configuración de servidor X
- **web_fetch**: Herramienta de fetching alternativa

## 📋 Intentos Realizados

### 1. Navegación con Playwright Browser
**Comando:** `playwright-browser_navigate`

**URLs Probadas:**
- `https://www.amazon.es/blackfriday/3?ref_=pe_205892261_1450473451` (URL completa)
- `https://www.amazon.es/blackfriday` (URL sin parámetros)
- `https://www.amazon.es/` (Página principal)
- `https://example.com` (URL de prueba)

**Resultado:** ❌ Bloqueado en todos los casos

### 2. Fetch con web_fetch
**Comando:** `web_fetch`

**Resultado:** ❌ `TypeError: fetch failed`

### 3. Chrome DevTools
**Comando:** `chrome-devtools-new_page`

**Resultado:** ❌ Requiere servidor X (display gráfico)

## 🚫 Error Encontrado

### ERR_BLOCKED_BY_CLIENT

**Mensaje de Error:**
```
Error: page.goto: net::ERR_BLOCKED_BY_CLIENT at https://www.amazon.es/
```

**Descripción del Error:**
- Título: "example.com is blocked" (o www.amazon.es is blocked)
- Mensaje: "This page has been blocked by Chrome"
- Código: ERR_BLOCKED_BY_CLIENT

**Captura de Pantalla:**
![Browser Blocked Error](https://github.com/user-attachments/assets/0fb8f0ba-5757-40d1-b157-29b474a7e99d)

## 🔍 Análisis del Problema

### Causa Raíz
El error `ERR_BLOCKED_BY_CLIENT` indica que el navegador Chrome está bloqueando el acceso a estos sitios web debido a:

1. **Políticas de Seguridad del Entorno**
   - El entorno de ejecución tiene restricciones de red
   - Políticas de sandbox que limitan acceso a sitios externos

2. **Extensiones o Bloqueadores**
   - Content blockers activos
   - Ad-blockers configurados
   - Filtros de contenido

3. **Restricciones de Red**
   - Firewall corporativo
   - Lista de dominios bloqueados
   - Políticas de acceso restringido

## 📊 Snapshot del Estado del Navegador

```yaml
- generic:
  - generic:
    - heading "www.amazon.es is blocked" [level=1]:
      - generic: www.amazon.es is blocked
    - paragraph: This page has been blocked by Chrome
    - generic: ERR_BLOCKED_BY_CLIENT
  - button "Reload" [cursor=pointer]
```

**URL del Navegador:** `chrome-error://chromewebdata/`

## 💡 Alternativas Propuestas

### Opción 1: Configuración del Navegador
Modificar las políticas de seguridad del navegador para permitir acceso a Amazon.es (requiere permisos administrativos)

### Opción 2: Proxy o VPN
Utilizar un proxy o VPN para acceder a través de una conexión alternativa

### Opción 3: Entorno Diferente
Ejecutar en un entorno sin restricciones de red:
- Máquina local del desarrollador
- Servidor con permisos de red completos
- Contenedor Docker configurado apropiadamente

### Opción 4: Mock/Simulación
Crear una simulación del contenido de Amazon Black Friday para propósitos de desarrollo

### Opción 5: API de Amazon
Utilizar la API oficial de Amazon (Amazon Product Advertising API) si está disponible

## 📝 Conclusiones

1. **El entorno actual no permite acceso directo a Amazon.es** debido a políticas de seguridad estrictas
2. **El error es consistente** a través de múltiples herramientas (Playwright, web_fetch)
3. **No es un problema del código** sino una limitación del entorno de ejecución
4. **Se requiere un enfoque alternativo** para acceder a contenido de Amazon

## 🎯 Recomendaciones

Para futuras investigaciones de URLs externas:

1. **Verificar accesibilidad** antes de intentos extensivos
2. **Usar herramientas locales** cuando sea posible
3. **Considerar APIs oficiales** en lugar de scraping
4. **Documentar restricciones** del entorno claramente
5. **Implementar fallbacks** para casos de acceso bloqueado

## 📅 Información del Intento

- **Fecha:** 5 de febrero de 2026
- **Entorno:** GitHub Actions / Sandboxed Environment
- **Navegador:** Playwright/Chromium
- **Estado Final:** Bloqueado por políticas de seguridad

---

## 🔗 URLs de Referencia

- URL Solicitada: `https://www.amazon.es/blackfriday/3?ref_=pe_205892261_1450473451`
- Parámetros:
  - `ref_`: pe_205892261_1450473451 (Tracking/referencia)
  - Sección: `/blackfriday/3`

## 📸 Evidencia Visual

La captura de pantalla muestra claramente el mensaje de bloqueo del navegador Chrome, confirmando que no es un problema de conectividad sino una política de seguridad activa que previene el acceso a sitios externos como Amazon.es.

**Imagen:** [Ver captura de pantalla](https://github.com/user-attachments/assets/0fb8f0ba-5757-40d1-b157-29b474a7e99d)
