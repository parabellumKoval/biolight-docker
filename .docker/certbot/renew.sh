#!/bin/sh
set -e

while true; do
  sh /etc/certbot/certbot-once.sh || true

  if [ "${CERTBOT_ONE_SHOT:-false}" = "true" ]; then
    exit 0
  fi

  sleep "${CERTBOT_RENEW_INTERVAL:-12h}"
done
