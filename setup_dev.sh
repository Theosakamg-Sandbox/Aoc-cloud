./composer.phar install

php app/console doctrine:database:drop --force
php app/console doctrine:database:create 
php app/console doctrine:schema:update --force
php app/console doctrine:schema:validate
echo y|php app/console doctrine:fixture:load

./app/console assets:install web --symlink --relative
rm -rf app/cache/prod/*
rm -rf app/cache/dev/*
php app/console cache:clear --env=dev
php app/console cache:clear --env=prod
