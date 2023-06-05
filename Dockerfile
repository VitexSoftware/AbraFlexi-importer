FROM php8.2:latest
LABEL Name=abraflexiimporter Version=0.0.1
RUN apt-get -y update && apt-get install -y fortunes
CMD ["/usr/bin/abraflexi-importer"]
