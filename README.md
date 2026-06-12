# AnakKayu.id - CodeIgniter 4 Company Profile CMS

AnakKayu.id adalah aplikasi fullstack CodeIgniter 4 untuk website company profile, landing page modern classic, CMS artikel, katalog produk, katalog layanan, portfolio, inquiry, share konten, SEO, dan social media content import/generator.

## Stack

- CodeIgniter 4.7
- CodeIgniter Shield
- MySQL/MariaDB
- Bootstrap
- Skote Admin Template-ready layout pada `public/assets/skote`
- Custom public landing page pada `public/assets/anakkayu`

## Quick Start

```bash
composer install
copy .env.example .env
php spark key:generate
php spark migrate --all
php spark db:seed AnakKayuSeeder
php spark serve
```

Login admin awal memakai `.env`:

- URL: `http://localhost:8080/login`
- Email: `ANAKKAYU_ADMIN_EMAIL`
- Password: `ANAKKAYU_ADMIN_PASSWORD`

Segera ganti password default setelah login.

## Git Setup

```bash
git init
git add .
git commit -m "init anakkayu codeigniter company profile cms"
git remote add origin <URL_REPOSITORY_GITHUB>
git branch -M main
git push -u origin main
```

## Dokumentasi

Dokumentasi teknis tersedia di folder `docs`, mulai dari instalasi, arsitektur, database, role permission, workflow CMS, social import, SEO, testing, deployment, sampai roadmap.

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.2 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - The end of life date for PHP 8.1 was December 31, 2025.
> - If you are still using below PHP 8.2, you should upgrade immediately.
> - The end of life date for PHP 8.2 will be December 31, 2026.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
