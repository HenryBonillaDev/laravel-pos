<?php

namespace Src\Order\Infrastructure\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Src\Customer\Application\UseCases\GetCustomerById;
use Src\Order\Application\UseCases\CreateOrder;
use Src\Order\Application\UseCases\DeleteOrder;
use Src\Order\Application\UseCases\GetOrderById;
use Src\Order\Application\UseCases\ListOrders;
use Src\Order\Application\UseCases\UpdateOrders;

class OrderController extends Controller
{
    private CreateOrder $createOrder;
    private UpdateOrders $updateOrder;
    private DeleteOrder $deleteOrder;
    private GetOrderById $findOrderById;
    private ListOrders $listOrders;

    private GetCustomerById $getCustomerById ;

    public function __construct(
        CreateOrder  $createOrder,
        UpdateOrders $updateOrder,
        DeleteOrder  $deleteOrder,
        GetOrderById $findOrderById,
        ListOrders   $listOrders
    )
    {
        $this->createOrder = $createOrder;
        $this->updateOrder = $updateOrder;
        $this->deleteOrder = $deleteOrder;
        $this->findOrderById = $findOrderById;
        $this->listOrders = $listOrders;
    }

    public function index(): Response
    {
        $orders = $this->listOrders->execute();

        return Inertia::render('Orders/Index', [
            'orders' => $orders
        ]);
    }

    public function createPage(): Response
    {
        $newOrder = [

        ];
        $this->createOrder->execute();
        return Inertia::render('Orders/Create');
    }

    public function create(Request $request): JsonResponse
    {
        $orderData = $request->all();
        $order = $this->createOrder->execute($orderData);

        return response()->json($order, 201);
    }

    public function update(string $id, Request $request): JsonResponse
    {
        $orderData = $request->all();
        $order = $this->updateOrder->execute($id, $orderData);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function delete(string $id): JsonResponse
    {
        $this->deleteOrder->execute($id);

        return response()->json(['message' => 'Order deleted'], 204);
    }

    public function findById(string $id): JsonResponse
    {
        $order = $this->findOrderById->execute($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }
}
