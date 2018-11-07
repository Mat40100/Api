# Api

Hello, 

Here is my Api, the goal is to provide clients' users' informations, and our product informations, in collection, or in detail for both.
The api administrator is able to add or edit clients, watch products, and watch a full list of users.

it's coded in symfony PHP, you don't need to be used to it to install it. 

Here is how to install the api : 
  - Clone repository to your server; https://github.com/mat40100/Api.git
  - While in the project root launch "composer install";

  - Edit .Env in the root project : 
      - change the Database line to yours;
      - Add SSL key dir; -> it's mandatory for JWT authentication
      - Add SSL pem dir; -> same
      
  - in terminal launch succesively:
      - "php bin/console doctrine:database:create"
      - "php bin/console doctrine:schema:create"
      
      If you want users and client fixtures:
      - "php bin/console doctrine:fixtures:load --append"
      
      If you don't want users and client fixtures, delete "ClientFixtures and UserFixtures" in "/src/Fixtures" then :
        - "php bin/console doctrine:fixtures:load --append" -> it will create an Admin;
        - go to you db and change the admin as you wish; -> like password, or username 
      
      now, you application should work, but you still have not cache-system even if varnish is installed.
      
      To install varnish with https application, you have to setup varnish for SSL termination, to do so, follow instruction from this link : 
        - https://bash-prompt.net/guides/apache-varnish/ -> to install the module;
        - to understand it : http://varnish-cache.org/


