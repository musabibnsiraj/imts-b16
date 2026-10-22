<?php

/*
 * Real-world example: an online shopping order.
 *
 * public    - actions available to the customer.
 * private   - sensitive order data controlled by the Order class.
 * protected - reusable rules available to Order and child order classes.
 */
class Order
{
    public $customerName;

    private $items = array();
    private $paymentToken;
    private $status = "Pending";

    protected $orderNumber;

    /**
     * Creates an order and stores its initial customer and payment details.
     * This public method is called automatically when a new order is created.
     */
    public function __construct($orderNumber, $customerName, $paymentToken)
    {
        $this->orderNumber = $orderNumber;
        $this->customerName = $customerName;
        $this->paymentToken = $paymentToken;
    }

    /**
     * Adds a product to the order after checking its price and quantity.
     * Public because customers need to add products to their shopping order.
     */
    public function addItem($productName, $price, $quantity = 1)
    {
        if ($price <= 0 || $quantity <= 0) {
            echo "Product price and quantity must be greater than zero.<br>";
            return;
        }

        $this->items[] = array(
            "name" => $productName,
            "price" => $price,
            "quantity" => $quantity
        );
    }

    /**
     * Changes the order status from Pending to Placed.
     * An order cannot be placed until it contains at least one product.
     */
    public function placeOrder()
    {
        if (count($this->items) === 0) {
            echo "Order cannot be placed without products.<br>";
            return;
        }

        $this->status = "Placed";
        echo "Order {$this->getMaskedOrderNumber()} placed successfully.<br>";
    }

    /**
     * Cancels an order that has already been placed.
     * Public because the customer may request cancellation.
     */
    public function cancelOrder()
    {
        if ($this->status !== "Placed") {
            echo "Only a placed order can be cancelled.<br>";
            return;
        }

        $this->status = "Cancelled";
        echo "Order cancelled successfully.<br>";
    }

    /**
     * Displays the customer's order information without exposing private data.
     * The payment token is intentionally never displayed.
     */
    public function showSummary()
    {
        echo "Customer: {$this->customerName}<br>";
        echo "Order number: {$this->getMaskedOrderNumber()}<br>";
        echo "Status: {$this->status}<br>";
        echo "Total: " . $this->calculateTotal() . "<br>";
    }

    /**
     * Calculates the final order total after applying the discount.
     * Private because only the Order class should control price calculations.
     */
    private function calculateTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item["price"] * $item["quantity"];
        }

        return $total - $this->calculateDiscount($total);
    }

    /**
     * Hides most of the order number before it is shown to the customer.
     * Private because masking is an internal security operation.
     */
    private function getMaskedOrderNumber()
    {
        return "****" . substr($this->orderNumber, -4);
    }

    /**
     * Returns the discount for a regular order.
     * Protected allows child order classes to provide their own discount rule.
     */
    protected function calculateDiscount($total)
    {
        return 0;
    }
}

class PremiumOrder extends Order
{
    /**
     * Calculates a 10 percent discount for premium customers.
     * This protected override is used internally by calculateTotal().
     */
    protected function calculateDiscount($total)
    {
        return $total * 10 / 100;
    }
}

$order = new PremiumOrder("ORD-2026-1001", "Aisha Khan", "payment-token-123");

// Public methods are the safe interface used by the shopping application.
$order->addItem("Laptop", 80000);
$order->addItem("Wireless Mouse", 1500, 2);
$order->addItem("Benz", 1000);

$order->placeOrder();
$order->showSummary();

// These properties and methods cannot be accessed directly from outside:
// $order->items[] = array("name" => "Free item"); // Private
// $order->paymentToken = "new-token";             // Private
// $order->status = "Delivered";                   // Private
// $order->calculateTotal();                       // Private
// $order->orderNumber = "ORD-9999";               // Protected
// $order->calculateDiscount(1000);                // Protected
