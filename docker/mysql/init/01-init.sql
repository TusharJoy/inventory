-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS inventory;

-- Switch to the inventory database
USE inventory;

-- Drop the user if it exists to avoid conflicts
DROP USER IF EXISTS 'inventory_user' @'%';

-- Create the user with proper permissions
CREATE USER 'inventory_user' @'%' IDENTIFIED BY
  'secret';

-- Grant all privileges on the inventory database
GRANT ALL PRIVILEGES ON inventory.* TO 'inventory_user' @'%';

-- Grant global privileges needed for Laravel
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON inventory.* TO 'inventory_user' @'%';

-- Flush privileges to apply changes
FLUSH PRIVILEGES;

