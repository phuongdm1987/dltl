FROM dltl-app-dev

# Change current user to www
USER root

RUN apt-get --allow-releaseinfo-change update \
 && apt-get install -y cron

ADD crontab /etc/cron.d/dltl

RUN chmod 0644 /etc/cron.d/dltl
RUN crontab /etc/cron.d/dltl
RUN touch /var/log/cron.log

# Run the command on container startup
CMD cron && tail -f /var/log/cron.log
