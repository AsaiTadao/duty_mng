<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\RegionRequest;
use App\Models\Office;
use App\Models\Region;

class RegionController extends BaseController
{
    public function get()
    {
        $regions = Region::with('offices:id,name,region_id')->get();
        return $this->sendResponse($regions->toArray());
    }
    public function create(RegionRequest $request)
    {
        $data = $request->validated();
        $region = Region::create([
            'name'  =>  $data['name']
        ]);
        $region->offices()->update(['region_id' => null]);
        if (!empty($data['offices']))
        {
            Office::whereIn('id', $data['offices'])
                    ->update(['region_id' => $region->id]);
        }
        return $this->sendResponse();
    }
    public function update(Region $region, RegionRequest $request)
    {
        $data = $request->validated();
        $region->name = $data['name'];
        $region->save();

        $region->offices()->update(['region_id' => null]);
        if (!empty($data['offices']))
        {
            Office::whereIn('id', $data['offices'])
                    ->update(['region_id' => $region->id]);
        }
        return $this->sendResponse();
    }
}
