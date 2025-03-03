<div style="font-family: Arial, sans-serif; color: #333;">
    <h2>Welcome to Our Platform!</h2>
    
    <p>We are thrilled to have you join us! Your account has been successfully created, and we are excited for you to explore our platform.</p>
    
    <p><strong>Your login details:</strong></p>
    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Name:</strong> {{ $user->name }}</li>
    </ul>

    <p>Please use the link below to log in for the first time. For security reasons, we strongly recommend changing your password after your first login.</p>
    <p><a href="{{ route('admin.index') }}" style="color: #007bff; text-decoration: none;">Login Here</a></p>

    <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>

    <p>Welcome aboard!</p>
    <p>Best Regards,<br/>Kittusweety Collection</p>
</div>
