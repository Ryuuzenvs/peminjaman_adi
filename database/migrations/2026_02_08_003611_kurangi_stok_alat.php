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
//trig
        //db:unpre "" triger name. where, ins tabel  for row 
// begin
// upd tabel, set var stck,
//end

//DB::unprepared("
//    CREATE TRIGGER kurangi_stok_alat
//    AFTER UPDATE ON loans
//    FOR EACH ROW
//    BEGIN
//        -- Stok berkurang HANYA saat status berubah dari 'pending' ke 'borrow'
//        IF OLD.status = 'pending' AND NEW.status = 'borrow' THEN
//            UPDATE tools SET stock = stock - NEW.qty WHERE id = NEW.tool_id;
//        END IF;
//        
//        -- Stok kembali saat status jadi 'return'
//        IF OLD.status = 'borrow' AND NEW.status = 'return' THEN
//            UPDATE tools SET stock = stock + NEW.qty WHERE id = NEW.tool_id;
//        END IF;
//    END
//");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
