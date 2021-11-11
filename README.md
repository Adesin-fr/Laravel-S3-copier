# Simple S3 Copier


This laravel project is meant to be used from the command line.
It just exposes a single command `adesin:s3-copy` that copies all the contents from the source bucket to the destination 
bucket. 

Each bucket can be on a different region / provider : I used it to move files from Amazon S3 to Scaleway which provides 
a less expensive, S3 compatible hosting service.

## How to use it 

Just copy the `.env.example` file to `.env` and edit it to suit your needs.

**IMPORTANT NOTE : the default settings I used are setting cache and public options on destination files. 
Set them as needed in `config/filesystems.php` **

When your settings are correct, just run `php artisan adesin:s3-copy` and let it run.

PS : if you don't have a beefy internet connection, run it on a server with large bandwidth !



Made freely by ADESIN.FR Nov. 2021 !
