<?php

namespace App\Service;

use App\DTO\ProduitDTO;
use App\Entity\Produit;
use App\Enum\InventoryStatus;
use App\Repository\ProduitRepository;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProduitService
{
    public function __construct(
        readonly private ProduitRepository  $produitRepository,
        readonly private ValidatorInterface $validator
    )
    {
    }

    /**
     * @param ProduitDTO $produitDTO
     * @return Produit
     */
    public function createProduit(ProduitDTO $produitDTO): Produit
    {
        $produit = new Produit();
        $produit->setCode($produitDTO->code);
        $produit->setName($produitDTO->name);
        $produit->setDescription($produitDTO->description);
        $produit->setImage($produitDTO->image);
        $produit->setCategory($produitDTO->category);
        $produit->setPrice($produitDTO->price);
        $produit->setQuantity($produitDTO->quantity);
        $produit->setInternalReference($produitDTO->internalReference);
        $produit->setShellId($produitDTO->shellId);
        $produit->setInventoryStatus(InventoryStatus::from($produitDTO->inventoryStatus));
        $produit->setRating($produitDTO->rating);

        if (\count($errors = $this->validator->validate($produit))) {
            throw new InvalidArgumentException($errors);
        }

        $this->produitRepository->save($produit);

        return $produit;
    }

    public function getAllProduits(): array
    {
        return $this->produitRepository->findAll();
    }


    public function updateProduit(Produit $produit, ProduitDTO $produitDTO): Produit
    {
        // Modification Produit
    }

    public function getProduit(int $id): ?ProduitDTO
    {
        $produit = $this->produitRepository->findOneBy(['id' => $id]);

        if (null === $produit) {
            return null;
        }

        // Création du ProduitDTO à partir de l'entité Produit
        $produitDTO = new ProduitDTO(
            $produit->getId(),
            $produit->getCode(),
            $produit->getName(),
            $produit->getDescription(),
            $produit->getImage(),
            $produit->getCategory(),
            $produit->getPrice(),
            $produit->getQuantity(),
            $produit->getInternalReference(),
            $produit->getShellId(),
            $produit->getInventoryStatus(),
            $produit->getRating(),
            $produit->getCreatedAt(),
            $produit->getUpdatedAt()
        );

        return $produitDTO;
    }

}
