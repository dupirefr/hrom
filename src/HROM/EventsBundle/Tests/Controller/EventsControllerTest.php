<?php

namespace HROM\EventsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventsControllerTest extends WebTestCase
{
    public function testCalendar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calendar');
    }

}
