<?php

namespace App\Http\Controllers;

use App\Models\JobOfferDetails;
use Illuminate\Http\Request;

class JobOfferDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Job Offer Details
      $JobOfferDetails = JobOfferDetails::all();

      if (count($JobOfferDetails) < 1) {
        // Return an error message if no record is found
        return response()->json('No records founds !!', 404);
      } else {
        // Return Job Offer Details in JSON format
        return response()->json($JobOfferDetails, 200);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get input from young lady (net salary and desired allowances)
        $input = $request->input();

        // Get Net Salary from the young lady
        $net_salary = $input['net_salary'];

        // Get Allowances from the young lady
        $allowances = $input['allowances'];

        // Get Total Payee tax
        $total_paye_tax = 0;
        $taxableAMT = $net_salary + $allowances;

        // Get Gross Salary
        $gross_salary = 0;

        // Get Employee Pension Contribution Amount
        $emp_pension_cont_amt = 0;

        // Get Employee Pension Amount
        $emp_pension_amt = 0;

        // Get Basic Salary
        $basic_salary = 0;

        // Get Total Allowance Amounts
        $total_allowance_amounts = 0;

        // Store the young lady's desired net salary and allowances
        $jobOfferDetails = new JobOfferDetails();
        $jobOfferDetails->net_salary = $net_salary;
        $jobOfferDetails->allowances = $total_allowance_amounts;
        $jobOfferDetails->total_paye_tax = $total_paye_tax;
        $jobOfferDetails->gross_salary = $gross_salary;
        $jobOfferDetails->emp_pension_cont_amt = $emp_pension_cont_amt;
        $jobOfferDetails->emp_pension_amt = $emp_pension_amt;

        // Check if the data has been stored successfully
        if ($jobOfferDetails->save()) {
            return response()->json('Your desired net salary and allowances has been submitted successfully', 200);
        } else {
        // If for some reason the young lady's data isn't stored return an error message.
        return response()->json("Something went wrong. Your data wasn't stored", 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
     {
         // Get JobOfferDetails by ID
         $JobOfferDetails = JobOfferDetails::findOrFail($id);

         // Return JobOfferDetails in json format
         return response()->json($JobOfferDetails, 200);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(JobOfferDetails $jobOfferDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOfferDetails $jobOfferDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOfferDetails $jobOfferDetails)
    {
        //
    }
}
