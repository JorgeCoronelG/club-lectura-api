<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\DonationServiceInterface;
use App\Core\BaseApiController;
use App\Exceptions\CustomErrorException;
use App\Http\Requests\Donation\StoreDonationRequest;
use App\Http\Resources\Donacion\DonacionResource;
use Illuminate\Http\JsonResponse;

class DonationController extends BaseApiController
{
    private DonationServiceInterface $donationService;

    public function __construct(
        DonationServiceInterface $donationService
    ) {
        $this->donationService = $donationService;
    }

    /**
     * @throws CustomErrorException
     */
    public function store(StoreDonationRequest $request): JsonResponse
    {
        $donation = $this->donationService->create($request->toData());
        return $this->showOne(DonacionResource::make($donation));
    }
}
