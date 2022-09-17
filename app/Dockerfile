FROM node:latest

ARG UID=1000
ARG GID=1000
RUN userdel -r node
RUN addgroup --system --gid $GID TODO
RUN adduser --system --uid $UID --ingroup TODO TODO
USER TODO

WORKDIR /usr/src/app
COPY package*.json ./
EXPOSE 4200

ENTRYPOINT ["sh", "build.sh"]
