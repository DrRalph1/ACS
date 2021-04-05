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
        return response()->json(['responseMessage' => 'No records founds !!','responseCode' => 100]);
      } else {
        // Return Job Offer Details in JSON format
        return response()->json(['responseMessage' => $JobOfferDetails,'responseCode' => 200]);
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
        // Request Input from young lady
        $input = $request->input();

        // Get Net Salary from the young lady
        $net_salary = @$input['net_salary'];

        // Get Allowance from the young lady
        $allowances = @$input['allowances'];

        // check if the user entered the net salary and / or allowances
        if(isset($net_salary) && isset($allowances)){

            // check if user entered numeric value(s) ONLY for the net salary and / or allowances
            if((preg_match('/^-?(?:\d+|\d*\.\d+)$/', $net_salary)) && (preg_match('/^-?(?:\d+|\d*\.\d+)$/', $allowances))){

                // Initialize total paye tax variable
                $total_paye_tax = 0;

                // Computing paye tax using net salary
                if($net_salary <= 319){
                    // chargeable income for the fist 319
                    $first_319 = 0;
                    $total_paye_tax = $first_319;

                } else if ($net_salary <= 414){
                    // chargeable income for the fist 319
                    $first_319 = 0;
                    // chargeable income for the next 100
                    $chargeable_income_next_100 = (100 / 95) * ($net_salary - 319);
                    $next_100 = 0.05 * $chargeable_income_next_100;

                    // compute the total paye tax
                    $total_paye_tax = $first_319 + $next_100;

                } else if ($net_salary <= 522){
                    // chargeable income for the fist 319
                    $first_319 = 0;
                    // chargeable income for the next 100
                    $chargeable_income_next_100 = 100;
                    $next_100 = 0.05 * $chargeable_income_next_100;
                    // chargeable income for the next 120
                    $chargeable_income_next_120 = (100 / 90) * ($net_salary - 414);
                    $next_120 = 0.1 * $chargeable_income_next_120;

                    // compute the total paye tax
                    $total_paye_tax = $first_319 + $next_100 + $next_120;

                } else if ($net_salary <= 2997){
                    // chargeable income for the fist 319
                    $first_319 = 0;
                    // chargeable income for the next 100
                    $chargeable_income_next_100 = 100;
                    $next_100 = 0.05 * $chargeable_income_next_100;
                    // chargeable income for the next 120
                    $chargeable_income_next_120 = 120;
                    $next_120 = 0.1 * $chargeable_income_next_120;
                    // chargeable income for the next 3,000
                    $chargeable_income_next_3000 = (100 / 82.5) * ($net_salary - 522);
                    $next_3000 = 0.175 * $chargeable_income_next_3000;

                    // compute the total paye tax
                    $total_paye_tax = $first_319 + $next_100 + $next_120 + $next_3000;

                } else if ($net_salary < 15342.75){
                    // chargeable income for the fist 319
                    $first_319 = 0;
                    // chargeable income for the next 100
                    $chargeable_income_next_100 = 100;
                    $next_100 = 0.05 * $chargeable_income_next_100;
                    // chargeable income for the next 120
                    $chargeable_income_next_120 = 120;
                    $next_120 = 0.1 * $chargeable_income_next_120;
                    // chargeable income for the next 3,000
                    $chargeable_income_next_3000 = 3000;
                    $next_3000 = 0.175 * $chargeable_income_next_3000;
                    // chargeable income for the next 16,461
                    $chargeable_income_next_16461 = (100 / 75) * ($net_salary - 2997);
                    $next_16461 = 0.25 * $chargeable_income_next_16461;

                    // compute the total paye tax
                    $total_paye_tax = $first_319 + $next_100 + $next_120 + $next_3000 + $next_16461;
                }
                
                else if ($net_salary > 15342.75){
                    // chargeable income for the fist 319
                    $first_319 = 0;
                    // chargeable income for the next 100
                    $chargeable_income_next_100 = 100;
                    $next_100 = 0.05 * $chargeable_income_next_100;
                    // chargeable income for the next 120
                    $chargeable_income_next_120 = 120;
                    $next_120 = 0.1 * $chargeable_income_next_120;
                    // chargeable income for the next 3,000
                    $chargeable_income_next_3000 = 3000;
                    $next_3000 = 0.175 * $chargeable_income_next_3000;
                    // chargeable income for the next 16,461
                    $chargeable_income_next_16461 = 16461;
                    $next_16461 = 0.25 * $chargeable_income_next_16461;
                    // chargeable income exceeding 20,000
                    $chargeable_income_exceeding_20000 = (100 / 70) * ($net_salary - 15342.75);
                    $exceeding_20000 = 0.3 * $chargeable_income_exceeding_20000;

                    // compute the total paye tax
                    $total_paye_tax = $first_319 + $next_100 + $next_120 + $next_3000 + $next_16461 + $exceeding_20000;
                }

                // Taxable Income Computation
                $taxableIncome = $total_paye_tax + $net_salary;

                // Employee contribution for tier two and tier three
                $basic_salary = ($taxableIncome - $allowances) * (100 / 89.5);

                // Employee Pension Contribution Amount Computation
                $employee_pension_cont_amt = 0.105 * $basic_salary;

                // Employer Pension Contribution
                $employer_pension_contribution = 0.18 * $basic_salary;

                // Employee Pension Amount Computation
                $employee_pension_amt = $employee_pension_cont_amt + $employer_pension_contribution;
                
                // Gross Salary Computation
                $gross_salary = $basic_salary + $allowances;

                // Store the young lady's desired net salary, allowances and additional details
                $jobOfferDetails = new JobOfferDetails();
                $jobOfferDetails->basic_salary = $basic_salary;
                $jobOfferDetails->net_salary = $net_salary;
                $jobOfferDetails->allowances = $allowances;
                $jobOfferDetails->total_paye_tax = $total_paye_tax;
                $jobOfferDetails->gross_salary = $gross_salary;
                $jobOfferDetails->employee_pension_cont_amt = $employee_pension_cont_amt;
                $jobOfferDetails->employee_pension_amt = $employee_pension_amt;

                // Check if the data has been stored successfully
                if ($jobOfferDetails->save()) {
                    return response()->json(['responseMessage' => 'Your desired net salary and allowances has been submitted successfully','responseCode' => 200]);
                } else {
                    // If for some reason the young lady's data isn't stored return an error message.
                    return response()->json(['responseMessage' => "Something went wrong. Your data wasn't stored",'responseCode' => 500]);
                }

            } else {
                // Return an error msg if user does not enter a number
                return response()->json(['responseMessage' => 'Please enter a numeric value ONLY for the net salary and / or the allowances','responseCode' => 400]);
            }

        } else {
            // Return an error msg if the user does not enter the net salary and/or the allowances
            return response()->json(['responseMessage' => 'Please enter a value for the net salary and / or allowances.','responseCode' => 400]);
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
         return response()->json(['responseMessage' => $JobOfferDetails,'responseCode' => 200]);
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
