<?php

namespace App\Actions;

use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class OptimizeWebpImageAction
{
    /**
     * Create a new class instance.
     */
    public function handle(string $input): array
    {
        // Image optimization
        $image = Image::read($input);

        // Scale down only
        if ($image->width() > 1000) {
            $image->scale(width: 1000);
        }

        $encoded = $image->toWebp(quality: 95)->toString();
        $fileName = Str::random().'.webp';

        return [
            'fileName' => $fileName,
            'webpString' => $encoded,
        ];
    }
}
