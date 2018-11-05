Hi,

Thanks for giving me this opportunity.

I'm very sorry this delay but I've been very sick for the entire week and I've letterally worked on this test while I was unwell.

I hope you will see in this my interest in the position. 

please, see below the installation instructions to run this application:

- this is based on Symfony 3.1


Installation:


1) copy and paste the content of the folder src in the src folder of your application

2) copy also the folder web, that's where the csv file are stored 

3) Add composer.json and composer.lock

3) run composer install

4) this should install jsRoutingBundle which is activated adding "new FOS\JsRoutingBundle\FOSJsRoutingBundle()," to app/appKernel.php,

5) Add the following to routing.yml:

 # app/config/routing.yml
fos_js_routing:
    resource: "@FOSJsRoutingBundle/Resources/config/routing/routing.xml"

6) run "php bin/console assets:install --symlink web", this will install the assets (img/script/css)

7) Once your app/parameters.yml file is set with database configuration run "php bin/console schema:database:create" to create the database

8) run "php bin/console doctrine:schema:update", this will create the tables in the database

9) run "php bin/console demo:uploadData" to upload the dummy data into the database

10) Add services.yml file to the app/config folder

11) At this point you should be able to see the application

Any question don't hesitate to contact me.

William

 


