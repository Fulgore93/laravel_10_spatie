# laravel_10_spatie 
 
## Introducción
Proyecto laravel 10 con un login simple, junto con roles y permisos ocupando la herramienta spatie.

## Instalación
Para instalar esto, debes seguir las siguientes indicaciones
- Tener php 8.2 y composer acorde a la versión de php
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate

# Ejemplos de uso
Para ver los ejemplos de uso, puedes hacer lo siguiente:
- Ir a la ruta /
- Si quieres autenticarte debes ingresar lo siguiente:
- - user1:
- - - email: user1@user.com
- - - password: user1
- - user2:
- - - email: user2@user.com
- - - password: user2
- ambos usuarios pueden acceder a la ruta /redirect1, pero sólo el user1 puede acceder a /redirect2
- puedes consultar el archivo web.php para más información sobre protección de las rutas.

# Instrucciones
## Para el login
- controlador con métodos de login y logout
- en el modelo usuario se realizó lo siguiente para poder autenticar al usuario ocupando el método attempt teniendo en el modelo usuario campos custom:
- - public function usu_email(){ return 'usu_email';}
- - public function getAuthPassword(){ return $this->usu_password;}
- en config/auth:
- - buscamos la variable model, que por defecto se le asigna una clase 'User', la cambiamos por la clase 'Usuario', quedando:
- - - 'model' => App\Models\Usuario::class,
- en app/Http/Middleware/Authenticate.php
- - por defecto, al no estar con una sesión iniciada, nos redirige a route('login'), pero nuestra ruta para logear no se llama 'login', se llama 'welcome' o el nombre que tu quieras, quedando:
- - - return $request->expectsJson() ? null : route('welcome');
- en app/Http/Middleware/RedirectIfAuthenticated.php
- - por defecto, al estar con una sesión iniciada e ir a la url base o /, nos redirige a redirect(RouteServiceProvider::HOME), pero queremos que ocupe una de nuestras rutas definidas, en mi caso 'redirect1', quedando:
- - - return redirect()->route('redirect1');

## Para aplicar lo de este repositorio, se requiere:
- laravel 10 con php 8 y composer acorde a la versión de php
- composer require spatie/laravel-permission 5.8
- en config/app.php, dentro de providers agregar:
- - Spatie\Permission\PermissionServiceProvider::class,
- ejecutar php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
- limpiar el caché con php artisan optimize:clear
- php artisan migrate (si quieres agregar más colunas a las tablas de roles o permisos, lo puedes hacer editando permission tables dentro de migrations) 
- agregar al modelo usuario: use HasRoles
- Para crear tus propios roles y permisos:
- - crea un archivo seeder o migración, según quieras, similar al archivo 2023_05_18_198713_permisos.php
- - para crear un permiso, debes escribir Permission::create(['name' => 'nombrePermiso']);
- - para crear un rol y asignarle permisos, debes escribir: 
- - - $nombreRol = Role::create(['name' => 'nombreRol']);
- - - $nombreRol->givePermissionTo(['nombrePermiso']);
- ejecutar la migracion o el seeder
- en app/Http/kernel.php
- - dentro del array middlewareAliases, se debe agregar lo siguiente:
- - - 'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
- - - 'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
- - - 'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
- agregar middleware a las rutas según corresponda
- agregar '@can('nombrePermiso') 'ruta con permisos' @endcan' en las vistas blade, para mostrar u ocultar según si el usuario puede acceder al contenido o no.

# Referencias
- https://spatie.be/docs/laravel-permission/v5/installation-laravel
- https://laravel.com/docs/10.x/releases

## Bitácora

Fecha | Descripcion | Acciones
| :-- | :-: | :-:
18-05-2022 18:11 | instalación de proyecto | Ejecutar _composer install_ y _php artisan migrate:fresh_
