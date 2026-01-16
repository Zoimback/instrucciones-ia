#!/usr/bin/env python3
"""
Script para procesar imágenes en la carpeta fotos/*/*
- Añade fondo blanco a todas las imágenes
- Redimensiona todas las imágenes a la misma relación de aspecto
- Mantiene la calidad de las imágenes

Requisitos:
    pip install Pillow

Uso:
    python procesar_imagenes.py
"""

import os
import glob
from PIL import Image, ImageOps
import sys

# Configuración
TARGET_SIZE = (800, 600)  # Tamaño objetivo (ancho, alto)
BACKGROUND_COLOR = (255, 255, 255, 255)  # Blanco con alpha
OUTPUT_FORMAT = 'PNG'  # Formato de salida
QUALITY = 95  # Calidad para JPEG (si se usa)
PROCESSED_SUFFIX = '_processed'

def get_supported_formats():
    """Retorna los formatos de imagen soportados"""
    return ['.jpg', '.jpeg', '.png', '.webp', '.avif', '.bmp', '.tiff']

def add_white_background(image):
    """
    Añade un fondo blanco a la imagen
    """
    # Si la imagen ya tiene 4 canales (RGBA), no hace falta convertir
    if image.mode != 'RGBA':
        image = image.convert('RGBA')
    
    # Crear una imagen de fondo blanco del mismo tamaño
    background = Image.new('RGBA', image.size, BACKGROUND_COLOR)
    
    # Combinar la imagen original con el fondo blanco
    combined = Image.alpha_composite(background, image)
    
    # Convertir a RGB para eliminar el canal alpha si es necesario
    if OUTPUT_FORMAT.upper() in ['JPEG', 'JPG']:
        combined = combined.convert('RGB')
    
    return combined

def resize_image_with_aspect_ratio(image, target_size):
    """
    Redimensiona la imagen manteniendo la relación de aspecto
    y añadiendo padding blanco si es necesario
    """
    # Calcular el tamaño manteniendo la relación de aspecto
    image.thumbnail(target_size, Image.Resampling.LANCZOS)
    
    # Crear una nueva imagen con el tamaño objetivo y fondo blanco
    new_image = Image.new('RGB', target_size, (255, 255, 255))
    
    # Calcular la posición para centrar la imagen
    x = (target_size[0] - image.width) // 2
    y = (target_size[1] - image.height) // 2
    
    # Pegar la imagen redimensionada en el centro
    new_image.paste(image, (x, y))
    
    return new_image

def process_image(input_path, output_path):
    """
    Procesa una imagen individual
    """
    try:
        print(f"Procesando: {input_path}")
        
        # Abrir la imagen
        with Image.open(input_path) as img:
            # Añadir fondo blanco
            img_with_background = add_white_background(img)
            
            # Redimensionar manteniendo aspecto
            processed_img = resize_image_with_aspect_ratio(img_with_background, TARGET_SIZE)
            
            # Guardar la imagen procesada
            if OUTPUT_FORMAT.upper() == 'JPEG':
                processed_img.save(output_path, OUTPUT_FORMAT, quality=QUALITY, optimize=True)
            else:
                processed_img.save(output_path, OUTPUT_FORMAT, optimize=True)
            
            print(f"✓ Guardado en: {output_path}")
            
    except Exception as e:
        print(f"✗ Error procesando {input_path}: {str(e)}")

def create_output_directory(input_path):
    """
    Crea el directorio de salida basado en el path de entrada
    """
    directory = os.path.dirname(input_path)
    output_dir = os.path.join(directory, 'procesadas')
    os.makedirs(output_dir, exist_ok=True)
    return output_dir

def get_output_filename(input_path, output_dir):
    """
    Genera el nombre del archivo de salida
    """
    filename = os.path.basename(input_path)
    name, ext = os.path.splitext(filename)
    
    # Añadir sufijo si no lo tiene
    if not name.endswith(PROCESSED_SUFFIX):
        name += PROCESSED_SUFFIX
    
    # Usar la extensión del formato de salida
    output_ext = '.png' if OUTPUT_FORMAT.upper() == 'PNG' else '.jpg'
    
    return os.path.join(output_dir, name + output_ext)

def main():
    """
    Función principal
    """
    print("🖼️  Iniciando procesamiento de imágenes...")
    print(f"📐 Tamaño objetivo: {TARGET_SIZE[0]}x{TARGET_SIZE[1]}")
    print(f"🎨 Formato de salida: {OUTPUT_FORMAT}")
    print("-" * 50)
    
    # Obtener el directorio base
    script_dir = os.path.dirname(os.path.abspath(__file__))
    fotos_dir = os.path.join(script_dir, 'fotos')
    
    if not os.path.exists(fotos_dir):
        print(f"❌ No se encontró el directorio: {fotos_dir}")
        sys.exit(1)
    
    # Buscar todas las imágenes en fotos/*/*
    supported_formats = get_supported_formats()
    image_patterns = []
    
    for fmt in supported_formats:
        image_patterns.extend([
            os.path.join(fotos_dir, '*', f'*{fmt}'),
            os.path.join(fotos_dir, '*', f'*{fmt.upper()}')
        ])
    
    # Encontrar todas las imágenes
    all_images = []
    for pattern in image_patterns:
        all_images.extend(glob.glob(pattern))
    
    if not all_images:
        print("❌ No se encontraron imágenes para procesar")
        print(f"🔍 Buscando en: {fotos_dir}/*/*")
        print(f"📁 Formatos soportados: {', '.join(supported_formats)}")
        sys.exit(1)
    
    print(f"📊 Se encontraron {len(all_images)} imágenes para procesar\n")
    
    # Procesar cada imagen
    processed_count = 0
    error_count = 0
    
    for image_path in all_images:
        try:
            # Crear directorio de salida
            output_dir = create_output_directory(image_path)
            
            # Generar nombre de archivo de salida
            output_path = get_output_filename(image_path, output_dir)
            
            # Procesar la imagen
            process_image(image_path, output_path)
            processed_count += 1
            
        except Exception as e:
            print(f"✗ Error general con {image_path}: {str(e)}")
            error_count += 1
    
    # Resumen final
    print("\n" + "="*50)
    print("📈 RESUMEN DEL PROCESAMIENTO")
    print("="*50)
    print(f"✅ Imágenes procesadas: {processed_count}")
    print(f"❌ Errores: {error_count}")
    print(f"📊 Total encontradas: {len(all_images)}")
    
    if processed_count > 0:
        print(f"\n🎉 ¡Procesamiento completado!")
        print(f"📂 Las imágenes procesadas están en las carpetas 'procesadas' dentro de cada subdirectorio")
    else:
        print(f"\n⚠️  No se procesó ninguna imagen")

if __name__ == "__main__":
    main()