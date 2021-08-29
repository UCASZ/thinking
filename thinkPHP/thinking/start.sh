#!/bin/bash
service nginx restart
cd /var/www/html/t* && php think run &

/usr/bin/tail -f /dev/null
