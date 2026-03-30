# Laravel API

## Requirements
- Docker
- Docker Compose
- Git

## Setup

**1. Clone the repo**
```bash
git clone <repo-url>
cd <folder-name>
```

**2. Copy environment files**
```bash
cp .env.example .env
cp src/.env.example src/.env
```

**3. Update `src/.env` with your database credentials**
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

**4. Start the containers**
```bash
docker-compose up -d --build
```

**5. Install dependencies**
```bash
docker-compose run --rm composer install
```

**6. Generate app key**
```bash
docker-compose run --rm artisan key:generate
```

**7. Run migrations**
```bash
docker-compose run --rm artisan migrate
```

The app should now be running at **http://localhost:8000**

## Commands

```bash
# Stop containers
docker-compose down

# Run the command to fetch the API from the source
docker-compose run --rm artisan app:fetch-json-api-data
```