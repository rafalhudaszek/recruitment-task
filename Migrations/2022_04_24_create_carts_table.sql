CREATE TABLE carts (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    is_expired BIT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)