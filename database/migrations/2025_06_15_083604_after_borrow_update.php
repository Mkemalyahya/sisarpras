<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP TRIGGER IF EXISTS after_borrow_approved;

            CREATE TRIGGER after_borrow_approved
            AFTER UPDATE ON borrows
            FOR EACH ROW
            BEGIN
                IF NEW.status = "approved" AND OLD.status != "approved" THEN
                    -- Kurangi quantity item
                    UPDATE items
                    SET
                        quantity = quantity - NEW.quantity,
                        status = "borrowed"
                    WHERE id = NEW.item_id;
                END IF;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_borrow_approved');
    }
};
