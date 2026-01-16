#!/usr/bin/env python3
"""
Script para convertir imágenes de cualquier formato a WebP optimizado para web
- Convierte: PNG, JPG, JPEG, AVIF, GIF, BMP, TIFF
- Optimiza el tamaño de archivo manteniendo alta calidad
- Crea versiones web-optimizadas

Requisitos:
    pip install Pillow pillow-avif-plugin

Uso:
    python convertir_a_webp.py [directorio_origen] [directorio_destino]
    
    Si no se especifican directorios, usa los valores por defecto.
"""

import os
import glob
import sys
import argparse

try:
    from PIL import Image
except ImportError:
    print("❌ Error: Pillow no está instalado. Ejecuta: pip install Pillow")
    sys.exit(1)

# Intentar importar soporte para AVIF
try:
    import pillow_avif
    AVIF_SUPPORT = True
except ImportError:
    AVIF_SUPPORT = False
    print("⚠️ Advertencia: pillow-avif-plugin no instalado. Los archivos .avif no se convertirán.")
    print("   Para soporte AVIF ejecuta: pip install pillow-avif-plugin")

# Configuración
WEBP_QUALITY = 85  # Calidad WebP (0-100), 85 es óptimo para web
WEBP_METHOD = 4    # Método de compresión (0-6), 4 es balance calidad/velocidad
LOSSLESS = False   # True para sin pérdida (archivos más grandes), False para lossy optimizado

# Extensiones de imagen soportadas
SUPPORTED_EXTENSIONS = ['.png', '.jpg', '.jpeg', '.gif', '.bmp', '.tiff', '.tif']
if AVIF_SUPPORT:
    SUPPORTED_EXTENSIONS.append('.avif')


def convert_image_to_webp(input_path, output_path):
    """
    Convierte una imagen de cualquier formato soportado a WebP optimizado
    """
    try:
        print(f"Convirtiendo: {os.path.basename(input_path)}")
        
        with Image.open(input_path) as img:
            # Convertir a RGB si es necesario (para formatos con transparencia usar RGBA)
            if img.mode in ('RGBA', 'LA', 'P'):
                # Mantener transparencia
                if img.mode == 'P':
                    img = img.convert('RGBA')
            elif img.mode != 'RGB':
                img = img.convert('RGB')
            
            # Configurar parámetros de WebP
            save_kwargs = {
                'format': 'WebP',
                'quality': WEBP_QUALITY,
                'method': WEBP_METHOD,
                'lossless': LOSSLESS
            }
            
            # Guardar como WebP
            img.save(output_path, **save_kwargs)
            
            # Obtener tamaños de archivo para comparación
            original_size = os.path.getsize(input_path)
            webp_size = os.path.getsize(output_path)
            reduction = ((original_size - webp_size) / original_size) * 100
            
            print(f"✓ {os.path.basename(output_path)}")
            print(f"  📊 Reducción: {reduction:.1f}% ({original_size//1024}KB → {webp_size//1024}KB)")
            
            return True, original_size, webp_size
            
    except Exception as e:
        print(f"✗ Error convirtiendo {input_path}: {str(e)}")
        return False, 0, 0


def get_webp_filename(image_path):
    """
    Genera el nombre del archivo WebP (elimina sufijos como _processed)
    """
    filename = os.path.basename(image_path)
    name, ext = os.path.splitext(filename)
    
    # Limpiar sufijos comunes de procesamiento
    suffixes_to_remove = ['_processed', '_original', '_optimized', '-300x300']
    for suffix in suffixes_to_remove:
        if name.endswith(suffix):
            name = name[:-len(suffix)]
    
    return name + '.webp'


def find_images(source_dir, recursive=True):
    """
    Encuentra todas las imágenes soportadas en el directorio
    """
    images = []
    
    if recursive:
        for ext in SUPPORTED_EXTENSIONS:
            # Buscar con extensión en minúsculas
            pattern = os.path.join(source_dir, '**', f'*{ext}')
            images.extend(glob.glob(pattern, recursive=True))
            # Buscar con extensión en mayúsculas
            pattern = os.path.join(source_dir, '**', f'*{ext.upper()}')
            images.extend(glob.glob(pattern, recursive=True))
    else:
        for ext in SUPPORTED_EXTENSIONS:
            pattern = os.path.join(source_dir, f'*{ext}')
            images.extend(glob.glob(pattern))
            pattern = os.path.join(source_dir, f'*{ext.upper()}')
            images.extend(glob.glob(pattern))
    
    # Eliminar duplicados y excluir archivos .webp existentes
    images = list(set(images))
    images = [img for img in images if not img.lower().endswith('.webp')]
    
    return sorted(images)


def main():
    """
    Función principal
    """
    parser = argparse.ArgumentParser(
        description='Convierte imágenes de cualquier formato a WebP optimizado'
    )
    parser.add_argument(
        'source', 
        nargs='?',
        help='Directorio de origen con las imágenes'
    )
    parser.add_argument(
        'dest',
        nargs='?', 
        help='Directorio de destino para los WebP'
    )
    parser.add_argument(
        '--quality', '-q',
        type=int,
        default=WEBP_QUALITY,
        help=f'Calidad WebP (0-100, default: {WEBP_QUALITY})'
    )
    parser.add_argument(
        '--no-recursive', '-nr',
        action='store_true',
        help='No buscar en subdirectorios'
    )
    
    args = parser.parse_args()
    
    # Determinar directorios
    # El script está en ajax/.github/scripts/, la carpeta ajax está 2 niveles arriba
    script_dir = os.path.dirname(os.path.abspath(__file__))
    ajax_dir = os.path.abspath(os.path.join(script_dir, '..', '..'))
    
    if args.source:
        source_dir = os.path.abspath(args.source)
    else:
        # Default: ajax/img/no_optimizadas
        source_dir = os.path.join(ajax_dir, 'img', 'no_optimizadas')
    
    if args.dest:
        dest_dir = os.path.abspath(args.dest)
    else:
        # Default: ajax/img/optimizadas
        dest_dir = os.path.join(ajax_dir, 'img', 'optimizadas')
    
    # Usar calidad especificada
    webp_quality = args.quality
    
    print("🔄 Iniciando conversión a WebP...")
    print(f"📂 Origen: {source_dir}")
    print(f"📂 Destino: {dest_dir}")
    print(f"📐 Calidad WebP: {webp_quality}%")
    print(f"📋 Formatos soportados: {', '.join(SUPPORTED_EXTENSIONS)}")
    print("-" * 60)
    
    # Verificar directorio origen
    if not os.path.exists(source_dir):
        print(f"❌ No se encontró el directorio de origen: {source_dir}")
        sys.exit(1)
    
    # Crear directorio destino
    os.makedirs(dest_dir, exist_ok=True)
    
    # Buscar imágenes
    recursive = not args.no_recursive
    images = find_images(source_dir, recursive=recursive)
    
    if not images:
        print("❌ No se encontraron imágenes para convertir")
        print(f"🔍 Buscando en: {source_dir}")
        sys.exit(1)
    
    # Mostrar resumen de archivos encontrados
    print(f"\n📊 Se encontraron {len(images)} imágenes para convertir:\n")
    
    # Agrupar por extensión para mostrar
    by_extension = {}
    for img in images:
        ext = os.path.splitext(img)[1].lower()
        by_extension[ext] = by_extension.get(ext, 0) + 1
    
    for ext, count in sorted(by_extension.items()):
        print(f"   {ext}: {count} archivos")
    
    print("")
    
    # Procesar imágenes
    converted_count = 0
    error_count = 0
    skipped_count = 0
    total_original_size = 0
    total_webp_size = 0
    
    for image_path in images:
        try:
            # Generar nombre de archivo WebP
            webp_filename = get_webp_filename(image_path)
            webp_path = os.path.join(dest_dir, webp_filename)
            
            # Verificar si ya existe
            if os.path.exists(webp_path):
                print(f"⏭️ Ya existe: {webp_filename}")
                skipped_count += 1
                continue
            
            # Convertir imagen
            success, orig_size, webp_size = convert_image_to_webp(image_path, webp_path)
            
            if success:
                converted_count += 1
                total_original_size += orig_size
                total_webp_size += webp_size
            else:
                error_count += 1
                
        except Exception as e:
            print(f"✗ Error general con {image_path}: {str(e)}")
            error_count += 1
    
    # Calcular reducción total
    total_reduction = 0
    if total_original_size > 0:
        total_reduction = ((total_original_size - total_webp_size) / total_original_size) * 100
    
    # Resumen final
    print("\n" + "=" * 60)
    print("📈 RESUMEN DE CONVERSIÓN A WebP")
    print("=" * 60)
    print(f"✅ Imágenes convertidas: {converted_count}")
    print(f"⏭️ Omitidas (ya existían): {skipped_count}")
    print(f"❌ Errores: {error_count}")
    print(f"📊 Total procesadas: {len(images)}")
    
    if converted_count > 0:
        print(f"📉 Reducción total de tamaño: {total_reduction:.1f}%")
        print(f"💾 Espacio ahorrado: {(total_original_size - total_webp_size)//1024:.0f}KB")
        print(f"\n🎉 ¡Conversión completada!")
        print(f"📂 Las imágenes WebP están en: {dest_dir}")
    else:
        print(f"\n⚠️ No se convirtió ninguna imagen nueva")


if __name__ == "__main__":
    main()
