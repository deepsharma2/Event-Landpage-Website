# CSA XCON Website - README

## 🎯 Project Overview

This is a complete website and CMS (Content Management System) for the **CSA XCON 2025** cybersecurity conference. The project includes:

1. **Frontend Website** - Modern, responsive single-page site
2. **Complete CMS** - Full-featured admin panel for content management
3. **Database System** - MySQL database with comprehensive schema
4. **User Management** - Role-based access control
5. **Media Library** - File and image management
6. **Documentation** - Complete guides and manuals

---

## 📁 Project Structure

```
csa-xcon/
├── index.html              # Main website (frontend)
├── styles.css              # Website styles
├── logo.svg                # Site logo
├── cms/                    # Content Management System
│   ├── assets/
│   │   ├── css/
│   │   │   └── admin.css   # Admin panel styles
│   │   └── js/
│   │       └── admin.js    # Admin panel scripts
│   ├── config/
│   │   ├── config.php      # Main configuration
│   │   └── database.php    # Database connection
│   ├── includes/
│   │   ├── header.php      # Admin header
│   │   └── footer.php      # Admin footer
│   ├── install/
│   │   ├── install.php     # Installation wizard
│   │   └── schema.sql      # Database schema
│   ├── models/
│   │   ├── User.php        # User model
│   │   ├── Content.php     # Content model
│   │   ├── Media.php       # Media model
│   │   └── Settings.php    # Settings model
│   ├── dashboard.php       # Admin dashboard
│   ├── login.php           # Login page
│   ├── logout.php          # Logout handler
│   ├── pages.php           # Pages management
│   ├── edit-content.php    # Content editor
│   ├── media.php           # Media library
│   └── settings.php        # Settings page
├── uploads/                # Uploaded files directory
├── CMS_DOCUMENTATION.md    # Complete documentation
├── QUICK_START.md          # Quick start guide
├── FEATURES.md             # Feature list
└── README.md               # This file
```

---

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP (for local development)

### Installation Steps

1. **Clone or Download**
   ```bash
   # Place files in your web server directory
   # For XAMPP: C:\xampp\htdocs\csa-xcon
   # For WAMP: C:\wamp64\www\csa-xcon
   ```

2. **Run Installer**
   ```
   Navigate to: http://localhost/csa-xcon/cms/install/install.php
   ```

3. **Enter Database Details**
   - Host: `localhost`
   - Database: `csa_xcon_cms`
   - Username: `root`
   - Password: (empty for local)

4. **Login to CMS**
   ```
   URL: http://localhost/csa-xcon/cms/login.php
   Username: admin
   Password: admin123
   ```

5. **Change Password** (Important!)
   - Go to Profile
   - Update your password immediately

---

## 📖 Documentation

### Quick References
- **[Quick Start Guide](QUICK_START.md)** - Get started in 5 minutes
- **[Complete Documentation](CMS_DOCUMENTATION.md)** - Full user and developer guide
- **[Feature List](FEATURES.md)** - All implemented features

### Key Topics
- Installation and setup
- User management
- Content editing
- Media management
- Navigation configuration
- Settings management
- Security best practices
- Troubleshooting

---

## ✨ Features

### Website Features
- ✅ Modern, responsive design
- ✅ Dark theme with gradients
- ✅ Smooth animations
- ✅ Mobile-friendly
- ✅ SEO optimized
- ✅ Fast loading

### CMS Features
- ✅ Complete content management
- ✅ User authentication & roles
- ✅ Media library
- ✅ Navigation management
- ✅ Settings configuration
- ✅ Activity logging
- ✅ Secure file uploads
- ✅ Responsive admin panel

---

## 🔐 Default Credentials

**⚠️ IMPORTANT: Change these immediately after installation!**

```
Username: admin
Password: admin123
```

---

## 🛠️ Configuration

### Database Configuration
Edit `cms/config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'csa_xcon_cms');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### Site Configuration
Edit `cms/config/config.php`:
```php
define('SITE_URL', 'http://localhost/csa-xcon');
define('MAX_FILE_SIZE', 5242880); // 5MB
```

---

## 📱 Browser Support

- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers

---

## 🔒 Security

### Implemented Security Features
- Password hashing (bcrypt)
- SQL injection prevention
- XSS protection
- CSRF tokens
- Session security
- File upload validation
- Role-based access control

### Security Best Practices
1. Change default password
2. Use strong passwords
3. Regular backups
4. Keep PHP/MySQL updated
5. Secure file permissions
6. Monitor activity logs

---

## 🎨 Customization

### Change Colors
Edit `cms/assets/css/admin.css`:
```css
:root {
    --primary-color: #00d4ff;
    --secondary-color: #7c3aed;
}
```

### Add Custom Pages
1. Copy existing page template
2. Modify content
3. Add to navigation

---

## 📊 Database Schema

### Main Tables
- `users` - User accounts
- `pages` - Website pages
- `sections` - Page sections
- `content_blocks` - Content pieces
- `media` - Uploaded files
- `site_settings` - Configuration
- `navigation_menus` - Menu structures
- `navigation_items` - Menu items
- `activity_log` - User activity

---

## 🐛 Troubleshooting

### Common Issues

**Database Connection Error**
- Check database credentials
- Ensure MySQL is running
- Verify database exists

**Upload Fails**
- Check `uploads/` folder permissions
- Verify PHP upload settings
- Check file size limits

**Can't Login**
- Clear browser cookies
- Check database connection
- Verify user exists

**Changes Not Showing**
- Clear browser cache
- Check if saved properly
- Verify status is "Published"

---

## 📞 Support

For issues or questions:
1. Check documentation files
2. Review error logs
3. Verify system requirements
4. Check file permissions

---

## 📝 License

© 2025 CloudSecureAlliance. All rights reserved.
Built for CSA XCON Cybersecurity Conference.

---

## 🙏 Credits

- **Design**: Modern cybersecurity theme
- **Fonts**: Google Fonts (Inter, Space Grotesk)
- **Icons**: Feather Icons (SVG)
- **Framework**: Custom PHP/MySQL

---

## 📅 Version History

### Version 1.0.0 (Current)
- Initial release
- Complete CMS functionality
- Full documentation
- Production ready

---

## 🚀 Getting Started Checklist

- [ ] Install CMS using installer
- [ ] Login with default credentials
- [ ] Change admin password
- [ ] Update site settings
- [ ] Upload logo and images
- [ ] Edit homepage content
- [ ] Configure navigation
- [ ] Add social media links
- [ ] Create additional users (if needed)
- [ ] Test all features
- [ ] Backup database
- [ ] Deploy to production

---

## 💡 Tips

1. **Regular Backups**: Backup database weekly
2. **Strong Passwords**: Use 12+ characters
3. **Test First**: Preview changes before publishing
4. **Organize Media**: Use descriptive filenames
5. **Monitor Activity**: Check logs regularly
6. **Update Content**: Keep information current
7. **Optimize Images**: Compress before upload
8. **Use Alt Text**: Better SEO and accessibility

---

## 🎉 You're All Set!

Your CSA XCON website and CMS are ready to use. Start by following the Quick Start guide and exploring the admin panel.

**Happy Content Managing! 🚀**

For detailed instructions, see [QUICK_START.md](QUICK_START.md)
