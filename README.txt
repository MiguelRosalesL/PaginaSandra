------------- Creacion de Base de Datos ---------------
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME NOT NULL
);

CREATE TABLE datos_envio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    calle VARCHAR(255) NOT NULL,
    no_calle_interior VARCHAR(50),
    no_calle_exterior VARCHAR(50),
    departamento VARCHAR(100),
    colonia VARCHAR(255) NOT NULL,
    cp VARCHAR(10) NOT NULL,
    indicaciones TEXT,
    forma_pago VARCHAR(50) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
);

CREATE TABLE elementos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    nombre_item VARCHAR(255) NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
);

IMPORTAR LIBRERIAS

Instalar Python

python --version

pip install pandas

pip install flask

pip install matplolib

pip install mysql-connector


git config --global user.name <usuario>
git config --global user.email <correo>


