<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class SetupDatabase extends Command
{
    protected $signature = 'setup:database';
    protected $description = 'Create the database specified in .env if it does not exist';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get database name from .env file
        $database = env('DB_DATABASE');
        if (!$database) {
            $this->error('Database name not specified in .env file.');
            return;
        }

        // Temporarily set database name to null for connection
        $defaultDatabase = Config::get('database.connections.mysql.database');
        Config::set('database.connections.mysql.database', null);
        DB::reconnect();

        // Check if database exists, create it if it doesn't
        try {
            $query = "CREATE DATABASE IF NOT EXISTS `$database`";
            DB::statement($query);
            $this->info("Database '$database' created or already exists.");

            // Reconnect to the newly created database
            Config::set('database.connections.mysql.database', $database);
            DB::reconnect();
        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
            return;
        }

        // Run migrations
        $this->call('migrate');
        $this->info('Database setup and migrations completed successfully.');
    }
}
