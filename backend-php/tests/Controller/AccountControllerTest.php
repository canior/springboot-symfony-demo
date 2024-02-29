<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountControllerTest extends WebTestCase
{
    public function testCanList(): void {
        $client = static::createClient();
        $client->request('GET', '/account');
        $this->assertResponseIsSuccessful();

        $accounts = [
            [
                'id' => 1,
                'name' => 'Good Burger',
                'status' => 'NEW',
                'contacts' => [
                    [
                        'id' => 2,
                        'firstName' => 'Salim',
                        'lastName' => 'Traher',
                        'phoneNumber' => '456-103-4512',
                        'primary' => true
                    ],
                    [
                        'id' => 3,
                        'firstName' => 'Ewan',
                        'lastName' => 'Maleck',
                        'phoneNumber' => '388-868-5602',
                        'primary' => false
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Acme Corp',
                'status' => 'NEW',
                'contacts' => [
                    [
                        'id' => 7,
                        'firstName' => 'Saccount_idoney',
                        'lastName' => 'Marconi',
                        'phoneNumber' => '137-718-5089',
                        'primary' => true
                    ],
                    [
                        'id' => 8,
                        'firstName' => 'Hedda',
                        'lastName' => 'Frie',
                        'phoneNumber' => '181-482-8234',
                        'primary' => false
                    ],
                ],
            ],
            [
                'id' => 3,
                'name' => 'Wonka Candy Company',
                'status' => 'NEW',
                'contacts' => [
                    [
                        'id' => 12,
                        'firstName' => 'Freddi',
                        'lastName' => 'Weippert',
                        'phoneNumber' => '588-683-6350',
                        'primary' => true
                    ],
                    [
                        'id' => 13,
                        'firstName' => 'Burr',
                        'lastName' => 'Margrett',
                        'phoneNumber' => '993-823-2355',
                        'primary' => false
                    ],
                ],
            ],
            [
                'id' => 4,
                'name' => 'Great Glass Elevator Corp',
                'status' => 'NEW',
                'contacts' => [],
            ],
        ];

        $this->assertEquals(json_encode($accounts), $client->getResponse()->getContent());
    }

    public function testCanListWithQuery(): void {
        $client = static::createClient();
        $client->request('GET', '/account?query=456-103-4512');
        $this->assertResponseIsSuccessful();

        $accounts = [
            [
                'id' => 1,
                'name' => 'Good Burger',
                'status' => 'NEW',
                'contacts' => [
                    [
                        'id' => 2,
                        'firstName' => 'Salim',
                        'lastName' => 'Traher',
                        'phoneNumber' => '456-103-4512',
                        'primary' => true
                    ],
                    [
                        'id' => 3,
                        'firstName' => 'Ewan',
                        'lastName' => 'Maleck',
                        'phoneNumber' => '388-868-5602',
                        'primary' => false
                    ],
                ],
            ],
        ];

        $this->assertEquals(json_encode($accounts), $client->getResponse()->getContent());
    }

    public function testCanListWithFilter(): void {
        $client = static::createClient();

        $client->request('GET', '/account?unassigned=true');
        $this->assertResponseIsSuccessful();
        $accounts = [
            [
                'id' => 4,
                'name' => 'Great Glass Elevator Corp',
                'status' => 'NEW',
                'contacts' => [],
            ],
        ];
        $this->assertEquals(json_encode($accounts), $client->getResponse()->getContent());

        $client->request('GET', '/account?unassigned=true&query=456-103-4512');
        $this->assertResponseIsSuccessful();
        $this->assertEquals(json_encode([]), $client->getResponse()->getContent());
    }
}
