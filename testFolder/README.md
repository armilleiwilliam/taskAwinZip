README FILE:

Preface.

First, thanks for allowing me to take this test. 

Yesterday I crashed my Mac and after hours of trying to fix it I ended up working on my laptop which doesn't have php 7 installed,
so, I couldn't test it with php 7 format coding. 
In order to show you my skills in coding with php 7 I've decided to make another copy of the test 
in php 7 standard, but as I can not run it I'm not sure it will work, I've created it only to show you
my skills in coding in format php 7 (type hint etc.). So, please, run the php 5 version copy because 
I've never tested the php 7 version.
Because of spending the most of the day in fixing my Mac while I was trying take the test I wasn't able
to code the testing part, something I know I'd be able to do.  
I know the deadline is Wednesday morning, but let me know if you want me to finish that part. 
 

INSTALLATION:

 - copy and paste the folder src in your symfony application

 - update paramenters.yml, copy and paste services.yml file in config folder and update kernel.php with the new bundle

 - composer install/update

 - once parameters.yml is updated run "php bin/console doctrine:database:create"
 
 - run "php bin/console doctrine:schema:update --force"

 - load manually the dump of the MySql database (merchantstransactions.sql)


RUN the application:

 - on the terminal/shell access the project folder

 - run "php bin/console demo:generateReport"

 - a bit different from what I've been asked you will see immediately the list of all transactions,
   then you can decide to produce a list of transactions per number id or brand name, not only 
   number id as I was asked. Once entered the value the engine service will convert the currency previously listed in
   EURO, DOLLAR or POUNDS only in POUNDS currency.  
