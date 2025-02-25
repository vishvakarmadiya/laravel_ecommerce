$order = Order::create([
    'user_id' => auth()->id(),
    'billing_first_name' => $validated['billing_first_name'],
    'billing_last_name' => $validated['billing_last_name'],
    'billing_email' => $validated['billing_email'],
    'billing_mobile' => $validated['billing_mobile'],
    'billing_address' => $validated['billing_address'],
    'billing_city' => $validated['billing_city'],
    'billing_state' => $validated['billing_state'],
    'billing_zip' => $validated['billing_zip'],
    'payment_method' => $validated['payment_method'],
    'status' => 'pending',
    'sub_total' => collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['price']), // Calculate subtotal
]);
