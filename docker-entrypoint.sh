#!/bin/bash
set -e

sed -i "s/DB_HOST=.*/DB_HOST=${DB_HOST}/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" .env

php artisan config:clear

echo "Waiting for database..."
until php artisan migrate --force 2>/dev/null; do
  sleep 3
done

php artisan db:seed --force 2>/dev/null || true

mkdir -p storage/app/public/images
if [ ! -f storage/app/public/images/laskar-pelangi.jpg ]; then
    echo "Downloading book covers..."
    declare -A covers=(
        ["laskar-pelangi.jpg"]="2506428"
        ["bumi-manusia.jpg"]="8234551"
        ["negeri-5-menara.jpg"]="10484345"
        ["dilan-1990.jpg"]="12776335"
        ["perahu-kertas.jpg"]="11414407"
        ["sang-pemimpi.jpg"]="10484346"
        ["harry-potter-batu-bertuah.jpg"]="10521270"
        ["the-alchemist.jpg"]="8739161"
        ["atomic-habits.jpg"]="10519463"
        ["rich-dad-poor-dad.jpg"]="8091013"
        ["sherlock-holmes.jpg"]="8091014"
        ["filosofi-teras.jpg"]="10519460"
        ["default.jpg"]="12818862"
    )
    for filename in "${!covers[@]}"; do
        curl -sL "https://covers.openlibrary.org/b/id/${covers[$filename]}-L.jpg" \
            -o "storage/app/public/images/${filename}" || true
    done
fi

php artisan storage:link 2>/dev/null || true
php artisan serve --host=0.0.0.0 --port=8000
