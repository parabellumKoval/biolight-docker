#!/bin/sh
set -e

if [ -z "${DOMAIN:-}" ]; then
  echo "DOMAIN is required" >&2
  exit 1
fi

SERVER_ALIASES="${SERVER_ALIASES:-}"
SERVER_ALIASES="$(echo "$SERVER_ALIASES" | tr ',' ' ')"
export DOMAIN SERVER_ALIASES

render_config() {
  cert_path="/etc/letsencrypt/live/${DOMAIN}/fullchain.pem"

  if [ -f "$cert_path" ]; then
    template="/etc/nginx/templates/site-https.conf.template"
  else
    template="/etc/nginx/templates/site-http.conf.template"
  fi

  envsubst '${DOMAIN} ${SERVER_ALIASES}' < "$template" > /etc/nginx/conf.d/default.conf
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
