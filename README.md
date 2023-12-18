## Steps to install project:
- Clone this repository.
- Copy `.env.example` to `.env`
- Go to `docker` folder.
- Run `docker compose build`.
- Run `docker compose up -d`.
- Run `docker compose exec fpm prepare-project.sh`.
- Visit website by browser ie.(http://127.0.0.1)

## Steps to run tests:
- Complete installation steps
- Go to project folder
- Run `./vendor/bin/phpunit tests --testdox`


## Postman endpoints documentation:
- Import Postman endpoints documentation from `R.postman_collection.json`
