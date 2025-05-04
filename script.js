// Store cart items and their quantities in memory
let cart = {};
let quantities = {}; // Keeps track of selected quantities before adding to cart

// Increase quantity when "+" is clicked
function increaseQty(item) {
    if (!quantities[item]) {
        quantities[item] = 0;
    }
    quantities[item]++; // Increase quantity
    updateQtyDisplay(item); // Update the number shown
}

// Decrease quantity when "-" is clicked
function decreaseQty(item) {
    if (quantities[item] > 0) {
        quantities[item]--; // Decrease quantity
        updateQtyDisplay(item);
    }
}

// Function to update the quantity display on the foods page
function updateQtyDisplay(item) {
    document.getElementById(`${item}-qty`).textContent = quantities[item];
}

// Add selected quantity of item to cart
function addToCart(item, price) {
    if (!quantities[item] || quantities[item] === 0) {
        alert("Please select a quantity before adding to cart.");
        return;
    }

    if (!cart[item]) {
        cart[item] = { name: item, price: price, qty: 0 };
    }

    cart[item].qty += quantities[item]; // Add selected quantity
    quantities[item] = 0; // Reset selection
    updateQtyDisplay(item); // Reset UI quantity

    updateCart(); // Update cart display
}

// Update the shopping cart display
function updateCart() {
    let cartItems = document.getElementById("cart-items");
    let totalElement = document.getElementById("total-price");

    if (!cartItems || !totalElement) return; // Prevents errors if cart elements are missing

    cartItems.innerHTML = ""; // Clear cart display
    let total = 0;

    // Loop through cart and display each item
    for (let item in cart) {
        if (cart[item].qty > 0) {
            let li = document.createElement("li");
            li.textContent = `${cart[item].name} x${cart[item].qty} - Rs.${cart[item].price * cart[item].qty}`;

            // Remove button for each cart item
            let removeBtn = document.createElement("button");
            removeBtn.textContent = "Remove";
            removeBtn.onclick = function () {
                removeFromCart(item);
            };

            li.appendChild(removeBtn);
            cartItems.appendChild(li);

            total += cart[item].price * cart[item].qty;
        }
    }

    totalElement.textContent = total; // Update total price
}

// Remove an item from the cart
function removeFromCart(item) {
    delete cart[item]; // Remove from cart
    updateCart();
}

// Checkout function
function checkout() {
    if (Object.keys(cart).length === 0) {
        alert("Your cart is empty!");
    } else {
        alert("Order placed successfully!");
        cart = {}; // Clear cart after checkout
        updateCart();
    }
}

// Load cart when the page loads
window.onload = updateCart;
