#!/bin/bash
find /var/www/html/ -type f -mmin +30 ! -name 'index.php' ! -name 'upload.php' -delete
