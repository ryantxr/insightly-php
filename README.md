# PHP client library for Insightly web API (v2.1)

The Insightly PHP SDK enables PHP developers to quickly integrate their applications with the Insightly REST API (version 2.1).

NOTE: this SDK currently only works with version 2.1 of the Insightly API. To use version 2.2, you'll need to modify this library, or you can use Swagger (www.swagger.io) to auto-generate an SDK (it can generate SDKs for over a dozen different target languages).

NOTE: works best with PHP version 7.x or 5.6.x.

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
require_once "vendor/autoload.php";

$insightly = new Ryantxr\Insightly\Client('your-api-key');
$contacts = $insightly->getContacts();
```

To add a lead:

```php
$insightly = new Ryantxr\Insightly\Client('your-api-key');

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

## Use Patterns

### Create/Update Actions

These methods expect an object containing valid data fields for the object.
They will return a dictionary containing the object
as stored on the server (if successful)
or raise an exception if the create/update request fails.
You indicate whether you want to create a new item
by setting the record id to 0 or omitting it.

To obtain sample objects, you can do the following:

```php
$contact = $i->addContact('sample');
$event = $i->addEvent('sample');
$organization = $i->addOrganization('sample');
$project = $i->addProject('sample');
```

This will return a random item from your account,
so you can see what fields are required,
along with representative field values.

### Search Actions

These methods return a list of dictionaries containing the matching items.
For example to request a list of all contacts, you call:

`$contacts = $i->getContacts();`

### Search Actions Using ODATA

Search methods recognize top, skip, orderby and filters parameters,
which you can use to page, order and filter recordsets.
These are passed via an associative array:

```php
// get the first 200 contacts   
$contacts = $i->getContacts(array("top" => 200));

// get the first 200 contacts, in first name descending order
$contacts = $i->getContacts(array("orderby" => 'FIRST_NAME desc', "top" => 200));

// get 200 records, after skipping the first 200 records
$contacts = $i->getContacts(array("top" => 200, "skip" => 200));

// get contacts where FIRST_NAME='Brian'
$contacts = $i->getContacts(array("filters" => array('FIRST_NAME=\'Brian\'')));
```

IMPORTANT NOTE: when using OData filters,
be sure to include escaped quotes around the search term.
Otherwise you will get a 400 (bad request) error.

These methods will raise an exception if the lookup fails,
or return a (possibly empty) list of objects if successful.

### Read Actions (Single Item)

These methods will return a single object containing the requested item's properties.

`$contact = $i->getContact(123456);`

### Delete Actions

These methods will return True if successful, or raise an exception.
e.g.

`$success = $i->deleteContact(123456)`

### Image And File Attachment Management

The API calls to manage images and file attachments have not yet been implemented in the PHP library. However you can access
these directly via our REST API

### Issues To Be Aware Of

This library makes it easy to integrate with Insightly,
and by automating HTTPS requests for you,
eliminates the most common causes of user issues.
That said, the service is picky about rejecting requests
that do not have required fields, or have invalid field values
(such as an invalid USER_ID).
When this happens, you'll get a 400 (bad request) error.
Your best bet at this point is to consult the
API documentation and look at the required request data.

Write/update methods also have a dummy feature
that returns sample objects that you can use as a starting point.
For example, to obtain a sample task object, just call:

`$task = $i->addTask('sample');`

This will return one of the tasks from your Insightly account,
so you can get a sense of the fields and values used.

If you are working with large recordsets,
we strongly recommend that you use ODATA functions,
such as top and skip to page through recordsets
rather than trying to fetch entire recordsets in one go.
This both improves client/server communication,
but also minimizes memory requirements on your end.

### Troubleshooting Tips

One of the main issues API users run into during write/update operations
is a 400 error (bad request) due to missing required fields.
If you are unclear about what the server is expecting,
a good way to troubleshoot this is to do the following:

* Using the web interface, create the object in question
    (contact, project, team, etc), and add sample data and child elements to it
* Use the corresponding getNNNN() method to retrieve this object via the web API
* Inspect the object's contents and structure

Read operations via the API are generally quite straightforward,
so if you get struck on a write operation, this is a good workaround,
as you are probably just missing a required field
or using an invalid element ID when referring
to something such as a link to a contact.

The library is built using PHP standard libraries.
(no third party tools required, so it will run out of the box
on most PHP environments).
The wrapper functions return native PHP objects (arrays and objects),
so working with them is easily done using built in functions. 

The API interface is provided by the `Ryantxr\Insightly\Client` class.
Please refer to the source-code documentation for more information.

The library was authored by Nathan Davis, and is currently in beta.
