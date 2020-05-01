FROM mysql:5.7

WORKDIR /app

COPY ./ ./
RUN chmod +x load-databases.sh

ENTRYPOINT [ "/app/load-databases.sh" ]