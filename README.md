# plots


### Requirements:

PHP >=7.3 (exec function should be enabled for php-fpm)

Python >= 3.5 and following packages must be installed, and the web server must have permission to run the python script and and must have access to package. (For development purpose I recommend  install python package using the following command  sudo pip3 -H install <package-name>)

* pandas
* matplotlib
* mpld3
* io
* base64
* sys

Apache Web server must have mod_rewirte engine active

__Sample apache vhost__

```.conf
<virtualhost *:80>
ServerName plot.deeprahman.test
ServerAlias plot.deeprahman.test
DocumentRoot /var/www/plots
<Directory /var/www/plots>
    AllowOverride All
 </Directory>
ErrorLog /var/www/plots/logs/error.log
CustomLog /var/www/plots/logs/access.log combined
</virtualhost>
```

Address of the home page: http://your_domain_name.com/home


_Note_: The file upload system is not implemented (but can be easily be implemented).  And Graph configuration option are hard coded for the given data file in the DataFiles . 
