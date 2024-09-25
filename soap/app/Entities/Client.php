<?php 

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
/**
 * Summary of Client
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Client {
    /**
     * Summary of id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue 
     */
    private $id;
    /**
     * Summary of nombres
     * @ORM\Column(type="string")
     */
    private $documento;
    /**
     * Summary of nombres
     * @ORM\Column(type="string")
     */
    private $nombres;
    
    /** @ORM\Column(type="string") */
    private $email;
    /**
     * Summary of celular
     * @ORM\Column(type="string")
     */
    private $celular;
    /**
     * Summary of setDocumento
     * @param string $documento
     * @return void
     */
    public function setDocumento(string $documento) {
        
        $this->documento = $documento;

    }
    /**
     * Summary of setNombres
     * @param string $nombres
     * @return void
     */
    public function setNombres(string $nombres) {

        $this->nombres = $nombres;
        
    }
    /**
     * Summary of setEmail
     * @param string $email
     * @return void
     */
    public function setEmail(string $email) {

        $this->email = $email;

    }
    /**
     * Summary of setCelular
     * @param string $celular
     * @return void
     */
    public function setCelular(string $celular) {

        $this->celular = $celular;

    }
    /**
     * Summary of getNombres
     * @return string
     */
    public function getNombres(): string {
        return $this->nombres;
    }
    /**
     * Summary of getEmail
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }
    /**
     * Summary of getCelular
     * @return string
     */
    public function getCelular(): string {
        return $this->celular;
    }


}