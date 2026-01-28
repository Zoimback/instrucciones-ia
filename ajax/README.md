# 🛡️ Proyecto Ajax - Documentación WordPress

Este directorio contiene toda la documentación, configuraciones y recursos para el desarrollo y mantenimiento del sitio web de Ajax (sistema de alarmas inteligentes).

## 📁 Estructura del Directorio

```
ajax/
├── .github/                          # Configuraciones específicas de GitHub
├── plug-ins/                         # Plugins y código personalizado
│   ├── code-snippets/               # Snippets de código reutilizables
│   └── productos-woocommerce/       # Datos de productos
│       ├── productos.csv            # Productos existentes (alarmas)
│       └── productos-cctv.csv       # 🆕 Productos CCTV nuevos
├── img/                             # Recursos de imagen
├── ISSUES.md                        # 🆕 Lista completa de issues del proyecto
├── GUIA-IMPLEMENTACION.md          # 🆕 Guía detallada de implementación
├── Contributing.md                  # Normas de contribución
└── README.md                        # Este archivo
```

## 🎯 Documentos Principales

### 1. 📋 [ISSUES.md](./ISSUES.md)
**Documento maestro de issues del proyecto**

Contiene 17 issues organizadas por categorías:
- 📝 Contenido y Textos (4 issues)
- 🛒 Carrito y Checkout (2 issues)
- 🔒 Privacidad y RGPD (2 issues)
- 📦 Nuevos Productos CCTV (6 issues)
- ⚙️ Configuración Técnica (2 issues)
- 🌍 Expansión Internacional (1 issue)

Cada issue incluye:
- Descripción detallada
- Prioridad (Crítica/Alta/Media)
- Etiquetas
- Lista de tareas
- Especificaciones técnicas cuando aplica

### 2. 🚀 [GUIA-IMPLEMENTACION.md](./GUIA-IMPLEMENTACION.md)
**Guía práctica paso a paso**

Incluye:
- Plan de implementación por fases
- Checklists detallados
- Referencia rápida de productos
- Troubleshooting común
- KPIs de éxito
- Herramientas recomendadas

### 3. 📦 [productos-cctv.csv](./plug-ins/productos-woocommerce/productos-cctv.csv)
**CSV listo para importar en WooCommerce**

Contiene 54 productos CCTV:
- 4 Grabadores NVR
- 32 Cámaras Mini Domo
- 2 Cámaras Turret
- 16 Cámaras Bullet

## 🚀 Inicio Rápido

### Para Desarrolladores

1. **Lee primero:**
   - `ISSUES.md` para entender el alcance completo
   - `GUIA-IMPLEMENTACION.md` para el plan de trabajo

2. **Prioriza según fases:**
   - **Fase 1 (Crítico):** Legal y RGPD
   - **Fase 2:** Contenidos
   - **Fase 3:** Productos CCTV
   - **Fase 4:** Expansión Brasil

3. **Antes de empezar:**
   - Haz backup completo
   - Crea entorno de staging si es posible
   - Lee `Contributing.md`

### Para Gestores de Proyecto

1. **Revisa las prioridades en ISSUES.md**
   - Issues críticas requieren atención inmediata
   - Planifica sprints según las fases propuestas

2. **Coordina con el cliente:**
   - Solicita imágenes de productos CCTV
   - Confirma precios de cámaras Turret
   - Valida textos y contenidos

3. **Monitorea usando los KPIs en GUIA-IMPLEMENTACION.md**

## 📊 Estado del Proyecto

### ✅ Completado
- [x] Análisis de requisitos
- [x] Organización de issues
- [x] Preparación de CSV de productos CCTV
- [x] Documentación de implementación

### 🔄 En Progreso
- [ ] Fase 1: Cumplimiento Legal
- [ ] Fase 2: Actualización de Contenidos
- [ ] Fase 3: Integración CCTV
- [ ] Fase 4: Expansión Brasil

## 🎯 Objetivos del Proyecto

### Corto Plazo (1-2 semanas)
1. ✅ Cumplimiento total RGPD
2. ✅ Carrito funcionando sin errores
3. ✅ WooCommerce activado para recibir pedidos
4. ✅ Información legal visible

### Medio Plazo (3-4 semanas)
1. 📦 54 productos CCTV publicados
2. 🎨 Menú reorganizado con sección CCTV
3. 📝 Contenidos actualizados
4. ⚙️ Configuraciones optimizadas

### Largo Plazo (2-3 meses)
1. 🌎 Versión brasileña del sitio
2. 📈 Optimización SEO
3. 🚀 Performance optimizada

## 🛠️ Stack Tecnológico

- **CMS:** WordPress
- **E-commerce:** WooCommerce
- **Servidor:** Por determinar
- **Base de datos:** MySQL
- **Lenguajes:** PHP, JavaScript, HTML, CSS
- **Control de versiones:** Git + GitHub

## 📝 Issues por Prioridad

### 🔴 Críticas (4)
- Issue #5: Problemas con el carrito
- Issue #7: Gestión de cookies rechazable
- Issue #8: Checkbox privacidad pre-marcado
- Issue #15: Activar WooCommerce

### 🟡 Altas (10)
- Issue #1: Texto servicio instalación
- Issue #3: Condiciones de venta
- Issue #4: Identificación titular
- Issue #6: Nombre ticket banco
- Issue #9: Sección menú CCTV
- Issue #10-13: Productos CCTV
- Issue #16: Error cuota IA

### 🟢 Medias (3)
- Issue #2: Link "Acerca de"
- Issue #14: Actualizar CSV
- Issue #17: Sitio Brasil

## 🤝 Cómo Contribuir

1. Lee `Contributing.md`
2. Usa la nomenclatura de branches:
   - `fix/*` para correcciones
   - `feature/*` para nuevas funcionalidades
   - `hot-fix/*` para urgencias

3. Asegura que el código funciona antes de hacer commit
4. Documenta todos los cambios importantes

## 📞 Contacto y Soporte

Para preguntas o aclaraciones sobre este proyecto:
- Revisa primero `ISSUES.md` y `GUIA-IMPLEMENTACION.md`
- Consulta con el equipo de desarrollo
- Contacta al cliente cuando sea necesario para:
  - Imágenes de productos
  - Confirmación de precios
  - Aprobación de contenidos

## 📚 Recursos Adicionales

### Documentación en `.github/instructions/`
- `php_wordpress.instructions.md` - Guía de PHP para WordPress
- `js_wordpress.instructions.md` - Guía de JavaScript/Gutenberg
- `html_wordpress.instructions.md` - Guía de HTML/Templates
- `css_wordpress.instructions.md` - Guía de CSS/Estilos

### Agentes de IA en `.github/agents/`
- `central.agent.md` - Agente central de coordinación
- `ortografia.agent.md` - Revisión ortográfica
- `review.agent.md` - Revisión de código
- `test.agent.md` - Testing con WordPress MCP
- `web-tester.agent.md` - Testing web con Playwright

## 🔐 Seguridad y Compliance

- ✅ Cumplimiento RGPD obligatorio
- ✅ Sanitización de entradas
- ✅ Escapado de salidas
- ✅ Uso de nonces en formularios
- ✅ Gestión segura de cookies

## 📈 Métricas de Éxito

### KPIs Principales
- **Cumplimiento Legal:** 100%
- **Productos Activos:** 54 nuevos CCTV + existentes
- **Tasa de Conversión:** A monitorear post-lanzamiento
- **Tiempo de Carga:** < 3 segundos
- **Errores de Checkout:** 0%

---

**Última actualización:** 28 de enero de 2026  
**Versión:** 1.0  
**Mantenido por:** Equipo de Desarrollo Ajax

---

## 🔄 Historial de Cambios

### v1.0 - 28/01/2026
- ✅ Creación de documentación inicial
- ✅ Organización de 17 issues
- ✅ Preparación de CSV con 54 productos CCTV
- ✅ Guía de implementación completa
- ✅ Estructura de proyecto definida
