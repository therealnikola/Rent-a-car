🚗 Rent-a-Car – Web aplikacija za iznajmljivanje vozila
Full-stack web aplikacija za pregled voznog parka, online rezervaciju vozila i administraciju najma, razvijena korišćenjem Laravel radnog okvira. 


✨ Ključne Funkcionalnosti
•	Pregled vozila i rezervacija: Korisnici mogu da pretražuju dostupna vozila (poput modela brendova Alfa Romeo, BMW, Citroen, Fiat, Honda, Mercedes, Nissan), biraju period iznajmljivanja i podnose zahteve za rezervaciju. 

•	Automatski obračun cene: Sistem automatski izračunava ukupnu cenu najma na osnovu cene vozila po danu i odabranog broja dana.

•	Korisničke uloge (Role-Based Access): Jasno razdvojene privilegije i funkcionalnosti za obične korisnike (Korisnik) i administratore sistema (Administrator).

•	Upravljanje statusima rezervacija: Administrator ima uvid u sve pristigle zahteve i može menjati njihov status u realnom vremenu (Pending, Accepted, Rejected).

🛠️ Tehnologije
•	Backend: PHP, Laravel (MVC arhitektura) 

•	Frontend: Blade templating engine, Bootstrap 

•	Baza podataka: MySQL

•	Build alati: Vite, Composer 

🚀 Pokretanje projekta lokalno
1.	Kloniraj repozitorijum i uđi u folder aplikacije (cd laravel_app). 

2.	Instaliraj PHP i frontend zavisnosti:


=============
composer install
npm install && npm run build
=============
3.	Kopiraj .env.example u .env i podesi parametre za povezivanje sa svojom MySQL bazom podataka.
   
4.	Generiši ključ aplikacije i pokreni migracije:

php artisan key:generate
php artisan migrate


5.	Pokreni lokalni server:

php artisan serve

