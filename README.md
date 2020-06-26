Ta aplikacja tworzy losowe, unikalne kody i zapisuje je w pliku w ścieżce podanej przez użytkownika lub 
pozwala pobrać taki plik na podstawie formularza wyświetlonego w przeglądarce.

Ilość znaków w każdym kodzie oraz ilość kodów jest podawana przez użytkownika.

Aby przetestować aplikację:
1. `composer install`
2.  zainstalować CLI symfony https://symfony.com/download
3. `symfony serve`

Aby przetestować aplikację w przeglądarce, wejść na `localhost:8000`

Aby przetestować aplikację CLI użyć komendy `php bin/console generate`, na przykład:
`php bin/console generate 10 20 'C:\Users\Michael\kody.txt'`

Użyłem argumentów CLI zamiast opcji gdyż te drugie są zawsze opcjonalne,
 a w przypadku tej aplikacji użytkownik musi podać
 ilość i długość kodu oraz ścieżkę.
 
 W przypadku nie podania ścieżki absolutnej, aplikacja stworzy plik relatywnie do swojego document root.
 
 Zdecydowałem się na użycie tmp filesystem do tworzenia plików w locie.