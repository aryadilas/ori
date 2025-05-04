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
                view_summary_sck_ori 
            AS
                SELECT
                    vso.id,
                    vso.kode_fasyankes,
                    vso.year,
                    vso.age_group,
                    CASE
                        WHEN vso.age_group = 1 THEN '9-<18 Bulan'
                        WHEN vso.age_group = 2 THEN '18-59 Bulan'
                        WHEN vso.age_group = 3 THEN '5-<7 Tahun'
                        WHEN vso.age_group = 4 THEN '7-<13 Tahun'
                        WHEN vso.age_group = 5 THEN '13-<16 Tahun'
                    END AS usia,
                    COUNT(vso.age_group) AS target,
                    CASE
                        WHEN vso.age_group IN (3, 4, 5) THEN COUNT(vso.age_group)
                        ELSE NULL
                    END AS cr2_target,
                    SUM(CASE WHEN vso.q1 = 'y' THEN 1 ELSE 0 END) AS cr1_abs,

                    CASE
                        WHEN vso.age_group IN (2, 3, 4, 5) THEN SUM(CASE WHEN vso.q2 = 'y' THEN 1 ELSE 0 END)
                        ELSE NULL
                    END AS cr2_abs,

                    CASE
                        WHEN vso.age_group IN (3, 4, 5) THEN SUM(CASE WHEN vso.q3 = 'y' THEN 1 ELSE 0 END)
                        ELSE NULL
                    END AS crBias_abs,
                    SUM(CASE WHEN vso.q4 = 'y' THEN 1 ELSE 0 END) AS crAddition_abs,
                    ROUND(SUM(CASE WHEN vso.q1 = 'y' THEN 1 ELSE 0 END) / COUNT(vso.age_group) * 100) AS cr1_scope,

                    CASE
                        WHEN vso.age_group IN (2, 3, 4, 5) THEN ROUND(SUM(CASE WHEN vso.q2 = 'y' THEN 1 ELSE 0 END) / COUNT(vso.age_group) * 100)
                        ELSE NULL
                    END AS cr2_scope,

                    CASE
                        WHEN vso.age_group IN (3, 4, 5) THEN ROUND(SUM(CASE WHEN vso.q3 = 'y' THEN 1 ELSE 0 END) / COUNT(vso.age_group) * 100)
                        ELSE NULL
                    END AS crBias_scope,

                    ROUND(SUM(CASE WHEN vso.q4 = 'y' THEN 1 ELSE 0 END) / COUNT(vso.age_group) * 100) AS crAddition_scope
                FROM
                    view_sck_ori vso
                GROUP BY
                    vso.kode_fasyankes,
                    vso.year,
                    vso.age_group
                ORDER BY 
                    vso.kode_fasyankes ASC,
                    vso.year ASC,
                    vso.age_group ASC;
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
