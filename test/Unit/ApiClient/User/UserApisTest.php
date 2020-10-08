<?php declare(strict_types = 1);

namespace SupportPal\ApiClient\Tests\Unit\ApiClient\User;

use SupportPal\ApiClient\Dictionary\ApiDictionary;
use SupportPal\ApiClient\Exception\HttpResponseException;
use SupportPal\ApiClient\Tests\DataFixtures\Core\UserData;
use SupportPal\ApiClient\Tests\Unit\ApiClientTest;

/**
 * Class UserApisTest
 * @package SupportPal\ApiClient\Tests\Unit\ApiClient
 * @covers \SupportPal\ApiClient\ApiClient\UserApis
 * @covers \SupportPal\ApiClient\ApiClient
 */
class UserApisTest extends ApiClientTest
{
    /**
     * @var array<mixed>
     */
    private $getUsersSuccessfulResponse = UserData::GET_USERS_SUCCESSFUL_RESPONSE;

    public function testGetUsers(): void
    {
        $queryParams = ['test' => 'value'];
        $request = $this->requestCommonExpectations('GET', ApiDictionary::USER_USER, $queryParams, []);
        $response = $this->sendRequestCommonExpectations(
            200,
            (string) json_encode($this->getUsersSuccessfulResponse),
            $request
        );
        $getUsersResponse = $this->apiClient->getUsers($queryParams);
        self::assertSame($response->reveal(), $getUsersResponse);
    }

    public function testHttpExceptionGetUsers(): void
    {
        $queryParams = ['test' => 'value'];
        $this->expectException(HttpResponseException::class);
        $request = $this->requestCommonExpectations('GET', ApiDictionary::USER_USER, $queryParams, []);
        $this->httpClient->sendRequest($request)->willThrow(HttpResponseException::class)->shouldBeCalled();
        $this->apiClient->getUsers($queryParams);
    }

    /**
     * @param int $statusCode
     * @param string $responseBody
     * @dataProvider provideUnsuccessfulTestCases
     */
    public function testUnsuccessfulGetUsers(int $statusCode, string $responseBody): void
    {
        $queryParams = ['test' => 'value'];
        $this->expectException(HttpResponseException::class);
        $request = $this->requestCommonExpectations('GET', ApiDictionary::USER_USER, $queryParams, []);
        $this->sendRequestCommonExpectations($statusCode, $responseBody, $request);
        $this->apiClient->getUsers($queryParams);
    }
}