@echo off
echo ========================================
echo    CONVERSOR PNG A WEBP - AJAX
echo ========================================
echo.

REM Verificar si Python está instalado
python --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Python no está instalado o no está en el PATH
    echo Por favor, instala Python desde https://www.python.org/
    pause
    exit /b 1
)

echo Verificando dependencias...

REM Verificar que Pillow esté instalado
pip show Pillow >nul 2>&1
if %errorlevel% neq 0 (
    echo Instalando Pillow...
    pip install Pillow
)

echo.
echo Iniciando conversión PNG a WebP...
echo Este proceso optimizará todas las imágenes PNG para web
echo.

REM Ejecutar el script de conversión
python convertir_a_webp.py

echo.
echo ========================================
echo    CONVERSIÓN COMPLETADA
echo ========================================
pause