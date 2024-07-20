<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostEquipmentAllocationRequest;
use App\Http\Requests\UpdateEquipmentAllocationRequest;
use App\Services\EquipmentAllocationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EquipmentAllocationController extends Controller
{

    protected EquipmentAllocationService $equipmentAllocationService;

    public function __construct(EquipmentAllocationService $equipmentAllocationService)
    {
        $this->equipmentAllocationService = $equipmentAllocationService;
    }

    /**
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {

        $allocationData  =  $this->equipmentAllocationService->getAllocationData();

        return view('allocations.index' , ['users' => $allocationData['users'] ,
            'equipments' => $allocationData['equipments'] , 'allocations' => $allocationData['allocations']]);

    }

    /**
     * @param PostEquipmentAllocationRequest $request
     * @return RedirectResponse
     */
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

    /**
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function viewReturns()
    {

        $allocations  =  $this->equipmentAllocationService->getAllocatedEquipment();

        return view('allocations.returns' , [ 'allocations' => $allocations]);

    }

    /**
     * @param string $allocationId
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function editReturn(string $allocationId)
    {

        $allocation  =  $this->equipmentAllocationService->getAllocationById($allocationId);

        return view('allocations.edit' , [ 'allocation' => $allocation]);

    }

    /**
     * @param UpdateEquipmentAllocationRequest $request
     * @param string $allocationId
     * @return RedirectResponse
     */
    public function recordReturns(UpdateEquipmentAllocationRequest $request , string $allocationId)
    {

        try{
            DB::beginTransaction();

            $allocation  =  $this->equipmentAllocationService->getAllocationById($allocationId);

            if (!$allocation) abort(ResponseAlias::HTTP_NOT_FOUND);

            $this->equipmentAllocationService->updateAllocation($request->validated() , $allocationId);

            DB::commit();

            Alert::success('Equipment Updated' , 'equipment updated successfully');

            return redirect()->route('returns.index');

        }catch (\Exception $exception){
            DB::rollBack();

            Alert::error('Updating Equipment' , 'equipment failed to update' . $exception->getMessage());

            return back();
        }

    }

}
