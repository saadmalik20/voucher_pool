define({ "api": [
  {
    "type": "post",
    "url": "/recipient",
    "title": "Recipient",
    "version": "1.0.0",
    "name": "Recipient",
    "group": "Vouchers",
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
            "field": "name",
            "description": "<p>required.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>required.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"name\" : \"Saad Malik\",\n \"email\" : \"saad@test.com\",\n}",
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
          "content": "  HTTP/1.1 200 OK\n[\n  \"Recipient created succesfully\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "src/Controllers/RecipientController.php",
    "groupTitle": "Vouchers"
  },
  {
    "type": "get",
    "url": "/voucher",
    "title": "VoucherRedeem",
    "version": "1.0.0",
    "name": "Recipient",
    "group": "Vouchers",
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
            "field": "code",
            "description": "<p>required.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>required.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"code\" : \"a5F128Vu\",\n \"email\" : \"saad@test.com\",\n}",
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
          "content": "  HTTP/1.1 200 OK\n[\n  \"percentage\" : \"10\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "src/Controllers/VouchersController.php",
    "groupTitle": "Vouchers"
  },
  {
    "type": "get",
    "url": "/vouchers/byemail",
    "title": "VoucherByEmail",
    "version": "1.0.0",
    "name": "VoucherByEmail",
    "group": "Vouchers",
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
            "field": "email",
            "description": "<p>required.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"email\" : \"saad@test.com\",\n}",
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
          "content": "    HTTP/1.1 200 OK\n  [\n\t\t{\n    \t\t\"voucher\" : \"a5F128Vu\",\n\t   \t\t\"discount\" : \"10%\"\n  \t},\n\t\t{\n    \t\t\"voucher\" : \"h11C76kn\",\n\t   \t\t\"discount\" : \"20%\"\n  \t}\n\t ]",
          "type": "json"
        }
      ]
    },
    "filename": "src/Controllers/VouchersController.php",
    "groupTitle": "Vouchers"
  },
  {
    "type": "get",
    "url": "/vouchers/generate",
    "title": "VoucherGenerate",
    "version": "1.0.0",
    "name": "VoucherGenerate",
    "group": "Vouchers",
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
            "type": "number",
            "optional": false,
            "field": "discount",
            "description": "<p>required.</p>"
          },
          {
            "group": "Parameter",
            "type": "date",
            "optional": false,
            "field": "expire_at",
            "description": "<p>required.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"discount\" : 10,\n \"expire_at\" : \"2018-10-10\",\n}",
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
          "content": "  HTTP/1.1 200 OK\n[\n  \"Vouchers generated succesfully\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "src/Controllers/VouchersController.php",
    "groupTitle": "Vouchers"
  }
] });
