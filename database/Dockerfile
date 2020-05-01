FROM mysql:5.7

WORKDIR /app
COPY ./ ./

ENTRYPOINT [ "bash", "/app/load-databases.sh" ]