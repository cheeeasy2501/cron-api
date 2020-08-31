# Run scheduler
while [ true ]
do
  /usr/local/bin/php /var/www/html/artisan schedule:run --verbose --no-interaction
  sleep 5
done
