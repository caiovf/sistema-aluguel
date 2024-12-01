<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $properties = $user->properties()->with([
            'contracts' => function($query){
                $query->where('active_contract',true);
            }])
            ->latest()
            ->paginate(24);

        return view('properties.index',compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'            
        ]);

        auth()->user()->properties()->create([
            'name' => $request->name
        ]);

        return redirect()->route('properties.index')->with('success','Produto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $this->authorize('access', $property);

        $propertyActiveContract = $this->getPropertyContractByStatus($property->id);
        $PropertyDisabledContracts = $this->getPropertyContractByStatus($property->id,false);

        return view('properties.show', compact('property','propertyActiveContract','PropertyDisabledContracts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('properties.edit',compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'
        ]);

        $property = Property::findOrfail($id);
        $property->update($validatedData);

        return redirect()->route('properties.index').with('success','Imóvel Atualizado Com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }

    public function getTotalPropertiesByContractStatus($contractStatus = true,$user)
    {
        return $user->properties()
        ->when($contractStatus, function ($query) {
            $query->whereHas('contracts', function ($subQuery) {
                $subQuery->where('active_contract', true);
            });
        })
        ->when(!$contractStatus, function ($query) {
            $query->where(function($q){
                $q->whereHas('contracts', function ($subQuery) {
                    $subQuery->where('active_contract', false);
                })->orWhereDoesntHave('contracts');
            });
        })
        ->count();
    }

    public function getPropertiesByContractEndingSoon($per_page=12,$user)
    {
        return $user->properties()
            ->whereHas('contracts', function ($query) {
                $query->where('active_contract', true);
            })
            ->with(['contracts' => function ($query) {
                $query->where('active_contract', true)
                      ->orderBy('end_date', 'asc');
            }])
            ->leftJoin('contracts', function ($join) {
                $join->on('properties.id', '=', 'contracts.property_id')
                     ->where('contracts.active_contract', true);
            })
            ->orderBy('contracts.end_date', 'asc')
            ->select('properties.*')
            ->paginate($per_page);
    }

    public function getPropertyContractByStatus($property_id, $status = true)
    {
        $activeContract = Property::with(['contracts' => function($query) use ($status) {
            $query->where('active_contract', $status);
        }])->find($property_id)->contracts;

        return $activeContract ? $activeContract : collect();
    }
}
