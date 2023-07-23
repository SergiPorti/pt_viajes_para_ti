# Prova tècnica viajes para ti
Prova tècnica per a la empresa Viajes Para Ti.

# Informacio

Està construït de 0, és a dir, amb un projecte de symfony clean i, tot fet a mà.
Sí que he anat afegint algunes dependències que eren necessàries per poder funcionar correctament tot.

Primer pas és crear la BD amb la comanda
> php bin/console doctrine:database:create

Deixaré encara així la bd per si es vol importar en el repositori  
Hi ha un factory per carregar dades fake en cas de que es vulgui fer.
> php bin/console doctrine:fixtures:load

Si no es vol eliminar el contingut ja de la base de dades
> php bin/console doctrine:fixtures:load --append  

Jo per iniciar el servidor he utilizat de Laragon i un servidor amb php
> php -S localhost:8080 -t public
