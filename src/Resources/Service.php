<?php

namespace Sendy\Api\Resources;

use GuzzleHttp\Exception\GuzzleException;
use Sendy\Api\ApiException;

class Service extends Resource
{
    /**
     * List services associated with a carrier
     *
     * Display all services associated with a carrier in a list.
     *
     * @param int $carrierId The id of the carrier
     * @return array<string, mixed|array<string|mixed>>
     * @throws GuzzleException
     * @throws ApiException
     * @see https://app.sendy.nl/api/docs#tag/Services/operation/getCarrierServices
     */
    public function list(int $carrierId): array
    {
        return $this->connection->get("/carriers/{$carrierId}/services");
    }

    /**
     * List services associated with a carrier based on $country, $product_type, and $delivery_type
     *
     * Display all services associated with a carrier in a list.
     *
     * @param int $carrierId The id of the carrier
     * @param string $country Country code
     * @param int $product_type 1 for mailbox package, 2 for package, 3 for pallet
     * @param int $delivery_type 1 for address, 2 for parcel shop
     * @return array<string, mixed|array<string|mixed>>
     * @throws GuzzleException
     * @throws ApiException
     * @see https://app.sendy.nl/api/docs#tag/Services/operation/getCarrierServices
     */
    public function listByParams(int $carrierId, string $country = null, int $product_type = null, int $delivery_type = null): array
    {
        $params = [];
        if($country !== null){
            $params['country'] = $country;
        }
        if($product_type !== null){
            $params['product_type'] = $product_type;
        }
        if($delivery_type !== null){
            $params['delivery_type'] = $delivery_type;
        }
        return $this->connection->get("/carriers/{$carrierId}/services", $params);
    }
}
