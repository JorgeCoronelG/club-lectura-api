# Club de Lectura – API

API REST para la gestión de un club de lectura: libros, autores, préstamos, multas, donaciones, usuarios, roles y menús de navegación, además de un dashboard con estadísticas.

## Tecnologías

- PHP 8.2 y Laravel 10
- Laravel Sanctum (autenticación por token)
- Spatie Laravel Data
- Intervention Image (imágenes de portada de los libros)
- MySQL 8
- Docker y Docker Compose

## Requisitos

Solo necesitas [Docker](https://www.docker.com/) con Docker Compose. No hace falta instalar PHP, Composer ni MySQL.

## Levantar el proyecto

1. Clona el repositorio y entra a la carpeta:

   ```bash
   git clone <url-del-repositorio>
   cd club-lectura-api
   ```

2. Construye y levanta los contenedores:

   ```bash
   docker compose up --build
   ```

   La primera vez tarda unos minutos. Al arrancar, el contenedor `app` automáticamente:

   - crea el archivo `.env` a partir de `.env.example`,
   - instala las dependencias con Composer,
   - genera la `APP_KEY`,
   - espera a que MySQL esté listo y ejecuta las migraciones,
   - crea el enlace simbólico de `storage`.

3. (Primera vez) Carga los datos iniciales en otra terminal:

   ```bash
   docker compose exec app php artisan db:seed
   ```

La API queda disponible en **http://localhost:8000**.

### Servicios

| Servicio | Descripción                                 | Puerto (host) |
|----------|---------------------------------------------|---------------|
| `app`    | API Laravel (`php artisan serve`)           | 8000          |
| `queue`  | Worker de colas (`php artisan queue:work`)  | –             |
| `db`     | MySQL 8                                     | 3307          |

Puedes conectarte a la base de datos desde un cliente externo con host `127.0.0.1`, puerto `3307`, usuario `root`, contraseña `secret` y base de datos `club_lectura`.

### Usuario de prueba

El seeder crea un usuario administrador:

- **Correo:** `admin@example.com`
- **Contraseña:** `password`

## Comandos útiles de Docker

```bash
# Levantar en segundo plano
docker compose up -d

# Ver los logs
docker compose logs -f app

# Ejecutar comandos de Artisan
docker compose exec app php artisan <comando>

# Reiniciar la base de datos con datos de prueba
docker compose exec app php artisan migrate:fresh --seed

# Ejecutar las pruebas
docker compose exec app php artisan test

# Abrir una terminal dentro del contenedor
docker compose exec app bash
```

## Bajar el proyecto

```bash
# Detener y eliminar los contenedores (conserva los datos de la base de datos)
docker compose down

# Detener y eliminar contenedores Y los datos de la base de datos
docker compose down -v

# Además, eliminar las imágenes construidas
docker compose down -v --rmi local
```

## Notas

- Este entorno Docker está pensado para **desarrollo**; usa el servidor integrado de Laravel y credenciales de ejemplo.
- Al iniciar, el contenedor sobrescribe las variables `DB_*` del archivo `.env` con las del `docker-compose.yml`. Si quieres ejecutar el proyecto fuera de Docker, vuelve a poner tus valores locales.
- La URL del front-end permitida se configura con `APP_URL_WEB` (por defecto `http://localhost:4200`).
