<img width="1919" height="944" alt="image" src="https://github.com/user-attachments/assets/638056e3-8cff-431b-aa70-aa31c72230d8" />
Built with PHP, love, and lots of sky blue

## Features

### Customer storefront

<img width="1919" height="926" alt="image" src="https://github.com/user-attachments/assets/05be8717-3514-4152-ae08-b65c3c8718fa" />

- Browse a responsive catalog of automotive parts.
- Search products by name or part number.
- Select quantities with live inventory limits.
- Add products to a browser-persisted shopping cart.
- Calculate totals, tax, weight-based shipping, and discounts.
- Enter shipping, billing, and payment information through the checkout flow.
- Receive an order confirmation after successful authorization.

### Admin dashboard

<img width="1919" height="943" alt="image" src="https://github.com/user-attachments/assets/c86eeb40-6533-450c-87d2-decbbcf1c5c8" />

- Review active customer orders and their line items.
- Filter orders by status.
- Complete and remove processed orders.
- View, add, update, and delete shipping weight brackets.

### Warehouse dashboard

<img width="1919" height="942" alt="image" src="https://github.com/user-attachments/assets/136d7ecb-eb6f-41ea-b637-3bd8af9d6512" />

- Receive incoming stock and update product quantities.
- Review orders waiting for fulfillment.
- Inspect customer and item details.
- Mark fulfilled orders as shipped.

### Demo accounts

| Area | Username | Password |
| --- | --- | --- |
| Admin | `admin` | `password` |
| Warehouse | `warehouse` | `password` |

##  The build

The project was divided around the same handoff a real order follows. The
customer-facing side owns product discovery, cart state, shipping, and checkout.
The admin side manages open orders and configurable weight brackets. The
warehouse side owns stock receiving and fulfillment. Those areas meet in the
shared order and inventory tables.

##  What we learned

- How customer, administrative, and fulfillment workflows share one data model.
- How to carry browser-side cart state into a server-side order safely.
- How weight brackets and live inventory affect checkout calculations.
- How PDO prepared statements keep PHP database code portable.
- How external course services can become deployment dependencies.
- How a local compatibility layer can keep an older application runnable without
  erasing its original architecture.


