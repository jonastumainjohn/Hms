<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backup of the database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $backupPath = storage_path('app/backups/' . date('Y-m-d_H-i-s') . '_backup.sql');

        // Create the backups directory if it doesn't exist
        if (!file_exists(dirname($backupPath))) {
            mkdir(dirname($backupPath), 0755, true);
        }

        $command = "mysqldump -h $host -u $username -p$password $database > $backupPath";

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info('Backup successfully created at ' . $backupPath);
        } else {
            $this->error('Failed to create backup.');
        }
    }
}
