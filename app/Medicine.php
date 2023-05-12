<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Medicine extends Model
{
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function symptoms()
    {
        return $this->belongsToMany('App\Symptom');
    }

    public function analytical_criterias()
    {
        return $this->belongsToMany('App\AnalyticalCriteria', "medicine_analytical_criteria");
    }

    public function metabolites()
    {
        return $this->belongsToMany('App\Metabolite', 'medicine_metabolite');
    }

    public function criterias()
    {
        return $this->belongsToMany('App\Criteria', "medicine_criteria");
    }

    public function getAllMedicineInfo($id)
    {
        return Medicine::with('symptoms')
            ->with('analytical_criterias')
            ->with('metabolites')
            ->with('criterias')
            ->where("medicines.id", "=", $id)
            ->first();
    }

    public static function searcheMedicine($request)
    {
        $symptoms = array_filter($request->symptoms);
        $symptomsQuery = " @symptoms_count :=(select count(*)
                 from symptoms s
                          join medicine_symptom ms on s.id = ms.symptom_id
                 where ms.medicine_id = m.id
                   and s.name REGEXP ";
        $symptomsQuery .= "'" . implode('|', $symptoms) . "'";
        if (!count($symptoms))
            $symptomsQuery .= " and s.id = 'none'";
        $symptomsQuery .= ") as symptoms_count";


        $analytical_criterias = array_filter($request->analytical_criterias);
        $analyticalCriteriasQuery = " @analytical_criterias_count :=(select count(*)
                 from analytical_criterias ac
                          join medicine_analytical_criteria mac on ac.id = mac.analytical_criteria_id
                 where mac.medicine_id = m.id
                   and ac.name REGEXP ";
        $analyticalCriteriasQuery .= "'" . implode('|', $analytical_criterias) . "'";
        if (!count($analytical_criterias))
            $analyticalCriteriasQuery .= " and ac.id = 'none'";
        $analyticalCriteriasQuery .= ") as analytical_criterias_count";


        $metabolites = array_filter($request->metabolites);
        $metabolitesQuery = " @metabolites_count :=(select count(*)
                             from metabolites m2
                                  join medicine_metabolite mm on m2.id = mm.metabolite_id
                                 where mm.medicine_id = m.id
                             and m2.name REGEXP ";
        $metabolitesQuery .= "'" . implode('|', $metabolites) . "'";
        if (!count($metabolites))
            $metabolitesQuery .= " and m2.id = 'none'";
        $metabolitesQuery .= ") as metabolites_count";


        $criterias = array_filter($request->criterias);
        $criteriasQuery = "@criterias_count :=(select count(*)
                 from criterias c
                        join medicine_criteria mc on c.id = mc.criteria_id
                 where mc.medicine_id = m.id
                   and c.name REGEXP ";
        $criteriasQuery .= "'" . implode('|', $criterias) . "'";
        if (!count($criterias))
            $criteriasQuery .= " and c.id = 'none'";
        $criteriasQuery .= ") as criterias_count";


        $query = "SELECT distinct m.*,";
        $query .= $symptomsQuery . "," . $analyticalCriteriasQuery . "," . $metabolitesQuery . "," . $criteriasQuery . ",";
        $query .= " @total_match :=(@symptoms_count + @analytical_criterias_count  + @metabolites_count + @criterias_count) as total_match";
        $query .= " FROM medicines as m order by total_match DESC limit 10;";


        return DB::select(DB::raw($query));
    }

}
