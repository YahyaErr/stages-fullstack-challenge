<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertArticlesTableToUtf8mb4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE articles CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci');
        
        // Convertir spécifiquement les colonnes texte
        DB::statement('ALTER TABLE articles MODIFY title VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci');
        DB::statement('ALTER TABLE articles MODIFY content TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci');
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE articles CONVERT TO CHARACTER SET latin1 COLLATE latin1_general_ci');
        DB::statement('ALTER TABLE articles MODIFY title VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci');
        DB::statement('ALTER TABLE articles MODIFY content TEXT CHARACTER SET latin1 COLLATE latin1_general_ci');
    
    }
}
