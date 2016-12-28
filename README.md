# Vet System

A patients manager system.

## Developed with (languages)

### Back-end

- PHP.
- mysql or postgresql (tested).

### Front-end

- Javascript.
- HTML.
- CSS.

## Frameworks used in this project

- CakePHP 3 (Back-end).
- Angular 2 (Front-end).

## REST APIs

REST APIs follows CakePHP conventions for paths. See [CakePHP routing](http://book.cakephp.org/3.0/en/development/routing.html#creating-restful-routes).

### Example

HTTP verbs | URL.format               | actions
---------- | ------------------------ | -------
GET        | /resources.[format]/     | List
GET        | /resources/123.[format]/ | View
POST       | /resources.[format]/     | Add
PUT        | /resources/123.[format]/ | Edit
DELETE     | /resources/123.[format]/ | Delete

What's inside the square brackets is optional.

### To-Do (REST APIs)

- [ ] Provide access to Breeds.
- [x] Provide access to Customers.
- [ ] Provide access to Locations.
- [ ] Provide access to Movements.
- [ ] Provide access to Observations.
- [ ] Provide access to Patients.
- [ ] Provide access to Species.
- [ ] Provide access to Users.
- [ ] Provide access to Vaccinations.
- [ ] Provide access to Vaccines.
