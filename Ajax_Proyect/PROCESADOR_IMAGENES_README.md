# Procesador de Imágenes Ajax

Este script procesa automáticamente todas las imágenes en las carpetas `fotos/*/*` para:
- ✅ Añadir un fondo blanco a todas las imágenes
- ✅ Redimensionar todas las imágenes a la misma relación de aspecto (800x600 por defecto)
- ✅ Mantener la calidad de las imágenes
- ✅ Soportar múltiples formatos: JPG, PNG, WebP, AVIF, BMP, TIFF

## 📋 Requisitos

- Python 3.6 o superior
- Pillow (se instala automáticamente)

## 🚀 Uso Rápido (Windows)

1. **Doble clic en `procesar_imagenes.bat`**
   - El script automáticamente verificará e instalará las dependencias necesarias
   - Procesará todas las imágenes encontradas

## 🛠️ Uso Manual

### Instalación de dependencias
```bash
pip install -r requirements.txt
```

### Ejecución del script
```bash
python procesar_imagenes.py
```

## 📁 Estructura de salida

Las imágenes procesadas se guardan en carpetas `procesadas` dentro de cada subdirectorio:

```
fotos/
├── blancos/
│   ├── imagen1.jpg
│   ├── imagen2.png
│   └── procesadas/
│       ├── imagen1_processed.png
│       └── imagen2_processed.png
└── negros/
    ├── imagen3.webp
    ├── imagen4.avif
    └── procesadas/
        ├── imagen3_processed.png
        └── imagen4_processed.png
```

## ⚙️ Configuración

Puedes modificar las siguientes variables en `procesar_imagenes.py`:

```python
TARGET_SIZE = (800, 600)  # Tamaño objetivo (ancho, alto)
BACKGROUND_COLOR = (255, 255, 255, 255)  # Color de fondo (RGBA)
OUTPUT_FORMAT = 'PNG'  # Formato de salida ('PNG' o 'JPEG')
QUALITY = 95  # Calidad para JPEG (1-100)
PROCESSED_SUFFIX = '_processed'  # Sufijo para archivos procesados
```

## 📊 Funcionalidades

### ✨ Procesamiento Inteligente
- **Fondo Blanco**: Añade automáticamente un fondo blanco a imágenes transparentes
- **Relación de Aspecto**: Mantiene las proporciones originales añadiendo padding blanco
- **Centrado**: Las imágenes se centran automáticamente en el nuevo tamaño
- **Optimización**: Las imágenes se optimizan para reducir el tamaño de archivo

### 🎯 Formatos Soportados
- **Entrada**: JPG, JPEG, PNG, WebP, AVIF, BMP, TIFF
- **Salida**: PNG (recomendado) o JPEG

### 🔄 Gestión de Errores
- Manejo robusto de errores
- Informes detallados del progreso
- Continuación del procesamiento aunque fallen imágenes individuales

## 📈 Ejemplo de Salida

```
🖼️  Iniciando procesamiento de imágenes...
📐 Tamaño objetivo: 800x600
🎨 Formato de salida: PNG
--------------------------------------------------
📊 Se encontraron 15 imágenes para procesar

Procesando: fotos\blancos\AJ-HUB2PLUS-W.avif
✓ Guardado en: fotos\blancos\procesadas\AJ-HUB2PLUS-W_processed.png
Procesando: fotos\blancos\AJ-KEYPAD-W.jpg
✓ Guardado en: fotos\blancos\procesadas\AJ-KEYPAD-W_processed.png
...

==================================================
📈 RESUMEN DEL PROCESAMIENTO
==================================================
✅ Imágenes procesadas: 15
❌ Errores: 0
📊 Total encontradas: 15

🎉 ¡Procesamiento completado!
📂 Las imágenes procesadas están en las carpetas 'procesadas' dentro de cada subdirectorio
```

## 🐛 Solución de Problemas

### Error: "Python no está instalado"
- Instala Python desde [python.org](https://www.python.org/)
- Asegúrate de marcar "Add to PATH" durante la instalación

### Error: "No se encontraron imágenes"
- Verifica que el script esté en la misma carpeta que la carpeta `fotos/`
- Revisa que las imágenes estén en subcarpetas dentro de `fotos/`

### Error de memoria con imágenes muy grandes
- Reduce el `TARGET_SIZE` en la configuración
- Procesa las imágenes en lotes más pequeños

## 📝 Notas

- Las imágenes originales **no se modifican**
- Se crean nuevas imágenes procesadas en carpetas separadas
- El script es seguro de ejecutar múltiples veces
- Compatible con Windows, macOS y Linux