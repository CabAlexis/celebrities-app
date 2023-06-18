
# Profile Browser

Create profiles





## Installation

Clone the project

Install [Docker](https://www.docker.com/products/docker-desktop/)

```bash
    composer install

    ./vendor/bin/sail up -d
    ./vendor/bin/sail migrate

    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
```

### Generate data

```bash
    ./vendor/bin/sail php artisan tinker
    App\Models\Profile::factory()->count(5)->create()
```    