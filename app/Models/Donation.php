<?php

namespace App\Models;

use CodeIgniter\Model;

class Donation extends Model
{

    public function insertDonation($data)
    {
        $db = \Config\Database::connect();
        return $db->table('donations_table')->insert($data);
    }
    public function getAllDonations()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('donations_table');
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getAllNonAnonymousDonation()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('donations_table');
        $builder->select('name');
        $builder->select('amount');
        $builder->where('anonymous', '0');
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }
    public function getDonationsbyID($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('donations_table');
        $builder->select("*");
        $builder->where('payment_id', $id);
        $query = $builder->get();
        $result = $query->getRowArray();
        return $result;
    }
    public function getDonationsbyEmail($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('donations_table');
        $builder->select("*");
        $builder->where('email', $email);
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }
    public function getDonationbyPaymentID($payment_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('donations_table');
        $builder->select("*");
        $builder->where('payment_id', $payment_id);
        $query = $builder->get();
        $result = $query->getRowArray();
        return $result;
    }
    
}
