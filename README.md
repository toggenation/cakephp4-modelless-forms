# CakePHP 4 - Example of how to handle multiple modelless forms on page that have Duplicate Field Names

## The problem
When you run multiple separate instances of a form class on a page and the forms have the same field names and then submit one of the forms the non active form grabs and displays the values and error from the "active" one.


## The Resolution

This repo contains an example of how to handle having 2 or more forms on a page that have the same field names.

In this example there are two forms with two fields with the same name on both forms `copies` & `printer_id`

To make it work you need make sure your form fields are all unique and won't interfere with other forms on the page despite having the same field names. 

The fix is to give the forms a unique name and dynamically rename the fields. You can then safely validate them on a per form basis.

## How it works
When new'ing up the multiple copies of a form on a page they need to be marked as unique. So that validation is applied to and errors show under the correct form fields.

Do this by customizing the form class to accept a form name and any other data your want to pass through

```php
// in controller instantiate the forms giving them a unique name
        foreach (['left', 'right'] as $form) {
            $copies = $form === 'left' ? 20 : 7;

            $forms[$form] = new CustomPrintSuccessForm($form, $copies);
        }
```

Prepend the unique form name to each input field for both schema and validator definitions.  

I do this by wrapping `$schema` and `$validator` with a Decorator class

So for the `left` form the field names become `left-copies` and `left-printer_id` and for the `right` form they become `right-copies` and `right-printer_id`

```php
// in CustomPrintSuccessForm.php

    protected function _buildSchema(Schema $schema): Schema
    {
        $schema = new DecorateForm($schema, $this->formName);

        $schema->addField('copies', 'integer')
            ->addField('printer_id', 'integer');

        // return the inner class that has been decorated
        return $schema->wrapped;
    }


    public function validationDefault(Validator $validator): Validator
    {

        $validator = new DecorateForm($validator, $this->formName);

        $validator
            ->notBlank('printer_id', "Please select a printer")
            ->allowEmptyString('copies', 'Please enter the number of copies you want to print')
            ->lessThan('copies', $this->copies, sprintf('Copies must be less than %d', $this->copies));

        return $validator->wrapped;
    }
```


```

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
-   src/Form/DecorateForm.php
-   templates/Print/multi_form_fail.php
-   templates/Print/multi_form_success.php
