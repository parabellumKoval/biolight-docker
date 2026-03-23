#!/bin/sh
set -e

if [ -z "${CERTBOT_EMAIL:-}" ] || [ -z "${CERTBOT_DOMAINS:-}" ]; then
  echo "CERTBOT_EMAIL and CERTBOT_DOMAINS are required" >&2
  sleep infinity
fi

DOMAIN_ARGS=""
for domain in $(echo "$CERTBOT_DOMAINS" | tr ',' ' '); do
  DOMAIN_ARGS="$DOMAIN_ARGS -d $domain"
done

while true; do
  certbot certonly \
    --webroot \
    --webroot-path /var/www/certbot \
    --email "$CERTBOT_EMAIL" \
    --agree-tos \
    --no-eff-email \
    --non-interactive \
    --keep-until-expiring \
    $DOMAIN_ARGS || true

  certbot renew --webroot --webroot-path /var/www/certbot --quiet || true

  sleep "${CERTBOT_RENEW_INTERVAL:-12h}"
done
