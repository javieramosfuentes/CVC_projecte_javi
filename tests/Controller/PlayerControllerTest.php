<?php

namespace App\Test\Controller;

use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayerControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/player/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Player::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Player index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'player[name]' => 'Testing',
            'player[lastname]' => 'Testing',
            'player[position]' => 'Testing',
            'player[age]' => 'Testing',
            'player[goals]' => 'Testing',
            'player[album]' => 'Testing',
            'player[team]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Player();
        $fixture->setName('My Title');
        $fixture->setLastname('My Title');
        $fixture->setPosition('My Title');
        $fixture->setAge('My Title');
        $fixture->setGoals('My Title');
        $fixture->setAlbum('My Title');
        $fixture->setTeam('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Player');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Player();
        $fixture->setName('Value');
        $fixture->setLastname('Value');
        $fixture->setPosition('Value');
        $fixture->setAge('Value');
        $fixture->setGoals('Value');
        $fixture->setAlbum('Value');
        $fixture->setTeam('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'player[name]' => 'Something New',
            'player[lastname]' => 'Something New',
            'player[position]' => 'Something New',
            'player[age]' => 'Something New',
            'player[goals]' => 'Something New',
            'player[album]' => 'Something New',
            'player[team]' => 'Something New',
        ]);

        self::assertResponseRedirects('/player/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getLastname());
        self::assertSame('Something New', $fixture[0]->getPosition());
        self::assertSame('Something New', $fixture[0]->getAge());
        self::assertSame('Something New', $fixture[0]->getGoals());
        self::assertSame('Something New', $fixture[0]->getAlbum());
        self::assertSame('Something New', $fixture[0]->getTeam());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Player();
        $fixture->setName('Value');
        $fixture->setLastname('Value');
        $fixture->setPosition('Value');
        $fixture->setAge('Value');
        $fixture->setGoals('Value');
        $fixture->setAlbum('Value');
        $fixture->setTeam('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/player/');
        self::assertSame(0, $this->repository->count([]));
    }
}
