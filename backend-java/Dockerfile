ARG ENVIRONMENT=prod

FROM maven:3.9-eclipse-temurin-17-alpine AS build
RUN mkdir -p /app
WORKDIR app
COPY pom.xml ./
RUN mvn verify --fail-never
COPY src src
RUN mvn verify package

FROM build AS build-local
RUN apk add --update inotify-tools
COPY start.sh start.sh
ENV COMMAND="./start.sh"

FROM eclipse-temurin:18.0.1_10-jre-alpine AS build-prod
COPY --from=build ./app/target/service.jar service.jar
ENV COMMAND="java -jar service.jar"

FROM build-${ENVIRONMENT} AS release

CMD $COMMAND