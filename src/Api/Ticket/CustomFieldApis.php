<?php declare(strict_types = 1);

namespace SupportPal\ApiClient\Api\Ticket;

use SupportPal\ApiClient\Api\ApiAware;
use SupportPal\ApiClient\Exception\HttpResponseException;
use SupportPal\ApiClient\Exception\InvalidArgumentException;
use SupportPal\ApiClient\Model\Collection\Collection;
use SupportPal\ApiClient\Model\Ticket\CustomField;

trait CustomFieldApis
{
    use ApiAware;

    /**
     * @param array<mixed> $queryParameters
     * @return Collection
     * @throws HttpResponseException
     * @throws InvalidArgumentException
     */
    public function getTicketCustomFields(array $queryParameters = []): Collection
    {
        $response = $this->getApiClient()->getTicketCustomFields($queryParameters);
        $body = $this->decodeBody($response);
        $models = array_map([$this, 'createCustomField'], $body['data']);

        return $this->getCollectionFactory()->create($body['count'], $models);
    }

    /**
     * @param array<mixed> $data
     * @return CustomField
     */
    private function createCustomField(array $data): CustomField
    {
        /** @var CustomField $model */
        $model = $this->getModelCollectionFactory()->create(CustomField::class, $data);

        return $model;
    }
}