<?php 

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Summary of User
 * @ORM\Entity
 * @ORM\Table(name="users")
 * 
 */
class User {
    /**
     * Summary of id
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * Summary of name
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * Summary of name
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * Summary of name
     * @ORM\Column(type="string")
     */
    private $password;

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }

}