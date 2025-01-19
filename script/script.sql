CREATE DATABASE youdemy;
USE youdemy;
CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY ,
    user_nom VARCHAR(255) NOT NULL,
    user_prenom VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    confirme_password VARCHAR(255) NOT NULL,
    user_type ENUM("etudiant","enseignant","administrateur"),
    status ENUM("en attente","valide","invalide")
);

CREATE TABLE categories(
    categorie_id INT AUTO_INCREMENT PRIMARY KEY ,
    categorie_image VARCHAR(255) NOT NULL,
    categorie_nom VARCHAR(255) NOT NULL,
    categorie_description VARCHAR(255) NOT NULL
);
INSERT INTO categories(categorie_image,categorie_nom,categorie_description)
VALUES ("https://egeniq.com/wp-content/uploads/2022/07/frontend_webdeveloper.jpg","FrontEnd","Apprenez à créer des interfaces utilisateur modernes avec HTML, CSS, JavaScript et les frameworks populaires."),
("https://static.vecteezy.com/system/resources/previews/007/570/850/original/backend-development-line-icon-vector.jpg","BackEnd","Développez des applications serveur robustes avec les technologies backend les plus demandées.");

CREATE TABLE cours(
    cours_id INT AUTO_INCREMENT PRIMARY KEY ,
    cours_image VARCHAR(255) NOT NULL,
    cours_nom VARCHAR(255) NOT NULL,
    cours_description VARCHAR(255) NOT NULL,
    categorie_id INT,
    user_id INT ,
    FOREIGN KEY (categorie_id) REFERENCES categories(categorie_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO cours (cours_image, cours_nom, cours_description, categorie_id, user_id) VALUES
('image1.jpg', 'Introduction à la programmation', 'Apprenez les bases de la programmation avec ce cours.', 1, 1),
('image2.jpg', 'HTML et CSS pour débutants', 'Découvrez comment créer des sites web avec HTML et CSS.', 1, 1),
('image3.jpg', 'JavaScript avancé', 'Maîtrisez JavaScript avec des concepts avancés.', 1, 1),
('image4.jpg', 'Python pour la science des données', 'Utilisez Python pour analyser et visualiser des données.', 1, 1),
('image5.jpg', 'Développement web avec React', 'Créez des applications web modernes avec React.', 1, 1),
('image6.jpg', 'Base de données SQL', 'Apprenez à manipuler des bases de données relationnelles.', 1, 1),
('image7.jpg', 'Développement mobile avec Flutter', 'Créez des applications mobiles multiplateformes avec Flutter.', 1, 1),
('image8.jpg', 'UI/UX Design', 'Concevez des interfaces utilisateur intuitives et esthétiques.', 1, 1),
('image9.jpg', 'Sécurité informatique', 'Protégez vos systèmes contre les cyberattaques.', 1, 1),
('image10.jpg', 'Gestion de projet Agile', 'Découvrez les méthodologies Agile pour gérer vos projets.', 1, 1);