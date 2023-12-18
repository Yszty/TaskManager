## Steps to install project:
- Clone this repository.
- Copy `.env.example` to `.env`
- Go to `docker-stack` folder.
- Run `docker compose build`.
- Run `docker compose up -d`.
- Run `docker compose exec fpm prepare-project.sh`.
- Visit website by browser ie.(http://127.0.0.1)

## Steps to run tests:
- Complete installation steps
- Go to `docker-stack` folder.
- Run `docker compose exec fpm ./vendor/bin/pest --testdox`


## Postman endpoints documentation:
- Import Postman endpoints documentation from `R.postman_collection.json`
