FROM php:8.1-fpm

# Create the SQLite file
RUN mkdir -p /var/www/database && touch /var/www/database/database.sqlite

# Set environment variables
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/var/www/database/database.sqlite
          