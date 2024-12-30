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

    // Filter All Expenses By Owner
    function filter_expenses_by_owner() {
        $owner_id = $_POST['owner_id'];

        if (!$owner_id) {
            echo json_encode([
                "message" => "Owner ID is Required",
                "status"  => 403,
                "success => false",
            ]);
        } else {
            $expenses = Expense::filter_expenses_by_owner($owner_id);
            if (count($expenses)) {
                echo json_encode([
                    "message"  => "Expenses Found Successfully",
                    "status"   => 200,
                    "success"  => true,
                    "expenses" => $expenses,
                ]);
            } else {
                echo json_encode([
                    "message"  => "Expenses Not Found",
                    "status"   => 404,
                    "success"  => false,
                    "expenses" => [],
                ]);
            }
        }
    }

    // Filter All Expenses By Owner And Date
    function filter_expenses_by_date() {
        $owner_id = $_POST['owner_id'];
        $days = $_POST['days'];

        if (!$owner_id && !$days) {
            echo json_encode([
                "message" => "Owner ID And Filter Day is Required",
                "status"  => 403,
                "success => false",
            ]);
        } else {
            $expenses = Expense::filter_expenses_by_owner_and_date($owner_id, $days);
            if (count($expenses)) {
                echo json_encode([
                    "message"  => "Expenses Found Successfully",
                    "status"   => 200,
                    "success"  => true,
                    "expenses" => $expenses,
                ]);
            } else {
                echo json_encode([
                    "message"  => "Expenses Not Found",
                    "status"   => 404,
                    "success"  => false,
                    "expenses" => [],
                ]);
            }
        }
    }

    // Filter Expense to Amount
    function filter_expense_amount_by_owner() {
        $owner_id = $_POST['owner_id'];

        if (!$owner_id) {
            echo json_encode([
                "message" => "Owner ID is Required",
                "status"  => 403,
                "success" => false,
            ]);
        } else {
            $total_expense_amount = Expense::get_total_expense_amount($owner_id);
            if ($total_expense_amount) {
                echo json_encode([
                    "message" => "Total Expense Amount Found!",
                    "status"  => 200,
                    "success" => true,
                    "amount"  => $total_expense_amount,
                ]);
            } else {
                echo json_encode([
                    "message" => "Total Expense Amount not Found!",
                    "status"  => 404,
                    "success" => false,
                    "amount"  => 0,
                ]);
            }
        }
    }

    // Filter Expense to Amount
    function filter_expense_amount_by_owner_and_day() {
        $owner_id = $_POST['owner_id'];
        $days = $_POST['days'];

        if (!$owner_id) {
            echo json_encode([
                "message" => "Owner ID is Required",
                "status"  => 403,
                "success" => false,
            ]);
        } else {
            $total_expense_amount = Expense::filter_total_expense_amount($owner_id, $days);
            if ($total_expense_amount) {
                echo json_encode([
                    "message" => "Total Expense Amount Found!",
                    "status"  => 200,
                    "success" => true,
                    "amount"  => $total_expense_amount,
                ]);
            } else {
                echo json_encode([
                    "message" => "Total Expense Amount not Found!",
                    "status"  => 404,
                    "success" => false,
                    "amount"  => 0,
                ]);
            }
        }
    }

    // Filter Expenses by Owner ID and Date Range
    function filter_expenses_by_date_range() {
        $owner_id = $_POST['owner_id'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        if ($owner_id && $from_date && $to_date) {
            $expense_amount = Expense::filter_expenses_by_owner_date_range($owner_id, $from_date, $to_date);

            if ($expense_amount) {
                echo json_encode([
                    "message" => "Total Expense Amount Found!",
                    "status"  => 200,
                    "success" => true,
                    "amount"  => $expense_amount,
                ]);
            } else {
                echo json_encode([
                    "message" => "Total Expense Amount Not Found!",
                    "status"  => 404,
                    "success" => false,
                    "amount"  => 0,
                ]);
            }
        } else {
            echo json_encode([
                "message" => "Owner ID is Required",
                "status"  => 403,
                "success" => false,
            ]);
        }
    }
}