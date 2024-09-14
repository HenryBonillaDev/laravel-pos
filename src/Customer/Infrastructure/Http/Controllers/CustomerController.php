<?php

namespace Src\Customer\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Src\Customer\Application\UseCases\CreateCustomer;
use Src\Customer\Application\UseCases\DeleteCustomer;
use Src\Customer\Application\UseCases\GetCustomerById;
use Src\Customer\Application\UseCases\ListCustomers;
use Src\Customer\Application\UseCases\UpdateCustomer;

class CustomerController extends Controller
{
    private CreateCustomer $createCustomer;
    private UpdateCustomer $updateCustomer;
    private DeleteCustomer $deleteCustomer;
    private GetCustomerById $getCustomerById;
    private ListCustomers $listCustomers;

    public function __construct(
        CreateCustomer  $createCustomer,
        UpdateCustomer  $updateCustomer,
        DeleteCustomer  $deleteCustomer,
        GetCustomerById $getCustomerById,
        ListCustomers   $listCustomers
    )
    {
        $this->createCustomer = $createCustomer;
        $this->updateCustomer = $updateCustomer;
        $this->deleteCustomer = $deleteCustomer;
        $this->getCustomerById = $getCustomerById;
        $this->listCustomers = $listCustomers;
    }

    public function index(): Response
    {
        $customers = $this->listCustomers->execute();
        return Inertia::render('Customers/Index', [
            'customers' => $customers
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'doc_type' => 'required|string|max:255',
            'dni' => 'required|string|unique:customers,dni|max:255',
            'email' => 'required|email|unique:customers,email|max:255'
        ]);

        $customer = $this->createCustomer->execute($validatedData);
        return response()->json($customer, 201);
    }

    public function show($id): JsonResponse
    {
        $customer = $this->getCustomerById->execute($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'doc_type' => 'required|string|max:255',
            'dni' => 'required|string|unique:customers,dni,' . $id . '|max:255', // DNI único, excepto para el cliente actual
            'email' => 'required|email|unique:customers,email,' . $id . '|max:255' // Email único, excepto para el cliente actual
        ]);

        $customer = $this->updateCustomer->execute($id, $validatedData);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->deleteCustomer->execute($id);
        if (!$deleted) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
