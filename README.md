## Guildelines to Launch the App

1. Git Clone the source codes from the repository

2. Navigate to the project directory and <b>edit the .env file</b> to reflect your Database credentials

3. Enter the command <b>php artisan migrate</b> to migrate the DB table into your database

4. Enter <b>php artisan serve</b> to run the code


## Guidelines to enable the young lady send her desired net salary and allowances via a REST API

1. Open Postman (or any other substitute application of your choice)

2. Switch the method to <b>POST</b>

3. Enter http://127.0.0.1:8000/api/sendNetSalaryANDAllowances in the URL section

4. Navigate to the body and supply these information 
   net_salary: 2120.4 (you can enter any amount of your choice)
   allowances: 284.52 (you can enter any amount of your choice)

5. Click on send to submit the young lady's data.

## Guildelines to return the corresponding gross salary and additional details (Basic Salary, Total PAYE Tax, Employee Pension Contribution Amount and Employer Pension amount etc.)

1. Open Postman (or any other substitute application of your choice)

2. Switch the method to <b>GET</b>

3. Enter http://127.0.0.1:8000/api/returnGrossSalaryANDAdditionalDetails in the URL section

4. Click on send to return the corresponding gross salary and additional details


<br>
<hr>
NB: <h3>This REST API was developed by <b>Rapheal Djane Kotei</b> for Adaptive Computer Solutions</h3>
<hr>
