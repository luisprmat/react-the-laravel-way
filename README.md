# Puppies App

This app is a transformation from React + API separated into a monolith Laravel Inertia app.

## Used tecnologies

Some differences with original course are:

- **Laravel React Starter Kit** now uses **fortify** for authentication instead of App Controllers
- We use **Wayfinder** instead of **Ziggy** for routes and actions
- We use the new **`<Form>`** component from **Inertia**

## Seeders

This app uses _seeder_ to generate the first puppies, the images must be downloaded from [**react-from-scratch-template**](https://github.com/luisprmat/react-from-scratch-template/tree/main/public/images) github repository.

### Prompt example to generate new puppies

We use this prompt in _VSCode_ to generate new puppies with the downloaded images (with Claude Sonnet 4.0)

> make 100 more puppies with the same shape and using images from 1.jpg to 22.jpg using the same format and append to this array

## Pagination

We test a AI prompt (ChatGPT) to generate types for the frontend pagination

> Generate frontend types for Laravel 12 Pagination - i'm building a React and Inertia app and want the type signature for paginated results to use in the frontend
>
> https://laravel.com/docs/12.x/eloquent-resources#pagination

## Localization

We decided to keep support for several languages (at first _Spanish_) using the [**Laravel Lang**](https://laravel-lang.com/contributions.html#for_laravel_lang_projects) tools using exclusive keys for this app.

To achieve this we have created a `translations` folder and we have installed the package `laravel-lang/status-generator` (as a _dev_ dependency).

### How does this work?

- Any new translation key must be added in the file `translations/source/app.json`.
- We run the command `vendor/bin/lang sync --path=translations`. This generates the new keys for each locale (placed in `translations/locales/{locale}/json.json` file)
- Now we must translate the new keys for each locale.
- If we need to know the pending keys to translate we must run the command `vendor/bin/lang status --path=translations` and take a look at [**`translations/docs/status.md`**](./translations/docs/status.md) where it appears the status of app translations.
- Then we can run `php artisan lang:update` to merge the updated keys in the Laravel's locales files properly.
