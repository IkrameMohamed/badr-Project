<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateImportationMedicineStoredProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
         CREATE PROCEDURE importationMedicine()
BEGIN

    insert into medicines
        (`name`)
    select distinct TRIM(idi.médicament)
    from importation_data_infos as idi
    where TRIM(idi.médicament)
              not in (select TRIM(name) from medicines);

    insert into symptoms
        (`name`)
    select distinct TRIM(idi.symptomes)
    from importation_data_infos as idi
    where TRIM(idi.symptomes)
        not in (select TRIM(name) from symptoms)
      and idi.symptomes IS NOT NULL;

    insert into criterias
        (`name`)
    select distinct TRIM(idi.criteres)
    from importation_data_infos as idi
    where TRIM(idi.criteres)
        not in (select TRIM(name) from criterias)
      and idi.criteres IS NOT NULL;

    insert into metabolites
        (`name`)
    select distinct TRIM(idi.métabolites)
    from importation_data_infos as idi
    where TRIM(idi.métabolites)
        not in (select TRIM(name) from metabolites)
      and idi.métabolites IS NOT NULL;

    insert into analytical_criterias
        (`name`)
    select distinct TRIM(idi.critères_analytiques)
    from importation_data_infos as idi
    where TRIM(idi.critères_analytiques)
        not in (select TRIM(name) from analytical_criterias)
      and idi.critères_analytiques IS NOT NULL;


    insert into medicine_symptom
        (medicine_id, symptom_id)
    select DISTINCT  m.id, s.id
    from importation_data_infos as idi
             left join medicines m on m.name = idi.médicament
             left join symptoms s on s.name = idi.symptomes
    where
        CONCAT(m.id, s.id)
            NOT IN (SELECT CONCAT(ms.medicine_id,ms.symptom_id) FROM medicine_symptom ms)
      and idi.symptomes IS NOT NULL and idi.médicament IS NOT NULL;

    insert into medicine_criteria
    (medicine_id, criteria_id)
    select DISTINCT  m.id, c.id
    from importation_data_infos as idi
             left join medicines m on m.name = idi.médicament
             left join criterias c on c.name = idi.criteres
    where
            CONCAT(m.id, c.id)
            NOT IN (SELECT CONCAT(mc.medicine_id,mc.criteria_id) FROM medicine_criteria mc)
      and idi.criteres IS NOT NULL and idi.médicament IS NOT NULL;

    insert into medicine_analytical_criteria
    (medicine_id, analytical_criteria_id)
    select DISTINCT  m.id, ac.id
    from importation_data_infos as idi
             left join medicines m on m.name = idi.médicament
             left join analytical_criterias ac on ac.name = idi.critères_analytiques
    where
            CONCAT(m.id, ac.id)
            NOT IN (SELECT CONCAT(mac.medicine_id,mac.analytical_criteria_id) FROM medicine_analytical_criteria mac)
      and idi.critères_analytiques IS NOT NULL and idi.médicament IS NOT NULL;

    insert into medicine_metabolite
    (medicine_id, metabolite_id)
    select DISTINCT  m.id, met.id
    from importation_data_infos as idi
             left join medicines m on m.name = idi.médicament
             left join metabolites met on met.name = idi.métabolites
    where
            CONCAT(m.id, met.id)
            NOT IN (SELECT CONCAT(mm.medicine_id,mm.metabolite_id) FROM medicine_metabolite mm)
      and idi.métabolites IS NOT NULL and idi.médicament IS NOT NULL;

          DELETE FROM `importation_data_infos` WHERE 1 ;

END;
                     ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(' DROP PROCEDURE IF EXISTS importationMedicine;');
    }
}
