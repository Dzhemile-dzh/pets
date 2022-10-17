#!/bin/bash


DB_SHORT_NAME=$(echo "${ASE_HOST}" | awk -F\. '{print $1}')

#Create freeTDS config
cat << EOF > /etc/freetds.conf
[global]
	tds version = auto
	text size = 64512
[ASE]
	host = $ASE_HOST
	port = $ASE_PORT
	tds version = 5.0
[$DB_SHORT_NAME]
	host = $ASE_HOST
	port = $ASE_PORT
	tds version = 5.0
EOF

export AUTH_DB_SERVERNAME_API_HORSES=$DB_SHORT_NAME
export CTRL_NODES_SERVERNAME_API_HORSES=$DB_SHORT_NAME
export CTRL_LOGGER_GENERAL_LEVEL_API_HORSES="ERROR"
export CTRL_REDIS_CACHEON_API_HORSES=1

#To enable debugging output
if [ "$MAKE_THINGS_VERBOSE" != "" ]; then
    echo 'display_errors=On' >> /etc/php.ini
    echo 'error_reporting=E_ALL' >> /etc/php.ini
fi

if [ "${ENVIRONMENT}" != "production" ]; then
    export CTRL_LOGGER_GENERAL_LEVEL_API_HORSES="TRACE"
fi

if grep instance_ip /var/lib/ecs_metadata; then
  DATADOG_TRACE_AGENT_HOSTNAME=$(grep instance_ip /var/lib/ecs_metadata | awk -F\: '{print $2}')
  export DATADOG_TRACE_AGENT_HOSTNAME
fi
export RP_ENVIRONMENT="${ENVIRONMENT}"
echo "Using ${DATADOG_TRACE_AGENT_HOSTNAME} for APM traces - connection test:"
time curl -v "http://${DATADOG_TRACE_AGENT_HOSTNAME}:8126/v0.3/traces"
export AUTH_REDIS_CLUSTER_API_HORSES="$REDIS_CACHE:6379;$REDIS_CACHE:6379;"
export LOG_ACCESS_LOG="no" # change this to yes to include access logs in cloudwatch
export PRODUCT_BRANCH="${APP_BUILD_BRANCH:-NotSet}"

#Chamber will inject secrets if it's installed
if which chamber; then
    chamber exec horses-api -- httpd -DFOREGROUND
else
    httpd -DFOREGROUND
fi
