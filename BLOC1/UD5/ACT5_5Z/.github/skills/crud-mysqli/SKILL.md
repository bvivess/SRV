---
name: crud-mysqli
description: Completa o modifica las páginas CRUD de esta aplicación PHP usando los métodos existentes all(), save() y destroy() de Model.php y Employee.php. Úsala para tareas de listado, alta, edición o eliminación de empleados y entidades equivalentes.
---

# Skill: CRUD usando los modelos existentes

## Objetivo

Completar el CRUD de `ACT5_5Z` aprovechando la arquitectura y los métodos de acceso a datos que ya existen. La prioridad es reutilizar el código preparado por el usuario, mantener los cambios pequeños y no crear una segunda capa de acceso a datos.

## 1. Inspección breve antes de cambiar código

1. Lee `AGENTS.md`.
2. Inspecciona `src/models/Model.php`, `src/models/Employee.php`, `src/html/Employees/Employees_list.php`, los includes y la configuración existente.
3. Respeta namespaces, autoload, rutas, estilo e idioma de la aplicación.
4. No supongas columnas ni reglas de negocio que no estén documentadas en el código o en el esquema disponible.
5. Expón un plan breve y modifica solo los archivos necesarios para la tarea solicitada.

## 2. Métodos de modelo que debes reutilizar

El acceso a datos CRUD debe hacerse mediante los métodos ya preparados:

- **Lectura/listado:** usa `Employee::all()` (método estático heredado de `Model`) para obtener la lista de empleados. El método devuelve un array de objetos `Employee`.
- **Guardar:** construye o rellena un objeto `Employee` con los datos validados y llama a `$employee->save()`.
- **Eliminar:** crea o rellena un objeto `Employee` con el `employee_id` validado y llama a `$employee->destroy()`.

No escribas SQL directamente en las páginas PHP ni dupliques en ellas la lógica de `Model` o `Employee`. No crees métodos como `getAll()`, `insert()`, `update()` o `delete()` alternativos, ni cambies la arquitectura, salvo que el usuario lo solicite o que sea imprescindible para una operación que los métodos actuales no permiten. En ese caso, explica primero la limitación y propone el cambio mínimo; no lo ocultes bajo una implementación paralela.

## 3. Respeta el comportamiento real de los métodos

Antes de implementar una operación, verifica qué hace realmente el método correspondiente. No des por hecho que un método llamado `save()` cubre todos los casos de alta y modificación.

En la versión actual del proyecto:

- `Model::all()` obtiene las columnas de la tabla asociada mediante `static::$table`, consulta sus filas y construye objetos de la clase heredada.
- `Employee::save()` solo continúa si `employee_id` está informado. Ejecuta un `INSERT ... ON DUPLICATE KEY UPDATE`, por lo que no admite actualmente el alta normal con identificador omitido/autogenerado; si la tarea requiere esa modalidad de alta, informa de esta limitación y pide autorización o plantea el cambio mínimo en `save()` antes de implementarlo.
- `Employee::destroy()` requiere `employee_id` y elimina el empleado si existe.
- No se ha definido en el modelo un método específico para recuperar un único empleado por ID. No inventes que existe. Si una pantalla de edición necesita cargar un registro, explica esta limitación y propone una solución coherente con el diseño actual antes de añadir otro método o una consulta directa.

Conserva las firmas y la semántica de estos métodos siempre que sea posible. Si detectas un defecto que impide la operación solicitada, explica el problema y el cambio mínimo necesario; no alteres silenciosamente su comportamiento.

## 4. Reglas para las páginas y formularios

- Las páginas reciben datos de la petición, los validan y delegan la persistencia en los métodos del modelo.
- Valida en el servidor los campos requeridos, los tipos, formatos y el `employee_id` antes de crear o utilizar el objeto.
- Escapa los valores dinámicos al generar HTML, por ejemplo con `htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')`.
- Las acciones que cambian datos (guardar o eliminar) deben usar `POST`, no enlaces `GET`.
- Si ya existe protección CSRF, reutilízala. Si no existe, indica esa carencia y propone añadir una protección basada en sesión para las acciones que modifican datos.
- Muestra mensajes comprensibles al usuario, sin revelar consultas SQL, credenciales, trazas ni detalles internos.
- No cambies el diseño general ni añadas dependencias si no son necesarias para la tarea.

## 5. Base de datos y configuración

- Respeta la configuración externa de conexión que ya utiliza el proyecto. No introduzcas credenciales ni una configuración paralela.
- No cambies la ruta de configuración ni el esquema de la base de datos sin autorización expresa.
- No modifiques `vendor/` ni archivos generados por Composer.
- No ejecutes operaciones destructivas sobre datos reales ni hagas cambios de esquema fuera del alcance solicitado.
- Las consultas y operaciones SQL deben permanecer en los modelos existentes, no en las páginas de presentación.

## 6. Validación y comunicación

Después de realizar cambios:

1. Revisa el diff y elimina cambios que no sean necesarios.
2. Ejecuta `php -l` sobre cada archivo PHP modificado.
3. Si existe una base de datos de pruebas disponible, comprueba el flujo afectado con datos de prueba. No afirmes que las pruebas de integración se han realizado si no pudiste ejecutarlas.
4. Comprueba que las páginas llaman a `all()`, `save()` y `destroy()` según corresponda y no contienen SQL duplicado.
5. Informa de los archivos modificados, los comandos y pruebas realmente ejecutados, y cualquier limitación pendiente.

Mantén el alcance acotado. No intentes completar o refactorizar todo el CRUD si el usuario solo ha pedido una operación concreta.
