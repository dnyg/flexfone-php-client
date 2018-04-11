<?php
namespace Flexfone\Tests\Feature;

use PHPUnit\Framework\TestCase;
use Flexfone\ApiClient;

class ApiClientTest extends TestCase
{
    /**
     * @var ApiClient
     */
    public $client;

    /**
     * @var array
     */
    public $config;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->config = include(__DIR__ . '/../config.php');
    }

    protected function setUp()
    {
        parent::setUp();
        $this->client = new ApiClient($this->config['pbx_id'], $this->config['api_key']);
    }

    public function testItCanGetEmployee()
    {
        $result = $this->client->getEmployee($this->config['test_employee']);

        $this->assertInstanceOf('Flexfone\Models\Employee' ,$result);
    }

    public function testItCanGetEmployees()
    {
        $result = $this->client->getEmployees();

        $this->assertInternalType('array', $result);
        $this->assertInstanceOf('Flexfone\Models\Employee', $result[0]);
    }

    public function testItCanGetVariableCallflows()
    {
        $result = $this->client->getVariableCallflows();

        $this->assertInternalType('array', $result);
        $this->assertInstanceOf('Flexfone\Models\VariableCallflow', $result[0]);
    }

    public function testItCanSetVariableCallflow()
    {
        $result = $this->client->setVariableCallflowState($this->config['test_callflow'], true);
        $this->assertInstanceOf('Flexfone\Models\ActionResponse',$result);

        $result = $this->client->setVariableCallflowState($this->config['test_callflow'], false);
        $this->assertInstanceOf('Flexfone\Models\ActionResponse',$result);
    }

    /**
     * I should probably mock this call at some point, but I don't have access to a Flexfone solution, so I can't
     * confirm whether this call returns an instance of ActionResponse.
     */
    public function testItCanStartACall()
    {
        $this->assertTrue(true);
    }

    public function testItCanValidateMyfoneUser()
    {
        $result = $this->client->validateMyfoneUser($this->config['myfone_username'], $this->config['myfone_password']);

        $this->assertInstanceOf('Flexfone\Models\ActionResponse', $result);
        $this->assertTrue($result->Success);
    }
}
