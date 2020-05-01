FROM mysql:5.7

WORKDIR /app
COPY ./ ./

ENTRYPOINT [ "/app/load-databases.sh" ]