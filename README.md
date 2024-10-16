# Laravel Tools

Une suite d'utilitaires

## Installation

### Ajouter Liwe/Tools a un autre projet Laravel

Dans `composer.json`, ajouter:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/lieberweiss/laravel-tools.git"
    }
],
```

> L'URL contient un deploy token qui a accès en lecture à ce dépôt. Il ne doit pas être utilisé dans un projet public.

Puis lancer:

```
composer require lieberweiss/laravel-tools
```

Pour le développement, il est aussi possible de faire un lien direct sur un dossier qui contient apperia-core:

- Cloner apperia-core à côté du projet qui utilise le package
- Utiliser le type `path` dans `composer.json`:
  ```json
  "repositories": [ { "type": "path", "url": "../laravel-tools" } ],
  ```

Installer le packet

## DUMP command

Permet de faire un dump en JSON d'une table en base de données

```sh
php artisan liwe-tools:dump App\\Models\\User
```

## Generic seeder

Permet d'insérer de la données provenant d'un fichier JSON.

Le fichier doit se trouver dans `ROOT/database/seeders/json/*`.

```php
use Liwe\Tools\Seeders\GenericJsonSeeder;

class TicketSeeder extends GenericJsonSeeder
{
    protected $model = \App\Models\User::class;
}
```
