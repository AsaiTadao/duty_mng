<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\ChildQuery;
use App\Http\Requests\Child\ChildRequest;
use App\Http\Resources\ChildResource;
use App\Models\Child;
use App\Models\ChildInformation;
use App\Models\ChildrenClass;
use App\Scopes\ChildCancelScope;
use App\Services\QrService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class ChildController extends BaseController
{
    public function register(ChildRequest $request, QrService $qrService)
    {
        $user = auth()->user();

        $data = $request->validated();
        if (empty($data['password'])) {
            return response()->json(['message' => 'Password is required'], 422);
        }
        // $child = Child::where(['email' => $data['email']])->first();
        // if ($child) {
        //     return response()->json(['message' => trans('This email is already registered')]);
        // }
        if ($data['type'] === 1 || $data['type'] === 2)
        {
            return response()->json(['message' => 'Please input company name'], 422);
        }

        $data['password'] = Crypt::encryptString($data['password']);
        $child = new Child($data);
        $child->office_id = $user->office_id;

        if (empty($data['class_id']))
        {
            $birthday = Carbon::parse($data['birthday']);
            $diff_in_months = $birthday->diffInMonths(Carbon::now());
            $year = floor($diff_in_months / 12);
            switch($year) {
                case 0:
                    $classId = ChildrenClass::AGE_0; break;
                case 1:
                    $classId = ChildrenClass::AGE_1; break;
                case 2:
                    $classId = ChildrenClass::AGE_2; break;
                case 3:
                    $classId = ChildrenClass::AGE_3; break;
                case 4:
                    $classId = ChildrenClass::AGE_4; break;
                case 5:
                    $classId = ChildrenClass::AGE_5; break;
                default:
                    $classId = ChildrenClass::AGE_5; break;
            }
            $child->class_id = $classId;
        }
        $child->save();

        $qr = "LK-CHILDREN-" . bcrypt($child->id);

        $child->qr = $qr;
        $child->save();

        $childInfo = new ChildInformation($data);
        $child->child_info()->save($childInfo);
        $qrService->getChildQrImageUri($child);
        return $this->sendResponse(new ChildResource($child));
    }

    public function update(Child $child, ChildRequest $request, QrService $qrService)
    {
        $user = auth()->user();
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Crypt::encryptString($data['password']);
        } else if ($data['password'] === null) {
            unset($data['password']);
        }
        // $existing = Child::where(['email' => $data['email']])->first();
        // if ($existing && $existing->id !== $child->id) {
        //     return response()->json(['message' => trans('This email is already registered')]);
        // }

        $child->fill($data);

        if (empty($data['class_id']))
        {
            $birthday = Carbon::parse($data['birthday']);
            $diff_in_months = $birthday->diffInMonths(Carbon::now());
            $year = floor($diff_in_months / 12);
            switch($year) {
                case 0:
                    $classId = ChildrenClass::AGE_0; break;
                case 1:
                    $classId = ChildrenClass::AGE_1; break;
                case 2:
                    $classId = ChildrenClass::AGE_2; break;
                case 3:
                    $classId = ChildrenClass::AGE_3; break;
                case 4:
                    $classId = ChildrenClass::AGE_4; break;
                case 5:
                    $classId = ChildrenClass::AGE_5; break;
                default:
                    $classId = ChildrenClass::AGE_5; break;
            }
            $child->class_id = $classId;
        }
        if (!$child->qr)
        {
            $child->qr = "LK-CHILDREN-" . bcrypt($child->id);
        }
        $child->save();

        $childInfo = $child->child_info;
        if (!$childInfo)
        {
            $childInfo = new ChildInformation(['child_id' => $child->id]);
        }
        $type_updated_before = $child->child_info ? $child->child_info->type : null;

        $childInfo->fill($data);
        if ($type_updated_before && $type_updated_before !== $childInfo->type)
        {
            $childInfo->type_updated_at = Carbon::now();
            $childInfo->type_updated_before = $type_updated_before;
        }
        $childInfo->save();

        $child->refresh();
        $qrService->getChildQrImageUri($child);
        return $this->sendResponse(new ChildResource($child));
    }
    public function retrieve(Child $child, QrService $qrService)
    {
        $qrService->getChildQrImageUri($child);
        return $this->sendResponse(new ChildResource($child));
    }
    public function delete(Child $child)
    {
        $child->delete();
        return $this->sendResponse([]);
    }
    public function cancel(Child $child)
    {
        $child->canceled_at = Carbon::now();
        $child->save();
        return $this->sendResponse([]);
    }
    public function list(ChildQuery $request)
    {
        $user = auth()->user();

        $data = $request->validated();

        $qb = Child::where(['office_id' => $user->office_id]);
        if (!empty($data['query']))
        {
            $search = $data['query'];
            $qb->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('number', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        if (empty($data['including_exited'])) {
            $qb->where(function ($query) {
                $query->whereNull('exit_date')
                    ->orWhere('exit_date', '>', Carbon::now());
            });
        }
        if (!empty($data['class_id']))
        {
            $qb->where(['class_id' => $data['class_id']]);
        }
        // TODO search plan_registered
        if (isset($data['plan_registered']))
        {
            $qb->where(['plan_registered' => $data['plan_registered']]);
        }
        if (!empty($data['including_canceled']))
        {
            $qb->withoutGlobalScopes([ChildCancelScope::class]);
        }
        return $this->sendResponse($qb->get());
    }
}
