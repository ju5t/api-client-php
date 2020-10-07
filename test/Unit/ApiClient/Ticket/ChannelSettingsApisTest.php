<?php declare(strict_types = 1);

namespace SupportPal\ApiClient\Tests\Unit\ApiClient\Ticket;

use SupportPal\ApiClient\Dictionary\ApiDictionary;
use SupportPal\ApiClient\Exception\HttpResponseException;
use SupportPal\ApiClient\Tests\DataFixtures\Ticket\ChannelSettingsData;
use SupportPal\ApiClient\Tests\Unit\ApiClientTest;

class ChannelSettingsApisTest extends ApiClientTest
{
    /**
     * @var array<mixed>
     */
    private $channelSettingsSuccessfulResponse = ChannelSettingsData::GET_SUCCESSFUL_RESPONSE_DATA;

    private const TEST_CHANNEL = 'web';

    public function testSuccessfulGetChannelSettings(): void
    {
        $request = $this
            ->requestCommonExpectations(
                'GET',
                sprintf(ApiDictionary::TICKET_CHANNEL_SETTINGS, self::TEST_CHANNEL),
                [],
                []
            );
        $response = $this->sendRequestCommonExpectations(
            200,
            (string) json_encode($this->channelSettingsSuccessfulResponse),
            $request
        );

        $ticketSettingsResponse = $this->apiClient->getChannelSettings(self::TEST_CHANNEL);
        self::assertSame($response->reveal(), $ticketSettingsResponse);
    }

    /**
     * @param int $statusCode
     * @param string $responseBody
     * @dataProvider provideUnsuccessfulTestCases
     */
    public function testUnsuccessfulGetChannelSettings(int $statusCode, string $responseBody): void
    {
        $this->expectException(HttpResponseException::class);
        $request = $this
            ->requestCommonExpectations(
                'GET',
                sprintf(ApiDictionary::TICKET_CHANNEL_SETTINGS, self::TEST_CHANNEL),
                [],
                []
            );
        $this->sendRequestCommonExpectations($statusCode, $responseBody, $request);
        $this->apiClient->getChannelSettings(self::TEST_CHANNEL);
    }

    public function testHttpExceptionGetChannelSettings(): void
    {
        $this->expectException(HttpResponseException::class);
        $request = $this
            ->requestCommonExpectations(
                'GET',
                sprintf(ApiDictionary::TICKET_CHANNEL_SETTINGS, self::TEST_CHANNEL),
                [],
                []
            );
        $this->httpClient->sendRequest($request)->willThrow(HttpResponseException::class)->shouldBeCalled();
        $this->apiClient->getChannelSettings(self::TEST_CHANNEL);
    }
}
