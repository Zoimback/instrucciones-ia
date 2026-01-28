# Guía Rápida de Implementación - Proyecto Ajax WordPress

## 📋 Resumen Ejecutivo

Este documento proporciona una guía rápida para implementar todas las mejoras solicitadas para el sitio web de Ajax.

---

## 🚀 Inicio Rápido

### Archivos Creados

1. **`ISSUES.md`** - Documento principal con todas las issues organizadas
2. **`productos-cctv.csv`** - CSV listo para importar en WooCommerce con todos los productos CCTV
3. **`GUIA-IMPLEMENTACION.md`** - Este archivo

---

## 📂 Estructura de Issues

### Por Prioridad

#### 🔴 CRÍTICAS (Hacer primero)
- **Issue #5**: Problemas con el carrito
- **Issue #7**: Cookies rechazables (RGPD)
- **Issue #8**: Checkbox privacidad (RGPD)
- **Issue #15**: Activar WooCommerce

#### 🟡 ALTAS (Hacer pronto)
- **Issue #1**: Nuevo texto instalación
- **Issue #3-4**: Info legal (condiciones + titular)
- **Issue #6**: Nombre ticket banco
- **Issue #9-13**: Productos CCTV
- **Issue #16**: Error cuota IA

#### 🟢 MEDIAS (Planificar)
- **Issue #2**: Link "Acerca de"
- **Issue #14**: CSV productos
- **Issue #17**: Sitio Brasil

---

## 🛠️ Implementación por Fases

### Fase 1: Cumplimiento Legal (Semana 1)
**Objetivo:** Asegurar el sitio cumpla RGPD y requisitos legales españoles

```bash
# Checklist Fase 1
□ Configurar plugin de cookies para permitir rechazo
□ Verificar y corregir todos los checkboxes de privacidad
□ Probar proceso completo de compra
□ Añadir condiciones de venta en homepage
□ Añadir identificación del titular
□ Revisar y corregir problemas del carrito
□ Activar notificaciones de WooCommerce
```

**Entregables:**
- Sitio 100% conforme RGPD
- Carrito funcionando perfectamente
- WooCommerce activado y recibiendo pedidos

---

### Fase 2: Contenido y Configuración (Semana 2)
**Objetivo:** Actualizar contenidos y configuraciones

```bash
# Checklist Fase 2
□ Actualizar página de instalación con nuevo texto
□ Verificar/modificar link en "Acerca de"
□ Configurar nombre en tickets bancarios
□ Resolver error de cuota IA
□ Hacer backup completo del sitio
```

**Entregables:**
- Contenidos actualizados
- Configuraciones optimizadas
- Error IA resuelto

---

### Fase 3: Catálogo CCTV (Semana 3-4)
**Objetivo:** Añadir línea completa de productos CCTV

#### Paso 3.1: Estructura del Menú
```bash
# En WordPress Admin > Apariencia > Menús
1. Crear nuevo elemento "CCTV"
2. Crear sub-elementos:
   - Grabadores NVR
   - Cámaras Mini Domo
   - Cámaras Turret
   - Cámaras Bullet
```

#### Paso 3.2: Categorías WooCommerce
```bash
# En WooCommerce > Productos > Categorías
Crear estructura:
CCTV (padre)
├── Grabadores NVR
└── Cámaras
    ├── Mini Domo
    ├── Turret
    └── Bullet
```

#### Paso 3.3: Importar Productos
```bash
# Usar archivo: productos-cctv.csv
# En WooCommerce > Productos > Importar

1. Subir productos-cctv.csv
2. Mapear columnas (ya están mapeadas correctamente)
3. Verificar preview
4. Ejecutar importación
5. Revisar productos importados
```

#### Paso 3.4: Completar Información
```bash
# Para cada producto:
□ Añadir imágenes de producto (solicitar al cliente)
□ Verificar descripciones
□ Configurar stock inicial
□ Verificar precios
□ Añadir SKUs si faltan
□ Configurar opciones de envío
□ Publicar productos
```

**Productos CCTV Totales:** 54 productos
- 4 NVRs (grabadores)
- 32 Mini Domos (con variaciones)
- 2 Turrets
- 16 Bullets (con variaciones)

---

### Fase 4: Expansión Internacional (Futuro)
**Objetivo:** Lanzar versión brasileña del sitio

```bash
# Decisiones arquitectónicas necesarias:
□ Decidir: Subdominio (br.sitio.com) vs Subdirectorio (/br/)
□ Elegir: Multisite WordPress vs Plugin multiidioma vs Instalación separada
□ Configurar: Pasarelas de pago brasileñas (PagSeguro, Mercado Pago, etc.)
□ Traducir: Todo el contenido al portugués brasileño
□ Adaptar: Precios a BRL
□ Configurar: Envíos para Brasil
□ Revisar: Requisitos legales brasileños
```

---

## 📊 Productos CCTV - Referencia Rápida

### NVR (Grabadores)
| SKU | Producto | Canales | Color | Precio |
|-----|----------|---------|-------|--------|
| AJ-NVR108-W | NVR 8 Canales | 8 | Blanco | 256€ |
| AJ-NVR108-B | NVR 8 Canales | 8 | Negro | 256€ |
| AJ-NVR116-W | NVR 16 Canales | 16 | Blanco | 395€ |
| AJ-NVR116-B | NVR 16 Canales | 16 | Negro | 395€ |

### Cámaras Mini Domo - Estándar
| Resolución | Lente | Color | Precio | SKU Base |
|------------|-------|-------|--------|----------|
| 5MP | 2.8mm | Blanco/Negro | 225€ | AJ-DOMECAM-MINI-5-[W/B] |
| 8MP | 2.8mm | Blanco/Negro | 298€ | AJ-DOMECAM-MINI-8-[W/B] |
| 5MP | 4mm | Blanco/Negro | 225€ | AJ-DOMECAM-MINI-5-0400-[W/B] |
| 8MP | 4mm | Blanco/Negro | 298€ | AJ-DOMECAM-MINI-8-0400-[W/B] |

### Cámaras Mini Domo - LED Blanco
| Resolución | Lente | Color | Precio | SKU Base |
|------------|-------|-------|--------|----------|
| 5MP | 2.8mm | Blanco/Negro | 232€ | AJ-DOMECAM-MINI-5-HL-[W/B] |
| 8MP | 2.8mm | Blanco/Negro | 310€ | AJ-DOMECAM-MINI-8-HL-[W/B] |
| 5MP | 4mm | Blanco/Negro | 232€ | AJ-DOMECAM-MINI-5-0400-HL-[W/B] |
| 8MP | 4mm | Blanco/Negro | 310€ | AJ-DOMECAM-MINI-8-0400-HL-[W/B] |

### Cámaras Turret
| Resolución | Lente | Color | Precio | SKU |
|------------|-------|-------|--------|-----|
| 8MP | 2.8mm | Blanco | TBD | AJ-TURRETCAM-8-W |
| 8MP | 4mm | Blanco | TBD | AJ-TURRETCAM-8-0400-W |

**Nota:** Precios pendientes de confirmar con cliente

### Cámaras Bullet
| Resolución | Lente | Color | Precio | SKU Base |
|------------|-------|-------|--------|----------|
| 5MP | 4mm | Blanco/Negro | 225€ | AJ-BULLETCAM-5-0400-[W/B] |
| 8MP | 4mm | Blanco/Negro | 298€ | AJ-BULLETCAM-8-0400-[W/B] |
| 8MP | 2.8mm | Blanco/Negro | 298€ | AJ-BULLETCAM-8-[W/B] |

---

## ✅ Checklist de Verificación General

### Antes de Comenzar
- [ ] Hacer backup completo del sitio
- [ ] Crear entorno de staging si es posible
- [ ] Documentar configuración actual
- [ ] Tener acceso a:
  - [ ] WordPress Admin
  - [ ] WooCommerce
  - [ ] FTP/SFTP
  - [ ] Base de datos
  - [ ] Hosting panel

### Durante el Desarrollo
- [ ] Probar cada cambio antes de pasar al siguiente
- [ ] Documentar cambios realizados
- [ ] Mantener comunicación con cliente
- [ ] Solicitar aprobación en cambios visuales
- [ ] Obtener imágenes de productos CCTV

### Antes de Publicar
- [ ] Revisar todo en staging
- [ ] Probar proceso completo de compra
- [ ] Verificar responsive design (móvil/tablet/desktop)
- [ ] Probar todos los formularios
- [ ] Verificar cookies y privacidad
- [ ] Revisar velocidad de carga
- [ ] Comprobar enlaces rotos
- [ ] Testear pasarelas de pago
- [ ] Verificar emails de notificación

### Post-Lanzamiento
- [ ] Monitorear primeras compras
- [ ] Verificar Google Analytics
- [ ] Comprobar Search Console
- [ ] Verificar emails transaccionales
- [ ] Solicitar feedback del cliente

---

## 🔧 Herramientas Recomendadas

### Plugins WordPress Esenciales
- **Cookie Notice & Compliance for GDPR / CCPA** - Gestión de cookies
- **WooCommerce** - E-commerce (ya instalado)
- **WPML** o **Polylang** - Para versión multiidioma (Brasil)
- **Yoast SEO** - Optimización SEO
- **Wordfence** - Seguridad
- **UpdraftPlus** - Backups automáticos

### Testing
- **Google PageSpeed Insights** - Velocidad
- **GTmetrix** - Performance
- **Google Mobile-Friendly Test** - Responsive
- **Broken Link Checker** - Enlaces rotos

### Desarrollo
- **WP-CLI** - Gestión por línea de comandos
- **Query Monitor** - Debug
- **Local by Flywheel** - Entorno local

---

## 📞 Información de Contacto con Cliente

### Datos Necesarios
- [ ] Imágenes de productos CCTV (alta resolución)
- [ ] Precios definitivos de cámaras Turret
- [ ] Link exacto a modificar en "Acerca de"
- [ ] Nombre deseado para tickets bancarios
- [ ] Datos legales del titular (NIF, dirección, etc.)
- [ ] Texto completo de condiciones de venta
- [ ] Detalles sobre el error de cuota IA
- [ ] Especificaciones técnicas completas de productos

---

## 📝 Notas Importantes

### Sobre WooCommerce
- Los productos con variaciones (color) deben crearse como "variable" padre y "variation" hijos
- Asegurar que los atributos globales estén creados (pa_color)
- Configurar el manejo de stock por variación si es necesario

### Sobre RGPD
- **CRÍTICO:** Ningún checkbox de privacidad debe estar pre-marcado
- Las cookies no esenciales NO deben cargarse sin consentimiento explícito
- Mantener registro de consentimientos (el plugin de cookies debe hacerlo)

### Sobre SEO
- Añadir meta descripciones a todos los productos nuevos
- Usar URLs amigables (slugs limpios)
- Configurar breadcrumbs
- Añadir schema markup para productos

### Sobre Imágenes
- Formato recomendado: WebP para web (con fallback JPG)
- Tamaños: Principal 1200x1200px, thumbnails automáticos
- Alt text descriptivo en todas las imágenes
- Comprimir imágenes antes de subir

---

## 🎯 KPIs de Éxito

### Post-Implementación Fase 1 (Legal)
- ✓ 0 errores de cumplimiento RGPD
- ✓ 100% procesos de compra exitosos en test
- ✓ Todos los emails de WooCommerce funcionando

### Post-Implementación Fase 2 (Contenido)
- ✓ Todos los textos actualizados
- ✓ 0 enlaces rotos
- ✓ Configuraciones aplicadas correctamente

### Post-Implementación Fase 3 (CCTV)
- ✓ 54 productos CCTV publicados
- ✓ Todas las categorías creadas
- ✓ Menú CCTV funcional
- ✓ Todas las imágenes cargadas
- ✓ Proceso de compra CCTV testeado

---

## 🐛 Troubleshooting Común

### Problema: Import CSV falla
**Solución:**
- Verificar encoding UTF-8
- Comprobar que las columnas coincidan
- Importar en lotes pequeños (10-20 productos)
- Verificar memoria PHP (aumentar si es necesario)

### Problema: Imágenes no se muestran
**Solución:**
- Verificar permisos de carpeta uploads
- Regenerar thumbnails (plugin)
- Comprobar URLs en CSV

### Problema: Variaciones no se crean
**Solución:**
- Crear atributos globales primero (pa_color)
- Asegurar parent_id correcto
- Verificar que el padre sea tipo "variable"

### Problema: Cookies se cargan sin consentimiento
**Solución:**
- Revisar configuración del plugin de cookies
- Verificar que scripts de terceros tengan el wrapper correcto
- Usar atributo data-consent en scripts

---

## 📚 Recursos Adicionales

### Documentación Oficial
- [WooCommerce Docs](https://woocommerce.com/documentation/)
- [WordPress Codex](https://codex.wordpress.org/)
- [RGPD España](https://www.aepd.es/)

### Comunidad
- [WordPress Support Forums](https://wordpress.org/support/)
- [WooCommerce Community](https://woocommerce.com/community/)
- [Stack Overflow WordPress Tag](https://stackoverflow.com/questions/tagged/wordpress)

---

**Última actualización:** 28 de enero de 2026  
**Versión:** 1.0  
**Responsable:** Equipo de Desarrollo Web Ajax
