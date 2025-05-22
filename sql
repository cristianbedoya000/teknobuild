CREATE DATABASE tienda;
USE tienda;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario'
);

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

INSERT INTO productos (nombre, categoria, precio, stock, imagen) VALUES
('Tarjeta Gráfica RTX 5070 12 GB', 'GPU', 1700000, 10, '../uploads/507012GB.webp'),
('Tarjeta Gráfica RTX 3050 8 GB', 'GPU', 1100000, 10, '../uploads/rtx30508b.webp'),
('Board Asus Rog Strix B550-f', 'BOARD', 1400000, 10, '../uploads/board-asus-rog-strix-b550-f.webp'),
('Procesador Intel Core Ultra 5', 'CPU', 1750000, 15, '../uploads/Procesador-Intel-Core-Ultra-5-245KF-520-GHz.webp'),
('PC GAMER LEGENDARIO', 'PC', 20000000, 20, '../uploads/Pc-gamer-legendario-2025.webp');

INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Admin', 'admin@store.com', 'admin123', 'admin'),
('Carlos', 'carlos@store.com', 'usuario123', 'usuario');
