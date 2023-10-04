<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class DeleteTempUploadedFiles extends Command
{
    protected $signature = 'app:delete-temp-uploaded-files';

    protected $description = 'Delete temporary uploaded files older than 24 hours.';

    public function handle(): void
    {
        foreach (Storage::directories('tmp') as $directory) {
            $directoryLastModified = Carbon::createFromTimestamp(Storage::lastModified($directory));

            if (now()->diffInHours($directoryLastModified) > 24) {
                Storage::deleteDirectory($directory);
            }
        }
    }
}
