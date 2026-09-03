FROM node:22-alpine

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci --include=dev

COPY . .
RUN npm run build

ENV PORT=4173
EXPOSE 4173

CMD ["sh", "-c", "npm run preview -- --host 0.0.0.0 --port ${PORT}"]
