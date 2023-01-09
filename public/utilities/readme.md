# Ecommerce Symfony


1. Vérifiez les pré-requis (php > 8, mysql, composer, symfony.exe)
2. Installation de Symfony (regarder la doc)

        symfony new siteDeECommerce --version="6.2.*" --webapp

3. Création de la configuration locals (.env.local) : et création database

        php bin/console doctrine:database:create

4. Démarrage server Symfony : on test l'accès à la première page

        Symfony server:start
        Adresse dans la console

5. Création du premier controller (page d'accueil /)

        symfony console make:controller HomePage

6. Création de nos entités à partir du MCD ou du diagramme de classe

        php bin/console make:entity

7. Relation entre nos entités

    php bin/console make:entity avec le nom de l'entity déjà crée puis :

        new property name : nom de l'entity qu'on veux lié
        field type : relation
        what class ... : identique au new property
        Choix de la relation

8. Migration vers la base de données ou Mise à jour du schéma

        php bin/console doctrine:migrations:diff (équivalent d'un "git add -A")
        php bin/console doctrine:migrations:migrate (équivalent d'un "git push")

9. Création de nos controllers admin (prefixer avec Admin : exemple : AdminProductController) pour créer de la donnée (CRUD). ¨Product - Category - Tva

    symfony console make:crud :

        the class... : nom de l'entité qu'on veux crée en admin
        choose a name... : AdminProductController
    

10. Eventuellement faire des Fixtures (création de jeux de données fake ou pas)

        composer require --dev orm-fixtures
        https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html
        php bin/console doctrine:fixtures:load

11. Petites choses en plus :
    1.  Modifier le Type (Form) : définir le type des champs nécessaire

        ex pour le CategoryType : 

                dans le builder changer les input que l'on veux
                (add->('placeholder'))

    2.  Gérer le slug

        Hydrater le setter avant le flush dans le repository ex : 

                if ($flush) {
                        $slugger = new AsciiSlugger();
                        $entity->setSlug($slugger->slug($entity->getName())->lower());
                        $this->getEntityManager()->flush();
                }
                
        
    3.  Créer le layout de l'admin et l'associer aux vues admin

                crée un fichier baseAdmin.html.twig
                Changer les autre twig admin avec le nouveau layout

    4.  Ajouter boostrap à l'admin et form twig avec bootstrap

        ajouter les lignes de code de la doc bootstrap
                
                {% block stylesheets %}
                        {{ encore_entry_link_tags('app') }}
                        <!-- CSS only -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"                rel="stylesheet"                                                       integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"  crossorigin="anonymous">
                {% endblock %}

                {% block javascripts %}
                        {{ encore_entry_script_tags('app') }}
                        <!-- JavaScript Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
                {% endblock %}

    5.  Ajouter une navigation à l'admin
    6.  Optimiser l'ajout et l'édit dans les controller CRUD
12. Upload des images
13. Afficher sur le Front nos produits (sur la page front d'accueil)
14. Page de détails produits
15. Ajouter la gestion du multilangue (en|fr)
16. Ajouter une méthode Front pour la gestion des pages statiques (presentation mentions légales, contacts...)
17. Création du register client
18. Création du login client
19. Et après :
    1.  Ajout au panier (session) 
    2.  Validation de la commande
    3.  Paiement !