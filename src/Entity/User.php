<?php
namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    public function __construct()
    {
        parent::__construct();

        $this->firstName= '';
        $this->lastName = '';
        $this->address = '';
    }


    public function getfirstname(): ?string
    {
        return $this->firstName;
    }

    public function setfirstname(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getlastname(): ?string
    {
        return $this->lastName;
    }

    public function setlastname(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getaddress(): ?string
    {
        return $this->address;
    }

    public function setaddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}