# Configuring

Download the zip file

or

```
https://github.com/fernandocoronatomf/delivery-order-api.git
```

Then

```
composer install
```

To Run the tests (Code repo 100% tested)

```
./vendor/phpunit/phpunit/phpunit tests
```

# Overview

The application Domain/ stores entities and value-objects classes


The repository layer implements a way to handle in memory collection of entities with basic operations such as getAll(), findById(), save(), etc


The service layer contains classes interacting with our domain layer such as a Reader implementation and ProcessDeliveryOrder service


1 - The method used to development was TDD (Test Driven Design) and the application is 100% covered by tests

2 - Some design patterns were used such as Factory Classes, Decorators, Dependency Injection, Polymorphism, Inheritance, Strategy (coding against a interface instead of a concrete class so we can switch implementations easily at run time)

3 - The appication was developed in about 5-6 hours and could be improved but this is just an example

# Examples

```
// Read Json File
// Instantiate the reader and decorates the response to output as array (JsonReader returns the json only, but both implements the same interface so we can call readFile() later)
1 - $jsonConvertedToArray = new JsonReaderToArrayDecorator(new JsonReader(__ROOT__ . 'orders.json'));

// Initiating repositories
2 - $orderRepository = new OrderRepository(new InMemoryCollection());
    $customerRepository = new CustomerRepository(new InMemoryCollection());
    $campaignRepository = new CampaignRepository(new InMemoryCollection());

// Save all the data to its respective collections on a mapper class
3 - $orderListMapper = new OrderListMapper($customerRepository, $campaignRepository, $orderRepository);

// Using the Facade Design Pattern we encapsulate all the steps to process the file and everything related to it
// Client does not need to know how they work inside the class as long as the dependencies implement the interfaces asked on the contructor
4 - $processDeliveryOrderFacade = new ProcessDeliveryOrder($jsonConvertedToArray, $orderListMapper);
    $processDeliveryOrderFacade->process();
    
// Inside $processDeliveryOrderFacade->process()
// we loop through a collection of Order objects
// using the factory pattern we return 3 different classes based on deliveryType:

// ProcessPersonalDelivery, ProcessPersonalDeliveryExpress, ProcessEnterpriseDelivery
// They all implement the same Delivery Interface
// The parent class triggers a 'event' if the order came from a campaign to notify a service that logs orders successfully receiveds from campaigns
// they all implement the same process method but ProcessEnterpriseDelivery goes one step further and sends data for a external API to be validated
// If processed, delivers will be made and the output look like this
// note: I added different deliver estimate days for each type of processment

Order no 1 processed and will be delived in 10 days 

Order no 2 was created through campaign Christmas2018 and logged on marketing service 
Order no 2 processed and will be delived in 3 days 

Order no 3 sent to external api to be validated 
Order no 3 processed and will be delived in 1 days 


// ProcessPersonalDelivery


```

To run the code yourself, please do 

```
php -S localhost:8001
```

and access it on your browser


http://localhost:8001/index.php

Questions?
Thanks (: