<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostEquipmentAllocationRequest;
use App\Http\Requests\PostEquipmentRequest;
use App\Models\Equipment;
use App\Models\EquipmentAllocation;
use App\Models\User;
use App\Services\EquipmentAllocationService;
use App\Services\EquipmentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EquipmentAllocationController extends Controller
{

    protected EquipmentAllocationService $equipmentAllocationService;

    public function __construct(EquipmentAllocationService $equipmentAllocationService , UserService $userService , EquipmentService $equipmentService)
    {
        $this->equipmentAllocationService = $equipmentAllocationService;
    }
    public function index()
    {

        $allocationData  =  $this->equipmentAllocationService->getAllocationData();

        return view('allocations.index' , ['users' => $allocationData['users'] ,
            'equipments' => $allocationData['equipments'] , 'allocations' => $allocationData['allocations']]);

    }

    public function assignEquipment(PostEquipmentAllocationRequest $request)
    {
        DB::beginTransaction();

        try{

            $this->equipmentAllocationService->assignAllocation($request->validated());

            DB::commit();

            Alert::success('Equipment Allocation' , 'equipment allocated successfully');

            return back();

        }catch (\Exception $exception){
            DB::rollBack();

            Alert::error('Equipment Allocation' , ' error '.$exception->getMessage());

            return back();

        }
    }
}
