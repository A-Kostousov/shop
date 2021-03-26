<?php

namespace App\Menu;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Knp\Menu\FactoryInterface;
class Builder
{

    private $factory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
    }

    public function mainMenu(array $options)
    {
        $menu = $this->factory->createItem('root',
            ['childrenAttributes' =>
                ['class' => 'nav navbar-nav' ]
            ]);
        $menu->addChild('На главную',
            ['route' => 'homepage']);
        $catalogue = $menu->addChild('Каталог',
            ['attributes' => ['dropdown' => true,],]);

        /**
         * @var EntityRepository $categotyRepo
         */
        $categotyRepo = $this->entityManager->getRepository(Category::class);

        /**
         * @var Category[] $categories
         */
        $categories = $categotyRepo->findBy([], ['id' => 'ASC']);


        foreach ($categories as $categoty) {
            $catalogue->addChild($categoty->getName(), [
                'route' => 'category_show',
                'routeParameters' => [
                    'id' => $categoty->getId(),
                ]
            ]);

        }

        $catalogue->addChild('Все товары', [
            'route' => 'categories',
            'attributes' => [
                'divider_prepend' => true,
            ]
         ]);

        $menu->addChild('Обратная связь', ['route' => 'feedback']);

        return $menu;
    }
}