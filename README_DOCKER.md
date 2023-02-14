# Hackers/Founders

## Guide to run with Docker
- Run `cp .env.example.docker .env`
- Run `docker compose up --build`
- After have builded the container, run `cp hfglobal.conf docker/nginx/`
- To install php dependencies run `./composer.sh install`
- To install JavaScript dependencies run `npm install` then `npm run dev`
- Run `./php-artisan.sh migrate` to migrate DB.
- To start the container run `docker compose up -d`
- To stop the container run `docker compose down`