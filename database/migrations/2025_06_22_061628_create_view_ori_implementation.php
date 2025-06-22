<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_summary_sck_ori");
        DB::unprepared("
            CREATE VIEW 
                view_ori_implementation
            AS
                SELECT 
                    oi_helper.*,
                    fasyankes.name
                FROM 
                    (
                        SELECT 
                            oi.*,
                            CASE
                                WHEN TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) >= 9
                                    AND TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) < 18 THEN '9 - <18 bulan'
                                WHEN TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) >= 18
                                    AND TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) <= 59 THEN '18 - 59 bulan'
                                WHEN TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) >= 60
                                    AND TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) < 84 THEN '5 - <7 tahun'
                                WHEN TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) >= 84
                                    AND TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) < 156 THEN '7 - <13 tahun'
                                WHEN TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) >= 156
                                    AND TIMESTAMPDIFF(MONTH, oi.birthday, CURDATE()) < 192 THEN '13 - <16 tahun'
                                ELSE '≥ 16 tahun'
                            END AS age_group,
                            YEAR(birthday) AS birth_year
                        FROM 
                            ori_implementations oi
                    ) AS oi_helper
                    JOIN 
                        fasyankes 
                    ON
                        oi_helper.kode_fasyankes = fasyankes.kode_fasyankes
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_summary_sck_ori");
    }
};
