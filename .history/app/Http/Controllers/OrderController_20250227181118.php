use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Exception;

public function order_store(Request $request)
{
    try {
        // Validate request data
        $validated = $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name'  => 'required|string|max:255',
            'billing_email'      => 'required|email',
            'billing_mobile'     => 'required|numeric',
            'billing_address'    => 'required|string',
            'billing_city'       => 'required|string',
            'billing_state'      => 'required|string',
            'billing_zip'        => 'required|numeric',
        ]);

        $userId = Auth::id();

        // Fetch cart items
        $cartItems = Cart::where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate total amount
        $subTotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingCharge = 50;
        $totalAmount = $subTotal + $shippingCharge;

        // Begin transaction
        DB::beginTransaction();

        // Create order with status 'pending'
        $order = Order::create([
            'user_id'         => $userId,
            'sub_total'       => $subTotal,
            'payment_method'  => 'razorpay',
            'shipping_charge' => $shippingCharge,
            'total'           => $totalAmount,
            'status'          => 'pending', // Mark as pending until payment is successful
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        // Store order items
        $orderItems = $cartItems->map(fn($cartItem) => [
            'order_id'      => $order->id,
            'product_id'    => $cartItem->product_id,
            'qty'           => $cartItem->quantity,
            'selling_price' => $cartItem->price,
            'created_at'    => now(),
            'updated_at'    => now(),
        ])->toArray();

        OrderDetail::insert($orderItems);

        // Store order address
        OrderAddress::create([
            'order_id'   => $order->id,
            'user_id'    => $userId,
            'name'       => "{$validated['billing_first_name']} {$validated['billing_last_name']}",
            'email'      => $validated['billing_email'],
            'mobile'     => $validated['billing_mobile'],
            'address'    => $validated['billing_address'],
            'city'       => $validated['billing_city'],
            'state'      => $validated['billing_state'],
            'pin_code'   => $validated['billing_zip'],
            'country'    => $request->input('billing_country', 'India'),
        ]);

        // Generate Razorpay Order ID
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $razorpayOrder = $api->order->create([
            'receipt'         => 'order_' . $order->id,
            'amount'          => $totalAmount * 100, // Convert to paise
            'currency'        => 'INR',
            'payment_capture' => 1, // Auto capture
        ]);

        // Save Razorpay Order ID in database
        $order->update(['razorpay_order_id' => $razorpayOrder['id']]);

        DB::commit();

        return response()->json([
            'success' => true,
            'order_id' => $razorpayOrder['id'],
            'amount' => $totalAmount,
        ]);
    } catch (Exception $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
