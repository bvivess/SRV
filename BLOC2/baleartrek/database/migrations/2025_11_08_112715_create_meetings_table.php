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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onUpdate("restrict")->onDelete("restrict");
            $table->foreignId("trek_id")->constrained()->onUpdate("restrict")->onDelete("restrict");
            $table->date("day");
            $table->time("time");
            $table->integer('totalScore')->default(0);
            $table->integer('countScore')->default(0);
            $table->date("appDateIni");
            $table->date("appDateEnd");
            $table->timestamps();
        });

        DB::statement('
            CREATE TRIGGER update_scores_after_insert_meetings
            AFTER INSERT ON meetings
            FOR EACH ROW
            BEGIN
                UPDATE treks
                SET totalScore = totalScore + IFNULL(NEW.totalscore, 0),
                    countScore = countScore + 1
                WHERE id = NEW.trek_id;

            END;
        ');

        DB::statement('
            CREATE TRIGGER update_scores_after_update_meetings
            AFTER UPDATE ON meetings
            FOR EACH ROW
            BEGIN
                UPDATE treks
                SET totalScore = totalScore + IFNULL(NEW.totalscore, 0) - IFNULL(OLD.totalscore, 0)
                WHERE id = IFNULL(NEW.trek_id, OLD.trek_id);
            END;
        ');

        DB::statement('
            CREATE TRIGGER update_scores_after_delete_meetings
            AFTER DELETE ON meetings
            FOR EACH ROW
            BEGIN
                UPDATE treks
                SET totalScore = totalScore - IFNULL(OLD.totalscore, 0),
                    countScore = countScore - 1
                WHERE id = OLD.trek_id;
            END;
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_insert_meetings');
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_update_meetings');
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_delete_meetings');
        Schema::dropIfExists('meetings');
    }
};
