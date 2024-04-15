FROM ubuntu:20.04
ENV DEBIAN_FRONTEND=noninteractive
MAINTAINER iplon-india-dev
RUN apt update
RUN apt install -y apache2
RUN apt install -y php libapache2-mod-php
COPY get_data.php /var/www/html/
COPY get_data_variable.php /var/www/html/
EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
