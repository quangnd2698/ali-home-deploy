FROM nginx:1.17.10

# Copy source code
COPY ./docker/nginx_conf /etc/nginx/conf.d/
COPY ./ /var/www/html
RUN chmod -R 777 /var/www/html/storage
RUN chmod +x /var/www/html/docker/nginx_script.sh

CMD sh /var/www/html/docker/nginx_script.sh

# Timezone
ENV TZ=Asia/Tokyo
RUN date
