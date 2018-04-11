<?php
namespace Flexfone;

use Flexfone\Models\Employee;
use Flexfone\Models\ActionResponse;
use Flexfone\Models\VariableCallflow;
use GuzzleHttp\RequestOptions;

class ApiClient
{
    protected $client;

    public function __construct(string $pbxId, string $apiKey)
    {
        $this->client = new WebClient($pbxId, $apiKey);
    }

    /**
     * Retrieves employee data from the Flexfone API.
     *
     * @param int $localNumber The local number of the employee
     * @return Employee
     */
    public function getEmployee(int $localNumber): Employee
    {
        $response = $this->client->get('employee/' . $localNumber)
            ->getBody()
            ->getContents();

        $employee = json_decode($response);

        return new Employee($employee);
    }

    /**
     * Retrieves all employee data from the Flexfone API.
     *
     * @return Employee[]
     */
    public function getEmployees(): array
    {
        $response = $this->client->get('employee')
            ->getBody()
            ->getContents();

        $employees = json_decode($response);

        return array_map(function ($employee) {
            return new Employee($employee);
        }, $employees);
    }

    public function getVariableCallflows(): array
    {
        $response = $this->client->get('Callflow')
            ->getBody()
            ->getContents();

        $variableCallflows = json_decode($response);

        return array_map(function ($callflow) {
            return new VariableCallflow($callflow);
        }, $variableCallflows);
    }

    public function setVariableCallflowState(int $localNumber, bool $state): ActionResponse
    {
        $response = $this->client->post('Callflow/SetCallFlowState', [
            RequestOptions::QUERY => [
                'localnumber' => $localNumber,
                'active' => var_export($state, true)
            ]
        ])
            ->getBody()
            ->getContents();

        $setCallflowResponse = json_decode($response);

        return new ActionResponse($setCallflowResponse);
    }

    public function startCall(int $employeeLocalNumber, string $phoneNumber, string $device = null)
    {
        $postData = [
            'employee' => $employeeLocalNumber,
            'callee' => $phoneNumber,
        ];

        if (isset($device)) {
            $postData['device'] = $device;
        }

        $response = $this->client->post('Call', [
            RequestOptions::QUERY => $postData
        ])
            ->getBody()
            ->getContents();

        return json_decode($response);
    }

    public function validateMyfoneUser(string $username, string $password): ActionResponse
    {
        $response = $this->client->post('MyfoneUser/ValidateUser', [
            RequestOptions::QUERY => [
                'username' => $username,
                'password' => $password
            ]
        ])
            ->getBody()
            ->getContents();

        $validationResult = json_decode($response);

        return new ActionResponse($validationResult);
    }
}
