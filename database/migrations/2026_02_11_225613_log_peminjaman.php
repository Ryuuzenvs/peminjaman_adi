<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS hitung_denda");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_loans_update");
        // dr if ext
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_log_activity");
        DB::unprepared("
        CREATE PROCEDURE sp_log_activity(IN pesan TEXT)
        BEGIN
            INSERT INTO activity_logs (data, created_at, updated_at)
            VALUES (pesan, NOW(), NOW());
        END
    ");
        // beg {} end
        // ev triger with call
        // 	Mendefinisikan parameter input (IN) bernama pesan dengan tipe data TEXT untuk stored procedure.

        // dr if ext
//FUNCTION Hitung Denda
         DB::unprepared("
        CREATE FUNCTION hitung_denda(p_tool_id INT, p_qty INT, tgl_due DATE, tgl_return DATE) 
        RETURNS DECIMAL(15,2)
        DETERMINISTIC
        BEGIN
            DECLARE v_harga_alat DECIMAL(15,2);
            DECLARE v_selisih_hari INT;
            DECLARE v_denda_per_hari DECIMAL(15,2);
            DECLARE v_total_denda DECIMAL(15,2) DEFAULT 0;
            
            -- Ambil harga alat dari tabel tools
            SELECT price INTO v_harga_alat FROM tools WHERE id = p_tool_id;
            
            -- Hitung selisih hari (Hanya jika telat)
            SET v_selisih_hari = DATEDIFF(tgl_return, tgl_due);
            
            IF v_selisih_hari > 0 THEN
                -- Rumus: 1% dari harga alat
                SET v_denda_per_hari = 0.01 * v_harga_alat;
                -- Total: (Denda per hari * hari telat) * jumlah barang
                SET v_total_denda = (v_denda_per_hari * v_selisih_hari) * p_qty;
            END IF;
            
            RETURN v_total_denda;
        END
    ");
        // ret must a int
        // be {} end
        // 

        DB::unprepared("DROP TRIGGER IF EXISTS trg_loans_insert");
        DB::unprepared("
        CREATE TRIGGER trg_loans_insert AFTER INSERT ON loans FOR EACH ROW
        BEGIN
            DECLARE v_username VARCHAR(255);
            DECLARE v_toolname VARCHAR(255);
            
            SELECT username INTO v_username FROM users WHERE id = NEW.borrower_id;
            SELECT name_tools INTO v_toolname FROM tools WHERE id = NEW.tool_id;
            
            CALL sp_log_activity(CONCAT('[BARU] ', v_username, ' mengajukan peminjaman alat: ', v_toolname));
        END
    ");
//trg_loans_update 
            DB::unprepared("
        CREATE TRIGGER trg_loans_update AFTER UPDATE ON loans FOR EACH ROW
        BEGIN
            DECLARE v_username VARCHAR(255);
            DECLARE v_toolname VARCHAR(255);
            DECLARE v_approver VARCHAR(255);
            
            -- Ambil info untuk log
            SELECT name INTO v_username FROM users WHERE id = NEW.borrower_id;
            SELECT name_tools INTO v_toolname FROM tools WHERE id = NEW.tool_id;

            -- LOGIC: STATUS BERUBAH JADI 'BORROW' (APPROVE)
            IF OLD.status = 'pending' AND NEW.status = 'borrow' THEN
                SELECT name INTO v_approver FROM users WHERE id = NEW.approved_by;
                
                -- Update Stok (Kurangi)
                UPDATE tools SET stock = stock - NEW.qty WHERE id = NEW.tool_id;
                
                -- Catat Log
                CALL sp_log_activity(CONCAT('[APPROVE] ', v_toolname, ' (', NEW.qty, ' pcs) disetujui oleh ', v_approver));

            -- LOGIC: STATUS BERUBAH JADI 'RETURN' (KEMBALI)
            ELSEIF OLD.status = 'borrow' AND NEW.status = 'return' THEN
                -- Update Stok (Tambah Balik)
                UPDATE tools SET stock = stock + NEW.qty WHERE id = NEW.tool_id;
                
                -- Catat Log (Denda sudah dihitung di level aplikasi atau trigger BEFORE)
                CALL sp_log_activity(CONCAT('[RETURN] ', v_username, ' mengembalikan ', v_toolname, '. Denda Akhir: Rp', NEW.penalty));

            -- LOGIC: SOFT DELETE
            ELSEIF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL THEN
                CALL sp_log_activity(CONCAT('[HAPUS] Transaksi ', v_toolname, ' (Peminjam: ', v_username, ') dihapus.'));
            END IF;
        END
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
