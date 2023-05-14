DOCKER LARAVEL PROJECT
=

---
#### features: 

* apache + php + xdebug3
* mariadb
* phpmyadmin
* .env variables
---

Deploy
-

* ```add 127.0.0.1 {sitename}``` to local hosts file
* copy .env.sample and rename to .env  in the ROOT directory
* go to (SITE FOLDER) and run ```docker-compose up -d```
* go to browser with http://{sitename} for mainpage

Links
-

* http://localhost/ - site
* http://localhost:8001/ - phpmyadmin

How to work with docker
-

* run docker-compose from cmd in storage folder
```
docker-compose up -d
```

* shutdown:
```
docker-compose down
```

Import DB
-

make import for .sql 
```
docker exec -i web4pro_mariadb mariadb new_dev -uroot -pqwerty --default-character-set=utf8 < /path/to/backup-filename.sql
```