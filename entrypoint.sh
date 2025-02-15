#!/bin/sh
cd /var/www

echo "[Entrypoint] Starting polling file watcher for selected files..."

# Function to generate a snapshot of the watched files with their modification times.
generate_snapshot() {
  (
    # Files in directories without filtering extensions:
    find app bootstrap routes -type f -print0 | xargs -0 stat -c "%n %Y"
    # Only PHP files in these directories:
    find config -type f -name "*.php" -print0 | xargs -0 stat -c "%n %Y"
    find database -type f -name "*.php" -print0 | xargs -0 stat -c "%n %Y"
    find public -type f -name "*.php" -print0 | xargs -0 stat -c "%n %Y"
    find resources -type f -name "*.php" -print0 | xargs -0 stat -c "%n %Y"
    # Files in the project root:
    find . -maxdepth 1 \( -name "composer.lock" -o -name ".env" \) -print0 | xargs -0 stat -c "%n %Y"
  ) | sort
}

# Log the count of files found for debugging.
count=$(generate_snapshot | wc -l)
echo "[Watch] Found $count files to watch."

# Get initial snapshot.
prev=$(generate_snapshot)

# Start a background loop that polls for changes every 0.5 seconds.
(
  while true; do
    curr=$(generate_snapshot)
    if [ "$prev" != "$curr" ]; then
      echo "[Reload] File change detected at $(date)"
      php artisan octane:reload
      prev="$curr"
    fi
    sleep 0.5
  done
) &

# Execute the main command 
exec "$@"
