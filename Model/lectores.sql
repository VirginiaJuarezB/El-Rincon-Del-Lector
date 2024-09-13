SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE DATABASE IF NOT EXISTS lectores DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE lectores;


-- Estructura de tabla para la tabla category donde se indicará si los libros según si son leídos, pendientes o abandonados

CREATE TABLE category (
  CategoryID int(11) NOT NULL,
  CatName varchar(50) NOT NULL, 
  PRIMARY KEY (CategoryID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertamos las clasificaciones

INSERT INTO category (CategoryID, CatName) VALUES
(1, 'LEYENDO'),
(2, 'PENDIENTE'),
(3, 'LEIDO'),
(4, "ABANDONADO");

-- Estructura de tabla para la tabla user


CREATE TABLE users (
  UserID int(11) AUTO_INCREMENT,
  Email varchar(100) NOT NULL UNIQUE,
  Password varchar(50) NOT NULL,
  FullName varchar(50) NOT NULL UNIQUE, 
  Enabled int NOT NULL, 
  PRIMARY KEY (UserID)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserción de datos para la tabla user


INSERT INTO users (UserID, Email, Password, FullName, Enabled) VALUES
(1, "bertaRivero@hola.com", "bertaR1989", "Berta Rivero", 2),
(2, "elviraDiaz@adios.com", "ED1387T", "Elvira Díaz", 1), 
(3, "marinoGalindo@open.es", "MarGal78", "Marino Galindo", 1), 
(4, "rogeRamon@human.net", "RoRa1956", "Rogelio Ramon", 2), 
(5, "esterSerra@gugul.com", "EsterSerra98N", "Ester Serra", 1), 
(6, "domiAnton75@linux.com", "DomingoAnton1975", "Domingo Anton", 1);


-- Estructura de tabla para la tabla setup para definir los usuarios SuperAdmin


CREATE TABLE setup (
Host varchar(50) NOT NULL,
Authentication int(11) NOT NULL,
SuperAdmin int(11) NOT NULL,
KEY SuperAdmin (SuperAdmin),
FOREIGN KEY (SuperAdmin) REFERENCES users (UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserción de datos para la tabla setup


INSERT INTO setup (Host, Authentication, SuperAdmin) VALUES
 ('localhost', 1, 3);



-- Estructura de tabla para la tabla book


CREATE TABLE book (
  BookID int(11) NOT NULL AUTO_INCREMENT,
  Title varchar(50) NOT NULL,
  AuthorName varchar (50) NOT NULL,
  Genre varchar (50) NOT NULL,
  CatID int,
  MemberID int,
  PRIMARY KEY (BookID),
  CONSTRAINT FK_CatID FOREIGN KEY (CatID) REFERENCES category (CategoryID),
  CONSTRAINT FK_MemeberID FOREIGN KEY (MemberID) REFERENCES users (UserID) ON DELETE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserción de datos para la tabla book


INSERT INTO book (BookID, Title, AuthorName, Genre, CatID, MemberID) VALUES
(1, "El camino de los reyes", "Brandon Sanderson", "Fantasía", 3,1), 
(2, "Ciudad de hueso", "Cassandra Clare", "Fantasía Urbana", 3,2), 
(3, "Don Quijote de la Mancha", "Miguel de Cervantes", "Clásicos", 3,3), 
(4, "Ojos azules", "Arturo Pérez Reverte", "Clásicos", 2,4), 
(5, "Los versos del capitán", "Pablo Neruda", "Poesía", 2,5), 
(6, "Los juegos del hambre", "Suzanne Collins", "Ciencia Ficción", 1,6), 
(7, "Londres", "Virginia Woolf", "No ficción", 2,1), 
(8, "Fundación", "Isaac Asimov", "Ciencia Ficción", 3,2), 
(9, "Orgullo y prejucio", "Jane Austen", "Romance", 3,3), 
(10, "Cien años de soledad", "Gabriel García Márquez", "Ficción histórica", 3,4), 
(11, "El ciclo del hombre lobo", "Stephen King", "Terror", 4,5), 
(12, "El exilio", "Victor Hugo", "No ficción", 3,6), 
(13, "Romeo y Julieta", "William Shakespeare", "Clásicos", 3,1), 
(14, "Poeta en Nueva York", "Federico García Lorca", "Poesía", 2,2), 
(15, "Trafalgar", "Benito Pérez Galdós", "Ficción histórica", 2,3), 
(16, "Platero y yo", "Juan Ramón Jiménez", "Clásicos", 1,4), 
(17, "Fuenteovejuna", "Lope de Vega", "Ficción histórica", 4,5), 
(18, "Campos de Castilla", "Antonio Machado", "Poesía", 3,6), 
(19, "Nosotras", "Rosa Montero", "No ficción", 2,1), 
(20, "El corazón helado",  "Almudena Grandes", "Suspense", 2,2);

