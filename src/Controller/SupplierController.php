<?php

namespace App\Controller;

use App\Entity\Supplier;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $currentPage = $request->query->getInt('page', 1);


        $suppliersWithPaginate = $paginator->paginate(
            $suppliers,
            $currentPage,
            5
        );

        if (empty($suppliersWithPaginate) && $currentPage > 1) {
            $currentPage--;
        }
        return $this->render('supplier/index.html.twig', [
            'suppliers' => $suppliersWithPaginate,
            'currentPage' => $currentPage
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

    public function deleteSupplier(Request $request, PaginatorInterface $paginator): JsonResponse
    {

        if ($request->isMethod('DELETE')) {
            $supplierId = (int) $request->request->get('id');

            $supplierRepository = $this->entityManager->getRepository(Supplier::class);

            $supplier = $supplierRepository->find($supplierId);

            if (!$supplier) {
                return new Response("No s'ha trovat cap usuari", 404);
            }

            $this->entityManager->remove($supplier);
            $this->entityManager->flush();

            $suppliers = $this->getSuppliers();
            $currentPage = $request->query->getInt('page', 1);

            $suppliersWithPaginate = $paginator->paginate(
                $suppliers,
                $currentPage,
                5
            );


            if (empty($suppliersWithPaginate->getItems()) && $currentPage > 1) {
                $currentPage--;
            }

            return new JsonResponse(['message' => 'Proveïdor eliminat correctament', 'currentPage' => $currentPage], 200);
        }

        return new Response('Hi ha hagut algun problema', Response::HTTP_METHOD_NOT_ALLOWED,);
    }
}
