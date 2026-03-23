FROM nginx:1.27-alpine

RUN apk add --no-cache gettext

COPY .docker/nginx/templates /etc/nginx/templates
COPY .docker/nginx/start.sh /usr/local/bin/nginx-start

RUN chmod +x /usr/local/bin/nginx-start

CMD ["/usr/local/bin/nginx-start"]
