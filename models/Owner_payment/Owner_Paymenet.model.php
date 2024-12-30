<?php

class OwnerPayment {
    public $id;
    public $owner_id;
    public $from_date;
    public $to_date;
    public $revenue;
    public $expense;
    public $total_paid;

    public function __construct($id, $owner_id, $from_date, $to_date, $revenue, $expense, $total_paid) {
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->revenue = $revenue;
        $this->expense = $expense;
        $this->total_paid = $total_paid;
    }

    // Create Owner Payment
    public function create_owner_payment() {
        global $tx, $db;
        $stmnt = $db->prepare("INSERT INTO {$tx}owner_payments(id, owner_id, from_date, to_date, revenue, expense, total_paid)VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmnt->bind_param("iissddd", $this->id, $this->owner_id, $this->from_date, $this->to_date, $this->revenue, $this->expense, $this->total_paid);
        return $stmnt->execute();
    }
}