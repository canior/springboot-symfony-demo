# Snazzy CRM

Welcome to Snazzy CRM, the snazziest CRM for all your CRM needs!

## Installation

### Requirements
1. Docker installed
2. An active internet connection

Then run:
```
docker compose up
```
## Backend Test

The backend test can br written in java or php (**Note:** php is under construction and currently not available). The java application is built using Spring and the php 
application is built using Symfony. There is a test suite for each application that can be run for either 
using this single script:
```
./test.sh java # or php
```

Both applications are built to be worked on while running in their docker container. The java application
will even hot reload after a code change to help you move as quickly as possible. Of course, feel free to
work on this application in any way you prefer.

The java application can be found at http://localhost:8080 and the php application at http://localhost:9090. 
Each supports the following api endpoint:

`GET /account`

returns:
```json
[
  {
    "id": 1,
    "name": "Good Burger",
    "status": "NEW"
  },
  {
    "id": 2,
    "name": "Acme Corp",
    "status": "NEW"
  },
  {
    "id": 3,
    "name": "Wonka Candy Company",
    "status": "NEW"
  },
  {
    "id": 4,
    "name": "Great Glass Elevator Corp",
    "status": "NEW"
  }
]
```

### The Challenges

Your goal is to complete the following three challenges. Each one has an accompanying test that should pass 
when complete. At the end, **we also like to get your thoughts on how we could further iterate on this new 
functionality with a series of question we'd ask to fill out in** `./CANDIDATE_THOUGHTS.md`.

#### Challenge 1

The Account entity has a one-to-many relationship with the Contact entity. Add a relationship to these entities
so we now get the following:

`GET /account`

returns:
```json
[
  {
    "id": 1,
    "name": "Good Burger",
    "status": "NEW",
    "contacts": [
      {
        "id": 2,
        "firstName": "Salim",
        "lastName": "Traher",
        "phoneNumber": "456-103-4512",
        "primary": true
      },
      {
        "id": 3,
        "firstName": "Ewan",
        "lastName": "Maleck",
        "phoneNumber": "388-868-5602",
        "primary": false
      }
    ]
  },
  {
    "id": 2,
    "name": "Acme Corp",
    "status": "NEW",
    "contacts": [
      {
        "id": 7,
        "firstName": "Saccount_idoney",
        "lastName": "Marconi",
        "phoneNumber": "137-718-5089",
        "primary": true
      },
      {
        "id": 8,
        "firstName": "Hedda",
        "lastName": "Frie",
        "phoneNumber": "181-482-8234",
        "primary": false
      }
    ]
  },
  {
    "id": 3,
    "name": "Wonka Candy Company",
    "status": "NEW",
    "contacts": [
      {
        "id": 12,
        "firstName": "Freddi",
        "lastName": "Weippert",
        "phoneNumber": "588-683-6350",
        "primary": true
      },
      {
        "id": 13,
        "firstName": "Burr",
        "lastName": "Margrett",
        "phoneNumber": "993-823-2355",
        "primary": false
      }
    ]
  },
  {
    "id": 4,
    "name": "Great Glass Elevator Corp",
    "status": "NEW",
    "contacts": []
  }
]
```

#### Challenge 2:

We would like to allow the user to search accounts and return results that match a contact's phone number.
Alter the method `search()` in the account repository, so we now get the following:

`GET /search?query=456-103-4512`

returns:
```json
[
  {
    "id": 1,
    "name": "Good Burger",
    "status": "NEW",
    "contacts": [
      {
        "id": 2,
        "firstName": "Salim",
        "lastName": "Traher",
        "phoneNumber": "456-103-4512",
        "primary": true
      },
      {
        "id": 3,
        "firstName": "Ewan",
        "lastName": "Maleck",
        "phoneNumber": "388-868-5602",
        "primary": false
      }
    ]
  }
]
```

#### Challenge 3:

We would now like to make accounts filterable for ones that are not assigned contacts. Please ensure the
following now works:

`GET /search?unassigned=true`

returns:
```json
[
  {
    "id": 4,
    "name": "Great Glass Elevator Corp",
    "status": "NEW",
    "contacts": []
  }
]
```

`GET /search?unassigned=true&query=456-103-4512`

returns:
```json
[]
```

### Submitting your code

When you are done, please commit your changes, modify the `.zip` file to include your name or initials, and send back to 
your recruiter.
