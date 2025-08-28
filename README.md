# TODO API Documentation
# ======================
This is the documentation for the TODO API, which allows you to manage a list of tasks. The API provides endpoints to create, read, update, and delete TODO items.
## Base URL
The base URL for all API requests is:
```http://localhost:8000
```
Make sure to include this base URL in all your API requests.
## Endpoints
The API provides several endpoints to interact with. Each endpoint is documented in detail in the following sections, including the HTTP methods supported, required parameters, and example requests and responses.    
### TODO CRUD Endpoints
- `GET /todos/`: Retrieve a list of all TODO items.
- `POST /todos/`: Create a new TODO item.
- `GET /todos/{id}/`: Retrieve a specific TODO item by its ID.
- `PUT /todos/{id}/`: Update a specific TODO item by its ID.
- `DELETE /todos/{id}/`: Delete a specific TODO item by its ID.
## Authentication
This API is not authenticated.
