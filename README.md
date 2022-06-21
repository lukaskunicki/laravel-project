# Football Team Manager

A Laravel-based web application prepared as a university project.

**Structure**

The application follows the MVC conception, where we can distinguish these five main models:

- Player
  Each logged in user can create a player assigned to his club. Later on, the user can update or delete the player. Listing players is available for everyone.

- Club

  Each logged in user can create a club and assignee it to the league. Later on, the user can update or delete the club. Listing clubs is available for everyone. Listing clubs and associated players is a available for everyone

- League

  Each logged in admin user can create a league, update, or delete it. Listing leagues and associated clubs is available for everyone.

- Position
  Each logged in admin user can create a position, update, or delete it. Listing positions and associated players is available for everyone.

- Nationality
  Each logged in admin user can create a nationality, update, or delete it. Listing nations and associated players is available for everyone.

CRUD operations have been prepared for all of them, taking into the consideration different user roles.

Most of the tables use different type of relations, including one-to-many, or many-to-many (which has been created with a pivot table `player_position`). The foreign key operations have been accomplished with the Eloquent Relations. 

The database structure has been prepared with migrations. Also, the default admin user `admin@gmail.com` with password `pass123` will be created during the initial run. 

The controllers work in a standard way, handling the CRUD operations. Players and Clubs Controllers implement the search method, which returns the query result as a JSON objects. The search call is performed with the JavaScript Fetch API on the frontend.

Routes have been defined for all the paths, including the authentication middleware.

The frontend layer has been prepared with bootstrap ui.

**Running the app**

1. Make sure that you've installed all the dependencies with `composer install`
2. Install the frontend dependencies with `npm install && npm run dev`
3. Run migrations with `php artisan migrate`
4. Run up the server with `php artisan serve`

