<?php declare(strict_types = 1);

namespace SupportPal\ApiClient\Tests\Integration\ApiClient;

use SupportPal\ApiClient\Tests\DataFixtures\Ticket\ChannelSettingsData;
use SupportPal\ApiClient\Tests\DataFixtures\Ticket\CustomFieldData;
use SupportPal\ApiClient\Tests\DataFixtures\Ticket\DepartmentData;
use SupportPal\ApiClient\Tests\DataFixtures\Ticket\PriorityData;
use SupportPal\ApiClient\Tests\DataFixtures\Ticket\SettingsData;
use SupportPal\ApiClient\Tests\Functional\ApiComponentTest;

class TicketApisTest extends ApiComponentTest
{
    /**
     * @var array[]
     */
    private $getEndpoints = [
        'getDepartments' => [DepartmentData::GET_DEPARTMENTS_SUCCESSFUL_RESPONSE, []],
        'getDepartment' => [DepartmentData::GET_DEPARTMENT_SUCCESSFUL_RESPONSE, [1]],
        'getTicketSettings' => [SettingsData::SUCCESSFUL_GET_RESPONSE, []],
        'getChannelSettings' => [ChannelSettingsData::GET_SUCCESSFUL_RESPONSE_DATA, ['web']],
        'getTicketCustomFields' => [CustomFieldData::GET_CUSTOMFIELDS_SUCCESSFUL_RESPONSE_DATA, []],
        'getTicketPriorities' => [PriorityData::GET_PRIORITIES_SUCCESSFUL_RESPONSE, []],
        'getTicketPriority' => [PriorityData::GET_PRIORITY_SUCCESSFUL_RESPONSE, [1]],
    ];

    /**
     * @return array<mixed>
     */
    protected function getGetEndpoints(): array
    {
        return $this->getEndpoints;
    }
}