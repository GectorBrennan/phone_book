define({ "api": [
  {
    "type": "DELETE",
    "url": "/contact.delete",
    "title": "",
    "group": "Contact",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": ""
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "api/contact.delete"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/ContactController.php",
    "groupTitle": "Contact",
    "name": "DeleteContactDelete"
  },
  {
    "type": "GET",
    "url": "/contact.getByName",
    "title": "",
    "group": "Contact",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "..100",
            "optional": true,
            "field": "per_page",
            "defaultValue": "25",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "page",
            "defaultValue": "1",
            "description": ""
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "api/contact.getByName"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/ContactController.php",
    "groupTitle": "Contact",
    "name": "GetContactGetbyname"
  },
  {
    "type": "GET",
    "url": "/contact.getList",
    "title": "",
    "group": "Contact",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "..100",
            "optional": true,
            "field": "per_page",
            "defaultValue": "25",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "page",
            "defaultValue": "1",
            "description": ""
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "api/contact.getList"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/ContactController.php",
    "groupTitle": "Contact",
    "name": "GetContactGetlist"
  },
  {
    "type": "Post",
    "url": "/contact.create",
    "title": "",
    "group": "Contact",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": ""
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "api/contact.create"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/ContactController.php",
    "groupTitle": "Contact",
    "name": "PostContactCreate"
  },
  {
    "type": "PUT",
    "url": "/contact.edit",
    "title": "",
    "group": "Contact",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": ""
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "api/contact.edit"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/ContactController.php",
    "groupTitle": "Contact",
    "name": "PutContactEdit"
  }
] });
