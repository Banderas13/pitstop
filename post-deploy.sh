#!/bin/bash
# Laravel post-deployment script

# Go to the application directory
cd ~subsite/pitstop.be

# Basic deployment confirmation
echo "Files deployed successfully to subsite/pitstop.be"

# Check if .env file exists, if not notify to create one
if [ ! -f .env ]; then
    echo "⚠️  WARNING: .env file not found!"
    echo "Please create a .env file by copying .env.example and configuring it for your environment."
    echo "Run: cp .env.example .env && php artisan key:generate"
fi

# Display PHP version for verification
php -v

# Laravel deployment tasks
echo "📦 Running Laravel deployment commands..."

# Install/update PHP dependencies with Composer
echo "🔄 Updating Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node.js dependencies
echo "🔄 Installing Node.js dependencies..."
npm ci --only=production

# Build assets for production
echo "🏗️ Building production assets..."
npm run build

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Create storage symlink if it doesn't exist
php artisan storage:link

# Run migrations (optional, uncomment if needed)
# php artisan migrate --force

echo "✅ Deployment completed successfully!"