<?php

class ExpenseApi {
    // create a new expense record
    function create_expense() {
        $vehicle_id = $_POST['vehicle_id'];
        $expense_type = $_POST['expense_type'];
        $amount = $_POST['amount'];
        $description = $_POST['description'];
        $maintenance_id = $_POST['maintenance_id'];

        if ($vehicle_id && $expense_type && $amount && $description) {
            $expense = new Expense(null, $vehicle_id, $expense_type, $amount, $description, $maintenance_id, null);
            $result = $expense->create();
            if ($result) {
                echo json_encode([
                    'status'  => 200,
                    'success' => true,
                    'message' => 'Expense record created successfully',
                ]);
            } else {
                echo json_encode([
                    'status'  => 500,
                    'success' => false,
                    'message' => 'Failed to create expense record',
                ]);
            }
        } else {
            echo json_encode([
                'status'  => 400,
                'success' => false,
                'message' => 'Vehicle ID, Expense Type, Amount, and Description are required',
            ]);
        }
    }
}