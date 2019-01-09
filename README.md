# orleans-0918-php-metiers-du-numerique

Projet Name : Les Métiers du numérique (Digital Jobs)

"LES METIERS DU NUMERIQUE" is a project created by a developper's Team (Alicia PILAR, Amélie AUMONT, Billy VIVANT, Julien MONTIGNY, Thomas PECOUT) as part of Wild Code School's formation.

"LES METIERS DU NUMERIQUE" est un project créer par l'équipe de développement composée d'Alicia PILAR, Amélie AUMONT, Billy VIVANT, Julien MONTIGNY, Thomas PECOUT dans le cadre de la formation dispensée par la Wild Code School. 

System requirements

    PHP 7.2;

    Git https://git-scm.com/book/fr/v1/D%C3%A9marrage-rapide-Installation-de-Git

    Database : MySQL;

    Composer https://getcomposer.org/doc/00-intro.md

    Npm https://www.npmjs.com/get-npm

How To Use

To clone and run this project, you'll need Git, Composer and NPM. From your command line.
Cloner et demarrer le projet, il est necessaire d'avoir Composer, NPM avec votre terminal.  

Clone this repository : 

$ git clone https://github.com/WildCodeSchool/orleans-0918-php-metiers-du-numerique.git

Go into the repository : 

$ cd metierdunumerique

Install dependencies : 

$ composer install
$ npm install
$ yarn install

Initiate Project :

$ php bin/console doctrine:database:create 
$ php bin/console doctrine:schema:update --force

Load fixtures to add Jobs, Comments, LearningCenters, Partners in database :

$ php bin/console doctrine:fixtures:load

Compile Webpack for CSS and JS :
$ npm run dev (for dev environment) 
$ npm run build (for prod environment)

Launch PHP Server :
$ php bin/console server:run (DEV Only) 
$ for prod env, configure a web server (apache, nginx, ...)
