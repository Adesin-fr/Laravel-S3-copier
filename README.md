## Simple S3 Copier


This laravel project is meant to be used from the command line.
It just exposes a single command `adesin:s3-copy` that copies all the contents from the source bucket to the destination 
bucket. 

Each bucket can be on a different region / provider : I used it to move files from Amazon S3 to Scaleway which provides 
a less expensive, S3 compatible hosting service.

Just copy the `.env.example` file to `.env` and edit it to suit your needs.

**IMPORTANT NOTE : the default settings I used are setting cache and public options on destination files. 
Set them as needed in `config/filesystems.php` **
