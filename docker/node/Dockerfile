FROM node:latest

# use nodemon for development
RUN npm install --global nodemon

#COPY . /home

WORKDIR /home/docker/node/home
RUN npm install

CMD ["nodemon"]
