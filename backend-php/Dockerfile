# Use the official PHP image with the Apache server
FROM php:8.2-cli

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli

# Copy application source
COPY . .

# Install dependencies with Composer
# It's important to run composer as non-root (www-data)
RUN composer install --no-interaction --no-progress

# Expose port 8000 for Symfony server
EXPOSE 8000

# Start Symfony server
CMD ["symfony", "server:start", "--no-tls", "--port=8000"]
