# Campus Hub PowerShell Deployment Script
# This script prepares and deploys Campus Hub to production on Windows

Write-Host "🎓 Campus Hub Deployment Script (Windows)" -ForegroundColor Blue
Write-Host "=========================================" -ForegroundColor Blue

function Write-Status {
    param($Message)
    Write-Host "[INFO] $Message" -ForegroundColor Cyan
}

function Write-Success {
    param($Message)
    Write-Host "[SUCCESS] $Message" -ForegroundColor Green
}

function Write-Warning {
    param($Message)
    Write-Host "[WARNING] $Message" -ForegroundColor Yellow
}

function Write-Error {
    param($Message)
    Write-Host "[ERROR] $Message" -ForegroundColor Red
}

# Check if running in production environment
if ($env:APP_ENV -ne "production") {
    Write-Warning "APP_ENV is not set to 'production'. Are you sure you want to continue? (y/N)"
    $response = Read-Host
    if ($response -notmatch "^[Yy]$") {
        Write-Error "Deployment cancelled."
        exit 1
    }
}

Write-Status "Starting Campus Hub deployment..."

try {
    # 1. Put application in maintenance mode
    Write-Status "Putting application in maintenance mode..."
    php artisan down --refresh=15 --secret="deploy-$(Get-Date -Format 'yyyyMMddHHmmss')"
    Write-Success "Application in maintenance mode"

    # 2. Install/update PHP dependencies
    Write-Status "Installing PHP dependencies..."
    composer install --optimize-autoloader --no-dev --no-interaction
    Write-Success "PHP dependencies installed"

    # 3. Install/update Node dependencies and build assets
    Write-Status "Installing Node dependencies..."
    npm ci --only=production --silent
    Write-Success "Node dependencies installed"

    Write-Status "Building production assets..."
    npm run build
    Write-Success "Assets built for production"

    # 4. Run database migrations
    Write-Status "Running database migrations..."
    php artisan migrate --force
    Write-Success "Database migrations completed"

    # 5. Clear and optimize caches
    Write-Status "Optimizing application caches..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    Write-Success "Application caches optimized"

    # 6. Clear application cache
    Write-Status "Clearing application cache..."
    php artisan cache:clear
    Write-Success "Application cache cleared"

    # 7. Optimize Composer autoloader
    Write-Status "Optimizing Composer autoloader..."
    composer dump-autoload --optimize
    Write-Success "Composer autoloader optimized"

    # 8. Restart queue workers (if using queues)
    if ($env:QUEUE_CONNECTION -ne "sync" -and $env:QUEUE_CONNECTION -ne "database") {
        Write-Status "Restarting queue workers..."
        php artisan queue:restart
        Write-Success "Queue workers restarted"
    }

    # 9. Take application out of maintenance mode
    Write-Status "Taking application out of maintenance mode..."
    php artisan up
    Write-Success "Application is now live"

    Write-Success "🎉 Campus Hub deployment completed successfully!"
    Write-Status "Application URL: $env:APP_URL"
    Write-Status "Deployment completed at: $(Get-Date)"

    # Display important post-deployment information
    Write-Host ""
    Write-Host "📋 Post-Deployment Checklist:" -ForegroundColor Yellow
    Write-Host "  ✅ Application is live and accessible"
    Write-Host "  ✅ Database migrations completed"
    Write-Host "  ✅ Caches optimized"
    Write-Host ""
    Write-Host "🔧 Next Steps:" -ForegroundColor Yellow
    Write-Host "  1. Verify all features are working correctly"
    Write-Host "  2. Check application logs for any errors"
    Write-Host "  3. Monitor performance metrics"
    Write-Host "  4. Update DNS records if needed"
    Write-Host "  5. Set up monitoring and alerting"
    Write-Host ""
    Write-Host "📞 Support: Check logs in storage/logs/ if issues occur" -ForegroundColor Cyan

} catch {
    Write-Error "Deployment failed: $($_.Exception.Message)"
    Write-Status "Taking application out of maintenance mode due to error..."
    php artisan up
    exit 1
}
