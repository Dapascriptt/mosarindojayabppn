<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

trait HandlesAdminUploads
{
    protected function storeSingleUpload(Request $request, string $field, string $directory, ?string $current = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $current;
        }

        return $request->file($field)->store($directory, 'public');
    }

    protected function storeMultipleUploads(Request $request, string $field, string $directory, array $current = []): array
    {
        $files = $request->file($field, []);
        $files = is_array($files) ? $files : [$files];

        $stored = collect($files)
            ->filter(fn ($file) => $file instanceof UploadedFile)
            ->map(fn (UploadedFile $file) => $file->store($directory, 'public'))
            ->values()
            ->all();

        return array_values(array_filter(array_merge($current, $stored)));
    }

    protected function linesToItems(?string $value, string $key = 'text'): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(fn ($line) => [$key => $line])
            ->values()
            ->all();
    }
}
