<?php
namespace Flexfone;

use Flexfone\Models\Employee;
use Flexfone\Models\ActionResponse;
use Flexfone\Models\VariableCallflow;
use GuzzleHttp\RequestOptions;

class ApiClient
{
    /**
     * @var WebClient
     */
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
        $employee = $this->client->get('employee/' . $localNumber);

        return new Employee($employee);
    }

    /**
     * Retrieves all employee data from the Flexfone API.
     *
     * @return Employee[]
     */
    public function getEmployees(): array
    {
        return array_map(function ($employee) {
            return new Employee($employee);
        }, $this->client->get('employee'));
    }

    public function getVariableCallflows(): array
    {
        return array_map(function ($callflow) {
            return new VariableCallflow($callflow);
        }, $this->client->get('Callflow'));
    }

    public function setVariableCallflowState(int $localNumber, bool $state): ActionResponse
    {
        $actionResponse = $this->client->post('Callflow/SetCallFlowState', [
            RequestOptions::QUERY => [
                'localnumber' => $localNumber,
                'active' => var_export($state, true)
            ]
        ]);

        return new ActionResponse($actionResponse);
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
        ]);

        return json_decode($response);
    }

    public function validateMyfoneUser(string $username, string $password): ActionResponse
    {
        $actionResponse = $this->client->post('MyfoneUser/ValidateUser', [
            RequestOptions::QUERY => [
                'username' => $username,
                'password' => $password
            ]
        ]);

        return new ActionResponse($actionResponse);
    }
}
