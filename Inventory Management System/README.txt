1) After extracting the zip file, paste the "inventory" folder in "htdocs" folder (path: C:\xampp\htdocs)
2) Create a database "inventory" in phpmyadmin and run these sql commands in the shell:
	use inventory;
	set global net_buffer_length=1000000; 
	set global max_allowed_packet=1000000000;
3) Now Import the SQL dump("inventory.sql") provided in the "inventory" folder. 
4) Now open "index.php" in phpmyadmin. It will redirect you to the login page.
5) Click on Create an account. Create an account with proper details.
6) Then click Register. You will be logged in and redirected to the home page.