#!/bin/sh
set -e

if [ -z "${CERTBOT_EMAIL:-}" ] || [ -z "${CERTBOT_DOMAINS:-}" ]; then
  echo "CERTBOT_EMAIL and CERTBOT_DOMAINS are required" >&2
  exit 1
fi

PRIMARY_DOMAIN="${CERTBOT_PRIMARY_DOMAIN:-$(echo "$CERTBOT_DOMAINS" | cut -d',' -f1 | tr -d ' ')}"

if [ -z "$PRIMARY_DOMAIN" ]; then
  echo "CERTBOT_PRIMARY_DOMAIN could not be resolved" >&2
  exit 1
fi

DOMAIN_ARGS=""
for domain in $(echo "$CERTBOT_DOMAINS" | tr ',' ' '); do
  DOMAIN_ARGS="$DOMAIN_ARGS -d $domain"
done

CERTBOT_ARGS="\
  --webroot \
  --webroot-path /var/www/certbot \
  --email $CERTBOT_EMAIL \
  --agree-tos \
  --no-eff-email \
  --non-interactive \
  --expand \
  --cert-name $PRIMARY_DOMAIN"

if [ "${CERTBOT_STAGING:-false}" = "true" ]; then
  CERTBOT_ARGS="$CERTBOT_ARGS --test-cert"
fi

if [ "${CERTBOT_FORCE_RENEWAL:-false}" = "true" ]; then
  CERTBOT_ARGS="$CERTBOT_ARGS --force-renewal"
else
  CERTBOT_ARGS="$CERTBOT_ARGS --keep-until-expiring"
fi

certbot certonly $CERTBOT_ARGS $DOMAIN_ARGS
