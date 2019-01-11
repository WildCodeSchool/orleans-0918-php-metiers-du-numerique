# orleans-0918-php-metiers-du-numerique

Les Métiers du numérique 

"LES METIERS DU NUMERIQUE" est un project créer par l'équipe de développement composée d'Alicia PILAR, Amélie AUMONT, Billy VIVANT, Julomontiti : https://github.com/Julomontiti, Thomas PECOUT dans le cadre de la formation dispensée par la Wild Code School. 

System requis :

    PHP 7.2;
    
    Symfony 4;

    Git https://git-scm.com/book/fr/v1/D%C3%A9marrage-rapide-Installation-de-Git

    Database : MySQL;

    Composer https://getcomposer.org/doc/00-intro.md
    
    NodeJS https://nodejs.org/en/
    
Démarrer : 

Cloner et demarrer le projet, il est necessaire d'avoir Composer avec votre terminal.  

Cloner ce "repository" : 

$ git clone https://github.com/WildCodeSchool/orleans-0918-php-metiers-du-numerique.git

Aller dans le répertoire : 

$ cd metierdunumerique

Installer les dépendances : 

$ composer install
$ yarn install

Initialiser le project :

Créer un fichier à la racine du projet .env.local copier le .env et modifier les élements suivant :

DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name


$ php bin/console doctrine:database:create 
$ php bin/console doctrine:migrations:migrate

Intégrer les fixtures de type : Jobs, LearningCenters, Partners dans la database :

$ php bin/console doctrine:fixtures:load

Compiler Webpack pour CSS et le JS :

$ yarn encore production

Lancer un serveur PHP :

$ php bin/console server:run (pour le développement) 
$ for prod env, configure a web server (apache, nginx, ...)
