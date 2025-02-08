<h1 align="center">🚀 <span style="color:#ff5733;">E-Commerce Application</span> 🛒</h1>

<p align="center">
  <b>An advanced <span style="color:#4CAF50;">E-Commerce Platform</span> built with CodeIgniter 4</b> <br>
  <i>Featuring product management, authentication, shopping cart, and secure payment gateways.</i>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/CodeIgniter-4-red?style=for-the-badge" alt="CodeIgniter">
  <img src="https://img.shields.io/badge/Payments-Paytm%20%7C%20Razorpay-blue?style=for-the-badge" alt="Payments">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License">
</p>

---

<h2>🚀 Features</h2>

<ul>
  <li>✅ <b>Product Management</b> – Add, edit, delete products with images & descriptions</li>
  <li>🔐 <b>User Authentication</b> – Secure login & registration</li>
  <li>🛍 <b>Shopping Cart</b> – Add/remove products, update quantities</li>
  <li>📦 <b>Order Management</b> – Track user orders & manage statuses</li>
  <li>💳 <b>Payment Gateways</b> – Integrated <b>Paytm & Razorpay Sandbox</b> for testing</li>
</ul>

---

<h2>📥 Installation</h2>

<h3>1️⃣ Clone the Repository</h3>

```
git clone https://github.com/tejassinghrajput/e-commerce.git
cd e-commerce  
```
<h3>2️⃣ Install Dependencies</h3>
<p>Ensure <b>Composer</b> is installed, then run:</p>composer install

<h3>3️⃣ Configure Environment</h3>
<ul>
  <li>Copy <code>.env.example</code> to <code>.env</code></li>
  <li>Update database details:</li>
</ul>database.default.hostname = localhost
database.default.database = e_commerce
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi

<ul>
  <li>Set <b>Paytm & Razorpay</b> API credentials in <code>.env</code>:</li>
</ul>PAYTM_MERCHANT_KEY=your_paytm_key
PAYTM_MERCHANT_ID=your_paytm_id
PAYTM_WEBSITE=WEBSTAGING

RAZORPAY_KEY_ID=your_razorpay_key
RAZORPAY_SECRET=your_razorpay_secret

<h3>4️⃣ Run Database Migrations</h3>php spark migrate

<h3>5️⃣ Start the Application</h3>php spark serve

<p><b>Visit:</b> <a href="http://localhost:8080" target="_blank" style="color:#ff5733;">http://localhost:8080</a></p>
---

<h2>💳 Payment Gateway Setup</h2><h3>🔹 <span style="color:#ff5733;">Paytm Sandbox</span></h3>
<ol>
  <li>Register on <a href="https://developer.paytm.com/" target="_blank" style="color:#4CAF50;">Paytm Developer</a></li>
  <li>Get <b>Merchant Key & ID</b> from Dashboard</li>
  <li>Enable <code>WEBSTAGING</code> mode in <code>.env</code></li>
</ol><h3>🔹 <span style="color:#007bff;">Razorpay Sandbox</span></h3>
<ol>
  <li>Sign up on <a href="https://razorpay.com/" target="_blank" style="color:#4CAF50;">Razorpay</a></li>
  <li>Generate <b>API Key & Secret</b></li>
  <li>Use test card details from <a href="https://razorpay.com/docs/" target="_blank" style="color:#4CAF50;">Razorpay Docs</a></li>
</ol>
---

<h2>📌 Usage</h2><ul>
  <li>🎛 <b>Admin Panel</b>: Manage products, orders, and users</li>
  <li>🛒 <b>User Interface</b>: Browse, add to cart, and checkout</li>
  <li>💰 <b>Payment Processing</b>: Simulate transactions using sandbox mode</li>
</ul>
---

<h2>🤝 Contributing</h2>
<p>🚀 Feel free to fork and submit a PR for enhancements!</p>
---

<h2>📜 License</h2>
<p>📖 This project is licensed under the <b>MIT License</b>. See <a href="LICENSE" style="color:#ff5733;">LICENSE</a>.</p>
---

<h2 align="center">🔥 <span style="color:#ff5733;">E-Commerce with Secure Payments</span> 🚀</h2>


Improvements:

✅ Colored text & icons for a premium look
✅ Stylish shields (badges) for better branding
✅ Clickable links with hover effects
✅ Clear separation of sections with colors
