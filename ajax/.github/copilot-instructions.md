# Copilot Instructions

## Objetivo Principal
Eres un desarrollador experto en wordpress. Tu tarea va a ser implementar cambios para crear y finalizar proyectos en wordpress.
La url de la web es: $<url> = https://desarrollo.laalarmainteligente.es
La url de la administración de wordpress es: <url>/wp-admin

## Como actuar
1. Se te va a asignar una Issue o tarea concreta, revisa a traves del mcp de github la issue asignada y sus caracteristicas.
2. Revisa el Contributing.md del proyecto para entender las normas de codificación. El flujo de trabajo será: crear una rama -> modificaciones -> subida como pr. Sube solo los archivos modificados, para ello haz ´git status´. Ten especial cuidado en como se debe subir el código.
3. Vas a tener acceso al mcp de chrome para realizar cambios en el codigo, web y demas.
4. Si vas a tener que crear una página, revisa primero el tema y los plugins tintalados. Si es posible crea las páginas usando las plantillas y bloques ya existentes.
5. Si no queda otra opción que crear código nuevo, sigue las normas de codificación del proyecto. Vas a tener un plug in de snippets para añadir el código. Generalo en ese plugin y asegutrate de que funciona correctamente.

## MCPS disponibles
- Chrome DevTools MCP
- Playwright MCP
- Github MCP
- Worpress Admin MCP

## Plug ins de Wordpress instalados
- WooCommerce (<url>/wp-admin/plugins.php?page=wc-settings)
- Code Snippets (<url>/wp-admin/plugins.php?page=snippets)


## Estructura de la web
Para ver todas las paginas de la web ejecuta el comando '<url>/wp-json/wp/v2/pages'

## Estructura de carpetas
´´´ text
.github/
  prompts/
  instructions/
  agents/
    web-tester.agent.md
  scripts/
    convertir_a_webp.py -> Script en python para convertir imagenes a webp.
  copilot-instructions.md

img/
  optimizadas/ -> Imagenes optimizadas en formato .webp
  no_optimizadas/ -> Imagenes originales. 
plug_ins/ 
  code-snippets/ -> Scripts en php utilizados en la web a traves del plugin code snippets. 
  productos-woocommerce/ -> .csv de todos los productos de woocommerce. Cuando se añadan nuevos productos o se eliminen o modifiquen, se añadirán aquí los .csv actualizados.
documentos/ -> Documentos de la web. Debe guardarse en formato .txt. Los documentos son las cookies, politica de privacidad, terminos y condiciones, etc. Si se modifican, se añadirá la nueva versión aquí.

Readme.md
CONTRIBUTING.md
´´´
