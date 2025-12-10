-- CSA XCON CMS Database Schema
-- This creates all necessary tables for the CMS

CREATE DATABASE IF NOT EXISTS csa_xcon_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE csa_xcon_cms;

-- Users table for admin authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Site settings table
CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type ENUM('text', 'textarea', 'image', 'color', 'number', 'boolean') DEFAULT 'text',
    category VARCHAR(50) DEFAULT 'general',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Navigation menu items
CREATE TABLE IF NOT EXISTS navigation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL,
    href VARCHAR(255) NOT NULL,
    position INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Hero section content
CREATE TABLE IF NOT EXISTS hero_section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    badge_text VARCHAR(100),
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    description TEXT,
    primary_button_text VARCHAR(50),
    primary_button_link VARCHAR(255),
    secondary_button_text VARCHAR(50),
    secondary_button_link VARCHAR(255),
    background_image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Hero stats
CREATE TABLE IF NOT EXISTS hero_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stat_number VARCHAR(20) NOT NULL,
    stat_label VARCHAR(50) NOT NULL,
    position INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- About XCON cards
CREATE TABLE IF NOT EXISTS about_xcon_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon_svg TEXT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    card_type VARCHAR(50),
    position INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- About XCON highlight
CREATE TABLE IF NOT EXISTS about_xcon_highlight (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(10),
    text TEXT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- About CSA content
CREATE TABLE IF NOT EXISTS about_csa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description_1 TEXT,
    description_2 TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- About CSA features
CREATE TABLE IF NOT EXISTS about_csa_features (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(10),
    title VARCHAR(100) NOT NULL,
    description TEXT,
    position INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Highlights/Events
CREATE TABLE IF NOT EXISTS highlights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(5),
    icon_svg TEXT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    position INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Footer content
CREATE TABLE IF NOT EXISTS footer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    site_title VARCHAR(100),
    site_description TEXT,
    email VARCHAR(100),
    phone VARCHAR(50),
    address TEXT,
    organizer_name VARCHAR(100),
    organizer_description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Social media links
CREATE TABLE IF NOT EXISTS social_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    platform VARCHAR(50) NOT NULL,
    url VARCHAR(255) NOT NULL,
    icon_svg TEXT,
    position INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Section settings (for controlling section visibility and order)
CREATE TABLE IF NOT EXISTS sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_name VARCHAR(100) UNIQUE NOT NULL,
    section_id VARCHAR(100) NOT NULL,
    badge_text VARCHAR(100),
    title VARCHAR(255),
    subtitle TEXT,
    position INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Media library
CREATE TABLE IF NOT EXISTS media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    original_filename VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(50),
    file_size INT,
    alt_text VARCHAR(255),
    uploaded_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Activity log
CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(100),
    record_id INT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123 - CHANGE THIS!)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@csaxcon.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert default site settings
INSERT INTO site_settings (setting_key, setting_value, setting_type, category) VALUES
('site_name', 'CSA XCON 2025', 'text', 'general'),
('site_tagline', 'Pioneering Cyber Resilience in the Himalayas', 'text', 'general'),
('logo_url', 'logo.svg', 'image', 'branding'),
('primary_color', '#a020f0', 'color', 'design'),
('secondary_color', '#ff8c3a', 'color', 'design'),
('accent_color', '#c770ff', 'color', 'design'),
('font_primary', 'Inter', 'text', 'typography'),
('font_heading', 'Space Grotesk', 'text', 'typography'),
('meta_description', 'CSA XCON - First major international cybersecurity conference in Uttarakhand in 10 years.', 'textarea', 'seo'),
('meta_keywords', 'cybersecurity, conference, CSA, XCON, Uttarakhand, Dehradun', 'textarea', 'seo');

-- Insert default navigation
INSERT INTO navigation (label, href, position) VALUES
('Home', '#home', 1),
('About XCON', '#about-xcon', 2),
('About CSA', '#about-csa', 3),
('Highlights', '#highlights', 4);

-- Insert default hero section
INSERT INTO hero_section (badge_text, title, subtitle, description, primary_button_text, primary_button_link, secondary_button_text, secondary_button_link) VALUES
('March 11-14, 2025', 'CSA XCON 2025', 'Pioneering Cyber Resilience in the Himalayas', 'Join 1000+ cybersecurity professionals at Uttarakhand''s first major international cybersecurity conference in a decade', 'Discover More', '#about-xcon', 'View Highlights', '#highlights');

-- Insert default hero stats
INSERT INTO hero_stats (stat_number, stat_label, position) VALUES
('1000+', 'Attendees', 1),
('4', 'Days', 2),
('10+', 'Years', 3);

-- Insert default sections
INSERT INTO sections (section_name, section_id, badge_text, title, subtitle, position) VALUES
('About XCON', 'about-xcon', 'The Conference', 'About XCON', 'A landmark event bringing cybersecurity excellence to the Himalayas', 1),
('About CSA', 'about-csa', 'The Organization', 'About CSA', 'CloudSecureAlliance - Leading the future of digital defense', 2),
('Highlights', 'highlights', 'What to Expect', 'Event Highlights', 'Immerse yourself in cutting-edge cybersecurity innovation', 3);
