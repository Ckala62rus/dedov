FROM php:8.0.9-fpm-alpine3.14

COPY crontab /etc/crontabs/root

CMD ["crond", "-f"]
