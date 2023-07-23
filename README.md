# Prova tècnica viajes para ti
Prova tècnica per a la empresa Viajes Para Ti.

# Informacio

Està construït de 0, és a dir, amb un projecte de symfony clean i, tot fet a mà.
Sí que he anat afegint algunes dependències que eren necessàries per poder funcionar correctament tot.

Primer pas és crear la BD amb la comanda
> php bin/console doctrine:database:create

Deixaré encara així una bd amb algunes dades per si es vol utilitzar, esta en el repositori, en cas que no, no hi ha problema.  
Hi ha un factory per carregar dades fake en cas de que es vulgui fer.
> php bin/console doctrine:fixtures:load

Si no es vol eliminar el contingut ja de la base de dades
> php bin/console doctrine:fixtures:load --append  

Jo per iniciar el servidor he utilizat Laragon i el servidor en php ja que el servidor que hem creava symfony, no hem funcionava.
> php -S localhost:8080 -t public
> symfony serve
