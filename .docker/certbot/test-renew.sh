#!/bin/sh
set -e

export CERTBOT_STAGING=true
export CERTBOT_FORCE_RENEWAL=true
export CERTBOT_ONE_SHOT=true

exec sh /etc/certbot/renew.sh
