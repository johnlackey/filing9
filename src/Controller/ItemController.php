<?php

namespace App\Controller;

use App\Entity\Item;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ItemController extends AbstractController
{
    #[Route('/item', name: 'item_index', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {
        $items = $doctrine
            ->getRepository(Item::class)
            ->findAll();

        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'id' => $item->getId(),
                'location' => $item->getLocation()->getName(),
                'number' => $item->getNumber(),
            ];
        }


        return $this->json($data);
    }
}
