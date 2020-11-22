[![Tests Actions Status](https://github.com/StefanoCbt/phpdotenv-sync/workflows/Tests/badge.svg)](https://github.com/StefanoCbt/phpdotenv-sync/actions)
[![Tests Actions Status](https://github.com/StefanoCbt/phpdotenv-sync/workflows/Codequality/badge.svg)](https://github.com/StefanoCbt/phpdotenv-sync/actions)

# phpdotenv-sync
A package that makes sure that your .env file is in sync with your .env.example

## Usage
```
TODO...
```

## Development
##### testing CHECK command into development environment (execute from project root dir):
```
php bin/phpdotenvsync --opt=check --src="./bin/dev_testing/.env.example" --dest="./bin/dev_testing/.env"
```

## Codequality tests

##### phpcs
```
automatic fix with phpcs:
php vendor/bin/phpcbf --standard=PSR12 -n -p src/
```