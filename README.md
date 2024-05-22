# Bookings

System that manages patient bookings

## Prerequisites

- Docker
- Web browser

## Getting Started

1. **Copy Environment File**:
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env

2. **Build Docker Container**:
   Build the Docker container:
   ```bash
   docker-compose build

3. **Start Docker Container**:
   Start the Docker container:
   ```bash
   docker-compose up -d

4. **Apply the Database Migration**:
   Connect to your database using the credentials specified in the `.env` file, and apply the migration located at `database/migrations/main.sql`.

5. **Accessing the Application**:
   Open your web browser and navigate to [Bookings page](http://localhost:8080/).