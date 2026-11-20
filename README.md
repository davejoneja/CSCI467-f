Built with PHP, love, and lots of sky blue


## Features

### Customer storefront

- Browse a responsive catalog of automotive parts.
- Search products by name or part number.
- Select quantities with live inventory limits.
- Add products to a browser-persisted shopping cart.
- Calculate totals, tax, weight-based shipping, and discounts.
- Enter shipping, billing, and payment information through the checkout flow.
- Receive an order confirmation after successful authorization.

### Admin dashboard

- Review active customer orders and their line items.
- Filter orders by status.
- Complete and remove processed orders.
- View, add, update, and delete shipping weight brackets.

### Warehouse dashboard

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

To keep the archived project usable beyond the original class environment, the
database layer was updated to preserve the two legacy PDO handles while providing
a compatible SQLite fallback. The fallback builds its schema and demo records on
first launch, which keeps setup lightweight without rewriting the surrounding PHP
pages.

##  What we learned

- How customer, administrative, and fulfillment workflows share one data model.
- How to carry browser-side cart state into a server-side order safely.
- How weight brackets and live inventory affect checkout calculations.
- How PDO prepared statements keep PHP database code portable.
- How external course services can become deployment dependencies.
- How a local compatibility layer can keep an older application runnable without
  erasing its original architecture.


