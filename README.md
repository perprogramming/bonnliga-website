# Website of the football tournament series "Bonnliga" in Bonn, Germany

## Installation

```bash
curl -s http://getcomposer.org/installer | php
php composer.phar install
```

## Create / Update database
```bash
app/console doctrine:database:create
app/console doctrine:migrations:migrate
app/console doctrine:fixtures:load
```

