
# Profile Browser

A little app to create star profiles, so you'll never forget which series you saw that famous star in!


## Installation

Clone the project

Install [Docker](https://www.docker.com/products/docker-desktop/)

```bash
    composer install

    cp .env.example .env
```
Use the .env data (cf. mail)


Optional (set alias for sail): 
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

(if alias is set use sail instead of ./vendor/bin/sail
)
```bash
    ./vendor/bin/sail up -d
    ./vendor/bin/sail php artisan key:generate
    ./vendor/bin/sail php artisan storage:link
    ./vendor/bin/sail php artisan migrate

    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
```

### Generate fake data

```bash
    ./vendor/bin/sail php artisan tinker
    App\Models\Profile::factory()->count(5)->create()
```    