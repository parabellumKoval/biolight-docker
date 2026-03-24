#!/bin/sh
set -e

normalize_names() {
  echo "$1" | tr ',' ' ' | xargs
}

FRONTEND_DOMAIN="${FRONTEND_DOMAIN:-${DOMAIN:-}}"
FRONTEND_SERVER_ALIASES="${FRONTEND_SERVER_ALIASES:-${SERVER_ALIASES:-}}"
BACKEND_DOMAIN="${BACKEND_DOMAIN:-$FRONTEND_DOMAIN}"
BACKEND_SERVER_ALIASES="${BACKEND_SERVER_ALIASES:-}"
CERTBOT_PRIMARY_DOMAIN="${CERTBOT_PRIMARY_DOMAIN:-$FRONTEND_DOMAIN}"

if [ -z "${FRONTEND_DOMAIN:-}" ]; then
  echo "FRONTEND_DOMAIN (or legacy DOMAIN) is required" >&2
  exit 1
fi

FRONTEND_SERVER_NAMES="$(normalize_names "$FRONTEND_DOMAIN $FRONTEND_SERVER_ALIASES")"
BACKEND_SERVER_NAMES="$(normalize_names "$BACKEND_DOMAIN $BACKEND_SERVER_ALIASES")"

export FRONTEND_DOMAIN \
  FRONTEND_SERVER_ALIASES \
  FRONTEND_SERVER_NAMES \
  BACKEND_DOMAIN \
  BACKEND_SERVER_ALIASES \
  BACKEND_SERVER_NAMES \
  CERTBOT_PRIMARY_DOMAIN

render_config() {
  cert_path="/etc/letsencrypt/live/${CERTBOT_PRIMARY_DOMAIN}/fullchain.pem"
  mode="single"

  if [ "$FRONTEND_SERVER_NAMES" != "$BACKEND_SERVER_NAMES" ]; then
    mode="split"
  fi

  if [ -f "$cert_path" ]; then
    template="/etc/nginx/templates/site-${mode}-https.conf.template"
  else
    template="/etc/nginx/templates/site-${mode}-http.conf.template"
  fi

  envsubst \
    '${FRONTEND_DOMAIN} ${FRONTEND_SERVER_ALIASES} ${FRONTEND_SERVER_NAMES} ${BACKEND_DOMAIN} ${BACKEND_SERVER_ALIASES} ${BACKEND_SERVER_NAMES} ${CERTBOT_PRIMARY_DOMAIN}' \
    < "$template" > /etc/nginx/conf.d/default.conf
}

render_config

(
  while true; do
    sleep "${NGINX_RELOAD_INTERVAL:-5m}"
    render_config
    nginx -s reload || true
  done
) &

exec nginx -g 'daemon off;'
