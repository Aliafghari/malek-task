# malek-task

<h2>how it's run:</h2>

<p>1. clone project</p>

<p>2. update packages</p>

```
composer update
```

<p>3. copy .env file</p>

```
cp .env.example .env
```

<p>4. Generate key</p>

```
php artisan key:generate
```


<p>5. Instal npm packages</p>

```
npm install
```

<p>6. npm run dev</p>

```
npm run dev
```

<p>7.create migrate & seed</p>

```
php artisan migrate --seed
```

<p>8. Run Server</p>

```
php artisan serve
```

#################################

<h1>Description:</h1>

<p>1- This app works with mailhog.</p>

<p>2- To run the 60 second timer, type the following command in the terminal:</p>

```
php artisan schedule:work
```

<p>3-ENV file setting:</p>


APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=malek-task
DB_USERNAME=root
DB_PASSWORD=

MEMCACHED_HOST=127.0.0.1

MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"