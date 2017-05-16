<?php

namespace Budgegeria\Bundle\IntlFormatBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServiceIntegrationTest extends WebTestCase
{
    /**
     * Tests if formatter are added by service-tags into the IntlFormatter sprintf service
     */
    public function testAvailableFormatter()
    {
        $client = self::createClient();

        $sprintfFormat = $client->getContainer()->get('intl_format.sprintf');

        // number formatter
        self::assertSame('2,2', $sprintfFormat->format('%number', 2.2));
        // datetime formatter
        self::assertSame('März', $sprintfFormat->format('%date_month_name', new \DateTime('2016-03-05')));
        // timezone formatter
        self::assertSame('UTC', $sprintfFormat->format('%timeseries_id', new \DateTimeZone('UTC')));
    }
}