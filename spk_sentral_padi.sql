CREATE DATABASE IF NOT EXISTS spk_padi;
USE spk_padi;

-- users
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- password_reset_tokens
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);

-- sessions
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
);

-- kriterias
CREATE TABLE IF NOT EXISTS kriterias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kriteria VARCHAR(255) NOT NULL,
    jenis ENUM('benefit', 'cost') NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- daerahs
CREATE TABLE IF NOT EXISTS daerahs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_daerah VARCHAR(255) NOT NULL,
    provinsi VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- nilai_daerahs
CREATE TABLE IF NOT EXISTS nilai_daerahs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    daerah_id BIGINT UNSIGNED NOT NULL,
    kriteria_id BIGINT UNSIGNED NOT NULL,
    nilai DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (daerah_id) REFERENCES daerahs(id) ON DELETE CASCADE,
    FOREIGN KEY (kriteria_id) REFERENCES kriterias(id) ON DELETE CASCADE
);

-- bobot_defaults
CREATE TABLE IF NOT EXISTS bobot_defaults (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kriteria_id BIGINT UNSIGNED NOT NULL,
    bobot DECIMAL(5, 4) NOT NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (kriteria_id) REFERENCES kriterias(id) ON DELETE CASCADE,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

-- log_perhitungans
CREATE TABLE IF NOT EXISTS log_perhitungans (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    executed_at DATETIME NOT NULL,
    keterangan VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
