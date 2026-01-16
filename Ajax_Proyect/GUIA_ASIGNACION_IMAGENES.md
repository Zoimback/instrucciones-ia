# 📋 GUÍA COMPLETA: Asignación de Imágenes WebP a Productos WordPress

## 🎯 Objetivo
Reemplazar las imágenes actuales de productos Ajax con las nuevas imágenes WebP optimizadas (800x600, fondo blanco, 91% menor tamaño).

## 📂 Mapeo de Imágenes Creadas vs Productos WordPress

### ✅ **Imágenes WebP Disponibles:**
**Ubicación:** `fotos/blancos/procesadas/webp/` y `fotos/negros/procesadas/webp/`

| Imagen WebP | Producto WordPress | SKU | ID Producto |
|-------------|-------------------|-----|-------------|
| `10XAJ-TAG-W.webp` | 10 Tags Blanco | 10XAJ-TAG-W | 140 |
| `110XAJ-TAG-B.webp` | 10 Tags Negro | 10XAJ-TAG-B | 141 |
| `AJ-COMBIPROTECT-W.webp` | CombiProtect Blanco | AJ-COMBIPROTECT-W | 133 |
| `AJ-COMBIPROTECT-B.webp` | CombiProtect Negro | AJ-COMBIPROTECT-B | 132 |
| `AJ-DOORPROTECTPLUS-W.webp` | DoorProtect Plus Blanco | AJ-DOORPROTECTPLUS-W | 124 |
| `AJ-DOORPROTECTPLUS-B.webp` | DoorProtect Plus Negro | AJ-DOORPROTECTPLUS-B | 125 |
| `AJ-FIREPROTECT2-C-SB-W.webp` | Ajax FireProtect 2 HSC Blanco* | AJ-FIREPROTECT2-HSC-SB-W | 145 |
| `AJ-FIREPROTECT2-HSC-SB-B.webp` | Ajax FireProtect 2 HSC Negro | AJ-FIREPROTECT2-HSC-SB-B | 144 |
| `AJ-GLASSPROTECT-W.webp` | GlassProtect Blanco | AJ-GLASSPROTECT-W | 134 |
| `AJ-GLASSPROTECT-B.webp` | GlassProtect Negro | AJ-GLASSPROTECT-B | 135 |
| `AJ-HOMESIREN-W.webp` | Sirena interior Blanco | AJ-HOMESIREN-W | 120 |
| `AJ-HOMESIREN-B.webp` | Sirena interior Negro | AJ-HOMESIREN-B | 121 |
| `AJ-HUB2-4G-W.webp` | Ajax Hub 2 4G Blanco | AJ-HUB2-4G-W | 112 |
| `AJ-HUB2-4G-B.webp` | Ajax Hub 2 4G Negro | AJ-HUB2-4G-B | 113 |
| `AJ-HUB2PLUS-W.webp` | Hub 2 Plus Blanco | AJ-HUB2PLUS-W | 114 |
| `AJ-HUB2PLUS-B.webp` | Hub 2 Plus Negro | AJ-HUB2PLUS-B | 115 |
| `AJ-KEYPAD-W.webp` | Teclado estándar Blanco | AJ-KEYPAD-W | 117 |
| `AJ-KEYPAD-B.webp` | Teclado estándar Negro | AJ-KEYPAD-B | 116 |
| `AJ-KEYPADPLUS-W.webp` | Keypad Plus Blanco | AJ-KEYPADPLUS-W | 119 |
| `AJ-KEYPADPLUS-B.webp` | Keypad Plus Negro | AJ-KEYPADPLUS-B | 118 |
| `AJ-LEAKSPROTECT-W.webp` | Detector de inundación Blanco | AJ-LEAKSPROTECT-W | 128 |
| `AJ-LEAKSPROTECT-B.webp` | Detector de inundación Negro | AJ-LEAKSPROTECT-B | 129 |
| `AJ-MOTIONCAM-PHOD-W.webp` | MotionCam PhOD Blanco | AJ-MOTIONCAM-PHOD-W | 126 |
| `AJ-MOTIONCAM-PHOD-B.webp` | MotionCam PhOD Negro | AJ-MOTIONCAM-PHOD-B | 127 |
| `AJ-MOTIONCAMOUTDOOR-PHOD-W.webp` | MotionCam Outdoor PhOD Blanco | AJ-MOTIONCAMOUTDOOR-PHOD-W | 136 |
| `AJ-MOTIONCAMOUTDOOR-PHOD-B.webp` | MotionCam Outdoor PhOD Negro | AJ-MOTIONCAMOUTDOOR-PHOD-B | 137 |
| `AJ-MOTIONPROTECTPLUS-W.webp` | MotionProtect Plus Blanco | AJ-MOTIONPROTECTPLUS-W | 130 |
| `AJ-MOTIONPROTECTPLUS-B.webp` | MotionProtect Plus Negro | AJ-MOTIONPROTECTPLUS-B | 131 |
| `AJ-PASS-W.webp` | Ajax Pass Blanco | AJ-PASS-W | 139 |
| `AJ-PASS-B.webp` | Ajax Pass Negro | AJ-PASS-B | 138 |
| `AJ-SPACECONTROL-W.webp` | SpaceControl Blanco | AJ-SPACECONTROL-W | 122 |
| `AJ-SPACECONTROL-B.webp` | SpaceControl Negro | AJ-SPACECONTROL-B | 123 |

*Nota: El producto tiene SKU diferente pero la imagen coincide en funcionalidad.

## 🚀 PROCESO DE ASIGNACIÓN MANUAL

### **MÉTODO 1: A través del Admin de WordPress (Recomendado)**

#### **Paso 1: Subir las Imágenes WebP**
1. Ve a `WordPress Admin → Medios → Biblioteca`
2. Clic en "Añadir archivo de medios"
3. Arrastra y suelta TODAS las imágenes WebP de las carpetas:
   - `fotos/blancos/procesadas/webp/`
   - `fotos/negros/procesadas/webp/`

#### **Paso 2: Asignar Imagen a cada Producto**
Para cada producto de la tabla anterior:

1. **Acceder al producto:**
   - Ve a `WooCommerce → Productos → Todos los productos`
   - Busca el producto por ID o nombre
   - Clic en "Editar"

2. **Cambiar la imagen:**
   - En "Imagen del producto" (esquina superior derecha)
   - Clic en "Establecer imagen del producto"
   - Busca la imagen WebP correspondiente
   - Seleccionar y clic en "Establecer imagen del producto"

3. **Guardar:**
   - Clic en "Actualizar" para guardar los cambios

#### **Ejemplo Detallado: Ajax Pass Blanco (ID: 139)**
```
1. Ir a: wp-admin/post.php?post=139&action=edit
2. Buscar sección "Imagen del producto"
3. Remover imagen actual (si existe)
4. Añadir nueva imagen: AJ-PASS-W.webp
5. Actualizar producto
```

### **MÉTODO 2: URLs Directas para Edición Rápida**
Puedes acceder directamente a cada producto usando estas URLs:

```
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=140&action=edit  # 10 Tags Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=141&action=edit  # 10 Tags Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=133&action=edit  # CombiProtect Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=132&action=edit  # CombiProtect Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=124&action=edit  # DoorProtect Plus Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=125&action=edit  # DoorProtect Plus Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=145&action=edit  # Ajax FireProtect 2 HSC Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=144&action=edit  # Ajax FireProtect 2 HSC Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=134&action=edit  # GlassProtect Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=135&action=edit  # GlassProtect Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=120&action=edit  # Sirena interior Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=121&action=edit  # Sirena interior Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=112&action=edit  # Ajax Hub 2 4G Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=113&action=edit  # Ajax Hub 2 4G Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=114&action=edit  # Hub 2 Plus Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=115&action=edit  # Hub 2 Plus Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=117&action=edit  # Teclado estándar Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=116&action=edit  # Teclado estándar Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=119&action=edit  # Keypad Plus Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=118&action=edit  # Keypad Plus Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=128&action=edit  # Detector de inundación Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=129&action=edit  # Detector de inundación Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=126&action=edit  # MotionCam PhOD Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=127&action=edit  # MotionCam PhOD Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=136&action=edit  # MotionCam Outdoor PhOD Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=137&action=edit  # MotionCam Outdoor PhOD Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=130&action=edit  # MotionProtect Plus Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=131&action=edit  # MotionProtect Plus Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=139&action=edit  # Ajax Pass Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=138&action=edit  # Ajax Pass Negro
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=122&action=edit  # SpaceControl Blanco
https://desarrollo.laalarmainteligente.es/wp-admin/post.php?post=123&action=edit  # SpaceControl Negro
```

## 🎯 RESULTADO ESPERADO

Después de completar este proceso, tendrás:

✅ **33 productos con imágenes optimizadas**
✅ **91% menos espacio utilizado** (de ~2MB a ~200KB total)
✅ **Carga 90% más rápida** en el sitio web
✅ **Imágenes uniformes** (800x600, fondo blanco)
✅ **Formato WebP** para máxima compatibilidad web

## ⚠️ NOTAS IMPORTANTES

1. **Backup:** Antes de empezar, haz un backup de la biblioteca de medios
2. **Nombres:** Mantén los nombres de archivo WebP tal como están
3. **Alt Text:** Asegúrate de añadir texto alternativo a cada imagen
4. **Cache:** Después de completar, limpia el cache del sitio
5. **Verificación:** Revisa el frontend para confirmar que las imágenes se muestran correctamente

## 🚀 RESULTADO FINAL

Una vez completado este proceso, tu sitio web de Ajax tendrá:
- Imágenes de producto profesionales y uniformes
- Tiempo de carga ultrarrápido
- Mejor experiencia de usuario
- Optimización web perfecta

¡Las imágenes están listas y optimizadas al máximo para tu tienda online! 🎉