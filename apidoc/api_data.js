define({ "api": [
  {
    "type": "post",
    "url": "/api/withdraw",
    "title": "Cash Withdraw",
    "version": "1.0.0",
    "name": "CashWithdraw",
    "group": "Cash",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "amount",
            "description": "<p>required.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"amount\" : 250,\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "  HTTP/1.1 400 Bad Request\n[\"InvalidArgumentException\"]",
          "type": "json"
        },
        {
          "title": "Error-Response: ",
          "content": "  HTTP/1.1 404 Not Found\n[\"NoteUnavailableException\"]",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "  HTTP/1.1 200 OK\n[\n  \"100.00\",\n  \"100.00\",\n  \"50.00\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/WithdrawController.php",
    "groupTitle": "Cash"
  }
] });
