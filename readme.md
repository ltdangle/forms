Proof-of-concept skeleton for managing HTML forms in PHP.

Rationale:
---------
* Forms should be treated as first-class citizens. A decent form requires considerable amount of front-end customisation. More often than not existing generic form solutions would not suffice and become too complicated for anything besides pre-defined CRUD operations. It is expected that a form should be hand-crafted with minimal support (this library).

* Forms are self-contained units (don't spread form functionality over several classes). This also means that html (either raw html or templates) is embedded in the php form class, which is ...fine. The inspiration comes from Reactjs class based components with its JSX html-in-js syntax. This way you can use full power of the php language to describe your view logic, including IDE features such as refactorings and navigation. Coding slightly complex behavior in twig templates, for example, becomes tangled very quickly.

* Forms should be easily re-usable. You should be able to extend/modify a form just like you would any other php object.

* Forms should not rely on external validation libraries and rely on built-in php functions. The preferred approach is to use value objects where a value object would only accept valid values or throw an exception. The exception can then be caught and shown as a form error.

Usage instructions:
-------------------
1. Create a value object that implements `ValueObjectInterface.php` The value object should always be in a valid state and has to throw an exception in the constructor if the passed value is invalid.
2. Create a form class and extend it from `AbstractForm.php`
3. Implement `_configureFormValues()` method in your form class.
4. Implement `setValues()` method in your form class.

Please see `tests/ContactForm.php` and `tests/ContactFormTest.php` for working example.

To be continued...