FROM    node:latest

RUN mkdir -p /home
WORKDIR /home
COPY . /home

RUN npm install

CMD ["npm", "start"]
