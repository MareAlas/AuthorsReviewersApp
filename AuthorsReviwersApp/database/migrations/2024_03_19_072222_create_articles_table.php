<?php

use App\Enums\ArticleStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $statusValues = array_values(ArticleStatus::toArray());
        $defaultStatus = ArticleStatus::PENDING;

        Schema::create('articles', function (Blueprint $table) use ($statusValues, $defaultStatus) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->enum('status', $statusValues)->default($defaultStatus);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
}