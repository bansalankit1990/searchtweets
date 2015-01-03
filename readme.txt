The source code folder is having the folder named kay that is the directory that you have to copy and put at the location from where you want to run.


Steps to deploy and run the code:

>Point your apache to the directory you put this code.
Ex : I created the kay folder at location /Office/kay
Create a kay.conf file at /etc/apache2/sites-available/kay.conf
with content:
<VirtualHost *:80>
     DocumentRoot /Office/kay/
     ServerName local.kay.com
     <Directory  /Office/kay/>
         Require all granted
         AllowOverride All
     </Directory>
     ErrorLog ${APACHE_LOG_DIR}/kay_error
</VirtualHost>


>Enable this site:
sudo a2ensite kay.conf


>Make hosts entry at /etc/hosts 
127.0.0.1       local.kay.com

>Restart apache - sudo service apache2 restart

>Give persmission to kay folder if required


>write follwing in url -> http://local.kay.com/

>If you have done setup correctly you will se the results something like show in screenshot attached in screenshot directory.

