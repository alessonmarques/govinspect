<?php

namespace App\Entity;

use App\Repository\DespesaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DespesaRepository::class)]
class Despesa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ano = null;

    #[ORM\Column]
    private ?int $mes = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataDocumento = null;

    #[ORM\Column]
    private ?int $codDocumento = null;

    #[ORM\Column]
    private ?int $codLote = null;

    #[ORM\Column]
    private ?int $codTipoDocumento = null;

    #[ORM\Column(length: 255)]
    private ?string $numDocumento = null;

    #[ORM\Column]
    private ?int $parcela = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoDocumento = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoDespesa = null;

    #[ORM\Column(length: 255)]
    private ?string $urlDOcumento = null;

    #[ORM\Column]
    private ?float $valorDocumento = null;

    #[ORM\Column]
    private ?float $valorGlosa = null;

    #[ORM\Column]
    private ?float $valorLiquido = null;

    #[ORM\ManyToOne(inversedBy: 'despesas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fornecedor $fornecedor = null;

    #[ORM\ManyToOne(inversedBy: 'despesas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Deputado $deputado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(int $ano): static
    {
        $this->ano = $ano;

        return $this;
    }

    public function getMes(): ?int
    {
        return $this->mes;
    }

    public function setMes(int $mes): static
    {
        $this->mes = $mes;

        return $this;
    }

    public function getDataDocumento(): ?\DateTimeInterface
    {
        return $this->dataDocumento;
    }

    public function setDataDocumento(\DateTimeInterface $dataDocumento): static
    {
        $this->dataDocumento = $dataDocumento;

        return $this;
    }

    public function getCodDocumento(): ?int
    {
        return $this->codDocumento;
    }

    public function setCodDocumento(int $codDocumento): static
    {
        $this->codDocumento = $codDocumento;

        return $this;
    }

    public function getCodLote(): ?int
    {
        return $this->codLote;
    }

    public function setCodLote(int $codLote): static
    {
        $this->codLote = $codLote;

        return $this;
    }

    public function getCodTipoDocumento(): ?int
    {
        return $this->codTipoDocumento;
    }

    public function setCodTipoDocumento(int $codTipoDocumento): static
    {
        $this->codTipoDocumento = $codTipoDocumento;

        return $this;
    }

    public function getNumDocumento(): ?string
    {
        return $this->numDocumento;
    }

    public function setNumDocumento(string $numDocumento): static
    {
        $this->numDocumento = $numDocumento;

        return $this;
    }

    public function getParcela(): ?int
    {
        return $this->parcela;
    }

    public function setParcela(int $parcela): static
    {
        $this->parcela = $parcela;

        return $this;
    }

    public function getTipoDocumento(): ?string
    {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento(string $tipoDocumento): static
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    public function getTipoDespesa(): ?string
    {
        return $this->tipoDespesa;
    }

    public function setTipoDespesa(string $tipoDespesa): static
    {
        $this->tipoDespesa = $tipoDespesa;

        return $this;
    }

    public function getUrlDOcumento(): ?string
    {
        return $this->urlDOcumento;
    }

    public function setUrlDOcumento(string $urlDOcumento): static
    {
        $this->urlDOcumento = $urlDOcumento;

        return $this;
    }

    public function getValorDocumento(): ?float
    {
        return $this->valorDocumento;
    }

    public function setValorDocumento(float $valorDocumento): static
    {
        $this->valorDocumento = $valorDocumento;

        return $this;
    }

    public function getValorGlosa(): ?float
    {
        return $this->valorGlosa;
    }

    public function setValorGlosa(float $valorGlosa): static
    {
        $this->valorGlosa = $valorGlosa;

        return $this;
    }

    public function getValorLiquido(): ?float
    {
        return $this->valorLiquido;
    }

    public function setValorLiquido(float $valorLiquido): static
    {
        $this->valorLiquido = $valorLiquido;

        return $this;
    }

    public function getFornecedor(): ?Fornecedor
    {
        return $this->fornecedor;
    }

    public function setFornecedor(?Fornecedor $fornecedor): static
    {
        $this->fornecedor = $fornecedor;

        return $this;
    }

    public function getDeputado(): ?Deputado
    {
        return $this->deputado;
    }

    public function setDeputado(?Deputado $deputado): static
    {
        $this->deputado = $deputado;

        return $this;
    }
}
