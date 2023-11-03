<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * "title": "Hello! HTML5 & CSS3",
            "isbn": "1935182897",
            "pageCount": 325,
            "publishedDate": { "$date": "2012-10-17T00:00:00.000-0700" },
            "thumbnailUrl": "https://s3.amazonaws.com/AKIAJC5RLADLUMVRPFDQ.book-thumb-images/crowther.jpg",
            "shortDescription": "Quick and Easy HTML5 and CSS3 is written for the web designer or developer who wants a fast, example-oriented introduction to the new HTML and CSS features. After a quick review of the basics, you'll turn to what's new. Start by learning to apply important new elements and attributes by building your first real HTML5 pages. You'll then take a quick tour through the new APIs: Form Validation, Canvas, Drag & Drop, Geolocation and Offline Applications. You'll also discover how to include video and audio on your pages without plug-ins, and how to draw interactive vector graphics with SVG.",
            "longDescription": "HTML and CSS are the foundation of the web, and HTML5 and CSS3 are the latest standards. If you build web pages, mobile apps, or do any type of development at all, you'll have to learn HTML5 and CSS3, so why not start now  Quick and Easy HTML5 and CSS3 will give you a smart, snappy, and fun introduction to building web sites with these really cool new tools.    Quick and Easy HTML5 and CSS3 is written for the web designer or developer who wants a fast, example-oriented introduction to the new HTML and CSS features. After a quick review of the basics, you'll turn to what's new. Start by learning to apply important new elements and attributes by building your first real HTML5 pages. You'll then take a quick tour through the new APIs: Form Validation, Canvas, Drag & Drop, Geolocation and Offline Applications. You'll also discover how to include video and audio on your pages without plug-ins, and how to draw interactive vector graphics with SVG.    Once you've explored the fundamentals of HTML5, it's time to add some style to your pages with CSS3. New CSS features include drop shadows, borders, colors, gradients and backgrounds. In addition, you'll learn to layout your pages with the new flexible box and layout modules, and add the finishing touches with custom fonts. You'll also see how to target specific devices with media queries, and do all of it with less code thanks to the new selectors and pseudo classes.    Finally you will walk through several large examples where you see all the features of HTML5 and CSS3 working together to produce responsive and lightweight applications which you can interact with just like native desktop apps.",
            "status": "PUBLISH",
            "authors": ["Rob Crowther"],
            "categories": ["Internet"]

         */
        /**
         * category
         */

        /**
         * table books (isbn)
         */

         /** status, author, category */
         /**
          * table authors (id, first_name, last_name)

           author -> many books
           book -> many authors
           relations many to many
           pivot table category_book
          */

        /**
         * one to one
         * table statuses (id, name, description)
         */

         /**
          * table categories (id, parent_id, name, description)
          * 
          */

        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // unique
            $table->string('isbn')->unique();

            // foreign
            $table->foreignId('status_id')->nullable()->constrained();
            $table->foreignId('category_id')->constrained();

            // data
            $table->string('title');
            $table->integer('page_count');
            $table->string('thumbnail_url');
            $table->mediumText('short_description');
            $table->text('long_description');

            $table->timestamp('published_at')->nullable();

            // timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
