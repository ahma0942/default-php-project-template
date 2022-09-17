<?php
$migrationsDir = __DIR__ . "/migrations/";
$migrationsFile = __DIR__ . "/.migrations";
$migrations = array_diff(scandir($migrationsDir), array('.', '..'));
$current = file_exists($migrationsFile) ? @file_get_contents($migrationsFile) : false;

if (!$current || !in_array($current, $migrations)) {
    echo "Migrating from start\n";
    foreach ($migrations as $migration) {
        echo "Running $migration\n";
        DI::database()->sql(file_get_contents($migrationsDir . $migration));
    }
    file_put_contents(__DIR__ . "/.migrations", $migration);
} elseif (array_search($current, $migrations) - 2 != count($migrations) - 1) {
    echo "Migrating from $current\n";
    $start = false;
    foreach ($migrations as $migration) {
        if ($start) {
            echo "Running $migration\n";
            DI::database()->sql(file_get_contents($migrationsDir . $migration));
        }

        if ($migration == $current) {
            $start = true;
        }
    }
    file_put_contents(__DIR__ . "/.migrations", $migration);
} else {
    echo "Migrations are up to date\n";
}

echo "\n";
