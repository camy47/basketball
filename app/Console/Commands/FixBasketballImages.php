<?php

namespace App\Console\Commands;

use App\Models\Basketball;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FixBasketballImages extends Command
{
    protected $signature = 'basketballs:fix-images';
    protected $description = 'Fix basketball image paths in the database';

    public function handle()
    {
        $basketballs = Basketball::whereNotNull('image')->get();
        
        foreach ($basketballs as $basketball) {
            // Extract filename from the temporary path
            $filename = basename($basketball->image);
            
            // Set the correct path
            $basketball->image = 'basketballs/' . $filename;
            $basketball->save();
        }

        $this->info('Basketball image paths have been fixed!');
    }
} 