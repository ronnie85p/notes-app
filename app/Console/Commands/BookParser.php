<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Profile\Settings;
use App\Services\Books\BookParserService;

class BookParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:book-parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = Settings::first();
        if (empty($settings)) {
            // exit("Settings not found!\n");
        }

        if (empty($settings?->books_source_url)) {
            // exit("Source url is required!\n");
        }

        $books_source_url = 'https://gitlab.grokhotov.ru/hr/yii-test-vacancy/-/raw/master/books.json?inline=false';
        BookParserService::handle($books_source_url, function ($book) {
            echo print_r($book, true);
        });

        return "Done!\n";
    }
}