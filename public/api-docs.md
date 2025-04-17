# Dokumentasi API JSON-RPC To-Do List

## Endpoint
```
GET/POST/PUT/PATCH/DELETE /api/jsonrpc
```

## Format Request
Semua request harus mengikuti format JSON-RPC 2.0:

### Untuk POST, PUT, PATCH, DELETE:
```json
{
    "jsonrpc": "2.0",
    "method": "nama_method",
    "params": {
        // parameter sesuai method
    },
    "id": "request_id"
}
```

### Untuk GET:
Parameter dapat dikirim sebagai query string:
```
/api/jsonrpc?jsonrpc=2.0&method=nama_method&params={"param1":"value1"}&id=1
```

## Panduan Testing di Postman

### 1. GET Request
1. Buat request baru
2. Method: GET
3. URL: `http://localhost:8000/api/jsonrpc`
4. Di tab "Params", tambahkan:
   ```
   jsonrpc: 2.0
   method: getTask
   params: {"id":1}
   id: 1
   ```

### 2. POST/PUT/PATCH/DELETE Request
1. Buat request baru
2. Method: POST/PUT/PATCH/DELETE
3. URL: `http://localhost:8000/api/jsonrpc`
4. Headers:
   ```
   Content-Type: application/json
   ```
5. Body: raw (JSON)
   ```json
   {
       "jsonrpc": "2.0",
       "method": "createTask",
       "params": {
           "title": "Tugas Baru",
           "description": "Deskripsi tugas",
           "status": "Belum Dikerjakan"
       },
       "id": 1
   }
   ```

## Method yang Tersedia

### 1. getTasks (GET)
Mendapatkan semua tugas

Request:
```json
{
    "jsonrpc": "2.0",
    "method": "getTasks",
    "params": {},
    "id": 1
}
```

### 2. getTask (GET)
Mendapatkan detail tugas berdasarkan ID

Request:
```
GET /api/jsonrpc?jsonrpc=2.0&method=getTask&params={"id":1}&id=1
```

### 3. createTask (POST)
Membuat tugas baru

Request:
```json
{
    "jsonrpc": "2.0",
    "method": "createTask",
    "params": {
        "title": "Judul Tugas",
        "description": "Deskripsi Tugas",
        "status": "Belum Dikerjakan"
    },
    "id": 1
}
```

### 4. updateTask (PUT)
Memperbarui tugas

Request:
```json
{
    "jsonrpc": "2.0",
    "method": "updateTask",
    "params": {
        "id": 1,
        "title": "Judul Tugas Baru",
        "description": "Deskripsi Tugas Baru",
        "status": "Selesai"
    },
    "id": 1
}
```

### 5. deleteTask (DELETE)
Menghapus tugas

Request:
```json
{
    "jsonrpc": "2.0",
    "method": "deleteTask",
    "params": {
        "id": 1
    },
    "id": 1
}
```

### 6. updateTaskStatus (PATCH)
Memperbarui status tugas

Request:
```json
{
    "jsonrpc": "2.0",
    "method": "updateTaskStatus",
    "params": {
        "id": 1,
        "status": "Selesai"
    },
    "id": 1
}
```

### 7. searchTasks (GET)
Mencari tugas berdasarkan kata kunci

Request:
```
GET /api/jsonrpc?jsonrpc=2.0&method=searchTasks&params={"query":"kata kunci"}&id=1
```

## Format Response

### Response Sukses
```json
{
    "jsonrpc": "2.0",
    "result": {
        // data hasil
    },
    "id": 1
}
```

### Response Error
```json
{
    "jsonrpc": "2.0",
    "error": {
        "code": -32000,
        "message": "Pesan error"
    },
    "id": 1
}
```

## Kode Error
- -32600: Invalid Request
- -32000: Server Error

## Contoh Penggunaan dengan cURL

1. GET request:
```bash
curl -X GET "http://localhost:8000/api/jsonrpc?jsonrpc=2.0&method=getTasks&params={}&id=1"
```

2. POST request:
```bash
curl -X POST http://localhost:8000/api/jsonrpc \
-H "Content-Type: application/json" \
-d '{
    "jsonrpc": "2.0",
    "method": "createTask",
    "params": {
        "title": "Tugas Baru",
        "description": "Deskripsi tugas",
        "status": "Belum Dikerjakan"
    },
    "id": 1
}'
```

3. PUT request:
```bash
curl -X PUT http://localhost:8000/api/jsonrpc \
-H "Content-Type: application/json" \
-d '{
    "jsonrpc": "2.0",
    "method": "updateTask",
    "params": {
        "id": 1,
        "title": "Judul Baru"
    },
    "id": 1
}'
```

4. DELETE request:
```bash
curl -X DELETE http://localhost:8000/api/jsonrpc \
-H "Content-Type: application/json" \
-d '{
    "jsonrpc": "2.0",
    "method": "deleteTask",
    "params": {
        "id": 1
    },
    "id": 1
}'
``` 