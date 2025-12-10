# CSA XCON CMS

A complete, custom-built Content Management System for the CSA XCON website.

## Features
- **Full Control**: Edit Hero section, About sections, Highlights, Footer, and Navigation.
- **Media Library**: Manage images and assets.
- **SEO Management**: Edit meta tags and descriptions from the dashboard.
- **Live Preview**: See changes in real-time within the editor.
- **Touch-Friendly**: Fully responsive admin panel works on mobile and desktop.
- **Secure**: Session-based authentication and password hashing.

## Installation

### 1. Database Setup
1. Create a MySQL database named `csa_xcon_cms`.
2. Import the `cms/database.sql` file into your database.
   - You can use tools like phpMyAdmin or MySQL Workbench.

### 2. Configuration
1. Open `cms/config.php`.
2. Update the database credentials if necessary:
   ```php
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

### 3. Usage
1. Navigate to `/csa-xcon/cms/login.php` in your browser.
2. Login with the default credentials:
   - **Username**: `admin`
   - **Password**: `admin123` (Please change this immediately after logging in!)

## Directory Structure
- `/cms`: Admin panel files
  - `/api`: Backend API endpoints for AJAX requests
  - `/assets`: Admin CSS and JS
  - `/includes`: Reusable components (sidebar, topbar)
  - `/uploads`: Directory for uploaded media
- `index.php`: The main website file (replaces index.html) connected to the CMS.

## Development
- **Adding new sections**: Create a new table in the database, create a new editor file in `/cms` (copy `hero-section.php` as a template), and add a link to `includes/sidebar.php`.
- **Frontend Integration**: Use `index.php` as a reference for fetching data from the database and displaying it.
