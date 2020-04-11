# CakePHP 4 Example of Multiple Modelless Forms with Duplicate Fields

This is an example of how to handle having 2 or more forms on a page that have the same fields

When you run multiple separate instances of a form class on a page and the forms have the same field names and then submit one of the forms the non active form grabs the current values from the active one.

This is an example of how to make sure your form fields are all unique and won't interfere with other forms on the page despite having the same field names.

I tried a number of approaches including naming the fields "formName.fieldName" to get formName[fieldName] and trying nestedValidators in the Modelless form class which didn't work

To test this clone this repo and then

```
composer install
```

Start the internal server it should be available at http://localhost:8765

```
bin/cake server
```

Connect to see failing and successful examples

| Result  | URL                                          |
| ------- | -------------------------------------------- |
| Success | http://localhost:8765/Print/multiFormSuccess |
| Fail    | http://localhost:8765/Print/multiFormFail    |

With the failing example when you submit the right or left form the values are immediately echoed in the opposite

See the files

-   src/Controller/PrintController.php
-   src/Form/CustomPrintFail.php
-   src/Form/CustomPrintSuccess.php
-   templates/Print/multi_form_fail.php
-   templates/Print/multi_form_success.php
