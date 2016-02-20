<?php

namespace Wilgucki\GenericRestApi\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index($model)
    {
        $model = $this->getModel($model);
        return response()->json($model::all());
    }

    public function show($model, $id)
    {
        $model = $this->getModel($model);
        try {
            $response = $model::findOrFail($id);
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => 'Invalid item id'];
        }
        return response()->json($response);
    }

    public function create(Request $request, $model)
    {
        $model = $this->getModel($model);
        try {
            $model::create($request->all());
            $response = ['success' => true];
        } catch (\Exception $e) {
            $response = ['success' => false];
        }
        return response()->json($response);
    }

    public function update(Request $request, $model, $id)
    {
        $model = $this->getModel($model);
        try {
            $item = $model::findOrFail($id);
            $response = ['success' => $item->update($request->all())];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => 'Invalid item id'];
        }
        return response()->json($response);
    }

    public function delete($model, $id)
    {
        $model = $this->getModel($model);
        try {
            $item = $model::findOrFail($id);
            $response = ['success' => $item->delete()];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => 'Invalid item id'];
        }
        return response()->json($response);
    }

    protected function getModel($model)
    {
        $defindeModels = config('generic-rest-api.models');
        $model = ucfirst(camel_case($model));

        if (!in_array($model, $defindeModels)) {
            abort(404);
        }
        return config('generic-rest-api.model-namespace').'\\'.$model;
    }
}
