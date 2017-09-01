Php client library for Insightly web API (v2.1)
===============================================

The Insightly PHP SDK enables PHP developers to quickly integrate their applications with the Insightly REST API (version 2.1).

NOTE: this SDK currently only works with version 2.1 of the Insightly API. To use version 2.2, you'll need to modify this library, or you can use Swagger (www.swagger.io) to auto-generate an SDK (it can generate SDKs for over a dozen different target languages).

NOTE: works best with PHP version 5.5.x, some users have reported issues with parse errors using older versions of PHP.

The library handles low level communication, authentication,
and encoding to minimize learning curve and debugging overhead for new users.
The library provides the ability to read/write/delete
all major Insightly objects, including:

* Contacts
* Events
* Organizations
* Opportunities
* Projects

To use the library, simply add Insightly.php to your PHP include-path.
Then making requests is as simple as:

```php
require_once "Insightly.php";

$i = new Insightly('your-api-key');
$contacts = $i->getContacts();
```

To add a lead:

```php
$insightly = new Insightly('your-api-key');

$tags = [
    (object)["TAG_NAME" => 'first_tag'],
	(object)["TAG_NAME" => 'second_tag']
]; // add multiple tags if you want
$arr = [
        'FIRST_NAME' => 'Jimmy', // add the person's first and last name
        'LAST_NAME' => 'Hollow', // 
        'ORGANIZATION_NAME' => 'Put-Organization-Name-Here',
        'PHONE_NUMBER' => '555-555-5555',
        'EMAIL_ADDRESS' => 'Put-Email-Here',
        'TAGS' => $tags,
        'LEAD_SOURCE_ID' => 9999999 // Get the real value for the source you want to use
        ];
$lead = $insightly->addLead((object)$arr);
```

The API interface is provided by the `Insightly` class.
Please refer to the source-code documentation for more information.

The library was authored by Nathan Davis, and is currently in beta.
