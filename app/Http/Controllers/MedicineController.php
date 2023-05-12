<?php

namespace App\Http\Controllers;

use App\AnalyticalCriteria;
use App\Criteria;
use App\Http\Requests\MedicineRequest\MedicineCreate;
use App\Http\Requests\MedicineRequest\MedicineDelete;
use App\Http\Requests\MedicineRequest\MedicineGetData;
use App\Http\Requests\MedicineRequest\MedicineUpdate;
use App\Medicine;
use App\Metabolite;
use App\Symptom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Gate;

class MedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index page method
     *
     * @return void
     */
    public function index()
    {

        if (Gate::allows('medicines') == false) {
            redirect('/')->send();
        }

        return view('medicine.index');
    }

    public function searchView()
    {
        if (Gate::allows('search') == false) {
            redirect('/')->send();
        }
        return view('medicine.search');
    }

    public function advanceSearch(Request $request)
    {

        $medicines = Medicine::searcheMedicine($request);

        foreach ($medicines as $key=>$medicine)
            if($medicine->total_match == 0)
                unset($medicines[$key]);

        return Datatables::of($medicines)->make(true);

    }


    /**
     * datatable method
     *
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        $medicines = Medicine::all();

        return Datatables::of($medicines)->make(true);
    }

    public function get(MedicineGetData $request)
    {
        $medicine = new Medicine();
        $medicines = $medicine->getAllMedicineInfo($request->id);

        return $this->returnSuccess('medicine.get_medicine_with_success', $medicines);
    }

    public function create(MedicineCreate $request)
    {

        $this->createMedicineOptions($request);

        $medicine = new Medicine();
        $medicine->name = $request->medicine_name;
        $medicine->save();

        $this->syncMedicineWithPivoteTables($medicine, $request);

        return $this->returnSuccess('medicine.create_medicine_succesfuly');
    }

    public function update(MedicineUpdate $request)
    {

        $this->createMedicineOptions($request);

        $medicine = Medicine::find($request->id);
        $medicine->name = $request->medicine_name;
        $medicine->save();

        $this->syncMedicineWithPivoteTables($medicine, $request);

        return $this->returnSuccess('medicine.update_medicine_succesfuly');
    }

    /**
     * delete user by id
     * @param UserDelete $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function delete(MedicineDelete $request)
    {

        $medicine = Medicine::find($request->id);
        $medicine->delete();
        return $this->returnSuccess('medicine.delete_medicine_succesfuly');
    }

    private function syncMedicineWithPivoteTables($medicine, $request)
    {
        $symptomIds = Symptom::getSymptomsIdByNames($request->symptoms);
        $criteriaIds = Criteria::getCriteriasIdByNames($request->criterias);
        $metaboliteIds = Metabolite::getMetabolitesIdByNames($request->metabolites);
        $analyticalCriteriaIds = AnalyticalCriteria::getCAnalyticalCriteriasIdByNames($request->analytical_criterias);

        $medicine->symptoms()->sync($symptomIds);
        $medicine->criterias()->sync($criteriaIds);
        $medicine->metabolites()->sync($metaboliteIds);
        $medicine->analytical_criterias()->sync($analyticalCriteriaIds);

        return true;
    }

    private function createMedicineOptions($request)
    {

        foreach (array_filter($request->symptoms) as $symptom)
            Symptom::firstOrCreate(['name' => $symptom]);
        foreach (array_filter($request->criterias) as $criteria)
            Criteria::firstOrCreate(['name' => $criteria]);
        foreach (array_filter($request->metabolites) as $metabolite)
            Metabolite::firstOrCreate(['name' => $metabolite]);
        foreach (array_filter($request->analytical_criterias) as $analytical_criteria)
            AnalyticalCriteria::firstOrCreate(['name' => $analytical_criteria]);

        return true;
    }


}
