# 🚀 Campus Hub Deployment Guide

This guide provides comprehensive instructions for deploying Campus Hub to production environments.

## 📋 Pre-Deployment Checklist

### System Requirements
- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18.x or higher
- **NPM**: 9.x or higher
- **Database**: SQLite (default) or MySQL 8.0+
- **Web Server**: Apache 2.4+ or Nginx 1.18+

### Required Extensions
```bash
# PHP Extensions
php-sqlite3 (for SQLite)
php-mysql (for MySQL)
php-mbstring
php-xml
php-bcmath
php-gd
php-zip
php-curl
```

## 🐳 Docker Deployment (Recommended)

### Quick Start with Docker
```bash
# Clone the repository
git clone https://github.com/your-username/campus-hub.git
cd campus-hub

# Build and run with Docker Compose
docker-compose up -d

# Access the application
open http://localhost:8000
```

### Production Docker Deployment
```bash
# Build production image
docker build -t campus-hub:latest .

# Run with production settings
docker run -d \
  --name campus-hub-prod \
  -p 80:80 \
  -e APP_ENV=production \
  -e APP_DEBUG=false \
  -v $(pwd)/database:/var/www/html/database \
  campus-hub:latest
```

## 🖥️ Traditional Server Deployment

### 1. Server Setup

#### Ubuntu/Debian
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP and required extensions
sudo apt install -y php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-sqlite3 \
    php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-gd php8.2-zip php8.2-curl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js and NPM
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

#### CentOS/RHEL
```bash
# Install PHP and extensions
sudo dnf install -y php php-cli php-fpm php-mysql php-sqlite php-mbstring \
    php-xml php-bcmath php-gd php-zip php-curl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
sudo dnf install -y nodejs npm
```

### 2. Application Deployment

#### Clone and Setup
```bash
# Clone repository
git clone https://github.com/your-username/campus-hub.git
cd campus-hub

# Set proper ownership (replace 'www-data' with your web server user)
sudo chown -R www-data:www-data .
sudo chmod -R 755 storage bootstrap/cache
```

#### Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Edit environment variables
nano .env
```

#### Required Environment Variables for Production:
```env
APP_NAME="Campus Hub"
APP_ENV=production
APP_KEY=base64:your-generated-key-here
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database/database.sqlite

# WorkOS Configuration (Required)
WORKOS_API_KEY=your_workos_api_key
WORKOS_CLIENT_ID=your_workos_client_id

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="Campus Hub"

# Security Settings
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
```

#### Install Dependencies and Build
```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node dependencies
npm ci --only=production

# Build production assets
npm run build

# Generate application key
php artisan key:generate

# Create database and run migrations
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --class=CampusHubSeeder --force

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 3. Web Server Configuration

#### Apache Configuration
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /path/to/campus-hub/public
    
    <Directory /path/to/campus-hub/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/campus-hub-error.log
    CustomLog ${APACHE_LOG_DIR}/campus-hub-access.log combined
</VirtualHost>

# SSL Configuration (recommended)
<VirtualHost *:443>
    ServerName your-domain.com
    DocumentRoot /path/to/campus-hub/public
    
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    
    <Directory /path/to/campus-hub/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Nginx Configuration
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/campus-hub/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.ht {
        deny all;
    }
    
    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
}
```

## 🔄 Automated Deployment

### Using the Deployment Script

#### Linux/macOS
```bash
# Make script executable
chmod +x deploy.sh

# Run deployment
./deploy.sh
```

#### Windows
```powershell
# Run PowerShell deployment script
.\deploy.ps1
```

### CI/CD Pipeline Example (GitHub Actions)

Create `.github/workflows/deploy.yml`:
```yaml
name: Deploy Campus Hub

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        extensions: mbstring, xml, bcmath, gd, zip, curl, sqlite3
    
    - name: Setup Node.js
      uses: actions/setup-node@v3
      with:
        node-version: '18'
    
    - name: Install dependencies
      run: |
        composer install --no-dev --optimize-autoloader
        npm ci --only=production
    
    - name: Build assets
      run: npm run build
    
    - name: Deploy to server
      uses: appleboy/ssh-action@v0.1.5
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.KEY }}
        script: |
          cd /path/to/campus-hub
          git pull origin main
          ./deploy.sh
```

## ☁️ Cloud Platform Deployment

### Heroku
```bash
# Install Heroku CLI and login
heroku create campus-hub-app

# Add PHP buildpack
heroku buildpacks:add heroku/php
heroku buildpacks:add heroku/nodejs

# Configure environment
heroku config:set APP_ENV=production
heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)

# Deploy
git push heroku main
```

### DigitalOcean App Platform
Create `app.yaml`:
```yaml
name: campus-hub
services:
- name: web
  source_dir: /
  github:
    repo: your-username/campus-hub
    branch: main
  run_command: "php artisan serve --host=0.0.0.0 --port=$PORT"
  environment_slug: php
  instance_count: 1
  instance_size_slug: basic-xxs
  envs:
  - key: APP_ENV
    value: production
  - key: APP_KEY
    value: your-app-key
```

### AWS EC2 with Load Balancer
```bash
# Launch EC2 instance
# Install dependencies (see server setup above)
# Configure Auto Scaling Group
# Set up Application Load Balancer
# Configure CloudFront CDN
# Set up RDS for database (optional)
```

## 🔒 Production Security Checklist

### SSL/TLS Configuration
- [ ] Install SSL certificate (Let's Encrypt recommended)
- [ ] Force HTTPS redirects
- [ ] Configure HSTS headers
- [ ] Update `APP_URL` to use HTTPS

### Security Headers
```nginx
# Add to Nginx configuration
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "no-referrer-when-downgrade" always;
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
```

### File Permissions
```bash
# Set proper permissions
sudo chown -R www-data:www-data /path/to/campus-hub
sudo chmod -R 755 /path/to/campus-hub
sudo chmod -R 775 /path/to/campus-hub/storage
sudo chmod -R 775 /path/to/campus-hub/bootstrap/cache
```

### Environment Security
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Use strong, unique `APP_KEY`
- [ ] Secure database credentials
- [ ] Configure proper session settings
- [ ] Set up rate limiting

## 📊 Monitoring and Maintenance

### Log Monitoring
```bash
# Monitor application logs
tail -f storage/logs/laravel.log

# Monitor web server logs
tail -f /var/log/apache2/campus-hub-error.log
tail -f /var/log/nginx/error.log
```

### Performance Monitoring
- Set up application performance monitoring (APM)
- Configure server resource monitoring
- Monitor database performance
- Set up uptime monitoring

### Backup Strategy
```bash
# Database backup
php artisan backup:database

# File storage backup
rsync -av storage/app/ /backup/location/

# Complete application backup
tar -czf campus-hub-backup-$(date +%Y%m%d).tar.gz .
```

### Updates and Maintenance
```bash
# Regular maintenance routine
php artisan down
git pull origin main
composer install --no-dev --optimize-autoloader
npm ci --only=production && npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan up
```

## 🆘 Troubleshooting

### Common Issues

#### Permission Errors
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

#### 500 Internal Server Error
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check web server logs
tail -f /var/log/apache2/error.log
```

#### Database Connection Issues
```bash
# Verify database file exists and is writable
ls -la database/database.sqlite
sudo chown www-data:www-data database/database.sqlite
```

#### Assets Not Loading
```bash
# Rebuild assets
npm run build
php artisan view:clear
```

### Support Resources
- **Documentation**: [GitHub Wiki](../../wiki)
- **Issues**: [GitHub Issues](../../issues)
- **Community**: [GitHub Discussions](../../discussions)
- **Email**: support@campushub.example.com

---

## 🎯 Quick Deployment Summary

### For Experienced Users:
```bash
# Clone and setup
git clone https://github.com/your-username/campus-hub.git
cd campus-hub
cp .env.example .env
# Edit .env for production

# Install and build
composer install --no-dev --optimize-autoloader
npm ci --only=production && npm run build

# Setup application
php artisan key:generate
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --class=CampusHubSeeder --force

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
sudo chown -R www-data:www-data .
sudo chmod -R 755 storage bootstrap/cache

# Configure web server (Apache/Nginx)
# Point document root to /public directory
# Setup SSL certificate
```

**🎉 Your Campus Hub deployment is now ready!**
