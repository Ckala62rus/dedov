FROM php:8.1.5-fpm-alpine

COPY docker/cron/crontab /etc/crontabs/root

CMD ["crond", "-f"]
