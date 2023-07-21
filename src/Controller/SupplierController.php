<?php

namespace App\Controller;

use App\Entity\Supplier;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/supplier", name="app_supplier")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $suppliers = $this->getSuppliers();
        $suppliersWithPaginate = $paginator->paginate(
            $suppliers,
            $request->query->getInt('page', 1),
            5
        );
        // dd($suppliersWithPaginate);
        return $this->render('supplier/index.html.twig', [
            'suppliers' => $suppliersWithPaginate,
        ]);
    }

    public function getSuppliers(): array
    {
        $supplierRepository = $this->entityManager->getRepository(Supplier::class);
        $query = $supplierRepository->getAllSuppliers();
        $suppliers = [];

        foreach ($query as $supplierData) {
            $supplier = new Supplier();

            $supplier->setId($supplierData->getId());
            $supplier->setName($supplierData->getName());
            $supplier->setEmail($supplierData->getEmail());
            $supplier->setPhoneNumber($supplierData->getPhoneNumber());
            $supplier->setSupplierType($supplierData->getSupplierType());
            $supplier->setIsActive($supplierData->getIsActive());
            $supplier->setCreatedAt($supplierData->getCreatedAt());

            $suppliers[] = $supplier;
        }

        return $suppliers;
    }

    public function createSupplier(Request $request): Response
    {
        // $entityManager->persist();
        // $entityManager->flush();
        return $this->render(''); //Canviar
    }

    public function updateSupplier(Request $request): Response
    {
        return $this->render('');
    }

    public function deleteSupplier(Request $request): Response
    {
        return $this->render('');
    }
}
