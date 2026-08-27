CREATE TABLE login_attempts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    email VARCHAR(150) NOT NULL,

    ip_address VARCHAR(45) NOT NULL,

    attempted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    successful TINYINT(1) NOT NULL DEFAULT 0,

    INDEX idx_login_email (email),
    INDEX idx_login_ip (ip_address),
    INDEX idx_login_time (attempted_at)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;