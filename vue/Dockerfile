# Image
FROM node:18-alpine

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN deluser --remove-home node && \
    addgroup -S dejan -g $GROUP_ID && \
    adduser -S -G dejan -u $USER_ID dejan

# Set up work directory
WORKDIR /vue

COPY package*.json ./

RUN npm install

EXPOSE 3000

USER dejan

# Init command
ENTRYPOINT ["sh"]