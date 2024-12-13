
    <div class="notification" id="cartNotification15" style="display: none;">
    Item added to cart. <span class="cart-link" onclick="viewCart()">View Cart</span>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const addToCartButtons = document.querySelectorAll(".add-to-cart15");
        const notification = document.getElementById("cartNotification15");

        addToCartButtons.forEach(button => {
            button.addEventListener("click", (event) => {
                const container = event.target.closest('.explore-part-container');
                const itemName = container.querySelector('.non-veg-heading').childNodes[0].nodeValue.trim();
                const itemPrice = parseInt(container.querySelector('.para-north[style*="color:green;"]').innerText.replace('Rs ', '').trim(), 10);

                const item = {
                    name: itemName,
                    price: itemPrice,
                    quantity: 1
                };
                addToCart(item);
                showNotification();
            });
        });

        function showNotification() {
            notification.style.display = "block";
            setTimeout(() => {
                notification.style.display = "none";
            }, 3000);
        }

        function addToCart(item) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            const existingItem = cart.find(cartItem => cartItem.name === item.name);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push(item);
            }

            localStorage.setItem("cart", JSON.stringify(cart));
        }

        function viewCart() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            if (cart.length === 0) {
                alert("Your cart is empty.");
                return;
            }

            const cartWindow = window.open("", "Cart", "width=500,height=500");
            renderCart(cartWindow, cart);
        }

        function renderCart(cartWindow, cart) {
            if (cart.length === 0) {
                cartWindow.document.body.innerHTML = '<h1>Your Cart is Empty</h1><button onclick="window.close()">Close</button>';
                return;
            }

            let cartDetails = cart.map((item, index) => `
                ${index + 1}. ${item.name} - Rs ${item.price} x ${item.quantity} = Rs ${item.price * item.quantity}
                <button onclick="opener.updateItemQuantity(${index}, -1)">-</button>
                ${item.quantity}
                <button onclick="opener.updateItemQuantity(${index}, 1)">+</button>
                <button onclick="opener.removeItemFromCart(${index})">Remove</button>
            `).join("<br>");

            cartWindow.document.body.innerHTML = `
                <h1>Your Cart</h1>
                ${cartDetails}<br><br>
                <button onclick="window.close()">Close</button>
            `;
        }

        window.updateItemQuantity = function (index, change) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            if (cart[index]) {
                cart[index].quantity += change;
                if (cart[index].quantity <= 0) {
                    cart.splice(index, 1);
                }
                localStorage.setItem("cart", JSON.stringify(cart));

                let cartWindow = window.open("", "Cart", "width=500,height=500");
                renderCart(cartWindow, cart);
            }
        };

        window.removeItemFromCart = function (index) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));

            let cartWindow = window.open("", "Cart", "width=500,height=500");
            renderCart(cartWindow, cart);
        };

        window.viewCart = viewCart;
    });
</script>
