##########
## BASE ##
##########
FROM registry.whatwedo.ch/whatwedo/docker-base-images/symfony:v2.7 as base

ARG GIT_COMMIT_SHORT_SHA=UNKNOWN
ENV GIT_COMMIT_SHORT_SHA=$GIT_COMMIT_SHORT_SHA

#########
## DEV ##
#########
FROM base as dev

RUN apk add --no-cache make php$PHP_VERSION-xdebug

COPY ./docker/dev/rootfs/etc /etc

# configure DDE
COPY .dde/configure-image.sh /tmp/dde-configure-image.sh
ARG DDE_UID
ARG DDE_GID
RUN /tmp/dde-configure-image.sh

##############
## COMPOSER ##
##############
FROM base as composer

# Add files
COPY ./ /var/www/

# install global dependencies
RUN composer install --prefer-dist

########################################################################
## PROD
########################################################################
FROM base as prod

COPY --from=composer --chown=nginx:nginx /var/www /var/www/

