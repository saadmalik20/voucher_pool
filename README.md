# Voucher Pool with slim Framework

## Prerequisites:
- PHP >= 7.1.3
- Lumen 5.6.3
- Mod Rewrite Enabled

## Deployment:
- Run composer install, to cover all dependencies (if you dont have all vendors inside `vendors/` directory)

> $ composer install 

- Run migration command for databse migration 

> $ php vendor/bin/phinx migrate -c config-phinx.php

## Sample Request:
- URL: http://localhost/voucher_pool/public/vouchers/generate
- METHOD: GET
- JSON REQUEST: {"Vouchers generated succesfully"}

## API Postman Data
Import postman sample data file from "postman" directory in project

## Tests
Go to project directory in terminal and execute below command:

> $ ./vendor/bin/phpunit ./tests/Functional/VouchersTest.php

## API Documentation
API documentation is provided inside apidoc/index.html file for details

Note: You may also regenerate by using below command:

> $ sudo npm install apidoc -g   # If not already installed

> $ apidoc -i ./src/Controllers/ -o apidoc/

- API Doc URL: http://localhost/voucher_pool/apidoc/