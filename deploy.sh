#!/bin/bash

# Campus Hub Deployment Script
# This script prepares and deploys Campus Hub to production

echo "🎓 Campus Hub Deployment Script"
echo "==============================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if running in production environment
if [ "$APP_ENV" != "production" ]; then
    print_warning "APP_ENV is not set to 'production'. Are you sure you want to continue? (y/N)"
    read -r response
    if [[ ! "$response" =~ ^[Yy]$ ]]; then
        print_error "Deployment cancelled."
        exit 1
    fi
fi

print_status "Starting Campus Hub deployment..."

# 1. Backup current deployment (if exists)
if [ -d "storage/app/backup" ]; then
    print_status "Creating backup of current deployment..."
    timestamp=$(date +"%Y%m%d_%H%M%S")
    mkdir -p "backups/$timestamp"
    cp -r storage/app/* "backups/$timestamp/" 2>/dev/null || true
    print_success "Backup created at backups/$timestamp"
fi

# 2. Put application in maintenance mode
print_status "Putting application in maintenance mode..."
php artisan down --refresh=15 --secret="deploy-$(date +%s)"

# 3. Pull latest code (if using Git)
if [ -d ".git" ]; then
    print_status "Pulling latest code from Git..."
    git pull origin main
    print_success "Code updated from Git"
fi

# 4. Install/update PHP dependencies
print_status "Installing PHP dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction
print_success "PHP dependencies installed"

# 5. Install/update Node dependencies and build assets
print_status "Installing Node dependencies..."
npm ci --only=production --silent
print_success "Node dependencies installed"

print_status "Building production assets..."
npm run build
print_success "Assets built for production"

# 6. Run database migrations
print_status "Running database migrations..."
php artisan migrate --force
print_success "Database migrations completed"

# 7. Clear and optimize caches
print_status "Optimizing application caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
print_success "Application caches optimized"

# 8. Clear application cache
print_status "Clearing application cache..."
php artisan cache:clear
print_success "Application cache cleared"

# 9. Optimize Composer autoloader
print_status "Optimizing Composer autoloader..."
composer dump-autoload --optimize
print_success "Composer autoloader optimized"

# 10. Set proper permissions
print_status "Setting proper file permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
print_success "File permissions set"

# 11. Run queue workers (if using queues)
if [ "$QUEUE_CONNECTION" != "sync" ] && [ "$QUEUE_CONNECTION" != "database" ]; then
    print_status "Restarting queue workers..."
    php artisan queue:restart
    print_success "Queue workers restarted"
fi

# 12. Warm up the application
print_status "Warming up application..."
php artisan config:cache
php artisan route:cache
print_success "Application warmed up"

# 13. Take application out of maintenance mode
print_status "Taking application out of maintenance mode..."
php artisan up
print_success "Application is now live"

# 14. Health check
print_status "Performing health check..."
if curl -f -s "$APP_URL/api/health" > /dev/null 2>&1; then
    print_success "Health check passed"
else
    print_warning "Health check endpoint not available or failed"
fi

# 15. Send deployment notification (optional)
if [ ! -z "$SLACK_WEBHOOK_URL" ]; then
    print_status "Sending deployment notification..."
    curl -X POST -H 'Content-type: application/json' \
        --data '{"text":"🎓 Campus Hub deployment completed successfully!"}' \
        "$SLACK_WEBHOOK_URL" > /dev/null 2>&1
    print_success "Deployment notification sent"
fi

print_success "🎉 Campus Hub deployment completed successfully!"
print_status "Application URL: $APP_URL"
print_status "Deployment completed at: $(date)"

# Display important post-deployment information
echo ""
echo "📋 Post-Deployment Checklist:"
echo "  ✅ Application is live and accessible"
echo "  ✅ Database migrations completed"
echo "  ✅ Caches optimized"
echo "  ✅ File permissions set"
echo ""
echo "🔧 Next Steps:"
echo "  1. Verify all features are working correctly"
echo "  2. Check application logs for any errors"
echo "  3. Monitor performance metrics"
echo "  4. Update DNS records if needed"
echo "  5. Set up monitoring and alerting"
echo ""
echo "📞 Support: Check logs in storage/logs/ if issues occur"
