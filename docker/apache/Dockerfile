# docker/apache/Dockerfile
FROM httpd:2.4.51
COPY projetotest.apache.conf /usr/local/apache2/conf/projetotest.apache.conf

RUN echo "Include /usr/local/apache2/conf/projetotest.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf