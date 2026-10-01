<?php

/*
 * JSON in PHP
 * ---------------------------
 * JSON is a text format used to exchange data between programs.
 * PHP gives us two main functions:
 *   json_encode() -> turns a PHP array/object INTO a JSON string
 *   json_decode() -> turns a JSON string BACK INTO a PHP object/array
 */


// ============================================================
// PART 1: json_encode() - PHP array => JSON string
// ============================================================

// Example 1: Associative array (key => value) becomes a JSON object { }
$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo json_encode($age);   // Output: {"Peter":35,"Ben":37,"Joe":43}
echo "<br>";

// Example 2: Indexed array (no keys) becomes a JSON list [ ]
$cars = array("Volvo", "BMW", "Toyota");
echo json_encode($cars);  // Output: ["Volvo","BMW","Toyota"]
echo "<br><br>";


// ============================================================
// PART 2: json_decode() - JSON string => PHP data
// ============================================================

// This is the JSON string we will decode in the examples below
$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

// Example 3: By default, json_decode() returns an OBJECT
var_dump(json_decode($jsonobj));

// Example 4: Pass "true" as the 2nd argument to get an ASSOCIATIVE ARRAY instead
var_dump(json_decode($jsonobj, true));
echo "<br><br>";


// ============================================================
// PART 3: Accessing values
// ============================================================

// Example 5: Access values from an OBJECT using the arrow "->"
$obj = json_decode($jsonobj);

echo $obj->Peter;  // 35
echo "<br>";
echo $obj->Ben;    // 37
echo "<br>";
echo $obj->Joe;    // 43
echo "<br><br>";

// Example 6: Access values from an ARRAY using square brackets ["key"]
$arr = json_decode($jsonobj, true);

echo $arr["Peter"];  // 35
echo "<br>";
echo $arr["Ben"];    // 37
echo "<br>";
echo $arr["Joe"];    // 43
echo "<br><br>";


// ============================================================
// PART 4: Looping through decoded data with foreach
// ============================================================

// Example 7: Loop through an OBJECT
$obj = json_decode($jsonobj);

foreach ($obj as $key => $value) {
    echo $key . " => " . $value . "<br>";
}
echo "<br>";

// Example 8: Loop through an ARRAY
$arr = json_decode($jsonobj, true);

foreach ($arr as $key => $value) {
    echo $key . " => " . $value . "<br>";
}
