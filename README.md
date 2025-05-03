# Customer and Order API

This project is a basic API built using Laravel with two models: **Customer** and **Order**. It provides endpoints to create, update, and view orders along with associated customer data. The API also includes basic validation, relationship handling, and additional features like statistics and filtering.

## Models

### Customer

-   `id` (Primary Key)
-   `name` (String)
-   `email` (String)
-   `timestamps` (Created at, Updated at)

### Order

-   `id` (Primary Key)
-   `customer_id` (Foreign Key to Customer)
-   `product_name` (String)
-   `quantity` (Integer)
-   `price` (Decimal)
-   `status` (Enum: `pending`, `shipped`)
-   `timestamps` (Created at, Updated at)

## Endpoints

### POST /orders

Create a new order.

**Request Body:**

```json
{
    "customer_id": 1,
    "product_name": "Product Name",
    "quantity": 1,
    "price": 100.0,
    "status": "pending"
}
```

**Response:**

```json
{
    "id": 1,
    "customer_id": 1,
    "product_name": "Product Name",
    "quantity": 1,
    "price": 100.0,
    "status": "pending",
    "created_at": "2025-05-03T10:00:00Z",
    "updated_at": "2025-05-03T10:00:00Z"
}
```

### GET /orders

List all orders.

**Response:**

```json
[
    {
        "id": 1,
        "customer_id": 1,
        "product_name": "Product Name",
        "quantity": 1,
        "price": 100.0,
        "status": "pending",
        "created_at": "2025-05-03T10:00:00Z",
        "updated_at": "2025-05-03T10:00:00Z",
        "customer": {
            "id": 1,
            "name": "Customer Name",
            "email": "customer@example.com",
            "created_at": "2025-05-03T10:00:00Z",
            "updated_at": "2025-05-03T10:00:00Z"
        }
    }
]
```

### PUT /orders/{id}

Update the order status.

**Request Body:**

```json
{
    "status": "shipped"
}
```

**Response:**

```json
{
    "id": 1,
    "customer_id": 1,
    "product_name": "Product Name",
    "quantity": 1,
    "price": 100.0,
    "status": "shipped",
    "created_at": "2025-05-03T10:00:00Z",
    "updated_at": "2025-05-03T10:05:00Z"
}
```

### GET /orders/stats

Return total revenue and number of orders per status.

**Response:**

```json
{
    "total_revenue": 100.0,
    "orders_per_status": {
        "pending": 1,
        "shipped": 0
    }
}
```

### GET /orders?status=shipped (Bonus)

Filter orders by status.

**Response:**

```json
[
    {
        "id": 4,
        "customer_id": 1,
        "product_name": "ps4",
        "quantity": 2,
        "price": 3000,
        "status": "shipped",
        "created_at": "2025-05-03T15:44:04.000000Z",
        "updated_at": "2025-05-03T15:44:04.000000Z",
        "customer": {
            "id": 1,
            "name": "Mahmoud",
            "email": "Mahmoud@example.com",
            "created_at": "2025-05-03T15:25:00.000000Z",
            "updated_at": "2025-05-03T15:25:00.000000Z"
        }
    }
]
```

## AI Development Tools Used

-   **GitHub Copilot:** Assisted with generating code for models, controllers, and routes.
-   **Laravel Docs:** Used to reference the Eloquent ORM and validation rules.
-   **Thunder Client:** Used to test API endpoints and ensure functionality.

## Scalability Considerations

### Message Queues

I’d use Laravel queues (with Redis, for example) to handle tasks that don’t need to happen immediately, like sending emails or calling an external API. This makes the app faster and more responsive.

### Caching

To reduce load on the database and speed things up, I’d use caching for repeated data — like user roles or settings — using Redis or the Laravel cache system.

### Authentication & Role-Based Authorization

I’d use Laravel Sanctum for API authentication. For authorization, I’d build a simple role-based system (like admin, editor, user) so only certain users can access certain parts of the app.

### Docker for Deployment

I’d use Docker to run the app in containers. This makes it easier to move and run the app consistently on different machines or servers.

### Load Balancing

To handle more traffic, I’d run multiple instances of the app and use a load balancer (like NGINX) to send traffic to the right place. This improves performance and reliability.
