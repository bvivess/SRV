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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->unsignedTinyInteger('score');
            $table->enum('status', ['y', 'n'])->default('n');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('meeting_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE comments ADD CONSTRAINT check_score CHECK (score BETWEEN 0 AND 5)');

        DB::statement('
            CREATE TRIGGER update_scores_after_insert_comments
            AFTER INSERT ON comments
            FOR EACH ROW
            BEGIN
                IF (NEW.status = "y") THEN
                    UPDATE meetings
                    SET totalScore = totalScore + IFNULL(NEW.score, 0),
                        countScore = countScore + 1
                    WHERE id = NEW.meeting_id;
                END IF;
            END;
        ');

        DB::statement('
            CREATE TRIGGER update_scores_after_update_comments
            AFTER UPDATE ON comments
            FOR EACH ROW
            BEGIN
                IF (NEW.score != OLD.score) THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "No se puede modificar el valor de \'score\'.";
                ELSEIF (OLD.status = "n") AND (NEW.status = "y") THEN
                    UPDATE meetings
                    SET totalScore = totalScore + IFNULL(NEW.score, 0),
                        countScore = countScore + 1
                    WHERE id = NEW.meeting_id;
                ELSEIF (OLD.status = "y") AND (NEW.status = "n")  THEN
                    UPDATE meetings
                    SET totalScore = totalScore - IFNULL(NEW.score, 0),
                        countScore = countScore - 1
                    WHERE id = NEW.meeting_id;
                END IF;
            END;
        ');

        DB::statement('
            CREATE TRIGGER update_scores_after_delete_comments
            AFTER DELETE ON comments
            FOR EACH ROW
            BEGIN
                IF (OLD.status = "y") THEN
                    UPDATE meetings
                    SET totalScore = totalScore - IFNULL(OLD.score, 0),
                        countScore = countScore - 1
                    WHERE id = OLD.meeting_id;
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_insert_comments');
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_update_comments');
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_delete_comments');
        Schema::dropIfExists('comments');
    }
};
