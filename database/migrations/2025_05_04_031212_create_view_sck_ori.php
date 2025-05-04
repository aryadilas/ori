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
        DB::unprepared("DROP VIEW IF EXISTS view_sck_ori");
        DB::unprepared("
            CREATE VIEW 
                view_sck_ori 
            AS
                SELECT 
                    f2_helpers.id,
                    f2_helpers.kode_fasyankes,
                    f2_helpers.year,
                    f2_helpers.house_id,
                    f2_helpers.village_name,
                    f2_helpers.parent_nik,
                    f2_helpers.parent_name,
                    f2_helpers.child_nik,
                    f2_helpers.child_name,
                    f2_helpers.birthdate,
                    f2_helpers.age_in_months,
                    f2_helpers.helper_5_and_6_year,
                    f2_helpers.age_group,
                    f2_helpers.birth_year,
                    f2_helpers.gender,
                    f2_helpers.q1,
                    CASE 
                        WHEN f2_helpers.age_group = 4 AND f2_helpers.birth_year > 2012 THEN 1
                        WHEN f2_helpers.age_group = 5 AND f2_helpers.birth_year > 2012 THEN 2
                        ELSE 0
                    END AS cr2_target,
                    f2_helpers.q2,
                    f2_helpers.q3,
                    f2_helpers.q4,
                    f2_helpers.q5,
                    f2_helpers.q6,
                    f2_helpers.q7,
                    f2_helpers.q8,
                    f2_helpers.q9,
                    f2_helpers.created_at
                FROM 
                    (
                        SELECT 
                            f2.*,
                            TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) AS age_in_months,
                            CASE
                                WHEN TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) > 59 
                                    AND TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) < 72 THEN 1
                                WHEN TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) >= 72 
                                    AND TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) < 84 THEN 2
                                ELSE 0
                            END AS helper_5_and_6_year,
                            CASE
                                WHEN TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) >= 2
                                    AND TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) < 18 THEN 1
                                WHEN TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) >= 18
                                    AND TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) <= 59 THEN 2
                                WHEN TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) >= 60
                                    AND TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) < 84 THEN 3
                                WHEN TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) >= 84
                                    AND TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) < 156 THEN 4
                                WHEN TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) >= 156
                                    AND TIMESTAMPDIFF(MONTH, f2.birthdate, CURDATE()) < 192 THEN 5
                                ELSE 0
                            END AS age_group,
                            YEAR(birthdate) AS birth_year
                        FROM 
                            form2_answers f2
                    ) AS f2_helpers
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_sck_ori");
    }
};
