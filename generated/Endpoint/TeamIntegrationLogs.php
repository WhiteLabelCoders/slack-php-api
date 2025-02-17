<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's Slack PHP API project.
 *
 * (c) JoliCode <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\Slack\Api\Endpoint;

class TeamIntegrationLogs extends \JoliCode\Slack\Api\Runtime\Client\BaseEndpoint implements \JoliCode\Slack\Api\Runtime\Client\Endpoint
{
    use \JoliCode\Slack\Api\Runtime\Client\EndpointTrait;

    /**
     * Gets the integration logs for the current team.
     *
     * @param array $queryParameters {
     *
     *     @var string $app_id Filter logs to this Slack app. Defaults to all logs.
     *     @var string $change_type Filter logs with this change type. Defaults to all logs.
     *     @var string $count
     *     @var string $page
     *     @var string $service_id Filter logs to this service. Defaults to all logs.
     *     @var string $token Authentication token. Requires scope: `admin`
     *     @var string $user Filter logs generated by this user’s actions. Defaults to all logs.
     * }
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/team.integrationLogs';
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    public function getAuthenticationScopes(): array
    {
        return ['slackAuth'];
    }

    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['app_id', 'change_type', 'count', 'page', 'service_id', 'token', 'user']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('app_id', ['string']);
        $optionsResolver->addAllowedTypes('change_type', ['string']);
        $optionsResolver->addAllowedTypes('count', ['string']);
        $optionsResolver->addAllowedTypes('page', ['string']);
        $optionsResolver->addAllowedTypes('service_id', ['string']);
        $optionsResolver->addAllowedTypes('token', ['string']);
        $optionsResolver->addAllowedTypes('user', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @return \JoliCode\Slack\Api\Model\TeamIntegrationLogsGetResponse200|\JoliCode\Slack\Api\Model\TeamIntegrationLogsGetResponsedefault|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'JoliCode\\Slack\\Api\\Model\\TeamIntegrationLogsGetResponse200', 'json');
        }

        return $serializer->deserialize($body, 'JoliCode\\Slack\\Api\\Model\\TeamIntegrationLogsGetResponsedefault', 'json');
    }
}
