<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostEquipmentRequest;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EquipmentController extends Controller
{

    protected EquipmentService $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view' , Equipment::class);

        $equipments =  $this->equipmentService->getEquipmentByDesc();

        return view('equipments.index',  ['equipments' => $equipments]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostEquipmentRequest $request)
    {
        $this->authorize('create' , Equipment::class);

        DB::beginTransaction();

        try{

            $this->equipmentService->createEquipment($request->validated());

            DB::commit();

            Alert::success('Equipment Creation' , 'equipment created successfully');

            return back();

        }catch (\Exception $exception){
            DB::rollBack();

            Alert::error('Equipment Creation' , ' error '.$exception->getMessage());

            return back();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $equipmentId)
    {
        $this->authorize('view' , Equipment::class);

        $equipment  =  $this->equipmentService->getEquipmentById($equipmentId);
        if (!$equipment) abort(ResponseAlias::HTTP_NOT_FOUND);

        return view('equipments.show' , ['equipment' => $equipment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $equipmentId)
    {
        $this->authorize('edit' , Equipment::class);

        $equipment  =  $this->equipmentService->getEquipmentById($equipmentId);
        if (!$equipment) abort(ResponseAlias::HTTP_NOT_FOUND);

        return view('equipments.edit' , ['equipment' => $equipment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostEquipmentRequest $request, string $equipmentId)
    {
        $this->authorize('update' , Equipment::class);
        try{
            DB::beginTransaction();

            $equipment  =  $this->equipmentService->getEquipmentById($equipmentId);
            if (!$equipment) abort(ResponseAlias::HTTP_NOT_FOUND);

            $this->equipmentService->updateEquipment($request->validated() , $equipmentId);

            DB::commit();

            Alert::success('Equipment Updated' , 'equipment updated successfully');

            return redirect()->route('equipments.index');

        }catch (\Exception $exception){
            DB::rollBack();

            Alert::error('Updating Equipment' , 'equipment failed to update' . $exception->getMessage());

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $equipmentId)
    {
        $this->authorize('delete' , Equipment::class);
        try{

            $equipment  =  $this->equipmentService->getEquipmentbyId($equipmentId);
            if (!$equipment) abort(ResponseAlias::HTTP_NOT_FOUND);

            if($equipment->user_allocation){
                Alert::error('Equipment Deletion' , 'failed to delete equipment because it has allocation');
                return back();
            }

            $this->equipmentService->deleteEquipment($equipmentId);

            Alert::success('Equipment Deletion' , 'equipment deleted successfully');

            return back();

        }catch(\Exception $exception){

            Alert::error('Equipment Deletion' , 'failed to delete equipment '.$exception->getMessage());

            return back();
        }
    }
}
