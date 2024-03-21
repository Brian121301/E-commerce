<?php

require 'vendor/autoload.php'; // Include the Composer autoload file

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;

// Instantiate a DynamoDB client
$client = new DynamoDbClient([
    'region'   => 'your-region',
    'version'  => 'latest',
]);

// Define your DynamoDB table name
$tableName = 'your-table-name';

try {
    // Put an item into the table
    $client->putItem([
        'TableName' => $tableName,
        'Item' => [
            'id' => ['N' => '1'],
            'name' => ['S' => 'John Doe'],
            // Add more attributes as needed
        ],
    ]);

    echo "Item added successfully.\n";

    // Get an item from the table
    $result = $client->getItem([
        'TableName' => $tableName,
        'Key' => [
            'id' => ['N' => '1'],
        ],
    ]);
    print_r($result['Item']);

    // Delete an item from the table
    $client->deleteItem([
        'TableName' => $tableName,
        'Key' => [
            'id' => ['N' => '1'],
        ],
    ]);

    echo "Item deleted successfully.\n";
} catch (DynamoDbException $e) {
    echo "Unable to perform DynamoDB operation: " . $e->getMessage() . "\n";
}
