#!/usr/bin/env python3
"""
Script para convertir imágenes PNG a formato WebP optimizado para web
- Convierte todas las imágenes PNG procesadas a WebP
- Optimiza el tamaño de archivo manteniendo alta calidad
- Crea versiones web-optimizadas

Requisitos:
    pip install Pillow

Uso:
    python convertir_a_webp.py
"""

import os
import glob
from PIL import Image
import sys

# Configuración
WEBP_QUALITY = 85  # Calidad WebP (0-100), 85 es óptimo para web
WEBP_METHOD = 4   # Método de compresión (0-6), 4 es balance calidad/velocidad
LOSSLESS = False  # True para sin pérdida (archivos más grandes), False para lossy optimizado

def convert_png_to_webp(png_path, webp_path):
    """
    Convierte una imagen PNG a WebP optimizado
    """
    try:
        print(f"Convirtiendo: {os.path.basename(png_path)}")
        
        with Image.open(png_path) as img:
            # Configurar parámetros de WebP
            save_kwargs = {
                'format': 'WebP',
                'quality': WEBP_QUALITY,
                'method': WEBP_METHOD,
                'lossless': LOSSLESS
            }
            
            # Guardar como WebP
            img.save(webp_path, **save_kwargs)
            
            # Obtener tamaños de archivo para comparación
            original_size = os.path.getsize(png_path)
            webp_size = os.path.getsize(webp_path)
            reduction = ((original_size - webp_size) / original_size) * 100
            
            print(f"✓ {os.path.basename(webp_path)}")
            print(f"  📊 Reducción: {reduction:.1f}% ({original_size//1024}KB → {webp_size//1024}KB)")
            
            return True
            
    except Exception as e:
        print(f"✗ Error convirtiendo {png_path}: {str(e)}")
        return False

def create_webp_directory(png_dir):
    """
    Crea el directorio para archivos WebP
    """
    webp_dir = os.path.join(png_dir, 'webp')
    os.makedirs(webp_dir, exist_ok=True)
    return webp_dir

def get_webp_filename(png_path):
    """
    Genera el nombre del archivo WebP
    """
    filename = os.path.basename(png_path)
    name, ext = os.path.splitext(filename)
    
    # Reemplazar _processed.png con .webp
    if name.endswith('_processed'):
        name = name.replace('_processed', '')
    
    return name + '.webp'

def main():
    """
    Función principal
    """
    print("🔄 Iniciando conversión PNG → WebP...")
    print(f"📐 Calidad WebP: {WEBP_QUALITY}%")
    print(f"⚙️  Método: {WEBP_METHOD} | Lossless: {LOSSLESS}")
    print("-" * 50)
    
    # Obtener el directorio base
    script_dir = os.path.dirname(os.path.abspath(__file__))
    fotos_dir = os.path.join(script_dir, 'fotos')
    
    if not os.path.exists(fotos_dir):
        print(f"❌ No se encontró el directorio: {fotos_dir}")
        sys.exit(1)
    
    # Buscar todas las imágenes PNG en las carpetas procesadas
    png_pattern = os.path.join(fotos_dir, '*', 'procesadas', '*.png')
    png_files = glob.glob(png_pattern)
    
    if not png_files:
        print("❌ No se encontraron imágenes PNG procesadas para convertir")
        print(f"🔍 Buscando en: {png_pattern}")
        sys.exit(1)
    
    print(f"📊 Se encontraron {len(png_files)} imágenes PNG para convertir a WebP\n")
    
    # Procesar cada imagen PNG
    converted_count = 0
    error_count = 0
    total_original_size = 0
    total_webp_size = 0
    
    # Agrupar archivos por directorio
    directories = {}
    for png_file in png_files:
        dir_path = os.path.dirname(png_file)
        if dir_path not in directories:
            directories[dir_path] = []
        directories[dir_path].append(png_file)
    
    # Procesar cada directorio
    for png_dir, files in directories.items():
        print(f"\n📁 Procesando: {os.path.basename(os.path.dirname(png_dir))}")
        
        # Crear directorio WebP
        webp_dir = create_webp_directory(png_dir)
        
        for png_file in files:
            try:
                # Generar nombre de archivo WebP
                webp_filename = get_webp_filename(png_file)
                webp_path = os.path.join(webp_dir, webp_filename)
                
                # Convertir PNG a WebP
                if convert_png_to_webp(png_file, webp_path):
                    converted_count += 1
                    # Acumular tamaños para estadísticas
                    total_original_size += os.path.getsize(png_file)
                    total_webp_size += os.path.getsize(webp_path)
                else:
                    error_count += 1
                    
            except Exception as e:
                print(f"✗ Error general con {png_file}: {str(e)}")
                error_count += 1
    
    # Calcular reducción total
    total_reduction = 0
    if total_original_size > 0:
        total_reduction = ((total_original_size - total_webp_size) / total_original_size) * 100
    
    # Resumen final
    print("\n" + "="*60)
    print("📈 RESUMEN DE CONVERSIÓN PNG → WebP")
    print("="*60)
    print(f"✅ Imágenes convertidas: {converted_count}")
    print(f"❌ Errores: {error_count}")
    print(f"📊 Total procesadas: {len(png_files)}")
    print(f"📉 Reducción total de tamaño: {total_reduction:.1f}%")
    print(f"💾 Espacio ahorrado: {(total_original_size - total_webp_size)//1024:.0f}KB")
    
    if converted_count > 0:
        print(f"\n🎉 ¡Conversión completada!")
        print(f"📂 Las imágenes WebP están en las carpetas 'webp' dentro de cada directorio procesadas/")
        print(f"🌐 Formato optimizado para web con {WEBP_QUALITY}% de calidad")
        
        # Mostrar estructura de directorios
        print(f"\n📁 Estructura creada:")
        print(f"   fotos/")
        print(f"   ├── blancos/procesadas/webp/")
        print(f"   └── negros/procesadas/webp/")
    else:
        print(f"\n⚠️  No se convirtió ninguna imagen")

if __name__ == "__main__":
    main()