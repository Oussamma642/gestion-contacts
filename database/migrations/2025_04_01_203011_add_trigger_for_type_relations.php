<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER before_insert_type_relation
            BEFORE INSERT ON type_relations
            FOR EACH ROW
            BEGIN
                DECLARE type_exists INT;
                SELECT COUNT(*) INTO type_exists 
                FROM type_relations 
                WHERE type = NEW.type;

                IF type_exists = 0 THEN
                    INSERT INTO type_relations (type, created_at, updated_at) 
                    VALUES (NEW.type, NOW(), NOW());
                END IF;
            END;
        ");
    }

    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS before_insert_type_relation");
    }
};