<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $nombre;
    
    /**
     * @ORM\Column(type="string", length=250)
     */
    private $codigo;
    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="productos", cascade={"persist"})
     */
    private $categoria;
    
    
    
    public function __construct($nombre=null, $codigo=null)
    {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
    
    function getCodigo(): ?string
    {
        return $this->codigo;
    }

    function setCodigo($codigo): self
    {
        $this->codigo = $codigo;
        
        return $this;
    }

    function getCategoria()
    {
        return $this->categoria;
    }

    function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }
    
}
