<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP TRIGGER IF EXISTS after_returning_update;

            CREATE TRIGGER after_returning_update
            AFTER INSERT ON returnings
            FOR EACH ROW
            BEGIN
                -- Ambil jumlah yang dipinjam dari tabel borrows
                DECLARE borrowed_qty INT;

                SELECT quantity INTO borrowed_qty
                FROM borrows
                WHERE id = NEW.borrow_id;

                -- Tambah quantity item
                UPDATE items
                SET
                    quantity = quantity + borrowed_qty,
                    status = "available"
                WHERE id = NEW.item_id;

                -- Ubah status borrow jadi returned
                UPDATE borrows
                SET status = "returned"
                WHERE id = NEW.borrow_id;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_returning_update');
    }
};
