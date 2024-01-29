<?php

namespace App\Entity;

use App\Repository\FornecedorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FornecedorRepository::class)]
class Fornecedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 14)]
    private ?string $cnpjCpfFornecedor = null;

    #[ORM\Column(length: 255)]
    private ?string $nomeFornecedor = null;

    #[ORM\OneToMany(mappedBy: 'fornecedor', targetEntity: Despesa::class)]
    private Collection $despesas;

    public function __construct()
    {
        $this->despesas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCnpjCpfFornecedor(): ?string
    {
        return $this->cnpjCpfFornecedor;
    }

    public function setCnpjCpfFornecedor(string $cnpjCpfFornecedor): static
    {
        $this->cnpjCpfFornecedor = $cnpjCpfFornecedor;

        return $this;
    }

    public function getNomeFornecedor(): ?string
    {
        return $this->nomeFornecedor;
    }

    public function setNomeFornecedor(string $nomeFornecedor): static
    {
        $this->nomeFornecedor = $nomeFornecedor;

        return $this;
    }

    /**
     * @return Collection<int, Despesa>
     */
    public function getDespesas(): Collection
    {
        return $this->despesas;
    }
}
