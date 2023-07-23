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
     * @Route("/home", name="app_supplier")
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



    /**
     * @Route("/update", name="update_supplier_view")
     * @return Response
     */
    public function updateSupplierView(Request $request): Response
    {
        $id = $request->query->get('id');
        $currentPage = $request->query->get('page');
        $supplierRepository = $this->entityManager->getRepository(Supplier::class);

        $supplier = $supplierRepository->find($id);

        return $this->render('supplier/update_supplier.html.twig', ['supplier' => $supplier, 'page' => $currentPage]);
    }

    /**
     * @Route("/create", name="create_supplier_view")
     * @return Response
     */
    public function createSupplierView(Request $request): Response
    {
        $page = $request->query->get('page');

        return $this->render('supplier/create_supplier.html.twig', ['page' => $page]);
    }

    /**
     * @Route("/create/supplier", name="create_supplier", methods={"POST"})
     * @return Response
     */
    public function createSupplier(Request $request): Response
    {
        if ($request->isMethod('POST')) {

            $supplier = new Supplier();

            $supplier->setName($request->request->get('name'));
            $supplier->setEmail($request->request->get('email'));
            $supplier->setPhoneNumber($request->request->get('phoneNumber'));
            $supplier->setSupplierType($request->request->get('supplierType'));
            $supplier->setIsActive(filter_var($request->request->get('isActive'), FILTER_VALIDATE_BOOLEAN));
            $supplier->setCreatedAt(new \DateTime());

            try {
                $this->entityManager->persist($supplier);
                $this->entityManager->flush();
                return new JsonResponse(['message' => 'S\'ha creat correctament el proveïdor'], Response::HTTP_CREATED);
            } catch (\Exception $e) {
                return new JsonResponse(['message' => 'Hi ha hagut un error creant el proveïdor ', 'error_message' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return new Response('Hi ha hagut algun problema', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    /**
     * @Route("/update/supplier", name="update_supplier", methods={"PUT"})
     * @return Response
     */
    public function updateSupplier(Request $request): JsonResponse
    {


        if ($request->isMethod('PUT')) {
            $supplierId = (int) $request->request->get('id');
            $supplierRepository = $this->entityManager->getRepository(Supplier::class);
            $supplier = $supplierRepository->find($supplierId);

            if (!$supplier) {
                return new Response("No s'ha trovat cap usuari", Response::HTTP_NOT_FOUND);
            }

            $supplier->setName($request->request->get('name'));
            $supplier->setEmail($request->request->get('email'));
            $supplier->setPhoneNumber($request->request->get('phoneNumber'));
            $supplier->setSupplierType($request->request->get('supplierType'));
            $supplier->setIsActive(filter_var($request->request->get('isActive'), FILTER_VALIDATE_BOOLEAN));
            $supplier->setUpdatedAt(new \DateTime());

            try {
                $this->entityManager->flush();
                return new JsonResponse(['message' => 'S\'ha actualitzat correctament el proveïdor'], Response::HTTP_CREATED);
            } catch (\Exception $e) {
                return new JsonResponse(['error' => 'Hi ha hagut un error editant el proveïdor ', 'error_message' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return new Response('Hi ha hagut algun problema', Response::HTTP_METHOD_NOT_ALLOWED);
    }

    public function deleteSupplier(Request $request, PaginatorInterface $paginator): JsonResponse
    {

        if ($request->isMethod('DELETE')) {
            $supplierId = (int) $request->request->get('id');

            $supplierRepository = $this->entityManager->getRepository(Supplier::class);

            $supplier = $supplierRepository->find($supplierId);

            if (!$supplier) {
                return new Response("No s'ha trovat cap usuari", Response::HTTP_NOT_FOUND);
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

        return new Response('Hi ha hagut algun problema', Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
