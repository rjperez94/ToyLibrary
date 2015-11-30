# ToyLibrary

#Setup
1. Download and install XAMPP from <a href="https://www.apachefriends.org/index.html">here</a>
2. Start Apache and MySQL module (You may need to install their respective services)
3. Go to <a href="http://localhost/phpmyadmin/">http://localhost/phpmyadmin/</a> on your browser
4. Create a database using root account and name it `toylib` with collation `utf8_general_ci` and DB type `InnoDB`
5. Then go to Import tab, and import `Documentation/DB Files/toylib FINAL.sql`
6. Go to Loaned table, click `Structure -> Relation View`. 
7. Set loaned.ToyID to relate to toys.ToyID. Also set loaned.CustomerID to relate to members.CustomerID
8. Go to Toys table, click Structure. Go to the Indexes dropdown Index “Toy (10)” and “Category (5)”
9. Click on User accounts and at the bottom, the console and execute the query at:
 `Documentation -> DB Files -> users and privileges.txt`
10. Based on the above setup, your database account should now have the passwords at:
 `Documentation -> DB Files -> users pass toylib.txt`
10. Open directory `XAMPP -> apache -> conf -> httpd.conf`
11. Look for line "Options Indexes FollowSymLinks Includes ExecCGI" (w/o quotes). Delete word "Indexes"
12. Open directory `XAMPP -> php -> php.ini`
13. Look for line "extension=php_openssl.dll" (w/o quotes). Make sure it has no semicolon before the line. If it has, delete it
14. Open directory `XAMPP -> htdocs` and make a new folder called `toylib` (You may change the name, if you want)
15. Clone this repository to that `toylib` folder. You may exclude the Documentation folder as you wish

You can now view the site my going to <a href="localhost/toylib">http://localhost/phpmyadmin/</a> in your browser. <strong>Make sure that the Apache and MySQL modules are started before you do this</strong>


Please <a href="https://github.com/rjperez94/ToyLibrary/blob/master/Documentation/Brief%20for%203.41.pdf">click here</a> for more information about this project
