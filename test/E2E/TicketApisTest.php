<?php declare(strict_types=1);

namespace SupportPal\ApiClient\Tests\E2E;

use SupportPal\ApiClient\Dictionary\ApiDictionary;

class TicketApisTest extends BaseTestCase
{
    /**
     * @inheritDoc
     */
    protected function getGetAllEndpoints(): array
    {
        return [
            ApiDictionary::TICKET_TICKET => 'getTickets',
            ApiDictionary::TICKET_ATTACHMENT => 'getTicketAttachments',
            ApiDictionary::TICKET_STATUS => 'getTicketStatuses',
            ApiDictionary::TICKET_PRIORITY => 'getTicketPriorities',
            ApiDictionary::TICKET_CUSTOMFIELD => 'getTicketCustomFields',
            ApiDictionary::TICKET_DEPARTMENT => 'getDepartments',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getGetByIdEndpoints(): array
    {
        return [
            ApiDictionary::TICKET_DEPARTMENT => 'getDepartment' ,
            ApiDictionary::TICKET_PRIORITY => 'getTicketPriority',
            ApiDictionary::TICKET_STATUS => 'getTicketStatus',
            ApiDictionary::TICKET_ATTACHMENT => 'getTicketAttachment',
            ApiDictionary::TICKET_TICKET => 'getTicket',
        ];
    }

    public function testTicketSettings(): void
    {
        $this->settingsTestCase(ApiDictionary::TICKET_SETTINGS, 'getTicketSettings');
    }
}