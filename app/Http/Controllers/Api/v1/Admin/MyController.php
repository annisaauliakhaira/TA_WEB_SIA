<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Resources\Admin\ListCollection as adminCollection;

class MyController extends Controller
{
    public function getAllData()
    {  
        try {
            $data = Admin::all();
            $data = adminCollection::collection($data);
            return $this->MessageSuccess($data);
        } catch (\Exception $e) {
            return $this->MessageError($e->getMessage());
        }
    }
}
