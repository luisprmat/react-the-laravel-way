<?php

namespace App\Console\Commands;

use App\Models\Puppy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeleteUnusedPuppyImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-unused-puppy-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up uploaded imeges that are no longer referenced in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ------------------------------
        // Find unused images
        // ------------------------------

        // Get all stored images in 'puppies' directory
        $storedImages = Storage::disk('public')->files('puppies');

        // Get all imaged referenced by puppies
        $usedImages = Puppy::pluck('image_url')->toArray();

        // Compare both arrays
        $unusedImages = array_diff($storedImages, $usedImages);

        // ------------------------------
        // Report
        // ------------------------------

        $totalCount = count($unusedImages);

        if ($totalCount === 0) {
            $this->warn('No unused images found!');

            return;
        }

        $this->info('Found '.$totalCount.' unused '.Str::plural('image', $totalCount));
        $this->newLine();

        // Show name for first 3 images, and then "+ X more..." if any.
        $firstThree = array_slice($unusedImages, 0, 3);
        foreach ($firstThree as $image) {
            $this->line("- {$image}");
        }
        if ($totalCount > 3) {
            $remaining = $totalCount - 3;
            $this->line("+ {$remaining} more...");
        }

        $this->newLine();

        // ------------------------------
        // Delete (upon confirmation)
        // ------------------------------

        if ($this->confirm('Do you want to delete these unused images?', true)) {
            foreach ($unusedImages as $image) {
                Storage::disk('public')->delete($image);
                $this->line('<fg=blue>- Deleted: '.$image);
            }
            $this->newLine();
            $this->info('Unused images deleted successfully.');
        } else {
            $this->warn('Operation cancelled.');
        }
    }
}
