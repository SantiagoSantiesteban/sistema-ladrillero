# LadrilloWeb – Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero

Plataforma web que conecta trabajadores y empleadores del sector ladrillero de la
vereda Patio Bonito (Nemocón) a partir de la disponibilidad por días.
Proyecto PGC 2026-2 – Universidad de Cundinamarca, Ingeniería de Sistemas y Computación.

## Funcionalidades
- Registro e inicio de sesión por rol (trabajador, empleador, administrador)
- Calendario de disponibilidad del trabajador
- Búsqueda de trabajadores por fecha o rango de días
- Vitrina de productos y directorio de contactos del sector
- Panel de administración y medición de rendimiento de consultas

## Requisitos
- PHP 8.2 o superior (probado con 8.3.35) y Composer
- Node.js 20 o superior (probado con v24.20.0) y npm
- MariaDB/MySQL (probado con MariaDB 10.4.24 en XAMPP)
- Git

## Instalación
1. Clonar el repositorio:
   `git clone https://github.com/SantiagoSantiesteban/sistema-ladrillero.git`
   y entrar a la carpeta `sistema-ladrillero`.
2. Instalar dependencias: `composer install` y `npm install`
3. Crear el archivo de entorno: copiar `.env.example` a `.env`.
4. En `.env`, **cambiar `DB_CONNECTION=sqlite` por `mysql`** y descomentar/ajustar:
```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306        # use 3307 si su XAMPP usa ese puerto
   DB_DATABASE=sistema_ladrillero
   DB_USERNAME=root
   DB_PASSWORD=
```
5. Crear la base de datos vacía:
   `mysql -u root -e "CREATE DATABASE sistema_ladrillero CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"`
   (agregue `-P 3307 -h 127.0.0.1` si usa el puerto 3307).
6. Generar la clave de la aplicación: `php artisan key:generate`
7. Crear las tablas y los usuarios de prueba: `php artisan migrate --seed`
   (crea 11 tablas: 3 de dominio —users, disponibilidades, fechas_disponibles— y 8 del framework).
8. Compilar los estilos y scripts: `npm run build`
9. Levantar el servidor: `php artisan serve` y abrir http://127.0.0.1:8000

## Usuarios de prueba
| Rol | Correo | Contraseña |
|---|---|---|
| Administrador | admin@ladrilloweb.test | Ladrillo2026! |
| Empleador | empleador@ladrilloweb.test | Ladrillo2026! |
| Trabajador (con 3 días libres desde mañana) | trabajador@ladrilloweb.test | Ladrillo2026! |

Estas cuentas son solo para pruebas locales. No use esa contraseña en un servidor real.
El rol de administrador no se puede elegir en el formulario de registro: solo lo crea el seeder.

## Pruebas automatizadas
`php artisan test`

## Respaldo y restauración de datos
- Respaldo: `mysqldump -u root -P 3307 -h 127.0.0.1 sistema_ladrillero > backup.sql`
- Restauración: `mysql -u root -P 3307 -h 127.0.0.1 sistema_ladrillero < backup.sql`
- No suba los respaldos al repositorio: contienen datos personales.

## Medición de rendimiento
Scripts y resultados en `docs/medicion/`.

## Autores
Yenderson Julián Silva Gómez · David Santiago Santiesteban Silva
