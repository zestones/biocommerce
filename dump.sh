#!/bin/bash

# Set the path to your SQLite database file
DATABASE_FILE="./src/database/agrovia_database.db"

# Check if the database file exists
if [ -f "$DATABASE_FILE" ]; then
    # If the database file exists, delete it
    rm "$DATABASE_FILE"
    echo "> Existing database file deleted"
fi

# Create a new SQLite database file
touch "$DATABASE_FILE"

# Run the SQL script to create tables
sqlite3 "$DATABASE_FILE" < ./src/database/create_tables.sql

# Run the SQL script to insert data
sqlite3 "$DATABASE_FILE" < ./src/database/insert_data.sql

# Display a message indicating the process is complete
echo "> Database reset and data inserted successfully"
