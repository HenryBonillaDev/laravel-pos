<?php

namespace Src\Customer\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
            'customers' => $customers,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'doc_type' => 'required|string|max:255',
            'dni' => 'required|string|unique:customers,dni|max:255',
            'email' => 'required|email|unique:customers,email|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'dni.unique' => 'El DNI ya está registrado.'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $str = '';
            foreach ($errors as $messages) {
                foreach ($messages as $message) {
                    $str .= "{$message} \n";
                }
            }
            toast_warning($str);
            return to_route('customers.index');
        }
        $this->createCustomer->execute($request->all());
        toast_success('Cliente creado correctamente');

        return to_route('customers.index');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'doc_type' => 'required|string|max:255',
            'dni' => 'required|string|unique:customers,dni,' . $id . '|max:255',
            'email' => 'required|email|unique:customers,email,' . $id . '|max:255'
        ]);

        $customer = $this->updateCustomer->execute($id, $validatedData);

        if ($customer) {
            toast_success('Cliente actualizado correctamente');
        } else {
            toast_error('No se pudo actualizar el cliente');
        }

        return to_route('customers.index');
    }

    public function destroy($id): Application|Redirector|RedirectResponse
    {
        $deleted = $this->deleteCustomer->execute($id);
        if ($deleted) {
            toast_success('Cliente eliminado correctamente');
        } else {
            toast_error('Cliente no encontrado');
        }
        return to_route('customers.index');
    }
}
