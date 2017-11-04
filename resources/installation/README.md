## Instalation RouterKhan System Login and Registration.

- 1
	- Create the file .HTACCESS and include the contents of HTACCESS.txt in Root Directory.

- 2
	- Config URL Root in bootstrap/Services/default.php 

	```php
		$container::bind("url", function(){ 
		   return "https://myurl.com"; 
	    });
	```

- 3
    - Import **router_login.sql** in Phpmyadmin.

- 4
	- Config Database in **bootstrap/Services/default.php** in var **$database**.

- 5
    - Login Default **admin@admin.com** and **paulo2017**.