# ACT5_5Z - Guía para agentes

## Contexto

Aplicación web PHP para la gestión de recursos humanos, centrada en operaciones CRUD de empleados. Usa MySQL mediante `mysqli`, Composer para el autoload y dependencias, y Bootstrap 4 para parte de la interfaz.

## Estructura

- `index.php`: página principal y composición de la estructura común.
- `src/config/`: configuración general de rutas y conexión a la base de datos.
- `src/models/`: modelos y acceso a datos; 
    - `Model`: clase abstracta que tiene la función `all()`: representa una `select` de SQL
    - `Employee` hereda de `Model`. Implementa las funciones `save()` y `destroy()` representando `insert/update` y `delete` de SQL
- `src/html/Employees/`: páginas de la interfaz relacionadas con el CRUD `employees`.
- `src/html/includes/`: cabecera, navegación y pie compartidos.
- `src/css/estils.css`: estilos propios.

## Convenciones de trabajo

- Mantén PHP y la organización actual por namespaces (`models` y `config`); respeta el autoload PSR-4 definido en `composer.json`.
- Reutiliza los includes compartidos y las constantes `BASE_PATH` y `BASE_URL` para rutas del proyecto.
- Conserva el idioma y el estilo de la pantalla que estés modificando; la interfaz actual está principalmente en inglés y los comentarios existentes mezclan catalán y español.
- Para consultas con valores variables, usa consultas preparadas de `mysqli`. Escapa los datos dinámicos al imprimirlos en HTML.
- No añadas credenciales ni datos locales de conexión al repositorio. La aplicación carga la configuración de la base de datos desde un archivo externo; respeta ese mecanismo y no lo sustituyas por valores incrustados en el código.
- Mantén los cambios acotados al comportamiento solicitado y sigue los patrones ya presentes antes de introducir nuevas dependencias o capas.

## Validación

- No hay comandos de test definidos en `composer.json`.
- Para validar cambios en PHP, ejecuta `php -l` sobre cada archivo PHP modificado.
- Si cambias una operación de datos o una página CRUD, revisa el flujo afectado y verifica que las rutas compartidas y la conexión a la base de datos sigan usándose correctamente.