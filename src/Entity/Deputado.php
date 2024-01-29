<?php

namespace App\Entity;

use App\Repository\DeputadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeputadoRepository::class)]
class Deputado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 11)]
    private ?string $cpf = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dataFalecimento = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataNascimento = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $escolaridade = null;

    #[ORM\Column(length: 255)]
    private ?string $municipioNascimento = null;

    #[ORM\Column(length: 255)]
    private ?string $nomeCivil = null;

    #[ORM\Column(length: 255)]
    private ?string $sexo = null;

    #[ORM\Column(length: 255)]
    private ?string $ufNascimento = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uri = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlWebsite = null;

    #[ORM\OneToMany(mappedBy: 'deputado', targetEntity: Despesa::class)]
    private Collection $despesas;

    public function __construct()
    {
        $this->despesas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getDataFalecimento(): ?\DateTimeInterface
    {
        return $this->dataFalecimento;
    }

    public function setDataFalecimento(?\DateTimeInterface $dataFalecimento): static
    {
        $this->dataFalecimento = $dataFalecimento;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): static
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getEscolaridade(): ?string
    {
        return $this->escolaridade;
    }

    public function setEscolaridade(?string $escolaridade): static
    {
        $this->escolaridade = $escolaridade;

        return $this;
    }

    public function getMunicipioNascimento(): ?string
    {
        return $this->municipioNascimento;
    }

    public function setMunicipioNascimento(string $municipioNascimento): static
    {
        $this->municipioNascimento = $municipioNascimento;

        return $this;
    }

    public function getNomeCivil(): ?string
    {
        return $this->nomeCivil;
    }

    public function setNomeCivil(string $nomeCivil): static
    {
        $this->nomeCivil = $nomeCivil;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): static
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getUfNascimento(): ?string
    {
        return $this->ufNascimento;
    }

    public function setUfNascimento(string $ufNascimento): static
    {
        $this->ufNascimento = $ufNascimento;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(?string $uri): static
    {
        $this->uri = $uri;

        return $this;
    }

    public function getUrlWebsite(): ?string
    {
        return $this->urlWebsite;
    }

    public function setUrlWebsite(?string $urlWebsite): static
    {
        $this->urlWebsite = $urlWebsite;

        return $this;
    }

    /**
     * @return Collection<int, Despesa>
     */
    public function getDespesas(): Collection
    {
        return $this->despesas;
    }

    public function addDespesa(Despesa $despesa): static
    {
        if (!$this->despesas->contains($despesa)) {
            $this->despesas->add($despesa);
            $despesa->setDeputado($this);
        }

        return $this;
    }

    public function removeDespesa(Despesa $despesa): static
    {
        if ($this->despesas->removeElement($despesa)) {
            // set the owning side to null (unless already changed)
            if ($despesa->getDeputado() === $this) {
                $despesa->setDeputado(null);
            }
        }

        return $this;
    }
}
