@echo off
echo ========================================
echo    PROCESADOR DE IMAGENES AJAX
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

REM Instalar Pillow si no está instalado
pip show Pillow >nul 2>&1
if %errorlevel% neq 0 (
    echo Instalando Pillow...
    pip install Pillow
)

echo.
echo Iniciando procesamiento de imágenes...
echo.

REM Ejecutar el script de Python
python procesar_imagenes.py

echo.
echo ========================================
echo    PROCESAMIENTO COMPLETADO
echo ========================================
pause