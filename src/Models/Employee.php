<?php
namespace Flexfone\Models;

class Employee
{
    public $Localnumber;
    public $Name;
    public $Description;
    public $Email;
    public $Phonenumbers = [];
    public $Phones = [];
    public $Info = [];
    public $Department;

    public function __construct($employeeData)
    {
        $this->Localnumber = $employeeData->Localnumber;
        $this->Name = $employeeData->Name;
        $this->Description = $employeeData->Description;
        $this->Email = $employeeData->Email;

        $this->Phonenumbers = array_map(function($phoneNumber) {
            return new PhoneNumber($phoneNumber);
        }, $employeeData->PhoneNumbers);

        $this->Phones = array_map(function($phone) {
            return new Phone($phone);
        }, $employeeData->Phones);

        $this->Info = array_map(function($info) {
            return new EmployeeInfo($info);
        }, $employeeData->Info);

        $this->Department = new Department($employeeData->Department);
    }
}
