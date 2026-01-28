# 🚀 Guía de Inicio Rápido - Proyecto Ajax

## 👋 ¡Bienvenido!

Este es el documento de inicio rápido para el proyecto de mejoras del sitio web Ajax (sistema de alarmas inteligentes).

---

## 📚 ¿Por Dónde Empezar?

### Si eres DESARROLLADOR:
1. Lee **[README.md](./README.md)** primero (5 min)
2. Revisa **[ISSUES.md](./ISSUES.md)** para ver todas las tareas (15 min)
3. Consulta **[GUIA-IMPLEMENTACION.md](./GUIA-IMPLEMENTACION.md)** para el plan (10 min)
4. Usa **[RESUMEN-VISUAL.md](./RESUMEN-VISUAL.md)** como referencia rápida

### Si eres PROJECT MANAGER:
1. Lee **[RESUMEN-VISUAL.md](./RESUMEN-VISUAL.md)** para visión general (5 min)
2. Revisa prioridades en **[ISSUES.md](./ISSUES.md)** (10 min)
3. Planifica sprints con **[GUIA-IMPLEMENTACION.md](./GUIA-IMPLEMENTACION.md)** (15 min)

### Si eres CLIENTE:
1. Revisa **[RESUMEN-VISUAL.md](./RESUMEN-VISUAL.md)** para entender el alcance
2. Consulta la lista de "Información Pendiente" al final
3. Prepara imágenes y datos necesarios

---

## 📄 Guía de Documentos

| Documento | Qué Contiene | Cuándo Usarlo |
|-----------|-------------|---------------|
| **[README.md](./README.md)** | Overview del proyecto completo | Primer contacto con el proyecto |
| **[ISSUES.md](./ISSUES.md)** | 17 issues detalladas con tareas | Implementación y tracking |
| **[GUIA-IMPLEMENTACION.md](./GUIA-IMPLEMENTACION.md)** | Plan paso a paso por fases | Durante desarrollo |
| **[RESUMEN-VISUAL.md](./RESUMEN-VISUAL.md)** | Gráficos y diagramas | Referencia rápida |
| **[productos-cctv.csv](./plug-ins/productos-woocommerce/productos-cctv.csv)** | 54 productos para importar | Importación WooCommerce |

---

## 🎯 Las 3 Cosas Más Importantes

### 1. 🔴 PRIORIDAD CRÍTICA: Legal y RGPD
**¿Qué?** Asegurar cumplimiento RGPD antes de cualquier otra cosa.

**Issues:**
- #5: Carrito funcionando
- #7: Cookies rechazables
- #8: Checkbox privacidad sin pre-marcar
- #15: WooCommerce activo

**Tiempo estimado:** 1 semana

**Por qué es crítico:** Requisitos legales obligatorios. Sin esto, el sitio no puede operar.

---

### 2. 📦 NUEVA LÍNEA: Productos CCTV
**¿Qué?** Añadir 54 productos nuevos de videovigilancia.

**Incluye:**
- 4 Grabadores NVR
- 32 Cámaras Mini Domo
- 2 Cámaras Turret
- 16 Cámaras Bullet

**Archivo listo:** `productos-cctv.csv` 

**Tiempo estimado:** 2 semanas

**Valor:** Expansión del catálogo a nueva categoría de productos.

---

### 3. 📝 ACTUALIZACIÓN: Contenidos y Configuración
**¿Qué?** Mejorar textos, configuraciones y resolver problemas técnicos.

**Incluye:**
- Nuevo texto servicio instalación
- Info legal en homepage
- Configuración pagos
- Correcciones varias

**Tiempo estimado:** 1 semana

**Valor:** Mejora experiencia usuario y profesionalidad del sitio.

---

## ⚡ Flujo de Trabajo Recomendado

```
DÍA 1-2: Setup
├─ Hacer backup completo
├─ Configurar staging
├─ Revisar documentación
└─ Solicitar info al cliente

SEMANA 1: Legal
├─ Fix cookies
├─ Fix checkbox privacidad
├─ Fix carrito
└─ Activar WooCommerce

SEMANA 2: Contenido
├─ Actualizar textos
├─ Añadir info legal
└─ Configuraciones

SEMANA 3-4: CCTV
├─ Crear menú
├─ Importar productos
├─ Añadir imágenes
└─ Testing

POST-LAUNCH: Monitoreo
├─ Verificar pedidos
├─ Monitorear errores
└─ Optimización
```

---

## 📋 Checklist Pre-Inicio

Antes de comenzar el desarrollo, asegúrate de tener:

### Accesos
- [ ] WordPress Admin (super admin)
- [ ] WooCommerce
- [ ] FTP/SFTP
- [ ] Base de datos
- [ ] Panel de hosting
- [ ] Dominio y DNS

### Información del Cliente
- [ ] Imágenes productos CCTV (alta resolución)
- [ ] Precios cámaras Turret
- [ ] Datos legales titular (NIF, dirección)
- [ ] Texto condiciones de venta
- [ ] Nombre para tickets bancarios
- [ ] Info sobre error cuota IA

### Herramientas
- [ ] Git configurado
- [ ] Editor de código (VS Code, PHPStorm, etc.)
- [ ] Node.js + npm (para compilar assets)
- [ ] PHP local (para testing)
- [ ] Cliente MySQL

### Backups
- [ ] Backup base de datos
- [ ] Backup archivos WordPress
- [ ] Backup configuración WooCommerce
- [ ] Backup tema actual
- [ ] Documentar configuración actual

---

## 🆘 ¿Problemas o Dudas?

### Si tienes dudas sobre:

**Qué hacer:**
→ Consulta **[ISSUES.md](./ISSUES.md)** - Cada issue tiene descripción detallada

**Cómo hacerlo:**
→ Consulta **[GUIA-IMPLEMENTACION.md](./GUIA-IMPLEMENTACION.md)** - Plan paso a paso

**Buenas prácticas:**
→ Consulta `.github/instructions/` - Guías de PHP, JS, HTML, CSS

**Problemas técnicos:**
→ Consulta **[GUIA-IMPLEMENTACION.md](./GUIA-IMPLEMENTACION.md)** sección "Troubleshooting"

---

## 🎓 Tips para el Éxito

### 1. **No te saltes el backup**
Siempre, SIEMPRE haz backup antes de comenzar cambios importantes.

### 2. **Testing en staging**
No hagas cambios directamente en producción. Usa staging primero.

### 3. **Commit frecuente**
Haz commits pequeños y frecuentes con mensajes descriptivos.

### 4. **Documenta cambios**
Anota cualquier cambio que no esté en la documentación original.

### 5. **Comunica con el cliente**
Mantén al cliente informado del progreso. Usa los reports de progreso.

### 6. **Prioriza RGPD**
Legal primero, todo lo demás después.

---

## 📞 Lista de Contactos

### Necesitas del Cliente:
- [ ] Imágenes productos CCTV
- [ ] Confirmación precios Turret
- [ ] Datos legales completos
- [ ] Aprobación de textos
- [ ] Credenciales de servicios (si aplica)

### Necesitas del Hosting:
- [ ] Acceso FTP/SFTP
- [ ] Acceso cPanel/panel admin
- [ ] Info de base de datos
- [ ] Límites de memoria PHP
- [ ] Versión PHP/MySQL

---

## 🚦 Semáforo de Issues

### 🔴 HACER YA (Críticas)
```
#5  - Carrito
#7  - Cookies
#8  - Checkbox privacidad
#15 - WooCommerce
```

### 🟡 HACER PRONTO (Altas)
```
#1  - Texto instalación
#3  - Condiciones venta
#4  - ID titular
#6  - Ticket banco
#9  - Menú CCTV
#10 - Productos NVR
#11 - Productos Mini Domo
#12 - Productos Turret
#13 - Productos Bullet
#16 - Error IA
```

### 🟢 PLANIFICAR (Medias)
```
#2  - Link Acerca de
#14 - CSV actualizado
#17 - Sitio Brasil
```

---

## 🎯 Objetivos de Cada Fase

### Fase 1: Legal (Semana 1)
**Objetivo:** Sitio 100% conforme RGPD y funcionando para ventas.

**Criterio de éxito:**
- ✅ Puedo comprar sin errores
- ✅ Puedo rechazar cookies
- ✅ Checkbox privacidad sin pre-marcar
- ✅ Recibo email de confirmación

---

### Fase 2: Contenido (Semana 2)
**Objetivo:** Contenidos actualizados y configuraciones optimizadas.

**Criterio de éxito:**
- ✅ Texto instalación actualizado
- ✅ Info legal visible en homepage
- ✅ Nombre correcto en ticket banco
- ✅ Sin errores de IA

---

### Fase 3: CCTV (Semana 3-4)
**Objetivo:** 54 productos CCTV publicados y funcionando.

**Criterio de éxito:**
- ✅ Menú CCTV visible
- ✅ 54 productos publicados
- ✅ Todas las imágenes cargadas
- ✅ Puedo comprar un producto CCTV

---

### Fase 4: Brasil (Futuro)
**Objetivo:** Versión brasileña del sitio operativa.

**Criterio de éxito:**
- ✅ Sitio en portugués accesible
- ✅ Precios en BRL
- ✅ Pasarelas brasileñas funcionando

---

## 📊 Métricas de Éxito del Proyecto

Al finalizar el proyecto, deberías poder decir:

```
✅ 0 errores legales/RGPD
✅ 0 errores en proceso de compra
✅ 54 productos CCTV activos
✅ 100% emails transaccionales funcionando
✅ < 3 segundos tiempo de carga
✅ 100% responsive (móvil, tablet, desktop)
```

---

## 🎬 ¡Comencemos!

1. **Ahora mismo:** Lee este documento completo ✓
2. **Siguiente:** Revisa [RESUMEN-VISUAL.md](./RESUMEN-VISUAL.md)
3. **Después:** Estudia las issues en [ISSUES.md](./ISSUES.md)
4. **Luego:** Sigue el plan en [GUIA-IMPLEMENTACION.md](./GUIA-IMPLEMENTACION.md)
5. **¡A trabajar!** 🚀

---

## 💡 Recuerda

> **"El código perfecto no existe, pero el código que funciona y cumple requisitos legales es lo que necesitamos."**

- Prioriza funcionalidad sobre perfección
- Legal primero, siempre
- Testing exhaustivo antes de producción
- Documenta todo lo que hagas
- Backup, backup, backup

---

**¡Éxito en tu desarrollo!** 🎉

Si tienes dudas, vuelve a esta guía. Todo lo que necesitas está en la documentación.

---

**Última actualización:** 28 de enero de 2026  
**Versión:** 1.0  
**Mantenido por:** Equipo Ajax
