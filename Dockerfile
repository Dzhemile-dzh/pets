FROM registry.gitlab.com/racing-post/internal-api/php-api-base:AD-1119-upgrade-php-7.3

ENV ASE_HOST=rp1-dev-ase-06.rp-infra.com
ENV ASE_PORT=5000

WORKDIR /code/v2/

COPY composer.lock composer.json package.json /code/v2/
COPY bo /code/v2/bo
COPY config /code/v2/config
COPY controllers /code/v2/controllers
COPY documentation /code/v2/documentation
COPY env /code/v2/env
COPY lib /code/v2/lib
COPY models /code/v2/models
COPY provider /code/v2/provider
COPY public /code/v2/public
COPY swagger /code/v2/public/documentation/swagger

RUN mkdir -p .git/hooks /var/log/rp
RUN chown apache: /var/log/rp
RUN composer install
RUN npm install
RUN composer build-raml
RUN cp /code/v2/public/documentation/swagger/swagger-file/swagger.yaml /code/v2/public/documentation/swagger/swagger-file/swagger-uat.yaml
RUN sed -i 's/production.global.rp-cloudinfra.com/uat.global.rp-cloudinfra.com/g' /code/v2/public/documentation/swagger/swagger-file/swagger-uat.yaml

# PHP CONFIG - This service has a huge amount of data being parsed which is why we increase execution time and memory limit
RUN sed -i '/memory_limit/c\memory_limit = 1024M' /etc/php.ini
RUN sed -i '/max_execution_time/c\max_execution_time = 60' /etc/php.ini

COPY httpd.conf /etc/httpd/conf/httpd.conf
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
