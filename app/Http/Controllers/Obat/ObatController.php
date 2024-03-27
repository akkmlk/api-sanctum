<?php

namespace App\Http\Controllers\Obat;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::query()->orderBy('id', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $obats,
        ], 200);
    }

    public function typeObat()
    {
        $typeObats = Obat::select('kategori')->distinct()->get();
        
        return response()->json([
            'success' => true,
            'data' => $typeObats,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = [
            'name' => 'required|min:1|max:255',
            'price' => 'required',
            'kategori' => 'required|min:1|max:255',
        ];
        $validator = Validator::make($request->all(), $validated);

        if ($validator->fails())  {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => $request->all(),
            ], 400);
        } else {
            $createObat = Obat::create([
                'name' => $request->name,
                'price' => $request->price,
                'kategori' => $request->kategori,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Created',
                'data' => $createObat,
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return response()->json([
            'success' => true,
            'data' => $obat,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $validated = [
            'name' => 'required|min:1|max:255',
            'price' => 'required',
            'kategori' => 'required|min:1|max:255',
        ];

        $validator = Validator::make($request->all(), $validated);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => $request->all()
            ], 400);
        } else {
            $updateObat = $obat->update([
                'name' => $request->name,
                'price' => $request->price,
                'kaegori' => $request->kategori,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'data' => $obat,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $deleteObat = $obat->delete();
        if ($deleteObat) {
            return response()->json([
                'success' => true,
                'message' => "Deleted",
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Failed",
            ], 400);
        }
    }
}
