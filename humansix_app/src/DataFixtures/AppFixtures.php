<?php

namespace App\DataFixtures;

use App\Entity\CartContent;
use App\Entity\CartRow;
use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {

        //add 4 products to Database
        $product1 = new Product();
        $product2 = new Product();
        $product3 = new Product();
        $product4 = new Product();

        $product1->setSku("ref1");
        $product1->setName("Product 1");
        $product1->setPrice(14);
        $manager->persist($product1);

        $product2->setSku("ref2");
        $product2->setName("Product 2");
        $product2->setPrice(10);
        $manager->persist($product2);

        $product3->setSku("ref3");
        $product3->setName("Product 3");
        $product3->setPrice(15);
        $manager->persist($product3);

        $product4->setSku("ref4");
        $product4->setName("Product 4");
        $product4->setPrice(20);
        $manager->persist($product4);
        $manager->flush();

        //add 4 Customer to database
        $customer1 = new Customer();
        $customer2 = new Customer();
        $customer3 = new Customer();

        $customer1->setFirstName("John");
        $customer1->setLastName("Dow");

        $customer2->setFirstName("Walter");
        $customer2->setLastName("White");

        $customer3->setFirstName("John");
        $customer3->setLastName("Snow");

        $manager->persist($customer1);
        $manager->persist($customer2);
        $manager->persist($customer3);

        $manager->flush();
        //add 4 order to database

        /*
         * Orders
         */

        //order 1
        $cartRow1 = new CartRow();
        $cartRow1->setProductId($product1->getId());
        $cartRow1->setQuantity(1);


        $order1 = new Order();
        $manager->persist($cartRow1);
        $order1->setCustomer($customer1);
        $order1->setOrderDate(new \DateTime('2019-09-02 17:02:53'));
        $order1->setStatus("processing");
        $order1->addRow($cartRow1);
        $price = $cartRow1->getQuantity()*$product1->getPrice();
        $order1->setOrderPrice($price);
        $manager->persist($order1);


        //order 2
        $cartRow2 = new CartRow();
        $cartRow2->setProductId($product2->getId());
        $cartRow2->setQuantity(1);
        $manager->persist($cartRow2);

        $cartRow3 = new CartRow();
        $cartRow3->setProductId($product3->getId());
        $cartRow3->setQuantity(2);
        $manager->persist($cartRow3);

        $order2 = new Order();
        $order2->setCustomer($customer1);
        $order2->setOrderDate(new \DateTime("2019-09-02 18:23:32"));
        $order2->setStatus("processing");
        $order2->addRow($cartRow2);
        $order2->addRow($cartRow3);
        $price2 = $cartRow2->getQuantity()*$product2->getPrice()+$cartRow3->getQuantity()*$product3->getPrice();
        $order2->setOrderPrice($price2);
        $manager->persist($order2);

        //order3
        $cartRow4 = new CartRow();
        $cartRow4->setProductId($product2->getId());
        $cartRow4->setQuantity(10);
        $manager->persist($cartRow4);

        $cartRow5 = new CartRow();
        $cartRow5->setProductId($product4->getId());
        $cartRow5->setQuantity(1);
        $manager->persist($cartRow5);

        $order3 = new Order();
        $order3->setCustomer($customer2);
        $order3->setOrderDate(new \DateTime("2019-09-04 10:32:51"));
        $order3->setStatus("processing");
        $order3->addRow($cartRow4);
        $order3->addRow($cartRow5);
        $price3 = $cartRow4->getQuantity()*$product2->getPrice()+$cartRow5->getQuantity()*$product4->getPrice();
        $order3->setOrderPrice($price3);
        $manager->persist($order3);

       //order4
        $cartRow6 = new CartRow();
        $cartRow6->setProductId($product1->getId());
        $cartRow6->setQuantity(1);
        $manager->persist($cartRow6);

        $order4 = new Order();
        $order4->setCustomer($customer3);
        $order4->setOrderDate(new \DateTime('2019-09-05 08:54:22'));
        $order4->setStatus("canceled");
        $order4->addRow($cartRow6);
        $price = $cartRow6->getQuantity()*$product1->getPrice();
        $order4->setOrderPrice($price);
        $manager->persist($order4);


        //add User "Admin"
        $user = new User();
        $user->setUsername("admin");
        $password = $this->encoder->encodePassword($user, 'S3cr3T+');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);


        $manager->flush();
    }
}
