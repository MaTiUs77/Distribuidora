FROM    node:latest

RUN mkdir -p /home
WORKDIR /home
COPY . /home

RUN npm install

EXPOSE  8080

CMD ["npm", "start"]
