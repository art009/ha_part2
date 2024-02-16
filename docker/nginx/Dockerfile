FROM nginx:latest

USER "${USER_ID}:${GROUP_ID}"
ENV LANG=en_US.UTF-8

WORKDIR /var/www/html

RUN apt-get update  \
    && apt-get install -y procps curl locales-all \
    && rm -rf /var/lib/apt/lists/*