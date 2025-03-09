# Symfony repository template 

### Requirements

- php 8.3+ (`php -v`)
- Composer 2.8+ (`composer --version`)
- Docker 26+ (`docker --version`)
- Docker compose 2.27+ (`docker compose version`)

### How to start

- In the top right corner, click "Use this template" > "Create new repository"
- `git clone {your new repo}`
- `cd {your new repo}`
- `cp .env.example .env`
- Make sure docker daemon is running locally
- To start the project : simply run `sh ./start.sh` in your terminal
- To run tests : run `sh ./test.sh` in your terminal
- Access `http://127.0.0.1/api/v1/health-check` to check that the api is up
- Access `http://127.0.0.1/api/v1/db-health-check` to check that the database is up

### Pipeline includes

- Lint (PSR-12)
- Static analysis
- Architectural tests
- Unit tests
- Integration tests

 
