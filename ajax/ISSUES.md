# Issues del Proyecto Ajax - WordPress

## Issue Principal: Actualización Integral del Sitio Web Ajax

### Descripción
Actualización completa del sitio web de Ajax incluyendo mejoras de contenido, funcionalidad del carrito, cumplimiento legal, y expansión del catálogo con productos CCTV.

---

## 📝 CATEGORÍA: Contenido y Textos

### Issue #1: Actualizar texto del servicio de instalación a domicilio

**Prioridad:** Alta  
**Etiquetas:** `contenido`, `servicio`

**Descripción:**
Actualizar el texto del servicio de instalación a domicilio con la nueva propuesta de "Servicio de Acompañamiento y Puesta en Marcha Ajax".

**Nuevo texto a implementar:**
```
🛠️ Servicio de Acompañamiento y Puesta en Marcha Ajax

¿Prefieres que un experto te guíe para asegurar la máxima eficiencia de tu sistema? Aunque Ajax está diseñado para una activación sencilla, ofrecemos un servicio especializado de asesoramiento técnico para que no tengas que preocuparte por nada.

📍 Presencial (Comunidad de Madrid): 150€

Un especialista en tecnología Ajax se desplazará a tu domicilio para realizar una consultoría integral y ayudarte con la puesta en marcha de tu equipo. Este servicio incluye:

Estudio:
Asesoramiento completo sobre la ubicación estratégica de cada componente para cubrir todos los puntos ciegos.

Configuración experta: Programación y vinculación de todo el sistema en tu aplicación móvil.

Soporte en la colocación: Ayuda técnica para la fijación profesional de todos los elementos del kit.

Certificación de señal: Verificación del correcto funcionamiento y de la intensidad de señal en cada dispositivo.

Masterclass de uso: Formación personalizada para que domines todas las funciones de tu nueva alarma inteligente.

Para solicitar este servicio de apoyo, contacta con nosotros al finalizar tu compra y coordinaremos una visita.
```

**Tareas:**
- [ ] Localizar la página/sección de instalación a domicilio
- [ ] Reemplazar el texto actual con el nuevo contenido
- [ ] Verificar formato y emojis se muestren correctamente
- [ ] Actualizar meta descripción si es necesario
- [ ] Probar en diferentes dispositivos (desktop, móvil)

---

### Issue #2: Modificar link en página "Acerca de"

**Prioridad:** Media  
**Etiquetas:** `contenido`, `enlaces`

**Descripción:**
Revisar y modificar un enlace específico en la página "Acerca de".

**Tareas:**
- [ ] Identificar qué link necesita modificación
- [ ] Confirmar con cliente el nuevo destino del enlace
- [ ] Actualizar el enlace
- [ ] Verificar que el enlace funcione correctamente
- [ ] Comprobar que no hay enlaces rotos en la página

---

### Issue #3: Agregar condiciones de venta en primera página

**Prioridad:** Alta  
**Etiquetas:** `legal`, `contenido`, `primera-página`

**Descripción:**
Añadir las condiciones de venta de forma visible en la primera página del sitio web para cumplir con requisitos legales.

**Tareas:**
- [ ] Obtener/revisar el texto de condiciones de venta
- [ ] Determinar ubicación óptima (footer, header, o sección dedicada)
- [ ] Diseñar presentación visual
- [ ] Implementar en la página principal
- [ ] Verificar que sea visible y accesible
- [ ] Comprobar responsive design

---

### Issue #4: Agregar identificación del titular en primera página

**Prioridad:** Alta  
**Etiquetas:** `legal`, `contenido`, `primera-página`

**Descripción:**
Incluir la identificación del titular del sitio web en la primera página conforme a requisitos legales (LSSI en España).

**Información requerida:**
- Nombre/Razón social
- NIF/CIF
- Domicilio social
- Datos de contacto

**Tareas:**
- [ ] Recopilar información legal del titular
- [ ] Determinar ubicación en la primera página
- [ ] Diseñar formato de presentación
- [ ] Implementar
- [ ] Verificar cumplimiento normativo

---

## 🛒 CATEGORÍA: Carrito y Checkout

### Issue #5: Revisar y corregir problemas con el carrito

**Prioridad:** Crítica  
**Etiquetas:** `bug`, `carrito`, `woocommerce`

**Descripción:**
Identificar y corregir problemas en la funcionalidad del carrito de compras.

**Problemas reportados:**
- Fallos no especificados en el funcionamiento del carrito

**Tareas:**
- [ ] Realizar pruebas exhaustivas del carrito:
  - [ ] Añadir productos
  - [ ] Modificar cantidades
  - [ ] Eliminar productos
  - [ ] Aplicar cupones de descuento
  - [ ] Calcular envío
  - [ ] Actualizar total
- [ ] Identificar errores específicos
- [ ] Documentar bugs encontrados
- [ ] Corregir cada problema identificado
- [ ] Realizar pruebas de regresión
- [ ] Verificar en diferentes navegadores

---

### Issue #6: Cambiar nombre que aparece en el ticket del banco

**Prioridad:** Alta  
**Etiquetas:** `pagos`, `woocommerce`, `configuración`

**Descripción:**
Modificar el nombre que aparece en los extractos bancarios de los clientes cuando realizan un pago.

**Tareas:**
- [ ] Identificar configuración actual de pasarela de pago
- [ ] Confirmar nuevo nombre deseado para el ticket bancario
- [ ] Actualizar configuración de la pasarela de pago
- [ ] Realizar pago de prueba
- [ ] Verificar el nombre en el extracto de prueba
- [ ] Documentar cambios

---

## 🔒 CATEGORÍA: Privacidad y RGPD

### Issue #7: Implementar gestión de cookies rechazable

**Prioridad:** Crítica  
**Etiquetas:** `rgpd`, `cookies`, `legal`

**Descripción:**
Asegurar que los usuarios puedan rechazar todas las cookies no esenciales según RGPD.

**Requisitos:**
- Banner de cookies debe permitir:
  - Aceptar todas
  - Rechazar no esenciales
  - Configurar preferencias
- Cookies no esenciales no deben cargarse sin consentimiento

**Tareas:**
- [ ] Auditar plugin de cookies actual
- [ ] Verificar que existe opción de rechazo clara
- [ ] Comprobar que cookies no esenciales no se cargan sin consentimiento
- [ ] Implementar configuración granular si no existe
- [ ] Testear flujo completo:
  - [ ] Aceptar cookies
  - [ ] Rechazar cookies
  - [ ] Configuración personalizada
- [ ] Verificar cumplimiento RGPD
- [ ] Documentar tipos de cookies usadas

---

### Issue #8: Corregir checkbox de privacidad pre-marcado

**Prioridad:** Crítica  
**Etiquetas:** `rgpd`, `checkout`, `privacidad`

**Descripción:**
Asegurar que el checkbox de política de privacidad en el checkout NO esté marcado automáticamente. El usuario debe marcarlo explícitamente (requisito RGPD).

**Ubicaciones a verificar:**
- Formulario de checkout
- Formulario de registro
- Formulario de newsletter
- Cualquier otro formulario con datos personales

**Tareas:**
- [ ] Localizar checkbox de privacidad en checkout
- [ ] Verificar estado por defecto (debe estar desmarcado)
- [ ] Corregir si está pre-marcado
- [ ] Verificar otros formularios del sitio
- [ ] Implementar validación de marcado obligatorio
- [ ] Testear proceso completo de compra
- [ ] Verificar cumplimiento RGPD

---

## 📦 CATEGORÍA: Nuevos Productos - CCTV

### Issue #9: Crear sección de menú para CCTV

**Prioridad:** Alta  
**Etiquetas:** `menú`, `cctv`, `navegación`

**Descripción:**
Añadir un apartado "CCTV" en el menú principal de navegación, separado de "Alarmas".

**Ubicación:**
En la barra de navegación superior junto a: Inicio, Tienda, etc.

**Tareas:**
- [ ] Diseñar estructura del menú con nueva sección
- [ ] Crear página/categoría CCTV en WooCommerce
- [ ] Añadir "CCTV" al menú principal
- [ ] Configurar submenú si es necesario (NVR, Cámaras)
- [ ] Actualizar mega-menú si existe
- [ ] Verificar responsive design
- [ ] Probar navegación en diferentes dispositivos

---

### Issue #10: Crear productos NVR (Grabadores de Video)

**Prioridad:** Alta  
**Etiquetas:** `productos`, `cctv`, `nvr`

**Descripción:**
Crear productos en WooCommerce para grabadores de videovigilancia (NVR).

**Productos a crear:**

**NVR 8 Canales:**
- AJ-NVR108-W (Blanco) - 256€
- AJ-NVR108-B (Negro) - 256€

**NVR 16 Canales:**
- AJ-NVR116-W (Blanco) - 395€
- AJ-NVR116-B (Negro) - 395€

**Especificaciones comunes:**
- Grabadores de videovigilancia
- Disponibles en blanco y negro
- 8 o 16 canales para cámaras

**Tareas:**
- [ ] Crear categoría "NVR" o "Grabadores"
- [ ] Crear producto: AJ-NVR108-W
- [ ] Crear producto: AJ-NVR108-B
- [ ] Crear producto: AJ-NVR116-W
- [ ] Crear producto: AJ-NVR116-B
- [ ] Añadir descripciones detalladas
- [ ] Añadir especificaciones técnicas
- [ ] Configurar variaciones de color si procede
- [ ] Añadir imágenes de productos (obtener del cliente)
- [ ] Configurar opciones de envío
- [ ] Verificar precios y stock
- [ ] Publicar productos
- [ ] Testear añadir al carrito y compra

---

### Issue #11: Crear productos Cámaras Mini Domo

**Prioridad:** Alta  
**Etiquetas:** `productos`, `cctv`, `cámaras`, `mini-domo`

**Descripción:**
Crear todos los productos de cámaras Mini Domo con sus variaciones.

**Productos Mini Domo Lente 2.8mm:**

**5MPX:**
- AJ-DOMECAM-MINI-5-W - 225€
- AJ-DOMECAM-MINI-5-B - 225€

**8MPX:**
- AJ-DOMECAM-MINI-8-W - 298€
- AJ-DOMECAM-MINI-8-B - 298€

**Productos Mini Domo Lente 4mm:**

**5MPX:**
- AJ-DOMECAM-MINI-5-0400-W - 225€
- AJ-DOMECAM-MINI-5-0400-B - 225€

**8MPX:**
- AJ-DOMECAM-MINI-8-0400-W - 298€
- AJ-DOMECAM-MINI-8-0400-B - 298€

**Productos Mini Domo con LED blanco 2.8mm:**

**5MPX:**
- AJ-DOMECAM-MINI-5-HL-W - 232€
- AJ-DOMECAM-MINI-5-HL-B - 232€

**8MPX:**
- AJ-DOMECAM-MINI-8-HL-W - 310€
- AJ-DOMECAM-MINI-8-HL-B - 310€

**Productos Mini Domo con LED blanco 4mm:**

**5MPX:**
- AJ-DOMECAM-MINI-5-0400-HL-W - 232€
- AJ-DOMECAM-MINI-5-0400-HL-B - 232€

**8MPX:**
- AJ-DOMECAM-MINI-8-0400-HL-W - 310€
- AJ-DOMECAM-MINI-8-0400-HL-B - 310€

**Tareas:**
- [ ] Crear categoría "Cámaras Mini Domo"
- [ ] Definir atributos de producto (Resolución, Lente, LED, Color)
- [ ] Crear productos base con variaciones
- [ ] Configurar todas las variaciones (16 productos)
- [ ] Añadir descripciones para cada tipo
- [ ] Incluir especificaciones técnicas
- [ ] Añadir imágenes (obtener del cliente)
- [ ] Configurar precios
- [ ] Configurar gestión de stock
- [ ] Publicar y testear

---

### Issue #12: Crear productos Cámaras Turret

**Prioridad:** Alta  
**Etiquetas:** `productos`, `cctv`, `cámaras`, `turret`

**Descripción:**
Crear productos de cámaras tipo Turret.

**Productos:**

**8MPX 2.8mm:**
- AJ-TURRETCAM-8-W - (precio pendiente)

**8MPX 4mm:**
- AJ-TURRETCAM-8-0400-W - (precio pendiente)

**Tareas:**
- [ ] Confirmar precios con cliente
- [ ] Crear categoría "Cámaras Turret"
- [ ] Crear producto: AJ-TURRETCAM-8-W
- [ ] Crear producto: AJ-TURRETCAM-8-0400-W
- [ ] Añadir descripciones
- [ ] Añadir especificaciones técnicas
- [ ] Configurar variaciones de lente
- [ ] Añadir imágenes
- [ ] Publicar y testear

---

### Issue #13: Crear productos Cámaras Bullet

**Prioridad:** Alta  
**Etiquetas:** `productos`, `cctv`, `cámaras`, `bullet`

**Descripción:**
Crear productos de cámaras tipo Bullet.

**Productos 5MPX 4mm:**
- AJ-BULLETCAM-5-0400-W - 225€
- AJ-BULLETCAM-5-0400-B - 225€

**Productos 8MPX 4mm:**
- AJ-BULLETCAM-8-0400-W - 298€
- AJ-BULLETCAM-8-0400-B - 298€

**Productos 8MPX 2.8mm:**
- AJ-BULLETCAM-8-W - 298€
- AJ-BULLETCAM-8-B - 298€

**Tareas:**
- [ ] Crear categoría "Cámaras Bullet"
- [ ] Definir atributos (Resolución, Lente, Color)
- [ ] Crear productos con variaciones
- [ ] Añadir descripciones
- [ ] Añadir especificaciones técnicas
- [ ] Añadir imágenes
- [ ] Configurar precios
- [ ] Publicar y testear

---

### Issue #14: Actualizar CSV de productos con CCTV

**Prioridad:** Media  
**Etiquetas:** `productos`, `cctv`, `csv`

**Descripción:**
Actualizar el archivo `productos.csv` con todos los nuevos productos CCTV para importación masiva.

**Ubicación:**
`/ajax/plug-ins/productos-woocommerce/productos.csv`

**Tareas:**
- [ ] Revisar estructura actual del CSV
- [ ] Añadir todos los productos NVR
- [ ] Añadir todas las cámaras Mini Domo
- [ ] Añadir cámaras Turret
- [ ] Añadir cámaras Bullet
- [ ] Incluir todas las especificaciones
- [ ] Configurar categorías y etiquetas
- [ ] Verificar formato correcto
- [ ] Realizar importación de prueba
- [ ] Documentar proceso

---

## ⚙️ CATEGORÍA: Configuración Técnica

### Issue #15: Activar cuenta WooCommerce para recibir pedidos

**Prioridad:** Crítica  
**Etiquetas:** `configuración`, `woocommerce`, `pedidos`

**Descripción:**
Configurar y activar la cuenta de WooCommerce para que el sitio pueda recibir pedidos reales.

**Tareas:**
- [ ] Verificar instalación de WooCommerce
- [ ] Configurar datos de la tienda (nombre, dirección, etc.)
- [ ] Configurar métodos de pago:
  - [ ] Pasarela de pago principal
  - [ ] Configuración bancaria
  - [ ] Métodos alternativos si procede
- [ ] Configurar métodos de envío:
  - [ ] Zonas de envío
  - [ ] Costes de envío
  - [ ] Opciones de entrega
- [ ] Configurar emails de notificación:
  - [ ] Email de nuevo pedido
  - [ ] Email de confirmación al cliente
  - [ ] Email de envío
- [ ] Configurar impuestos (IVA)
- [ ] Realizar pedido de prueba completo
- [ ] Verificar recepción de notificaciones
- [ ] Verificar panel de administración de pedidos
- [ ] Documentar configuración

---

### Issue #16: Resolver error de cuota de IA

**Prioridad:** Alta  
**Etiquetas:** `bug`, `ia`, `técnico`

**Descripción:**
Investigar y resolver el error de cuota que está dando la IA.

**Síntomas:**
- "La IA da fallo de cuota"

**Tareas:**
- [ ] Identificar qué sistema de IA está generando el error
- [ ] Revisar logs de error
- [ ] Verificar límites de cuota actuales
- [ ] Identificar causa del problema:
  - [ ] Límite de uso alcanzado
  - [ ] Error de configuración
  - [ ] Problema de API key
- [ ] Implementar solución
- [ ] Aumentar cuota si es necesario
- [ ] Implementar manejo de errores
- [ ] Testear funcionamiento
- [ ] Documentar solución

---

## 🌍 CATEGORÍA: Expansión Internacional

### Issue #17: Crear copia del sitio para Brasil

**Prioridad:** Media  
**Etiquetas:** `internacional`, `brasil`, `multiidioma`

**Descripción:**
Crear una versión del sitio web para el mercado brasileño.

**Requisitos:**
- Traducción al portugués brasileño
- Adaptación de precios (moneda BRL)
- Métodos de pago locales
- Configuración de envíos para Brasil
- Adaptaciones legales (términos brasileños)

**Tareas:**
- [ ] Decidir arquitectura (subdominio vs subdirectorio)
- [ ] Configurar instalación WordPress para Brasil
- [ ] Instalar plugin multiidioma o duplicar sitio
- [ ] Traducir contenido al portugués brasileño:
  - [ ] Páginas principales
  - [ ] Productos
  - [ ] Menús
  - [ ] Formularios
- [ ] Configurar pasarelas de pago brasileñas
- [ ] Configurar envíos para Brasil
- [ ] Adaptar precios a BRL
- [ ] Revisar requisitos legales brasileños
- [ ] Configurar dominio o subdominio
- [ ] Realizar pruebas completas
- [ ] Lanzamiento

---

## 📊 Resumen de Prioridades

### Críticas (hacer primero):
1. Issue #5: Revisar y corregir problemas con el carrito
2. Issue #7: Implementar gestión de cookies rechazable
3. Issue #8: Corregir checkbox de privacidad pre-marcado
4. Issue #15: Activar cuenta WooCommerce para recibir pedidos

### Altas (hacer pronto):
1. Issue #1: Actualizar texto del servicio de instalación
2. Issue #3: Agregar condiciones de venta en primera página
3. Issue #4: Agregar identificación del titular
4. Issue #6: Cambiar nombre en ticket del banco
5. Issue #9: Crear sección de menú para CCTV
6. Issue #10: Crear productos NVR
7. Issue #11: Crear productos Cámaras Mini Domo
8. Issue #12: Crear productos Cámaras Turret
9. Issue #13: Crear productos Cámaras Bullet
10. Issue #16: Resolver error de cuota de IA

### Medias (planificar):
1. Issue #2: Modificar link en página "Acerca de"
2. Issue #14: Actualizar CSV de productos con CCTV
3. Issue #17: Crear copia del sitio para Brasil

---

## 🔧 Orden de Implementación Recomendado

### Fase 1: Legal y Funcionalidad Crítica (Semana 1)
1. Corregir checkbox de privacidad (Issue #8)
2. Implementar cookies rechazables (Issue #7)
3. Corregir problemas del carrito (Issue #5)
4. Activar WooCommerce (Issue #15)
5. Agregar condiciones de venta (Issue #3)
6. Agregar identificación titular (Issue #4)

### Fase 2: Contenido y Configuración (Semana 2)
1. Actualizar texto instalación (Issue #1)
2. Cambiar nombre ticket banco (Issue #6)
3. Modificar link "Acerca de" (Issue #2)
4. Resolver error cuota IA (Issue #16)

### Fase 3: Productos CCTV (Semana 3-4)
1. Crear sección menú CCTV (Issue #9)
2. Crear productos NVR (Issue #10)
3. Crear productos Mini Domo (Issue #11)
4. Crear productos Turret (Issue #12)
5. Crear productos Bullet (Issue #13)
6. Actualizar CSV (Issue #14)

### Fase 4: Expansión (Futuro)
1. Crear sitio Brasil (Issue #17)

---

## 📝 Notas Importantes

- Hacer backup completo antes de comenzar cambios importantes
- Testear en entorno de staging antes de producción
- Documentar todos los cambios realizados
- Obtener aprobación del cliente en cambios de contenido
- Obtener imágenes de productos CCTV del cliente
- Verificar cumplimiento RGPD en todos los formularios
- Mantener coherencia en naming de productos
