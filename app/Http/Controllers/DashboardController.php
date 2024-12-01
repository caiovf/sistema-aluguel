<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $propertyController;

    public function __construct(PropertyController $propertyController)
    {
        $this->propertyController = $propertyController;
    }
    public function index()
    {
        $user = Auth::user();
        
        $proprietiesCountWithContract = $this->propertyController->getTotalPropertiesByContractStatus(true,$user);
        $proprietiesCountWithoutContract = $this->propertyController->getTotalPropertiesByContractStatus(false,$user);    
        $proprietiesContractEndSoon = $this->propertyController->getPropertiesByContractEndingSoon(4,$user);

        return view('dashboard',compact('proprietiesCountWithContract','proprietiesCountWithoutContract','proprietiesContractEndSoon'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
