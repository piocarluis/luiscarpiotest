# luiscarpiotest
horusmusic

The project is developed in symfony 6.3.1 with docker.

To start the project, open a command window and run the command git clone https://github.com/piocarluis/luiscarpiotest.git or download the project .zip.

The next step is to access the project folder by command to initialize the container. Execute:

```
docker-compose build
docker-compose up -d
docker exec -it app-tlc bash
```


You should run the command
composer install

To create the database tables you must execute the commands
```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

We can open a database client and connect to the database
host: 127.0.0.1
user: root
password: tlcpass
database: tlc

To test the requested functions we can do it with postman

endpoint http://localhost/circle/5.0
method: GET

endpoint http://localhost/triangle/3.0/4.0/5.0
method: GET

endpoint http://localhost/circle/sum-objects
method: POST
body select form-data:
key value
object1 {"radius":5}
object2 {"radius":5}

endpoint http://localhost/triangle/sum-objects
method: POST
body select form-data:
key value
object1 {"a":3,"b":4,"c":5}
object2 {"a":3,"b":4,"c":5}


I added persistence to the database for each GET method consumed.



Finally, after the tests, the container must be stopped with the command
```
docker compose down
```
