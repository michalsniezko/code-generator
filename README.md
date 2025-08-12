This application generates random, unique codes and saves them to a file at a path provided by the user. It also allows downloading that file via a form in the browser.

The number of characters in each code and the total number of codes are set by the user.

To test the app:

1. Run `composer install`  
2. Install Symfony CLI: https://symfony.com/download  
3. Run the server with `symfony serve`  
4. Open your browser at `localhost:8000`

To test via CLI, use the command `php bin/console generate`, for example:

- Windows:  
  `php bin/console generate 10 20 'C:\Users\Michael\codes.txt'`

- Linux/MacOS:  
  `php bin/console generate 50 10 '/Users/michalsniezko/mycodes.txt'`

I used CLI arguments instead of options because options are always optional, but here the user must provide the number of codes, the length of each code, and the file path.

If no absolute path is given, the app creates the file relative to its document root.

I chose to use the temporary filesystem (`tmp`) for creating files on the fly.
