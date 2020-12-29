envsubst '$$FPM_HOST $$FPM_PORT' < /etc/nginx/conf.d/default.conf > /etc/nginx/conf.d/nginx.conf.tmpl
rm /etc/nginx/conf.d/default.conf
mv /etc/nginx/conf.d/nginx.conf.tmpl /etc/nginx/conf.d/default.conf
nginx -g 'daemon off;'
