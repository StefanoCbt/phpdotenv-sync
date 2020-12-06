[![Tests Actions Status](https://github.com/StefanoCbt/phpdotenv-sync/workflows/Tests/badge.svg)](https://github.com/StefanoCbt/phpdotenv-sync/actions)
[![Tests Actions Status](https://github.com/StefanoCbt/phpdotenv-sync/workflows/Codequality/badge.svg)](https://github.com/StefanoCbt/phpdotenv-sync/actions)

# phpdotenv-sync
A package that makes sure that your .env file is in sync with your .env.example

## Usage
requiring the library with composer:
```
composer require stefanocbt/phpdotenv-sync
```
using the library:
phpdotenv-sync has the following operations:
- check: to check diffs between two dotenv files (Example: .env.example and .env)
- sync: to sync two dotenv files (add missing dotenv parameters to destination dotenv file)

#### Executing:
```
./vendor/bin/phpdotenvsync [options]

Options:
    --opt[=OPT]               Specify the right operation (Required) ("check" or "sync")
    --src[=SOURCE]            Specify the source dotenv file (Optional) (default: current-folder-path/.env.example)
    --dest[=DESTINATION]      Specify the destination dotenv file (Optional) (default: current-folder-path/.env)
```

for --src and --dest options you can use absolute and/or relative paths. If, for example, you have the files inside the current pwd folder but dotenv files have different filenames you can launch phpdotenvsync this way:
```
./vendor/bin/phpdotenvsync --opt=sync --src=./[SRC_FILENAME] --dest=./[DEST_FILENAME]
```

or if you want to specify an absolute path: 
```
./vendor/bin/phpdotenvsync --opt=sync --src=/absolute/path/to/[SRC_FILENAME] --dest=/absolute/path/to/[DEST_FILENAME]
```


## Development
##### testing CHECK command into development environment (execute from project root dir):
```
php bin/phpdotenvsync --opt=check --src="./bin/dev_testing/.env.example" --dest="./bin/dev_testing/.env"
```
#### testing SYNC command into development environment (execute from project root dir):
```
php bin/phpdotenvsync --opt=sync --src="./bin/dev_testing/.env.example" --dest="./bin/dev_testing/.env"
```

## Codequality tests

##### phpcs
```
automatic fix with phpcs:
php vendor/bin/phpcbf --standard=PSR12 -n -p src/
```