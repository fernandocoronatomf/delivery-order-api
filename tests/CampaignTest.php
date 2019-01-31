<?php

namespace Tests;

use App\Domain\Campaign\Campaign;
use App\Domain\Campaign\CampaignId;
use App\Repository\CampaignRepository;
use App\Repository\InMemoryCollection;
use PHPUnit\Framework\TestCase;

class CampaignTest extends TestCase
{
    /** @test */
    public function it_adds_a_new_campaign()
    {
        $persistence = new InMemoryCollection();

        $campaignRepository = new CampaignRepository($persistence);
        $campaign = Campaign::fromState([
            'id' => $campaignRepository->generateId(),
            'name' => 'campaign nam',
            'source' => 'source',
            'type' => 'Test Type',
            'ads' => 'Test ad',
        ]);

        $this->assertTrue($campaign->getId() instanceof CampaignId);
        $this->assertTrue($campaign->getType() === 'Test Type');
        $this->assertTrue($campaign->getAds() === 'Test ad');
    }
}